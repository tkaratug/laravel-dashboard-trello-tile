<?php

namespace Tkaratug\LaravelDashboardTrelloTile\Tests;

use Orchestra\Testbench\TestCase;
use Tkaratug\LaravelDashboardTrelloTile\LaravelDashboardTrelloTileServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app): array
    {
        return [LaravelDashboardTrelloTileServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
