@extends("layouts.admin", ["title" => "Curriculum Management"])

@section("content")
    <!-- Metric Summary Cards -->
    <div class="stats-grid" style="margin-bottom: 2rem;">
        <div class="stat-card">
            <div class="stat-card-glow" style="background: var(--blue);"></div>
            <div class="stat-icon">📚</div>
            <div class="stat-label">Total Topics</div>
            <div class="stat-value">{{ \App\Models\Curriculum::count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-glow" style="background: var(--amber);"></div>
            <div class="stat-icon">🇹🇿</div>
            <div class="stat-label">Swahili Topics</div>
            <div class="stat-value">{{ \App\Models\Curriculum::where('language', 'sw')->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-glow" style="background: var(--teal);"></div>
            <div class="stat-icon">🇬🇧</div>
            <div class="stat-label">English Topics</div>
            <div class="stat-value">{{ \App\Models\Curriculum::where('language', 'en')->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-glow" style="background: var(--indigo);"></div>
            <div class="stat-icon">⚡</div>
            <div class="stat-label">Active Materials</div>
            <div class="stat-value">{{ \App\Models\Curriculum::where('is_active', true)->count() }}</div>
        </div>
    </div>

    <div style="display:grid; grid-template-columns:340px 1fr; gap:1.8rem; align-items:start;">

        <!-- Import Panel -->
        <div class="card" style="position:sticky; top:80px; box-shadow: 0 8px 30px rgba(0,0,0,0.2);">
            <div class="card-header" style="background: rgba(255,255,255,0.02);">
                <div class="card-title">📤 Import Curriculum</div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.curriculum.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" style="margin-bottom: 0.6rem;">Source Document (CSV, TXT, JSON)</label>
                        
                        <!-- Drag and Drop Dropzone -->
                        <div id="drop-zone" style="border:2px dashed rgba(255,255,255,0.15); border-radius:14px; padding:2rem 1rem; text-align:center; cursor:pointer; transition:all .3s ease; background:rgba(255,255,255,0.01);">
                            <div id="drop-zone-icon" style="font-size:2.5rem; margin-bottom:.5rem; transition:transform 0.2s;">📂</div>
                            <span style="color:var(--white); font-size:.9rem; font-weight:600; display:block; margin-bottom:.2rem;">Drag & drop file here</span>
                            <span style="color:var(--gray-500); font-size:.78rem; display:block; margin-bottom:.8rem;">or <label for="doc_file" style="color:var(--amber-light); font-weight:600; text-decoration:underline; cursor:pointer;">browse computer</label></span>
                            <input type="file" id="doc_file" name="doc_file" required accept=".csv,.txt,.json" style="display:none;">
                            <div id="file-name" style="font-size:.78rem; color:#10b981; font-weight:500; margin-top:.4rem; word-break:break-all;"></div>
                        </div>

                        <div class="form-hint" style="margin-top:0.8rem; font-size:0.75rem; color:var(--gray-500); line-height:1.45;">
                            💡 <strong>CSV columns:</strong> title, content, summary, tags.<br>
                            💡 <strong>JSON structure:</strong> array of objects with keys above.<br>
                            💡 <strong>TXT:</strong> split automatically by double-newlines.
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-top: 1.5rem;">
                        <label class="form-label">Curriculum Language</label>
                        <select name="language" class="form-select">
                            <option value="sw">🇹🇿 Swahili (Kiswahili)</option>
                            <option value="en">🇬🇧 English</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full" style="margin-top: 1rem;">
                        <span>⬆ Import Data</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Entries Table & Filters -->
        <div class="card" style="box-shadow: 0 8px 30px rgba(0,0,0,0.2);">
            <div class="card-header" style="background: rgba(255,255,255,0.02); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <div class="card-title">📚 Curriculum Entries</div>
                    <div class="card-subtitle">{{ $curriculums->total() }} total records matching query</div>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div style="background: rgba(255,255,255,0.015); border-bottom: 1px solid rgba(255,255,255,0.07); padding: 1.2rem 1.5rem;">
                <form method="GET" action="{{ route('admin.curriculum.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px; position: relative;">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, summary, or tags..." class="form-input" style="padding-left: 2.2rem;">
                        <span style="position: absolute; left: 0.8rem; top: 50%; transform: translateY(-50%); color: var(--gray-500); font-size: 0.9rem;">🔍</span>
                    </div>
                    <div style="width: 160px;">
                        <select name="language" class="form-select" onchange="this.form.submit()">
                            <option value="">All Languages</option>
                            <option value="sw" {{ request('language') === 'sw' ? 'selected' : '' }}>🇹🇿 Swahili</option>
                            <option value="en" {{ request('language') === 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-blue" style="padding: 0.65rem 1.2rem;">Search</button>
                    @if(request()->filled('search') || request()->filled('language'))
                        <a href="{{ route('admin.curriculum.index') }}" class="btn btn-ghost" style="padding: 0.65rem 1.2rem;">Clear</a>
                    @endif
                </form>
            </div>

            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="padding-left: 1.5rem; width: 45%;">Title / Topic Summary</th>
                            <th style="width: 15%;">Language</th>
                            <th style="width: 22%;">Tags</th>
                            <th style="text-align: right; padding-right: 1.5rem; width: 18%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($curriculums as $item)
                            <tr>
                                <td style="padding: 1.2rem 1rem 1.2rem 1.5rem; vertical-align: top;">
                                    <div style="font-weight:600; color:var(--white); font-size:.92rem; margin-bottom:.25rem;">{{ $item->title }}</div>
                                    <div style="font-size:0.78rem; color:var(--gray-400); line-height: 1.45; max-width: 420px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $item->summary ?? Str::limit(strip_tags($item->content), 120) }}
                                    </div>
                                </td>
                                <td style="vertical-align: top; padding-top: 1.2rem;">
                                    @if($item->language === 'sw')
                                        <span class="badge badge-amber">🇹🇿 SW</span>
                                    @else
                                        <span class="badge badge-blue">🇬🇧 EN</span>
                                    @endif
                                </td>
                                <td style="vertical-align: top; padding-top: 1.2rem;">
                                    <div style="display: flex; gap: 0.35rem; flex-wrap: wrap; max-width: 200px;">
                                        @if($item->tags)
                                            @foreach(explode(',', $item->tags) as $tag)
                                                <span class="badge badge-gray" style="font-size: 0.68rem; padding: 0.15rem 0.45rem;">{{ trim($tag) }}</span>
                                            @endforeach
                                        @else
                                            <span style="color:var(--gray-600); font-size:0.8rem;">—</span>
                                        @endif
                                    </div>
                                </td>
                                <td style="vertical-align: top; padding: 1.2rem 1.5rem 1.2rem 1rem; text-align: right;">
                                    <div style="display: flex; gap: 0.45rem; justify-content: flex-end; align-items: center;">
                                        <a href="{{ route('curriculum.show', $item) }}" target="_blank" class="btn btn-ghost btn-sm" style="padding: 0.35rem 0.65rem; font-size: 0.78rem;" title="View Study Room">
                                            👁️ View
                                        </a>
                                        <form action="{{ route('admin.curriculum.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Delete this curriculum entry?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.35rem 0.65rem; font-size: 0.78rem;">🗑 Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; padding:4rem; color:var(--gray-600);">
                                    <div style="font-size:2.5rem; margin-bottom:.8rem;">📭</div>
                                    <div style="font-weight: 600; color: var(--gray-400); margin-bottom: 0.25rem;">No curriculum found</div>
                                    <p style="font-size: 0.8rem;">Try clearing your search query or import a new file.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div style="padding:1.2rem 1.5rem; border-top:1px solid rgba(255,255,255,0.07); background: rgba(255,255,255,0.005);">
                {{ $curriculums->links('vendor.pagination.admin-dark') }}
            </div>
        </div>
    </div>

    <!-- Drag & Drop Uploader Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('doc_file');
            const fileNameDisplay = document.getElementById('file-name');
            const dropZoneIcon = document.getElementById('drop-zone-icon');

            if (!dropZone) return;

            // Highlight drag events
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.style.borderColor = 'var(--amber)';
                    dropZone.style.background = 'rgba(245,158,11,0.06)';
                    dropZone.style.boxShadow = '0 0 15px rgba(245,158,11,0.15)';
                    dropZoneIcon.style.transform = 'scale(1.18)';
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.style.borderColor = 'rgba(255,255,255,0.15)';
                    dropZone.style.background = 'rgba(255,255,255,0.01)';
                    dropZone.style.boxShadow = 'none';
                    dropZoneIcon.style.transform = 'scale(1)';
                }, false);
            });

            // Handle dropped files
            dropZone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length) {
                    fileInput.files = files;
                    updateFileInfo(files[0]);
                }
            });

            // File select change
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) {
                    updateFileInfo(fileInput.files[0]);
                }
            });

            // Click zone to trigger browse
            dropZone.addEventListener('click', (e) => {
                if (e.target.tagName !== 'LABEL') {
                    fileInput.click();
                }
            });

            function updateFileInfo(file) {
                const ext = file.name.split('.').pop().toLowerCase();
                if (['csv', 'txt', 'json'].includes(ext)) {
                    fileNameDisplay.innerHTML = `<div style="display:inline-flex; align-items:center; gap:0.3rem; margin-top:0.4rem; padding: 0.35rem 0.75rem; background: rgba(16,185,129,0.1); border-radius: 8px; border: 1px solid rgba(16,185,129,0.25);"><span style="color:#10b981; font-weight: 600;">✓ ${file.name}</span> <span style="font-size:0.7rem; color:var(--gray-400);">(${Math.round(file.size / 1024)} KB)</span></div>`;
                } else {
                    fileNameDisplay.innerHTML = `<div style="display:inline-flex; align-items:center; gap:0.3rem; margin-top:0.4rem; padding: 0.35rem 0.75rem; background: rgba(239,68,68,0.1); border-radius: 8px; border: 1px solid rgba(239,68,68,0.25);"><span style="color:#ef4444; font-weight: 600;">⚠️ Invalid file type. Use CSV, TXT or JSON.</span></div>`;
                    fileInput.value = '';
                }
            }
        });
    </script>
@endsection
