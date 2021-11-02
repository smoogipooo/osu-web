// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { DiscussionType, discussionTypeIcons } from 'beatmap-discussions/discussion-type';
import { BeatmapReviewDiscussionType } from 'interfaces/beatmap-discussion-review';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';
import { Element, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import IconDropdownMenu, { MenuItem } from './icon-dropdown-menu';
import { SlateContext } from './slate-context';

const selectableTypes: DiscussionType[] = ['praise', 'problem', 'suggestion'];

interface Props {
  beatmaps: BeatmapExtendedJson[];
  disabled: boolean;
  element: Element;
}

export default class EditorIssueTypeSelector extends React.Component<Props> {
  static contextType = SlateContext;
  declare context: React.ContextType<typeof SlateContext>;

  render(): React.ReactNode {
    const menuOptions: MenuItem[] = selectableTypes.map((type) => ({
      icon: <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`}><i className={discussionTypeIcons[type]} /></span>,
      id: type,
      label: osu.trans(`beatmaps.discussions.message_type.${type}`),
    }));

    return (
      <IconDropdownMenu
        disabled={this.props.disabled}
        menuOptions={menuOptions}
        onSelect={this.select}
        selected={this.props.element.discussionType as BeatmapReviewDiscussionType}
      />
    );
  }

  select = (discussionType: string) => {
    const path = ReactEditor.findPath(this.context, this.props.element);
    Transforms.setNodes(this.context, {discussionType}, {at: path});
  };
}
