<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table  = 'projects';
    protected $guarded = ['id'];

    public function task(){
        return $this->hasMany(Task::class);
    }

    public function team(){
        return $this->belongsTo(Team::class, 'leader_id');
    }

    public function getFormatStartDateAttribute(){
        return Carbon::parse(($this->attributes['start_date']))->translatedFormat('d M Y');
    }

    public function getFormatEndDateAttribute(){
        return Carbon::parse(($this->attributes['end_date']))->translatedFormat('d M Y');
    }
}
