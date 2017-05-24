<?php

namespace Tests\Unit\Ssh;

use App\Project;
use Tests\TestCase;
use App\Ssh\FakeSshClient;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FakeSshClientTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function init_ssh_client()
    {
        $project = factory(Project::class)->states('deployable')->make();
        $sshClient = new FakeSshClient;

        $sshClient->init($project);

        $this->assertEquals($sshClient->user, $project->sshUser);
        $this->assertNotNull($sshClient->user);
        $this->assertEquals($sshClient->host, $project->sshHost);
        $this->assertNotNull($sshClient->host);
        $this->assertEquals($sshClient->script, $project->deployScript);
        $this->assertNotNull($sshClient->script);
    }
}
