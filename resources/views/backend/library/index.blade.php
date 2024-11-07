@extends('layout')

@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Perpustakaan Digital</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Perpustakaan Digital Saya</h6>
            </nav>
        </div>
    </nav>
    <div class="container py-4">
        @if($purchasedBooks->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Anda belum memiliki buku. Silahkan beli buku terlebih dahulu.
                <div class="mt-3">
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-shopping-cart me-2"></i> Beli Buku
                    </a>
                </div>
            </div>
        @else
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
                @foreach($purchasedBooks as $purchase)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-img-wrapper">
                                @if($purchase->book->cover_image)
                                    <img src="{{ asset('storage/books/images/' . $purchase->book->cover_image) }}"
                                         class="card-img-top"
                                         alt="{{ $purchase->book->title }}">
                                @else
                                    <div class="card-img-placeholder d-flex align-items-center justify-content-center">
                                        <i class="fas fa-book fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-2 d-flex flex-column justify-content-between">
                                <h6 class="card-title text-center text-truncate mb-2">{{ $purchase->book->title }}</h6>
                                <a href="{{ route('frontend.example1', $purchase->book->id) }}"
                                   class="btn btn-sm btn-primary w-100">
                                    <i class="fas fa-book-reader fa-sm me-1"></i> Baca
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
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-img-wrapper {
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-img-placeholder {
            width: 100%;
            height: 100%;
            background-color: #f8f9fa;
            color: #adb5bd;
        }

        .card-title {
            font-size: 0.9rem;
            line-height: 1.2;
            height: 2.4rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        .container {
            max-width: 1200px;
        }

        @media (max-width: 767.98px) {
            .row-cols-md-3 {
                --bs-gutter-x: 0.5rem;
            }
            .card-img-wrapper {
                height: 150px;
            }
        }
    </style>
@endpush
