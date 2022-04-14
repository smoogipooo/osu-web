// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BlockButton from 'components/block-button';
import NotificationBanner from 'components/notification-banner';
import UserJson from 'interfaces/user-json';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  children?: React.ReactNode;
  user: UserJson;
}

@observer
export default class UserProfileContainer extends React.Component<Props> {
  @observable private forceShow = false;

  @computed
  get isBlocked() {
    return core.currentUserModel.blocks.has(this.props.user.id);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    let cssClass: string | undefined;
    const modifiers = ['full'];
    if (this.isBlocked && !this.forceShow) {
      cssClass = 'osu-layout__no-scroll';
      modifiers.push('masked');
    }

    return (
      <div className={cssClass}>
        {this.isBlocked && this.renderBanner()}
        <div className={classWithModifiers('osu-layout', modifiers)}>
          {this.props.children}
        </div>
      </div>
    );
  }

  renderBanner() {
    const message = (
      <div className='grid-items grid-items--notification-banner-buttons'>
        <div>
          <BlockButton userId={this.props.user.id} />
        </div>
        <div>
          <button className='textual-button' onClick={this.handleClick} type='button'>
            <span>
              <i className='textual-button__icon fas fa-low-vision' />
              {' '}
              {this.forceShow ? osu.trans('users.blocks.hide_profile') : osu.trans('users.blocks.show_profile')}
            </span>
          </button>
        </div>
      </div>
    );

    return (
      <div className='osu-page'>
        <NotificationBanner message={message} title={osu.trans('users.blocks.banner_text')} type='warning' />
      </div>
    );
  }

  @action
  private handleClick = () => {
    this.forceShow = !this.forceShow;
  };
}
