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
                            @if(isset($purchase))
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Status pembelian Anda masih <strong>{{ $purchase->status_text }}</strong>.
                                    Anda dapat membaca buku ini setelah status pembelian berubah menjadi "Sukses".
                                </div>
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
                            <a href="{{ route('auth.index') }}" class="btn btn-primary">Login</a>
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
