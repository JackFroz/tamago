<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProgressList extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'progress_lists';

    protected $fillable = [
        'list_id',
        'division_id',
        'list_name',
        'order',
    ];

    protected $primaryKey = 'list_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
