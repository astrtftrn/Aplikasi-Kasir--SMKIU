@extends('layout.template')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #007bff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1.1rem;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            font-size: 1.1rem;
            padding: 10px 20px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .alert {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .form-control {
            font-size: 1.1rem;
        }

        .form-group label {
            font-size: 1rem;
            font-weight: 600;
        }

        .error-message {
            font-size: 0.875rem;
            color: red;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Create Pelanggan</h1>

    <!-- Pesan Error -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('pelanggan.store') }}">
        @csrf

        <!-- Nama Pelanggan -->
        <div class="form-group">
            <label for="NamaPelanggan">Nama Pelanggan</label>
            <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan" value="{{ old('NamaPelanggan') }}" required>
            @error('NamaPelanggan')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <!-- Alamat -->
        <div class="form-group">
            <label for="Alamat">Alamat</label>
            <textarea class="form-control" id="Alamat" name="Alamat" required>{{ old('Alamat') }}</textarea>
            @error('Alamat')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <!-- Nomor Telepon -->
        <div class="form-group">
            <label for="NomorTelepon">Nomor Telepon</label>
            <input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon" value="{{ old('NomorTelepon') }}" required>
            @error('NomorTelepon')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" value="{{ old('Email') }}" required>
            @error('Email')
                <small class="error-message">{{ $message }}</small>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary btn-block">Create</button>

        <!-- Tombol Kembali -->
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-block mt-3">Kembali</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
@endsection
