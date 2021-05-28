<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CardMember extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'card_members';

    protected $fillable = [
        'card_member_id',
        'card_id',
        'username',
        'member_id',
    ];

    protected $primaryKey = 'card_member_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    public function projectMember()
    {
        return $this->belongsTo(ProjectMember::class, 'member_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
