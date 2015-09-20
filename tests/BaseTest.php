<?php

namespace Coreplex\Navigator\Tests;

use Coreplex\Navigator\Navigator;
use Coreplex\Navigator\Store\ArrayStore;
use PHPUnit_Framework_TestCase;

class BaseTest extends PHPUnit_Framework_TestCase
{
    public function navigator()
    {
        return new Navigator($this->renderer(), $this->store(), $this->config());
    }

    public function store()
    {
        return new ArrayStore($this->getMenus());
    }

    protected function renderer()
    {
        return new \Coreplex\Core\Renderer\Native();
    }

    public function config()
    {
        return [

            /**
             * =======================================================================
             *  Base menu items
             * =======================================================================
             *
             * Set any class based menus here.
             */
            'menus' => [
                'main' => [
                    [
                        'title' => 'Register',
                        'items' => [
                            [
                                'title' => 'Test',
                            ]
                        ]
                    ],
                ],

                'sidebar' => 'Coreplex\Navigator\Tests\Sidebar',
            ],

            /**
             * =======================================================================
             *  Default view
             * =======================================================================
             *
             * If you are using a templatable driver then you can set the base
             * template here. To override this at run time you can use the template
             * method.
             */
            'defaultView' => 'navigator::bootstrap.default',

            /**
             * =======================================================================
             *  Store
             * =======================================================================
             *
             * Set the data store you are using. Can be:
             *
             * Coreplex\Navigator\Store\ArrayStore
             */
            'store' => 'Coreplex\Navigator\Store\ArrayStore',

            /**
             * =======================================================================
             *  Item Filters
             * =======================================================================
             *
             * Item filters can be used to verify if a user can view a menu item. To
             * add a filter add them to the array below with the key as a unique name
             * used to access the item filter and the value being then name of the
             * class used for the filter.
             */
            'filters' => [
                //
            ],

        ];
    }

    public function getMenus()
    {
        return [
            'main' => [
                [
                    'title' => 'Register',
                    'items' => [
                        [
                            'title' => 'Test',
                        ]
                    ]
                ],
            ],

            'sidebar' => 'Coreplex\Navigator\Tests\Sidebar',
        ];
    }

    public function testCommon()
    {
        //
    }
}