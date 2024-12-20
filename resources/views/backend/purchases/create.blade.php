@extends('layout')

@section('content')
    <main class="main-content position-relative border-radius-lg">
        <div class="d-flex justify-content-between">
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
                <div class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Form Pembelian</li>
                        </ol>
                        <h6 class="font-weight-bolder text-white mb-0">Form Pembelian</h6>
                    </nav>
                </div>
            </nav>
        </div>
        <div class="container mt-4">
            <div class="card shadow p-3">
                @if($flipbook->price == 0)
                    <!-- Tampilan untuk buku gratis -->
                    <div class="alert alert-success shadow-sm">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-gift fa-2x me-3"></i>
                            <h5 class="mb-0">Buku Gratis!</h5>
                        </div>
                        <p class="mb-3">Buku ini tersedia secara gratis. Anda dapat langsung membacanya tanpa perlu melakukan pembelian.</p>
                        <a href="{{ route('frontend.example1', $flipbook->id) }}" class="btn btn-success">
                            <i class="fas fa-book-reader me-2"></i>Baca Sekarang
                        </a>
                    </div>
                @else
                    <!-- Status Checks untuk buku berbayar -->
                    @php
                        $existingPurchase = \App\Models\Purchase::where('user_id', Auth::id())
                            ->where('book_id', $flipbook->id)
                            ->orderBy('created_at', 'desc')
                            ->first();
                    @endphp
                    @if($existingPurchase)
                        @if($existingPurchase->payment_status == -1)
                            <div class="alert alert-warning shadow-sm">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock fa-2x me-3"></i>
                                    <h5 class="mb-0">Pembelian Sedang Diproses!</h5>
                                </div>
                                <p class="mb-3">Anda telah melakukan pembelian untuk buku ini dan sedang menunggu konfirmasi.</p>
                                <a href="{{ route('purchases.index') }}" class="btn btn-warning">
                                    <i class="fas fa-history me-2"></i>Cek Status Pembelian
                                </a>
                            </div>
                        @elseif($existingPurchase->payment_status == 1)
                            <div class="alert alert-success shadow-sm">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle fa-2x me-3"></i>
                                    <h5 class="mb-0">Buku Sudah Dibeli!</h5>
                                </div>
                                <p class="mb-3">Anda telah memiliki buku ini. Silahkan nikmati buku Anda di perpustakaan digital.</p>
                                <a href="{{ route('library.index') }}" class="btn btn-success">
                                    <i class="fas fa-book-reader me-2"></i>Ke Perpustakaan Digital
                                </a>
                            </div>
                        @else
                            <div class="alert alert-info shadow-sm mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x me-3"></i>
                                    <p class="mb-0">Pembelian sebelumnya ditolak. Anda dapat mencoba membeli kembali.</p>
                                </div>
                            </div>
                            @include('backend.purchases.purchase-form')
                        @endif
                    @else
                        @include('backend.purchases.purchase-form')
                    @endif
                @endif
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .alert {
                border: none;
                border-radius: 10px;
                padding: 1.5rem;
            }

            .alert i {
                color: inherit;
            }

            .alert-warning {
                background-color: #fff3cd;
                color: #856404;
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
            }

            .alert-info {
                background-color: #d1ecf1;
                color: #0c5460;
            }

            .btn {
                border-radius: 6px;
                padding: 0.5rem 1rem;
                font-weight: 500;
            }
        </style>
    @endpush
    </main>
@endsection
