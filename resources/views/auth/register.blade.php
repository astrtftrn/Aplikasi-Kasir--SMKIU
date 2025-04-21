@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('assets/images/logos/regiskasir.png') }}') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
        height: 100vh;
    }

    /* Hapus overlay gelap sebelumnya */
    body::before {
        display: none;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.8); /* Lebih terang & solid */
        backdrop-filter: blur(5px);
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        color: #000; /* Ubah teks jadi hitam agar terbaca */
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .form-label,
    .card-header h3,
    .card-footer,
    .text-white {
        color: #000 !important; /* Teks jadi hitam agar jelas */
    }

    .form-control {
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(0, 0, 0, 0.2);
        color: #000;
    }

    .form-control::placeholder {
        color: rgba(0, 0, 0, 0.5);
    }

    .form-control:focus {
        border-color: #007BFF;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
        background: rgba(255, 255, 255, 0.8);
        color: #000;
    }

    .input-group-text {
        background: transparent;
        color: #000;
        border: none;
        font-size: 1.2rem;
    }

    .input-group:hover .input-group-text {
        color: #007BFF;
        text-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    .btn-hover {
        transition: all 0.3s ease-in-out;
        background: linear-gradient(135deg, #007BFF 0%, #0056b3 100%);
        border: none;
        color: #fff;
    }

    .btn-hover:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #0056b3 0%, #007BFF 100%);
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.6);
    }

    .card-footer a {
        color: #007BFF;
        font-weight: bold;
    }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100" style="z-index: 1;">
    <div class="col-md-6">
        <div class="card glass-card p-4">
            <div class="card-header text-center bg-transparent border-0">
                <h3 class="text-white"><i class="fas fa-user-plus me-2"></i> Daftar Akun</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label text-white"><i class="fas fa-user"></i> Nama</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-white"><i class="fas fa-envelope"></i> Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Masukkan email aktif">
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label text-white"><i class="fas fa-lock"></i> Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Masukkan password">
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label text-white"><i class="fas fa-lock"></i> Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Ulangi password">
                        </div>
                    </div>

                    <!-- Tombol Daftar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-hover">
                            <i class="fas fa-user-check"></i> Daftar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="card-footer text-center bg-transparent border-0">
                <small class="text-white">Sudah punya akun? <a href="{{ route('login') }}" class="text-info">Login di sini</a></small>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert & FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @endif
</script>
@endsection
