@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        <div class="text-center">
                            <img src="{{ asset('storage/books/images/' . $book->cover_image) }}"
                                 alt="{{ $book->title }}"
                                 class="img-fluid rounded mb-3"
                                 style="max-height: 300px;">

                            <h3 class="mb-3">{{ $book->title }}</h3>
                            <p class="mb-4">{{ $book->description }}</p>

                            @auth
                                @if(isset($purchase))
                                    @if($purchase->payment_status == 0) {{-- Jika status ditolak --}}
                                    <div class="alert alert-danger">
                                        <i class="fas fa-times-circle me-2"></i>
                                        Pembelian Anda sebelumnya telah ditolak. Anda dapat mencoba membeli kembali.
                                    </div>
                                    @elseif($purchase->payment_status == -1) {{-- Jika status pending --}}
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Status pembelian Anda masih pending. Mohon tunggu konfirmasi dari admin.
                                    </div>
                                    @elseif($purchase->payment_status == 1) {{-- Jika status disetujui --}}
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Pembelian Anda telah disetujui. Anda dapat membaca buku ini sekarang.
                                    </div>
                                    <a href="{{ route('frontend.example1', $book->id) }}" class="btn btn-success">
                                        Baca Buku
                                    </a>
                                    @endif
                                @else
                                    <a href="{{ route('purchases.create', ['book' => $book->id]) }}"
                                       class="btn btn-primary">
                                        Beli Buku
                                    </a>
                                @endif
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Silakan login untuk membeli dan membaca buku ini.
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
