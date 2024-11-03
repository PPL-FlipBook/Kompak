@extends('layout')

@section('content')
    <div class="container">
        <h1 class="mb-4">Perpustakaan Digital Saya</h1>

        @if($purchasedBooks->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                Anda belum memiliki buku. Silahkan beli buku terlebih dahulu.
                <div class="mt-3">
                    <a href="{{ route('books.index') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Beli Buku
                    </a>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($purchasedBooks as $purchase)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($purchase->book->cover_image)
                                <img src="{{ asset('storage/' . $purchase->book->cover_image) }}"
                                     class="card-img-top"
                                     alt="{{ $purchase->book->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $purchase->book->title }}</h5>
                                <a href="{{ route('frontend.example1', $purchase->book->id) }}"
                                   class="btn btn-primary">
                                    <i class="fas fa-book-reader"></i> Baca Buku
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.2s;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .btn i {
            margin-right: 8px;
        }
    </style>
@endpush
