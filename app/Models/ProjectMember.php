<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProjectMember extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'project_members';
    protected $fillable = [
        'member_id',
        'project_id',
        'division_id',
        'username',
        'permission',
    ];

    protected $primaryKey = 'member_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function projectDivision()
    {
        return $this->belongsTo(ProjectDivision::class, 'division_id');
    }

    public function cardMembers()
    {
        return $this->hasMany(CardMember::class, 'member_id');
    }
}
