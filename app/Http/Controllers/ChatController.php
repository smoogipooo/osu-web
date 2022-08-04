<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\Chat;
use App\Libraries\UserChannelList;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\User;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // TODO: notification server and chat client needs some updating
        // to handle verification_requirement_change properly.
        if (config('osu.user.post_action_verification')) {
            $this->middleware('verify-user');
        }

        return parent::__construct();
    }

    public function index()
    {
        $user = auth()->user();
        Chat::ack($user);

        // rejoin any existing channel first, so it will be in the user channel list.
        $targetUser = User::lookup(get_int(request('sendto')), 'id');
        if ($targetUser !== null) {
            $channel = Channel::findPM($targetUser, $user);
            $channel?->addUser($user);

            $sendToJson = [
                'can_message_error' => ($channel?->checkCanMessage($user) ?? priv_check('ChatPmStart', $targetUser))->message(),
                'channel_id' => $channel?->getKey(),
                'target' => json_item($targetUser, 'UserCompact'),
            ];
        }

        $json = [
            'current_user_attributes' => [
                'can_chat_announce' => priv_check('ChatAnnounce')->can(),
            ],
            'last_message_id' => optional(Message::last())->getKey(),
            'presence' => (new UserChannelList($user))->get(),
        ];

        if (isset($sendToJson)) {
            $json['send_to'] = $sendToJson;
        }

        return ext_view('chat.index', compact('json'));
    }
}
