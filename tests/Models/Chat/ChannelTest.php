<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Chat\Channel;
use App\Models\User;
use App\Models\UserRelation;
use Illuminate\Filesystem\Filesystem;
use SplFileInfo;
use Storage;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    public function testPublicChannelDoesNotShowUsers()
    {
        $user = factory(User::class)->create();
        $channel = $this->createChannel([$user], 'public');

        $this->assertSame(1, $channel->users()->count());
        $this->assertEmpty($channel->visibleUsers());
    }

    /**
     * @dataProvider channelWithBlockedUserVisibilityDataProvider
     */
    public function testChannelWithBlockedUserVisibility(array|string $otherUserGroup, bool $expectVisible)
    {
        $user = factory(User::class)->create();
        $otherUser = $this->createUserWithGroup($otherUserGroup);
        $channel = $this->createChannel([$user, $otherUser], 'pm');

        UserRelation::create([
            'user_id' => $user->getKey(),
            'zebra_id' => $otherUser->getKey(),
            'foe' => true,
        ]);

        $this->assertSame($expectVisible, $channel->isVisibleFor($user));
    }

    /**
     * @dataProvider channelCanMessageModeratedChannelDataProvider
     */
    public function testChannelCanMessageModeratedPmChannel(array|string $group, bool $canMessage)
    {
        $user = factory(User::class)->states($group)->create();
        $otherUser = factory(User::class)->create();
        $channel = $this->createChannel([$user, $otherUser], 'moderated', 'pm');

        $this->assertSame($canMessage, $channel->canMessage($user));
    }

    /**
     * @dataProvider channelCanMessageModeratedChannelDataProvider
     */
    public function testChannelCanMessageModeratedPublicChannel(array|string $group, bool $canMessage)
    {
        $user = factory(User::class)->states($group)->create();
        $channel = $this->createChannel([$user], 'moderated', 'public');

        $this->assertSame($canMessage, $channel->canMessage($user));
    }

    /**
     * @dataProvider channelCanMessageModeratedChannelDataProvider
     */
    public function testChannelCanMessagePmChannelWhenBlocked(array|string $group, bool $canMessage)
    {
        $user = factory(User::class)->states($group)->create();
        $otherUser = factory(User::class)->create();
        $channel = $this->createChannel([$user, $otherUser], 'pm');

        UserRelation::create([
            'user_id' => $user->getKey(),
            'zebra_id' => $otherUser->getKey(),
            'foe' => true,
        ]);

        // this assertion to make sure the correct block direction is being tested.
        $this->assertTrue($user->hasBlocked($otherUser));
        $this->assertSame($canMessage, $channel->canMessage($user));
    }

    /**
     * @dataProvider channelCanMessageModeratedChannelDataProvider
     */
    public function testChannelCanMessagePmChannelWhenBlocking(array|string $group, bool $canMessage)
    {
        $user = factory(User::class)->states($group)->create();
        $otherUser = factory(User::class)->create();
        $channel = $this->createChannel([$user, $otherUser], 'pm');

        UserRelation::create([
            'user_id' => $otherUser->getKey(),
            'zebra_id' => $user->getKey(),
            'foe' => true,
        ]);

        // this assertion to make sure the correct block direction is being tested.
        $this->assertTrue($otherUser->hasBlocked($user));
        $this->assertSame($canMessage, $channel->canMessage($user));
    }

    public function testPmChannelIcon()
    {
        Storage::fake('local-avatar');
        $this->beforeApplicationDestroyed(function () {
            (new Filesystem())->deleteDirectory(storage_path('framework/testing/disks/local-avatar'));
        });

        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();

        $testFile = new SplFileInfo(public_path('images/layout/avatar-guest.png'));
        $user->setAvatar($testFile);
        $otherUser->setAvatar($testFile);

        $channel = $this->createChannel([$user, $otherUser], 'pm');
        $this->assertSame($otherUser->user_avatar, $channel->displayIconFor($user));
        $this->assertSame($user->user_avatar, $channel->displayIconFor($otherUser));
    }

    public function testPmChannelName()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();

        $channel = $this->createChannel([$user, $otherUser], 'pm');
        $this->assertSame($otherUser->username, $channel->displayNameFor($user));
        $this->assertSame($user->username, $channel->displayNameFor($otherUser));
    }

    public function channelCanMessageModeratedChannelDataProvider()
    {
        return [
            [[], false],
            ['admin', true],
            ['bng', false],
            ['gmt', true],
            ['nat', true],
        ];
    }

    public function channelWithBlockedUserVisibilityDataProvider()
    {
        return [
            [[], false],
            ['admin', true],
            ['bng', false],
            ['gmt', true],
            ['nat', true],
        ];
    }

    private function createChannel(array $users, ...$types): Channel
    {
        $channel = factory(Channel::class)->states($types)->create();
        foreach ($users as $user) {
            $channel->addUser($user);
        }

        return $channel;
    }
}
