<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cinzel:wght@400;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-display {
            font-family: 'Cinzel', serif;
        }

        .sidebar-pattern {
            background:
                radial-gradient(circle at 1px 1px, rgba(231, 192, 51, 0.1) 1px, transparent 0),
                linear-gradient(180deg, #5c0f12 0%, #31080a 100%);
            background-size: 24px 24px, 100% 100%;
        }

        .content-watermark {
            background:
                linear-gradient(rgba(244, 245, 247, 0.92), rgba(244, 245, 247, 0.92)),
                url('{{ asset('images/gold-pattern-clean.png') }}');
            background-size: cover, 1400px;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-saffron-50/30 text-slate-900">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside
            class="w-64 sidebar-pattern text-white hidden md:flex flex-col sticky top-0 h-screen shadow-2xl border-r border-maroon-800">
            <div class="p-6 border-b border-maroon-800/50">
                <h1 class="text-xl font-bold tracking-tight flex items-center gap-3 font-display">
                    <i data-lucide="sun" class="w-8 h-8 text-gold-500"></i>
                    <span class="text-white">Sreekovil</span>
                </h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-saffron-500/10 text-saffron-100 border-l-4 border-gold-500' : 'text-saffron-200/50 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span class="font-bold tracking-wide">Dashboard</span>
                </a>
                <a href="{{ route('admin.temples.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.temples.*') ? 'bg-saffron-500/10 text-saffron-100 border-l-4 border-gold-500' : 'text-saffron-200/50 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                    <span class="font-bold tracking-wide">Temples</span>
                </a>
                <a href="{{ route('admin.hotels.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.hotels.*') ? 'bg-saffron-500/10 text-saffron-100 border-l-4 border-gold-500' : 'text-saffron-200/50 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="hotel" class="w-5 h-5"></i>
                    <span class="font-bold tracking-wide">Hotels</span>
                </a>
                <a href="{{ route('admin.songs.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.songs.*') ? 'bg-saffron-500/10 text-saffron-100 border-l-4 border-gold-500' : 'text-saffron-200/50 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="music" class="w-5 h-5"></i>
                    <span class="font-bold tracking-wide">Playlist</span>
                </a>
                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.settings.*') ? 'bg-saffron-500/10 text-saffron-100 border-l-4 border-gold-500' : 'text-saffron-200/50 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    <span class="font-bold tracking-wide">Settings</span>
                </a>
            </nav>

            <div class="p-4 border-t border-maroon-800/50">
                <form method="POST" action="{{ route('logout') }}"
                    onsubmit="return confirm('Are you sure you want to log out?')">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 px-4 py-3 w-full text-left rounded-xl text-saffron-200/50 hover:bg-red-950/30 hover:text-red-400 transition-all">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Header -->
        <div
            class="md:hidden fixed top-0 left-0 right-0 sidebar-pattern text-white p-4 flex justify-between items-center z-50 shadow-lg border-b border-maroon-800">
            <div class="flex items-center gap-2">
                <i data-lucide="sun" class="w-6 h-6 text-gold-500"></i>
                <h1 class="text-lg font-bold font-display uppercase tracking-wider">Sreekovil</h1>
            </div>
            <button id="mobile-menu-button" class="p-2 text-saffron-100 hover:text-white transition-colors">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Content -->
        <main class="flex-1 flex flex-col min-w-0 content-watermark">
            <header
                class="bg-white/95 backdrop-blur-sm border-b border-maroon-900/10 p-6 flex justify-between items-center mt-14 md:mt-0 sticky top-0 z-40">
                <h2 class="text-2xl font-bold text-maroon-900 font-display uppercase tracking-[0.1em]">@yield('header')
                </h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-maroon-800/60 font-medium hidden sm:block italic">Welcome,
                        {{ Auth::user()->name }}</span>
                    <div class="relative">
                        <button id="profile-dropdown-button"
                            class="w-10 h-10 rounded-full bg-saffron-100 text-saffron-700 flex items-center justify-center font-bold focus:outline-none focus:ring-2 focus:ring-saffron-500 transition-all hover:bg-saffron-200 shadow-sm border border-saffron-200">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </button>

                        <div id="profile-dropdown-menu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-200 z-50 overflow-hidden transform origin-top-right">
                            <div class="p-2">
                                <a href="{{ route('admin.profile.edit') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 rounded-lg transition-colors">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                    Profile
                                </a>
                                <div class="my-1 border-t border-slate-100"></div>
                                <form method="POST" action="{{ route('logout') }}"
                                    onsubmit="return confirm('Are you sure you want to log out?')">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <i data-lucide="log-out" class="w-4 h-4"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-6 lg:p-8">
                @if(session('success'))
                    <div
                        class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Reusable Modal -->
    <div id="crud-modal" class="hidden fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-4 text-center sm:block sm:p-0">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/40 transition-opacity" aria-hidden="true" onclick="closeModal()">
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Content -->
            <div
                class="relative z-50 inline-block align-bottom bg-white rounded-3xl text-left shadow-2xl transform transition-all sm:my-8 sm:align-middle w-full max-w-md sm:max-w-lg border border-saffron-100 mx-auto">
                <div class="p-6 border-b border-saffron-100 flex justify-between items-center bg-saffron-50/30">
                    <h3 id="modal-title" class="text-xl font-bold text-maroon-900 font-display"></h3>
                    <button type="button" onclick="closeModal()"
                        class="p-2 -mr-2 text-maroon-400 hover:text-maroon-600 transition-colors rounded-full hover:bg-maroon-50">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <div id="modal-content" class="p-6">
                    <!-- Form content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Image Lightbox Modal -->
    <div id="image-lightbox"
        class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-maroon-950/90 backdrop-blur-md transition-all duration-300 opacity-0"
        onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors">
            <i data-lucide="x" class="w-10 h-10"></i>
        </button>
        <img id="lightbox-img" src=""
            class="max-w-[95vw] max-h-[90vh] rounded-2xl shadow-2xl transition-transform duration-500 scale-90">
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsmediatags/3.9.5/jsmediatags.min.js"></script>
    <script>
        function handleSongFileSelect(input) {
            if (!input.files || !input.files[0]) return;

            const file = input.files[0];
            console.log('File selected:', file.name);

            const fileNameDisplay = document.getElementById('file-name');
            if (fileNameDisplay) {
                fileNameDisplay.innerText = file.name;
                fileNameDisplay.classList.add('text-saffron-600', 'font-bold');
            }

            // Set default title from filename (clean version)
            const defaultTitle = file.name.replace(/\.[^/.]+$/, "").replace(/[_-]/g, ' ');
            if (document.getElementById('title') && !document.getElementById('title').value) {
                document.getElementById('title').value = defaultTitle;
            }

            // Fetch Metadata
            if (typeof jsmediatags !== 'undefined') {
                console.log('Reading metadata...');
                jsmediatags.read(file, {
                    onSuccess: function (tag) {
                        console.log('Metadata found:', tag.tags);
                        const tags = tag.tags;
                        if (tags.title && document.getElementById('title')) document.getElementById('title').value = tags.title;
                        if (tags.artist && document.getElementById('singer')) document.getElementById('singer').value = tags.artist;
                        if (tags.album && document.getElementById('album')) document.getElementById('album').value = tags.album;
                        if (tags.composer && document.getElementById('author')) document.getElementById('author').value = tags.composer;
                    },
                    onError: function (error) {
                        console.error('Error reading tags:', error);
                    }
                });
            } else {
                console.warn('jsmediatags library not loaded!');
            }
        }

        function viewFullscreen(src) {
            const lightbox = document.getElementById('image-lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lightbox.classList.remove('hidden');
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
                img.classList.remove('scale-90');
                img.classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        }

        function closeLightbox() {
            const lightbox = document.getElementById('image-lightbox');
            const img = document.getElementById('lightbox-img');
            lightbox.classList.add('opacity-0');
            img.classList.add('scale-90');
            setTimeout(() => {
                lightbox.classList.add('hidden');
            }, 300);
            document.body.style.overflow = 'auto';
        }

        lucide.createIcons();

        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.querySelector('aside');
        if (mobileMenuButton && sidebar) {
            mobileMenuButton.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('fixed');
                sidebar.classList.toggle('inset-0');
                sidebar.classList.toggle('z-[100]');
                sidebar.classList.toggle('flex');
            });
        }

        // Modal Functions
        async function openModal(url, title) {
            const modal = document.getElementById('crud-modal');
            const titleEl = document.getElementById('modal-title');
            const contentEl = document.getElementById('modal-content');

            if (titleEl) titleEl.innerText = title;
            if (contentEl) contentEl.innerHTML = '<div class="flex justify-center p-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-maroon-900"></div></div>';

            if (modal) modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const html = await response.text();
                if (contentEl) contentEl.innerHTML = html;
                lucide.createIcons();
            } catch (error) {
                if (contentEl) contentEl.innerHTML = '<p class="text-red-500 p-8 text-center text-sm font-bold">Failed to load content.</p>';
            }
        }

        function closeModal() {
            // Hide all modals
            const modals = document.querySelectorAll('.fixed.inset-0[role="dialog"], #crud-modal');
            modals.forEach(m => m.classList.add('hidden'));
            document.body.style.overflow = 'auto';
        }

        // Close modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        // Photo Management Helpers
        function markForDeletion(index, path, containerId, elementIdPrefix) {
            if (confirm('Are you sure you want to remove this photo?')) {
                const el = document.getElementById(elementIdPrefix + index);
                if (el) el.classList.add('hidden');

                const container = document.getElementById(containerId);
                if (container) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'remove_photos[]';
                    input.value = path;
                    container.appendChild(input);
                }
            }
        }

        // Aliases for compatibility
        function markHotelPhotoForDeletion(index, path) {
            markForDeletion(index, path, 'hotel-deleted-photos-container', 'hotel-photo-');
        }
        function markTemplePhotoForDeletion(index, path) {
            markForDeletion(index, path, 'temple-deleted-photos-container', 'temple-photo-');
        }

        function updateFileList(input, listId) {
            const list = document.getElementById(listId);
            if (!list) return;
            list.innerHTML = '';

            if (input.files.length > 0) {
                Array.from(input.files).forEach(file => {
                    const span = document.createElement('span');
                    span.className = 'px-3 py-1 bg-maroon-50 text-maroon-900 text-xs font-bold rounded-lg border border-maroon-100 flex items-center gap-2';
                    span.innerHTML = `<i data-lucide="file-image" class="w-3 h-3"></i> ${file.name}`;
                    list.appendChild(span);
                });
                if (window.lucide) window.lucide.createIcons();
            }
        }

        // AJAX Form Submission Helper
        async function submitForm(form, successCallback) {
            // Find submit button
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnContent = submitBtn ? submitBtn.innerHTML : '';

            // Clear previous errors
            form.querySelectorAll('.error-message').forEach(el => el.remove());
            form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));

            // Show loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <div class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Processing...</span>
                    </div>
                `;
            }

            const formData = new FormData(form);
            const url = form.action;
            const method = formData.get('_method') || form.method;

            try {
                const response = await fetch(url, {
                    method: method === 'GET' ? 'GET' : 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    closeModal();
                    if (successCallback) successCallback(data);

                    // Optional: Show a quick toast or alert if no redirect happened
                    if (!data.redirect) {
                        alert(data.message || 'Action successful!');
                    }
                } else {
                    // Restore button state
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnContent;
                    }

                    // Handle validation errors
                    const errors = data.errors;
                    if (errors) {
                        Object.keys(errors).forEach(field => {
                            const input = form.querySelector(`[name="${field}"]`) ||
                                form.querySelector(`[name="${field}[]"]`);
                            if (input) {
                                const errorMsg = document.createElement('p');
                                errorMsg.className = 'text-red-500 text-xs mt-1 error-message';
                                errorMsg.innerText = errors[field][0];

                                const container = input.closest('.space-y-2') || input.parentElement;
                                container.appendChild(errorMsg);
                                input.classList.add('border-red-500');
                            }
                        });
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                // Restore button state on network error
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnContent;
                }
                alert('An unexpected error occurred. Please try again.');
            }
        }

        // Profile Dropdown Toggle
        const profileButton = document.getElementById('profile-dropdown-button');
        const profileMenu = document.getElementById('profile-dropdown-menu');

        if (profileButton && profileMenu) {
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!profileMenu.contains(e.target) && !profileButton.contains(e.target)) {
                    profileMenu.classList.add('hidden');
                }
            });
        }
    </script>

    <!-- Global Music Player -->
    <div id="global-player"
        class="fixed bottom-0 left-0 right-0 z-[60] bg-maroon-900/95 backdrop-blur-xl border-t border-gold-500/30 text-white transform translate-y-full transition-transform duration-500 shadow-[0_-10px_40px_rgba(0,0,0,0.4)]">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-6">
            <!-- Song Info -->
            <div class="flex items-center gap-4 w-1/4 min-w-0">
                <div
                    class="w-12 h-12 rounded-xl bg-gold-500/20 flex items-center justify-center text-gold-500 ring-1 ring-gold-500/30 shrink-0">
                    <i data-lucide="music" class="w-6 h-6"></i>
                </div>
                <div class="min-w-0 truncate">
                    <p id="player-song-title" class="text-sm font-bold truncate">No Song Selected</p>
                    <p id="player-song-artist" class="text-xs text-saffron-300 truncate">Unknown Artist</p>
                </div>
            </div>

            <!-- Controls -->
            <div class="flex-1 max-w-2xl">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center justify-center gap-6 mb-1">
                        <button class="text-gold-500/50 hover:text-gold-500 hover:scale-110 transition-all">
                            <i data-lucide="skip-back" class="w-5 h-5"></i>
                        </button>
                        <button id="player-play-pause"
                            class="w-11 h-11 rounded-full bg-gold-500 text-maroon-900 flex items-center justify-center hover:bg-gold-400 transition-all shadow-lg active:scale-95 group"
                            onclick="togglePlayPause()">
                            <i data-lucide="play" id="play-icon" class="w-5 h-5 fill-current ml-0.5"></i>
                            <i data-lucide="pause" id="pause-icon" class="w-5 h-5 fill-current hidden"></i>
                            <div id="player-loader" class="hidden">
                                <svg class="animate-spin h-5 w-5 text-maroon-900" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                        </button>
                        <button class="text-gold-500/50 hover:text-gold-500 hover:scale-110 transition-all">
                            <i data-lucide="skip-forward" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <div class="flex items-center gap-3">
                        <span id="player-current-time"
                            class="text-[10px] font-mono text-gold-500/50 w-10 text-right">0:00</span>
                        <div class="flex-1 h-1.5 bg-maroon-800 rounded-full cursor-pointer relative group/progress"
                            onclick="seekSong(event)">
                            <div id="player-progress"
                                class="absolute top-0 left-0 h-full bg-gradient-to-r from-gold-600 to-saffron-400 rounded-full w-0 transition-all">
                            </div>
                            <div id="player-handle"
                                class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 h-3.5 w-3.5 bg-white rounded-full shadow-md opacity-0 group-hover/progress:opacity-100 transition-opacity"
                                style="left: 0%"></div>
                        </div>
                        <span id="player-duration" class="text-[10px] font-mono text-gold-500/50 w-10">0:00</span>
                    </div>
                </div>
            </div>

            <!-- Volume -->
            <div class="w-1/4 flex items-center justify-end gap-3 text-gold-500/50">
                <i data-lucide="volume-2" class="w-4 h-4"></i>
                <input type="range"
                    class="w-24 h-1 bg-maroon-800 rounded-full appearance-none cursor-pointer accent-gold-500" min="0"
                    max="1" step="0.01" value="1" oninput="setPlayerVolume(this.value)">
                <button onclick="hidePlayer()" class="ml-4 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </div>
    <audio id="global-audio-element" class="hidden"></audio>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsmediatags/3.9.5/jsmediatags.min.js"></script>
    <script>
        // Global Music Player Logic
        const globalAudio = document.getElementById('global-audio-element');
        const globalPlayer = document.getElementById('global-player');
        let currentLoadingBtn = null;

        function playGlobalSong(src, title, artist, btn = null) {
            if (globalAudio.src === src && !globalAudio.paused) {
                togglePlayPause();
                return;
            }
            if (globalAudio.src === src && globalAudio.paused) {
                globalAudio.play();
                updatePlayerState(true);
                return;
            }

            if (currentLoadingBtn) resetBtnLoading(currentLoadingBtn);
            if (btn) setBtnLoading(btn);

            globalAudio.src = src;
            document.getElementById('player-song-title').innerText = title;
            document.getElementById('player-song-artist').innerText = artist || 'Unknown Artist';

            globalPlayer.classList.remove('translate-y-full');
            setPlayerLoading(true);
            globalAudio.play();
            updatePlayerState(true);
        }

        function togglePlayPause() {
            if (globalAudio.paused) {
                globalAudio.play();
                updatePlayerState(true);
            } else {
                globalAudio.pause();
                updatePlayerState(false);
            }
        }

        function updatePlayerState(isPlaying) {
            const playIcon = document.getElementById('play-icon');
            const pauseIcon = document.getElementById('pause-icon');
            if (playIcon && pauseIcon) {
                playIcon.classList.toggle('hidden', isPlaying);
                pauseIcon.classList.toggle('hidden', !isPlaying);
            }
            if (window.lucide) lucide.createIcons();
        }

        function setPlayerLoading(loading) {
            const loader = document.getElementById('player-loader');
            const playIcon = document.getElementById('play-icon');
            const pauseIcon = document.getElementById('pause-icon');
            if (loader) loader.classList.toggle('hidden', !loading);
            if (loading) {
                if (playIcon) playIcon.classList.add('hidden');
                if (pauseIcon) pauseIcon.classList.add('hidden');
            } else {
                updatePlayerState(!globalAudio.paused);
            }
        }

        function setBtnLoading(btn) {
            currentLoadingBtn = btn;
            const iconDiv = btn.querySelector('div');
            if (iconDiv) {
                btn.dataset.originalHtml = iconDiv.innerHTML;
                iconDiv.innerHTML = `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;
            }
        }

        function resetBtnLoading(btn) {
            const iconDiv = btn.querySelector('div');
            if (iconDiv && btn.dataset.originalHtml) {
                iconDiv.innerHTML = btn.dataset.originalHtml;
            }
            currentLoadingBtn = null;
        }

        if (globalAudio) {
            globalAudio.onwaiting = () => setPlayerLoading(true);
            globalAudio.onplaying = () => {
                setPlayerLoading(false);
                if (currentLoadingBtn) resetBtnLoading(currentLoadingBtn);
            };
            globalAudio.oncanplay = () => setPlayerLoading(false);

            globalAudio.ontimeupdate = function () {
                if (isNaN(globalAudio.duration)) return;
                const progress = (globalAudio.currentTime / globalAudio.duration) * 100;
                document.getElementById('player-progress').style.width = progress + '%';
                document.getElementById('player-handle').style.left = progress + '%';

                document.getElementById('player-current-time').innerText = formatAudioTime(globalAudio.currentTime);
                document.getElementById('player-duration').innerText = formatAudioTime(globalAudio.duration);
            };
        }

        function formatAudioTime(seconds) {
            const min = Math.floor(seconds / 60);
            const sec = Math.floor(seconds % 60);
            return min + ":" + (sec < 10 ? '0' : '') + sec;
        }

        function seekSong(event) {
            const rect = event.currentTarget.getBoundingClientRect();
            const pos = (event.clientX - rect.left) / rect.width;
            globalAudio.currentTime = pos * globalAudio.duration;
        }

        function setPlayerVolume(val) {
            globalAudio.volume = val;
        }

        function hidePlayer() {
            globalPlayer.classList.add('translate-y-full');
            globalAudio.pause();
        }
    </script>
</body>

</html>