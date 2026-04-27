@extends('layouts.app')

@section('header', 'Temples')

@section('content')
    <div class="flex justify-end mb-6">
        <button onclick="addTemple()"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-saffron-500 to-saffron-600 hover:from-saffron-600 hover:to-saffron-700 text-white font-bold py-3 px-7 rounded-2xl transition-all shadow-lg shadow-saffron-500/20 active:scale-95">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Add New Temple
        </button>
    </div>

    <div
        class="bg-white border border-maroon-900/10 rounded-2xl shadow-xl shadow-maroon-900/5 overflow-x-auto ring-1 ring-black/5">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-maroon-900 border-b border-maroon-800">
                    <th class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase w-16">ID
                    </th>
                    <th class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase">Name
                    </th>
                    <th class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase">
                        Location</th>
                    <th
                        class="py-4 px-6 text-xs font-bold text-saffron-100 font-display tracking-[0.2em] uppercase text-right">
                        Actions</th>
                </tr>
            </thead>
            <tbody id="temples-table-body" class="divide-y divide-slate-100">
                @include('temples.partials.table', ['temples' => $temples])
            </tbody>
        </table>
    </div>


    <script>
        async function refreshTable() {
            const response = await fetch("{{ route('admin.temples.index') }}", {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const html = await response.text();
            document.getElementById('temples-table-body').innerHTML = html;
            lucide.createIcons();
        }

        function addTemple() {
            openModal("{{ route('admin.temples.create') }}", "Register New Temple");
        }

        function editTemple(id) {
            const url = "{{ route('admin.temples.edit', ':id') }}".replace(':id', id);
            openModal(url, "Edit Temple Profile");
        }

        async function deleteTemple(id) {
            if (!confirm('Are you sure you want to delete this temple?')) return;

            const url = "{{ route('admin.temples.destroy', ':id') }}".replace(':id', id);
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