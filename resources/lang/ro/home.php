<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Descarcă acum',
        'online' => '<strong>:players</strong> momentan online în <strong>:games</strong> jocuri',
        'peak' => 'Maxim, :count de utilizatori online',
        'players' => '<strong>:count</strong> de jucători înregistrați',
        'title' => 'bine ai venit',
        'see_more_news' => 'vezi mai multe noutăți',

        'slogan' => [
            'main' => 'cel mai cel joc de ritm free-to-win',
            'sub' => 'ritmul este doar la un clic distanță',
        ],
    ],

    'search' => [
        'advanced_link' => 'Căutare avansată',
        'button' => 'Căutare',
        'empty_result' => 'Nimic găsit!',
        'keyword_required' => 'Un cuvânt cheie este necesar',
        'placeholder' => 'tastează pentru a căuta',
        'title' => 'Caută',

        'beatmapset' => [
            'login_required' => 'Conectați-vă pentru a căuta beatmap-uri',
            'more' => ':count mai multe rezultate de căutare pentru acest beatmap',
            'more_simple' => 'Vezi mai multe rezultate de căutare pentru acest beatmap',
            'title' => 'Beatmap-uri',
        ],

        'forum_post' => [
            'all' => 'Toate forum-urile',
            'link' => 'Caută pe forum',
            'login_required' => 'Conectați-vă pentru a căuta forum-ul',
            'more_simple' => 'Vezi mai multe rezultate de căutare pe forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'căutare în forum-uri',
                'forum_children' => 'include subforum-uri',
                'topic_id' => 'subiect #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'tot',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'jucător',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Conectați-vă pentru a căuta utilizatori',
            'more' => ':count mai multe rezultate de căutare pentru acest jucător',
            'more_simple' => 'Vezi mai multe rezultate de căutare pentru acest jucător',
            'more_hidden' => 'Căutarea jucătorului este limitată la :max jucători. Încearcă să îți redefinești căutarea.',
            'title' => 'Jucători',
        ],

        'wiki_page' => [
            'link' => 'Caută în wiki',
            'more_simple' => 'Vezi mai multe rezultate de căutare pe wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "să<br>începem!",
        'action' => 'Descarcă osu!',

        'help' => [
            '_' => 'dacă ai o problemă la pornirea jocului sau la înregistrarea contului, :help_forum_link sau :support_button.',
            'help_forum_link' => 'verifică forum-ul de ajutor',
            'support_button' => 'contactează suportul tehnic',
        ],

        'os' => [
            'windows' => 'pentru Windows',
            'macos' => 'pentru macOS',
            'linux' => 'pentru Linux',
        ],
        'mirror' => 'sursă alternativă',
        'macos-fallback' => 'utilizatori macOS',
        'steps' => [
            'register' => [
                'title' => 'creează un cont',
                'description' => 'urmează instrucțiunile când deschizi jocul pentru a te conecta sau pentru a-ți crea un cont nou',
            ],
            'download' => [
                'title' => 'descarcă jocul',
                'description' => 'dă clic pe butonul de mai sus pentru a descărca installer-ul, apoi rulează-l!',
            ],
            'beatmaps' => [
                'title' => 'obține beatmap-uri',
                'description' => [
                    '_' => ':browse vasta colecție de beatmap-uri create de utilizatori și începe să joci!',
                    'browse' => 'navigați',
                ],
            ],
        ],
        'video-guide' => 'ghid video',
    ],

    'user' => [
        'title' => 'tablou de comenzi',
        'news' => [
            'title' => 'Noutăți',
            'error' => 'Eroare la încărcarea noutăților, încearcă să reîmprospătezi pagina?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Prieteni Online',
                'games' => 'Jocuri',
                'online' => 'Utilizatori online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Beatmap-uri Clasate Noi',
            'popular' => 'Beatmap-uri Populare',
            'by_user' => 'de :user',
        ],
        'buttons' => [
            'download' => 'Descarcă osu!',
            'support' => 'Sprijină osu!',
            'store' => 'Magazinul osu!',
        ],
    ],
];
