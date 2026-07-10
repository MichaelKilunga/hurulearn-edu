<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\PromptTemplateController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WebChatController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\StudentCurriculumController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    $communityPosts = \App\Models\CommunityPost::where('is_approved', true)
        ->whereHas('thread', function($query) {
            $query->where('slug', 'general-advice');
        })
        ->with('user')
        ->latest()
        ->take(6)
        ->get();
    return view('welcome', compact('communityPosts'));
})->name('welcome');

// Web Chatbot Routes
Route::get('/chat', [WebChatController::class, 'index'])->name('chat.index');
Route::post('/chat/login', [WebChatController::class, 'login'])->name('chat.login');
Route::get('/chat/messages', [WebChatController::class, 'getMessages'])->name('chat.messages');
Route::post('/chat/send', [WebChatController::class, 'sendMessage'])->name('chat.send');
Route::post('/chat/logout', [WebChatController::class, 'logout'])->name('chat.logout');
Route::get('/chat/stats', [WebChatController::class, 'getStats'])->name('chat.stats');

// Student Curriculum Routes
Route::get('/curriculum', [StudentCurriculumController::class, 'index'])->name('curriculum.index');
Route::get('/curriculum/{curriculum}', [StudentCurriculumController::class, 'show'])->name('curriculum.show');
Route::post('/curriculum/{curriculum}/chat', [StudentCurriculumController::class, 'chat'])->name('curriculum.chat');

// Legal Pages
Route::view('/terms-and-conditions', 'legal.terms')->name('legal.terms');
Route::view('/privacy-policy', 'legal.privacy')->name('legal.privacy');
Route::view('/offline', 'offline')->name('offline');

// Community Routes
Route::prefix('community')->name('community.')->group(function () {
    Route::get('/', [CommunityController::class, 'index'])->name('index');
    Route::post('/threads', [CommunityController::class, 'storeThread'])->name('threads.store');
    Route::get('/threads/{thread:slug}', [CommunityController::class, 'show'])->name('show');
    Route::post('/threads/{thread:slug}/posts', [CommunityController::class, 'storePost'])->name('posts.store');
    Route::post('/threads/{thread:slug}/join', [CommunityController::class, 'join'])->name('join');
    Route::post('/threads/{thread:slug}/leave', [CommunityController::class, 'leave'])->name('leave');
    Route::post('/threads/{thread:slug}/invite', [CommunityController::class, 'inviteStudent'])->name('invite');
    Route::get('/invites/accept/{token}', [CommunityController::class, 'acceptInvite'])->name('invites.accept');
    Route::post('/invites/reject/{token}', [CommunityController::class, 'rejectInvite'])->name('invites.reject');
});

// Landing page contact / subscribe / partner forms
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(AdminAuth::class)->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Curriculum
    Route::get('/curriculum', [CurriculumController::class, 'index'])->name('admin.curriculum.index');
    Route::post('/curriculum/import', [CurriculumController::class, 'import'])->name('admin.curriculum.import');
    Route::delete('/curriculum/{curriculum}', [CurriculumController::class, 'destroy'])->name('admin.curriculum.destroy');

    // Prompt Templates
    Route::get('/templates', [PromptTemplateController::class, 'index'])->name('admin.templates.index');
    Route::post('/templates', [PromptTemplateController::class, 'store'])->name('admin.templates.store');
    Route::get('/templates/{template}/edit', [PromptTemplateController::class, 'edit'])->name('admin.templates.edit');
    Route::put('/templates/{template}', [PromptTemplateController::class, 'update'])->name('admin.templates.update');
    Route::delete('/templates/{template}', [PromptTemplateController::class, 'destroy'])->name('admin.templates.destroy');
    Route::patch('/templates/{template}/toggle', [PromptTemplateController::class, 'toggle'])->name('admin.templates.toggle');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
