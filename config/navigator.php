<?php

return [

    'menus' => [
        'main' => [
            'items' => [
                [
                    'title' => 'Register',
                    'items' => [
                        [
                            'title' => 'Test',
                            'filter' => [
                                'notAuthenticated' => [
                                    ['test', 'test']
                                ],
                            ],
                        ]
                    ]
                ],
            ],
            'view' => 'main'
        ],

        'sidebar' => [
            'items' => [
                [
                    'title' => 'Dashboard',
                    'url' => '/',
                    'icon' => 'icon icon-meter',
                    'filter' => 'notAuthenticated',
                    'items' => [
                        [
                            'title' => 'Test',
                            'url' => '/users',
                        ]
                    ]
                ],
            ],
            'view' => 'sidebar'
        ]
    ],

    'defaultView' => 'navigator::bootstrap.default',

    'renderer' => 'Coreplex\Navigator\Renderers\LaravelBlade',

    'store' => 'Coreplex\Navigator\Store\ArrayStore',

    'filters' => [
        'notAuthenticated' => 'AdvancedRent\Filters\NotAuthenticated',
    ],

];