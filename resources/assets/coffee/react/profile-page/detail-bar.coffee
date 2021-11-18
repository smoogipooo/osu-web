# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import FollowUserMappingButton from 'follow-user-mapping-button'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import DetailBarButtons from 'profile-page/detail-bar-buttons'
import Rank from 'profile-page/rank'
import * as React from 'react'
import { a, button, div, dd, dl, dt, h1, i, img, li, span, ul } from 'react-dom-factories'
import { nextVal } from 'utils/seq'

el = React.createElement
bn = 'profile-detail-bar'

export class DetailBar extends React.Component
  render: =>
    el Observer, null, =>
      expanded = core.userPreferences.get('ranking_expanded')

      div className: bn,
        div className: "#{bn}__page-toggle",
          button
            className: 'btn-circle btn-circle--page-toggle'
            onClick: @toggleExtend
            title: osu.trans("common.buttons.#{if expanded then 'collapse' else 'expand'}")
            if expanded
              span className: 'fas fa-chevron-up'
            else
              span className: 'fas fa-chevron-down'

        div className: "#{bn}__column",
          el DetailBarButtons, user: @props.user

        div className: "#{bn}__column #{bn}__column--right",
          if expanded
            div
              title: osu.trans('users.show.stats.level_progress')
              className: "#{bn}__entry #{bn}__entry--level-progress hidden-xs"
              div className: 'bar bar--user-profile',
                div
                  className: 'bar__fill'
                  style:
                    width: "#{@props.stats.level.progress}%"
                div className: "bar__text",
                  "#{@props.stats.level.progress}%"

          if !expanded
            el React.Fragment, null,
              div className: "#{bn}__entry hidden-xs",
                el Rank, type: 'global', stats: @props.stats

              div className: "#{bn}__entry hidden-xs",
                el Rank, type: 'country', stats: @props.stats

          div className: "#{bn}__entry #{bn}__entry--level",
            div
              className: "#{bn}__level"
              title: osu.trans('users.show.stats.level', level: @props.stats.level.current)
              @props.stats.level.current


  toggleExtend: =>
    core.userPreferences.set('ranking_expanded', !core.userPreferences.get('ranking_expanded'))
