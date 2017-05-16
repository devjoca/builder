<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Ssh\SshClientGateway;

class ProjectController extends Controller
{
    public function build(Project $project, SshClientGateway $sshClient)
    {
        $build = $project->runBuild($sshClient);

        return response()->json($build);
    }
}
