@extends('layout.template')

@section('content')
<h3 class="mb-4 fw-bold text-dark text-center">⚙️ Dashboard Admin</h3>

<div class="row justify-content-center">
    @php
        $cards = [
            ['icon' => 'fas fa-users', 'title' => 'Total Pelanggan', 'value' => $totalPelanggan, 'color' => 'primary', 'route' => route('pelanggan.index')],
            ['icon' => 'fas fa-shopping-cart', 'title' => 'Total Penjualan', 'value' => $totalPenjualan, 'color' => 'success', 'route' => route('penjualan.index')],
            ['icon' => 'fas fa-th-large', 'title' => 'Total Kategori', 'value' => $totalKategori, 'color' => 'warning', 'route' => route('kategoriproduk.index')],
            ['icon' => 'fas fa-box', 'title' => 'Total Produk', 'value' => $totalProduk, 'color' => 'danger', 'route' => route('produk.index')],
            ['icon' => 'fas fa-credit-card', 'title' => 'Total Pembayaran', 'value' => 'Rp ' . number_format($totalPembayaran, 0, ',', '.'), 'color' => 'info', 'route' => route('pembayaran.index')],
        ];

        $chartData = [$totalPelanggan, $totalPenjualan, $totalKategori, $totalProduk, $totalPembayaran];
        $chartLabels = ['Pelanggan', 'Penjualan', 'Kategori', 'Produk', 'Pembayaran'];
    @endphp

    @foreach($cards as $card)
    <div class="col-md-4 col-lg-2 mb-4">
        <a href="{{ $card['route'] }}" class="text-decoration-none">
            <div class="card shadow-sm text-center border-0 bg-light rounded-4 h-100 p-3">
                <div class="mb-2">
                    <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }}"></i>
                </div>
                <div class="fw-bold text-secondary small">{{ $card['title'] }}</div>
                <div class="fs-5 fw-semibold text-dark">{{ $card['value'] }}</div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="card shadow-lg p-4 mb-4 rounded-4 bg-white">
    <h5 class="mb-3 fw-bold text-dark text-center">📊 Statistik</h5>
    <div class="d-flex justify-content-center">
        <div style="height: 320px; width: 80%;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <!-- Stok Menipis -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow rounded-4">
            <div class="card-header bg-warning text-white fw-bold">
                <i class="fas fa-exclamation-triangle me-1"></i> Stok Produk Menipis
            </div>
            <div class="card-body">
                @if(count($produk) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produk as $item)
                                <tr>
                                    <td>{{ $item->NamaProduk }}</td>
                                    <td class="text-center">{{ $item->Stok }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted">Tidak ada produk dengan stok menipis</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Produk Terlaris -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow rounded-4">
            <div class="card-header bg-success text-white fw-bold">
                <i class="fas fa-fire me-1"></i> Produk Terlaris
            </div>
            <div class="card-body">
                @if(count($produkTerlaris) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Jumlah Terjual</th>
                                    <th class="text-center">Stok Tersisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produkTerlaris as $item)
                                <tr>
                                    <td>{{ $item->produk->NamaProduk ?? '-' }}</td>
                                    <td class="text-center">{{ $item->total_terjual }}</td>
                                    <td class="text-center">{{ $item->produk->Stok ?? '0' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-muted">Belum ada data penjualan produk</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#3D8BFD'); 
    gradient.addColorStop(1, '#B3D7FF'); 

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah',
                data: {!! json_encode($chartData) !!},
                backgroundColor: gradient,
                borderColor: '#3D8BFD',
                borderWidth: 2,
                borderRadius: 20,
                hoverBackgroundColor: '#1B6EC2',
                hoverBorderColor: '#003580'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Statistik Data',
                    font: {
                        size: 16,
                        weight: 'bold'
                    },
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#333',
                        font: { weight: 'bold' }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        stepSize: 1,
                        color: '#333',
                        font: { weight: 'bold' }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutBounce'
            }
        }
    });
</script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    });
</script>
@endsection
