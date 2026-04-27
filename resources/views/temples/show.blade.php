@extends('layouts.app')

@section('header', 'Temple Profile')

@section('content')
    <div class="space-y-8 pb-12">
        <!-- Header Action Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-maroon-900 font-display uppercase tracking-wider">{{ $temple->name }}
                </h1>
                <p class="text-slate-500 flex items-center gap-2 mt-1">
                    <i data-lucide="map-pin" class="w-4 h-4 text-saffron-600"></i>
                    {{ $temple->location }}
                </p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.temples.index') }}"
                    class="px-8 py-4 text-sm font-black text-slate-500 hover:text-maroon-800 transition-all uppercase tracking-[0.2em] flex items-center gap-3 bg-white/50 rounded-2xl border border-slate-200 hover:border-maroon-300 hover:shadow-lg active:scale-95">
                    <i data-lucide="arrow-left" class="w-6 h-6 text-saffron-600"></i> Back to List
                </a>
                <button onclick="editTemple({{ $temple->id }})"
                    class="inline-flex items-center gap-3 bg-gradient-to-r from-saffron-500 to-saffron-600 hover:from-saffron-600 hover:to-saffron-700 text-white font-black py-4 px-10 rounded-2xl transition-all shadow-xl shadow-saffron-500/30 active:scale-95 text-lg uppercase tracking-wider">
                    <i data-lucide="pencil" class="w-6 h-6"></i>
                    Edit Profile
                </button>
            </div>
        </div>

        <!-- Main Profile Card -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Details Column -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-3xl shadow-xl shadow-maroon-900/5 border border-maroon-900/10 overflow-hidden">
                    <div class="p-8">
                        <h3
                            class="text-lg font-bold text-maroon-900 font-display uppercase tracking-widest border-b border-maroon-100 pb-4 mb-6">
                            Description</h3>
                        <p class="text-slate-600 leading-relaxed text-lg">
                            {{ $temple->description ?? 'No description provided for this sacred site.' }}
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
                                {{ count($temple->photos ?? []) }} Images
                            </span>
                        </div>

                        @if($temple->photos && count($temple->photos) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($temple->photos as $photo)
                                    <div class="aspect-square rounded-2xl overflow-hidden border border-slate-100 group cursor-zoom-in relative"
                                        onclick="viewFullscreen('{{ str_starts_with($photo, 'http') ? $photo : asset('storage/' . $photo) }}')">
                                        <img src="{{ str_starts_with($photo, 'http') ? $photo : asset('storage/' . $photo) }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all flex items-center justify-center">
                                            <i data-lucide="maximize"
                                                class="text-white w-8 h-8 opacity-0 group-hover:opacity-100 transition-opacity"></i>
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

            <!-- Sidebar Info -->
            <div class="space-y-8">
                <div class="bg-maroon-900 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10 pointer-events-none"
                        style="background-image: radial-gradient(circle at 2px 2px, #e7c033 1px, transparent 0); background-size: 16px 16px;">
                    </div>

                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center gap-4 text-gold-400">
                            <i data-lucide="info" class="w-6 h-6"></i>
                            <h3 class="text-lg font-bold font-display uppercase tracking-widest">Quick Info</h3>
                        </div>

                        <div class="space-y-4">
                            <div class="bg-maroon-800/50 p-4 rounded-2xl border border-maroon-700">
                                <p class="text-xs text-maroon-300 uppercase font-bold tracking-widest mb-1">State/Region</p>
                                <p class="text-lg font-semibold">{{ $temple->location }}</p>
                            </div>
                            <div class="bg-maroon-800/50 p-4 rounded-2xl border border-maroon-700">
                                <p class="text-xs text-maroon-300 uppercase font-bold tracking-widest mb-1">Reference ID</p>
                                <p class="text-lg font-mono">#TPL-{{ str_pad($temple->id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($temple->idleSong)
                    <div
                        class="bg-gradient-to-br from-maroon-900 to-maroon-950 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden ring-1 ring-gold-500/30">
                        <div class="absolute -right-4 -top-4 text-gold-500/10 rotate-12">
                            <i data-lucide="music" class="w-32 h-32"></i>
                        </div>

                        <div class="relative z-10 space-y-4">
                            <div class="flex items-center gap-3 text-gold-400 mb-2">
                                <i data-lucide="music-2" class="w-6 h-6 animate-pulse"></i>
                                <h3 class="text-lg font-bold font-display uppercase tracking-widest">Temple Hymn</h3>
                            </div>

                            <div class="space-y-1">
                                <p class="text-2xl font-bold text-white">{{ $temple->idleSong->title }}</p>
                                @if($temple->idleSong->singer)
                                    <p class="text-saffron-300 font-medium tracking-wide italic">by
                                        {{ $temple->idleSong->singer }}
                                    </p>
                                @endif
                            </div>

                            <button
                                onclick="playGlobalSong('{{ asset('storage/' . $temple->idleSong->file_path) }}', '{{ addslashes($temple->idleSong->title) }}', '{{ addslashes($temple->idleSong->singer ?? 'Unknown Artist') }}', this)"
                                class="w-full flex items-center justify-center gap-4 bg-gold-500 hover:bg-gold-400 text-maroon-900 font-black py-4 px-6 rounded-2xl transition-all shadow-xl shadow-gold-500/20 group active:scale-95 mt-6">
                                <div
                                    class="w-10 h-10 rounded-full bg-maroon-900 text-gold-500 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <i data-lucide="play" class="w-5 h-5 fill-current ml-1"></i>
                                </div>
                                <span class="text-lg uppercase tracking-widest">Listen to Hymn</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Related Hotels -->
        <div class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <i data-lucide="hotel" class="w-8 h-8 text-maroon-900"></i>
                    <h3 class="text-2xl font-bold text-maroon-900 font-display uppercase tracking-wider text-shadow-sm">
                        Hotels Nearby</h3>
                </div>
                <button onclick="addHotel({{ $temple->id }})"
                    class="inline-flex items-center gap-2 bg-white border border-maroon-900/10 text-maroon-900 hover:bg-maroon-50 font-bold py-2.5 px-5 rounded-xl transition-all shadow-sm active:scale-95">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Add Hotel
                </button>
            </div>

            <div
                class="bg-white border border-maroon-900/10 rounded-2xl shadow-xl shadow-maroon-900/5 overflow-x-auto ring-1 ring-black/5">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-maroon-900 border-b border-maroon-800">
                            <th
                                class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase w-16">
                                ID</th>
                            <th
                                class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase">
                                Hotel Name</th>
                            <th
                                class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase">
                                Price Range</th>
                            <th
                                class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($temple->hotels as $hotel)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6 text-sm font-mono text-saffron-600/50 whitespace-nowrap">#{{ $hotel->id }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-slate-900">{{ $hotel->name }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="text-slate-600 font-medium whitespace-nowrap">₹
                                        {{ number_format($hotel->onwards_price, 2) }} onwards</span>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.hotels.show', $hotel) }}"
                                            class="p-2 text-slate-400 hover:text-saffron-600 transition-colors"
                                            title="View Profile">
                                            <i data-lucide="eye" class="w-5 h-5"></i>
                                        </a>
                                        <button onclick="editHotel({{ $hotel->id }})"
                                            class="p-2 text-slate-400 hover:text-gold-600 transition-colors" title="Edit">
                                            <i data-lucide="pencil" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-slate-400 italic bg-slate-50/50">
                                    No hotels have been registered near this temple yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // These functions should trigger the global modal logic
        function refreshTable() {
            // On a detail page, we just reload to show changes
            location.reload();
        }

        function editTemple(id) {
            openModal("{{ route('admin.temples.edit', $temple->id) }}", "Edit Temple Information");
        }

        function addHotel(templeId) {
            openModal("{{ route('admin.hotels.create') }}?temple_id=" + templeId, "Register New Hotel");
        }

        function editHotel(id) {
            openModal("/admin/hotels/" + id + "/edit", "Edit Hotel Information");
        }
    </script>
@endsection