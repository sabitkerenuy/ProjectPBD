<div class="row mb-3">
    <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Merchandise</label>
    <div class="col-md-6">
        <input id="nama" type="text" name="nama" maxlength="45"
               class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $b->nama ?? '') }}" required autofocus>
        @error('nama')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="kategori" class="col-md-4 col-form-label text-md-end">Kategori</label>
    <div class="col-md-6">
        <select id="kategori" name="kategori"
                class="form-select @error('kategori') is-invalid @enderror" required>
            <option value="">-- Pilih kategori --</option>
            <option value="N" {{ old('kategori', $b->jenis ?? '') == 'N' ? 'selected' : '' }}>Nuigurumi (N)</option>
            <option value="S" {{ old('kategori', $b->jenis ?? '') == 'S' ? 'selected' : '' }}>Acrylic Stand (S)</option>
            <option value="K" {{ old('kategori', $b->jenis ?? '') == 'K' ? 'selected' : '' }}>Acrylic Keychain (K)</option>
            <option value="B" {{ old('kategori', $b->jenis ?? '') == 'B' ? 'selected' : '' }}>Can Badges (B)</option>
            <option value="C" {{ old('kategori', $b->jenis ?? '') == 'C' ? 'selected' : '' }}>Cheki (C)</option>
        </select>
        @error('kategori')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="harga" class="col-md-4 col-form-label text-md-end">Harga Barang (Rp)</label>
    <div class="col-md-6">
        <input id="harga" type="number" name="harga" min="0" step="1"
               class="form-control @error('harga') is-invalid @enderror"
               value="{{ old('harga', $b->harga ?? '') }}" required>
        @error('harga')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="satuan" class="col-md-4 col-form-label text-md-end">Satuan</label>
    <div class="col-md-6">
        <select id="satuan" name="satuan"
                class="form-select @error('satuan') is-invalid @enderror" required>
            <option value="">-- Pilih satuan --</option>
            @foreach ($satuan as $s)
                <option value="{{ $s->NO }}"
                    {{ old('satuan', $b->idsatuan ?? '') == $s->NO ? 'selected' : '' }}>
                    {{ $s->{'Tipe Satuan'} }}
                </option>
            @endforeach
        </select>
        @error('satuan')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

@isset($b)
    <div class="row mb-3">
        <label for="status" class="col-md-4 col-form-label text-md-end">Status Barang</label>
        <div class="col-md-6">
            <select id="status" name="status"
                    class="form-select @error('status') is-invalid @enderror" required>
                <option value="1" {{ old('status', $b->Status) == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status', $b->Status) == 0 ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
@endisset
