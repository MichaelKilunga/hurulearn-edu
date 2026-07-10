<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityThread;
use App\Models\CommunityPost;
use App\Models\CommunityMember;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $userId = session('chat_user_id');
        if (!$userId) {
            return redirect()->route('chat.index', ['redirect' => request()->getRequestUri()])->with('error', 'Please login to access the community.');
        }

        $user = User::find($userId);
        
        // Public threads and threads user is a member of
        $publicThreads = CommunityThread::where('is_private', false)->latest()->get();
        $joinedThreads = $user->joinedThreads()->latest()->get();

        // Pending invites for the user
        $pendingInvites = \App\Models\CommunityInvite::where('invitee_id', $userId)
            ->where('status', 'pending')
            ->where(function($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->with(['thread', 'inviter'])
            ->get();

        return view('community.index', compact('publicThreads', 'joinedThreads', 'pendingInvites'));
    }

    public function show(CommunityThread $thread)
    {
        $userId = session('chat_user_id');
        if (!$userId) {
            return redirect()->route('chat.index', ['redirect' => request()->getRequestUri()]);
        }

        $user = User::find($userId);

        // Check if thread is private and user is a member
        if ($thread->is_private && !$thread->members->contains($user)) {
            return redirect()->route('community.index')->with('error', 'This is a private thread.');
        }

        $posts = $thread->posts()->with('user')->orderBy('created_at', 'asc')->paginate(50);
        $members = $thread->members;

        return view('community.show', compact('thread', 'posts', 'members', 'user'));
    }

    public function storeThread(Request $request)
    {
        $userId = session('chat_user_id');
        if (!$userId) return response()->json(['error' => 'Unauthorized'], 401);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_private' => 'boolean',
        ]);

        $thread = CommunityThread::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'description' => $request->description,
            'creator_id' => $userId,
            'is_private' => $request->has('is_private'),
        ]);

        // Creator is the first member and admin of the thread
        $thread->members()->attach($userId, ['role' => 'admin']);

        return redirect()->route('community.show', $thread);
    }

    public function storePost(Request $request, CommunityThread $thread)
    {
        $userId = session('chat_user_id');
        if (!$userId) return response()->json(['error' => 'Unauthorized'], 401);

        $user = User::find($userId);
        if (!$thread->members->contains($user)) {
            return response()->json(['error' => 'You are not a member of this thread.'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $post = CommunityPost::create([
            'community_thread_id' => $thread->id,
            'user_id' => $userId,
            'content' => $request->content,
            'is_approved' => true, // Auto-approve for now, unless it's a special moderated thread
        ]);

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'post' => $post->load('user')]);
        }

        return back();
    }

    public function join(CommunityThread $thread)
    {
        $userId = session('chat_user_id');
        if (!$userId) return redirect()->route('chat.index', ['redirect' => route('community.show', $thread)]);

        if ($thread->is_private) {
            return back()->with('error', 'Cannot join a private thread without an invite.');
        }

        $thread->members()->syncWithoutDetaching([$userId => ['role' => 'member']]);

        return redirect()->route('community.show', $thread);
    }

    public function leave(CommunityThread $thread)
    {
        $userId = session('chat_user_id');
        if (!$userId) return redirect()->route('chat.index', ['redirect' => route('community.index')]);

        $thread->members()->detach($userId);

        return redirect()->route('community.index');
    }

    // Admin moderation
    public function toggleApproval(CommunityPost $post)
    {
        // This should be protected by admin middleware
        $post->update(['is_approved' => !$post->is_approved]);
        return back()->with('success', 'Post approval toggled.');
    }

    public function inviteStudent(Request $request, CommunityThread $thread)
    {
        $userId = session('chat_user_id');
        if (!$userId) return redirect()->route('chat.index')->with('error', 'Please login to send invites.');

        $request->validate([
            'phone_number' => 'required|string|min:10',
        ]);

        $phoneNumber = $request->phone_number;
        // Basic normalization
        if (!str_starts_with($phoneNumber, '+')) {
            if (str_starts_with($phoneNumber, '0')) {
                $phoneNumber = '+255' . substr($phoneNumber, 1);
            } else {
                $phoneNumber = '+' . $phoneNumber;
            }
        }

        $invitee = User::where('phone_number', $phoneNumber)->first();
        if (!$invitee) {
            return back()->with('error', 'Student with this phone number is not registered yet.');
        }

        if ($invitee->id === (int) $userId) {
            return back()->with('error', 'You cannot invite yourself.');
        }

        // Check if already a member
        if ($thread->members->contains($invitee)) {
            return back()->with('error', 'This student is already a member of this thread.');
        }

        // Check for active invite
        $existingInvite = \App\Models\CommunityInvite::where('community_thread_id', $thread->id)
            ->where('invitee_id', $invitee->id)
            ->where('status', 'pending')
            ->where('expires_at', '>', now())
            ->first();

        if ($existingInvite) {
            return back()->with('error', 'An invitation has already been sent to this student.');
        }

        \App\Models\CommunityInvite::create([
            'community_thread_id' => $thread->id,
            'inviter_id' => $userId,
            'invitee_id' => $invitee->id,
            'status' => 'pending',
            'expires_at' => now()->addDays(7),
        ]);

        return back()->with('success', 'Invitation sent successfully.');
    }

    public function acceptInvite(Request $request, $token)
    {
        $userId = session('chat_user_id');
        if (!$userId) {
            return redirect()->route('chat.index', ['redirect' => route('community.invites.accept', $token)])
                ->with('error', 'Please login to accept your invite.');
        }

        $invite = \App\Models\CommunityInvite::where('token', $token)->firstOrFail();

        if ($invite->status !== 'pending' || ($invite->expires_at && $invite->expires_at->isPast())) {
            return redirect()->route('community.index')->with('error', 'This invitation has expired or been accepted.');
        }

        if ($invite->invitee_id !== (int) $userId) {
            return redirect()->route('community.index')->with('error', 'This invitation was not sent to you.');
        }

        $thread = $invite->thread;
        $thread->members()->syncWithoutDetaching([$userId => ['role' => 'member']]);

        $invite->update(['status' => 'accepted']);

        return redirect()->route('community.show', $thread->slug)->with('success', "Joined thread: {$thread->title}");
    }

    public function rejectInvite(Request $request, $token)
    {
        $userId = session('chat_user_id');
        if (!$userId) return redirect()->route('chat.index');

        $invite = \App\Models\CommunityInvite::where('token', $token)->firstOrFail();

        if ($invite->invitee_id !== (int) $userId) {
            return back()->with('error', 'This invitation was not sent to you.');
        }

        $invite->update(['status' => 'rejected']);

        return back()->with('success', 'Invitation declined.');
    }
}
