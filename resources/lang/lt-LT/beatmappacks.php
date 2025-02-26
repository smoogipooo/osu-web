<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Beatmapų kolekcijos pagal temas.',
        'nav_title' => '',
        'title' => 'Beatmapų kolekcijos',

        'blurb' => [
            'important' => 'PERSKAITYK PRIEŠ ATSISIŲSDAMAS',
            'instruction' => [
                '_' => "Įkėlimas: Kai parsisiųsi, išskleisk parsiųstą .rar failą į savo osu! \"Songs\" aplankalą.
                    Visos dainos bus .zip ir/arba .osz archyvuose, ir osu! turės jas išskleisti prieš einant į žaidimo dainų meniu.
                    :scary pats neišskleidinėk iš .zip/.osz archyvų,
                    kitaip beatmapai bus atvaizduojami neteisingai ir veiks blogai.",
                'scary' => 'JOKIU Būdu',
            ],
            'note' => [
                '_' => 'Taip pat yra rekomenduojama :scary, nes senesni mapai yra daug blogesnės kokybės lyginant su naujesniais.',
                'scary' => 'siųstis nuo naujausiu iki seniausių',
            ],
        ],
    ],

    'show' => [
        'download' => 'Parsisiuntimai',
        'item' => [
            'cleared' => 'išvalyta',
            'not_cleared' => 'neišvalyta',
        ],
        'no_diff_reduction' => [
            '_' => '',
            'link' => '',
        ],
    ],

    'mode' => [
        'artist' => 'Atlikėjas/Albumas',
        'chart' => 'Verti dėmesio',
        'standard' => 'Įprasti',
        'theme' => 'Pagal temas',
    ],

    'require_login' => [
        '_' => 'Parsisiuntimui jums reikia :link',
        'link_text' => 'prisijungti',
    ],
];
