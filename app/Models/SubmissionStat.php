<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'processed_at',
        'processing_time_ms',
        'status'
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
