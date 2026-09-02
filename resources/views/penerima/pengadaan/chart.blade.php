@extends('layouts.pengadaan.penerima')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Section -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-bar-chart-fill text-primary me-2"></i>Dashboard Chart
                    </h4>
                    <p class="text-muted mb-0">Visualisasi data pengadaan barang bidang Anda</p>
                </div>
                <div>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill">
                        <i class="bi bi-building me-2"></i>{{ $authUser->karyawan->bidang->nama_bidang ?? 'Semua Bidang' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-grid-3x3-gap-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Total</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['total'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-pencil-square fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Draft</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['draft'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-info bg-opacity-10 text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Proses</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['diajukan'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Disetujui</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['disetujui'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-danger bg-opacity-10 text-danger rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-x-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Ditolak</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['ditolak'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm hover-shadow transition-all rounded-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon bg-purple bg-opacity-10 text-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-hourglass-split fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small">Menunggu</h6>
                            <h5 class="fw-bold mb-0">{{ $stats['menunggu_direktur'] ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('penerima.chartPengadaan') }}" method="GET" class="row g-3 align-items-end">
                <!-- Filter Ruangan -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-door-open me-1"></i> Ruangan / Instalasi
                    </label>
                    <select name="filter_ruangan" class="form-select bg-light border-0">
                        <option value="">Semua Ruangan</option>
                        @foreach($ruangans as $ruangan)
                            <option value="{{ $ruangan }}" {{ request('filter_ruangan') == $ruangan ? 'selected' : '' }}>
                                {{ $ruangan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tahun -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-calendar me-1"></i> Tahun Anggaran
                    </label>
                    <select name="tahun_anggaran" class="form-select bg-light border-0">
                        <option value="">Semua Tahun</option>
                        @for($i = date('Y'); $i >= date('Y')-5; $i--)
                            <option value="{{ $i }}" {{ request('tahun_anggaran') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Filter Status -->
                {{-- <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted">
                        <i class="bi bi-filter me-1"></i> Status
                    </label>
                    <select name="status" class="form-select bg-light border-0">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                        <option value="disetujui_koordinator" {{ request('status') == 'disetujui_koordinator' ? 'selected' : '' }}>Disetujui Koordinator</option>
                        <option value="disetujui_kabid" {{ request('status') == 'disetujui_kabid' ? 'selected' : '' }}>Disetujui Kabid</option>
                        <option value="menunggu_direktur" {{ request('status') == 'menunggu_direktur' ? 'selected' : '' }}>Menunggu Direktur</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div> --}}

                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                        <a href="{{ route('penerima.chartPengadaan') }}" class="btn btn-outline-secondary rounded-pill px-3" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="row g-4">
        <!-- Chart 1: Donut Status -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-pie-chart-fill text-primary me-2"></i>Distribusi Status
                        </h6>
                        <span class="badge bg-light text-muted">Total: {{ $stats['total'] ?? 0 }}</span>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 2: Trend -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-graph-up-arrow text-success me-2"></i>Trend Pengajuan per Bulan
                        </h6>
                        <span class="badge bg-light text-muted">{{ date('Y') }}</span>
                    </div>
                    <div style="height: 300px;">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 3: Top Barang -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-box-seam-fill text-warning me-2"></i>Top Barang Diminta
                        </h6>
                        <span class="badge bg-light text-muted">Terbanyak</span>
                    </div>
                    <div style="height: 300px;">
                        <canvas id="topBarangChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 4: Total Nilai -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-currency-dollar text-info me-2"></i>Total Nilai per Bulan
                        </h6>
                        <span class="badge bg-light text-muted">Rp</span>
                    </div>
                    <div style="height: 300px;">
                        <canvas id="nilaiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Chart 5: Per Ruangan (Full Width) -->
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-door-open text-success me-2"></i>Per Ruangan / Instalasi
                        </h6>
                        <span class="badge bg-light text-muted">Jumlah Pengajuan</span>
                    </div>
                    <div style="height: 300px;">
                        <canvas id="perRuanganChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Rekap Data -->
    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body p-4">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-table text-primary me-2"></i>Rekapitulasi Data Pengadaan
            </h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-2 px-3">No</th>
                            <th class="py-2 px-3">Bulan</th>
                            <th class="py-2 px-3 text-center">Jumlah</th>
                            <th class="py-2 px-3 text-end">Total Nilai</th>
                            <th class="py-2 px-3 text-center">Disetujui</th>
                            <th class="py-2 px-3 text-center">Ditolak</th>
                            <th class="py-2 px-3 text-center">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekapBulanan ?? [] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['bulan'] }}</td>
                            <td class="text-center">{{ $item['total'] }}</td>
                            <td class="text-end fw-semibold">Rp {{ number_format($item['nilai'], 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success">{{ $item['disetujui'] }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-danger-subtle text-danger">{{ $item['ditolak'] }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning-subtle text-warning">{{ $item['proses'] }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                Belum ada data rekap
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
STYLES
============================================ -->
<style>
.bg-purple {
    background-color: #6f42c1;
}
.bg-purple-subtle {
    background-color: #e7d8f5 !important;
}
.text-purple {
    color: #6f42c1 !important;
}
.bg-success-subtle {
    background-color: #d4edda !important;
}
.bg-danger-subtle {
    background-color: #f8d7da !important;
}
.bg-warning-subtle {
    background-color: #fff3cd !important;
}
.bg-info-subtle {
    background-color: #d1ecf1 !important;
}
.bg-secondary-subtle {
    background-color: #e2e3e5 !important;
}
.bg-primary-subtle {
    background-color: #cfe2ff !important;
}

.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}
.transition-all {
    transition: all 0.3s ease;
}

.stats-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}

@media (max-width: 768px) {
    .stats-icon {
        width: 40px;
        height: 40px;
    }
    .stats-icon i {
        font-size: 1.2rem !important;
    }
}
</style>

<!-- ============================================
SCRIPTS - Chart.js
============================================ -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== DATA FROM PHP =====
    <?php
        $defaultChartData = [
            'status' => ['Disetujui' => 0, 'Ditolak' => 0],
            'trend' => [],
            'topBarang' => [],
            'nilai' => [],
            'perRuangan' => []
        ];
        $chartData = isset($chartData) ? $chartData : $defaultChartData;
        echo 'const chartData = ' . json_encode($chartData) . ';';
    ?>

    // =============================================
    // 1. DONUT CHART - DISETUJUI & DITOLAK
    // =============================================
    const statusCtx = document.getElementById('statusChart').getContext('2d');

    const statusLabels = ['Disetujui', 'Ditolak'];
    const statusValues = [
        chartData.status['Disetujui'] || 0,
        chartData.status['Ditolak'] || 0
    ];

    const statusBgColors = ['#10b981', '#ef4444'];
    const statusHoverColors = ['#34d399', '#f87171'];
    const totalData = statusValues.reduce((a, b) => a + b, 0);

    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusValues,
                backgroundColor: statusBgColors,
                hoverBackgroundColor: statusHoverColors,
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 15,
                spacing: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            radius: '90%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 14,
                        boxHeight: 14,
                        padding: 16,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 13,
                            weight: '700',
                            family: "'Inter', system-ui, sans-serif"
                        },
                        color: '#1a1a2e',
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1a1a2e',
                    bodyColor: '#4a4a6a',
                    borderColor: 'rgba(0,0,0,0.06)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    padding: 14,
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed;
                            const percentage = totalData > 0 ? ((value / totalData) * 100).toFixed(1) : 0;
                            const icon = context.label === 'Disetujui' ? '✅' : '❌';
                            return icon + ' ' + context.label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                duration: 1200,
                easing: 'easeInOutQuart'
            }
        }
    });

    // =============================================
    // 2. TREND CHART
    // =============================================
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    const trendLabels = chartData.trend.map(function(item) { return item.bulan; });
    const trendValues = chartData.trend.map(function(item) { return item.total; });

    const trendGradient = trendCtx.createLinearGradient(0, 0, 0, 280);
    trendGradient.addColorStop(0, 'rgba(79, 70, 229, 0.25)');
    trendGradient.addColorStop(0.5, 'rgba(79, 70, 229, 0.10)');
    trendGradient.addColorStop(1, 'rgba(79, 70, 229, 0.01)');

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: trendValues,
                borderColor: '#4f46e5',
                borderWidth: 3,
                backgroundColor: trendGradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4f46e5',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1a1a2e',
                    bodyColor: '#4a4a6a',
                    borderColor: 'rgba(0,0,0,0.06)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    padding: 12,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#94a3b8',
                        font: { size: 11, weight: '500' }
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.12)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11, weight: '500' }
                    },
                    grid: { display: false }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // =============================================
    // 3. TOP BARANG CHART
    // =============================================
    const topBarangCtx = document.getElementById('topBarangChart').getContext('2d');
    const topBarangLabels = chartData.topBarang.map(function(item) { return item.nama; });
    const topBarangValues = chartData.topBarang.map(function(item) { return item.jumlah; });
    const barColors = ['#4f46e5', '#8b5cf6', '#ec4899', '#ef4444', '#f59e0b', '#10b981', '#3b82f6', '#14b8a6', '#f97316', '#6366f1'];

    new Chart(topBarangCtx, {
        type: 'bar',
        data: {
            labels: topBarangLabels,
            datasets: [{
                label: 'Jumlah Diminta',
                data: topBarangValues,
                backgroundColor: topBarangValues.map(function(_, i) {
                    return barColors[i % barColors.length] + 'cc';
                }),
                borderColor: topBarangValues.map(function(_, i) {
                    return barColors[i % barColors.length];
                }),
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                barPercentage: 0.7,
                categoryPercentage: 0.8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1a1a2e',
                    bodyColor: '#4a4a6a',
                    borderColor: 'rgba(0,0,0,0.06)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    padding: 12,
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#94a3b8',
                        font: { size: 11, weight: '500' }
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.12)',
                        drawBorder: false
                    }
                },
                y: {
                    ticks: {
                        color: '#1a1a2e',
                        font: { size: 11, weight: '600' }
                    },
                    grid: { display: false }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // =============================================
    // 4. NILAI CHART
    // =============================================
    const nilaiCtx = document.getElementById('nilaiChart').getContext('2d');
    const nilaiLabels = chartData.nilai.map(function(item) { return item.bulan; });
    const nilaiValues = chartData.nilai.map(function(item) { return item.total; });

    const nilaiGradient = nilaiCtx.createLinearGradient(0, 0, 0, 280);
    nilaiGradient.addColorStop(0, 'rgba(16, 185, 129, 0.8)');
    nilaiGradient.addColorStop(0.5, 'rgba(16, 185, 129, 0.5)');
    nilaiGradient.addColorStop(1, 'rgba(16, 185, 129, 0.2)');

    new Chart(nilaiCtx, {
        type: 'bar',
        data: {
            labels: nilaiLabels,
            datasets: [{
                label: 'Total Nilai (Rp)',
                data: nilaiValues,
                backgroundColor: nilaiGradient,
                borderColor: '#10b981',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                barPercentage: 0.6,
                categoryPercentage: 0.7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1a1a2e',
                    bodyColor: '#4a4a6a',
                    borderColor: 'rgba(0,0,0,0.06)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed.y;
                            if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(1) + ' Juta';
                            if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + ' Ribu';
                            return 'Rp ' + value;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11, weight: '500' },
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                            if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + 'rb';
                            return 'Rp ' + value;
                        }
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.12)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11, weight: '500' }
                    },
                    grid: { display: false }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // =============================================
    // 5. PER RUANGAN CHART
    // =============================================
    const perRuanganCtx = document.getElementById('perRuanganChart').getContext('2d');
    const perRuanganLabels = chartData.perRuangan.map(function(item) { return item.ruangan; });
    const perRuanganTotal = chartData.perRuangan.map(function(item) { return item.total; });
    const perRuanganDisetujui = chartData.perRuangan.map(function(item) { return item.disetujui; });
    const perRuanganDitolak = chartData.perRuangan.map(function(item) { return item.ditolak; });

    new Chart(perRuanganCtx, {
        type: 'bar',
        data: {
            labels: perRuanganLabels,
            datasets: [
                {
                    label: 'Total Pengajuan',
                    data: perRuanganTotal,
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: '#10b981',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.6,
                },
                {
                    label: 'Disetujui',
                    data: perRuanganDisetujui,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: '#3b82f6',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.6,
                },
                {
                    label: 'Ditolak',
                    data: perRuanganDitolak,
                    backgroundColor: 'rgba(239, 68, 68, 0.7)',
                    borderColor: '#ef4444',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.6,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 14,
                        boxHeight: 14,
                        padding: 14,
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                        font: {
                            size: 11,
                            weight: '500',
                            family: "'Inter', system-ui, sans-serif"
                        },
                        color: '#1a1a2e'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1a1a2e',
                    bodyColor: '#4a4a6a',
                    borderColor: 'rgba(0,0,0,0.06)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    padding: 12,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#94a3b8',
                        font: { size: 11, weight: '500' }
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.12)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#1a1a2e',
                        font: { size: 10, weight: '600' },
                        maxRotation: 45,
                        minRotation: 0
                    },
                    grid: { display: false }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
});
</script>
@endsection