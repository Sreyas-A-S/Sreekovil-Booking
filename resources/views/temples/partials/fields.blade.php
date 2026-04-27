<div class="space-y-4">
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="name">Temple Name</label>
        <input
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
            id="name" name="name" type="text" value="{{ old('name', $temple->name ?? '') }}"
            placeholder="e.g. Somnath Temple" required>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="location">Location</label>
        <input
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
            id="location" name="location" type="text" value="{{ old('location', $temple->location ?? '') }}"
            placeholder="e.g. Gujarat, India" required>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="description">Description</label>
        <textarea
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
            id="description" name="description" rows="4"
            placeholder="Tell us more about this temple...">{{ old('description', $temple->description ?? '') }}</textarea>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="idle_song_id">Idle Song (Playlist)</label>
        <select name="idle_song_id" id="idle_song_id"
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none">
            <option value="">No idle song</option>
            @foreach($songs as $song)
                <option value="{{ $song->id }}" {{ (old('idle_song_id', $temple->idle_song_id ?? '') == $song->id) ? 'selected' : '' }}>
                    {{ $song->title }} ({{ $song->singer ?? 'Unknown' }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2" for="temple_photos">
            <i data-lucide="image" class="w-4 h-4 text-slate-400"></i>
            {{ isset($temple) ? 'Add More Photos' : 'Upload Photos' }}
        </label>
        <div
            class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-saffron-100 border-dashed rounded-2xl hover:border-saffron-400 hover:bg-saffron-50/30 transition-all cursor-pointer relative">
            <div class="space-y-2 text-center">
                <i data-lucide="upload-cloud" class="mx-auto h-12 w-12 text-slate-400"></i>
                <div class="flex text-sm text-slate-600">
                    <span class="relative font-semibold text-saffron-600">Upload files</span>
                    <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-slate-500 font-medium">PNG, JPG, GIF up to 10MB</p>
            </div>
            <input id="temple_photos" name="photos[]" type="file" onchange="updateFileList(this, 'temple-file-list')"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="image/*">
        </div>
        <div id="temple-file-list" class="flex flex-wrap gap-2 mt-2"></div>
    </div>

    @if(isset($temple) && $temple->photos && count($temple->photos) > 0)
        <div class="space-y-4">
            <label class="text-sm font-semibold text-slate-700">Manage Existing Photos</label>
            <div id="existing-photos-grid"
                class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                @foreach($temple->photos as $index => $photo)
                    <div class="aspect-square relative group rounded-xl overflow-hidden border border-white shadow-sm"
                        id="temple-photo-{{ $index }}">
                        <img src="{{ str_starts_with($photo, 'http') ? $photo : asset('storage/' . $photo) }}"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-maroon-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                            <button type="button"
                                onclick="markForDeletion('{{ $index }}', '{{ $photo }}', 'temple-deleted-photos-container', 'temple-photo-')"
                                class="p-2 bg-red-500 text-white rounded-lg shadow-lg hover:bg-red-600 transition-colors">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="temple-deleted-photos-container"></div>
        </div>
    @endif
</div>