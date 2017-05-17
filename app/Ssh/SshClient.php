<?php

namespace App\Ssh;

use App\Project;

class SshClient implements SshClientGateway
{
    public $user;
    public $host;
    public $script;

    public function init(Project $project)
    {
        $this->user = $project->sshUser;
        $this->host = $project->sshHost;
        $this->script = $project->deployScript;
    }

    public function runTask(){}
}