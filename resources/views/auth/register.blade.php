@extends('layouts.app')

@section('content')
<style>
    /* Background Styling */
    body {
        background: url('https://source.unsplash.com/1600x900/?technology,signup') no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }

    /* Overlay Transparan */
    body::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(10px);
    }

    /* Glassmorphism Card */
    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(255, 255, 255, 0.2);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Input Field */
    .form-control {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .form-control:focus {
        border-color: #007BFF;
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.8);
        background: rgba(255, 255, 255, 0.3);
    }

    /* Neon Glow Input Icons */
    .input-group-text {
        background: transparent;
        color: white;
        border: none;
        font-size: 1.2rem;
    }

    .input-group:hover .input-group-text {
        color: #007BFF;
        text-shadow: 0 0 10px rgba(0, 123, 255, 0.8);
    }

    /* Button Hover */
    .btn-hover {
        transition: all 0.3s ease-in-out;
        background: linear-gradient(135deg, #007BFF 0%, #0056b3 100%);
        border: none;
        color: #fff;
    }

    .btn-hover:hover {
        transform: scale(1.1);
        background: linear-gradient(135deg, #0056b3 0%, #007BFF 100%);
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.6);
    }

</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
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
