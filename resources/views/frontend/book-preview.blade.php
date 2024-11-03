<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

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
                            @if($book->price == 0)
                                <div class="alert alert-success">
                                    <i class="fas fa-gift me-2"></i>
                                    Buku ini <strong>GRATIS</strong>! Anda dapat membacanya langsung tanpa perlu membeli.
                                </div>
                                <a href="{{ route('frontend.example1', $book->id) }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-book-open me-2"></i>Baca Buku Gratis
                                </a>
                            @else
                                @php
                                    $existingPurchase = \App\Models\Purchase::existingPurchase(auth()->id(), $book->id);
                                @endphp

                                @if($existingPurchase instanceof \App\Models\Purchase)
                                    @if($existingPurchase->payment_status == -1)
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Status pembelian Anda masih <strong>{{ $existingPurchase->status_text }}</strong>.
                                            Anda dapat membaca buku ini setelah status pembelian berubah menjadi "Sukses".
                                        </div>
                                    @elseif($existingPurchase->payment_status == 1)
                                        @if($showSuccessConfirmation)
                                            <div class="alert alert-success">
                                                <i class="fas fa-check-circle me-2"></i>
                                                Pembelian Anda telah <strong>Sukses</strong>. Anda dapat membaca buku ini sekarang.
                                            </div>
                                        @endif
                                        <a href="{{ route('frontend.example1', $book->id) }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-book-open me-2"></i>Baca Buku
                                        </a>
                                    @elseif($existingPurchase->payment_status == 0)
                                        <div class="alert alert-danger">
                                            <i class="fas fa-times-circle me-2"></i>
                                            Pembelian Anda sebelumnya <strong>ditolak</strong>.
                                        </div>
                                        <div class="alert alert-info mt-2">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Silakan melakukan pembelian ulang untuk dapat membaca buku ini.
                                        </div>
                                        <div class="mt-3">
                                            <p><strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                                        </div>
                                        <a href="{{ route('purchases.create', ['flipbookId' => $book->id]) }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-shopping-cart me-2"></i>Beli Buku Kembali
                                        </a>
                                    @endif
                                @else
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Anda belum membeli buku ini. Silakan melakukan pembelian terlebih dahulu untuk dapat membaca buku ini.
                                    </div>
                                    <div class="mt-3">
                                        <p><strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                                    </div>
                                    <a href="{{ route('purchases.create', ['flipbookId' => $book->id]) }}" class="btn btn-primary">
                                        <i class="fas fa-shopping-cart me-2"></i>Beli Buku
                                    </a>
                                @endif
                            @endif
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Silakan login untuk membaca buku ini.
                            </div>
                            @if($book->price > 0)
                                <div class="mt-3">
                                    <p><strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                                </div>
                            @endif
                            <a href="{{ route('auth.index') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
