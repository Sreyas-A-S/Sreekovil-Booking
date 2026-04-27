<form id="song-form" action="{{ isset($song) ? route('admin.songs.update', $song) : route('admin.songs.store') }}"
    method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); submitForm(this, refreshTable);">
    @csrf
    @if(isset($song))
        @method('PUT')
    @endif

    <div class="space-y-4">
        <div class="space-y-2">
            <label class="text-sm font-semibold text-slate-700 flex items-center gap-2" for="file">
                <i data-lucide="music" class="w-4 h-4 text-slate-400"></i>
                {{ isset($song) ? 'Replace Audio File' : 'Upload Audio File' }}
            </label>
            <div
                class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-saffron-100 border-dashed rounded-2xl hover:border-saffron-400 hover:bg-saffron-50/30 transition-all cursor-pointer relative">
                <div class="space-y-2 text-center">
                    <i data-lucide="upload-cloud" class="mx-auto h-12 w-12 text-slate-400"></i>
                    <div class="flex text-sm text-slate-600">
                        <span class="relative font-semibold text-saffron-600">Upload MP3</span>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-slate-500 font-medium" id="file-name">MP3, WAV up to 20MB</p>
                </div>
                <input id="file" name="file" type="file"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".mp3,.wav,.ogg,audio/*"
                    {{ isset($song) ? '' : 'required' }} onchange="handleSongFileSelect(this)">
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-sm font-semibold text-slate-700" for="title">Song Title</label>
            <input
                class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
                id="title" name="title" type="text" value="{{ old('title', $song->title ?? '') }}"
                placeholder="e.g. Harivarasanam" required>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700" for="singer">Singer</label>
                <input
                    class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
                    id="singer" name="singer" type="text" value="{{ old('singer', $song->singer ?? '') }}"
                    placeholder="e.g. K. J. Yesudas">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700" for="album">Album</label>
                <input
                    class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
                    id="album" name="album" type="text" value="{{ old('album', $song->album ?? '') }}"
                    placeholder="e.g. Ayyappa Devotional">
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-sm font-semibold text-slate-700" for="author">Author/Composer</label>
            <input
                class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
                id="author" name="author" type="text" value="{{ old('author', $song->author ?? '') }}"
                placeholder="e.g. Kumbakudi Kulathur Iyer">
        </div>
    </div>

    <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-slate-100">
        <button type="button" onclick="closeModal()"
            class="px-6 py-2.5 rounded-xl text-slate-600 font-semibold hover:bg-slate-100 transition-colors">
            Cancel
        </button>
        <button type="submit"
            class="px-8 py-2.5 rounded-xl bg-saffron-500 hover:bg-saffron-600 text-white font-bold transition-all shadow-lg shadow-saffron-500/20 active:scale-95">
            {{ isset($song) ? 'Update Song' : 'Add to Playlist' }}
        </button>
    </div>
</form>