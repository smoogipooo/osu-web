// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from './game-mode';

export default interface GroupJson {
  colour: string;
  id: number;
  identifier: string;
  is_probationary: boolean;
  name: string;
  playmodes?: GameMode[];
  short_name: string;
}
