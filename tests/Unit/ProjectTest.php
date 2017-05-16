<?php

namespace Tests\Unit;

use App\Project;
use Tests\TestCase;
use App\Ssh\FakeSshClient;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function run_a_new_build()
    {
        $project = factory(Project::class)->create();

        $build = $project->runBuild(new FakeSshClient);

        $this->assertEquals($build->fresh(), $project->builds()->first());
        $this->assertEquals(1, $project->builds()->count());
    }

    /** @test */
    public function get_latest_build_by_default()
    {
        $project = factory(Project::class)->create();

        $build1 = $project->runBuild(new FakeSshClient);
        $build2 = $project->runBuild(new FakeSshClient);

        $this->assertEquals($build2->id, $project->builds->first()->id);
    }
}
