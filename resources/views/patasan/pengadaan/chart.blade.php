@extends('layouts.pengadaan.atasan')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="row g-3 mb-3">
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div>
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-graph-up-arrow text-primary me-2"></i>Dashboard Chart
                    </h5>
                    <p class="text-muted small mb-0">Visualisasi data pengadaan barang</p>
                </div>
                <div>
                    <a href="{{ route('atasan.pengadaan') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill ms-1">
                        <i class="bi bi-building me-1"></i>{{ $authUser->karyawan->bidang->nama_bidang ?? 'Semua Bidang' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards - Diperkecil -->
    <div class="row g-2 mb-3">
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stats-icon bg-primary bg-opacity-10 text-primary rounded-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-file-earmark-text fs-6"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small" style="font-size: 0.6rem;">Total</h6>
                            <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $stats['total_pengajuan'] ?? 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stats-icon bg-success bg-opacity-10 text-success rounded-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-check-circle-fill fs-6"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small" style="font-size: 0.6rem;">Disetujui</h6>
                            <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $stats['total_disetujui'] ?? 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stats-icon bg-warning bg-opacity-10 text-warning rounded-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-clock-history fs-6"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small" style="font-size: 0.6rem;">Menunggu</h6>
                            <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $stats['total_menunggu'] ?? 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stats-icon bg-danger bg-opacity-10 text-danger rounded-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-x-circle-fill fs-6"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small" style="font-size: 0.6rem;">Ditolak</h6>
                            <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $stats['total_ditolak'] ?? 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stats-icon bg-info bg-opacity-10 text-info rounded-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-cash-coin fs-6"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small" style="font-size: 0.6rem;">Nominal</h6>
                            <h6 class="fw-bold mb-0" style="font-size: 0.7rem;">Rp {{ number_format($stats['total_nominal'] ?? 0, 0, ',', '.') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stats-icon bg-purple bg-opacity-10 text-purple rounded-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-hourglass-split fs-6"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small" style="font-size: 0.6rem;">Nominal disetujui</h6>
                            <h6 class="fw-bold mb-0" style="font-size: 0.9rem;">{{ number_format($stats['total_disetujui'] ?? 0, 0, ',', '.') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section - Diperkecil -->
    <div class="card border-0 shadow-sm rounded-3 mb-3">
        <div class="card-body p-3">
            <form id="filterForm" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted" style="font-size: 0.7rem;">
                        <i class="bi bi-calendar me-1"></i> Tahun
                    </label>
                    <select name="tahun" id="filterTahun" class="form-select form-select-sm bg-light border-0">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: none;">
                    <label class="form-label fw-semibold small text-muted" style="font-size: 0.7rem;">
                        <i class="bi bi-building me-1"></i> Bidang
                    </label>

                    <select name="bidang" id="filterBidang" class="form-select form-select-sm bg-light border-0">
                        <option value="">Semua Bidang</option>

                        @foreach($bidangs as $bidang)
                            <option value="{{ $bidang->id }}">
                                {{ $bidang->nama_bidang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted" style="font-size: 0.7rem;">
                        <i class="bi bi-building me-1"></i> Bidang
                    </label>
                    <select name="bidang" id="filterBidang" class="form-select form-select-sm bg-light border-0">
                        <option value="">Semua Bidang</option>
                        @foreach($bidangs as $bidang)
                            <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold small text-muted" style="font-size: 0.7rem;">
                        <i class="bi bi-clock me-1"></i> Periode
                    </label>
                    <select name="periode" id="filterPeriode" class="form-select form-select-sm bg-light border-0">
                        <option value="tahunan">Tahunan</option>
                        <option value="triwulan">Triwulan</option>
                        <option value="bulanan">Bulanan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="button" id="refreshChart" class="btn btn-primary btn-sm w-100 rounded-pill">
                        <i class="bi bi-arrow-repeat me-1"></i> Refresh
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Charts Section - Diperkecil -->
    <div class="row g-3">
        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-transparent border-0 pt-3 px-3 pb-0">
                    <h6 class="fw-bold mb-0" style="font-size: 0.85rem;">
                        <i class="bi bi-pie-chart-fill text-primary me-1"></i>Distribusi Status
                    </h6>
                    <p class="text-muted small mb-0" style="font-size: 0.65rem;">Persentase status pengajuan</p>
                </div>
                <div class="card-body p-3">
                    <canvas id="statusChart" height="240"></canvas>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="col-xl-6 col-lg-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-transparent border-0 pt-3 px-3 pb-0">
                    <h6 class="fw-bold mb-0" style="font-size: 0.85rem;">
                        <i class="bi bi-building text-primary me-1"></i>Per Bidang
                    </h6>
                    <p class="text-muted small mb-0" style="font-size: 0.65rem;">Jumlah pengajuan per bidang</p>
                </div>
                <div class="card-body p-3">
                    <canvas id="bidangChart" height="240"></canvas>
                </div>
            </div>
        </div>

        <!-- Line Chart -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-transparent border-0 pt-3 px-3 pb-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                        <div>
                            <h6 class="fw-bold mb-0" style="font-size: 0.85rem;">
                                <i class="bi bi-graph-up text-primary me-1"></i>Tren Pengajuan
                            </h6>
                            <p class="text-muted small mb-0" style="font-size: 0.65rem;">Jumlah & nominal per periode</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="showNominal" style="width: 28px; height: 14px;">
                            <label class="form-check-label small" for="showNominal" style="font-size: 0.7rem;">Nominal</label>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <canvas id="trendChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-transparent border-0 pt-3 px-3 pb-0">
                    <h6 class="fw-bold mb-0" style="font-size: 0.85rem;">
                        <i class="bi bi-bar-chart-fill text-primary me-1"></i>Rata-rata Nominal per Status
                    </h6>
                    <p class="text-muted small mb-0" style="font-size: 0.65rem;">Rata-rata nominal berdasarkan status</p>
                </div>
                <div class="card-body p-3">
                    <canvas id="averageChart" height="160"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important;
}
.transition-all {
    transition: all 0.3s ease;
}
.stats-icon {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
}
.bg-purple {
    background-color: #6f42c1 !important;
}
.bg-purple-subtle {
    background-color: #e7d8f5 !important;
}
.text-purple {
    color: #6f42c1 !important;
}

/* Custom scroll untuk chart jika diperlukan */
.card-body {
    overflow: hidden;
}
canvas {
    max-width: 100%;
}
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let statusChart, bidangChart, trendChart, averageChart;
    
    function loadChartData() {
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);
        
        const btn = document.getElementById('refreshChart');
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span>`;
        btn.disabled = true;
        
        fetch(`{{ route('atasan.pengadaan.chart-data') }}?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateStatusChart(data.status);
                    updateBidangChart(data.bidang);
                    updateTrendChart(data.trend, data.periode);
                    updateAverageChart(data.average);
                } else {
                    alert('Gagal memuat data: ' + (data.message || 'Unknown error'));
                }
                
                btn.innerHTML = `<i class="bi bi-arrow-repeat me-1"></i> Refresh`;
                btn.disabled = false;
            })
            .catch(error => {
                console.error('Error loading chart data:', error);
                alert('Gagal memuat data chart. Silakan coba lagi.');
                btn.innerHTML = `<i class="bi bi-arrow-repeat me-1"></i> Refresh`;
                btn.disabled = false;
            });
    }
    
    function updateStatusChart(data) {
        const ctx = document.getElementById('statusChart').getContext('2d');
        if (statusChart) statusChart.destroy();
        
        statusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.map(item => item.label),
                datasets: [{
                    data: data.map(item => item.value),
                    backgroundColor: data.map(item => item.color),
                    borderWidth: 1.5,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 10,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 10 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
    
    function updateBidangChart(data) {
        const ctx = document.getElementById('bidangChart').getContext('2d');
        if (bidangChart) bidangChart.destroy();
        
        const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69', '#fd7e14'];
        
        bidangChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.map(item => item.label),
                datasets: [{
                    data: data.map(item => item.total),
                    backgroundColor: colors.slice(0, data.length),
                    borderWidth: 1.5,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 10,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 10 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                const nominal = data[context.dataIndex]?.nominal || 0;
                                return `${context.label}: ${context.parsed} (${percentage}%) - Rp ${nominal.toLocaleString('id-ID')}`;
                            }
                        }
                    }
                }
            }
        });
    }
    
    function updateTrendChart(data, periode) {
        const ctx = document.getElementById('trendChart').getContext('2d');
        const showNominal = document.getElementById('showNominal').checked;
        
        if (trendChart) trendChart.destroy();
        
        const labels = data.map(item => item.label);
        const totals = data.map(item => item.total);
        const nominals = data.map(item => item.nominal || 0);
        
        const datasets = [
            {
                label: 'Jumlah',
                data: totals,
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: '#4e73df',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                yAxisID: 'y',
                pointRadius: 3
            }
        ];
        
        if (showNominal) {
            datasets.push({
                label: 'Nominal (Rp)',
                data: nominals,
                backgroundColor: 'rgba(28, 200, 138, 0.2)',
                borderColor: '#1cc88a',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                yAxisID: 'y1',
                pointRadius: 3
            });
        }
        
        trendChart = new Chart(ctx, {
            type: 'line',
            data: { labels: labels, datasets: datasets },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 10,
                            font: { size: 10 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                if (context.dataset.label.includes('Nominal')) {
                                    return `${context.dataset.label}: Rp ${context.parsed.y.toLocaleString('id-ID')}`;
                                }
                                return `${context.dataset.label}: ${context.parsed.y}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { stepSize: 1, font: { size: 9 } }
                    },
                    y1: {
                        position: 'right',
                        beginAtZero: true,
                        grid: { drawOnChartArea: false },
                        ticks: {
                            font: { size: 9 },
                            callback: function(value) {
                                if (value >= 1000000000) return 'Rp ' + (value / 1000000000).toFixed(1) + 'M';
                                if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(0) + 'JT';
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
    
    function updateAverageChart(data) {
        const ctx = document.getElementById('averageChart').getContext('2d');
        if (averageChart) averageChart.destroy();
        
        const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69', '#fd7e14'];
        
        averageChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(item => item.label),
                datasets: [{
                    label: 'Rata-rata (Rp)',
                    data: data.map(item => item.value),
                    backgroundColor: colors.slice(0, data.length),
                    borderColor: colors.slice(0, data.length).map(c => c + '80'),
                    borderWidth: 1.5,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Rp ${context.parsed.y.toLocaleString('id-ID')}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: {
                            font: { size: 9 },
                            callback: function(value) {
                                if (value >= 1000000000) return 'Rp ' + (value / 1000000000).toFixed(1) + 'M';
                                if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(0) + 'JT';
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
    
    // Event listeners
    document.getElementById('refreshChart').addEventListener('click', loadChartData);
    document.getElementById('showNominal').addEventListener('change', function() {
        if (trendChart) loadChartData();
    });
    document.getElementById('filterTahun').addEventListener('change', loadChartData);
    document.getElementById('filterBidang').addEventListener('change', loadChartData);
    document.getElementById('filterPeriode').addEventListener('change', loadChartData);
    
    // Load initial data
    loadChartData();
});
</script>

@endsection