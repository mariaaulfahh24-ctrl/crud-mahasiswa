@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-6 fw-bold">📋 Data Mahasiswa</h1>
        <div>
            {{-- Tombol Daftar MK dan Cetak PDF dinonaktifkan sementara agar tidak error --}}
            {{-- <a href="#" class="btn btn-outline-secondary me-2">📚 Daftar MK</a> --}}
            {{-- <a href="#" class="btn btn-danger me-2">📄 Cetak PDF</a> --}}

            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
            </a>

            {{-- Tombol Asset disembunyikan jika rute assets.store belum siap --}}
            {{-- <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                ➕ Tambah Asset
            </button> --}}
        </div>
    </div>

    {{-- Alert Notifikasi --}}
    @if(session('msg'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0 overflow-hidden" style="border-radius: 15px;">
        <div class="card-body p-0"> 
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Mata Kuliah</th> 
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $mahasiswa)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration }}</td>
                            <td><span class="badge bg-secondary">{{ $mahasiswa->nim }}</span></td>
                            <td class="fw-bold text-dark">{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->kelas }}</td>
                            <td>
                                {{-- Menyesuaikan dengan Modul 2: Menampilkan string mata kuliah --}}
                                {{ $mahasiswa->matakuliah }}
                            </td>
                            <td class="text-center pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('mahasiswa.edit', $mahasiswa->nim) }}" 
                                       class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                                    
                                    <form action="{{ route('mahasiswa.destroy', $mahasiswa->nim) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Hapus data mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger ms-1">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <img src="https://illustrations.popsy.co/gray/data-report.svg" alt="empty" style="width: 150px; opacity: 0.5;">
                                <h5 class="mt-3 text-muted">Belum ada data mahasiswa</h5>
                                <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-primary mt-2">Tambah Sekarang</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <p class="text-muted small">Total: {{ $mahasiswas->count() }} data mahasiswa.</p>
    </div>
</div>

{{-- Bagian Modal Asset tetap dipertahankan namun pastikan rute assets.store sudah ada di web.php --}}
@if(Route::has('assets.store'))
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog shadow-lg">
        <div class="modal-content">
            <form action="{{ route('assets.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">➕ Tambah Asset Laboratorium</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Asset</label>
                        <input type="text" name="nama_asset" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Merk</label>
                        <input type="text" name="merk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Simpan Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection