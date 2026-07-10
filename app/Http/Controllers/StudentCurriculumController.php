<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Services\AiService;
use App\Services\PromptEngine;
use Illuminate\Support\Str;

class StudentCurriculumController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::where('is_active', true)->get();

        // Categorize by subject and class level based on tags
        $categorized = [];
        foreach ($curriculums as $c) {
            $subject = $this->resolveSubject($c);
            $level = $this->resolveLevel($c);
            
            $categorized[$level][$subject][] = $c;
        }

        // Sort levels
        ksort($categorized);

        return view('curriculum.index', compact('categorized'));
    }

    public function show(Curriculum $curriculum)
    {
        return view('curriculum.show', compact('curriculum'));
    }

    public function chat(Request $request, Curriculum $curriculum, AiService $aiService)
    {
        $message = $request->input('message');
        if (empty($message)) {
            return response()->json(['error' => 'Message is empty'], 400);
        }

        $userId = session('chat_user_id');

        // Build customized system context instructing the AI to coach the student
        $manualContext = "[MADA YA KIADA: {$curriculum->title}]\n{$curriculum->content}\n\n";
        $manualContext .= "MAELEKEZO YA UFUNDISHAJI:\n";
        $manualContext .= "Wewe ni Mwalimu Msaidizi anayemuongoza mwanafunzi kusoma mada hii. ";
        if ($curriculum->language === 'sw') {
            $manualContext .= "Jibu swali la mwanafunzi kulingana na mada iliyo hapo juu pekee. Mpe maelezo mafupi, rahisi, na ya kirafiki kwa Kiswahili. Ukimweleza jambo, muulize swali dogo la kupima uelewa wake. Usitumie alama za nyota (*).";
        } else {
            $manualContext .= "Answer the student's question strictly based on the curriculum topic above. Keep it brief, simple, and friendly in English. After explaining, ask a quick follow-up quiz question to test their understanding. Do not use asterisks (*).";
        }

        // Generate response
        $engine = new PromptEngine();
        $prompt = $engine->build($message, $curriculum->language, $manualContext);
        
        $aiResult = $aiService->generateResponse($prompt);

        // Track learning session if user is logged in
        if ($userId) {
            $subject = $this->resolveSubject($curriculum);
            // Dynamic check in case migration/model is not created yet
            if (class_exists(\App\Models\LearningSession::class)) {
                \App\Models\LearningSession::trackMessage($userId, $subject, 0); // we will track tokens inside Task 5
            }
        }

        return response()->json([
            'status' => 'success',
            'response' => $aiResult,
        ]);
    }

    private function resolveSubject(Curriculum $c): string
    {
        $tags = Str::lower($c->tags);
        if (Str::contains($tags, ['fizikia', 'physics'])) return 'Physics (Fizikia)';
        if (Str::contains($tags, ['biolojia', 'biology'])) return 'Biology (Biolojia)';
        if (Str::contains($tags, ['kemia', 'chemistry'])) return 'Chemistry (Kemia)';
        if (Str::contains($tags, ['tehama', 'ict', 'computer'])) return 'Computer Studies (TEHAMA)';
        if (Str::contains($tags, ['hisabati', 'math'])) return 'Mathematics (Hisabati)';
        if (Str::contains($tags, ['kiswahili'])) return 'Kiswahili';
        if (Str::contains($tags, ['kiingereza', 'english'])) return 'English';
        if (Str::contains($tags, ['afya', 'health'])) return 'Health Education (Elimu ya Afya)';
        
        return 'General Studies';
    }

    private function resolveLevel(Curriculum $c): string
    {
        $tags = Str::lower($c->tags);
        if (Str::contains($tags, ['form1', 'kidato cha kwanza', 'kwanza'])) return 'Form 1 (Kidato cha I)';
        if (Str::contains($tags, ['form2', 'kidato cha pili', 'pili'])) return 'Form 2 (Kidato cha II)';
        if (Str::contains($tags, ['form3', 'kidato cha tatu', 'tatu'])) return 'Form 3 (Kidato cha III)';
        if (Str::contains($tags, ['form4', 'kidato cha nne', 'nne'])) return 'Form 4 (Kidato cha IV)';
        
        return 'Other Levels';
    }
}
