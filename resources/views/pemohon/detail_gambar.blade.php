<!DOCTYPE html>
<html>
<head>
    <title>Preview Gambar</title>
    <link rel="icon" href="{{ asset('gambar/rsmz.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

    <div class="card shadow-lg border-0">
        
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Preview Gambar Permintaan</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- Gambar -->
                <div class="col-md-7 text-center">
                    @if(!empty($req->detailBarang->gambar))
                        <img 
                            src="{{ asset('public/storage/'.$req->detailBarang->gambar) }}" 
                            class="img-fluid rounded shadow">
                    @else
                        <div class="alert alert-warning">
                            Gambar tidak tersedia
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="col-md-5">

                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nama Barang</th>
                            <td>{{ $req->detailBarang->nama_barang }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $req->status }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Ruangan</th>
                            <td>{{ $req->ruangan }}</td>
                        </tr>

                        <tr>
                    @if($req->request_type == 'permintaan')
                        <tr>
                            <th>Alasan Permintaan</th>
                            <td>{{ $req->detailBarang->alasan ?? '-' }}</td>
                        </tr>
                        @elseif($req->request_type == 'perbaikan')
                        <tr>
                            <th>Deskripsi Kerusakan</th>
                            <td>{{ $req->detailBarang->deskripsi ?? '-' }}</td>
                        </tr>
                        @endif
                    </table>

                    <a href="{{ asset('public/storage/'.$req->detailBarang->gambar) }}" 
                       class="btn btn-success w-100"
                       download>
                        Download Gambar
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>