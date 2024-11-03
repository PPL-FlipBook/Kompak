@extends('layout')

@section('content')
    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Detail Pembelian</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Detail Pembelian</h6>
                </nav>
            </div>
        </nav>

        <div class="row m-md-4">
            <div class="col-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Detail Pembelian</h6>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <tbody>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Buku</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="ms-2">
                                            <h6 class="text-sm mb-0">{{ $purchase->book->title }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Pembelian</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="ms-2">
                                            <h6 class="text-sm mb-0">{{ $purchase->purchase_date }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="ms-2">
                                            <h6 class="text-sm mb-0">{{ $purchase->quantity }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Pembayaran</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="ms-2">
                                            <h6 class="text-sm mb-0">{{ $purchase->total_amount }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pembayaran</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="ms-2">
                                            <h6 class="text-sm mb-0">{{ $purchase->status_text }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Metode Pembayaran</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="ms-2">
                                            <h6 class="text-sm mb-0">{{ $purchase->payment_method }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti Pembayaran</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="ms-2">
                                            @if($purchase->payment_proof)
                                                <img src="{{ asset('storage/' . $purchase->payment_proof) }}"
                                                     alt="Bukti Pembayaran"
                                                     class="img-fluid"
                                                     style="max-width: 200px;">
                                            @else
                                                <p class="text-sm mb-0">Tidak ada bukti pembayaran</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="ms-2">
                                            @if($purchase->payment_status == 1)
                                                <a href="{{ route('books.show', $purchase->book->id) }}"
                                                   class="btn btn-sm btn-primary"
                                                   target="_blank">
                                                    Baca Buku
                                                </a>
                                            @else
                                                <button type="button"
                                                        class="btn btn-sm btn-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#purchaseNotComplete">
                                                    Baca Buku
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal untuk pembelian yang belum sukses -->
    @if($purchase->payment_status != 1)
        <div class="modal fade" id="purchaseNotComplete" tabindex="-1" aria-labelledby="purchaseNotCompleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="purchaseNotCompleteLabel">Informasi Pembelian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $purchase->book->cover_image) }}"
                                 alt="{{ $purchase->book->title }}"
                                 class="img-fluid rounded"
                                 style="max-height: 200px;">
                        </div>
                        <h5 class="mb-3">{{ $purchase->book->title }}</h5>
                        <p class="mb-3">{{ $purchase->book->description }}</p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Maaf, Anda belum dapat membaca buku ini karena status pembelian
                            masih <strong>{{ $purchase->status_text }}</strong>.
                            Silakan tunggu hingga status pembelian berubah menjadi "Sukses".
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
