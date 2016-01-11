<?php
namespace App\Transformers\API;

use App\Models\Channel;
use App\Models\Message;
use League\Fractal;

class ChannelTransformer extends Fractal\TransformerAbstract {
	public $availableIncludes = ['messages'];
	public function transform(Channel $channel) {
		return [
			'id' => $channel->channel_id,
			'name' => $channel->name,
			'created_at' => $channel->created_at
		];
	}

	public function includeMessages(Channel $channel) {
		return $this->collection(
			$channel->messages,
			new MessageTransformer()
		);
	}
}