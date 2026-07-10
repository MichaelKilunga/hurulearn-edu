<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningSession extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'message_count',
        'total_tokens',
        'started_at',
        'last_activity_at',
        'is_active',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Track a chat message and group it into a learning session.
     *
     * @param int $userId
     * @param string $subject
     * @param int $tokens
     * @return LearningSession
     */
    public static function trackMessage($userId, $subject = 'General', $tokens = 0)
    {
        $now = now();
        $sessionThreshold = 30; // minutes

        // Find active session active within last 30 minutes
        $session = self::where('user_id', $userId)
            ->where('is_active', true)
            ->where('last_activity_at', '>=', $now->copy()->subMinutes($sessionThreshold))
            ->first();

        if ($session) {
            $session->message_count += 1;
            $session->total_tokens += $tokens;
            $session->last_activity_at = $now;
            
            // Upgrade subject if it was General
            if ($session->subject === 'General' && $subject !== 'General') {
                $session->subject = $subject;
            }
            
            $session->save();
        } else {
            // Close any old active sessions that timed out
            self::where('user_id', $userId)
                ->where('is_active', true)
                ->update(['is_active' => false]);

            $session = self::create([
                'user_id' => $userId,
                'subject' => $subject,
                'message_count' => 1,
                'total_tokens' => $tokens,
                'started_at' => $now,
                'last_activity_at' => $now,
                'is_active' => true,
            ]);
        }

        return $session;
    }

    /**
     * Resolve subject from a query string.
     *
     * @param string $query
     * @return string
     */
    public static function resolveSubjectFromQuery(string $query)
    {
        $query = \Illuminate\Support\Str::lower($query);
        
        $subjects = [
            'Physics (Fizikia)' => ['fizikia', 'physics', 'nguvu', 'force', 'mwendo', 'motion', 'mwanga', 'light', 'umeme', 'electricity', 'magne', 'vipimo'],
            'Biology (Biolojia)' => ['biolojia', 'biology', 'seli', 'cell', 'mimea', 'plant', 'upumuaji', 'uzazi', 'reproduction', 'urithi', 'genetics', 'viumbe'],
            'Chemistry (Kemia)' => ['kemia', 'chemistry', 'maabara', 'laboratory', 'atom', 'asidi', 'acid', 'besi', 'base', 'reaction', 'mchanganyiko'],
            'Computer Studies (TEHAMA)' => ['tehama', 'ict', 'kompyuta', 'computer', 'software', 'hardware', 'internet', 'mtandao'],
            'Mathematics (Hisabati)' => ['hisabati', 'math', 'hesabu', 'namba', 'algebra', 'jiometri'],
        ];

        foreach ($subjects as $subjectName => $keywords) {
            if (\Illuminate\Support\Str::contains($query, $keywords)) {
                return $subjectName;
            }
        }

        return 'General';
    }
}
