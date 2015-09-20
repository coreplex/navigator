<?php

namespace Coreplex\Navigator\Tests;

class NavigatorTest extends BaseTest
{
    public function testNavigatorImplementsContract()
    {
        $navigator = $this->navigator();

        $this->assertInstanceOf('Coreplex\Navigator\Contracts\Navigator', $navigator);
    }

    public function testMenusCanBeRegisteredWithClassesOrArrays()
    {
        $navigator = $this->navigator();
        $main = $navigator->get('main');
        $sidebar = $navigator->get('sidebar');

        $this->assertInstanceOf('Coreplex\Navigator\Components\Menu', $main);
        $this->assertInstanceOf('Coreplex\Navigator\Components\Menu', $sidebar);
    }

    public function testAllMethodReturnsAllMenuItems()
    {
        $navigator = $this->navigator();
        $items = $navigator->all();

        $this->assertEquals(3, count($items->all()));
    }

    public function testGetMethodOnlyReturnsRelevantMenuItems()
    {
        $navigator = $this->navigator();
        $items = $navigator->get('sidebar');

        $this->assertEquals(2, count($items->all()));
    }

    public function testFiltersCanBeAddedAfterNavigatorIsInstantiated()
    {
        $navigator = $this->navigator();
        $navigator = $navigator->filter('testFilter', 'NewFilter');

        $this->assertInstanceOf('Coreplex\Navigator\Contracts\Navigator', $navigator);
    }

    public function testAttributesCanBeAccessDynamicallyFromTheMenuItems()
    {
        $navigator = $this->navigator();
        $menu = $navigator->get('sidebar');
        $item = $menu->all()[0];

        $this->assertContains('Dashboard', $item->title);
    }

    public function testIsActiveMethod()
    {
        $navigator = $this->navigator();
        $menu = $navigator->get('sidebar');
        $items = $menu->all();

        $this->assertInternalType('bool', $items[0]->isActive());
        $this->assertEquals(true, $items[0]->isActive());
        $this->assertEquals(false, $items[1]->isActive());
    }
}