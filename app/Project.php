<?php

namespace App;

use InvalidArgumentException;
use App\Ssh\SshClientGateway;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function builds()
    {
        return $this->hasMany(Build::class)->latest('id');
    }

    public function runBuild(SshClientGateway $ssh)
    {
        $this->validateForDeploy($this);

        $ssh->init($this);

        return $this->builds()->create([
            'output' => $ssh->runTask(),
        ]);
    }

    protected function validateForDeploy()
    {
        if( is_null($this->sshUser)
            || is_null($this->sshHost)
            || is_null($this->deployScript))
        {
            throw new InvalidArgumentException;
        }
    }

    public static function findByUser(User $user)
    {
        return $user->projects;
    }

}
