<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewProjectsListTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_view_list_projects_in_home()
    {
        $user = factory(User::class)->create();
        factory(Project::class)->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
    }

    /** @test */
    public function just_list_projects_of_auth_user()
    {
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        factory(Project::class)->create([
            'user_id' => $user->id,
        ]);

        factory(Project::class)->create([
            'user_id' => $user2->id,
        ]);

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
        $response->assertViewHas('projects', $user->projects);
    }
}
