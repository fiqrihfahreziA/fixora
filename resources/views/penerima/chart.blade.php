@extends('layouts.penerima')

@section('content')


<div class="row">

    <div class="col-md-3">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6>Total Request</h6>
                <h2>{{ $totalRequest }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6>Permintaan</h6>
                <h2 class="text-primary">{{ $totalPermintaan }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6>Perbaikan</h6>
                <h2 class="text-warning">{{ $totalPerbaikan }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6>Approved</h6>
                <h2 class="text-success">{{ $approved }}</h2>
            </div>
        </div>
    </div>

</div>

{{-- Grafik --}}
<div class="row mt-4">

    <!-- Status Request -->
    <div class="col-lg-8">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Status Request</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <!-- Jenis Request -->
    <div class="col-lg-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Jenis Request</h5>
            </div>
            <div class="card-body">
                <canvas id="jenisChart"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- Request Terbaru --}}
<div class="card shadow border-0 mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"> Request Terbaru</h5>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentRequests as $key => $request)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $request->detailBarang->nama_barang ?? '-' }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ ucfirst($request->request_type) }}
                            </span>
                        </td>

                        <td>
                            @if($request->status == 'pending')
                                <span class="badge bg-warning">Pending</span>

                            @elseif($request->status == 'approved')
                                <span class="badge bg-success">Approved</span>

                            @elseif($request->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>

                            @else
                                <span class="badge bg-secondary">
                                    {{ $request->status }}
                                </span>
                            @endif
                        </td>

                        <td>{{ $request->created_at->format('d M Y') }}</td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada request.
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// const statusChart = new Chart(document.getElementById('statusChart'), {
//     type: 'bar',
//     data: {
//         labels: ['Pending', 'Approved'],
//         datasets: [{
//             label: 'Jumlah Request',
//             data: [{{ $pending }}, {{ $approved }}],
//             backgroundColor: [
//                 '#f6c23e',
//                 '#1cc88a'
//             ],
//             borderRadius: 8
//         }]
//     },
//     options: {
//         responsive: true,
//         plugins: {
//             legend: {
//                 display: false
//             }
//         }
//     }
// });

const statusChart = new Chart(document.getElementById('statusChart'), {
    type: 'bar',
    data: {
        labels: ['Pending', 'Diverifikasi', 'Approved'],
        datasets: [{
            label: 'Jumlah Request',
            data: [
                {{ $pending }},
                {{ $verified }},
                {{ $approved }}
            ],
            backgroundColor: [
                '#f6c23e', // kuning
                '#4e73df', // biru
                '#1cc88a'  // hijau
            ],
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            }
        }
    }
});

const jenisChart = new Chart(document.getElementById('jenisChart'), {
    type: 'doughnut',
    data: {
        labels: ['Permintaan', 'Perbaikan'],
        datasets: [{
            data: [
                {{ $totalPermintaan }},
                {{ $totalPerbaikan }}
            ],
            backgroundColor: [
                '#4e73df',
                '#36b9cc'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endsection
<style>
#statusChart{
    height:260px !important;
}

#jenisChart{
    height:260px !important;
}
</style>