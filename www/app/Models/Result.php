<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = false;
    use HasFactory;
    public function answers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Answer::class, 'answer_result')
            ->withPivot('rating')
            ->withTimestamps();
    }
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
