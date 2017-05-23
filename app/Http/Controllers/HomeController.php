<?php

namespace App\Http\Controllers;

use App\Project;
use App\Ssh\SshClientGateway;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(SshClientGateway $ssh)
    {
        return view('home', [
            'projects' => Project::findByUser(request()->user()),
            'public_key' => $ssh->getPublicKey(),
        ]);
    }
}
