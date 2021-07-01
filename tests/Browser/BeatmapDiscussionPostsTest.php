<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Browser;

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BeatmapDiscussionPostsTest extends DuskTestCase
{
    private $new_reply_widget_selector = '.beatmap-discussion-post--new-reply';

    public function testConcurrentPostAfterResolve()
    {
        $this->browse(function (Browser $first, Browser $second) {
            // Setup both browsers.
            $this->visitDiscussionPageAsUser($first, $this->mapper);
            $this->visitDiscussionPageAsUser($second, $this->user);

            // Write a reply...
            $this->writeReply($first, 'Fixed');
            $this->writeReply($second, 'Hey!');

            // And send the replies.
            $this->postReply($first, 'resolve');
            $this->postReply($second, 'reply');

            $first->pause(2000);
            $second->pause(2000);

            $this->assertSame(true, $this->beatmapDiscussion->fresh()->resolved);
        });
    }

    protected function writeReply(Browser $browser, $reply)
    {
        $browser->with($this->new_reply_widget_selector, function ($new_reply) use ($reply) {
            $new_reply->press('Respond')
                ->waitFor('textarea')
                ->type('textarea', $reply);
        });
    }

    protected function postReply(Browser $browser, $action)
    {
        $browser->with($this->new_reply_widget_selector, function ($new_reply) use ($action) {
            switch ($action) {
                case 'resolve':
                    $new_reply->press('Reply and Resolve');
                    break;
                default:
                    $new_reply->keys('textarea', '{enter}');
                    break;
            }
        });
    }

    protected function visitDiscussionPageAsUser(Browser $browser, User $user): void
    {
        $browser->loginAs($user)
            ->visit('/_dusk/verify')
            ->visitRoute('beatmapsets.discussions.show', [
                'discussion' => $this->beatmapDiscussion->getKey(),
            ]);
    }

    protected function createUserCapableOfDiscussing(): User
    {
        $user = factory(User::class)->create();
        $user->statisticsOsu()->create(['playcount' => $this->minPlays]);

        return $user;
    }

    protected function deleteUser(User $user): void
    {
        $user->userProfileCustomization()->forceDelete();
        $user->forceDelete();
    }

    protected function cleanup(): void
    {
        // Delete all models we created.
        $this->beatmapDiscussion->beatmapDiscussionPosts()->forceDelete();
        $this->beatmapDiscussion->forceDelete();
        $this->beatmap->forceDelete();
        $this->beatmapset->events()->forceDelete();
        $this->beatmapset->forceDelete();
        $this->deleteUser($this->user);
        $this->deleteUser($this->mapper);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->minPlays = config('osu.user.min_plays_for_posting');

        $this->mapper = $this->createUserCapableOfDiscussing();
        $this->user = $this->createUserCapableOfDiscussing();

        $this->beatmapset = factory(Beatmapset::class)->create([
            'user_id' => $this->mapper->getKey(),
        ]);
        $this->beatmap = $this->beatmapset->beatmaps()->save(factory(Beatmap::class)->make([
            'user_id' => $this->mapper->getKey(),
        ]));
        $this->beatmapDiscussion = factory(BeatmapDiscussion::class)->states('timeline')->create([
            'beatmapset_id' => $this->beatmapset->getKey(),
            'beatmap_id' => $this->beatmap->getKey(),
            'user_id' => $this->user->getKey(),
        ]);
        $post = factory(BeatmapDiscussionPost::class)->states('timeline')->make([
            'user_id' => $this->user->getKey(),
        ]);
        $this->beatmapDiscussionPost = $this->beatmapDiscussion->beatmapDiscussionPosts()->save($post);

        $this->beforeApplicationDestroyed(function () {
            // Similar case to SanityTest, cleanup the models we created during the test.
            $this->cleanup();
        });
    }
}
