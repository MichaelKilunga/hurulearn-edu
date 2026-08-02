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
            --indigo: #1e1b4b;
            --indigo-dark: #0f0d2e;
            --blue: #3b82f6;
            --blue-light: #60a5fa;
            --amber: #f59e0b;
            --amber-light: #fcd34d;
            --teal: #14b8a6;
            --white: #ffffff;
            --gray-100: #f3f4f6;
            --gray-400: #9ca3af;
            --gray-850: #16143c;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--indigo-dark); color: var(--white); min-height: 100vh; overflow-x: hidden; }
        
        .bg-glow {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 10% 20%, rgba(59,130,246,0.1) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(245,158,11,0.08) 0%, transparent 40%);
            z-index: -1;
        }

        /* Nav */
        nav {
            padding: 1.5rem 2rem; display: flex; align-items: center; justify-content: space-between;
            background: rgba(15,13,46,0.8); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.08); position: sticky; top: 0; z-index: 100;
        }
        .logo { display: flex; align-items: center; gap: .8rem; text-decoration: none; color: #fff; font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.2rem; }
        .logo img { width: 32px; height: 32px; }

        .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        
        header { margin-bottom: 2.5rem; text-align: center; }
        header h1 { font-family: 'Space Grotesk', sans-serif; font-size: 2.8rem; margin-bottom: .8rem; background: linear-gradient(135deg, #fff 30%, var(--gray-400)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        header p { color: var(--gray-400); font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.6; }

        .level-section { margin-bottom: 4.5rem; }
        .level-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; margin-bottom: 2rem; display: flex; align-items: center; gap: .8rem; border-bottom: 1px solid rgba(255,255,255,0.06); padding-bottom: .8rem; }
        .level-title span { width: 40px; height: 5px; background: var(--amber); border-radius: 3px; }

        .subject-block { margin-bottom: 2.5rem; }
        .subject-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.3rem; margin-bottom: 1.2rem; color: var(--blue-light); display: flex; align-items: center; gap: 0.5rem; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.8rem; }
        
        .card {
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px; padding: 1.8rem; transition: all .3s ease;
            display: flex; flex-direction: column; justify-content: space-between;
            position: relative; overflow: hidden; text-decoration: none; color: inherit;
        }
        .card:hover { transform: translateY(-4px); border-color: rgba(59,130,246,0.3); background: rgba(255,255,255,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.25); }
        
        .card-lang { font-size: 0.7rem; font-weight: 700; background: rgba(255,255,255,0.06); padding: 0.2rem 0.5rem; border-radius: 4px; color: var(--gray-400); border: 1px solid rgba(255,255,255,0.08); text-transform: uppercase; }

        .card h3 { font-family: 'Space Grotesk', sans-serif; font-size: 1.15rem; margin-bottom: .6rem; line-height: 1.4; color: #white; }
        .card p { font-size: .88rem; color: var(--gray-400); line-height: 1.55; margin-bottom: 1.5rem; flex-grow: 1; }
        
        .card-footer { display: flex; align-items: center; justify-content: space-between; color: var(--blue-light); font-size: 0.85rem; font-weight: 600; margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 0.8rem; }
        .card-footer svg { transition: transform 0.2s; }
        .card:hover .card-footer svg { transform: translateX(4px); }

        .btn { display: inline-flex; align-items: center; justify-content: center; padding: .7rem 1.4rem; border-radius: 12px; font-weight: 600; text-decoration: none; cursor: pointer; transition: all .2s; border: none; font-size: .88rem; }
        .btn-outline { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); color: #fff; }
        .btn-outline:hover { background: rgba(255,255,255,0.1); border-color: var(--blue-light); }

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
            <a href="{{ route('chat.index') }}" class="btn btn-outline" style="padding: .5rem 1rem; font-size: .8rem; background: var(--blue); border-color: transparent;">Study Chat</a>
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
                        <div id="progress-ratio" style="font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; font-weight: 700; color: var(--amber);">0 / 0</div>
                        <div style="font-size: 0.72rem; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Topics Completed</div>
                    </div>
                </div>
                <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.06); border-radius: 10px; overflow: hidden; position: relative;">
                    <div id="student-progress-bar" style="width: 0%; height: 100%; background: linear-gradient(90deg, var(--amber), var(--blue-light)); border-radius: 10px; transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);"></div>
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
