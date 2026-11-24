<div class="row mb-3">
    <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Role</label>
    <div class="col-md-6">
        <input id="nama" type="text" name="nama" maxlength="45"
               class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $r->nama ?? '') }}" required autofocus>
        @error('nama')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
