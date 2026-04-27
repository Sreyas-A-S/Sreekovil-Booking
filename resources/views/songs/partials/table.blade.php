@forelse($songs as $song)
    <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-4 px-6 text-sm font-mono text-saffron-600/50 whitespace-nowrap">#{{ $song->id }}</td>
        <td class="py-4 px-6">
            <div class="font-semibold text-slate-900">{{ $song->title }}</div>
            <div class="text-xs text-slate-400">{{ $song->author }}</div>
        </td>
        <td class="py-4 px-6">
            <div class="text-sm text-slate-600 font-medium">{{ $song->singer ?? 'Unknown' }}</div>
            <div class="text-xs text-slate-400 italic">{{ $song->album ?? 'Single' }}</div>
        </td>
        <td class="py-4 px-6">
            <button
                onclick="playGlobalSong('{{ asset('storage/' . $song->file_path) }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->singer ?? 'Unknown Artist') }}', this)"
                class="flex items-center gap-3 px-4 py-2 bg-saffron-50 text-saffron-700 rounded-xl hover:bg-saffron-100 transition-all group">
                <div
                    class="w-8 h-8 rounded-full bg-saffron-500 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i data-lucide="play" class="w-4 h-4 fill-current ml-0.5"></i>
                </div>
                <span class="text-xs font-bold uppercase tracking-wider">Listen Preview</span>
            </button>
        </td>
        <td class="py-4 px-6 whitespace-nowrap">
            <div class="flex items-center justify-end gap-3">
                <button onclick="editSong({{ $song->id }})" class="p-2 text-slate-400 hover:text-gold-600 transition-colors"
                    title="Edit">
                    <i data-lucide="pencil" class="w-5 h-5"></i>
                </button>
                <button onclick="deleteSong({{ $song->id }})"
                    class="p-2 text-slate-400 hover:text-red-600 transition-colors" title="Delete">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="py-12 text-center text-slate-500">
            <div class="flex flex-col items-center gap-2">
                <i data-lucide="music" class="w-10 h-10 text-slate-300"></i>
                <p>No songs found in the playlist. Start by adding one!</p>
            </div>
        </td>
    </tr>
@endforelse