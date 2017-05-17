<?php

namespace Tests\Unit\Ssh;

use App\Project;
use App\Ssh\SshClient;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SshClientTest extends TestCase
{
    /** @test */
    public function can_init_with_project_data()
    {
        $project = factory(Project::class)->states('deployable')->make();
        $ssh = new SshClient;

        $ssh->init($project);

        $this->assertEquals($ssh->user, $project->sshUser);
        $this->assertNotNull($ssh->user);
        $this->assertEquals($ssh->host, $project->sshHost);
        $this->assertNotNull($ssh->host);
        $this->assertEquals($ssh->script, $project->deployScript);
        $this->assertNotNull($ssh->script);
    }
}
