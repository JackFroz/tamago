<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Attachment extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'attachments';

    protected $fillable = [
        'attachment_id',
        'attachment_name',
        'attachment_url',
        'card_id',
    ];

    protected $primaryKey = 'attachment_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'card_id');
    }
}
