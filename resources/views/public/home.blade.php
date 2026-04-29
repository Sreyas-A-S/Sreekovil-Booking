@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 hero-gradient"
            style="background-image: linear-gradient(to bottom, rgba(255, 153, 51, 0.6), rgba(230, 92, 0, 0.85)), url('{{ asset('assets/hero-bg.png') }}');">
        </div>
        <div class="absolute inset-0 mandala-overlay opacity-50 mix-blend-overlay"></div>

        <div class="relative z-30 max-w-7xl mx-auto px-6 text-center animate-fade-in">
            <div class="flex flex-col items-center gap-6">
                <span
                    class="inline-block px-6 py-2 rounded-full glass border border-gold-500/30 text-gold-400 font-bold text-xs uppercase tracking-[0.4em] mb-4">
                    The Sacred Journey
                </span>
                <h1
                    class="text-6xl md:text-8xl font-black text-white font-display uppercase tracking-tighter leading-tight">
                    Embrace the <br>
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-saffron-400 via-gold-500 to-saffron-500">Divine
                        Wisdom</span>
                </h1>
                <!-- Search Bar -->
                <div class="w-full max-w-3xl mt-6 animate-slide-up relative z-30" style="animation-delay: 0.4s">
                    <form action="{{ route('public.temple.index') }}" method="GET" class="relative group">
                        <div
                            class="absolute inset-0 bg-saffron-500/20 blur-2xl group-hover:bg-saffron-500/30 transition-all duration-500 rounded-full">
                        </div>
                        <div
                            class="relative flex items-center p-2 bg-white/10 backdrop-blur-3xl border border-white/20 rounded-full shadow-2xl overflow-hidden group-focus-within:border-saffron-500/50 transition-all">
                            <input type="text" name="search" autocomplete="off"
                                placeholder="Search temples, hotels, or sacred places..."
                                class="search-input-suggest flex-1 bg-transparent border-0 text-white placeholder-white/40 focus:ring-0 focus:outline-none outline-none px-8 py-4 text-base md:text-lg font-medium ring-0">
                            <button type="submit"
                                class="px-10 py-4 saffron-gradient text-white font-bold rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all text-xs uppercase tracking-widest">
                                Search
                            </button>
                        </div>
                    </form>

                    <div class="flex flex-wrap justify-center gap-4 mt-6">
                        <span class="text-[10px] text-white/40 font-bold uppercase tracking-widest py-1">Quick
                            Search:</span>
                        <a href="{{ route('public.temple.index', ['search' => 'luxury']) }}"
                            class="text-[10px] text-saffron-200/60 hover:text-saffron-400 font-bold uppercase tracking-widest transition-colors">Luxury
                            Stays</a>
                        <a href="{{ route('public.temple.index', ['search' => 'sanctuary']) }}"
                            class="text-[10px] text-saffron-200/60 hover:text-saffron-400 font-bold uppercase tracking-widest transition-colors">Quiet
                            Sanctuaries</a>
                        <a href="{{ route('public.temple.index', ['search' => 'ancient']) }}"
                            class="text-[10px] text-saffron-200/60 hover:text-saffron-400 font-bold uppercase tracking-widest transition-colors">Ancient
                            Shrines</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Icons -->
        <div class="absolute bottom-20 left-10 md:left-20 animate-float opacity-30 text-gold-500 hidden md:block">
            <i data-lucide="sun" class="w-20 h-20"></i>
        </div>
        <div class="absolute top-40 right-20 animate-float opacity-20 text-saffron-500 hidden md:block"
            style="animation-delay: 2s">
            <i data-lucide="sparkles" class="w-32 h-32"></i>
        </div>
    </section>

    @if($homepageSong)
        <script>
            window.addEventListener('click', function () {
                if (window.playGlobalSong) {
                    window.playGlobalSong("{{ asset('storage/' . $homepageSong->file_path) }}", "{{ addslashes($homepageSong->title) }}", "{{ addslashes($homepageSong->singer ?? 'Unknown Artist') }}");
                }
            }, { once: true });
        </script>
    @endif

    <!-- Stats / Highlights -->
    <section
        class="bg-orange-900/95 backdrop-blur-2xl mx-6 md:mx-auto max-w-6xl -mt-24 relative z-20 rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 overflow-hidden min-h-[180px] flex items-center justify-center">
        @if($heroStatsMode === 'image' && $heroStatsImage)
            <img src="{{ asset('storage/' . $heroStatsImage) }}" class="w-full h-full object-cover animate-fade-in" alt="Hero Highlights">
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 px-12 py-12 w-full animate-fade-in">
                <div
                    class="text-center space-y-3 border-r border-white/10 last:border-0 hover:scale-105 transition-transform duration-500">
                    <p class="text-5xl font-black text-saffron-400 font-display italic">{{ $statsTemples }}</p>
                    <p class="text-[11px] text-maroon-200 uppercase font-black tracking-[0.3em]">Divine Temples</p>
                </div>
                <div
                    class="text-center space-y-3 border-r border-white/10 last:border-0 hover:scale-105 transition-transform duration-500">
                    <p class="text-5xl font-black text-saffron-400 font-display italic">{{ $statsHotels }}</p>
                    <p class="text-[11px] text-orange-200 uppercase font-black tracking-[0.3em]">Luxury Stays</p>
                </div>
                <div
                    class="text-center space-y-3 border-r border-white/10 last:border-0 hover:scale-105 transition-transform duration-500">
                    <p class="text-5xl font-black text-saffron-400 font-display italic">{{ $statsDevotees }}</p>
                    <p class="text-[11px] text-orange-200 uppercase font-black tracking-[0.3em]">Happy Devotees</p>
                </div>
                <div class="text-center space-y-3 last:border-0 hover:scale-105 transition-transform duration-500">
                    <p class="text-5xl font-black text-saffron-400 font-display italic">{{ $statsSupport }}</p>
                    <p class="text-[11px] text-orange-200 uppercase font-black tracking-[0.3em]">Sacred Support</p>
                </div>
            </div>
        @endif
    </section>

    <!-- Temples Listing -->
    <section id="temples" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col items-center text-center space-y-4 mb-20">
                <p class="text-saffron-600 font-bold text-xs uppercase tracking-[0.4em]">Sacred Sanctuaries</p>
                <h2 class="text-4xl md:text-5xl font-black text-orange-950 font-display uppercase tracking-widest">Featured
                    Shrines</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($temples as $temple)
                    <a href="{{ route('public.temple.show', $temple) }}"
                        class="group relative bg-white rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-700 animate-slide-up border border-slate-100">
                        <div class="aspect-video relative overflow-hidden">
                            @if($temple->photos && count($temple->photos) > 0)
                                <img src="{{ str_starts_with($temple->photos[0], 'http') ? $temple->photos[0] : (str_starts_with($temple->photos[0], 'assets/') ? asset($temple->photos[0]) : asset('storage/' . $temple->photos[0])) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <i data-lucide="image" class="w-12 h-12 text-slate-300"></i>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-maroon-950/90 via-maroon-950/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity">
                            </div>

                            <!-- Location Tag -->
                            <div
                                class="absolute top-6 left-6 px-4 py-2 rounded-full glass border border-white/20 text-white text-[10px] font-bold uppercase tracking-widest flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-3 h-3 text-saffron-400"></i>
                                {{ $temple->location }}
                            </div>
                        </div>

                        <div class="p-6 relative -mt-8">
                            <div class="bg-white rounded-3xl p-5 shadow-xl space-y-3 border border-slate-50 relative z-10">
                                <div class="flex justify-between items-start gap-4">
                                    <h3
                                        class="text-2xl font-bold font-display text-orange-950 group-hover:text-saffron-600 transition-colors uppercase leading-tight">
                                        {{ $temple->name }}
                                    </h3>
                                    <div
                                        class="w-10 h-10 rounded-full bg-saffron-50 text-saffron-600 flex items-center justify-center shrink-0">
                                        <i data-lucide="arrow-up-right"
                                            class="w-5 h-5 group-hover:rotate-45 transition-transform"></i>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center gap-4 text-xs font-bold text-slate-500 uppercase tracking-widest pt-4 border-t border-slate-100">
                                    <span class="flex items-center gap-2">
                                        <i data-lucide="hotel" class="w-4 h-4 text-gold-500"></i>
                                        {{ count($temple->hotels) }} Stays Nearby
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-20 text-center">
                <a href="{{ route('public.temple.index') }}"
                    class="group inline-flex items-center gap-4 px-12 py-5 rounded-2xl border-2 border-maroon-900 text-maroon-900 font-bold text-sm uppercase tracking-widest hover:bg-maroon-900 hover:text-white transition-all duration-500 shadow-xl hover:shadow-maroon-900/20">
                    Discover More Shrines
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-32 relative overflow-hidden bg-maroon-900">
        <div class="absolute inset-0 mandala-overlay opacity-10 pointer-events-none scale-150 rotate-45"></div>
        <div class="max-w-5xl mx-auto px-6 text-center relative z-10 space-y-8">
            <h2 class="text-4xl md:text-6xl font-black text-white font-display uppercase tracking-widest leading-tight">
                Ready to Begin <br>
                <span class="text-saffron-500 italic">Your Pilgrimage?</span>
            </h2>
            <p class="text-maroon-200/60 text-lg max-w-2xl mx-auto font-medium">
                Join thousands of devotees who have found peace and comfort on their journey through Sreekovil.
            </p>
            <div class="pt-6">
                <a href="#"
                    class="inline-flex items-center gap-4 px-12 py-5 rounded-2xl bg-white text-maroon-900 font-bold uppercase tracking-widest hover:bg-saffron-400 hover:text-white transition-all duration-500 group">
                    Plan Your Stay
                    <i data-lucide="sparkles" class="w-5 h-5 group-hover:scale-125 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>
@endsection