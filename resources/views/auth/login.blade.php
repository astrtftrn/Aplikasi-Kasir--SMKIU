@extends('layouts.app')

@section('content')
<style>
    /* Background Styling */
    body {
        background: url('{{ asset('assets/images/logos/desain.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        position: relative;
        margin: 0;
        padding: 0;
        height: 100vh;
        filter: brightness(0.8); /* Menerapkan filter kecerahan untuk gambar agar lebih jelas */
    }

    /* Overlay Transparan */
    body::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5); /* Memperjelas overlay */
        z-index: 1; /* Menjamin overlay berada di bawah konten */
        backdrop-filter: blur(5px); /* Menambahkan efek blur yang lebih ringan */
    }

    /* Login Card Styling */
    .glass-card {
        background: rgba(255, 255, 255, 0.8); /* Lighter & solid */
        backdrop-filter: blur(5px);
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        color: #000; /* Black text for visibility */
        border: 1px solid rgba(255, 255, 255, 0.3);
        z-index: 2; /* Card berada di atas overlay */
    }

    /* Input Field */
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

    /* Neon Glow Input Icons */
    .input-group-text {
        background: transparent;
        color: #000;
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

    /* Custom text color */
    .text-black {
        color: #000000 !important;
    }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-5">
        <div class="card glass-card p-4">
            <div class="card-header text-center bg-transparent border-0">
                <h3 class="text-black"><i class="fas fa-cash-register me-2"></i>Login</h3>
            </div>

            <div class="card-body">
                <!-- Alert Pesan Sukses -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Alert Pesan Error -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-black">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label text-black">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label text-black" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-hover">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </button>
                    </div>

                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <div class="mt-3 text-center">
                            <a class="btn btn-link text-black" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    @endif
                </form>
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
