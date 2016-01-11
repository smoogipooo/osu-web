<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
	protected $table = "osu_chat.channels";

	public function messages()
	{
		return $this->hasMany('App\Models\Message', 'channel_id', 'channel_id');
	}
}
