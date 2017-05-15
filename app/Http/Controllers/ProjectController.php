<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function build(Project $project)
    {
        $build = $project->runBuild();

        return response()->json($build);
    }
}
