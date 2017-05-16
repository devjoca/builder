<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use App\Ssh\FakeSshClient;
use App\Ssh\SshClientGateway;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RunNewBuildTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_a_new_build_of_app( )
    {
        $project = factory(Project::class)->create();
        $fakeSshClient = new FakeSshClient;
        $this->app->instance(SshClientGateway::class, $fakeSshClient);

        $response = $this->json('POST', "projects/{$project->id}/build");

        $response->assertStatus(200);
        $this->assertEquals($project->builds()->count(), 1);
        $this->assertNotNull($project->builds()->first()->output);
    }
}
