<div class="space-y-4">
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="temple_id">Associated Temple</label>
        <select
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
            id="temple_id" name="temple_id" required>
            <option value="">Select a Temple</option>
            @foreach($temples as $temple)
                <option value="{{ $temple->id }}" {{ old('temple_id', $hotel->temple_id ?? request('temple_id')) == $temple->id ? 'selected' : '' }}>
                    {{ $temple->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="name">Hotel Name</label>
        <input
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
            id="name" name="name" type="text" value="{{ old('name', $hotel->name ?? '') }}"
            placeholder="e.g. Sree Krishna Inn" required>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="contact_number">Contact Number</label>
        <input
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
            id="contact_number" name="contact_number" type="text"
            value="{{ old('contact_number', $hotel->contact_number ?? '') }}" placeholder="e.g. +91 98765 43210">
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="onwards_price">Onwards Price (₹)</label>
        <input
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
            id="onwards_price" name="onwards_price" type="number" step="0.01"
            value="{{ old('onwards_price', $hotel->onwards_price ?? '') }}" placeholder="e.g. 2500.00" required>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700" for="details">Details & Amenities</label>
        <textarea
            class="w-full py-3 px-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-saffron-400 focus:ring-4 focus:ring-saffron-100 transition-all outline-none"
            id="details" name="details" rows="4"
            placeholder="Describe the rooms, food, and distance from temple...">{{ old('details', $hotel->details ?? '') }}</textarea>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2" for="hotel_photos">
            <i data-lucide="image" class="w-4 h-4 text-slate-400"></i>
            {{ isset($hotel) ? 'Add More Photos' : 'Upload Photos' }}
        </label>
        <div
            class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-saffron-100 border-dashed rounded-2xl hover:border-saffron-400 hover:bg-saffron-50/30 transition-all cursor-pointer relative">
            <div class="space-y-2 text-center">
                <i data-lucide="upload-cloud" class="mx-auto h-12 w-12 text-slate-400"></i>
                <div class="flex text-sm text-slate-600">
                    <span class="relative font-semibold text-saffron-600">Upload files</span>
                    <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-slate-500 font-medium">PNG, JPG, GIF up to 10MB</p>
            </div>
            <input id="hotel_photos" name="photos[]" type="file" onchange="updateFileList(this, 'hotel-file-list')"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="image/*">
        </div>
        <div id="hotel-file-list" class="flex flex-wrap gap-2 mt-2"></div>
    </div>

    @if(isset($hotel) && $hotel->photos && count($hotel->photos) > 0)
        <div class="space-y-4">
            <label class="text-sm font-semibold text-slate-700">Manage Existing Photos</label>
            <div id="existing-hotel-photos-grid"
                class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                @foreach($hotel->photos as $index => $photo)
                    <div class="aspect-square relative group rounded-xl overflow-hidden border border-white shadow-sm"
                        id="hotel-photo-{{ $index }}">
                        <img src="{{ str_starts_with($photo, 'http') ? $photo : asset('storage/' . $photo) }}"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-maroon-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                            <button type="button"
                                onclick="markForDeletion('{{ $index }}', '{{ $photo }}', 'hotel-deleted-photos-container', 'hotel-photo-')"
                                class="p-2 bg-red-500 text-white rounded-lg shadow-lg hover:bg-red-600 transition-colors">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="hotel-deleted-photos-container"></div>
        </div>
    @endif
</div>