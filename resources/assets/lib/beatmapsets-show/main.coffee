# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import NsfwWarning from 'beatmapsets-show/nsfw-warning'
import Scoreboard from 'beatmapsets-show/scoreboard'
import { Comments } from 'components/comments'
import { CommentsManager } from 'components/comments-manager'
import HeaderV4 from 'components/header-v4'
import PlaymodeTabs from 'components/playmode-tabs'
import { gameModes } from 'interfaces/game-mode'
import { route } from 'laroute'
import core from 'osu-core-singleton'
import * as React from 'react'
import { div } from 'react-dom-factories'
import * as BeatmapHelper from 'utils/beatmap-helper'
import { generate, parse, setHash } from 'utils/beatmapset-page-hash'
import { nextVal } from 'utils/seq'
import { currentUrl } from 'utils/turbolinks'
import { Header } from './header'
import headerLinks from './header-links'
import Hype from './hype'
import { Info } from './info'

el = React.createElement

export class Main extends React.Component
  constructor: (props) ->
    super props

    @eventId = "beatmapsets-show-#{nextVal()}"
    @scoreboardXhr = null
    @favouriteXhr = null

    @state = JSON.parse(@props.container.dataset.state ? 'null')
    @restoredState = @state?

    if @restoredState
      @state.beatmaps = new Map(@state.beatmapsArray)
    else
      optionsHash = parse currentUrl().hash

      beatmaps = _.concat props.beatmapset.beatmaps, props.beatmapset.converts
      beatmaps = BeatmapHelper.group beatmaps

      currentBeatmap = BeatmapHelper.find
        group: beatmaps
        id: optionsHash.beatmapId
        mode: optionsHash.playmode

      # fall back to the first mode that has beatmaps in this mapset
      currentBeatmap ?= BeatmapHelper.findDefault items: beatmaps.get(optionsHash.playmode)
      currentBeatmap ?= BeatmapHelper.findDefault group: beatmaps

      @state =
        beatmapset: props.beatmapset
        beatmaps: beatmaps
        currentBeatmap: currentBeatmap
        favcount: props.beatmapset.favourite_count
        hasFavourited: props.beatmapset.has_favourited
        loadingState: null
        showingNsfwWarning: props.beatmapset.nsfw && !core.userPreferences.get('beatmapset_show_nsfw')
        currentScoreboardType: 'global'
        enabledMods: []
        scores: []
        userScore: null
        userScorePosition: -1


  setBeatmapset: (_e, {beatmapset}) =>
    return unless beatmapset?

    @setState beatmapset: beatmapset


  setCurrentScoreboard: (_e, {
    scoreboardType = @state.currentScoreboardType,
    enabledMod = null,
    forceReload = false,
    resetMods = false
  }) =>
    @scoreboardXhr?.abort()

    enabledMods = if resetMods
      []
    else if enabledMod != null && _.includes @state.enabledMods, enabledMod
      _.without @state.enabledMods, enabledMod
    else if enabledMod != null
      _.concat @state.enabledMods, enabledMod
    else
      @state.enabledMods

    @setState
      currentScoreboardType: scoreboardType
      enabledMods: enabledMods

    if !@state.currentBeatmap.is_scoreable
      @setState loadingState: 'unranked'
      return

    if (!currentUser.is_supporter && (scoreboardType != 'global' || enabledMods.length > 0))
      @setState loadingState: 'supporter_only'
      return

    @scoresCache ?= {}
    cacheKey = "#{@state.currentBeatmap.id}-#{@state.currentBeatmap.mode}-#{_.sortBy enabledMods}-#{scoreboardType}"

    loadScore = =>
      @setState
        loadingState: null
        scores: @scoresCache[cacheKey].scores
        userScore: @scoresCache[cacheKey].userScore if @scoresCache[cacheKey].userScore?
        userScorePosition: @scoresCache[cacheKey].userScorePosition

    if !forceReload && @scoresCache[cacheKey]?
      loadScore()
      return

    @setState loadingState: 'loading'

    @scoreboardXhr = $.ajax (route 'beatmaps.scores', beatmap: @state.currentBeatmap.id),
      method: 'GET'
      dataType: 'JSON'
      data:
        type: scoreboardType
        mods: enabledMods
        mode: @state.currentBeatmap.mode

    .done (data) =>
      @scoresCache[cacheKey] = data
      loadScore()

    .fail (xhr, status) =>
      @setState loadingState: 'error'

      if status == 'abort'
        return


  setCurrentBeatmap: (_e, {beatmap}) =>
    return unless beatmap?
    return if @state.currentBeatmap.id == beatmap.id && @state.currentBeatmap.mode == beatmap.mode

    @setState
      currentBeatmap: beatmap
      =>
        @setHash()
        @setCurrentScoreboard null, scoreboardType: 'global', resetMods: true


  setCurrentPlaymode: (e, mode) =>
    e.preventDefault()

    return if @state.currentBeatmap.mode == mode

    beatmap = BeatmapHelper.find id: @state.currentBeatmap.id, mode: mode, group: @state.beatmaps
    beatmap ?= BeatmapHelper.findDefault items: @state.beatmaps.get(mode)
    @setCurrentBeatmap null, { beatmap }


  setHoveredBeatmap: (_e, hoveredBeatmap) =>
    @setState hoveredBeatmap: hoveredBeatmap


  toggleFavourite: =>
    @favouriteXhr = $.ajax
      url: route('beatmapsets.favourites.store', beatmapset: @state.beatmapset.id)
      method: 'post'
      dataType: 'json'
      data:
        action: if @state.hasFavourited then 'unfavourite' else 'favourite'

    .done (data) =>
      @setState
        favcount: data.favourite_count
        hasFavourited: !@state.hasFavourited

    .fail (xhr, status) =>
      if status == 'abort'
        return

      osu.ajaxError xhr

  componentDidMount: ->
    $.subscribe "beatmapset:set.#{@eventId}", @setBeatmapset
    $.subscribe "beatmapset:beatmap:set.#{@eventId}", @setCurrentBeatmap
    $.subscribe "beatmapset:scoreboard:set.#{@eventId}", @setCurrentScoreboard
    $.subscribe "beatmapset:scoreboard:retry.#{@eventId}", @onRetryScoreboard
    $.subscribe "beatmapset:hoveredbeatmap:set.#{@eventId}", @setHoveredBeatmap
    $.subscribe "beatmapset:favourite:toggle.#{@eventId}", @toggleFavourite
    $(document).on "turbolinks:before-cache.#{@eventId}", @saveStateToContainer

    @setHash()

    if !@restoredState
      @setCurrentScoreboard null, scoreboardType: 'global', resetMods: true


  componentWillUnmount: ->
    $.unsubscribe ".#{@eventId}"
    $(document).off ".#{@eventId}"
    @scoreboardXhr?.abort()
    @favouriteXhr?.abort()


  render: ->
    div className: 'osu-layout osu-layout--full',
      @renderPageHeader()
      if @state.showingNsfwWarning
        el NsfwWarning, onClose: => @setState showingNsfwWarning: false
      else
        @renderPage()


  onRetryScoreboard: =>
    @setCurrentScoreboard null, enabledMod: @state.enabledMods


  renderPage: ->
    el React.Fragment, null,
      div className: 'osu-page osu-page--generic-compact',
        el Header,
          beatmapset: @state.beatmapset
          beatmaps: @state.beatmaps
          currentBeatmap: @state.currentBeatmap
          hoveredBeatmap: @state.hoveredBeatmap
          favcount: @state.favcount
          hasFavourited: @state.hasFavourited

        el Info,
          beatmapset: @state.beatmapset
          beatmap: @state.currentBeatmap

      if @state.beatmapset.can_be_hyped
        div className: 'osu-page osu-page--generic-compact',
          el Hype,
            beatmapset: @state.beatmapset
            currentUser: currentUser

      if @state.currentBeatmap.is_scoreable
        div className: 'osu-page osu-page--generic',
          el Scoreboard,
            type: @state.currentScoreboardType
            beatmap: @state.currentBeatmap
            scores: @state.scores
            userScore: @state.userScore?.score
            userScorePosition: @state.userScore?.position
            enabledMods: @state.enabledMods
            loadingState: @state.loadingState
            isScoreable: @state.currentBeatmap.is_scoreable

      div className: 'osu-page osu-page--generic-compact',
        el CommentsManager,
          component: Comments
          commentableType: 'beatmapset'
          commentableId: @state.beatmapset.id


  renderPageHeader: ->
    unless @state.showingNsfwWarning
      linksAppend = el PlaymodeTabs,
        currentMode: @state.currentBeatmap.mode
        entries: gameModes.map (mode) =>
          beatmaps = @state.beatmaps.get(mode)
          mainCount = beatmaps.filter((b) => !b.convert).length

          count: if mainCount > 0 then mainCount else undefined
          disabled: beatmaps.length == 0
          href: generate(mode: mode)
          mode: mode
        modifiers: 'beatmapset'
        onClick: @setCurrentPlaymode

    el HeaderV4,
      links: headerLinks 'show', @state.beatmapset
      linksAppend: linksAppend
      theme: 'beatmapset'

  saveStateToContainer: =>
    @state.beatmapsArray = Array.from(@state.beatmaps)
    @props.container.dataset.state = JSON.stringify(@state)


  setHash: =>
    setHash generate
      beatmap: @state.currentBeatmap
