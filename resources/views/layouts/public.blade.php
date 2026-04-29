<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sreekovil - Divine Pilgrimage Portal')</title>

    <!-- Divine Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Outfit:wght@300;400;600;700;900&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/sreekovil-white-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-orange: #ff9933;
            --deep-orange: #e65c00;
            --light-saffron: #ffcc66;
            --gold-500: #d4af37;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-body {
            font-family: 'Outfit', sans-serif;
        }

        .saffron-gradient {
            background: linear-gradient(135deg, #ffcc66 0%, #ff9933 100%);
        }

        .mandala-overlay {
            background-image: url("/assets/mandala.png");
            background-size: 800px;
            background-repeat: repeat;
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slide-up 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Preloader Styles */
        #preloader {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #fffcf5 0%, #fff0e0 100%);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.8s;
            overflow: hidden;
        }

        #preloader::before {
            content: '';
            position: absolute;
            inset: -100%;
            background-image: url("/assets/mandala.png");
            background-size: 800px;
            background-repeat: repeat;
            opacity: 0.04;
            animation: rotate-slow 120s linear infinite;
            pointer-events: none;
        }

        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        #preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .preloader-content {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            z-index: 10;
        }

        .preloader-logo {
            height: 80px;
            width: auto;
            animation: pulse-logo 3s ease-in-out infinite;
            filter: drop-shadow(0 10px 30px rgba(255, 153, 51, 0.2));
        }

        @keyframes pulse-logo {
            0%, 100% {
                transform: scale(1);
                filter: drop-shadow(0 10px 30px rgba(255, 153, 51, 0.15));
            }
            50% {
                transform: scale(1.05);
                filter: drop-shadow(0 20px 50px rgba(255, 153, 51, 0.3));
            }
        }
    </style>
</head>

<body class="bg-slate-50 font-body text-slate-900 overflow-x-hidden">
    <!-- Divine Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <img src="{{ asset('assets/logo.png') }}" alt="Sreekovil" class="preloader-logo">
            <div class="w-12 h-0.5 bg-saffron-500/20 rounded-full relative overflow-hidden">
                <div class="absolute inset-0 bg-saffron-500 w-1/2 animate-[loading_2s_ease-in-out_infinite]"></div>
            </div>
        </div>
    </div>

    <style>
        @keyframes loading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(200%); }
        }
    </style>
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-[100] transition-all duration-500 py-6" id="main-nav">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('assets/sreekovil-white-logo.png') }}" alt="Sreekovil"
                    class="h-10 md:h-14 w-auto drop-shadow-xl group-hover:scale-105 transition-transform duration-500">
            </a>

            <div class="hidden md:flex items-center gap-10">
                <a href="/"
                    class="text-white/80 hover:text-saffron-400 font-bold text-sm uppercase tracking-widest transition-colors font-body">Home</a>
                <a href="{{ route('public.temple.index') }}"
                    class="text-white/80 hover:text-saffron-400 font-bold text-sm uppercase tracking-widest transition-colors font-body">Temples</a>
                <a href="#"
                    class="text-white/80 hover:text-saffron-400 font-bold text-sm uppercase tracking-widest transition-colors">Bookings</a>
            </div>

            <button class="md:hidden text-white">
                <i data-lucide="menu" class="w-8 h-8"></i>
            </button>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-orange-900 text-white pt-20 pb-10 relative overflow-hidden">
        <div class="absolute inset-0 mandala-overlay opacity-20 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-16 border-b border-white/10">
                <div class="col-span-1 md:col-span-2 space-y-6">
                    <a href="/" class="flex items-center gap-3">
                        <img src="{{ asset('assets/sreekovil-white-logo.png') }}" alt="Sreekovil" class="h-14 w-auto">
                    </a>
                    <p class="text-orange-100/60 leading-relaxed max-w-md italic">
                        Experience the divine tranquility and spiritual awakening. Sreekovil connects you with the most
                        sacred temples and luxury stays, ensuring your pilgrimage is as comfortable as it is holy.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" target="_blank"
                            class="w-10 h-10 rounded-full glass flex items-center justify-center hover:bg-saffron-500 transition-all hover:scale-110">
                            <i data-lucide="instagram" class="w-5 h-5 text-white"></i>
                        </a>
                        <a href="#" target="_blank"
                            class="w-10 h-10 rounded-full glass flex items-center justify-center hover:bg-saffron-500 transition-all hover:scale-110">
                            <i data-lucide="facebook" class="w-5 h-5 text-white"></i>
                        </a>
                        <a href="#" target="_blank"
                            class="w-10 h-10 rounded-full glass flex items-center justify-center hover:bg-saffron-500 transition-all hover:scale-110">
                            <i data-lucide="twitter" class="w-5 h-5 text-white"></i>
                        </a>
                    </div>
                </div>

                <div class="space-y-6">
                    <h4 class="text-lg font-bold font-display uppercase tracking-widest text-saffron-400">Quick Links
                    </h4>
                    <ul class="space-y-4 text-orange-200/60 text-sm">
                        <li><a href="{{ route('public.temple.index') }}"
                                class="hover:text-saffron-400 transition-colors">Our Temples</a></li>
                        <li><a href="#" class="hover:text-saffron-400 transition-colors">Stay Experiences</a></li>
                        <li><a href="#" class="hover:text-saffron-400 transition-colors">About Journey</a></li>
                        <li><a href="#" class="hover:text-saffron-400 transition-colors">Contact Us</a></li>
                    </ul>
                </div>

                <div class="space-y-6">
                    <h4 class="text-lg font-bold font-display uppercase tracking-widest text-saffron-400">Contact
                        Support</h4>
                    <ul class="space-y-4 text-orange-200/60 text-sm">
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-4 h-4 text-gold-500"></i>
                            +91 1800 234 5678
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-4 h-4 text-gold-500"></i>
                            divine@sreekovil.com
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="pt-10 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] text-orange-200/30 uppercase tracking-[0.2em] font-bold">
                <p>&copy; 2026 Sreekovil Divine Travels. All rights reserved.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-saffron-400 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-saffron-400 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Icons -->
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.435.0/dist/umd/lucide.min.js"></script>
    <script>
        // Preloader Logic
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.classList.add('fade-out');
            }, 500); // Small delay for the "wow" effect
        });

        // Lucide implementation with robust loading
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });

        // Fallback for cases where script might load after DOMContentLoaded
        window.addEventListener('load', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('main-nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-orange-950/90', 'backdrop-blur-xl', 'py-4', 'shadow-2xl');
                nav.classList.remove('py-6');
            } else {
                nav.classList.remove('bg-orange-950/90', 'backdrop-blur-xl', 'py-4', 'shadow-2xl');
                nav.classList.add('py-6');
            }
        });

        // Search Suggestions Implementation
        const searchInputs = document.querySelectorAll('.search-input-suggest');

        searchInputs.forEach(input => {
            const container = input.closest('form');
            if (!container) return;

            const suggestionsDiv = document.createElement('div');
            suggestionsDiv.className = 'absolute top-full left-0 right-0 mt-4 bg-white/95 backdrop-blur-xl rounded-[2.5rem] shadow-[0_30px_100px_rgba(0,0,0,0.1),0_10px_40px_rgba(255,153,51,0.05)] border border-orange-100/50 overflow-hidden z-[200] opacity-0 translate-y-4 pointer-events-none transition-all duration-300';
            suggestionsDiv.id = 'search-suggestions-' + Math.random().toString(36).substr(2, 9);
            container.appendChild(suggestionsDiv);

            let timeout = null;

            input.addEventListener('input', (e) => {
                clearTimeout(timeout);
                const query = e.target.value.trim();

                if (query.length < 2) {
                    hideSuggestions(suggestionsDiv);
                    return;
                }

                timeout = setTimeout(async () => {
                    renderLoading(suggestionsDiv);
                    showSuggestions(suggestionsDiv);

                    try {
                        const response = await fetch(`{{ route('public.search.suggestions') }}?query=${encodeURIComponent(query)}`);
                        const suggestions = await response.json();

                        if (suggestions.length > 0) {
                            renderSuggestions(suggestionsDiv, suggestions);
                        } else {
                            renderNoResults(suggestionsDiv);
                        }
                    } catch (error) {
                        console.error('Suggestions error:', error);
                        hideSuggestions(suggestionsDiv);
                    }
                }, 300);
            });

            // Hide when clicking outside
            document.addEventListener('click', (e) => {
                if (!container.contains(e.target)) {
                    hideSuggestions(suggestionsDiv);
                }
            });
        });

        function renderLoading(div) {
            div.innerHTML = `
                <div class="px-6 py-12 text-center space-y-4">
                    <div class="relative w-16 h-16 mx-auto">
                        <div class="absolute inset-0 rounded-full border-4 border-orange-50"></div>
                        <div class="absolute inset-0 rounded-full border-4 border-t-saffron-500 animate-spin"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i data-lucide="sparkles" class="w-6 h-6 text-saffron-500 animate-pulse"></i>
                        </div>
                    </div>
                    <p class="text-[9px] text-orange-400 font-black uppercase tracking-[0.4em] animate-pulse">Seeking Divine Connections...</p>
                </div>
            `;
            if (window.lucide) {
                lucide.createIcons();
            }
        }

        function renderNoResults(div) {
            div.innerHTML = `
                <div class="px-6 py-12 text-center space-y-4">
                    <div class="w-16 h-16 rounded-3xl bg-orange-50 flex items-center justify-center mx-auto text-orange-200">
                        <i data-lucide="search-x" class="w-8 h-8"></i>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-bold text-orange-950 uppercase tracking-widest">No Sacred Matches</p>
                        <p class="text-[10px] text-orange-400 font-medium italic">Try searching for other temples or cities</p>
                    </div>
                </div>
            `;
            if (window.lucide) {
                lucide.createIcons();
            }
        }

        function renderSuggestions(div, data) {
            div.innerHTML = data.map(item => `
                <a href="${item.url}" class="group flex items-center gap-4 px-6 py-4 hover:bg-orange-50/50 transition-all border-b border-orange-50 last:border-0">
                    <div class="w-14 h-14 rounded-2xl overflow-hidden shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                        ${item.image ? 
                            `<img src="${item.image}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">` :
                            `<div class="w-full h-full ${item.type === 'temple' ? 'bg-saffron-50 text-saffron-600' : 'bg-gold-50 text-gold-600'} flex items-center justify-center">
                                <i data-lucide="${item.type === 'temple' ? 'sun' : 'hotel'}" class="w-6 h-6"></i>
                            </div>`
                        }
                    </div>
                    <div class="flex-1 min-w-0 text-left">
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded-md ${item.type === 'temple' ? 'bg-saffron-100 text-saffron-700' : 'bg-gold-100 text-gold-700'}">${item.type}</span>
                        </div>
                        <h5 class="text-sm font-bold text-orange-950 group-hover:text-saffron-600 transition-colors truncate">${item.title}</h5>
                        <p class="text-[10px] text-orange-400 font-medium uppercase tracking-widest truncate">${item.subtitle}</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-saffron-600"></i>
                    </div>
                </a>
            `).join('');

            if (window.lucide) {
                lucide.createIcons();
            }
        }

        function showSuggestions(div) {
            div.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
            div.classList.add('opacity-100', 'translate-y-0');
        }

        function hideSuggestions(div) {
            div.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
            div.classList.remove('opacity-100', 'translate-y-0');
        }
    </script>
</body>

</html>