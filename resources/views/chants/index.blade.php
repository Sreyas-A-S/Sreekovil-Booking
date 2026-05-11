@extends('layouts.app')

@section('header', 'Sacred Chants')

@section('content')
    <div class="flex justify-end mb-6">
        <button onclick="addChant()"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-saffron-500 to-saffron-600 hover:from-saffron-600 hover:to-saffron-700 text-white font-bold py-3 px-7 rounded-2xl transition-all shadow-lg shadow-saffron-500/20 active:scale-95">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Add New Chant
        </button>
    </div>

    <div
        class="bg-white border border-maroon-900/10 rounded-2xl shadow-xl shadow-maroon-900/5 overflow-x-auto ring-1 ring-black/5">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-maroon-900 border-b border-maroon-800">
                    <th class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase w-1/3">Chant Text</th>
                    <th class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase w-1/3">Meaning</th>
                    <th class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase text-center w-32">Status</th>
                    <th class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="chants-table-body" class="divide-y divide-slate-100">
                @include('chants.partials.table', ['chants' => $chants])
            </tbody>
        </table>
    </div>

    <script>
        async function refreshTable() {
            const response = await fetch("{{ route('admin.chants.index') }}", {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const html = await response.text();
            document.getElementById('chants-table-body').innerHTML = html;
            lucide.createIcons();
        }

        function addChant() {
            openModal("{{ route('admin.chants.create') }}", "Add Sacred Chant");
        }

        function editChant(id) {
            const url = "{{ route('admin.chants.edit', ':id') }}".replace(':id', id);
            openModal(url, "Edit Sacred Chant");
        }

        async function deleteChant(id) {
            if (!confirm('Are you sure you want to delete this chant?')) return;

            const url = "{{ route('admin.chants.destroy', ':id') }}".replace(':id', id);
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: new URLSearchParams({
                    '_method': 'DELETE'
                })
            });

            if (response.ok) {
                refreshTable();
            }
        }
    </script>
@endsection
