@forelse($temples as $temple)
    <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="py-4 px-6 text-sm font-mono text-saffron-600/50 whitespace-nowrap">#{{ $temple->id }}</td>
        <td class="py-4 px-6">
            <div class="font-semibold text-slate-900">{{ $temple->name }}</div>
        </td>
        <td class="py-4 px-6 text-slate-500">
            <div class="flex items-center gap-1.5 text-sm">
                <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                {{ $temple->location }}
            </div>
        </td>
        <td class="py-4 px-6 whitespace-nowrap">
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.temples.show', $temple) }}"
                    class="p-2 text-slate-400 hover:text-saffron-600 transition-colors" title="View">
                    <i data-lucide="eye" class="w-5 h-5"></i>
                </a>
                <button onclick="editTemple({{ $temple->id }})"
                    class="p-2 text-slate-400 hover:text-gold-600 transition-colors" title="Edit">
                    <i data-lucide="pencil" class="w-5 h-5"></i>
                </button>
                <button onclick="deleteTemple({{ $temple->id }})"
                    class="p-2 text-slate-400 hover:text-red-600 transition-colors" title="Delete">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="py-12 text-center text-slate-500">
            <div class="flex flex-col items-center gap-2">
                <i data-lucide="database" class="w-10 h-10 text-slate-300"></i>
                <p>No temples found. Start by adding one!</p>
            </div>
        </td>
    </tr>
@endforelse