<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_thread()
    {
        $user = \App\Models\User::factory()->create();
        
        $response = $this->withSession(['chat_user_id' => $user->id])
            ->post(route('community.threads.store'), [
                'title' => 'Test Thread',
                'description' => 'Test Description',
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('community_threads', ['title' => 'Test Thread']);
    }

    public function test_user_can_join_public_thread()
    {
        $user = \App\Models\User::factory()->create();
        
        $thread = \App\Models\CommunityThread::create([
            'title' => 'Public Thread',
            'slug' => 'public-thread',
            'is_private' => false,
        ]);

        $response = $this->withSession(['chat_user_id' => $user->id])
            ->post(route('community.join', $thread->slug));

        $response->assertStatus(302);
        $this->assertTrue($thread->members()->where('user_id', $user->id)->exists());
    }

    public function test_user_can_post_in_joined_thread()
    {
        $user = \App\Models\User::factory()->create();
        
        $thread = \App\Models\CommunityThread::create([
            'title' => 'Joined Thread',
            'slug' => 'joined-thread',
            'is_private' => false,
        ]);
        $thread->members()->attach($user->id);

        $response = $this->withSession(['chat_user_id' => $user->id])
            ->post(route('community.posts.store', $thread->slug), [
                'content' => 'Hello World',
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('community_posts', ['content' => 'Hello World']);
    }

    public function test_user_can_invite_student_to_private_thread()
    {
        $user = \App\Models\User::factory()->create();
        $student = \App\Models\User::factory()->create(['phone_number' => '+255711223344']);
        
        $thread = \App\Models\CommunityThread::create([
            'title' => 'Private Thread',
            'slug' => 'private-thread',
            'is_private' => true,
        ]);
        $thread->members()->attach($user->id, ['role' => 'admin']);

        $response = $this->withSession(['chat_user_id' => $user->id])
            ->post(route('community.invite', $thread->slug), [
                'phone_number' => '0711223344',
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('community_invites', [
            'community_thread_id' => $thread->id,
            'invitee_id' => $student->id,
            'status' => 'pending',
        ]);
    }

    public function test_user_can_accept_private_thread_invite()
    {
        $user = \App\Models\User::factory()->create();
        $student = \App\Models\User::factory()->create();
        
        $thread = \App\Models\CommunityThread::create([
            'title' => 'Private Thread',
            'slug' => 'private-thread',
            'is_private' => true,
        ]);
        $thread->members()->attach($user->id, ['role' => 'admin']);

        $invite = \App\Models\CommunityInvite::create([
            'community_thread_id' => $thread->id,
            'inviter_id' => $user->id,
            'invitee_id' => $student->id,
            'status' => 'pending',
            'expires_at' => now()->addDays(7),
        ]);

        $response = $this->withSession(['chat_user_id' => $student->id])
            ->get(route('community.invites.accept', $invite->token));

        $response->assertStatus(302);
        $this->assertTrue($thread->members()->where('user_id', $student->id)->exists());
        $this->assertDatabaseHas('community_invites', [
            'id' => $invite->id,
            'status' => 'accepted',
        ]);
    }
}
