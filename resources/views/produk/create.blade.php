@extends('layout.template')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .error-message {
            font-size: 0.875rem;
            color: red;
        }

        #imagePreview {
            display: none;
            max-width: 100%;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Create Produk</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="NamaProduk">Nama Produk</label>
                <input type="text" class="form-control" id="NamaProduk" name="NamaProduk"
                    value="{{ old('NamaProduk') }}" placeholder="Masukkan nama produk" required>
                @error('NamaProduk')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="Harga">Harga</label>
                <input type="text" class="form-control" id="Harga" name="Harga" value="{{ old('Harga') }}"
                    placeholder="Masukkan harga produk" required oninput="formatHarga(this)">
                @error('Harga')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="Stok">Stok</label>
                <input type="number" class="form-control" id="Stok" name="Stok" value="{{ old('Stok') }}"
                    placeholder="Masukkan jumlah stok" min="0" required>
                @error('Stok')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="KategoriID">Kategori</label>
                <select class="form-control" id="KategoriID" name="KategoriID" required>
                    <option value="">--Pilih Kategori--</option>
                    @foreach ($kategori as $kategoriItem)
                        <option value="{{ $kategoriItem->KategoriID }}" {{ old('KategoriID') == $kategoriItem->KategoriID ? 'selected' : '' }}>
                            {{ $kategoriItem->NamaKategori }}
                        </option>
                    @endforeach
                </select>
                @error('KategoriID')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>            

            <div class="form-group">
                <label for="Deskripsi">Deskripsi</label>
                <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="3" placeholder="Masukkan deskripsi produk"
                    required>{{ old('Deskripsi') }}</textarea>
                @error('Deskripsi')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label for="Gambar">Gambar Produk</label>
                <input type="file" class="form-control-file" id="Gambar" name="Gambar" accept="image/*" onchange="previewImage(event)">
                @error('Gambar')
                    <small class="error-message">{{ $message }}</small>
                @enderror
                <img id="imagePreview" src="#" alt="Preview Gambar" class="img-fluid mt-2"/>
            </div> --}}

            <button type="submit" class="btn btn-primary btn-block">Create</button>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-block mt-3">Kembali</a>
        </form>
    </div>

    <script>
        function formatHarga(input) {
            let value = input.value.replace(/\./g, '');
            if (!isNaN(value)) {
                input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            } else {
                input.value = input.value.replace(/[^\d]/g, '');
            }
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = "block";
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>
@endsection
