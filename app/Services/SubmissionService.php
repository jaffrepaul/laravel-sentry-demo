<?php

namespace App\Services;

use App\Models\Submission;
use App\Models\SubmissionStat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SubmissionService
{
    private const CACHE_TTL = 3600; // 1 hour
    private const RECENT_SUBMISSIONS_CACHE_KEY = 'recent_submissions';
    private const STATS_CACHE_KEY = 'submission_stats';

    public function storeSubmission(array $data): Submission
    {
        return DB::transaction(function () use ($data) {
            // Create the submission
            $submission = Submission::create($data);

            // Record processing stats
            $startTime = microtime(true);
            $this->recordSubmissionStats($submission, $startTime);

            // Invalidate caches
            $this->invalidateCaches();

            return $submission;
        });
    }

    public function getRecentSubmissions(int $limit = 10): array
    {
        return Cache::remember(
            self::RECENT_SUBMISSIONS_CACHE_KEY,
            self::CACHE_TTL,
            fn() => Submission::withStats()
                ->recent()
                ->limit($limit)
                ->get()
                ->toArray()
        );
    }

    public function getSubmissionStats(): array
    {
        return Cache::remember(
            self::STATS_CACHE_KEY,
            self::CACHE_TTL,
            function () {
                return [
                    'total_submissions' => Submission::count(),
                    'average_processing_time' => SubmissionStat::avg('processing_time_ms'),
                    'submissions_by_status' => SubmissionStat::select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->get()
                        ->pluck('count', 'status')
                        ->toArray(),
                    'recent_activity' => Submission::withStats()
                        ->recent()
                        ->limit(5)
                        ->get()
                        ->map(fn($submission) => [
                            'id' => $submission->id,
                            'name' => $submission->name,
                            'email' => $submission->email,
                            'processed_at' => $submission->stat?->processed_at,
                            'processing_time' => $submission->stat?->processing_time_ms,
                            'status' => $submission->stat?->status,
                        ])
                        ->toArray(),
                ];
            }
        );
    }

    private function recordSubmissionStats(Submission $submission, float $startTime): void
    {
        $processingTime = round((microtime(true) - $startTime) * 1000); // Convert to milliseconds

        SubmissionStat::create([
            'submission_id' => $submission->id,
            'processed_at' => now(),
            'processing_time_ms' => $processingTime,
            'status' => 'completed',
        ]);
    }

    private function invalidateCaches(): void
    {
        Cache::forget(self::RECENT_SUBMISSIONS_CACHE_KEY);
        Cache::forget(self::STATS_CACHE_KEY);
    }
}
