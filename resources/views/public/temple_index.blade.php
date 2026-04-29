@extends('layouts.public')

@section('title', 'Sacred Temples - Sreekovil')

@section('content')
    <!-- Header -->
    <section class="relative pt-40 pb-28 flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0"
            style="background-image: linear-gradient(to bottom, rgba(255, 153, 51, 0.6), rgba(230, 92, 0, 0.85)), url('{{ asset('assets/hero-bg.png') }}'); background-size: cover; background-position: center;">
        </div>
        <div class="absolute inset-0 mandala-overlay opacity-30 rotate-12 scale-150 mix-blend-overlay"></div>
        
        <div class="max-w-7xl mx-auto px-8 md:px-6 relative z-10 text-center space-y-4">
            <p class="text-saffron-300 font-bold text-xs uppercase tracking-[0.4em] animate-fade-in drop-shadow-sm">
                {{ isset($search) && $search ? 'Divine Results' : 'Sacred Collection' }}
            </p>
            <h1
                class="text-4xl md:text-6xl font-black text-white font-display uppercase tracking-widest leading-tight animate-slide-up drop-shadow-xl">
                @if(isset($search) && $search)
                    Showing <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-saffron-400 to-gold-500">"{{ $search }}"</span>
                @else
                    All Sacred <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-saffron-400 to-gold-500">Shrines</span>
                @endif
            </h1>
        </div>
    </section>

    <!-- Search/Filter -->
    <section class="relative z-30 -mt-10 px-8 md:px-6">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('public.temple.index') }}" method="GET" class="relative group">
                <div
                    class="absolute inset-0 bg-saffron-500/10 blur-2xl group-hover:bg-saffron-500/20 transition-all duration-500 rounded-full">
                </div>
                <div
                    class="relative flex items-center p-1.5 bg-white/95 backdrop-blur-xl rounded-full shadow-[0_30px_100px_rgba(0,0,0,0.1)] border border-maroon-100/50 overflow-hidden group-focus-within:border-saffron-500/30 transition-all">
                    <input type="text" name="search" value="{{ $search ?? '' }}" autocomplete="off"
                        placeholder="Search temples..."
                        class="search-input-suggest flex-1 bg-transparent border-0 text-maroon-900 placeholder-maroon-300 focus:ring-0 focus:outline-none outline-none px-6 md:px-8 py-4 md:py-5 text-sm md:text-lg font-medium ring-0">

                    <button type="submit"
                        class="px-6 md:px-10 py-4 saffron-gradient text-white font-bold rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all text-[10px] md:text-xs uppercase tracking-widest shrink-0">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Temples Grid -->
    <section class="py-24 px-6 min-h-[60vh]">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($temples as $temple)
                    <a href="{{ route('public.temple.show', $temple) }}"
                        class="group relative bg-white rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-700 border border-slate-100">
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
                                        {{ count($temple->hotels ?? []) }} Stays Nearby
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20 text-center animate-fade-in space-y-6">
                        <div
                            class="w-24 h-24 rounded-full bg-maroon-50 flex items-center justify-center mx-auto text-maroon-200">
                            <i data-lucide="search-x" class="w-12 h-12"></i>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-2xl font-bold font-display text-maroon-900 uppercase">No Shrines Found</h3>
                            <p class="text-slate-500 max-w-md mx-auto italic">We couldn't find any sacred places matching your
                                search. Try searching for a different name, location, or deity.</p>
                        </div>
                        <a href="{{ route('public.temple.index') }}"
                            class="inline-block text-saffron-600 font-bold text-sm uppercase tracking-widest border-b-2 border-saffron-100 hover:border-saffron-500 transition-all pb-1">
                            View All Shrines
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-20">
                {{ $temples->links() }}
            </div>
        </div>
    </section>

    <!-- Sacred Footer Pattern -->
    <div class="h-32 bg-gradient-to-t from-maroon-50 to-transparent"></div>
@endsection