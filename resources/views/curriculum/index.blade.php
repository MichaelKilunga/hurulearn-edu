<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syllabus & Topics – HuruLearn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1b3f8b;
            --primary-dark: #0f295e;
            --secondary: #1e293b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --border-color: #cbd5e1;
            --success: #15803d;
            --accent: #eab308;
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
        
        header { margin-bottom: 2.5rem; text-align: center; }
        header h1 { font-family: 'Space Grotesk', sans-serif; font-size: 2.8rem; margin-bottom: .8rem; color: var(--primary); }
        header p { color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.6; }

        .level-section { margin-bottom: 4.5rem; }
        .level-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; margin-bottom: 2rem; display: flex; align-items: center; gap: .8rem; border-bottom: 1px solid var(--border-color); padding-bottom: .8rem; color: var(--text-main); }
        .level-title span { width: 40px; height: 5px; background: var(--accent); border-radius: 3px; }

        .subject-block { margin-bottom: 2.5rem; }
        .subject-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.3rem; margin-bottom: 1.2rem; color: var(--primary-dark); display: flex; align-items: center; gap: 0.5rem; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.8rem; }
        
        .card {
            background: var(--card-bg); border: 1px solid var(--border-color);
            border-radius: 18px; padding: 1.8rem; transition: all .3s ease;
            display: flex; flex-direction: column; justify-content: space-between;
            position: relative; overflow: hidden; text-decoration: none; color: inherit;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        .card:hover { transform: translateY(-4px); border-color: var(--primary); background: var(--card-bg); box-shadow: 0 10px 25px rgba(15, 23, 42, 0.06); }
        
        .card-lang { font-size: 0.7rem; font-weight: 700; background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; color: var(--text-muted); border: 1px solid var(--border-color); text-transform: uppercase; }

        .card h3 { font-family: 'Space Grotesk', sans-serif; font-size: 1.15rem; margin-bottom: .6rem; line-height: 1.4; color: var(--text-main); }
        .card p { font-size: .88rem; color: var(--text-muted); line-height: 1.55; margin-bottom: 1.5rem; flex-grow: 1; }
        
        .card-footer { display: flex; align-items: center; justify-content: space-between; color: var(--primary); font-size: 0.85rem; font-weight: 600; margin-top: auto; border-top: 1px solid var(--border-color); padding-top: 0.8rem; }
        .card-footer svg { transition: transform 0.2s; }
        .card:hover .card-footer svg { transform: translateX(4px); }

        .btn { display: inline-flex; align-items: center; justify-content: center; padding: .7rem 1.4rem; border-radius: 12px; font-weight: 600; text-decoration: none; cursor: pointer; transition: all .2s; border: none; font-size: .88rem; }
        .btn-outline { background: #ffffff; border: 1.5px solid var(--primary); color: var(--primary); }
        .btn-outline:hover { background: #eff6ff; color: var(--primary-dark); border-color: var(--primary-dark); }

        @media (max-width: 768px) {
            .grid { grid-template-columns: 1fr; }
            header h1 { font-size: 2.2rem; }
            .container { padding: 2rem 1.2rem; }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    
    <nav>
        <a href="/" class="logo">
            <img src="/logo.svg" alt="HuruLearn">
            <span>HuruLearn Syllabus</span>
        </a>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('community.index') }}" class="btn btn-outline" style="padding: .5rem 1rem; font-size: .8rem;">Community</a>
            <a href="{{ route('chat.index') }}" class="btn btn-outline" style="padding: .5rem 1rem; font-size: .8rem; background: var(--primary); border-color: transparent; color: #fff;">Study Chat</a>
        </div>
    </nav>

    <div class="container">
        <header>
            <h1>Syllabus & Lesson Topics</h1>
            <p>Select any learning topic below. Access the official curriculum materials and learn step-by-step with your personalized AI teaching assistant.</p>
        </header>

        @if(count($categorized) > 0)
            <!-- Student Progress Dashboard Widget -->
            <div class="progress-container-card" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 1.8rem; margin-bottom: 3.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.2rem;">
                    <div>
                        <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; color: var(--white); margin-bottom: 0.2rem;">🎓 My Learning Journey</h3>
                        <p style="font-size: 0.85rem; color: var(--gray-400);">Stay trackable! Completed topics save automatically in your browser.</p>
                    </div>
                    <div style="text-align: right;">
                        <div id="progress-ratio" style="font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; font-weight: 700; color: var(--primary);">0 / 0</div>
                        <div style="font-size: 0.72rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Topics Completed</div>
                    </div>
                </div>
                <div style="width: 100%; height: 8px; background: #e2e8f0; border-radius: 10px; overflow: hidden; position: relative;">
                    <div id="student-progress-bar" style="width: 0%; height: 100%; background: var(--primary); border-radius: 10px; transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);"></div>
                </div>
            </div>
        @endif

        @if(count($categorized) === 0)
            <div style="text-align: center; padding: 4rem; color: var(--gray-400); background: rgba(255,255,255,0.02); border-radius: 20px; border: 1px solid rgba(255,255,255,0.05);">
                <h3>No curriculum material loaded yet.</h3>
                <p style="margin-top: 0.5rem; font-size: 0.9rem;">Please seed the database or check settings.</p>
            </div>
        @else
            @foreach($categorized as $level => $subjects)
                <div class="level-section">
                    <h2 class="level-title"><span></span> {{ $level }}</h2>
                    
                    @foreach($subjects as $subject => $items)
                        <div class="subject-block">
                            <h3 class="subject-title">📙 {{ $subject }}</h3>
                            <div class="grid">
                                @foreach($items as $item)
                                    <a href="{{ route('curriculum.show', $item->id) }}" class="card curriculum-card" data-id="{{ $item->id }}">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.8rem; width: 100%;">
                                            <span class="card-lang">{{ $item->language == 'sw' ? 'Kiswahili' : 'English' }}</span>
                                            <span class="status-badge" style="display: none; font-size: 0.68rem; font-weight: 700; color: #10b981; background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.22); padding: 0.18rem 0.5rem; border-radius: 6px; text-transform: uppercase;">✓ Completed</span>
                                        </div>
                                        <div>
                                            <h3>{{ $item->title }}</h3>
                                            <p>{{ $item->summary ?? Str::limit(strip_tags($item->content), 120) }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <span class="action-text">Soma Mada na Uliza maswali</span>
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

    <!-- Syllabus Progress Tracker JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.curriculum-card');
            let completedCount = 0;
            const totalCount = cards.length;

            cards.forEach(card => {
                const cardId = card.getAttribute('data-id');
                const isCompleted = localStorage.getItem('hurulearn_completed_curriculum_' + cardId) === 'true';

                if (isCompleted) {
                    completedCount++;
                    // Show completion badge
                    const badge = card.querySelector('.status-badge');
                    if (badge) badge.style.display = 'inline-block';
                    
                    // Modify styles for completed cards
                    card.style.borderColor = 'rgba(20, 184, 166, 0.25)';
                    card.style.background = 'rgba(20, 184, 166, 0.015)';
                    
                    const actionText = card.querySelector('.action-text');
                    if (actionText) {
                        actionText.textContent = 'Completed (Read Again)';
                        actionText.style.color = '#14b8a6';
                    }
                }
            });

            // Update user progress metrics card
            const progressRatio = document.getElementById('progress-ratio');
            const progressBar = document.getElementById('student-progress-bar');
            
            if (progressRatio) {
                progressRatio.textContent = `${completedCount} / ${totalCount}`;
            }
            
            if (progressBar && totalCount > 0) {
                const percentage = (completedCount / totalCount) * 100;
                progressBar.style.width = `${percentage}%`;
            }
        });
    </script>
</body>
</html>
