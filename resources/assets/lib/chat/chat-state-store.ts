// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatNewConversationAdded } from 'actions/chat-new-conversation-added';
import DispatcherAction from 'actions/dispatcher-action';
import FriendUpdated from 'actions/friend-updated';
import SocketMessageSendAction from 'actions/socket-message-send-action';
import SocketStateChangedAction from 'actions/socket-state-changed-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { supportedChannelTypes } from 'interfaces/chat/channel-json';
import { clamp, maxBy } from 'lodash';
import { action, autorun, computed, makeObservable, observable, observe, runInAction } from 'mobx';
import Channel from 'models/chat/channel';
import ChannelStore from 'stores/channel-store';
import { updateQueryString } from 'utils/url';
import ChannelJoinEvent from './channel-join-event';
import ChannelPartEvent from './channel-part-event';
import { getUpdates } from './chat-api';
import MainView from './main-view';
import PingService from './ping-service';

@dispatchListener
export default class ChatStateStore implements DispatchListener {
  @observable isReady = false;
  skipRefresh = false;
  @observable viewsMounted = new Set<MainView>();
  @observable private isConnected = false;
  private lastHistoryId: number | null = null;
  private pingService: PingService;
  @observable private selected: number | null = null;
  private selectedIndex = 0;

  @computed
  get isChatMounted() {
    return this.viewsMounted.size > 0;
  }

  @computed
  get selectedChannel() {
    return this.selected != null ? this.channelStore.get(this.selected) : null;
  }

  @computed
  private get channelList(): Channel[] {
    return supportedChannelTypes.flatMap((type) => this.channelStore.groupedChannels[type]);
  }

  constructor(protected channelStore: ChannelStore) {
    this.pingService = new PingService(channelStore);

    makeObservable(this);

    observe(channelStore.channels, (changes) => {
      // refocus channels if any gets removed
      if (changes.type === 'delete') {
        this.refocusSelectedChannel();
      }
    });

    autorun(() => {
      if (this.isReady && this.isChatMounted) {
        this.pingService.start();
        dispatch(new SocketMessageSendAction({ event: 'chat.start' }));
      } else {
        this.pingService.stop();
        dispatch(new SocketMessageSendAction({ event: 'chat.end' }));
      }
    });

    autorun(async () => {
      if (this.isConnected && this.isChatMounted) {
        if (this.skipRefresh) {
          this.skipRefresh = false;
        } else {
          await this.updateChannelList();
        }

        runInAction(() => {
          // TODO: use selectChannel?
          if (this.selected != null) {
            this.channelStore.loadChannel(this.selected);
          }

          this.isReady = true;
        });
      }
    });
  }

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof ChannelJoinEvent) {
      this.handleChatChannelJoinEvent(event);
    } else if (event instanceof ChannelPartEvent) {
      this.handleChatChannelPartEvent(event);
    } else if (event instanceof ChatNewConversationAdded) {
      this.handleChatNewConversationAdded(event);
    } else if (event instanceof FriendUpdated) {
      this.handleFriendUpdated(event);
    } else if (event instanceof SocketStateChangedAction) {
      this.handleSocketStateChanged(event);
    }
  }

  @action
  selectChannel(channelId: number | null, mode: 'advanceHistory' | 'replaceHistory' | null = 'advanceHistory') {
    // TODO: enfore location url even if channel doesn't change;
    // noticeable when navigating via ?sendto= on existing channel.
    if (this.selected === channelId) return;

    // mark the channel being switched away from as read.
    if (this.selectedChannel != null) {
      this.channelStore.markAsRead(this.selectedChannel.channelId);
    }

    this.selected = channelId;

    if (channelId == null) return;

    const channel = this.channelStore.get(channelId);

    if (channel == null) {
      console.error(`Trying to switch to non-existent channel ${channelId}`);
      return;
    }

    this.selectedIndex = this.channelList.indexOf(channel);

    // TODO: should this be here or have something else figure out if channel needs to be loaded?
    this.channelStore.loadChannel(channelId);

    if (mode != null) {
      const params = channel.newPmChannel
        ? { channel_id: null, sendto: channel.pmTarget?.toString() }
        : { channel_id: channel.channelId.toString(), sendto: null };

      Turbolinks.controller[mode](updateQueryString(null, params));
    }
  }

  @action
  selectFirst() {
    if (this.channelList.length === 0) return;

    this.selectChannel(this.channelList[0].channelId, null);
    // Remove channel_id from location on selectFirst();
    // also handles the case when history goes back to a channel that was removed.
    Turbolinks.controller.replaceHistory(updateQueryString(null, {
      channel_id: null,
      sendto: null,
    }));
  }

  @action
  private focusChannelAtIndex(index: number) {
    if (this.channelList.length === 0) {
      return;
    }

    const nextIndex = clamp(index, 0, this.channelList.length - 1);
    const channel = this.channelList[nextIndex];

    this.selectChannel(channel.channelId);
  }

  @action
  private handleChatChannelJoinEvent(event: ChannelJoinEvent) {
    this.channelStore.update(event.json);
  }

  @action
  private handleChatChannelPartEvent(event: ChannelPartEvent) {
    this.channelStore.partChannel(event.channelId, false);
  }

  @action
  private handleChatNewConversationAdded(event: ChatNewConversationAdded) {
    // TODO: currently only the current window triggers the action, but this should be updated
    // to ignore unfocused windows once new conversation added messages start getting triggered over the websocket.
    this.selectChannel(event.channelId);
  }

  @action
  private handleFriendUpdated(event: FriendUpdated) {
    if (!this.isChatMounted) return;

    // FIXME: friend list update isn't propagated to other tabs without a full refresh, yet.
    const channel = this.channelStore.groupedChannels.PM.find((value) => value.pmTarget === event.userId);
    channel?.refresh();
  }

  @action
  private handleSocketStateChanged(event: SocketStateChangedAction) {
    this.isConnected = event.connected;
    if (!event.connected) {
      this.channelStore.channels.forEach((channel) => channel.needsRefresh = true);
      this.isReady = false;
    }
  }

  @action
  /**
   * Keeps the current channel in focus, unless deleted, then focus on next channel.
   */
  private refocusSelectedChannel() {
    if (this.selectedChannel != null) {
      this.selectChannel(this.selectedChannel.channelId);
    } else {
      this.focusChannelAtIndex(this.selectedIndex);
    }
  }

  @action
  private async updateChannelList() {
    const json = await getUpdates(this.channelStore.lastReceivedMessageId, this.lastHistoryId);
    if (!json) return; // FIXME: fix response

    runInAction(() => {
      const newHistoryId = maxBy(json.silences, 'id')?.id;

      if (newHistoryId != null) {
        this.lastHistoryId = newHistoryId;
      }

      this.channelStore.updateWithChatUpdates(json);
    });
  }
}
