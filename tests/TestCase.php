<?php

namespace Lian\Coupon\Test;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected $user;

    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->withFactories(__DIR__ . '/../database/factories');

        $this->loadLaravelMigrations();

        $this->user = User::create(['email' => 'm809745357@gmail.com', 'name' => 'm809745357', 'password' => bcrypt('password')]);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('coupon.model', User::class);
    }

    protected function getPackageProviders($app)
    {
        return ['Lian\Coupon\CouponServiceProvider'];
    }
}
