@extends('layouts.app')

@section('header', 'Add New Hotel')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700" for="temple_id">Select Temple</label>
                        <select name="temple_id" id="temple_id" class="w-full py-3 px-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none appearance-none cursor-pointer @error('temple_id') border-red-500 @enderror" required>
                            <option value="">Choose a Temple</option>
                            @foreach($temples as $temple)
                                <option value="{{ $temple->id }}" {{ (old('temple_id') == $temple->id || request('temple_id') == $temple->id) ? 'selected' : '' }}>{{ $temple->name }}</option>
                            @endforeach
                        </select>
                        @error('temple_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700" for="name">Hotel Name</label>
                        <input class="w-full py-3 px-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none @error('name') border-red-500 @enderror" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="e.g. Grand Palace" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700" for="onwards_price">Onwards Price (₹)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">₹</span>
                        <input class="w-full py-3 pl-8 pr-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none @error('onwards_price') border-red-500 @enderror" id="onwards_price" name="onwards_price" type="number" step="0.01" value="{{ old('onwards_price') }}" placeholder="0.00" required>
                    </div>
                    @error('onwards_price')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
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
                    <label class="text-sm font-semibold text-slate-700" for="details">Additional Details</label>
                    <textarea class="w-full py-3 px-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none @error('details') border-red-500 @enderror" id="details" name="details" rows="4" placeholder="Mention facilities, room types, etc.">{{ old('details') }}</textarea>
                    @error('details')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-100">
                    <a href="{{ route('admin.hotels.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">Cancel</a>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95 flex items-center gap-2" type="submit">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Create Hotel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
