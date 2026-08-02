@extends('layouts.penerima')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Data Penerima</h1>

    <!-- Form Filter & Preview -->
    <form action="{{ route('penerima.preview') }}" method="GET" target="_blank" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <label>Tahun</label>
            <select name="tahun" class="form-control">
                <option value="">Semua</option>
                @for($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>


        <div class="col-md-3">
            <label>Bulan</label>
            <select name="bulan" class="form-control">
                <option value="">Semua</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Tanggal</label>
            <select name="tanggal" class="form-control">
                <option value="">Semua</option>
                @for($i=1;$i<=31;$i++)
                    <option value="{{ sprintf('%02d',$i) }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        {{-- <div class="col-md-3">
            <label>Jenis Permintaan</label>
            <select name="request_type" class="form-control">
                <option value="">Semua</option>
                <option value="permintaan">📦 Permintaan Barang</option>
                <option value="perbaikan">🛠️ Perbaikan Barang</option>
            </select>
        </div> --}}
        {{-- <div class="col-md-3">
            <label>Bidang</label>
            <select name="bidang_id" class="form-control">
                <option value="">Semua Bidang</option>
                @foreach($bidangs as $bidang)
                    <option value="{{ $bidang->id }}">
                        {{ $bidang->nama }}
                    </option>
                @endforeach
            </select>
        </div> --}}

    </div>

    <button class="btn btn-primary mt-3">
        <i class="fas fa-eye"></i> preview
    </button>
   {{-- <a href="{{ route('penerima.export.csv') }}"
   class="btn btn-success mb-3">
    Export Excel (CSV)
</a> --}}
<button
    formaction="{{ route('penerima.export.csv') }}"
    formmethod="GET"
    class="btn btn-success mt-2">
    Export Excel
</button>



</form>

</div>
@endsection
