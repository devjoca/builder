<?php

namespace App\Ssh;

use App\Project;

class FakeSshClient implements SshClientGateway
{
    public function init(Project $project)
    {

    }

    public function runTask()
    {

    }
}