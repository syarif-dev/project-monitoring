<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $table  = 'teams';
    protected $fillable = ['name','email','photo'];

    public function project(){
        return $this->hasMany(Project::class);
    }

    public function getPhoto(){
        return asset('photo/user.png');
    }
}
