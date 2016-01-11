<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "osu_chat.messages";
    public $timestamps = false;

    public function channel()
    {
    	return $this->belongsTo('App\Models\Channel', 'channel_id', 'channel_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
}
