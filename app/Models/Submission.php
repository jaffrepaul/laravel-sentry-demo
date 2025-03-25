<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message'];

    public function stat()
    {
        return $this->hasOne(SubmissionStat::class);
    }

    public function scopeRecent(Builder $query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeWithStats(Builder $query)
    {
        return $query->with('stat');
    }
}
