<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Düzenlemek için giriş yapılmış olmalı.',
            'system_generated' => 'Sistem tarafından oluşturulmuş gönderiler düzenlenemez.',
            'wrong_user' => 'Düzenlemek için gönderinin sahibi olmalısınız.',
        ],
    ],

    'events' => [
        'empty' => 'Hiçbir şey olmadı... henüz.',
    ],

    'index' => [
        'deleted_beatmap' => 'silindi',
        'none_found' => 'Kriterlere uyan bir tartışma sonucu bulunamadı.',
        'title' => 'Beatmap Tartışmaları',

        'form' => [
            '_' => 'Ara',
            'deleted' => 'Silinmiş tartışmaları içer',
            'only_unresolved' => 'Sadece çözülmemiş tartışmaları göster',
            'types' => 'Mesaj türü',
            'username' => 'Kullanıcı adı',

            'beatmapset_status' => [
                '_' => 'Beatmap durumu',
                'all' => 'Tümü',
                'disqualified' => 'Diskalifiye edildi',
                'never_qualified' => 'Nitelikli Değildi',
                'qualified' => 'Nitelikli',
                'ranked' => 'Dereceli',
            ],

            'user' => [
                'label' => 'Kullanıcı',
                'overview' => 'Etkinliğe genel bakış',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Gönderim tarihi',
        'deleted_at' => 'Silinme tarihi',
        'message_type' => 'Tür',
        'permalink' => 'Kalıcı bağlantı',
    ],

    'nearby_posts' => [
        'confirm' => 'Bu gönderilerin hiçbiri sorunumla ilgili değil',
        'notice' => ':timestamp (:existing_timestamp) civarında gönderilmiş mesajlar var. Göndermeden önce lütfen onlara bir göz atın.',
        'unsaved' => 'bu incelemede :count',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Yanıtlamak için Giriş yapın',
            'user' => 'Yanıtla',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blok kullanıldı',
        'go_to_parent' => 'İnceleme paylaşımını görüntüle',
        'go_to_child' => 'Tartışmayı görüntüle',
        'validation' => [
            'block_too_large' => 'her blok en fazla :limit karakter içerebilir',
            'external_references' => 'inceleme, bu incelemeye ait olmayan sorunlara referanslar içeriyor',
            'invalid_block_type' => 'geçersiz blok türü',
            'invalid_document' => 'geçersiz gözden geçirme',
            'minimum_issues' => 'gözden geçirme asgari :count sayıda sorun içermelidir|gözden geçirme asgari :count sayıda sorun içermelidir',
            'missing_text' => 'blokta yazı eksik',
            'too_many_blocks' => 'gözden geçirmeler sadece :count paragraf/sorun içerebilir|gözden geçirmeler sadece azami :count paragraf/sorun içerebilir',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user tarafından çözüldü olarak işaretlendi',
            'false' => ':user tarafından yeniden açıldı',
        ],
    ],

    'timestamp_display' => [
        'general' => 'genel',
        'general_all' => 'genel (hepsi)',
    ],

    'user_filter' => [
        'everyone' => 'Herkes',
        'label' => 'Kullanıcıya göre filtrele',
    ],
];
