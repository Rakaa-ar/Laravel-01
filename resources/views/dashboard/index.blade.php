@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4 text-white">Dashboard Overview</h3>
        <p class="text-secondary mb-4"><small>Project Laravel Inventori Gudang By Rakapradiva Laksana</small></p>

        <div class="row mb-4">
            <!-- Kotak Total Barang -->
            <div class="col-md-3 mb-3">
                <div class="card bg-dark text-white border-secondary h-100 p-3 shadow-sm">
                    <h6 class="mb-2"><i class="bi bi-box-seam me-2"></i>Total Barang</h6>

                    <h3 class="fw-bold" style="color: #00e5ff;">{{ $total_barang }}</h3>
                    <small class="text-secondary">Stok tersedia di gudang</small>
                </div>
            </div>

            <!-- Kotak Total Supplier -->
            <div class="col-md-3 mb-3">
                <div class="card bg-dark text-white border-secondary h-100 p-3 shadow-sm">
                    <h6 class ="mb-2"><i class="bi bi-truck me-2"></i>Total Supplier</h6>
                    
                    <h3 class="fw-bold" style="color: #00e5ff;">{{ $total_supplier }}</h3>
                    <small class="text-secondary">Mitra aktif</small>
                </div>
            </div>

            <!-- Kotak Uang Masuk -->
            <div class="col-md-3 mb-3">
                <div class="card bg-dark text-white border-secondary h-100 p-3 shadow-sm">
                    <h6 class="mb-2"><i class="bi bi-cash-stack me-2"></i>Uang Masuk (Rp)</h6>

                    <h3 class="fw-bold" style="color: #00e5ff;">{{ number_format($uang_masuk, 0, ',', '.') }}</h3>
                    <small class="text-secondary">Total omset keseluruhan</small>
                </div>
            </div>

            <!-- Kotak Uang Keluar -->
            <div class="col-md-3 mb-3">
                <div class="card bg-dark text-white border-secondary h-100 p-3 shadow-sm">
                    <h6 class="mb-2"><i class="bi bi-cart-dash me-2"></i>Uang Keluar (Rp)</h6>

                    <h3 class="fw-bold" style="color: #00e5ff;">{{ number_format($uang_keluar, 0, ',', '.') }}</h3>
                    <small class="text-secondary">Total pengeluaran</small>
                </div>
            </div>
        </div>

        <!-- Area Grafik (Sales Figures) -->
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-dark border-secondary p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="text-white mb-0">Arus Keuangan Tahunan</h5>
                        <div>
                            <span class="badge" style="background-color: #4361ee;">Uang Masuk</span>
                            <span class="badge text-dark" style="background-color: #00f5d4;">Uang Keluar</span>
                        </div>
                    </div>
                    <!-- Tempat grafik bakal digambar -->
                    <canvas id="keuanganChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Script Chart.js dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil data yang dilempar dari Controller
            const dataMasuk = {!! $grafik_masuk !!};
            const dataKeluar = {!! $grafik_keluar !!};

            const ctx = document.getElementById('keuanganChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar', // Tipe grafik batang kayak di gambar referensi
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    datasets: [{
                            label: 'Uang Masuk (Rp)',
                            data: dataMasuk,
                            backgroundColor: '#4361ee', // Warna Biru
                            borderRadius: 4,
                            barPercentage: 0.6,
                            categoryPercentage: 0.8
                        },
                        {
                            label: 'Uang Keluar (Rp)',
                            data: dataKeluar,
                            backgroundColor: '#00f5d4', // Warna Hijau Neon/Cyan
                            borderRadius: 4,
                            barPercentage: 0.6,
                            categoryPercentage: 0.8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }, // Sembunyiin legend bawaan (kita udah bikin badge di atas)
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)', // Garis background putus-putus tipis
                                borderDash: [5, 5]
                            },
                            ticks: {
                                color: '#a0a0a0'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#a0a0a0'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
