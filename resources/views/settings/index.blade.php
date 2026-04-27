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
            <form action="{{ route('admin.settings.update') }}" method="POST" class="p-10 space-y-10">
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

                    <div class="p-6 bg-saffron-50 rounded-2xl border border-saffron-100 flex items-start gap-4">
                        <i data-lucide="info" class="w-5 h-5 text-saffron-600 mt-1"></i>
                        <p class="text-xs text-saffron-800 leading-relaxed italic">
                            The selected song will automatically play in the background when visitors enter the home portal.
                            Note: Due to browser policies, an initial user interaction might be required to start playback.
                        </p>
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