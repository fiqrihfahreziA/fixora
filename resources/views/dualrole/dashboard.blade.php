@extends('layouts.dualrole')

@section('content')
    <div class="container">

    <!-- Card A -->
 <div class="row justify-content-center g-4">

    <!-- CARD ATASAN -->
    <div class="col-md-4">
        <a href="{{ route('multirole.permintaan') }}" class="text-decoration-none">
            <div class="card role-card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <i class="bi bi-person-workspace role-icon text-primary"></i>
                    <h4 class="mt-3 fw-bold text-dark">Menu Atasan</h4>
                    <p class="text-muted">Persetujuan permintaan barang</p>
                </div>
            </div>
        </a>
    </div>

    <!-- CARD PENERIMA -->
    <div class="col-md-4">
        <a href="{{ route('multirole.permintaann') }}" class="text-decoration-none">
            <div class="card role-card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <i class="bi bi-box-seam role-icon text-success"></i>
                    <h4 class="mt-3 fw-bold text-dark">Menu Penerima</h4>
                    <p class="text-muted">Pengelolaan barang masuk</p>
                </div>
            </div>
        </a>
    </div>

</div>

</div> 
@endsection

