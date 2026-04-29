@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-4xl font-black text-maroon-900 font-display uppercase tracking-widest leading-tight">Global
                    Settings</h1>
                <p class="text-maroon-600 mt-2 italic">Configure your divine experience</p>
            </div>
            <div
                class="w-20 h-20 rounded-2xl bg-saffron-500/10 flex items-center justify-center text-saffron-600 ring-1 ring-saffron-500/20">
                <i data-lucide="settings-2" class="w-10 h-10"></i>
            </div>
        </div>

        @if(session('success'))
            <div
                class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3 animate-fade-in">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-maroon-100 overflow-hidden">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-12">
                @csrf

                <!-- Homepage Music Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-maroon-900 text-white flex items-center justify-center shadow-lg">
                            <i data-lucide="music-2" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-maroon-900 font-display uppercase tracking-wider">Homepage
                                Atmosphere</h3>
                            <p class="text-xs text-maroon-500 italic">Select the sacred hymn for your homepage backdrop</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <label class="block text-sm font-bold text-maroon-700 uppercase tracking-widest ml-1">Choose Idle
                            Song</label>
                        <select name="homepage_song_id"
                            class="w-full bg-maroon-50 border-0 rounded-2xl p-4 text-maroon-900 focus:ring-2 focus:ring-saffron-500 transition-all appearance-none cursor-pointer">
                            <option value="">No Song Selected</option>
                            @foreach($songs as $song)
                                <option value="{{ $song->id }}" {{ $homepageSongId == $song->id ? 'selected' : '' }}>
                                    {{ $song->title }} ({{ $song->singer ?? 'Unknown Artist' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Hero Highlights Section -->
                <div class="pt-10 border-t border-maroon-50 space-y-8">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-saffron-500 text-white flex items-center justify-center shadow-lg">
                            <i data-lucide="bar-chart-3" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-maroon-900 font-display uppercase tracking-wider">Hero
                                Highlights</h3>
                            <p class="text-xs text-maroon-500 italic">Manage the stats bar or replace it with a majestic banner</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="block text-sm font-bold text-maroon-700 uppercase tracking-widest ml-1">Display Mode</label>
                            <div class="flex gap-4">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="hero_stats_mode" value="text" class="peer hidden" {{ $heroStatsMode == 'text' ? 'checked' : '' }}>
                                    <div class="p-4 rounded-2xl bg-maroon-50 border-2 border-transparent peer-checked:border-saffron-500 peer-checked:bg-white transition-all text-center">
                                        <i data-lucide="align-left" class="w-5 h-5 mx-auto mb-2 text-maroon-400 peer-checked:text-saffron-600"></i>
                                        <span class="text-[10px] font-bold uppercase tracking-widest block">Text Stats</span>
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="hero_stats_mode" value="image" class="peer hidden" {{ $heroStatsMode == 'image' ? 'checked' : '' }}>
                                    <div class="p-4 rounded-2xl bg-maroon-50 border-2 border-transparent peer-checked:border-saffron-500 peer-checked:bg-white transition-all text-center">
                                        <i data-lucide="image" class="w-5 h-5 mx-auto mb-2 text-maroon-400 peer-checked:text-saffron-600"></i>
                                        <span class="text-[10px] font-bold uppercase tracking-widest block">Single Image</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-sm font-bold text-maroon-700 uppercase tracking-widest ml-1">Banner Image (Mode: Image)</label>
                            <div class="relative group">
                                <input type="file" name="hero_stats_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="p-4 rounded-2xl bg-maroon-50 border-2 border-dashed border-maroon-200 group-hover:border-saffron-400 transition-all text-center">
                                    @if($heroStatsImage)
                                        <img src="{{ asset('storage/' . $heroStatsImage) }}" class="h-12 w-auto mx-auto rounded-lg mb-2 shadow-sm">
                                    @else
                                        <i data-lucide="upload-cloud" class="w-6 h-6 mx-auto mb-2 text-maroon-300"></i>
                                    @endif
                                    <span class="text-[10px] font-bold text-maroon-400 uppercase tracking-widest block">Click to Upload Banner</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 p-8 bg-maroon-50 rounded-[2rem] border border-maroon-100">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-maroon-400 uppercase tracking-[0.2em] ml-1">Temples</label>
                            <input type="text" name="stats_temples" value="{{ $statsTemples }}" class="w-full bg-white border-0 rounded-xl p-3 text-sm font-bold text-maroon-900 focus:ring-2 focus:ring-saffron-500">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-maroon-400 uppercase tracking-[0.2em] ml-1">Hotels</label>
                            <input type="text" name="stats_hotels" value="{{ $statsHotels }}" class="w-full bg-white border-0 rounded-xl p-3 text-sm font-bold text-maroon-900 focus:ring-2 focus:ring-saffron-500">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-maroon-400 uppercase tracking-[0.2em] ml-1">Devotees</label>
                            <input type="text" name="stats_devotees" value="{{ $statsDevotees }}" class="w-full bg-white border-0 rounded-xl p-3 text-sm font-bold text-maroon-900 focus:ring-2 focus:ring-saffron-500">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-maroon-400 uppercase tracking-[0.2em] ml-1">Support</label>
                            <input type="text" name="stats_support" value="{{ $statsSupport }}" class="w-full bg-white border-0 rounded-xl p-3 text-sm font-bold text-maroon-900 focus:ring-2 focus:ring-saffron-500">
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-maroon-50">
                    <button type="submit"
                        class="flex items-center justify-center gap-3 w-full sm:w-auto px-10 py-4 bg-maroon-900 text-white font-bold rounded-2xl hover:bg-maroon-800 transition-all shadow-xl shadow-maroon-900/20 active:scale-95 group">
                        Save Divine Settings
                        <i data-lucide="save" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection