@forelse($chants as $chant)
    <tr class="hover:bg-slate-50/50 transition-colors group">
        <td class="py-4 px-6">
            <p class="text-sm font-bold text-orange-950 leading-relaxed">{{ $chant->text }}</p>
        </td>
        <td class="py-4 px-6">
            <p class="text-sm text-slate-500 italic leading-relaxed">{{ $chant->meaning ?? '---' }}</p>
        </td>
        <td class="py-4 px-6 text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $chant->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                {{ $chant->is_active ? 'Active' : 'Inactive' }}
            </span>
        </td>
        <td class="py-4 px-6 text-right">
            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <button onclick="editChant({{ $chant->id }})"
                    class="w-10 h-10 rounded-xl bg-saffron-50 text-saffron-600 flex items-center justify-center hover:bg-saffron-500 hover:text-white transition-all shadow-sm">
                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                </button>
                <button onclick="deleteChant({{ $chant->id }})"
                    class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-sm">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="py-20 text-center">
            <div class="flex flex-col items-center gap-3 text-slate-300">
                <i data-lucide="music" class="w-12 h-12"></i>
                <p class="text-sm font-medium uppercase tracking-[0.2em]">No Sacred Chants Found</p>
            </div>
        </td>
    </tr>
@endforelse
