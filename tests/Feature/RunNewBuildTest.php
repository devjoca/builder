<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RunNewBuildTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_a_new_build_of_app()
    {
        $project = factory(Project::class)->create();

        $project->runBuild();

        $this->assertEquals($project->builds()->count(), 1);
    }
}
