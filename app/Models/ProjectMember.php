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
        'member_email',
        'permission',
    ];

    protected $primaryKey = 'member_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function cardMembers()
    {
        return $this->hasMany(CardMember::class);
    }
}
