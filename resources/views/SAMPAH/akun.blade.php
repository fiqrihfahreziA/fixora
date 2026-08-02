@extends('layouts.admin')

@section('content')
<h2 class="mb-4">Daftar Akun Pengguna</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Daftar Akun Pengguna</h5>

            <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahAkun">
                + Tambah Akun
            </button>
        </div>

        {{-- TABLE RESPONSIVE --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Karyawan</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($userr as $user)
                        <tr>
                            <td>{{ $userr->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>{{ $user->karyawan->nama ?? '-' }}</td>
                            <td>{{ $user->karyawan->jabatan ?? '-' }}</td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td>
                                @if ($user->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>

                            <td class="text-nowrap">
                                <button class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditUser{{ $user->id }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('AKUN AKAN DIHAPUS PERMANEN. Lanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Belum ada akun pengguna
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted small">
                Menampilkan
                {{ $userr->firstItem() }}
                –
                {{ $userr->lastItem() }}
                dari
                {{ $userr->total() }}
                akun
            </div>

            {{ $userr->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

{{-- MODAL TAMBAH AKUN --}}
<div class="modal fade" id="modalTambahAkun" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.pengguna.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Akun Pengguna</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- <div class="mb-3">
                        <label>Karyawan</label>
                        <select name="karyawan_id" class="form-select" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach ($karyawans as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->nama }} – {{ $k->jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <select name="karyawan_id" class="form-select" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawans as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->nama }} – {{ $k->jabatan }}
                            </option>
                        @endforeach
                    </select>


                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-select" required>
                            <option value="pemohon">Pemohon</option>
                            <option value="penerima">Penerima</option>
                            <option value="atasan">Atasan</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal Edit Akun -->
<div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST"
                  action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Akun Pengguna</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Karyawan (readonly) -->
                    <div class="mb-3">
                        <label>Karyawan</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->karyawan->nama ?? '-' }}"
                               readonly>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $user->email }}"
                               required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Kosongkan jika tidak ingin mengubah">
                        <small class="text-muted">
                            Biarkan kosong jika tidak ingin mengganti password
                        </small>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role"
                                class="form-select"
                                required>
                            <option value="pemohon" {{ $user->role == 'pemohon' ? 'selected' : '' }}>Pemohon</option>
                            <option value="penerima" {{ $user->role == 'penerima' ? 'selected' : '' }}>Penerima</option>
                            <option value="atasan"   {{ $user->role == 'atasan' ? 'selected' : '' }}>Atasan</option>
                            <option value="admin"    {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label>Status Akun</label>
                        <select name="is_active"
                                class="form-select"
                                required>
                            <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ ! $user->is_active ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-warning">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>



@endsection

