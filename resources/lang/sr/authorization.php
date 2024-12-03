<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Шта кажеш на то да играш мало osu! уместо тога?',
    'require_login' => 'Молимо Вас да се пријавите да би сте наставили.',
    'require_verification' => 'Молимо Вас да се верификујете да би сте наставили.',
    'restricted' => "Не можете да то урадите док сте рестриктовани.",
    'silenced' => "Не можете да то урадите док сте мутирани.",
    'unauthorized' => 'Приступ одбијен.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Не можете да откажете ваш хајп.',
            'has_reply' => 'Не можете да обришете дискусију која има одговоре',
        ],
        'nominate' => [
            'exhausted' => 'Достигли сте лимит ваших номинација за данас, молимо Вас да покушате сутра.',
            'incorrect_state' => 'Дошло је до грешке, покушајте да освежите страницу.',
            'owner' => "Не можете да номинујете вашу мапу.",
            'set_metadata' => 'Морате подесити жанр и језик пре номинације.',
        ],
        'resolve' => [
            'not_owner' => 'Само власник дискусије и власник мапе може означити дискусију као решеном.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Само власник мапе или номинатор/члан NAT-а групе може поставити поруку.',
        ],

        'vote' => [
            'bot' => "Не можете да гласате на дискусију направљену од стране робота",
            'limit_exceeded' => 'Молимо Вас сачекајте мало пре него што поново гласате',
            'owner' => "Не можете да гласате на вашој дискусији.",
            'wrong_beatmapset_state' => 'Можете само гласати на дискусијама мапа које чекају одобрење.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Можете обрисати само ваше постове.',
            'resolved' => 'Не можете обрисати пост са решене дискусије.',
            'system_generated' => 'Аутоматски генерисани постови не могу бити обрисани.',
        ],

        'edit' => [
            'not_owner' => 'Само објављивач може изменити објаву.',
            'resolved' => 'Не можете обрисати пост са решене дискусије.',
            'system_generated' => 'Аутоматски генерисани постови не могу бити обрисани.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Ова мапа је закључана за дискусију.',

        'metadata' => [
            'nominated' => 'Не можете да промените метаподатке номиноване мапе. Контактирајте члана BN-а или NAT-а групе ако мислите да су подаци нетачни.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => '',
        ],
    ],

    'chat' => [
        'blocked' => 'Не можете да пошаљете поруку кориснику који вас је блокирао или кога сте ви блокирали.',
        'friends_only' => 'Корисник блокира поруке од људи који нису на њиховој листи пријатеља.',
        'moderated' => 'Овај канал је тренутно под модерацијом.',
        'no_access' => 'Немате приступ овом каналу.',
        'no_announce' => '',
        'receive_friends_only' => 'Овај корисник можда неће моћи да одговори зато што прихватате поруке искључиво од људи са ваше листе пријатеља. ',
        'restricted' => 'Не можете да шаљете поруке док сте мутирани, рестриктовани или бановани.',
        'silenced' => 'Не можете да шаљете поруке док сте мутирани, рестриктовани или бановани.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Коментари су онемогућени',
        ],
        'update' => [
            'deleted' => "Не можете да измените обрисан пост.",
        ],
    ],

    'contest' => [
        'judging_not_active' => '',
        'voting_over' => 'Не можете да промените глас након што је прошао период гласања за ово такмичење.',

        'entry' => [
            'limit_reached' => 'Достигли сте ограничење за пријаву за ово такмичење',
            'over' => 'Хвала вам на учешћу! Пријаве су затворене за ово такмичење и гласање ће ускоро почети.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Немате дозволу за модерирање овог форума.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Само последњи пост може бити обрисан.',
                'locked' => 'Не можете да обришете пост у закључаној теми.',
                'no_forum_access' => 'Немате приступ овом форуму.',
                'not_owner' => 'Само објављивач може обрисати пост.',
            ],

            'edit' => [
                'deleted' => 'Не можете да измените обрисан пост.',
                'locked' => 'Овај пост је закључан и не може бити промењен.',
                'no_forum_access' => 'Немате приступ овом форуму.',
                'not_owner' => 'Само објављивач може изменити објаву.',
                'topic_locked' => 'Не можете да обришете пост у закључаној теми.',
            ],

            'store' => [
                'play_more' => 'Молимо Вас покуштајте да играте игру пре него што почнете да објављујете на форуму! Ако имате проблем са игром, молимо Вас постујте на форум за Помоћ и Подршку.',
                'too_many_help_posts' => "Морате да играте игру пре него што имате право да правите додатне постове. Ако и даље имате проблема са игром, напишите мејл на support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Молимо Вас да измените Ваш претходни пост уместо да постујете поново.',
                'locked' => 'Не можете да одговорите на закључану дискусију.',
                'no_forum_access' => 'Немате приступ овом форуму.',
                'no_permission' => 'Немате дозволу да одговорите.',

                'user' => [
                    'require_login' => 'Молимо Вас да се пријавите да би сте одговорили.',
                    'restricted' => "Не можете одговорити док сте рестриктовани.",
                    'silenced' => "Не можете одговорити док сте мутирани.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Немате приступ овом форуму.',
                'no_permission' => 'Немате дозволу да започнете нову тему.',
                'forum_closed' => 'Овај форум је затворен и не може се коментарисати на њега.',
            ],

            'vote' => [
                'no_forum_access' => 'Немате приступ овом форуму.',
                'over' => 'Гласање је завршено и не може се више гласати.',
                'play_more' => 'Морате да играте још пре него што можете да гласате на форуму.',
                'voted' => 'Промена гласа није дозвољена.',

                'user' => [
                    'require_login' => 'Молимо Вас да се пријавите како би сте гласали.',
                    'restricted' => "Не можете да гласате док сте рестриктовани.",
                    'silenced' => "Не можете да гласате док сте мутирани.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Немате приступ овом форуму.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Ваше заглавље није валидно.',
                'not_owner' => 'Само власник може променити заглавље.',
            ],
            'store' => [
                'forum_not_allowed' => 'Овај форум не прихвата заглавља за теме.',
            ],
        ],

        'view' => [
            'admin_only' => 'Само администратор може видети овај форум.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => '',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Не можете да закачите ову врсту резултата",
            'failed' => "",
            'not_owner' => 'Само власник овог резултата може пиновати резултат.',
            'too_many' => 'Пиновали сте превише резултата.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Корисникова страница је закључана.',
                'not_owner' => 'Можете променити само вашу корисничку страницу.',
                'require_supporter_tag' => 'морате да имате osu!supporter статус.',
            ],
        ],
        'update_email' => [
            'locked' => 'адреса е-поште је закључана',
        ],
    ],
];
