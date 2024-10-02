<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rank',
        'total_points',
        'period',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
