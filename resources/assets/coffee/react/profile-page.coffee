# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { parseJson } from 'utils/json'
import { Main } from './profile-page/main'

core.reactTurbolinks.register 'profile-page', (container) ->
  user = parseJson('json-user')

  createElement Main,
    user: user
    userPage: user.page
    userAchievements: user.user_achievements
    currentMode: parseJson('json-currentMode')
    withEdit: user.id == window.currentUser.id
    achievements: _.keyBy parseJson('json-achievements'), 'id'
    perPage: parseJson('json-perPage')
    extras: parseJson('json-extras')
    container: container
