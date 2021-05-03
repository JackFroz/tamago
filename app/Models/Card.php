<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Card extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'cards';

    protected $fillable = [
        'card_id',
        'list_id',
        'card_name',
        'card_desc',
        'card_deadline',
        'order',
    ];

    protected $primaryKey = 'card_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function cardMembers()
    {
        return $this->hasMany(CardMember::class);
    }
}
