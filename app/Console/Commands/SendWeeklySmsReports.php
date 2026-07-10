<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\LearningSession;
use App\Services\SmsService;
use App\Services\LanguageDetector;
use Illuminate\Support\Str;

class SendWeeklySmsReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hurulearn:send-weekly-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $signature_description = 'Dispatches weekly educational study reports to active student users via SMS.';

    /**
     * Execute the console command.
     */
    public function handle(SmsService $smsService)
    {
        $this->info('Starting weekly study reports dispatch...');

        $oneWeekAgo = now()->subDays(7);

        // Fetch users who had learning session activity in the last 7 days
        $activeUsers = User::whereHas('messages', function ($query) use ($oneWeekAgo) {
            $query->where('created_at', '>=', $oneWeekAgo);
        })->get();

        $count = 0;
        foreach ($activeUsers as $user) {
            // Count completed sessions
            $sessions = LearningSession::where('user_id', $user->id)
                ->where('started_at', '>=', $oneWeekAgo)
                ->get();

            if ($sessions->isEmpty()) {
                continue;
            }

            $sessionCount = $sessions->count();
            
            // Get unique subjects
            $subjects = $sessions->pluck('subject')
                ->unique()
                ->filter(fn($s) => $s !== 'General')
                ->values();

            // Detect language preference from last message
            $lastMsg = $user->messages()
                ->where('direction', 'inbound')
                ->latest()
                ->first();

            $language = 'sw';
            if ($lastMsg) {
                $detector = new LanguageDetector();
                $language = $detector->detect($lastMsg->content) ?? 'sw';
            }

            // Build SMS report text
            if ($language === 'sw') {
                $subjectsList = $subjects->isEmpty() ? 'Masomo Mbalimbali' : $subjects->join(', ');
                $smsText = "HuruLearn: Hongera! Wiki hii umekamilisha vipindi {$sessionCount} vya masomo. Mada ulizosoma: {$subjectsList}. Endelea kusoma kwa ufaulu mzuri!";
            } else {
                $subjectsList = $subjects->isEmpty() ? 'General Studies' : $subjects->join(', ');
                $smsText = "HuruLearn: Congratulations! You completed {$sessionCount} study sessions this week. Subjects: {$subjectsList}. Keep learning towards your exams!";
            }

            // Add shortcode prefix requirement
            $smsText = 'HURU ' . $smsText;

            // Send SMS
            $this->info("Sending report to {$user->phone_number}: {$smsText}");
            $smsService->send($user->phone_number, $smsText);
            $count++;
        }

        $this->info("Successfully sent weekly reports to {$count} users.");
    }
}
