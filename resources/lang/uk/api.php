<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Неможливо надіслати пусте повідомлення.',
            'limit_exceeded' => 'Ви відправляєте повідомлення занадто швидко, будь ласка, зачекайте трохи перед повторною спробою.',
            'too_long' => 'Повідомлення, яке ви намагаєтесь відправити надто довге.',
        ],
    ],

    'scopes' => [
        'bot' => 'Виступайте в ролі чатового бота',
        'identify' => 'Ідентифікувати вас і читати загальнодоступні дані.',

        'chat' => [
            'write' => 'Надсилайте повідомлення від свого імені.',
        ],

        'forum' => [
            'write' => 'Створюйте та редагуйте теми та дописи на форумі від вашого імені.',
        ],

        'friends' => [
            'read' => 'Подивіться, на кого ви підписані.',
        ],

        'public' => 'Читайте публічні дані від свого імені.',
    ],
];
