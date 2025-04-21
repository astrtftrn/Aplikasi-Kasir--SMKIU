{{-- @extends('layout.template')

@section('title', 'Verifikasi Kasir')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Verifikasi Pengguna Kasir</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($users->isEmpty())
    <div class="alert alert-info">
        Tidak ada pengguna kasir yang menunggu verifikasi.
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(isset($user->id))
                            <a href="{{ route('admin.verifikasi.proses', ['id' => $user->id]) }}" class="btn btn-success">
                                Verifikasi
                            </a>
                        @else
                            <span class="text-danger">ID tidak ditemukan</span>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
</div>
@endsection --}}
