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
            <div class="col-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Daftar Pembelian Anda</h6>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table align-items-center">
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
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="ms-2">
                                                <h6 class="text-sm mb-0">{{ $loop->iteration }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="ms-2">
                                                <h6 class="text-sm mb-0">{{ $purchase->book->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="ms-2">
                                                <h6 class="text-sm mb-0">{{ $purchase->purchase_date }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="ms-2">
                                                <h6 class="text-sm mb-0">{{ $purchase->quantity }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="ms-2">
                                                <h6 class="text-sm mb-0">{{ $purchase->total_amount }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="ms-2">
                                                <h6 class="text-sm mb-0">{{ $purchase->status_text }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @can('admin')
                                            @if($purchase->payment_status != 1)
                                                <a href="{{ route('purchases.updateStatus', ['purchase' => $purchase->id, 'status' => 1]) }}"
                                                   class="text-success" title="Tandai Selesai">
                                                    <i class="fas fa-check-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('purchases.updateStatus', ['purchase' => $purchase->id, 'status' => 0]) }}"
                                                   class="text-warning" title="Tandai Proses">
                                                    <i class="fas fa-sync-alt"></i>
                                                </a>
                                            @endif
                                        @endcan
                                        <a href="{{ route('purchases.show', $purchase->id) }}" class="text-primary" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#hapusPembelian-{{ $purchase->id }}" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
@endsection
