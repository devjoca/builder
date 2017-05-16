<?php

namespace App;

use App\Ssh\SshClientGateway;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function builds()
    {
        return $this->hasMany(Build::class)->latest('id');
    }

    public function runBuild(SshClientGateway $ssh)
    {
        $ssh->init($this);

        return $this->builds()->create([
            'output' => $ssh->runTask(),
        ]);
    }
}
