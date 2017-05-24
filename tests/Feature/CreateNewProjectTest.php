<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateNewProjectTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function create_new_project()
    {
        $user = factory(User::class)->create();


        $response = $this->actingAs($user)
                         ->post("/projects/store", [
                            'name' => 'Some weird project name',
                            'sshUser' => 'user',
                            'sshHost' => 'host',
                            'deployScript' => 'deploy script',
                        ]);
        $project = Project::first();

        $response->assertRedirect(route('home'))
                 ->assertSessionHas('message', 'Successful');
        $this->assertNotNull($project);
        $this->assertEquals($project->user_id, $user->id);
        $this->assertEquals($project->name, 'Some weird project name');
        $this->assertEquals($project->sshUser, 'user');
        $this->assertEquals($project->sshHost, 'host');
        $this->assertEquals($project->deployScript, 'deploy script');
    }
}
