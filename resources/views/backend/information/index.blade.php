@extends('layout')

@section('content')
    <main class="main-content position-relative border-radius-lg">
        <div class="d-flex justify-content-between">
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
                <div class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Informasi</li>
                        </ol>
                        <h6 class="font-weight-bolder text-white mb-0">Informasi</h6>
                    </nav>
                </div>
            </nav>
        </div>
        <div class="container mt-4">
            <div class="card shadow">
                <div class="card-body">
                    @if($salesInfo)
                        <!-- Informasi Kontak -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-address-card text-primary me-2"></i>Informasi Kontak
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item d-flex align-items-center p-3 border rounded mb-3">
                                            <div class="icon-wrapper me-3">
                                                <i class="fas fa-envelope fa-lg text-primary"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="text-muted small">Email</div>
                                                <div class="fw-bold">{{ $salesInfo->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item d-flex align-items-center p-3 border rounded mb-3">
                                            <div class="icon-wrapper me-3">
                                                <i class="fas fa-phone fa-lg text-primary"></i>
                                            </div>
                                            <div class="info-content">
                                                <div class="text-muted small">Nomor Telepon</div>
                                                <div class="fw-bold">{{ $salesInfo->phone_number }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3"><i class="fas fa-university text-primary me-2"></i>Informasi Rekening Bank</h5>
                        <div class="row">
                            @foreach(['BRI' => 'bank_bri', 'BCA' => 'bank_bca', 'Mandiri' => 'bank_mandiri'] as $bankName => $bankField)
                                @if($salesInfo->$bankField)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border-primary">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $bankName }}</h6>
                                                <p class="card-text">
                                                    <strong>No. Rekening:</strong> {{ $salesInfo->$bankField }}<br>
                                                    <strong>Atas Nama:</strong> {{ $salesInfo->{$bankField.'_name'} ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <h5 class="mt-4 mb-3"><i class="fas fa-wallet text-primary me-2"></i>E-Wallet</h5>
                        <div class="row">
                            @foreach(['DANA' => 'dana', 'OVO' => 'ovo', 'GoPay' => 'gopay'] as $walletName => $walletField)
                                @if($salesInfo->$walletField)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border-success">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $walletName }}</h6>
                                                <p class="card-text">
                                                    <strong>Nomor:</strong> {{ $salesInfo->$walletField }}<br>
                                                    <strong>Atas Nama:</strong> {{ $salesInfo->{$walletField.'_name'} ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fas fa-edit me-2"></i>Edit Informasi
                        </button>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Belum ada informasi penjualan.
                        </div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-plus me-2"></i>Tambah Informasi
                        </button>
                    @endif
                </div>
            </div>
        </div>


    <!-- Create/Edit Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Mengubah ukuran modal menjadi lebih besar -->
            <div class="modal-content">
                <form action="{{ route('sales-information.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Informasi Penjualan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Informasi Kontak -->
                        <h6 class="mb-3">Informasi Kontak</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                           id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Bank -->
                        <h6 class="mb-3 mt-4">Informasi Bank</h6>
                        <div class="row">
                            <!-- BRI -->
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">Bank BRI</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="bank_bri" class="form-label">Nomor Rekening</label>
                                            <input type="text" class="form-control @error('bank_bri') is-invalid @enderror"
                                                   id="bank_bri" name="bank_bri" value="{{ old('bank_bri') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="bank_bri_name" class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control @error('bank_bri_name') is-invalid @enderror"
                                                   id="bank_bri_name" name="bank_bri_name" value="{{ old('bank_bri_name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- BCA -->
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">Bank BCA</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="bank_bca" class="form-label">Nomor Rekening</label>
                                            <input type="text" class="form-control @error('bank_bca') is-invalid @enderror"
                                                   id="bank_bca" name="bank_bca" value="{{ old('bank_bca') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="bank_bca_name" class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control @error('bank_bca_name') is-invalid @enderror"
                                                   id="bank_bca_name" name="bank_bca_name" value="{{ old('bank_bca_name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mandiri -->
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">Bank Mandiri</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="bank_mandiri" class="form-label">Nomor Rekening</label>
                                            <input type="text" class="form-control @error('bank_mandiri') is-invalid @enderror"
                                                   id="bank_mandiri" name="bank_mandiri" value="{{ old('bank_mandiri') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="bank_mandiri_name" class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control @error('bank_mandiri_name') is-invalid @enderror"
                                                   id="bank_mandiri_name" name="bank_mandiri_name" value="{{ old('bank_mandiri_name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- E-Wallet -->
                        <h6 class="mb-3 mt-4">E-Wallet</h6>
                        <div class="row">
                            <!-- DANA -->
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">DANA</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="dana" class="form-label">Nomor</label>
                                            <input type="text" class="form-control @error('dana') is-invalid @enderror"
                                                   id="dana" name="dana" value="{{ old('dana') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="dana_name" class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control @error('dana_name') is-invalid @enderror"
                                                   id="dana_name" name="dana_name" value="{{ old('dana_name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- OVO -->
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">OVO</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="ovo" class="form-label">Nomor</label>
                                            <input type="text" class="form-control @error('ovo') is-invalid @enderror"
                                                   id="ovo" name="ovo" value="{{ old('ovo') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ovo_name" class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control @error('ovo_name') is-invalid @enderror"
                                                   id="ovo_name" name="ovo_name" value="{{ old('ovo_name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- GoPay -->
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">GoPay</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="gopay" class="form-label">Nomor</label>
                                            <input type="text" class="form-control @error('gopay') is-invalid @enderror"
                                                   id="gopay" name="gopay" value="{{ old('gopay') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="gopay_name" class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control @error('gopay_name') is-invalid @enderror"
                                                   id="gopay_name" name="gopay_name" value="{{ old('gopay_name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal menggunakan struktur yang sama -->
    @if($salesInfo)
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('sales-information.update', $salesInfo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Informasi Penjualan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Informasi Kontak -->
                            <h6 class="mb-3">Informasi Kontak</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit_email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="edit_email" name="email" value="{{ old('email', $salesInfo->email) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit_phone_number" class="form-label">Phone Number</label>
                                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                               id="edit_phone_number" name="phone_number" value="{{ old('phone_number', $salesInfo->phone_number) }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Bank -->
                            <h6 class="mb-3 mt-4">Informasi Bank</h6>
                            <div class="row">
                                <!-- Bank Cards (BRI, BCA, Mandiri) -->
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">Bank BRI</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="edit_bank_bri">Nomor Rekening</label>
                                                <input type="text" class="form-control" id="edit_bank_bri" name="bank_bri"
                                                       value="{{ old('bank_bri', $salesInfo->bank_bri) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_bank_bri_name">Nama Pemilik</label>
                                                <input type="text" class="form-control" id="edit_bank_bri_name" name="bank_bri_name"
                                                       value="{{ old('bank_bri_name', $salesInfo->bank_bri_name) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">Bank BCA</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="edit_bank_bca">Nomor Rekening</label>
                                                <input type="text" class="form-control" id="edit_bank_bca" name="bank_bca"
                                                       value="{{ old('bank_bca', $salesInfo->bank_bca) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_bank_bca_name">Nama Pemilik</label>
                                                <input type="text" class="form-control" id="edit_bank_bca_name" name="bank_bca_name"
                                                       value="{{ old('bank_bca_name', $salesInfo->bank_bca_name) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">Bank Mandiri</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="edit_bank_mandiri">Nomor Rekening</label>
                                                <input type="text" class="form-control" id="edit_bank_mandiri" name="bank_mandiri"
                                                       value="{{ old('bank_mandiri', $salesInfo->bank_mandiri) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_bank_mandiri_name">Nama Pemilik</label>
                                                <input type="text" class="form-control" id="edit_bank_mandiri_name" name="bank_mandiri_name"
                                                       value="{{ old('bank_mandiri_name', $salesInfo->bank_mandiri_name) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- E-Wallet Section -->
                            <h6 class="mb-3 mt-4">E-Wallet</h6>
                            <div class="row">
                                <!-- E-Wallet Cards (DANA, OVO, GoPay) -->
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">DANA</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="edit_dana">Nomor</label>
                                                <input type="text" class="form-control" id="edit_dana" name="dana"
                                                       value="{{ old('dana', $salesInfo->dana) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_dana_name">Nama Pemilik</label>
                                                <input type="text" class="form-control" id="edit_dana_name" name="dana_name"
                                                       value="{{ old('dana_name', $salesInfo->dana_name) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">OVO</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="edit_ovo">Nomor</label>
                                                <input type="text" class="form-control" id="edit_ovo" name="ovo"
                                                       value="{{ old('ovo', $salesInfo->ovo) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_ovo_name">Nama Pemilik</label>
                                                <input type="text" class="form-control" id="edit_ovo_name" name="ovo_name"
                                                       value="{{ old('ovo_name', $salesInfo->ovo_name) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">GoPay</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="edit_gopay">Nomor</label>
                                                <input type="text" class="form-control" id="edit_gopay" name="gopay"
                                                       value="{{ old('gopay', $salesInfo->gopay) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_gopay_name">Nama Pemilik</label>
                                                <input type="text" class="form-control" id="edit_gopay_name" name="gopay_name"
                                                       value="{{ old('gopay_name', $salesInfo->gopay_name) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('{{ $salesInfo ? 'editModal' : 'createModal' }}'));
                myModal.show();
            });
        </script>
    @endif
    <style>
        .info-item {
            margin-bottom: 10px;
        }
        .info-item strong {
            margin-right: 5px;
        }
        .card-title {
            color: #007bff;
            font-weight: bold;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-item strong {
            margin-right: 5px;
        }
        .card-title {
            color: #007bff;
            font-weight: bold;
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: box-shadow 0.3s ease-in-out;
        }
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card-header {
            font-weight: bold;
        }
        .modal-lg {
            max-width: 50%;
        }

    </style>
    </main>
@endsection
