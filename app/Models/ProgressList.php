<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProgressList extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'progress_lists';

    protected $fillable = [
        'list_id',
        'division_id',
        'list_name',
    ];

    protected $primaryKey = 'list_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
