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
    <style>
        .book-image {
            width: 100%; /* Mengatur lebar gambar agar sesuai dengan kolom */
            height: auto; /* Mempertahankan rasio aspek */
            max-height: 300px; /* Atur tinggi maksimum untuk gambar */
            object-fit: cover; /* Memastikan gambar terpotong dengan baik */
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                    <div class="row">
                        <!-- Sampul Buku -->
                        <div class="col-md-4">
                            @if($book->cover_image)
                            <img src="{{ asset('storage/books/images/' . $book->cover_image) }}"
                                 alt="{{ $book->title }}"
                                 class="img-fluid rounded"
                                 style="max-height: 500px; object-fit: cover;">
                            @else
                                <img src="https://st4.depositphotos.com/14953852/24787/v/450/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg"
                                     class="book-image mb-3"
                                     alt="No image available">
                            @endif
                        </div>

                        <!-- Informasi Buku -->
                        <div class="col-md-8">
                            <h3 class="mb-3">{{ $book->title }}</h3>

                            <div class="mb-4">
                                <h5>Deskripsi:</h5>
                                <p>{{ $book->description }}</p>
                            </div>

                            @auth
                                @if($book->price == 0)
                                    <div class="alert alert-success">
                                        <i class="fas fa-gift me-2"></i>
                                        Buku ini <strong>GRATIS</strong>! Anda dapat membacanya langsung tanpa perlu membeli.
                                    </div>
                                    <a href="{{ route('frontend.example1', $book->id) }}" class="btn btn-primary">
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
                                            <a href="{{ route('frontend.example1', $book->id) }}" class="btn btn-primary">
                                                <i class="fas fa-book-open me-2"></i>Baca Buku
                                            </a>
                                        @elseif($existingPurchase->payment_status == 0)
                                            <div class="mb-3">
                                                <p class="mb-0"><strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="alert alert-danger">
                                                <i class="fas fa-times-circle me-2"></i>
                                                Pembelian Anda sebelumnya <strong>ditolak,</strong>
                                                Silakan melakukan pembelian ulang untuk dapat membaca buku ini.
                                            </div>
                                            <a href="{{ route('purchases.create', ['flipbookId' => $book->id]) }}" class="btn btn-primary">
                                                <i class="fas fa-shopping-cart me-2"></i>Beli Buku Kembali
                                            </a>
                                        @endif
                                    @else
                                        <div class="mb-3">
                                            <p class="mb-0"><strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Anda belum membeli buku ini. Silakan melakukan pembelian terlebih dahulu untuk dapat membaca buku ini.
                                        </div>
                                        <a href="{{ route('purchases.create', ['flipbookId' => $book->id]) }}" class="btn btn-primary">
                                            <i class="fas fa-shopping-cart me-2"></i>Beli Buku
                                        </a>
                                    @endif
                                @endif
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Silakan login dan lakukan pembelian buku terlebih dahulu untuk membaca buku ini.
                                </div>
                                @if($book->price > 0)
                                    <div class="mb-3">
                                        <p class="mb-0"><strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
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
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
