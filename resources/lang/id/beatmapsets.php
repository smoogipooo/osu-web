<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Beatmap saat ini tidak tersedia untuk diunduh.',
        'parts-removed' => 'Beberapa bagian dari beatmap ini telah dihapus atas permintaan pembuat lagu atau pihak ketiga pemegang hak cipta.',
        'more-info' => 'Lihat di sini untuk informasi lebih lanjut.',
        'rule_violation' => 'Sebagian aset yang terkandung dalam berkas beatmap ini telah dihapus karena dinilai tidak sesuai dengan kaidah penggunaan konten yang berlaku di osu!.',
    ],

    'cover' => [
        'deleted' => 'Beatmap yang telah dihapus',
    ],

    'download' => [
        'limit_exceeded' => 'Jangan terlalu bernafsu dalam mengunduh. Mainkan beatmap yang telah Anda miliki terlebih dahulu.',
    ],

    'featured_artist_badge' => [
        'label' => 'Featured artist',
    ],

    'index' => [
        'title' => 'Daftar Beatmap',
        'guest_title' => 'Beatmap',
    ],

    'panel' => [
        'empty' => 'tidak ada beatmap',

        'download' => [
            'all' => 'unduh',
            'video' => 'unduh dengan video',
            'no_video' => 'unduh tanpa video',
            'direct' => 'buka melalui osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Pada beatmap hybrid, Anda harus memilih setidaknya satu mode permainan untuk dinominasikan.',
        'incorrect_mode' => 'Anda tidak memiliki hak untuk memberikan nominasi pada mode permainan: :mode',
        'full_bn_required' => 'Anda harus berstatus sebagai nominator penuh (full nominator) untuk dapat menominasikan beatmap ini.',
        'too_many' => 'Persyaratan nominasi telah terpenuhi.',

        'dialog' => [
            'confirmation' => 'Apakah Anda yakin untuk menominasikan beatmap ini?',
            'header' => 'Nominasikan Beatmap',
            'hybrid_warning' => 'catatan: Anda hanya dapat memberikan satu nominasi, sehingga pastikan Anda memberikan nominasi pada mode permainan yang memang Anda kehendaki',
            'which_modes' => 'Mode permainan mana yang hendak Anda nominasikan?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Eksplisit',
    ],

    'show' => [
        'discussion' => 'Diskusi',

        'details' => [
            'by_artist' => 'oleh :artist',
            'favourite' => 'Tambahkan beatmap ini ke dalam daftar Beatmap Favorit',
            'favourite_login' => 'Silakan masuk untuk menambahkan beatmap ini ke Beatmap Favorit',
            'logged-out' => 'Anda harus masuk sebelum mengunduh beatmap!',
            'mapped_by' => 'dibuat oleh :mapper',
            'unfavourite' => 'Hapus beatmap ini dari daftar Beatmap Favorit',
            'updated_timeago' => 'terakhir diperbarui :timeago',

            'download' => [
                '_' => 'Unduh',
                'direct' => '',
                'no-video' => 'tanpa Video',
                'video' => 'dengan Video',
            ],

            'login_required' => [
                'bottom' => 'untuk mengakses lebih banyak fitur',
                'top' => 'Masuk',
            ],
        ],

        'details_date' => [
            'approved' => 'berstatus Approved sejak :timeago',
            'loved' => 'berstatus Loved sejak :timeago',
            'qualified' => 'berstatus Qualified sejak :timeago',
            'ranked' => 'berstatus Ranked sejak :timeago',
            'submitted' => 'diunggah pada :timeago',
            'updated' => 'terakhir diperbarui :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Anda memiliki terlalu banyak beatmap yang telah Anda favoritkan! Mohon hapus beberapa beatmap dari daftar favorit Anda sebelum melanjutkan.',
        ],

        'hype' => [
            'action' => 'Apabila Anda menyukai beatmap ini, berikanlah hype Anda agar beatmap ini dapat selangkah lebih dekat menuju status <strong>Ranked</strong>.',

            'current' => [
                '_' => 'Beatmap ini sedang berstatus :status.',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => 'dalam pengerjaan (work-in-progress)',
                ],
            ],

            'disqualify' => [
                '_' => 'Apabila Anda menemukan suatu masalah pada beatmap ini, mohon diskualifikasi beatmap yang bersangkutan melalui :link.',
            ],

            'report' => [
                '_' => 'Apabila Anda menemukan suatu masalah pada beatmap ini, mohon laporkan kepada tim kami melalui :link.',
                'button' => 'Laporkan Masalah',
                'link' => 'tautan ini',
            ],
        ],

        'info' => [
            'description' => 'Deskripsi',
            'genre' => 'Aliran',
            'language' => 'Bahasa',
            'no_scores' => 'Data sedang diproses...',
            'nominators' => 'Nominator',
            'nsfw' => 'Konten eksplisit',
            'offset' => 'Offset online',
            'points-of-failure' => 'Titik-Titik Kegagalan',
            'source' => 'Sumber',
            'storyboard' => 'Beatmap ini menyertakan storyboard',
            'success-rate' => 'Tingkat Keberhasilan',
            'tags' => 'Tag',
            'video' => 'Beatmap ini menyertakan video',
        ],

        'nsfw_warning' => [
            'details' => 'Beatmap ini ditenggarai mengandung konten yang bersifat eksplisit dan/atau konten yang dapat dianggap menyinggung bagi kalangan tertentu. Apakah Anda tetap ingin melihat beatmap ini?',
            'title' => 'Konten Eksplisit',

            'buttons' => [
                'disable' => 'Nonaktifkan peringatan',
                'listing' => 'Daftar beatmap',
                'show' => 'Tampilkan',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'diraih pada :when',
            'country' => 'Peringkat Negara',
            'error' => 'Gagal memuat peringkat',
            'friend' => 'Peringkat Teman',
            'global' => 'Peringkat Global',
            'supporter-link' => 'Klik <a href=":link">di sini</a> untuk melihat seluruh fitur menarik yang akan Anda dapatkan!',
            'supporter-only' => 'Anda harus menjadi supporter untuk mengakses fitur peringkat teman dan negara!',
            'title' => 'Papan Skor',

            'headers' => [
                'accuracy' => 'Akurasi',
                'combo' => 'Kombo Maks',
                'miss' => 'Miss',
                'mods' => 'Mod',
                'pin' => 'Sematkan',
                'player' => 'Pemain',
                'pp' => '',
                'rank' => 'Peringkat',
                'score' => 'Skor',
                'score_total' => 'Jumlah Skor',
                'time' => 'Waktu',
            ],

            'no_scores' => [
                'country' => 'Tidak seorang pun dari negara Anda yang memiliki skor di map ini!',
                'friend' => 'Anda tidak memiliki teman yang telah menorehkan skor di map ini!',
                'global' => 'Belum ada skor yang tercatat pada beatmap ini. Mungkin Anda tertarik untuk mencetak skor Anda sendiri?',
                'loading' => 'Memuat skor...',
                'unranked' => 'Beatmap ini tidak berstatus Ranked.',
            ],
            'score' => [
                'first' => 'Di Posisi Pertama',
                'own' => 'Skor Terbaik Anda',
            ],
            'supporter_link' => [
                '_' => 'Klik :here untuk melihat seluruh fitur menarik yang akan Anda dapatkan!',
                'here' => 'di sini',
            ],
        ],

        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => 'Jumlah Key',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => 'Star Difficulty',
            'total_length' => 'Durasi Total (Durasi Bersih: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Jumlah Circle',
            'count_sliders' => 'Jumlah Slider',
            'offset' => 'Offset online: :offset',
            'user-rating' => 'Nilai Pengguna',
            'rating-spread' => 'Persebaran Nilai Pengguna',
            'nominations' => 'Nominasi',
            'playcount' => 'Jumlah Dimainkan',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'Pending',
            'graveyard' => 'Graveyard',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Spotlight',
    ],
];
