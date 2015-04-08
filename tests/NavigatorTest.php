<?php namespace Coreplex\Navigator\Tests;

use Coreplex\Navigator\Navigator;
use Coreplex\Navigator\Store\ArrayStore;
use Coreplex\Navigator\Renderers\LaravelBlade;

class NavigatorTest extends PHPUnit_Framework_TestCase
{

    protected function makeNavigator()
    {
        $config = $this->getConfig();

        return new Navigator(new LaravelBlade(App::make('view')), new ArrayStore($config['items']), $config);
    }

    protected function getConfig()
    {
        return file_get_contents(__DIR__ . '../config/navigator.php');
    }

}