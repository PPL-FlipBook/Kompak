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

        <div class="container-fluid py-4">
            <!-- Section Buku Gratis -->
            @if($freeBooks->count() > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pb-0 p-3 bg-success text-white">
                                <h6 class="mb-0"><i class="fas fa-gift me-2"></i>Buku Gratis</h6>
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
                </div>
            @endif

            <!-- Section Daftar Pembelian -->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Daftar Pembelian</h6>
                            </div>
                            @if(session('success'))
                                <div class="alert alert -success mx-3 mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger mx-3 mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Buku</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Pembelian</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Pembayaran</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pembelian</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($purchases->sortByDesc('purchase_date') as $purchase)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $purchase->book->title }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $purchase->purchase_date }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $purchase->quantity }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</p>
                                                </td>
                                                <td>
                                                    <span class="badge badge-sm bg-gradient-{{ $purchase->payment_status == 1 ? 'success' : ($purchase->payment_status == 0 ? 'danger' : 'warning') }}">
                                                        {{ $purchase->status_text }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @can('admin')
                                                        @if($purchase->payment_status == 1)
                                                            <form action="{{ route('purchases.updateStatus', ['purchase' => $purchase->id, 'status' => -1]) }}"
                                                                  method="POST"
                                                                  class="d-inline-block">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-link p-0 mx-1" title="Ubah Status">
                                                                    <i class="fas fa-sync-alt text-warning"></i>
                                                                </button>
                                                            </form>
                                                        @elseif($purchase->payment_status == -1)
                                                            @if(auth()->user()->id === $purchase->book->user_id) <!-- Cek apakah admin yang mengupload -->
                                                            <form action="{{ route('purchases.updateStatus', ['purchase' => $purchase->id, 'status' => 1]) }}"
                                                                  method="POST"
                                                                  class="d-inline-block">
                                                                @csrf
                                                                @method('PUT')
                                                                <a type="submit" class="btn btn-link p-0 mx-1" data-bs-toggle="modal" data-bs-target="#setujuiPembelian-{{ $purchase->id }}" title="Setujui">
                                                                    <i class="fas fa-check-circle text-success"></i>
                                                                </a>
                                                            </form>
                                                            <form action="{{ route('purchases.updateStatus', ['purchase' => $purchase->id, 'status' => 0]) }}"
                                                                  method="POST"
                                                                  class="d-inline-block">
                                                                @csrf
                                                                @method('PUT')
                                                                <a type="submit" class="btn btn-link p-0 mx-1" data-bs-toggle="modal" data-bs-target="#tolakPembelian-{{ $purchase->id }}" title="Tolak">
                                                                    <i class="fas fa-times-circle text-danger"></i>
                                                                </a>
                                                            </form>
                                                            @endif
                                                        @endif
                                                    @endcan

                                                    <a href="{{ route('purchases.show', $purchase->id) }}"
                                                       class="btn btn-link p-0 mx-1"
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye text-primary"></i>
                                                    </a>

                                                    @if($purchase->payment_status == -1 || $purchase->payment_status == 0)
                                                        <a href="#"
                                                           class="btn btn-link p-0 mx-1"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#hapusPembelian-{{ $purchase->id }}"
                                                           title="Hapus">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </a>
                                                    @endif

                                                    @if($purchase->payment_status == 1)
                                                        <a href="{{ route('frontend.example1', $purchase->book->id) }}"
                                                           class="btn btn-link p-0 mx-1"
                                                           title="Baca Buku">
                                                            <i class="fas fa-book-reader text-success"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data pembelian</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Modal-modal -->
            @foreach($purchases as $purchase)
                <!-- Modal Setujui -->
                <div class="modal fade" id="setujuiPembelian-{{ $purchase->id }}" tabindex="-1" aria-labelledby="setujuiPembelianLabel-{{ $purchase->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="setujuiPembelianLabel-{{ $purchase->id }}">Setujui Pembelian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda yakin ingin menyetujui pembelian buku "{{ $purchase->book->title }}"?</p>
                                <p class="text-sm text-muted">
                                    Total Pembayaran: Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('purchases.updateStatus', ['purchase' => $purchase->id, 'status' => 1]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Setujui</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tolak -->
                <div class="modal fade" id="tolakPembelian-{{ $purchase->id }}" tabindex="-1" aria-labelledby="tolakPembelianLabel-{{ $purchase->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tolakPembelianLabel-{{ $purchase->id }}">Tolak Pembelian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda yakin ingin menolak pembelian ini?</p>
                                <p class="text-danger">Perhatian: Tindakan ini tidak dapat dibatalkan!</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('purchases.updateStatus', ['purchase' => $purchase->id, 'status' => 0]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusPembelian-{{ $purchase->id }}" tabindex="-1 ">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hapus Pembelian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda yakin ingin menghapus pembelian ini?</p>
                                <p class="text-danger">Perhatian: Tindakan ini tidak dapat dibatalkan!</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModals = [].slice.call(document.querySelectorAll('.modal'))
                myModals.forEach(function(modalEl) {
                    new bootstrap.Modal(modalEl)
                })
            })
        </script>
    @endpush
@endsection
