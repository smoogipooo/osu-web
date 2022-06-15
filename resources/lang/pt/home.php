<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Descarregar agora',
        'online' => '<strong>:players</strong> atualmente online em <strong>:games</strong> jogos',
        'peak' => 'Pico, :count utilizadores online',
        'players' => '<strong>:count</strong> jogadores registados',
        'title' => 'bem-vindo',
        'see_more_news' => 'ver mais notícias',

        'slogan' => [
            'main' => 'o melhor jogo de ritmo grátis',
            'sub' => 'o ritmo está a um clique de distância',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pesquisa avançada',
        'button' => 'Pesquisar',
        'empty_result' => 'Nada encontrado!',
        'keyword_required' => 'É necessária uma palavra-chave de pesquisa',
        'placeholder' => 'escreve para procurar',
        'title' => 'Procurar',

        'beatmapset' => [
            'login_required' => 'Inicia a sessão para procurar por beatmaps',
            'more' => 'Há mais :count resultados de pesquisa de beatmap',
            'more_simple' => 'Ver mais resultados de pesquisa de beatmap',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Todos os fóruns',
            'link' => 'Pesquisar o fórum',
            'login_required' => 'Inicia a sessão para pesquisar no fórum',
            'more_simple' => 'Ver mais resultados de pesquisa de fórum',
            'title' => 'Fórum',

            'label' => [
                'forum' => 'procurar nos fóruns',
                'forum_children' => 'incluir sub-fóruns',
                'topic_id' => 'tópico #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'todos',
            'beatmapset' => 'beatmap',
            'forum_post' => 'fórum',
            'user' => 'jogador',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Inicia a sessão para procurar utilizadores',
            'more' => 'Há mais :count resultados de pesquisa de jogador',
            'more_simple' => 'Ver mais resultados de pesquisa de jogador',
            'more_hidden' => 'A pesquisa de jogador está limitada a :max jogadores. Tenta redefinir a questão de pesquisa.',
            'title' => 'Jogadores',
        ],

        'wiki_page' => [
            'link' => 'Pesquisar na wiki',
            'more_simple' => 'Ver mais resultados de pesquisa da wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "vamos pôr-te<br>a andar!",
        'action' => 'Descarrega o osu!',

        'help' => [
            '_' => 'se tiveres problemas ao iniciar o jogo ou ao criar uma conta, vê :help_forum_link ou :support_button.',
            'help_forum_link' => 'consultar o fórum de ajuda',
            'support_button' => 'contactar apoio',
        ],

        'os' => [
            'windows' => 'para Windows',
            'macos' => 'para macOS',
            'linux' => 'para Linux',
        ],
        'mirror' => 'link alternativo',
        'macos-fallback' => 'utilizadores de macOS',
        'steps' => [
            'register' => [
                'title' => 'obtém uma conta',
                'description' => 'segue as indicações ao iniciares o jogo para iniciar sessão ou criar uma nova conta',
            ],
            'download' => [
                'title' => 'descarrega o jogo',
                'description' => 'clica no botão acima para transferir o instalador e depois abre-o!',
            ],
            'beatmaps' => [
                'title' => 'adquire beatmaps',
                'description' => [
                    '_' => ':browse a vasta biblioteca de beatmaps criados por utilizadores e começa a jogar!',
                    'browse' => 'explora',
                ],
            ],
        ],
        'video-guide' => 'vídeo de guia',
    ],

    'user' => [
        'title' => 'painel de controlo',
        'news' => [
            'title' => 'Notícias',
            'error' => 'Erro ao carregar notícias, melhor tentares recarregar a página?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Amigos online',
                'games' => 'Jogos',
                'online' => 'Utilizadores online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Novos beatmaps classificados',
            'popular' => 'Beatmaps populares',
            'by_user' => 'por :user',
        ],
        'buttons' => [
            'download' => 'Transfere o osu!',
            'support' => 'Apoia o osu!',
            'store' => 'osu!store',
        ],
    ],
];
