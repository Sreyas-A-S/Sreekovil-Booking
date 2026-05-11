<form action="{{ isset($chant) ? route('admin.chants.update', $chant) : route('admin.chants.store') }}"
    method="POST" class="space-y-6"
    onsubmit="event.preventDefault(); submitForm(this, refreshTable);">
    @csrf
    @if(isset($chant))
        @method('PUT')
    @endif

    <div class="space-y-5">
        <!-- Chant Text -->
        <div class="space-y-2">
            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Chant Text (Sanskrit/Hindi/English)</label>
            <div class="relative group">
                <div class="absolute top-4 left-5 text-slate-400 group-focus-within:text-saffron-500 transition-colors">
                    <i data-lucide="music" class="w-5 h-5"></i>
                </div>
                <textarea name="text" rows="3" required
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-sm font-bold text-orange-950 placeholder:text-slate-300 focus:bg-white focus:border-saffron-400 focus:outline-none transition-all"
                    placeholder="Enter the sacred verse...">{{ $chant->text ?? '' }}</textarea>
            </div>
        </div>

        <!-- Meaning -->
        <div class="space-y-2">
            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Meaning / Translation</label>
            <div class="relative group">
                <div class="absolute top-4 left-5 text-slate-400 group-focus-within:text-saffron-500 transition-colors">
                    <i data-lucide="languages" class="w-5 h-5"></i>
                </div>
                <textarea name="meaning" rows="3"
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-sm font-bold text-orange-950 placeholder:text-slate-300 focus:bg-white focus:border-saffron-400 focus:outline-none transition-all"
                    placeholder="Enter the meaning or translation...">{{ $chant->meaning ?? '' }}</textarea>
            </div>
        </div>

        <!-- Status Toggle -->
        <div class="bg-slate-50 p-5 rounded-2xl border-2 border-slate-100 flex items-center justify-between group hover:border-saffron-100 transition-colors">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-slate-400 group-hover:text-saffron-500 transition-colors">
                    <i data-lucide="power" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">Availability</p>
                    <p class="text-xs font-bold text-orange-950">Active on Homepage</p>
                </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" class="sr-only peer" {{ !isset($chant) || $chant->is_active ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-saffron-500"></div>
            </label>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
        <button type="button" onclick="closeModal()"
            class="px-5 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors uppercase tracking-widest">Cancel</button>
        <button
            class="inline-flex items-center gap-2 bg-gradient-to-r from-saffron-500 to-saffron-600 hover:from-saffron-600 hover:to-saffron-700 text-white font-bold py-3.5 px-8 rounded-2xl transition-all shadow-lg shadow-saffron-500/20 active:scale-95"
            type="submit">
            <i data-lucide="{{ isset($chant) ? 'refresh-cw' : 'plus-circle' }}" class="w-5 h-5"></i>
            {{ isset($chant) ? 'Update Chant' : 'Add Sacred Chant' }}
        </button>
    </div>
</form>

<script>
    lucide.createIcons();
</script>
