<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RunNewBuildTest extends TestCase
{
    public function test_run_a_new_build_of_app()
    {
        $app = factory(Application::class)->create();

        $app->runBuild();

        $this->assertTrue($app->builds()->count(), 1);
    }
}
