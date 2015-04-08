<?php

namespace Coreplex\Navigator\Tests;

use PHPUnit_Framework_TestCase;
use Illuminate\Foundation\Testing\ApplicationTrait;

class LaravelTestCase extends PHPUnit_Framework_TestCase {

    use ApplicationTrait;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        if ( ! $this->app)
        {
            $this->refreshApplication();
        }
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../../../../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

}