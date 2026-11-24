<div class="row mb-3">
    <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Vendor</label>
    <div class="col-md-6">
        <input id="nama" type="text" name="nama" maxlength="45"
               class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $v->nama ?? '') }}" required autofocus>
        @error('nama')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

@isset($v)
    <div class="row mb-3">
        <label for="status" class="col-md-4 col-form-label text-md-end">Status Vendor</label>
        <div class="col-md-6">
            <select id="status" name="status"
                    class="form-select @error('status') is-invalid @enderror" required>
                <option value="1" {{ old('status', $v->Status) == 'A' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status', $v->Status) == 'N' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
@endisset
