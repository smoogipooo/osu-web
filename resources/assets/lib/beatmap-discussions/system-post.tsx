// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import BeatmapsetDiscussionPostJson from 'interfaces/beatmapset-discussion-post-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { linkHtml } from 'utils/url';

interface Props {
  post: BeatmapsetDiscussionPostJson;
  user: UserJson;
}

export default function SystemPost({ post, user }: Props) {
  if (!post.system) return null;
  if (post.message.type !== 'resolved') return null;

  const className = classWithModifiers('beatmap-discussion-system-post', post.message.type, {
    deleted: post.deleted_at != null,
  });

  return (
    <div className={className}>
      <div className='beatmap-discussion-system-post__content'>
        <StringWithComponent
          mappings={{
            user: linkHtml(
              route('users.show', { user: user.id }),
              user.username,
              { classNames: ['beatmap-discussion-system-post__user'] },
            ),
          }}
          pattern={osu.trans(`beatmap_discussions.system.resolved.${post.message.value}`)}
        />
      </div>
    </div>
  );
}
