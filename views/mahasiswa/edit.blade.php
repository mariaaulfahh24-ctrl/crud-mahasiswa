<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 15px; }
        .card-header { border-radius: 15px 15px 0 0 !important; }
        .invalid-feedback { font-weight: 500; }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- 1. TAMBAHKAN: Pesan Sukses (Jika ada session success) --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- 2. Ringkasan Error Validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <strong><i class="bi bi-exclamation-octagon-fill me-2"></i> Mohon periksa kembali:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-header bg-warning text-dark py-3">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square"></i> Edit Data Mahasiswa</h4>
                    </div>
                    <div class="card-body p-4">
                        {{-- Form Action menggunakan NIM sesuai Controller --}}
                        <form action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="nim" class="form-label fw-bold">NIM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                       id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" 
                                       placeholder="Masukkan NIM" required>
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">NIM merupakan identitas unik mahasiswa.</small>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" 
                                       placeholder="Masukkan Nama Lengkap" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kelas" class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kelas') is-invalid @enderror" 
                                           id="kelas" name="kelas" value="{{ old('kelas', $mahasiswa->kelas) }}" 
                                           placeholder="Contoh: 4A" required>
                                    @error('kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="matakuliah" class="form-label fw-bold">Mata Kuliah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('matakuliah') is-invalid @enderror" 
                                           id="matakuliah" name="matakuliah" value="{{ old('matakuliah', $mahasiswa->matakuliah) }}" 
                                           placeholder="Contoh: Pemrograman Web" required>
                                    @error('matakuliah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-warning px-4 fw-bold shadow-sm">
                                    <i class="bi bi-save"></i> Update Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center text-muted mt-3"><small>&copy; 2026 Sistem Informasi Mahasiswa</small></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>