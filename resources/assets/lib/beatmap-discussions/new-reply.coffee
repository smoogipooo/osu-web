# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button'
import UserAvatar from 'components/user-avatar'
import { route } from 'laroute'
import core from 'osu-core-singleton'
import * as React from 'react'
import TextareaAutosize from 'react-autosize-textarea'
import { button, div, form, input, label, span, i } from 'react-dom-factories'
import { createClickCallback } from 'utils/html'
import { InputEventType, makeTextAreaHandler } from 'utils/input-handler'
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay'
import { MessageLengthCounter } from './message-length-counter'

el = React.createElement

bn = 'beatmap-discussion-post'

export class NewReply extends React.PureComponent
  ACTION_ICONS =
    reply_resolve: 'fas fa-check'
    reply_reopen: 'fas fa-exclamation-circle'
    reply: 'fas fa-reply'

  constructor: (props) ->
    super props

    @box = React.createRef()
    @handleKeyDown = makeTextAreaHandler @handleKeyDownCallback
    storedMessage = @storedMessage()

    @state =
      editing: storedMessage != ''
      message: storedMessage
      posting: null


  componentDidUpdate: (prevProps) =>
    if prevProps.discussion.id != @props.discussion.id
      @setState message: @storedMessage()
      return

    @storeMessage()


  componentWillUnmount: =>
    @postXhr?.abort()


  render: =>
    if @state.editing
      @renderBox()
    else
      @renderPlaceholder()


  renderBox: =>
    div
      className: "#{bn} #{bn}--reply #{bn}--new-reply"

      @renderCancelButton()

      div
        className: "#{bn}__content"
        div className: "#{bn}__avatar",
          el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

        div className: "#{bn}__message-container",
          el TextareaAutosize,
            disabled: @state.posting?
            className: "#{bn}__message #{bn}__message--editor"
            value: @state.message
            onChange: @setMessage
            onKeyDown: @handleKeyDown
            placeholder: osu.trans 'beatmaps.discussions.reply_placeholder'
            ref: @box

      div
        className: "#{bn}__footer #{bn}__footer--notice"
        osu.trans 'beatmaps.discussions.reply_notice'
        el MessageLengthCounter, message: @state.message, isTimeline: @isTimeline()

      div
        className: "#{bn}__footer"
        div className: "#{bn}__actions",
          div className: "#{bn}__actions-group",
            if @canResolve() && !@props.discussion.resolved
              @renderReplyButton 'reply_resolve'

            if @canReopen() && @props.discussion.resolved
              @renderReplyButton 'reply_reopen'

            @renderReplyButton 'reply'


  renderCancelButton: =>
    button
      className: "#{bn}__action #{bn}__action--cancel"
      disabled: @state.posting?
      onClick: @onCancelClick
      i className: 'fas fa-times'


  renderPlaceholder: =>
    [text, icon, disabled] =
      if @props.currentUser.id?
        [osu.trans('beatmap_discussions.reply.open.user'), 'fas fa-reply', @props.currentUser.is_silenced]
      else
        [osu.trans('beatmap_discussions.reply.open.guest'), 'fas fa-sign-in-alt', false]

    div
      className: "#{bn} #{bn}--reply #{bn}--new-reply #{bn}--new-reply-placeholder"
      el BigButton,
        disabled: disabled
        icon: icon
        modifiers: 'beatmap-discussion-reply-open'
        props:
          onClick: @editStart
        text: text


  renderReplyButton: (action) =>
    div className: "#{bn}__action",
      el BigButton,
        disabled: !@validPost() || @state.posting?
        icon: ACTION_ICONS[action]
        isBusy: @state.posting == action
        text: osu.trans("common.buttons.#{action}")
        props:
          'data-action': action
          onClick: @post


  canReopen: =>
    @props.discussion.can_be_resolved && @props.discussion.current_user_attributes.can_reopen


  canResolve: =>
    @props.discussion.can_be_resolved && @props.discussion.current_user_attributes.can_resolve


  editStart: =>
    return if core.userLogin.showIfGuest(@editStart)

    @setState editing: true, =>
      @box.current?.focus()


  handleKeyDownCallback: (type, event) =>
    switch type
      when InputEventType.Cancel
        @setState editing: false
      when InputEventType.Submit
        @post(event)


  isTimeline: =>
    @props.discussion.timestamp?


  onCancelClick: =>
    return if @state.message != '' && !confirm(osu.trans('common.confirmation_unsaved'))

    @setState
      editing: false
      message: ''


  post: (event) =>
    return if !@validPost() || @postXhr?
    showLoadingOverlay()

    # in case the event came from input box, do 'reply'.
    action = event.currentTarget.dataset.action ? 'reply'
    @setState posting: action

    resolved = switch action
               when 'reply_resolve' then true
               when 'reply_reopen' then false
               else null

    @postXhr = $.ajax route('beatmapsets.discussions.posts.store'),
      method: 'POST'
      data:
        beatmap_discussion_id: @props.discussion.id
        beatmap_discussion:
          # Only add resolved flag to beatmap_discussion if there was an
          # explicit change (resolve/reopen).
          if resolved?
            resolved: resolved
          else
            {}
        beatmap_discussion_post:
          message: @state.message

    .done (data) =>
      @setState
        message: ''
        editing: false
      $.publish 'beatmapDiscussionPost:markRead', id: data.beatmap_discussion_post_ids
      $.publish 'beatmapsetDiscussions:update', beatmapset: data.beatmapset

    .fail osu.ajaxError

    .always =>
      hideLoadingOverlay()
      @postXhr = null
      @setState posting: null


  setMessage: (e) =>
    @setState message: e.target.value


  storageKey: =>
    "beatmapset-discussion:reply:#{@props.discussion.id}:message"


  storeMessage: =>
    if @state.message == ''
      localStorage.removeItem @storageKey()
    else
      localStorage.setItem @storageKey(), @state.message


  storedMessage: =>
    localStorage.getItem(@storageKey()) ? ''


  validPost: =>
    BeatmapDiscussionHelper.validMessageLength(@state.message, @isTimeline())
