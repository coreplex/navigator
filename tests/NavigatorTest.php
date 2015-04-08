<?php namespace Coreplex\Navigator\Tests;

require_once __DIR__ . '/LaravelTestCase.php';

use Coreplex\Navigator\Navigator;
use Coreplex\Navigator\Store\ArrayStore;
use Coreplex\Navigator\Renderers\LaravelBlade;

class NavigatorTest extends LaravelTestCase {

    public function testNavigatorImplementsContract()
    {
        $navigator = $this->makeNavigator();

        $this->assertInstanceOf('Coreplex\Navigator\Contracts\Navigator', $navigator);
    }

    public function testAllMethodReturnsAllMenuItems()
    {
        $navigator = $this->makeNavigator();
        $items = $navigator->all();

        $this->assertEquals(2, count($items->all()));
    }

    public function testGetMethodOnlyReturnsRelevantMenuItems()
    {
        $navigator = $this->makeNavigator();
        $items = $navigator->get('sidebar');

        $this->assertEquals(1, count($items->all()));
    }

    public function testFiltersCanBeAddedAfterNavigatorIsInstantiated()
    {
        $navigator = $this->makeNavigator();
        $navigator = $navigator->filter('testFilter', 'NewFilter');

        $this->assertInstanceOf('Coreplex\Navigator\Contracts\Navigator', $navigator);
    }

    protected function makeNavigator()
    {
        $config = $this->getConfig();

        return new Navigator(new LaravelBlade($this->app['view']), new ArrayStore($this->getMenu()), $config);
    }

    protected function getMenu()
    {
        return [
            'main' => [
                'items' => [
                    [
                        'title' => 'Register',
                        'items' => [
                            [
                                'title' => 'Test',
                            ]
                        ]
                    ],
                ],
            ],

            'sidebar' => [
                'items' => [
                    [
                        'title' => 'Dashboard',
                        'url' => '/',
                        'icon' => 'icon icon-meter',
                        'items' => [
                            [
                                'title' => 'Test',
                                'url' => '/users',
                            ]
                        ]
                    ],
                ],
            ]
        ];
    }

    protected function getConfig()
    {
        return require __DIR__ . '/../config/navigator.php';
    }

}