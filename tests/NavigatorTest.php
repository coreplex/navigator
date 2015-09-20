<?php

namespace Coreplex\Navigator\Tests;

class NavigatorTest extends BaseTest
{
    public function testNavigatorImplementsContract()
    {
        $navigator = $this->navigator();

        $this->assertInstanceOf('Coreplex\Navigator\Contracts\Navigator', $navigator);
    }

    public function testAllMethodReturnsAllMenuItems()
    {
        $navigator = $this->navigator();
        $items = $navigator->all();

        $this->assertEquals(2, count($items->all()));
    }

    public function testGetMethodOnlyReturnsRelevantMenuItems()
    {
        $navigator = $this->navigator();
        $items = $navigator->get('sidebar');

        $this->assertEquals(1, count($items->all()));
    }

    public function testFiltersCanBeAddedAfterNavigatorIsInstantiated()
    {
        $navigator = $this->navigator();
        $navigator = $navigator->filter('testFilter', 'NewFilter');

        $this->assertInstanceOf('Coreplex\Navigator\Contracts\Navigator', $navigator);
    }
}