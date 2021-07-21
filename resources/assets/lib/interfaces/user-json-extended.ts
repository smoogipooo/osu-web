// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';

export default interface UserJsonExtended extends UserJson {
  country: Country;
  cover: Cover;
  discord: string | null;
  has_supported: boolean;
  interests: string | null;
  is_admin: boolean;
  is_bng: boolean;
  is_full_bn: boolean;
  is_gmt: boolean;
  is_limited_bn: boolean;
  is_moderator: boolean;
  is_nat: boolean;
  is_restricted: boolean;
  is_silenced: boolean;
  join_date: string;
  kudosu: {
    available: number;
    total: number;
  };
  location: string | null;
  occupation: string | null;
  playmode: GameMode | null;
  playstyle: string[];
  post_count: number;
  profile_order: string[];
  title: string | null;
  title_url: string | null;
  twitter: string | null;
  website: string | null;
}
