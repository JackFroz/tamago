<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Project extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'projects';
    protected $fillable = [
        'project_id',
        'project_name',
        'project_desc',
        'owner_email',
    ];

    protected $primaryKey = 'project_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    public function projectDivisions()
    {
        return $this->hasMany(ProjectDivision::class);
    }

    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class);
    }
}
