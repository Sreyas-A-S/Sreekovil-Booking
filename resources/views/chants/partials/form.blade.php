<form id="chant-form" action="{{ isset($chant) ? route('admin.chants.update', $chant) : route('admin.chants.store') }}" method="POST">
    @csrf
    @if(isset($chant))
        @method('PUT')
    @endif

    <div class="input-group input-group-outline my-3 {{ isset($chant) ? 'is-filled' : '' }}">
        <label class="form-label">Chant Text (Sanskrit/Hindi/English)</label>
        <textarea name="text" class="form-control" rows="2" required>{{ $chant->text ?? '' }}</textarea>
    </div>

    <div class="input-group input-group-outline my-3 {{ isset($chant) ? 'is-filled' : '' }}">
        <label class="form-label">Meaning / Translation</label>
        <textarea name="meaning" class="form-control" rows="2">{{ $chant->meaning ?? '' }}</textarea>
    </div>

    <div class="form-check form-switch ps-0">
        <input class="form-check-input ms-auto" type="checkbox" name="is_active" id="is_active" {{ !isset($chant) || $chant->is_active ? 'checked' : '' }}>
        <label class="form-check-label ms-3" for="is_active">Active</label>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn bg-gradient-primary w-100 mb-2">
            {{ isset($chant) ? 'Update Chant' : 'Add Chant' }}
        </button>
    </div>
</form>
