@extends('layouts.public')

@section('content')
    <!-- Temple Header Section -->
    <section class="relative min-h-[70vh] flex items-end pb-20 overflow-hidden">
        @if($temple->photos && count($temple->photos) > 0)
            <img src="{{ str_starts_with($temple->photos[0], 'http') ? $temple->photos[0] : (str_starts_with($temple->photos[0], 'assets/') ? asset($temple->photos[0]) : asset('storage/' . $temple->photos[0])) }}"
                class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 bg-orange-600"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-orange-950 via-orange-950/40 to-transparent"></div>
        <div class="absolute inset-0 mandala-overlay opacity-[0.2] pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full animate-fade-in">
            <div class="flex flex-col md:flex-row justify-between items-end gap-10">
                <div class="space-y-6 max-w-3xl">
                    <div class="flex items-center gap-3">
                        <span
                            class="px-4 py-1.5 rounded-full glass border border-saffron-500/30 text-saffron-400 font-black text-[10px] uppercase tracking-widest">
                            Available Sanctuary
                        </span>
                        <span class="flex items-center gap-2 text-white/50 text-[10px] font-bold uppercase tracking-widest">
                            <i data-lucide="map-pin" class="w-3 h-3"></i>
                            {{ $temple->location }}
                        </span>
                    </div>
                    <h1
                        class="text-5xl md:text-7xl font-black text-white font-display uppercase tracking-widest italic leading-tight">
                        {{ $temple->name }}
                    </h1>
                    <p class="text-orange-100/70 text-lg leading-relaxed italic max-w-2xl">
                        {{ $temple->description }}
                    </p>
                </div>

                <!-- Hymn Player -->
                @if($temple->idleSong)
                    <div class="w-full md:w-80 glass rounded-[2rem] p-6 border border-white/10 shadow-2xl animate-float">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-10 h-10 rounded-full saffron-gradient flex items-center justify-center text-white scale-110 shadow-lg">
                                <i data-lucide="music-2" class="w-5 h-5 animate-pulse"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-saffron-400 font-bold uppercase tracking-widest">Temple Hymn</p>
                                <p class="text-white font-bold text-sm truncate">{{ $temple->idleSong->title }}</p>
                            </div>
                        </div>
                        <audio controls class="w-full h-8 opacity-40 hover:opacity-100 transition-opacity">
                            <source src="{{ asset('storage/' . $temple->idleSong->file_path) }}" type="audio/mpeg">
                        </audio>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Hotel Listings Hub -->
    <section class="py-32 px-6 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end gap-10 mb-20">
                <div class="space-y-4">
                    <p class="text-saffron-600 font-bold text-xs uppercase tracking-[0.4em]">Stay & Serenity</p>
                    <h2 class="text-4xl md:text-5xl font-black text-maroon-950 font-display uppercase tracking-widest">
                        Available Hotels</h2>
                </div>
                <div class="flex items-center gap-3 px-6 py-3 rounded-2xl bg-maroon-50 border border-maroon-100">
                    <span class="text-sm font-bold text-maroon-900">{{ count($temple->hotels) }}</span>
                    <span
                        class="text-xs font-medium text-maroon-800/60 uppercase tracking-widest border-l border-maroon-200 pl-3">Hotels
                        Found</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @forelse($temple->hotels as $hotel)
                    <div
                        class="group flex flex-col lg:flex-row bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-700">
                        <div class="w-full lg:w-2/5 aspect-[4/3] lg:aspect-auto relative overflow-hidden">
                            @if($hotel->photos && count($hotel->photos) > 0)
                                <img src="{{ str_starts_with($hotel->photos[0], 'http') ? $hotel->photos[0] : asset('storage/' . $hotel->photos[0]) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <i data-lucide="building-2" class="w-12 h-12 text-slate-300"></i>
                                </div>
                            @endif
                            <div
                                class="absolute top-6 left-6 px-4 py-2 rounded-full glass border border-white/20 text-white text-[10px] font-black uppercase tracking-widest">
                                Onwards ₹{{ number_format($hotel->onwards_price, 2) }}
                            </div>
                        </div>

                        <div class="w-full lg:w-3/5 p-8 flex flex-col">
                            <div class="flex-1 space-y-4">
                                <h3
                                    class="text-2xl font-bold font-display text-maroon-950 uppercase tracking-wide group-hover:text-saffron-600 transition-colors">
                                    {{ $hotel->name }}
                                </h3>
                                <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 italic">
                                    {{ $hotel->details }}
                                </p>

                                <div class="flex flex-wrap gap-3 pt-4">
                                    <div
                                        class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-100">
                                        <i data-lucide="wifi" class="w-3 h-3"></i> Free Wifi
                                    </div>
                                    <div
                                        class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-100">
                                        <i data-lucide="coffee" class="w-3 h-3"></i> Breakfast
                                    </div>
                                </div>
                            </div>

                            <div class="pt-8 mt-8 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('public.hotel.show', ['hotel' => $hotel->slug]) }}"
                                    class="inline-flex items-center gap-2 text-saffron-600 font-bold text-sm uppercase tracking-widest hover:translate-x-2 transition-transform">
                                    View Details
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </a>
                                <a href="tel:{{ $hotel->contact_number }}"
                                    class="w-12 h-12 rounded-2xl bg-maroon-50 text-maroon-900 flex items-center justify-center hover:bg-maroon-900 hover:text-white transition-all shadow-inner">
                                    <i data-lucide="phone" class="w-5 h-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center animate-fade-in">
                        <div class="max-w-md mx-auto space-y-6">
                            <div
                                class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-300">
                                <i data-lucide="hotel" class="w-10 h-10"></i>
                            </div>
                            <p class="text-slate-400 italic text-lg font-medium">We're currently expanding our stays near this
                                sacred shrine. Check back very soon!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-32 px-6 bg-maroon-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col items-center text-center space-y-4 mb-20">
                <h2 class="text-3xl font-bold font-display text-maroon-900 uppercase tracking-widest">Visual Pilgrimage</h2>
                <div class="w-16 h-0.5 bg-gold-500/30"></div>
            </div>

            <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                @foreach($temple->photos as $photo)
                    <div
                        class="rounded-3xl overflow-hidden shadow-lg border border-white hover:scale-[1.02] transition-all duration-500 cursor-pointer">
                        <img src="{{ str_starts_with($photo, 'http') ? $photo : asset('storage/' . $photo) }}"
                            class="w-full h-auto">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if($temple->idleSong)
        <script>
            window.addEventListener('click', function () {
                if (window.playGlobalSong) {
                    window.playGlobalSong("{{ asset('storage/' . $temple->idleSong->file_path) }}", "{{ addslashes($temple->idleSong->title) }}", "{{ addslashes($temple->idleSong->singer ?? 'Unknown Artist') }}");
                }
            }, { once: true });
        </script>
    @endif
@endsection