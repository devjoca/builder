<?php

namespace Tests\Feature;

use App\User;
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
        $user = factory(User::class)->create();
        $project = factory(Project::class)->states('deployable')->create([
            'user_id' => $user->id,
        ]);
        $fakeSshClient = new FakeSshClient;
        $this->app->instance(SshClientGateway::class, $fakeSshClient);

        $response = $this->actingAs($user)
                         ->json('POST', "projects/{$project->id}/build");

        $response->assertStatus(200);
        $this->assertEquals($project->builds()->count(), 1);
        $this->assertNotNull($project->builds()->first()->output);
    }
}
