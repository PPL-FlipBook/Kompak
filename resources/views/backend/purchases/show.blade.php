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

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Detail Pembelian</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            @if($purchase->payment_status == 1)
                                <div class="alert alert-success mx-4 mt-4" role="alert">
                                    <strong>Selamat!</strong> Pembelian Anda telah berhasil dan disetujui.
                                </div>
                            @endif
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Buku</td>
                                        <td class="align-middle text-sm">
                                            <h6 class="mb-0 text-sm">{{ $purchase->book->title }}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</td>
                                        <td class="align-middle text-sm">
                                            <h6 class="mb-0 text-sm">{{ $purchase->quantity }}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Pembayaran</td>
                                        <td class="align-middle text-sm">
                                            <h6 class="mb-0 text-sm">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pembayaran</td>
                                        <td class="align-middle text-sm">
                                            <span class="badge badge-sm bg-gradient-{{ $purchase->payment_status == 1 ? 'success' : 'warning' }}">{{ $purchase->status_text }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Metode Pembayaran</td>
                                        <td class="align-middle text-sm">
                                            <h6 class="mb-0 text-sm">{{ $purchase->payment_method }}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti Pembayaran</td>
                                        <td class="align-middle text-sm">
                                            @if($purchase->payment_proof)
                                                <a href="{{ asset('storage/' . $purchase->payment_proof) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Bukti</a>
                                            @else
                                                <span class="text-xs font-weight-bold">Tidak ada bukti pembayaran</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary btn-sm mb-0">Kembali</a>
                                @if($purchase->payment_status == 1)
                                    <a href="{{ route('books.show', $purchase->book->id) }}" class="btn btn-primary btn-sm mb-0">Baca Buku</a>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#purchaseNotComplete">
                                        Baca Buku
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
                            <img src="{{ asset('storage/books/images/' . $purchase->book->cover_image) }}" alt="{{ $purchase->book->title }}" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                        <h5 class="mb-3">{{ $purchase->book->title }}</h5>
                        <p class="mb-3">{{ $purchase->book->description }}</p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Maaf, Anda belum dapat membaca buku ini karena status pembelian masih <strong>{{ $purchase->status_text }}</strong>.
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
