@extends('layouts.main.direktur')

@section('content')
<div class="row g-4">
    <!-- Card Kiri - Pengadaan -->
    <div class="col-md-6">
        <a href="{{ route('direktur.pengadaan') }}" class="text-decoration-none d-block">
            <div class="card card-menu card-pengadaan h-100">
                <div class="card-body text-center p-5">
                    <div class="icon-box mb-4">
                        <i class="bi bi-cart-plus"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Pengadaan</h4>
                    <p class="text-muted mb-4">Ajukan permohonan pengadaan barang dan perlengkapan</p>
                    <span class="btn btn-success btn-lg px-4">
                        <i class="bi bi-arrow-right-circle me-2"></i> Lanjutkan
                    </span>
                </div>
            </div>
        </a>
    </div>

    <!-- Card Kanan - Pemeliharaan -->
    {{-- <div class="col-md-6">
        <a href="{{ route('pemohon.permintaan') }}" class="text-decoration-none d-block">
            <div class="card card-menu card-pemeliharaan h-100">
                <div class="card-body text-center p-5">
                    <div class="icon-box mb-4">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Pemeliharaan</h4>
                    <p class="text-muted mb-4">Ajukan permohonan pemeliharaan fasilitas dan peralatan</p>
                    <span class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-arrow-right-circle me-2"></i> Lanjutkan
                    </span>
                </div>
            </div>
        </a>
    </div> --}}
</div>

@endsection

@push('styles')
<style>
    /* =============================================
       CARD MENU
    ============================================= */
    .card-menu {
        border: none;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        cursor: pointer;
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        position: relative;
        overflow: hidden;
    }

    /* Garis atas */
    .card-menu::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        transition: height 0.4s ease;
    }

    .card-pengadaan::before {
        background: linear-gradient(90deg, #34c38f, #2a9d8f);
    }

    .card-pemeliharaan::before {
        background: linear-gradient(90deg, #4a90e2, #357abd);
    }

    /* Hover effect */
    .card-menu:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
    }

    .card-menu:hover::before {
        height: 8px;
    }

    /* =============================================
       ICON BOX
    ============================================= */
    .icon-box {
        width: 100px;
        height: 100px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 50px;
        transition: all 0.5s ease;
    }

    .card-pengadaan .icon-box {
        background: linear-gradient(135deg, rgba(52, 195, 143, 0.1), rgba(42, 157, 143, 0.1));
        color: #34c38f;
    }

    .card-pemeliharaan .icon-box {
        background: linear-gradient(135deg, rgba(74, 144, 226, 0.1), rgba(53, 122, 189, 0.1));
        color: #4a90e2;
    }

    /* Hover icon */
    .card-pengadaan:hover .icon-box {
        background: linear-gradient(135deg, #34c38f, #2a9d8f);
        color: white;
        transform: scale(1.1) rotate(10deg);
        box-shadow: 0 15px 40px rgba(52, 195, 143, 0.3);
    }

    .card-pemeliharaan:hover .icon-box {
        background: linear-gradient(135deg, #4a90e2, #357abd);
        color: white;
        transform: scale(1.1) rotate(-10deg);
        box-shadow: 0 15px 40px rgba(74, 144, 226, 0.3);
    }

    /* =============================================
       BUTTON
    ============================================= */
    .card-menu .btn {
        border-radius: 50px;
        padding: 12px 35px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .card-pengadaan .btn-success {
        background: linear-gradient(135deg, #34c38f, #2a9d8f);
        border: none;
    }

    .card-pemeliharaan .btn-primary {
        background: linear-gradient(135deg, #4a90e2, #357abd);
        border: none;
    }

    .card-menu:hover .btn {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    }

    /* =============================================
       ANIMASI MASUK
    ============================================= */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-pengadaan {
        animation: fadeInUp 0.6s ease forwards;
    }

    .card-pemeliharaan {
        animation: fadeInUp 0.6s ease 0.2s forwards;
        opacity: 0;
    }

    /* =============================================
       STATISTIK
    ============================================= */
    .card.border-0 {
        border-radius: 16px !important;
        transition: all 0.3s ease;
    }

    .card.border-0:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
    }

    /* =============================================
       RESPONSIVE
    ============================================= */
    @media (max-width: 768px) {
        .card-menu .card-body {
            padding: 30px 20px !important;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            font-size: 40px;
        }

        .card-menu h4 {
            font-size: 20px;
        }

        .card-menu .btn {
            font-size: 14px;
            padding: 10px 25px;
        }

        .card-menu .text-muted {
            font-size: 14px;
        }
    }

    /* =============================================
       RIPPLE EFFECT
    ============================================= */
    .card-menu {
        position: relative;
        overflow: hidden;
    }

    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: rippleAnim 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes rippleAnim {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // =============================================
    // RIPPLE EFFECT
    // =============================================
    document.querySelectorAll('.card-menu').forEach(card => {
        card.addEventListener('click', function(e) {
            // Cegah ripple jika klik di dalam link/button
            if (e.target.closest('a')) return;

            const ripple = document.createElement('span');
            ripple.classList.add('ripple');

            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size/2) + 'px';

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
</script>
@endpush