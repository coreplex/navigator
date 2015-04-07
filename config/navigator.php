<?php

return [

    'menus' => [
        'main' => [
            'items' => [
                [
                    'title' => 'Register',
                    'filter' => 'AdvancedRent\Filters\NotAuthenticated',
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
                ],
            ],
            'view' => 'sidebar'
        ]
    ],

    'defaultView' => 'navigator::bootstrap.default',

    'renderer' => 'Coreplex\Navigator\Renderers\LaravelBlade',

    'store' => 'Coreplex\Navigator\Store\ArrayStore',

];