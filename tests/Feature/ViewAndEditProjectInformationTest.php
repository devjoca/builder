<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewAndEditProjectInformationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_view_project_information()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->states('deployable')->create([
            'user_id' => $user->id,
        ]);

        $project->wasRecentlyCreated = false;
        $project->load('builds');

        $response = $this->actingAs($user)
                         ->get("/projects/{$project->id}/edit");

        $response->assertStatus(200)
                 ->assertViewHas('project', $project);
    }

    /** @test */
    public function update_project_information()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->states('deployable')->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
                         ->put("/projects/{$project->id}", [
                            'name' => 'Some weird project name',
                            'sshUser' => 'user',
                            'sshHost' => 'host',
                            'deployScript' => 'deploy script',
                        ]);

        $response->assertRedirect(route('project.edit', $project->id))
                 ->assertSessionHas('message', 'Successful');
        $this->assertEquals($project->fresh()->name, 'Some weird project name');
        $this->assertEquals($project->fresh()->sshUser, 'user');
        $this->assertEquals($project->fresh()->sshHost, 'host');
        $this->assertEquals($project->fresh()->deployScript, 'deploy script');
    }
}
