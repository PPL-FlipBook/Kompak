@extends('layout')

@section('content')
    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Daftar Pembelian</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Daftar Pembelian</h6>
                </nav>
            </div>
        </nav>

        <div class="row m-md-4">
            <!-- Section Buku Gratis -->
            @if($freeBooks->count() > 0)
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3 bg-success text-white">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2"><i class="fas fa-gift me-2"></i>Buku Gratis</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($freeBooks as $book)
                                    <div class="col-md-3 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            <img src="{{ asset('storage/books/images/' . $book->cover_image) }}"
                                                 class="card-img-top"
                                                 alt="{{ $book->title }}"
                                                 style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title text-truncate">{{ $book->title }}</h6>
                                                <p class="card-text text-success mb-2">
                                                    <i class="fas fa-tag me-1"></i>GRATIS
                                                </p>
                                                <a href="{{ route('frontend.example1', $book->id) }}"
                                                   class="btn btn-success btn-sm w-100">
                                                    <i class="fas fa-book-reader me-1"></i>Baca Sekarang
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Section Daftar Pembelian -->
            <div class="col-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Daftar Pembelian Anda</h6>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mx-3 mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <!-- Tabel yang sudah ada -->
                        <table class="table align-items-center">
                            <!-- ... kode tabel yang sudah ada ... -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Hapus Pembelian -->
    @foreach($purchases as $purchase)
        <div class="modal fade" id="hapusPembelian-{{ $purchase->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Pembelian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus pembelian ini?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @push('styles')
        <style>
            .card-img-top {
                border-top-left-radius: calc(0.375rem - 1px);
                border-top-right-radius: calc(0.375rem - 1px);
            }

            .card.h-100 {
                transition: transform 0.2s;
            }

            .card.h-100:hover {
                transform: translateY(-5px);
            }

            .text-truncate {
                max-width: 100%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
    @endpush
@endsection
