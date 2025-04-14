@extends('layout.template')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Edit Pelanggan</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pelanggan.update', $pelanggan->PelangganID) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put" />

                    <div class="form-group mb-4">
                        <label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan"
                            value="{{ $pelanggan->NamaPelanggan }}" placeholder="Masukkan nama pelanggan" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="Alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="Alamat" name="Alamat" placeholder="Masukkan alamat pelanggan" required>{{ $pelanggan->Alamat }}</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon"
                            value="{{ $pelanggan->NomorTelepon }}" placeholder="Masukkan nomor telepon pelanggan"
                            required>
                    </div>

                    <!-- Tambahan Field Email -->
                    <div class="form-group mb-4">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email"
                            value="{{ $pelanggan->Email }}" placeholder="Masukkan email pelanggan" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-2">Update</button>
                        <button type="button" class="btn btn-secondary"
                            onclick="window.location.href='{{ route('pelanggan.index') }}'">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection