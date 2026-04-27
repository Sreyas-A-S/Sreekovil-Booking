@extends('layouts.app')

@section('header', 'Edit Temple')

@section('content')
    <div class="max-w-4xl mx-auto pb-12">
        <div class="bg-white rounded-[2rem] shadow-2xl shadow-maroon-900/5 border border-maroon-900/10 overflow-hidden">
            <div class="p-8 md:p-12">
                <h2
                    class="text-2xl font-bold text-maroon-900 font-display uppercase tracking-widest mb-8 border-b border-maroon-50 pb-4">
                    Temple Profile Management
                </h2>

                <form action="{{ route('admin.temples.update', $temple) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf
                    @method('PUT')

                    @include('temples.partials.fields')

                    <div class="flex items-center justify-end gap-4 pt-8 border-t border-slate-100">
                        <a href="{{ route('admin.temples.show', $temple) }}"
                            class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-maroon-800 transition-colors uppercase tracking-widest">
                            Cancel
                        </a>
                        <button
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-saffron-500 to-saffron-600 hover:from-saffron-600 hover:to-saffron-700 text-white font-bold py-4 px-10 rounded-2xl transition-all shadow-lg shadow-saffron-500/20 active:scale-95"
                            type="submit">
                            <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                            Update Temple Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection