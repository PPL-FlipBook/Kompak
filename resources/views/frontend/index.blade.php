<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlipBook Landing Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/jpg" href="{{asset('assets/img/icon-flipbook.jpg')}}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Base styles and utilities */
        body {
            font-family: 'Open Sans', sans-serif;
            overflow-x: hidden;
            padding-top: 100px;
        }

        /* Navbar Styling */
        nav {
            transition: all 0.3s ease;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.7) !important;
            padding: 1rem 0;
        }

        .navbar.scrolled {
            background-color: rgba(33, 37, 41, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand,
        .nav-link,
        .navbar-nav .nav-link.active {
            color: white !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: rgba(255, 255, 255, 0.8) !important;
            transform: translateY(-1px);
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5) !important;
            padding: 0.5rem;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        /* Atur Section */
        html {
            scroll-padding-top: 80px; /* Memberikan ruang untuk navbar */
            scroll-behavior: smooth;
        }

        /* Section styling */
        section {
            padding-top: 80px; /* Memberikan ruang di atas setiap section */
            margin-top: -20px; /* Mengompensasi padding-top */
        }

        /* Khusus untuk section about */
        #about {
            padding-top: 80px;
            scroll-margin-top: 80px; /* Memastikan scroll berhenti di posisi yang tepat */
        }

        /* Hero section tetap memiliki styling khusus */
        .hero {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: calc(80px + 2rem) 0 60px; /* Sesuaikan padding top */
            margin-top: -80px;
        }

        /* Memastikan section headers tidak tertutup navbar */
        section h2 {
            padding-top: 20px; /* Memberikan ruang tambahan untuk heading */
        }

        /* Media queries untuk responsivitas */
        @media (max-width: 991.98px) {
            html {
                scroll-padding-top: 60px;
            }

            section {
                padding-top: 60px;
                margin-top: -60px;
            }

            #about {
                padding-top: 60px;
                scroll-margin-top: 60px;
            }

            .hero {
                padding: calc(60px + 2rem) 0 40px;
            }
        }

        /* Custom logout button */
        .custom-logout-btn {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white !important;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .custom-logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 120px 0 80px;
            margin-top: -76px; /* Adjust based on navbar height */
        }

        /* Book Carousel */
        .book-carousel {
            position: relative;
            width: 300px;
            height: 400px;
            margin: 0 auto;
            perspective: 1000px;
        }

        .book-carousel img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: all 0.5s ease;
            transform: translateY(20px);
        }

        .book-carousel img.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Featured Books Section */
        .featured-books {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .book-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .book-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .book-item:hover {
            transform: translateY(-5px);
        }

        .book-item:hover img {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Description Overlay */
        .description-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 23.5%;
            background-color: rgba(0, 0, 0, 0.85);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .description-overlay p {
            font-size: 0.9rem;
            line-height: 1.4;
            margin: 0;
        }

        .book-item:hover .description-overlay {
            opacity: 1;
        }

        /* Search Bar */
        .input-group {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .input-group input {
            border: none;
            padding: 0.8rem 1.2rem;
        }

        .input-group .btn {
            padding: 0.8rem 1.5rem;
            background-color: #212529;
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .input-group .btn:hover {
            background-color: #343a40;
        }

        /* About Section */
        .bg-dark.rounded-circle {
            width: 80px;
            height: 80px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
        }

        .bg-dark.rounded-circle:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background-color: #212529;
        }

        footer a {
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-control {
            padding: 0.8rem 1rem;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
            border-color: #0d6efd;
        }

        /* Splash Screen */
        #splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        #splash-screen img {
            width: 150px;
            height: auto;
            animation: flip 2s infinite linear;
        }

        @keyframes flip {
            0% { transform: perspective(400px) rotateY(0); }
            100% { transform: perspective(400px) rotateY(360deg); }
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: rgba(33, 37, 41, 0.95);
                padding: 1rem;
                border-radius: 0.5rem;
                margin-top: 0.5rem;
            }

            .hero {
                padding: 100px 0 60px;
                text-align: center;
            }

            .book-carousel {
                margin-top: 2rem;
            }
        }

        @media (max-width: 767.98px) {
            .book-item img {
                height: 250px;
            }

            .description-overlay {
                font-size: 0.8rem;
            }
        }

        /* Additional Utility Classes */
        .fade-out {
            opacity: 0;
        }

        .stay-white {
            color: white !important;
        }

        .custom-logout-btn.stay-white:hover {
            color: white !important;
        }

    </style>
</head>
<body>
<div id="splash-screen">
    <img src="{{asset('assets-fe/flipbook.png')}}" alt="FlipBook Icon">
</div>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets-fe/flipbook.png')}}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top me-2">
            FlipBook
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#books">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @if(auth()->check())
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link" target="_blank" title="Masuk ke Dashboard">
                            <span class="d-none d-md-block">Hi, {{auth()->user()->name }}</span>
                            <span class="d-md-none">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auth.logout') }}" class="nav-link btn custom-logout-btn stay-white" title="Logout">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.index') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register.index') }}">Register</a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h1 class="display-4 mb-4">Baca buku interaktif dengan pengalaman flipbook terbaik</h1>
                <p class="lead mb-4">Nikmati pengalaman membaca yang imersif dan interaktif dengan teknologi flipbook terkini kami.</p>
                <a class="btn btn-primary btn-dark" href="{{route('auth.index')}}">Get Started</a>
            </div>
            <div class="col-lg-4">
                <div class="book-carousel">
                    <img src="{{asset('assets-fe/book-1.png')}}" alt="Interactive Physics" class="active">
                    <img src="{{asset('assets-fe/book-2.png')}}" alt="Digital Marketing 101">
                    <img src="{{asset('assets-fe/book-3.png')}}" alt="Web Development Mastery">
                    <img src="{{asset('assets-fe/book-4.png')}}" alt="Data Science Essentials">
                    <img src="{{asset('assets-fe/book-5.png')}}" alt="Artificial Intelligence Basics">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5" id="about">
    <div class="container">
        <h2 class="text-center mb-5 pt-3">Mengapa Memilih FlipBook?</h2>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="bg-dark rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                </div>
                <h3 class="mt-4">Pembacaan Interaktif</h3>
                <p>Hadapi buku-buku Anda seperti tidak pernah sebelumnya dengan fitur-fitur interaktif kami.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="bg-dark rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                </div>
                <h3 class="mt-4">Perpustakaan Besar</h3>
                <p>Akses ribuan judul di berbagai genre, semuanya tersedia di ujung jari Anda.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="bg-dark rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                </div>
                <h3 class="mt-4">Pengalaman yang Disesuaikan</h3>
                <p>Ubah pengalaman membaca Anda dengan pengaturan yang dapat disesuaikan dan rekomendasi yang dipersonalisasi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Book Section -->
<section class="featured-books py-5" id="books">
    <div class="container">
        <h2 class="text-center mb-5 pt-3" id="textContent">Buku Terbaru</h2>
        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchBook" placeholder="Cari buku...">
                        <button class="btn btn-dark text" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Books limit(8) -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4">
            @foreach($visibleBooks as $book)
                <a href="{{ route('frontend.example1', $book->id) }}" class="text-decoration-none text-dark">
                    <div class="col">
                        <div class="book-item text-center position-relative">
                            @if($book->cover_image)
                                <img src="{{ Storage::url('books/images/' . $book->cover_image) }}" alt="{{ $book->title }}" class="mb-3">
                                <h5>{{ $book->title }}</h5>
                                <button class="btn btn-outline-dark mt-2">Read Now</button>
                                <div class="description-overlay">
                                    <p>{{ $book->description }}</p> <!-- Assuming $book->description contains the book description -->
                                </div>
                            @else
                                <div style="background-color: #ddd; width: 100%; height: 100%;">
                                    <p>No image available</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <!-- Hidden Books (starting from the 9th book) -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 mt-1">
            @foreach($hiddenBooks as $bookItem)
                <div class="col hidden-book" style="display:none;">
                    <a href="{{ route('frontend.example1', $bookItem->id) }}" class="text-decoration-none text-dark">
                        <div class="book-item text-center position-relative">
                            @if($bookItem->cover_image)
                                <img src="{{ Storage::url('books/images/' . $bookItem->cover_image) }}" alt="{{ $bookItem->title }}" class="mb-3">
                                <h5>{{ $bookItem->title }}</h5>
                                <button class="btn btn-outline-dark mt-2">Read Now</button>
                                <div class="description-overlay">
                                    <p>{{ $bookItem->description }}</p>
                                </div>
                            @else
                                <div style="background-color: #ddd; width: 100%; height: 100%;">
                                    <p>No image available</p>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-dark btn-lg">Lihat Semua Buku</button>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-dark btn-lg" id="bukuBaru">Lihat Buku Terbaru</button>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-light py-5" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>Hubungi Kami</h5>
                <p>Email: info@flipbook.com</p>
                <p>Telepon: +62 123 4567 890</p>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="#home" class="text-light">Beranda</a></li>
                    <li><a href="#about" class="text-light">Tentang</a></li>
                    <li><a href="#books" class="text-light">Buku</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Ikuti Kami</h5>
                <div class="d-flex">
                    <a href="#" class="text-light me-3" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-light me-3" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-light" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm00 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 6.778a2.668 2.668 0 1 1 0-5.336 2.668 2.668 0 0 1 0 5.336z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <p class="text-center mb-0">&copy; 2023 FlipBook App. Hak Cipta Dilindungi.</p>
    </div>
</footer>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="registerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="registerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registerPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="registerConfirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Jika navbar sudah jadi fixed-top maka backgrounnya berubah jadi transparant -->
<script>
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        // Ubah selector untuk hanya mengambil link yang tidak memiliki class 'stay-white'
        const links = document.querySelectorAll('nav a:not(.stay-white)');

        if (window.scrollY > 0) {
            nav.classList.add('bg-transparent', 'shadow');
            nav.classList.remove('bg-dark');

            links.forEach(link => {
                link.classList.add('text-black');
                link.classList.remove('text-white');
            });
        } else {
            nav.classList.remove('bg-transparent', 'shadow');
            nav.classList.add('bg-dark');

            links.forEach(link => {
                link.classList.remove('text-black');
                link.classList.add('text-white');
            });
        }
    });

</script>

<!-- Custom JS -->
<script>
    // Book carousel
    const carouselImages = document.querySelectorAll('.book-carousel img');
    let currentIndex = 0;

    function showNextImage() {
        carouselImages[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % carouselImages.length;
        carouselImages[currentIndex].classList.add('active');
    }

    setInterval(showNextImage, 3000);

    // Fungsi untuk menghilangkan splash screen
    function hideSplashScreen() {
        const splashScreen = document.getElementById('splash-screen');
        splashScreen.classList.add('fade-out');
        setTimeout(() => {
            splashScreen.style.display = 'none';
        }, 500);
    }

    // Tampilkan splash screen selama 3 detik
    window.addEventListener('load', () => {
        setTimeout(hideSplashScreen, 2000);
    });
</script>

<script>
    // Tambahkan event listener pada input pencarian buku
    const searchBookInput = document.getElementById('searchBook');
    const bookItems = document.querySelectorAll('.book-item');
    const bookContainer = document.querySelector('.row.row-cols-2.row-cols-md-3.row-cols-lg-6.g-4');

    searchBookInput.addEventListener('input', function() {
        const searchQuery = searchBookInput.value.toLowerCase();
        const filteredBooks = [];

        bookItems.forEach(bookItem => {
            const bookTitle = bookItem.querySelector('h5').textContent.toLowerCase();
            if (bookTitle.includes(searchQuery)) {
                filteredBooks.push(bookItem);
            }
        });

        // Hapus semua buku yang ada di container
        bookContainer.innerHTML = '';

        // Tambahkan buku-buku yang sesuai dengan pencarian ke container
        filteredBooks.forEach(bookItem => {
            bookContainer.appendChild(bookItem);
        });
    });
</script>


<script>
    // Get references to buttons and book sections
    const viewAllButton = document.querySelector(".btn-dark.btn-lg");
    const newBooksButton = document.getElementById("bukuBaru");
    const hiddenBooks = document.querySelectorAll(".hidden-book");
    const visibleBooks = document.querySelectorAll(".book-item:not(.hidden-book)");
    const sectionTitle = document.querySelector("#textContent");

    // Initially hide the "Buku Baru" button
    newBooksButton.style.display = "none";

    // Function to show all books
    function showAllBooks() {
        hiddenBooks.forEach(book => book.style.display = "block");
        visibleBooks.forEach(book => book.style.display = "block");
        sectionTitle.textContent = "Semua Buku";
        viewAllButton.style.display = "none";
        newBooksButton.style.display = "inline-block";
    }

    // Function to show only new books
    function showNewBooks() {
        hiddenBooks.forEach(book => book.style.display = "none");
        visibleBooks.forEach(book => book.style.display = "block");
        sectionTitle.textContent = "Buku Baru";
        viewAllButton.style.display = "inline-block";
        viewAllButton.textContent = "Lihat Semua Buku";
        newBooksButton.style.display = "none";
    }

    // Event listener for "Lihat Semua Buku" button
    viewAllButton.addEventListener("click", showAllBooks);

    // Event listener for "Buku Baru" button
    newBooksButton.addEventListener("click", showNewBooks);
</script>

<script>
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');

        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });
</script>
</body>
</html>
