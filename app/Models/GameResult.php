<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'correct', 'incorrect', 'detalle'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
