<?php

namespace Coreplex\Navigator\Tests;

class Sidebar
{
    public function design()
    {
        return [
            [
                'title' => 'Dashboard',
                'url' => '/test',
                'icon' => 'icon icon-meter',
                'items' => [
                    [
                        'title' => 'Test',
                        'url' => '/users',
                    ]
                ]
            ],
            [
                'title' => 'Users',
                'url' => '/users',
                'icon' => 'icon icon-user',
                'items' => [
                    [
                        'title' => 'Create User',
                        'url' => '/create',
                    ]
                ]
            ],
        ];
    }
}