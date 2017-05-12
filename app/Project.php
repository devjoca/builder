<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function builds()
    {
        return $this->hasMany(Build::class);
    }

    public function runBuild()
    {
        $this->builds()->create([]);
    }
}
