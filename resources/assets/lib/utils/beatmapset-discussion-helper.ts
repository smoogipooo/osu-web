// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import guestGroup from 'beatmap-discussions/guest-group';
import mapperGroup from 'beatmap-discussions/mapper-group';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import UserJson from 'interfaces/user-json';
import { currentUrl } from 'utils/turbolinks';
import { linkHtml, urlRegex } from 'utils/url';

interface BadgeGroupParams {
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJson;
  discussion: BeatmapsetDiscussionJson;
  user?: UserJson;
}

interface PropsFromHrefValue {
  [key: string]: string | undefined;
  children: string;
  className?: string;
  rel: 'nofollow noreferrer';
  target?: '_blank';
}

export function badgeGroup({ beatmapset, currentBeatmap, discussion, user }: BadgeGroupParams) {
  if (user == null) {
    return null;
  }

  if (user.id === beatmapset.user_id) {
    return mapperGroup;
  }

  if (currentBeatmap != null && discussion.beatmap_id === currentBeatmap.id && user.id === currentBeatmap.user_id) {
    return guestGroup;
  }

  return user.groups?.[0];
}

export function discussionLinkify(text: string) {
  // text should be pre-escaped.
  return text.replace(urlRegex, (match, url: string) => {
    const { children, ...props } = propsFromHref(url);
    // React types it as ReactNode but it can be a string.
    const displayUrl = typeof children === 'string' ? children : url;
    return linkHtml(url, displayUrl, { props, unescape: true });
  });
}

export function propsFromHref(href: string) {
  const current = BeatmapDiscussionHelper.urlParse(currentUrl().href);

  const props: PropsFromHrefValue = {
    children: href,
    rel: 'nofollow noreferrer',
    target: '_blank',
  };

  let targetUrl: URL | undefined;

  try {
    // TODO: The regexp used sometimes catches invalid URL like "https://example.com]".
    // Either accept that as fact of life or a better regexp is needed which is
    // probably rather difficult especially if we're going to support parsing IDN.
    targetUrl = new URL(href);
  } catch (e: unknown) {
    // ignore error
  }

  if (targetUrl != null && targetUrl.host === currentUrl().host) {
    const target = BeatmapDiscussionHelper.urlParse(targetUrl.href, null, { forceDiscussionId: true });
    if (target?.discussionId != null && target.beatmapsetId != null) {
      const hash = [target.discussionId, target.postId].filter(Number.isFinite).join('/');
      if (current?.beatmapsetId === target.beatmapsetId) {
        // same beatmapset, format: #123
        props.children = `#${hash}`;
        props.className = 'js-beatmap-discussion--jump';
        props.target = undefined;
      } else {
        // different beatmapset, format: 1234#567
        props.children = `${target.beatmapsetId}#${hash}`;
      }
    }
  }

  return props;
}
