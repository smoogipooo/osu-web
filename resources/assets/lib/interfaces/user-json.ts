// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfileBannerJson from './profile-banner';
import UserAccountHistoryJson from './user-account-history-json';
import UserBadgeJson from './user-badge-json';
import UserGroupJson from './user-group-json';
import UserStatisticsJson from './user-statistics-json';

export default interface UserJson {
  account_history?: UserAccountHistoryJson[];
  active_tournament_banner?: ProfileBannerJson | null;
  avatar_url: string;
  badges?: UserBadgeJson[];
  comments_count?: number;
  country?: Country;
  country_code: string; // TODO: country object?
  cover?: Cover;
  default_group: string;
  follower_count?: number;
  groups?: UserGroupJson[];
  id: number;
  is_active: boolean;
  is_bot: boolean;
  is_deleted: boolean;
  is_online: boolean;
  is_supporter: boolean;
  last_visit: string | null;
  loved_beatmapset_count?: number;
  mapping_follower_count?: number;
  page?: {
    html: string;
    raw: string;
  };
  pending_beatmapset_count?: number;
  pm_friends_only: boolean;
  previous_usernames?: string[];
  profile_colour: string | null;
  ranked_beatmapset_count?: number;
  replays_watched_counts?: number;
  scores_best_count?: number;
  scores_first_count?: number;
  scores_recent_count?: number;
  statistics?: UserStatisticsJson;
  support_level?: number;
  username: string;
}
