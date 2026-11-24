<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Merchandise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4">STRshop</h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">ALL MERCHANDISES</h2>
            <a href="{{ route('barang.create') }}" class="btn btn-primary">ADD MERCHANDISE</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kategori</th>
                        <th>Nama Merchandise</th>
                        <th>Satuan</th>
                        <th>Status Barang</th>
                        <th class="text-end">Harga Barang</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barang as $b)
                        <tr>
                            <td>{{ $b->NO }}</td>
                            <td>{{ $b->Kategori }}</td>
                            <td>{{ $b->{'Nama Merchandise'} }}</td>
                            <td>{{ $b->{'Tipe Satuan'} }}</td>
                            <td>
                                @if ($b->Status == 1)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-end">Rp {{ number_format($b->Harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $b->NO) }}" class="btn btn-success">Update</a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('barang.destroy', $b->NO) }}"
                                      onsubmit="return confirm('Nonaktifkan barang ini? Datanya tidak dihapus dari database.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" {{ $b->Status == 1 ? '' : 'disabled' }}>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
