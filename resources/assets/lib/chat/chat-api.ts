// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import Message from 'models/chat/message';
import * as ApiResponses from './chat-api-responses';

export default class ChatAPI {
  getMessages(channelId: number, params?: { since?: number; until?: number }) {
    return $.get(route('chat.channels.messages.index', { channel: channelId, ...params })) as JQuery.jqXHR<ApiResponses.GetMessagesJson>;
  }

  getUpdates(since: number, lastHistoryId?: number | null) {
    return $.get(route('chat.updates'), { history_since: lastHistoryId, since }) as JQuery.jqXHR<ApiResponses.GetUpdatesJson>;
  }

  markAsRead(channelId: number, messageId: number) {
    return $.ajax({
      type: 'PUT',
      url: route('chat.channels.mark-as-read', {channel: channelId, message: messageId}),
    }) as JQuery.jqXHR<ApiResponses.MarkAsReadJson>;
  }

  newConversation(userId: number, message: Message) {
    return $.post(route('chat.new'), {
      is_action: message.isAction,
      message: message.content,
      target_id: userId,
    }) as JQuery.jqXHR<ApiResponses.NewConversationJson>;
  }

  partChannel(channelId: number, userId: number) {
    return $.ajax(route('chat.channels.part', {
      channel: channelId,
      user: userId,
    }), {
      method: 'DELETE',
    }) as JQuery.jqXHR<void>;
  }

  sendMessage(message: Message) {
    return $.post(route('chat.channels.messages.store', { channel: message.channelId }), {
      is_action: message.isAction,
      message: message.content,
      target_id: message.channelId,
      target_type: 'channel',
    }) as JQuery.jqXHR<ApiResponses.SendMessageJson>;
  }
}
