<?php

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Chat\Channel;
use App\Models\Multiplayer\Room;

class RoomsController extends Controller
{
    public function createMm()
    {
        $host = User::findOrFail($GLOBALS['cfg']['osu']['legacy']['bancho_bot_user_id']);

        $room = new Room();
        $room->user_id = $host->getKey();

        // Unsure what this should be for now.
        $room->name = 'player 1 vs player 2 vs player 3 vs... etc?';

        // Todo: Participant IDs are serialised through the `user_id` param (array).
        //       The room should somehow be exclusive to these users (only they may ever join).
        //       Perhaps also add validation.
        $room->password = 'wangs';

        // Special flags (unsure which ones are required right now).
        $room->category = 'mm';
        $room->type = 'mm';
        $room->queue_mode = 'mm';

        // Equivalent to realtime rooms.
        $room->starts_at = now();
        $room->ends_at = now()->addSeconds(30);

        // No initial playlist.

        $room->getConnection()->transaction(function () use ($room) {
            $room->save(); // need to persist to get primary key for channel name.
            $channel = Channel::createMultiplayer($room);
            $room->update(['channel_id' => $channel->channel_id]);
        });

        return response($room->getKey());
    }
}
