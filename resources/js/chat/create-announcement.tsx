// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import InputContainer from 'components/input-container';
import { Spinner } from 'components/spinner';
import UserCardBrick from 'components/user-card-brick';
import UserJson from 'interfaces/user-json';
import { action, computed, makeObservable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { isInputKey } from 'models/chat/create-announcement';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';

type Props = Record<string, never>;

const BusySpinner = ({ busy }: { busy: boolean }) => (
  <div className='chat-form__spinner'>
    {busy && <Spinner />}
  </div>
);

@observer
export default class CreateAnnouncement extends React.Component<Props> {
  @computed
  private get canSend() {
    return core.dataStore.chatState.isReady && !core.dataStore.chatState.isAddingChannel && this.model.isValid;
  }

  @computed
  private get model() {
    return core.dataStore.chatState.createAnnouncement;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    runInAction(() => {
      this.model.initialize();
    });
  }

  render() {
    if (!core.dataStore.chatState.canChatAnnounce) return null;

    return (
      <div className='chat-form'>
        <div className='chat-form__fields'>
          <div className='chat-form__title'>{trans('chat.form.title.announcement')}</div>
          <InputContainer
            labelKey='chat.form.labels.name'
            modifiers='chat'
            {...this.model.inputContainerPropsFor('name')}
          >
            <input
              className='chat-form__input'
              defaultValue={this.model.inputs.name}
              name='name'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
            />
          </InputContainer>
          <InputContainer
            labelKey='chat.form.labels.description'
            modifiers='chat'
            {...this.model.inputContainerPropsFor('description')}
          >
            <input
              className='chat-form__input'
              defaultValue={this.model.inputs.description}
              name='description'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
            />
          </InputContainer>
          <InputContainer
            for='chat-form-users'
            labelKey='chat.form.labels.users'
            modifiers='chat'
            {...this.model.inputContainerPropsFor('users')}
          >
            <div className='chat-form__users'>
              <UserCardBrick user={core.currentUserOrFail} />
              {this.renderValidUsers()}
              <input
                className='chat-form__input chat-form__input--users'
                id='chat-form-users'
                name='users'
                onBlur={this.handleBlur}
                onChange={this.handleUsersInputChange}
                onKeyDown={this.handleUsersInputKeyDown}
                onPaste={this.handleUsersInputPaste}
                value={this.model.inputs.users}
              />
              <BusySpinner busy={this.model.lookingUpUsers} />
            </div>
          </InputContainer>
          <InputContainer
            labelKey='chat.form.labels.message'
            modifiers={['chat', 'fill']}
            {...this.model.inputContainerPropsFor('message')}
          >
            <textarea
              autoComplete='off'
              className='chat-form__input chat-form__input--box'
              defaultValue={this.model.inputs.message}
              name='message'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
              placeholder={trans('chat.input.placeholder')}
            />
          </InputContainer>
          <div className='chat-form__button-bar'>
            <BigButton
              disabled={!this.canSend}
              icon='fas fa-bullhorn'
              isBusy={core.dataStore.chatState.isAddingChannel}
              modifiers='chat-send'
              props={{ onClick: this.handleButtonClick }}
              text={trans(core.dataStore.chatState.isReady ? 'chat.input.create' : 'chat.input.disconnected')}
            />
          </div>
        </div>
      </div>
    );
  }

  @action
  private readonly handleBlur = (e: React.FocusEvent<HTMLInputElement> | React.FocusEvent<HTMLTextAreaElement>) => {
    const elem = e.target;

    if (isInputKey(elem.name)) {
      this.model.showError[elem.name] = true;
    }
  };

  @action
  private readonly handleButtonClick = () => {
    core.dataStore.chatState.addChannel();
  };

  @action
  private readonly handleInput = (e: React.ChangeEvent<HTMLInputElement> | React.FormEvent<HTMLTextAreaElement>) => {
    const elem = e.currentTarget;

    if (isInputKey(elem.name)) {
      this.model.inputs[elem.name] = elem.value.trim();
    }
  };

  @action
  private readonly handleRemoveUser = (user: UserJson) => {
    this.model.validUsers.delete(user.id);
  };

  @action
  private readonly handleUsersInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.model.updateUsers(e.currentTarget.value, false);
  };

  @action
  private readonly handleUsersInputKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
    const elem = e.currentTarget;
    if (e.key === 'Backspace' && elem.selectionStart === 0 && elem.selectionEnd === 0) {
      const last = [...this.model.validUsers.keys()].pop();
      if (last != null) {
        this.model.validUsers.delete(last);
      }
    }
  };

  @action
  private readonly handleUsersInputPaste = (e: React.SyntheticEvent<HTMLInputElement>) => {
    this.model.updateUsers(e.currentTarget.value, true);
  };

  private renderValidUsers() {
    return [...this.model.validUsers.values()].map((user) => (
      <UserCardBrick key={user.id} onRemoveClick={this.handleRemoveUser} user={user} />
    ));
  }
}
