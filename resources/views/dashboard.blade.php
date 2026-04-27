@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Temple Count -->
        <div
            class="bg-white p-8 rounded-[2rem] shadow-2xl shadow-maroon-900/10 border border-white relative overflow-hidden group hover:shadow-saffron-500/10 transition-all duration-500">
            <div
                class="absolute top-0 right-0 w-24 h-24 bg-saffron-50 rounded-bl-full -mr-8 -mt-8 transition-all group-hover:scale-110">
            </div>
            <div class="flex items-center gap-6 relative z-10">
                <div
                    class="w-16 h-16 rounded-2xl bg-saffron-600 text-white flex items-center justify-center shadow-lg shadow-saffron-600/30">
                    <i data-lucide="map-pin" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] font-display mb-1">Total Temples
                    </p>
                    <p class="text-4xl font-bold text-maroon-900 tracking-tight">{{ $templeCount }}</p>
                </div>
            </div>
        </div>

        <!-- Hotel Count -->
        <div
            class="bg-white p-8 rounded-[2rem] shadow-2xl shadow-maroon-900/10 border border-white relative overflow-hidden group hover:shadow-maroon-500/10 transition-all duration-500">
            <div
                class="absolute top-0 right-0 w-24 h-24 bg-maroon-50 rounded-bl-full -mr-8 -mt-8 transition-all group-hover:scale-110">
            </div>
            <div class="flex items-center gap-6 relative z-10">
                <div
                    class="w-16 h-16 rounded-2xl bg-maroon-800 text-white flex items-center justify-center shadow-lg shadow-maroon-800/30">
                    <i data-lucide="hotel" class="w-8 h-8"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] font-display mb-1">Total Hotels
                    </p>
                    <p class="text-4xl font-bold text-maroon-900 tracking-tight">{{ $hotelCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-16">
        <h3 class="text-sm font-bold text-slate-400 mb-8 flex items-center gap-3 font-display uppercase tracking-[0.3em]">
            <span class="w-8 h-[2px] bg-saffron-500/30"></span>
            Quick Actions
            <span class="w-8 h-[2px] bg-saffron-500/30"></span>
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('admin.temples.index') }}"
                class="group bg-white p-6 rounded-2xl border border-transparent shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div
                        class="p-3 bg-saffron-100 text-saffron-700 rounded-xl group-hover:bg-saffron-600 group-hover:text-white transition-all">
                        <i data-lucide="plus" class="w-6 h-6"></i>
                    </div>
                    <span class="font-bold text-maroon-900 uppercase text-xs tracking-widest font-display">Add Temple</span>
                </div>
            </a>

            <a href="{{ route('admin.hotels.index') }}"
                class="group bg-white p-6 rounded-2xl border border-transparent shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div
                        class="p-3 bg-maroon-100 text-maroon-800 rounded-xl group-hover:bg-maroon-800 group-hover:text-white transition-all">
                        <i data-lucide="plus" class="w-6 h-6"></i>
                    </div>
                    <span class="font-bold text-maroon-900 uppercase text-xs tracking-widest font-display">Add Hotel</span>
                </div>
            </a>
        </div>
    </div>
@endsection