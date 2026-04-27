@extends('layouts.public')

@section('content')
    <!-- Hotel Hero & Gallery Header -->
    <section class="h-100% pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Main Featured Image -->
                <div
                    class="lg:col-span-2 aspect-[4/3] rounded-[3rem] overflow-hidden shadow-2xl relative group border-4 border-white">
                    @if($hotel->photos && count($hotel->photos) > 0)
                        <img src="{{ str_starts_with($hotel->photos[0], 'http') ? $hotel->photos[0] : (str_starts_with($hotel->photos[0], 'assets/') ? asset($hotel->photos[0]) : asset('storage/' . $hotel->photos[0])) }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <i data-lucide="image" class="w-20 h-20 text-slate-200"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-orange-950/60 to-transparent"></div>
                </div>

                <!-- Side Gallery Grid -->
                <div class="lg:col-span-2 grid grid-cols-2 gap-6">
                    @foreach(array_slice($hotel->photos ?? [], 1, 4) as $index => $photo)
                        <div
                            class="aspect-square rounded-[2rem] overflow-hidden shadow-lg group border-2 border-white hover:border-saffron-300 transition-colors">
                            <img src="{{ str_starts_with($photo, 'http') ? $photo : (str_starts_with($photo, 'assets/') ? asset($photo) : asset('storage/' . $photo)) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                    @endforeach

                    <!-- Placeholder if not enough photos -->
                    @for($i = count($hotel->photos ?? []); $i < 5; $i++)
                        <div
                            class="aspect-square rounded-[2rem] bg-slate-100 border-2 border-white/50 border-dashed flex flex-col items-center justify-center text-slate-300 gap-2">
                            <i data-lucide="image" class="w-8 h-8"></i>
                            <span class="text-[10px] font-bold uppercase tracking-widest">More Coming</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- Hotel Content -->
    <section class="pb-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Details Column -->
                <div class="lg:col-span-2 space-y-12">
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('public.temple.show', $hotel->temple) }}"
                                class="px-4 py-1.5 rounded-full glass bg-orange-50 border border-orange-200 text-orange-950 font-black text-[10px] uppercase tracking-widest hover:bg-orange-900 hover:text-white transition-all">
                                Near {{ $hotel->temple->name }}
                            </a>
                            <div class="flex text-gold-500">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current text-slate-200"></i>
                            </div>
                        </div>
                        <h1
                            class="text-5xl md:text-6xl font-black text-maroon-950 font-display uppercase tracking-wider leading-tight animate-slide-up">
                            {{ $hotel->name }}
                        </h1>
                        <div class="flex items-center gap-4 text-slate-400 font-bold uppercase tracking-[0.2em] text-xs">
                            <i data-lucide="map-pin" class="w-5 h-5 text-saffron-500"></i>
                            {{ $hotel->temple->location }}
                        </div>
                    </div>

                    <div class="prose prose-slate max-w-none">
                        <h3 class="text-xl font-bold font-display uppercase tracking-widest text-maroon-900 mb-4">About the
                            Sanctuary</h3>
                        <p class="text-lg text-slate-600 leading-relaxed italic">
                            {{ $hotel->details }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8 pt-10 border-t border-slate-100">
                        <div class="space-y-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-saffron-50 text-saffron-600 flex items-center justify-center">
                                <i data-lucide="wifi" class="w-6 h-6"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-900 uppercase tracking-widest">Free Wifi</p>
                            <p class="text-[10px] text-slate-400 font-medium">High-speed connectivity throughout the stay.
                            </p>
                        </div>
                        <div class="space-y-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-saffron-50 text-saffron-600 flex items-center justify-center">
                                <i data-lucide="coffee" class="w-6 h-6"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-900 uppercase tracking-widest">Breakfast</p>
                            <p class="text-[10px] text-slate-400 font-medium">Satvik morning meals included with stay.</p>
                        </div>
                        <div class="space-y-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-saffron-50 text-saffron-600 flex items-center justify-center">
                                <i data-lucide="clock" class="w-6 h-6"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-900 uppercase tracking-widest">Divine Hours</p>
                            <p class="text-[10px] text-slate-400 font-medium">Aligned with temple prayer timings.</p>
                        </div>
                    </div>
                </div>

                <!-- Booking Sidebar -->
                <div class="space-y-8">
                    <div
                        class="sticky top-32 bg-maroon-900 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group border border-maroon-800">
                        <div
                            class="absolute inset-0 mandala-overlay opacity-[0.03] pointer-events-none group-hover:scale-125 transition-transform duration-[20s]">
                        </div>

                        <div class="relative z-10 space-y-8">
                            <div>
                                <p class="text-gold-500 font-bold text-xs uppercase tracking-[0.3em] mb-2">Onwards</p>
                                <div class="flex items-baseline gap-2">
                                    <span
                                        class="text-4xl font-bold tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-saffron-300 to-gold-500">₹{{ number_format($hotel->onwards_price, 2) }}</span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div
                                    class="p-4 rounded-2xl bg-maroon-950/50 border border-maroon-800 flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-saffron-500 text-white flex items-center justify-center">
                                        <i data-lucide="phone-call" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-maroon-400 font-bold uppercase tracking-widest">Direct
                                            Contact</p>
                                        <p class="text-white font-bold leading-none mt-1">
                                            {{ $hotel->contact_number ?? 'Inquire Within' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <a href="tel:{{ $hotel->contact_number }}"
                                class="block w-full py-5 rounded-2xl saffron-gradient text-white font-bold text-center uppercase tracking-widest shadow-xl shadow-saffron-500/20 hover:scale-[1.02] transition-all active:scale-95 group">
                                Book Your Sanctuary
                                <i data-lucide="arrow-right"
                                    class="inline-block w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>

                            <p
                                class="text-[10px] text-maroon-300/60 text-center uppercase tracking-[0.2em] font-medium leading-relaxed">
                                Price inclusive of sacred taxes. <br>
                                Special discounts for long-term devotees.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection