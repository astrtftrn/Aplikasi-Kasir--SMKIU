@extends('layout.template')

@section('content')
<h3 class="mb-4 fw-bold text-dark text-center">📊 Dashboard Kasir</h3>

<div class="row justify-content-center">
    @php
        $cards = [
            ['icon' => 'fas fa-users', 'title' => 'Total Pelanggan', 'value' => $totalPelanggan, 'color' => 'primary', 'route' => route('pelanggan.index')],
            ['icon' => 'fas fa-shopping-cart', 'title' => 'Total Penjualan', 'value' => $totalPenjualan, 'color' => 'success', 'route' => route('penjualan.index')],
            ['icon' => 'fas fa-th-large', 'title' => 'Total Kategori', 'value' => $totalKategori, 'color' => 'warning', 'route' => route('kategoriproduk.index')],
            ['icon' => 'fas fa-box', 'title' => 'Total Produk', 'value' => $totalProduk, 'color' => 'danger', 'route' => route('produk.index')]
        ];
    @endphp

    @foreach($cards as $card)
    <div class="col-md-3 col-6 mb-4">
        <a href="{{ $card['route'] }}" class="text-decoration-none">
            <div class="card shadow-lg p-4 text-center border-0 bg-light rounded-4">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <i class="{{ $card['icon'] }} fa-3x text-{{ $card['color'] }} me-2"></i>
                </div>
                <h6 class="fw-bold text-secondary">{{ $card['title'] }}</h6>
                <p class="fs-4 fw-semibold text-dark">{{ $card['value'] }}</p>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="card shadow-lg p-4 rounded-4 bg-white">
    <h5 class="mb-3 fw-bold text-dark text-center">📈 Statistik</h5>
    <div class="d-flex justify-content-center">
        <div style="height: 320px; width: 80%;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>

<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Selamat Datang!',
            text: 'Anda telah masuk ke Dashboard Kasir.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });

    var ctx = document.getElementById('myChart').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#007bff');
    gradient.addColorStop(1, '#ffffff');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pelanggan', 'Penjualan', 'Kategori', 'Produk'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalPelanggan }}, {{ $totalPenjualan }}, {{ $totalKategori }}, {{ $totalProduk }}],
                backgroundColor: gradient,
                borderColor: '#007bff',
                borderWidth: 2,
                borderRadius: 12,
                hoverBackgroundColor: '#0056b3'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#555', font: { weight: 'bold' } }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: '#555', font: { weight: 'bold' } }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutBounce'
            }
        }
    });
</script>
@endsection
