<form action="{{ isset($hotel) ? route('admin.hotels.update', $hotel) : route('admin.hotels.store') }}" method="POST"
    enctype="multipart/form-data" class="space-y-6" onsubmit="event.preventDefault(); submitForm(this, refreshTable);">
    @csrf
    @if(isset($hotel))
        @method('PUT')
    @endif

    <div class="space-y-4">
        @include('hotels.partials.fields')
    </div>

    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
        <button type="button" onclick="closeModal()"
            class="px-5 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors uppercase tracking-widest">Cancel</button>
        <button
            class="inline-flex items-center gap-2 bg-gradient-to-r from-saffron-500 to-saffron-600 hover:from-saffron-600 hover:to-saffron-700 text-white font-bold py-3.5 px-8 rounded-2xl transition-all shadow-lg shadow-saffron-500/20 active:scale-95"
            type="submit">
            <i data-lucide="{{ isset($hotel) ? 'refresh-cw' : 'plus-circle' }}" class="w-5 h-5"></i>
            {{ isset($hotel) ? 'Update Hotel' : 'Create Hotel' }}
        </button>
    </div>
</form>

<script>
    lucide.createIcons();
</script>