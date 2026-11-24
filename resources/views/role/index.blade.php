<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STRshop - Role</title>
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
            <h2 class="mb-0">ALL ROLES</h2>
            <a href="{{ route('role.create') }}" class="btn btn-primary">ADD ROLE</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Role</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($role as $r)
                        <tr>
                            <td>{{ $r->NO }}</td>
                            <td>{{ $r->Role }}</td>
                            <td>
                                <a href="{{ route('role.edit', $r->NO) }}" class="btn btn-success">Update</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
