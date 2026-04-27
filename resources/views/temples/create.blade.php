@extends('layouts.app')

@section('header', 'Add New Temple')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.temples.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700" for="name">Temple Name</label>
                        <input class="w-full py-3 px-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none @error('name') border-red-500 @enderror" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="e.g. Somnath Temple" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700" for="location">Location</label>
                        <input class="w-full py-3 px-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none @error('location') border-red-500 @enderror" id="location" name="location" type="text" value="{{ old('location') }}" placeholder="e.g. Gujarat, India" required>
                        @error('location')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 flex items-center gap-2" for="photos">
                        <i data-lucide="image" class="w-4 h-4 text-slate-400"></i>
                        Upload Photos
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-slate-200 border-dashed rounded-2xl hover:border-indigo-400 hover:bg-slate-50 transition-all cursor-pointer relative">
                        <div class="space-y-2 text-center">
                            <i data-lucide="upload-cloud" class="mx-auto h-12 w-12 text-slate-400"></i>
                            <div class="flex text-sm text-slate-600">
                                <span class="relative font-semibold text-indigo-600">Upload files</span>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-slate-500 font-medium">PNG, JPG, GIF up to 2MB</p>
                        </div>
                        <input id="photos" name="photos[]" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="image/*">
                    </div>
                    @error('photos.*')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700" for="description">Description</label>
                    <textarea class="w-full py-3 px-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none @error('description') border-red-500 @enderror" id="description" name="description" rows="5" placeholder="Tell us more about this temple...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-100">
                    <a href="{{ route('admin.temples.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">Cancel</a>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95 flex items-center gap-2" type="submit">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Create Temple
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
