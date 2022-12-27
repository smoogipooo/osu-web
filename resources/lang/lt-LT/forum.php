<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Prisegtos Temos',
    'slogan' => "",
    'subforums' => 'Subforumai',
    'title' => 'Forumas',

    'covers' => [
        'edit' => 'Redaguoti viršelį',

        'create' => [
            '_' => 'Išrinkti viršelio paveikslėlį',
            'button' => 'Įkelti paveiksliuką',
            'info' => 'Viršelio dydis turėtu būti :dimensions. Jūs taip pat galite čia įmesti paveikslėlį įkėlimui.',
        ],

        'destroy' => [
            '_' => 'Ištrink viršelio paveikslėlį',
            'confirm' => 'Ar tikrai norite pašalinti viršelį?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Paskutinieji pranešimai',

        'index' => [
            'title' => 'Forumo pradžia',
        ],

        'topics' => [
            'empty' => 'Nėra temų!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Pažymėti foruma kaip skaitytą',
        'forums' => 'Pažymėti forumus kaip skaitytus',
        'busy' => 'Pažymima kaip skaityta...',
    ],

    'post' => [
        'confirm_destroy' => 'Tikrai ištrinti posta?',
        'confirm_restore' => 'Tikrai gražinti posta?',
        'edited' => 'Paskutini kartą redaguota :user :when, redaguota :count_delimited kartų. |Paskutini kartą redaguota :user :when, redaguota :count_delimited kartų.',
        'posted_at' => 'paskelbta :when',
        'posted_by' => 'paskelbta :username',

        'actions' => [
            'destroy' => 'Ištrinti pranešimą',
            'edit' => 'Redaguoti postą',
            'report' => 'Pranešti apie postą',
            'restore' => 'Gražinti Publikaciją',
        ],

        'create' => [
            'title' => [
                'reply' => 'Naujas atsakymas',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited publikacija|:count_delimited publikacijos(-ų)',
            'topic_starter' => 'Temos Pradininkas',
        ],
    ],

    'search' => [
        'go_to_post' => 'Eiti į postą',
        'post_number_input' => 'įveskite publikacijos numerį',
        'total_posts' => ':posts_count iš viso publikacijų',
    ],

    'topic' => [
        'confirm_destroy' => 'Tikrai ištrinti temą?',
        'confirm_restore' => 'Tikrai gražinti temą?',
        'deleted' => 'ištrintos temos',
        'go_to_latest' => 'peržiūrėti vėliausius postus',
        'has_replied' => 'Jūs atsakyte į šią temą',
        'in_forum' => 'tarp :forum',
        'latest_post' => ':when iš :user',
        'latest_reply_by' => 'vėliausia atsakyma pateikė :user',
        'new_topic' => 'Nauja tema',
        'new_topic_login' => 'Naujos temos publikavimui reikia prisijungti',
        'post_reply' => 'Publikuoti',
        'reply_box_placeholder' => 'Rašykite čia norėdami atsakyti',
        'reply_title_prefix' => 'Re',
        'started_by' => 'iš :user',
        'started_by_verbose' => 'pradėjo :user',

        'actions' => [
            'destroy' => 'Ištrinti temą',
            'restore' => 'Atstatyti temą',
        ],

        'create' => [
            'close' => 'Uždaryti',
            'preview' => 'Peržiūra',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Rašyti',
            'submit' => 'Siųsti',

            'necropost' => [
                'default' => '',

                'new_topic' => [
                    '_' => "",
                    'create' => '',
                ],
            ],

            'placeholder' => [
                'body' => '',
                'title' => '',
            ],
        ],

        'jump' => [
            'enter' => '',
            'first' => '',
            'last' => '',
            'next' => '',
            'previous' => '',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Atšaukti',
            'post' => 'Išsaugoti',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'forumo temų stebėjimo sąrašas',

            'box' => [
                'total' => '',
                'unread' => '',
            ],

            'info' => [
                'total' => '',
                'unread' => '',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '',
                'title' => '',
            ],
        ],
    ],

    'topics' => [
        '_' => '',

        'actions' => [
            'login_reply' => '',
            'reply' => 'Atsakyti',
            'reply_with_quote' => '',
            'search' => '',
        ],

        'create' => [
            'create_poll' => 'Apklausos kūrimas',

            'preview' => '',

            'create_poll_button' => [
                'add' => 'Sukurti apklausą',
                'remove' => 'Atšaukti apklausos kūrimą',
            ],

            'poll' => [
                'hide_results' => '',
                'hide_results_info' => '',
                'length' => '',
                'length_days_suffix' => '',
                'length_info' => '',
                'max_options' => '',
                'max_options_info' => '',
                'options' => 'Parinktys',
                'options_info' => '',
                'title' => 'Klausimas',
                'vote_change' => '',
                'vote_change_info' => '',
            ],
        ],

        'edit_title' => [
            'start' => '',
        ],

        'index' => [
            'feature_votes' => '',
            'replies' => '',
            'views' => 'peržiūros',
        ],

        'issue_tag_added' => [
            'to_0' => 'Pašalinti „pridėjimo“ žymę',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_assigned' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_invalid' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_resolved' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'lock' => [
            'is_locked' => '',
            'to_0' => '',
            'to_0_confirm' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_confirm' => '',
            'to_1_done' => '',
        ],

        'moderate_move' => [
            'title' => '',
        ],

        'moderate_pin' => [
            'to_0' => '',
            'to_0_confirm' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_confirm' => '',
            'to_1_done' => '',
            'to_2' => '',
            'to_2_confirm' => '',
            'to_2_done' => '',
        ],

        'moderate_toggle_deleted' => [
            'show' => '',
            'hide' => '',
        ],

        'show' => [
            'deleted-posts' => '',
            'total_posts' => '',

            'feature_vote' => [
                'current' => '',
                'do' => '',

                'info' => [
                    '_' => '',
                    'feature_request' => '',
                    'supporters' => '',
                ],

                'user' => [
                    'count' => '',
                    'current' => '',
                    'not_enough' => "",
                ],
            ],

            'poll' => [
                'edit' => '',
                'edit_warning' => '',
                'vote' => 'Balsuoti',

                'button' => [
                    'change_vote' => '',
                    'edit' => '',
                    'view_results' => '',
                    'vote' => '',
                ],

                'detail' => [
                    'end_time' => '',
                    'ended' => '',
                    'results_hidden' => '',
                    'total' => '',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '',
            'to_watching' => '',
            'to_watching_mail' => '',
            'tooltip_mail_disable' => '',
            'tooltip_mail_enable' => '',
        ],
    ],
];
