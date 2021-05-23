<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'projects';
    protected $fillable = [
        'project_id',
        'project_name',
        'project_desc',
        'username',
    ];

    protected $primaryKey = 'project_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
    
    public function projectDivisions()
    {
        return $this->hasMany(ProjectDivision::class, 'project_id');
    }

    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class, 'project_id');
    }
}
