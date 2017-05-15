<?php

namespace App;

use App\Ssh\SshClient;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function builds()
    {
        return $this->hasMany(Build::class)->latest('id');
    }

    public function runBuild()
    {
        return $this->builds()->create([]);
    }
}
