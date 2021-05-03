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
        'owner_email',
        'division_name',
        'division_desc',
    ];

    protected $primaryKey = 'division_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function progressLists()
    {
        return $this->hasMany(ProgressList::class);
    }

    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class);
    }
}
