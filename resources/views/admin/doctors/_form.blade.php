@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
    </div>
@endif

<div class="mb-3">
    <label class="form-label">Ad Soyad</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $doctor->name ?? '') }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Uzmanlık</label>
    <input type="text" name="specialty" class="form-control @error('specialty') is-invalid @enderror"
           value="{{ old('specialty', $doctor->specialty ?? '') }}" required>
    @error('specialty') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Biyografi</label>
    <textarea name="bio" class="form-control" rows="3">{{ old('bio', $doctor->bio ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Fotoğraf</label>
    @if(isset($doctor) && $doctor->photo)
        <div class="mb-2"><img src="{{ $doctor->photo_url }}" style="width:60px;height:60px;object-fit:cover;border-radius:50%;"></div>
    @endif
    <input type="file" name="photo" class="form-control" accept="image/*">
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1"
           {{ old('is_active', ($doctor->is_active ?? true) ? '1' : '0') == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Aktif</label>
</div>
