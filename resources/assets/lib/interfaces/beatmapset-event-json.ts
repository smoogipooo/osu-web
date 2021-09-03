// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from './beatmapset-json';
import GameMode from './game-mode';

export function isBeatmapsetNominationEvent(x: BeatmapsetEventJson): x is BeatmapsetNominationEvent {
  return x.type === 'nominate' && Array.isArray(x.comment?.modes);
}

export interface BeatmapsetNominationEvent extends BeatmapsetEventJson {
  comment: {
    modes: GameMode[];
  };
  type: 'nominate';
}

export default interface BeatmapsetEventJson {
  beatmapset?: BeatmapsetJson;
  comment: any; // TODO: make always an object instead of object or string.
  created_at: string;
  discussion?: BeatmapsetDiscussionJson;
  id: number;
  type: string;
  user_id?: number;
}
