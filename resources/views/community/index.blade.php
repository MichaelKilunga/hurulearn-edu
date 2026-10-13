<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Hub – HuruLearn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #15803d;
            --primary-dark: #166534;
            --secondary: #0f172a;
            --gov-blue: #1d4ed8;
            --gov-blue-dark: #1e40af;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --border-color: #cbd5e1;
            --white: #ffffff;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text-main); min-height: 100vh; overflow-x: hidden; }
        
        .bg-glow { display: none; }

        /* Nav */
        nav {
            padding: 1.5rem 2rem; display: flex; align-items: center; justify-content: space-between;
            background: #ffffff; backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color); position: sticky; top: 0; z-index: 100;
        }
        .logo { display: flex; align-items: center; gap: .8rem; text-decoration: none; color: var(--text-main); font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.2rem; }
        .logo img { width: 32px; height: 32px; }

        .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        
        header { margin-bottom: 3rem; }
        header h1 { font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; margin-bottom: .5rem; color: var(--primary-dark); }
        header p { color: var(--text-muted); font-size: 1.1rem; }

        .section-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: .8rem; color: var(--text-main); }
        .section-title span { width: 32px; height: 4px; background: var(--primary); border-radius: 2px; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 2rem; margin-bottom: 4rem; }
        
        .card {
            background: var(--card-bg); border: 1px solid var(--border-color);
            border-radius: 20px; padding: 2rem; transition: all .3s;
            display: flex; flex-direction: column; justify-content: space-between;
            position: relative; overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        .card:hover { transform: translateY(-5px); border-color: var(--gov-blue); background: var(--card-bg); box-shadow: 0 10px 25px rgba(15, 23, 42, 0.06); }
        .card::before { display: none; }
        
        .tag { display: inline-block; padding: .3rem .8rem; border-radius: 6px; font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 1rem; width: fit-content; }
        .tag-system { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .tag-public { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
        
        .card h3 { font-family: 'Space Grotesk', sans-serif; font-size: 1.3rem; margin-bottom: .8rem; color: var(--text-main); }
        .card p { font-size: .9rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1; }
        
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: .8rem 1.5rem; border-radius: 12px; font-weight: 600; text-decoration: none; cursor: pointer; transition: all .2s; border: none; font-size: .9rem; }
        .btn-primary { background: var(--gov-blue); color: #fff; box-shadow: 0 4px 12px rgba(29, 78, 216, 0.15); }
        .btn-primary:hover { background: var(--gov-blue-dark); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(29, 78, 216, 0.25); }
        .btn-outline { background: #ffffff; border: 1.5px solid var(--gov-blue); color: var(--gov-blue); }
        .btn-outline:hover { background: #eff6ff; border-color: var(--gov-blue-dark); color: var(--gov-blue-dark); }

        .fab { position: fixed; bottom: 2rem; right: 2rem; width: 64px; height: 64px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 30px rgba(21, 128, 61, 0.3); cursor: pointer; transition: all .3s; z-index: 100; border: none; }
        .fab:hover { background: var(--primary-dark); transform: scale(1.1) rotate(90deg); box-shadow: 0 12px 40px rgba(21, 128, 61, 0.45); }
        .fab svg { width: 32px; height: 32px; }

        /* Modal */
        .modal-overlay { position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 1000; padding: 2rem; }
        .modal { background: #ffffff; border: 1px solid var(--border-color); border-radius: 24px; width: 100%; max-width: 500px; padding: 2.5rem; position: relative; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); color: var(--text-main); }
        .modal h2 { font-family: 'Space Grotesk', sans-serif; margin-bottom: 1.5rem; color: var(--primary-dark); }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; font-size: .85rem; color: var(--text-muted); margin-bottom: .5rem; font-weight: 500; }
        .form-group input, .form-group textarea { width: 100%; background: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; padding: .8rem 1rem; color: var(--text-main); font-size: .95rem; outline: none; }
        .form-group input:focus, .form-group textarea:focus { border-color: var(--gov-blue); }
        
        @media (max-width: 768px) {
            .grid { grid-template-columns: 1fr; }
            header h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    
    <nav>
        <a href="/" class="logo">
            <img src="/logo.svg" alt="HuruLearn">
            <span>HuruLearn Community</span>
        </a>
        <a href="{{ route('chat.index') }}" class="btn btn-outline" style="padding: .5rem 1rem; font-size: .8rem;">Back to Chat</a>
    </nav>

    <div class="container">
        <header>
            <h1>Welcome to the Community</h1>
            <p>Connect with students, teachers, and stakeholders. Discuss anything!</p>
        </header>

        @if(session('error'))
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); padding: 1rem; border-radius: 12px; color: #fca5a5; margin-bottom: 2rem; font-size: .9rem;">
                {{ session('error') }}
            </div>
        @endif

        @if(isset($pendingInvites) && $pendingInvites->count() > 0)
            <div class="section-title"><span></span> Private Invites</div>
            <div class="grid" style="margin-bottom: 3rem;">
                @foreach($pendingInvites as $invite)
                <div class="card" style="border-color: rgba(245,158,11,0.3); background: rgba(245,158,11,0.02);">
                    <div>
                        <span class="tag" style="background: rgba(245,158,11,0.15); color: #f59e0b; border: 1px solid rgba(245,158,11,0.3);">
                            Invitation
                        </span>
                        <h3>{{ $invite->thread->title }}</h3>
                        <p style="margin-bottom: 1rem;">Invited by: <strong>{{ $invite->inviter->name ?? $invite->inviter->phone_number }}</strong></p>
                        <p style="font-size: .85rem; line-height: 1.5;">{{ Str::limit($invite->thread->description, 80) }}</p>
                    </div>
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <a href="{{ route('community.invites.accept', $invite->token) }}" class="btn btn-primary" style="flex: 1; padding: .6rem; font-size: .85rem;">Accept</a>
                        <form action="{{ route('community.invites.reject', $invite->token) }}" method="POST" style="flex: 1;">
                            @csrf
                            <button type="submit" class="btn btn-outline" style="width: 100%; padding: .6rem; font-size: .85rem; color: #f87171; border-color: rgba(248,113,113,0.3);">Decline</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        @if($joinedThreads->count() > 0)
            <div class="section-title"><span></span> Your Threads</div>
            <div class="grid">
                @foreach($joinedThreads as $thread)
                <div class="card">
                    <div>
                        <span class="tag {{ $thread->is_system ? 'tag-system' : 'tag-public' }}">
                            {{ $thread->is_system ? 'Official' : 'Community' }}
                        </span>
                        <h3>{{ $thread->title }}</h3>
                        <p>{{ Str::limit($thread->description, 100) }}</p>
                    </div>
                    <a href="{{ route('community.show', $thread->slug) }}" class="btn btn-primary">Open Thread</a>
                </div>
                @endforeach
            </div>
        @endif

        <div class="section-title"><span></span> Explore Public Discussions</div>
        <div class="grid">
            @foreach($publicThreads as $thread)
                @if(!$joinedThreads->contains($thread))
                <div class="card">
                    <div>
                        <span class="tag {{ $thread->is_system ? 'tag-system' : 'tag-public' }}">
                            {{ $thread->is_system ? 'Official' : 'Public' }}
                        </span>
                        <h3>{{ $thread->title }}</h3>
                        <p>{{ Str::limit($thread->description, 100) }}</p>
                    </div>
                    <form action="{{ route('community.join', $thread->slug) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline" style="width: 100%;">Join Discussion</button>
                    </form>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Create Thread FAB -->
    <button class="fab" onclick="document.getElementById('createModal').style.display='flex'">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
    </button>

    <!-- Create Thread Modal -->
    <div class="modal-overlay" id="createModal" onclick="if(event.target == this) this.style.display='none'">
        <div class="modal">
            <h2>Start a New Thread</h2>
            <form action="{{ route('community.threads.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="e.g. Physics Study Group" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" placeholder="What is this thread about?"></textarea>
                </div>
                <div class="form-group" style="display: flex; align-items: center; gap: .8rem;">
                    <input type="checkbox" name="is_private" id="is_private" style="width: auto;">
                    <label for="is_private" style="margin-bottom: 0;">Make this a private thread</label>
                </div>
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn btn-outline" style="flex: 1;" onclick="document.getElementById('createModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Create Thread</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
