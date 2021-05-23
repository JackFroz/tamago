<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProjectDivision extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'project_divisions';
    protected $fillable = [
        'division_id',
        'division_name',
        'division_desc',
        'project_id',
    ];

    protected $primaryKey = 'division_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function project() 
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function progressLists()
    {
        return $this->hasMany(ProgressList::class, 'division_id');
    }

    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class, 'division_id');
    }
}
