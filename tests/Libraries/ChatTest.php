<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Exceptions\VerificationRequiredException;
use App\Libraries\Chat;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\User;
use Exception;
use Tests\TestCase;

class ChatTest extends TestCase
{
    /**
     * @dataProvider verifiedDataProvider
     */
    public function testSendMessage(bool $verified, $expectedException)
    {
        $sender = factory(User::class)->create();
        $channel = factory(Channel::class)->states('public')->create();
        $channel->addUser($sender);

        if ($verified) {
            $sender->markSessionVerified();
        }

        if ($expectedException === null) {
            $this->expectNotToPerformAssertions();
        } else {
            $this->expectException($expectedException);
        }

        Chat::sendMessage($sender, $channel, 'test', false);
    }

    public function testSendPM()
    {
        $sender = factory(User::class)->create();
        $sender->markSessionVerified();
        $target = factory(User::class)->create(['pm_friends_only' => false]);

        $initialChannelsCount = Channel::count();
        $initialMessagesCount = Message::count();

        Chat::sendPrivateMessage($sender, $target, 'test message', false);

        $channel = Channel::findPM($sender, $target);

        $this->assertInstanceOf(Channel::class, $channel);
        $this->assertSame($initialChannelsCount + 1, Channel::count());
        $this->assertSame($initialMessagesCount + 1, Message::count());
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testSendPMFriendsOnly($groupIdentifier, $successful)
    {
        $sender = $this->createUserWithGroup($groupIdentifier);
        $sender->markSessionVerified();
        $target = factory(User::class)->create(['pm_friends_only' => true]);

        $initialChannelsCount = Channel::count();
        $initialMessagesCount = Message::count();

        try {
            Chat::sendPrivateMessage($sender, $target, 'test message', false);
        } catch (Exception $e) {
            $savedException = $e;
        }

        if ($successful) {
            $this->assertSame($initialChannelsCount + 1, Channel::count());
            $this->assertSame($initialMessagesCount + 1, Message::count());
        } else {
            $this->assertNull(Channel::findPM($sender, $target));
            $this->assertSame($initialChannelsCount, Channel::count());
            $this->assertSame($initialMessagesCount, Message::count());
            $this->assertSame(
                'User is blocking messages from people not on their friends list.',
                $savedException->getMessage()
            );
        }
    }

    public function testSendPMTooLongNotCreatingNewChannel()
    {
        $sender = factory(User::class)->create();
        $sender->markSessionVerified();
        $target = factory(User::class)->create(['pm_friends_only' => false]);

        $initialChannelsCount = Channel::count();
        $initialMessagesCount = Message::count();
        $longMessage = str_repeat('a', config('osu.chat.message_length_limit') + 1);

        try {
            Chat::sendPrivateMessage($sender, $target, $longMessage, false);
        } catch (Exception $e) {
            $savedException = $e;
        }

        $this->assertNull(Channel::findPM($sender, $target));
        $this->assertSame($initialChannelsCount, Channel::count());
        $this->assertSame($initialMessagesCount, Message::count());
        $this->assertSame(
            'The message you are trying to send is too long.',
            $savedException->getMessage()
        );
    }

    public function testSendPMSecondTime()
    {
        $sender = factory(User::class)->create();
        $sender->markSessionVerified();
        $target = factory(User::class)->create(['pm_friends_only' => false]);

        Chat::sendPrivateMessage($sender, $target, 'test message', false);

        $initialChannelsCount = Channel::count();
        $initialMessagesCount = Message::count();

        Chat::sendPrivateMessage($sender, $target, 'test message again', false);

        $this->assertSame($initialChannelsCount, Channel::count());
        $this->assertSame($initialMessagesCount + 1, Message::count());
    }

    public function groupsDataProvider()
    {
        return [
            ['admin', true],
            ['bng', false],
            ['gmt', true],
            ['nat', true],
            [[], false],
        ];
    }

    public function verifiedDataProvider()
    {
        return [
            [false, VerificationRequiredException::class],
            [true, null],
        ];
    }
}
