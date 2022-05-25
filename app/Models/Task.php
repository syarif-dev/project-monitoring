<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table  = 'tasks';
    protected $guarded = ['id'];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
