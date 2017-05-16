<?php

namespace App\Ssh;

use App\Project;

interface SshClientGateway
{

    public function init(Project $project);

}