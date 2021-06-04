// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed } from 'mobx';
import { observer } from 'mobx-react';
import { typeNames } from 'models/notification-type';
import NotificationIcon from 'notification-icon';
import core from 'osu-core-singleton';
import * as React from 'react';

interface Props {
  type?: string;
}

@observer
export default class MainNotificationIcon extends React.Component<Props> {
  @computed
  private get unreadCount() {
    // TODO: need a better way of propagating the exclusion list to this (but it's global anyway?)
    const types = typeNames.filter((name) => !(name == null || name === 'channel'));
    return types.reduce((acc, current) => acc + core.dataStore.notificationStore.unreadStacks.getOrCreateType({ objectType: current }).total, 0);
  }

  render() {
    return <NotificationIcon count={this.unreadCount} iconClassName='fas fa-inbox' ready={core.notificationsWorker.hasData} type={this.props.type} />;
  }
}
