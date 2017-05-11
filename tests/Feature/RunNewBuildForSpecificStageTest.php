<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RunNewBuildForSpecificStage extends TestCase
{
    public function test_run_a_new_build_for_a_stage()
    {
        $stage = factory(Stage::class)->create();

        $stage->runBuild();

        $this->assertTrue($stage->builds()->count(), 1);
    }
}
