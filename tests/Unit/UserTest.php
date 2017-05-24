<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_create_new_project()
    {
        $user = factory(User::class)->create();
        $user->createProject(new Project([
            'name' => 'Some weird project name',
            'sshUser' => 'user',
            'sshHost' => 'host',
            'deployScript' => 'deploy script',
        ]));

        $this->assertEquals($user->projects->first()->name, 'Some weird project name');
        $this->assertEquals($user->projects->first()->sshUser, 'user');
        $this->assertEquals($user->projects->first()->sshHost, 'host');
        $this->assertEquals($user->projects->first()->deployScript, 'deploy script');
    }
}
