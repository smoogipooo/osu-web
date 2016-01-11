<?php
namespace App\Transformers\API;

use App\Models\Message;
use League\Fractal;

class MessageTransformer extends Fractal\TransformerAbstract {

	public $availableIncludes = ['user'];

	public function transform(Message $message) {
		return [
			'id' => $message->message_id,
			'user_id' => $message->user_id,
			'content' => $message->content,
			'channel_id' => $message->channel_id,
			'created_at' => $message->timestamp
		];
	}

	public function includeUser(Message $message) {
		return $this->item(
			$message->user,
			new UserTransformer()
		);
	}
}