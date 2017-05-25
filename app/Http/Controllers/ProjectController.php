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

    public function edit(Project $project)
    {
        $project->load('builds');

        return view('projects.edit', ['project' => $project]);
    }

    public function update(Project $project)
    {
        $project->update(request()->intersect([
            'name',
            'sshUser',
            'sshHost',
            'deployScript',
        ]));

        return redirect(route('home'))->with('message', 'Successful');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        request()->user()
                 ->createProject(new Project(request()->only(
                    'name',
                    'sshUser',
                    'sshHost',
                    'deployScript'
                )));

        return redirect(route('home'))->with('message', 'Successful');
    }
}
