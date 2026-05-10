@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[40vh] md:min-h-[45vh] overflow-hidden pt-16 pb-24">
        <div class="absolute inset-0 hero-gradient"
            style="background-image: linear-gradient(to bottom, #2d1005 0%, rgba(255, 153, 51, 0.8) 50%, rgba(230, 92, 0, 0.9) 100%), url('{{ asset('assets/hero-bg.png') }}');">
        </div>
        <div class="absolute inset-0 mandala-overlay opacity-50 mix-blend-overlay"></div>

        <div class="relative z-30 max-w-7xl mx-auto px-8 md:px-6 text-center animate-fade-in pt-10 pb-0">
            <div class="flex flex-col items-center gap-4">
                <!-- Chants Section -->
                @if(count($chants) > 0)
                    <div class="relative w-full min-h-[100px] flex flex-col items-center justify-center">
                        @foreach($chants as $index => $chant)
                            <div class="chant-item absolute inset-0 flex flex-col items-center justify-center transition-all duration-1000 opacity-0 transform translate-y-8 pointer-events-none" 
                                 data-index="{{ $index }}">
                                <h2 class="text-3xl md:text-5xl font-black text-white font-display uppercase tracking-[0.2em] leading-tight mb-2 drop-shadow-2xl">
                                    {{ $chant->text }}
                                </h2>
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-px bg-gradient-to-r from-transparent to-saffron-500/50"></div>
                                    <p class="text-saffron-400 font-bold text-xs md:text-sm uppercase tracking-[0.4em] italic opacity-80">
                                        {{ $chant->meaning }}
                                    </p>
                                    <div class="w-8 h-px bg-gradient-to-l from-transparent to-saffron-500/50"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const chants = document.querySelectorAll('.chant-item');
                            let current = 0;
                            
                            if (chants.length > 0) {
                                const showChant = (index) => {
                                    chants.forEach(c => {
                                        c.classList.remove('opacity-100', 'translate-y-0');
                                        c.classList.add('opacity-0', 'translate-y-8');
                                    });
                                    chants[index].classList.remove('opacity-0', 'translate-y-8');
                                    chants[index].classList.add('opacity-100', 'translate-y-0');
                                };
                                
                                showChant(0);
                                if (chants.length > 1) {
                                    setInterval(() => {
                                        current = (current + 1) % chants.length;
                                        showChant(current);
                                    }, 6000);
                                }
                            }
                        });
                    </script>
                @endif

                <!-- Search Bar -->
                <div class="w-full max-w-4xl animate-slide-up relative z-30">
                    <form action="{{ route('public.temple.index') }}" method="GET" class="relative group">
                        <div
                            class="absolute inset-0 bg-saffron-500/10 blur-3xl group-hover:bg-saffron-500/20 transition-all duration-500 rounded-full">
                        </div>
                        <div
                            class="relative flex items-center p-1.5 bg-white/10 backdrop-blur-3xl border border-white/20 rounded-full shadow-2xl overflow-hidden group-focus-within:border-saffron-500/50 transition-all">
                            <input type="text" name="search" autocomplete="off"
                                placeholder="Search temples, hotels, or sacred places..."
                                class="search-input-suggest flex-1 bg-transparent border-0 text-white placeholder-white/40 focus:ring-0 focus:outline-none outline-none px-6 md:px-8 py-3.5 md:py-4 text-sm md:text-lg font-medium ring-0">
                            <button type="submit"
                                class="px-8 md:px-12 py-3.5 md:py-4 saffron-gradient text-white font-bold rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all text-[10px] md:text-xs uppercase tracking-[0.2em]">
                                Search
                            </button>
                        </div>
                    </form>

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
        class="bg-[#4a1d0b] backdrop-blur-2xl mx-6 md:mx-auto max-w-4xl -mt-12 relative z-20 rounded-[2.5rem] shadow-[0_30px_70px_rgba(0,0,0,0.4)] border border-white/5 overflow-hidden">
        @if($heroStatsMode === 'image' && $heroStatsImage)
            <img src="{{ asset('storage/' . $heroStatsImage) }}" class="w-full h-full object-cover animate-fade-in" alt="Hero Highlights">
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 px-6 md:px-8 py-5 md:py-6 w-full animate-fade-in divide-x divide-y md:divide-y-0 divide-white/5">
                <div
                    class="text-center py-4 md:py-0 space-y-1 hover:scale-105 transition-transform duration-500">
                    <p class="text-3xl md:text-4xl font-black text-saffron-400 font-display italic tracking-tight">{{ $statsTemples }}</p>
                    <p class="text-[8px] md:text-[9px] text-saffron-100/50 uppercase font-black tracking-[0.3em]">Divine Temples</p>
                </div>
                <div
                    class="text-center py-4 md:py-0 space-y-1 hover:scale-105 transition-transform duration-500">
                    <p class="text-3xl md:text-4xl font-black text-saffron-400 font-display italic tracking-tight">{{ $statsHotels }}</p>
                    <p class="text-[8px] md:text-[9px] text-saffron-100/50 uppercase font-black tracking-[0.3em]">Luxury Stays</p>
                </div>
                <div
                    class="text-center py-4 md:py-0 space-y-1 hover:scale-105 transition-transform duration-500">
                    <p class="text-3xl md:text-4xl font-black text-saffron-400 font-display italic tracking-tight">{{ $statsDevotees }}</p>
                    <p class="text-[8px] md:text-[9px] text-saffron-100/50 uppercase font-black tracking-[0.3em]">Happy Devotees</p>
                </div>
                <div class="text-center py-4 md:py-0 space-y-1 hover:scale-105 transition-transform duration-500 border-l-0 md:border-l">
                    <p class="text-3xl md:text-4xl font-black text-saffron-400 font-display italic tracking-tight">{{ $statsSupport }}</p>
                    <p class="text-[8px] md:text-[9px] text-saffron-100/50 uppercase font-black tracking-[0.3em]">Sacred Support</p>
                </div>
            </div>
        @endif
    </section>

    <!-- Temples Listing -->
    <section id="temples" class="py-16 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col items-center text-center space-y-2 mb-12">
                <p class="text-saffron-600 font-bold text-xs uppercase tracking-[0.4em]">Sacred Sanctuaries</p>
                <h2 class="text-4xl md:text-5xl font-black text-orange-950 font-display uppercase tracking-widest">Featured
                    Shrines</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($temples as $temple)
                    <a href="{{ route('public.temple.show', ['temple' => $temple->slug]) }}"
                        class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-500 animate-slide-up border border-slate-100 flex flex-col">
                        <div class="aspect-video relative overflow-hidden">
                            @if($temple->photos && count($temple->photos) > 0)
                                <img src="{{ str_starts_with($temple->photos[0], 'http') ? $temple->photos[0] : (str_starts_with($temple->photos[0], 'assets/') ? asset($temple->photos[0]) : asset('storage/' . $temple->photos[0])) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                                    loading="lazy" alt="{{ $temple->name }}">
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

                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div class="space-y-3">
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