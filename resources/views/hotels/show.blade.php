@extends('layouts.app')

@section('header', 'Hotel Profile')

@section('content')
    <div class="space-y-8 pb-12">
        <!-- Header Action Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-maroon-900 font-display uppercase tracking-wider">{{ $hotel->name }}</h1>
                <p class="text-slate-500 flex items-center gap-2 mt-1">
                    <i data-lucide="map-pin" class="w-4 h-4 text-saffron-600"></i>
                    Near {{ $hotel->temple->name }}
                </p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.temples.show', $hotel->temple_id) }}"
                    class="px-8 py-4 text-sm font-black text-slate-500 hover:text-maroon-800 transition-all uppercase tracking-[0.2em] flex items-center gap-3 bg-white/50 rounded-2xl border border-slate-200 hover:border-maroon-300 hover:shadow-lg active:scale-95">
                    <i data-lucide="arrow-left" class="w-6 h-6 text-saffron-600"></i> Back to Temple
                </a>
                <button onclick="editHotel({{ $hotel->id }})"
                    class="inline-flex items-center gap-3 bg-gradient-to-r from-saffron-500 to-saffron-600 hover:from-saffron-600 hover:to-saffron-700 text-white font-black py-4 px-10 rounded-2xl transition-all shadow-xl shadow-saffron-500/30 active:scale-95 text-lg uppercase tracking-wider">
                    <i data-lucide="pencil" class="w-6 h-6"></i>
                    Edit Profile
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-3xl shadow-xl shadow-maroon-900/5 border border-maroon-900/10 overflow-hidden">
                    <div class="p-8">
                        <h3
                            class="text-lg font-bold text-maroon-900 font-display uppercase tracking-widest border-b border-maroon-100 pb-4 mb-6 text-shadow-sm">
                            Hotel Overview</h3>
                        <p class="text-slate-600 leading-relaxed text-lg">
                            {{ $hotel->details ?? 'No additional details provided for this establishment.' }}
                        </p>
                    </div>
                </div>

                <!-- Photos Gallery -->
                <div class="bg-white rounded-3xl shadow-xl shadow-maroon-900/5 border border-maroon-900/10 overflow-hidden">
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-maroon-900 font-display uppercase tracking-widest">Photo
                                Gallery</h3>
                            <span
                                class="px-3 py-1 bg-saffron-50 text-saffron-700 text-xs font-bold rounded-full border border-saffron-100">
                                {{ count($hotel->photos ?? []) }} Images
                            </span>
                        </div>

                        @if($hotel->photos && count($hotel->photos) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($hotel->photos as $photo)
                                    <div class="aspect-square rounded-2xl overflow-hidden border border-slate-100 group cursor-zoom-in relative"
                                        onclick="viewFullscreen('{{ str_starts_with($photo, 'http') ? $photo : asset('storage/' . $photo) }}')">
                                        <img src="{{ str_starts_with($photo, 'http') ? $photo : asset('storage/' . $photo) }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        <div
                                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <i data-lucide="maximize" class="text-white w-8 h-8"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="py-12 flex flex-col items-center justify-center text-slate-400 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                                <i data-lucide="image" class="w-12 h-12 mb-3 opacity-20"></i>
                                <p>No photos uploaded yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Price & Quick Info -->
            <div class="space-y-8">
                <div class="bg-maroon-900 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 pointer-events-none"
                        style="background-image: radial-gradient(circle at 2px 2px, #e7c033 1px, transparent 0); background-size: 16px 16px;">
                    </div>

                    <div class="relative z-10 space-y-8">
                        <div>
                            <p class="text-xs text-maroon-300 uppercase font-bold tracking-[0.2em] mb-2">Starting From</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-bold text-gold-400 font-display">₹
                                    {{ number_format($hotel->onwards_price, 0) }}</span>
                                <span class="text-maroon-200 text-sm">/ night</span>
                            </div>
                        </div>

                        <div class="space-y-4 pt-6 border-t border-maroon-800">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-maroon-800 flex items-center justify-center border border-maroon-700">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-gold-400"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-maroon-400 uppercase font-bold tracking-widest">Location</p>
                                    <p class="text-sm font-semibold truncate">{{ $hotel->temple->name }} Radius</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-maroon-800 flex items-center justify-center border border-maroon-700">
                                    <i data-lucide="hash" class="w-5 h-5 text-gold-400"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-maroon-400 uppercase font-bold tracking-widest">Reference ID
                                    </p>
                                    <p class="text-sm font-mono">HTL-{{ str_pad($hotel->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function refreshTable() {
            location.reload();
        }

        function editHotel(id) {
            openModal("{{ route('admin.hotels.edit', $hotel->id) }}", "Edit Hotel Information");
        }
    </script>
@endsection