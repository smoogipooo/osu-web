<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'אוספים ארוזים מראש של beatmaps המבוססים סביב נושא משותף.',
        'nav_title' => 'רשימה',
        'title' => 'חבילות Beatmap',

        'blurb' => [
            'important' => 'קרא את זה לפני שאתה מוריד',
            'instruction' => [
                '_' => "התקנה: לאחר שהורדת חבילה, חלץ את קובץ ה- .rar לתוך תיקיית Songs של osu!.
כל השירים עדיין מכווצים כ- .zip ו/או .osz בתוך החבילה, לכן osu! יצטרך לחלץ את ה- beatmaps בעצמו בפעם הבאה שתיכנס למצב Play.
:scary תחלץ את קבצי ה- .zip/.osz בעצמך,
או שה- beatmaps יופיעו באופן שגוי בתוך osu! ולא יפעלו כראוי.",
                'scary' => 'אל',
            ],
            'note' => [
                '_' => 'שימו לב שמומלץ מאוד ל- :scary, מאחר והמפות הישנות ביותר הן באיכות הרבה יותר נמוכה מאשר המפות האחרונות.',
                'scary' => 'הורד את החבילות מהאחרונות למוקדמות',
            ],
        ],
    ],

    'show' => [
        'download' => 'הורד',
        'item' => [
            'cleared' => 'סוים בהצלחה',
            'not_cleared' => 'לא סוים בהצלחה',
        ],
        'no_diff_reduction' => [
            '_' => ':linkלא ניתן לשימוש ניקוי הפאק.',
            'link' => 'צמצום קושי המודים',
        ],
    ],

    'mode' => [
        'artist' => 'אמן\אלבום',
        'chart' => 'Spotlights',
        'standard' => 'רגיל',
        'theme' => 'ערכת נושא',
    ],

    'require_login' => [
        '_' => 'אתה צריך להיות :link כדי להוריד',
        'link_text' => 'מחובר',
    ],
];
