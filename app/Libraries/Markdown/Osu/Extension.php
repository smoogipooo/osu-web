<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu;

use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Extension\Table\Table;

class Extension implements ExtensionInterface
{
    /**
     * @var DocumentProcessor|null
     */
    public $processor;

    public function register(ConfigurableEnvironmentInterface $environment): void
    {
        $this->processor = new DocumentProcessor($environment);

        $environment
            ->addBlockRenderer(ListItem::class, new Renderers\ListItemRenderer(), 10)
            ->addBlockRenderer(Table::class, new Renderers\TableRenderer(), 10)
            ->addEventListener(DocumentParsedEvent::class, $this->processor);
    }
}
