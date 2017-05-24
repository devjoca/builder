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
}
