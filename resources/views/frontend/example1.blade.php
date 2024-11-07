{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>PDF Flipbook</title>--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">--}}
{{--    <style>--}}
{{--        * {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            box-sizing: border-box;--}}
{{--        }--}}

{{--        html {--}}
{{--            font-size: 62.5%;--}}
{{--        }--}}

{{--        body {--}}
{{--            font-family: sans-serif;--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            align-items: center;--}}
{{--            width: 100%;--}}
{{--            background-color: #f0f0f0;--}}
{{--        }--}}

{{--        .theme-toggle {--}}
{{--            position: absolute;--}}
{{--            top: 20px;--}}
{{--            left: 20px;--}}
{{--            font-size: 2rem;--}}
{{--            cursor: pointer;--}}
{{--            color: #FFA500; /* Warna untuk matahari */--}}
{{--        }--}}

{{--        .close{--}}
{{--            position: absolute;--}}
{{--            top: 20px;--}}
{{--            right: 20px;--}}
{{--            font-size: 2rem;--}}
{{--            cursor: pointer;--}}
{{--        }--}}
{{--        .btnClose {--}}
{{--            display: inline-block;--}}
{{--            background-color: transparent; /* Sesuaikan dengan desain kamu */--}}
{{--            border: none;--}}
{{--            cursor: pointer;--}}
{{--            font-size: 2.5rem; /* Sesuaikan ukuran ikon */--}}
{{--            text-decoration: none; /* Menghilangkan garis bawah */--}}
{{--            color: inherit; /* Mengambil warna dari elemen induk */--}}
{{--        }--}}

{{--        .btnClose:hover{--}}
{{--            color: red;--}}
{{--        }--}}

{{--        .btn_1 {--}}
{{--            width: 50px; /* Ukuran lebih besar */--}}
{{--            height: 50px; /* Ukuran lebih besar */--}}
{{--            border: 2px solid #FFA500; /* Tambahkan border */--}}
{{--            border-radius: 50%;--}}
{{--            font-size: 2rem; /* Ukuran ikon lebih besar */--}}
{{--            transition: background-color 0.3s, color 0.3s;--}}
{{--        }--}}

{{--        body.dark-theme .btn_1 {--}}
{{--            border: 2px solid white; /* Warna border untuk tema gelap */--}}
{{--            background-color: black; /* Warna tombol untuk tema gelap */--}}
{{--            color: white; /* Warna ikon untuk tema gelap */--}}
{{--        }--}}

{{--        body:not(.dark-theme) .btn_1 {--}}
{{--            border: 2px solid #FFA500; /* Warna border untuk tema terang */--}}
{{--            background-color: white; /* Warna tombol untuk tema terang */--}}
{{--            color: #FFA500; /* Warna ikon untuk tema terang */--}}
{{--        }--}}


{{--        .bookWrapper {--}}
{{--            margin: 10rem auto; /* Center horizontally */--}}
{{--            width: 70rem;--}}
{{--            height: 45rem;--}}
{{--            position: relative;--}}
{{--            perspective: 2000px;--}}
{{--            transition: transform 0.3s ease;--}}
{{--        }--}}

{{--        .bookBg {--}}
{{--            position: absolute;--}}
{{--            background-color: #000;--}}
{{--            width: calc(100% + 20px);--}}
{{--            height: calc(100% + 20px);--}}
{{--            top: -10px;--}}
{{--            left: -10px;--}}
{{--            border-radius: 1.2rem;--}}
{{--        }--}}

{{--        .pageWrapper {--}}
{{--            position: relative;--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            overflow: hidden;--}}
{{--        }--}}

{{--        .bookPage {--}}
{{--            width: 50%;--}}
{{--            height: 100%;--}}
{{--            background-color: #fff;--}}
{{--            border-radius: 0.5rem;--}}
{{--            position: absolute;--}}
{{--            top: 0;--}}
{{--            transition: transform 1s ease, box-shadow 0.5s ease;--}}
{{--            backface-visibility: hidden;--}}
{{--            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);--}}
{{--        }--}}

{{--        .bookPage.left {--}}
{{--            left: 0;--}}
{{--            transform-origin: right;--}}
{{--        }--}}

{{--        .bookPage.right {--}}
{{--            right: 0;--}}
{{--            transform-origin: left;--}}
{{--        }--}}

{{--        .flipping {--}}
{{--            box-shadow: 10px 0px 50px rgba(0, 0, 0, 0.7);--}}
{{--            z-index: 2;--}}
{{--        }--}}

{{--        .flipping-right {--}}
{{--            transform: rotateY(-160deg);--}}
{{--        }--}}

{{--        .flipping-left {--}}
{{--            transform: rotateY(160deg);--}}
{{--        }--}}

{{--        .nav-button {--}}
{{--            position: absolute;--}}
{{--            top: 50%;--}}
{{--            transform: translateY(-50%);--}}
{{--            background-color: rgba(255, 255, 255, 0.8);--}}
{{--            border: none;--}}
{{--            cursor: pointer;--}}
{{--            font-size: 3rem;--}}
{{--            color: #333;--}}
{{--            z-index: 10;--}}
{{--            padding: 0.5rem;--}}
{{--            border-radius: 50%;--}}
{{--            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);--}}
{{--        }--}}

{{--        .nav-button.left {--}}
{{--            left: -60px;--}}
{{--        }--}}

{{--        .nav-button.right {--}}
{{--            right: -60px;--}}
{{--        }--}}

{{--        .nav-button:hover {--}}
{{--            background-color: rgba(255, 87, 51, 1);--}}
{{--        }--}}

{{--        canvas {--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            border-radius: 0.5rem;--}}
{{--        }--}}

{{--        .zoom-buttons {--}}
{{--            margin-top: 1rem;--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--            gap: 1rem;--}}
{{--            z-index: 10;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .zoom-button {--}}
{{--            font-size: 1.5rem;--}}
{{--            cursor: pointer;--}}
{{--            color: #333;--}}
{{--            background-color: rgba(255, 255, 255, 0.8);--}}
{{--            border: none;--}}
{{--            padding: 0.5rem;--}}
{{--            border-radius: 5px;--}}
{{--            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);--}}
{{--        }--}}

{{--        .zoom-button:hover {--}}
{{--            background-color: rgba(255, 255, 255, 1);--}}
{{--        }--}}

{{--        .header-buttons {--}}
{{--            position: fixed;--}}
{{--            top: 20px;--}}
{{--            left: 20px;--}}
{{--            right: 20px;--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            z-index: 100;--}}
{{--        }--}}

{{--        .close, .theme-toggle {--}}
{{--            position: relative;--}}
{{--            top: auto;--}}
{{--            left: auto;--}}
{{--            right: auto;--}}
{{--        }--}}
{{--        @media (max-width: 768px) {--}}
{{--            body {--}}
{{--                position: fixed;--}}
{{--                padding-top: 60px;--}}
{{--            }--}}

{{--            .btn_1, .btnClose {--}}
{{--                width: 30px;--}}
{{--                height: 30px;--}}
{{--                font-size: 1.2rem;--}}
{{--            }--}}

{{--            .theme-toggle {--}}
{{--                position: absolute;--}}
{{--                top: 20px; /* Atur posisi tombol tema */--}}
{{--                right: 20px; /* Atur posisi tombol tema */--}}
{{--                font-size: 2rem;--}}
{{--                cursor: pointer;--}}
{{--                color: #FFA500; /* Warna untuk matahari */--}}
{{--                z-index: 100; /* Pastikan tombol di atas elemen lain */--}}
{{--            }--}}

{{--            .btn_1 {--}}
{{--                width: 40px; /* Ukuran tombol */--}}
{{--                height: 40px; /* Ukuran tombol */--}}
{{--                border: 2px solid #FFA500; /* Border */--}}
{{--                border-radius: 50%;--}}
{{--                font-size: 1.5rem; /* Ukuran ikon */--}}
{{--                transition: background-color 0.3s, color 0.3s;--}}
{{--            }--}}

{{--            .btn_1 i {--}}
{{--                font-size: 1.5rem; /* Ukuran ikon */--}}
{{--                margin: 0;--}}
{{--            }--}}

{{--            .bookWrapper {--}}
{{--                width: 90vw; /* Sesuaikan lebar untuk layar kecil */--}}
{{--                height: 50vw; /* Sesuaikan tinggi untuk layar kecil */--}}
{{--                margin-top: 10rem;--}}
{{--                display: flex;--}}
{{--                justify-content: center; /* Center content */--}}
{{--                align-items: center; /* Center vertically */--}}
{{--                position: relative; /* Tambahkan posisi relatif */--}}
{{--            }--}}

{{--            .bookPage {--}}
{{--                width: 100%;--}}
{{--                height: 100%;--}}
{{--                position: relative;--}}
{{--            }--}}

{{--            .nav-button {--}}
{{--                font-size: 2rem;--}}
{{--            }--}}

{{--            .zoom-button {--}}
{{--                font-size: 1.2rem;--}}
{{--            }--}}

{{--            .nav-button {--}}
{{--                position: absolute; /* Letakkan tombol navigasi */--}}
{{--                top: 50%; /* Posisikan di tengah vertikal */--}}
{{--                transform: translateY(-50%); /* Pusatkan tombol secara vertikal */--}}
{{--            }--}}

{{--            .nav-button.left {--}}
{{--                left: -60px; /* Sesuaikan jarak dari kiri */--}}
{{--            }--}}

{{--            .nav-button.right {--}}
{{--                right: -60px; /* Sesuaikan jarak dari kanan */--}}
{{--            }--}}
{{--            h1 {--}}
{{--                font-size: 1.8rem; /* Sesuaikan ukuran font judul */--}}
{{--                font-weight: bold;--}}
{{--                color: #333; /* Sesuaikan warna judul */--}}
{{--                margin-bottom: 1rem; /* Beri jarak dengan elemen di bawah */--}}
{{--                margin-top: 5rem;--}}
{{--            }--}}

{{--            .text-muted {--}}
{{--                font-size: 1.6rem; /* Ukuran font lebih kecil untuk subjudul atau keterangan */--}}
{{--                color: #777;--}}
{{--            }--}}

{{--            .close {--}}
{{--                top: 20px;--}}
{{--                left: 20px; /* Pindahkan ke kiri */--}}
{{--                right: auto; /* Hapus posisi kanan */--}}
{{--            }--}}

{{--            .theme-toggle {--}}
{{--                top: 20px;--}}
{{--                right: 20px; /* Pastikan tetap di kanan */--}}
{{--            }--}}
{{--        }--}}

{{--        .close {--}}
{{--            z-index: 101; /* Lebih tinggi dari tombol tema */--}}
{{--        }--}}
{{--        h1 {--}}
{{--            font-size: 2.4rem; /* Sesuaikan ukuran font judul */--}}
{{--            font-weight: bold;--}}
{{--            color: #333; /* Sesuaikan warna judul */--}}
{{--            margin-bottom: 1rem; /* Beri jarak dengan elemen di bawah */--}}
{{--            text-align: center;--}}
{{--        }--}}

{{--        .text-muted {--}}
{{--            font-size: 1.6rem; /* Ukuran font lebih kecil untuk subjudul atau keterangan */--}}
{{--            color: #777;--}}
{{--        }--}}

{{--        * {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            box-sizing: border-box;--}}
{{--        }--}}

{{--        html {--}}
{{--            font-size: 62.5%;--}}
{{--        }--}}

{{--        body {--}}
{{--            font-family: sans-serif;--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            align-items: center;--}}
{{--            width: 100%;--}}
{{--            background-color: #f0f0f0;--}}
{{--        }--}}

{{--        .theme-toggle {--}}
{{--            position: absolute;--}}
{{--            top: 20px;--}}
{{--            left: 20px;--}}
{{--            font-size: 2rem;--}}
{{--            cursor: pointer;--}}
{{--            color: #FFA500; /* Warna untuk matahari */--}}
{{--        }--}}

{{--        .close{--}}
{{--            position: absolute;--}}
{{--            top: 20px;--}}
{{--            right: 20px;--}}
{{--            font-size: 2rem;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .btnClose {--}}
{{--            display: inline-block;--}}
{{--            background-color: transparent; /* Sesuaikan dengan desain kamu */--}}
{{--            border: none;--}}
{{--            cursor: pointer;--}}
{{--            font-size: 2.5rem; /* Sesuaikan ukuran ikon */--}}
{{--            text-decoration: none; /* Menghilangkan garis bawah */--}}
{{--            color: inherit; /* Mengambil warna dari elemen induk */--}}
{{--        }--}}

{{--        .btnClose:hover{--}}
{{--            color: red;--}}
{{--        }--}}

{{--        .btn_1 {--}}
{{--            width: 50px; /* Ukuran lebih besar */--}}
{{--            height: 50px; /* Ukuran lebih besar */--}}
{{--            border: 2px solid #FFA500; /* Tambahkan border */--}}
{{--            border-radius: 50%;--}}
{{--            font-size: 2rem; /* Ukuran ikon lebih besar */--}}
{{--            transition: background-color 0.3s, color 0.3s;--}}
{{--        }--}}

{{--        body.dark-theme .btn_1 {--}}
{{--            border: 2px solid white; /* Warna border untuk tema gelap */--}}
{{--            background-color: black; /* Warna tombol untuk tema gelap */--}}
{{--            color: white; /* Warna ikon untuk tema gelap */--}}
{{--        }--}}

{{--        body:not(.dark-theme) .btn_1 {--}}
{{--            border: 2px solid #FFA500; /* Warna border untuk tema terang */--}}
{{--            background-color: white; /* Warna tombol untuk tema terang */--}}
{{--            color: #FFA500; /* Warna ikon untuk tema terang */--}}
{{--        }--}}

{{--        .container {--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--            align-items: flex-start;--}}
{{--            margin-top: 2rem; /* Jarak dari atas */--}}
{{--        }--}}

{{--        .bookWrapper {--}}
{{--            margin: 0; /* Menghilangkan margin untuk menempatkan di tengah */--}}
{{--            width: 70rem; /* Lebar buku */--}}
{{--            height: 45rem; /* Tinggi buku */--}}
{{--            position: relative;--}}
{{--            perspective: 2000px;--}}
{{--            transition: transform 0.3s ease;--}}
{{--        }--}}

{{--        .music-player {--}}
{{--            margin-left: 75%; /* Jarak antara konten buku dan pemutar musik */--}}
{{--            max-width: 300px; /* Lebar maksimal pemutar musik */--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            align-items: center; /* Center konten di dalam pemutar musik */--}}
{{--            z-index: 10;--}}
{{--            position: absolute;--}}
{{--            transform: translateY(400%); /* Pindahkan ke atas untuk menempatkan di tengah */--}}
{{--        }--}}

{{--        @media (max-width: 1024px) {--}}
{{--            .music-player {--}}
{{--                display: none; /* Menyembunyikan pemutar musik pada layar kecil */--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="header-buttons">--}}
{{--    <div class="close" title="Kembali">--}}
{{--        <a href="{{ url()->previous() }}" class="btnClose">--}}
{{--            <i class="bi bi-skip-backward-fill"></i>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="theme-toggle" id="themeToggle" title="Toggle Theme">--}}
{{--        <button type="button" class="btn_1" id="themeButton">--}}
{{--            <i class="bi bi-sun" id="themeIcon"></i>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="container">--}}
{{--    <!-- Konten buku -->--}}
{{--    <div class="text-center my-5">--}}
{{--        @if($book)--}}
{{--            <h1 class="text-bold">{{ $book->title }} <small class="text-muted"></small></h1>--}}
{{--        @else--}}
{{--            <h1 class="text-danger">Tidak ada buku yang ditemukan.</h1>--}}
{{--        @endif--}}
{{--        <hr style="border-width: 2px; border-color: #333;">--}}
{{--        <div class="bookWrapper mt-5" id="bookWrapper">--}}
{{--            <div class="bookBg"></div>--}}
{{--            <button class="nav-button left" id="prevButton" title="Previous">--}}
{{--                <i class="bi bi-chevron-left"></i>--}}
{{--            </button>--}}
{{--            <div class="pageWrapper">--}}
{{--                <div class="bookPage left" id="leftPage">--}}
{{--                    <canvas id="leftPdfCanvas"></canvas>--}}
{{--                </div>--}}
{{--                <div class="bookPage right" id="rightPage">--}}
{{--                    <canvas id="rightPdfCanvas"></canvas>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <button class="nav-button right" id="nextButton" title="Next">--}}
{{--                <i class="bi bi-chevron-right"></i>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Pemutar Musik -->--}}
{{--    <div class="music-player mt-5">--}}
{{--        <h4><i class="bi bi-music-note me-2"></i>Pilih Musik</h4>--}}
{{--        <select id="musicSelect" class="form-select">--}}
{{--            <option value="">-- Pilih Musik --</option>--}}
{{--            @foreach (scandir(public_path('storage/music')) as $file)--}}
{{--                @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['m4a', 'mp3', 'wav'])) <!-- Pastikan hanya mengambil file audio -->--}}
{{--                <option value="{{ asset('storage/music/' . $file) }}">{{ pathinfo($file, PATHINFO_FILENAME) }}</option>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        <div class="mt-2 d-flex gap-2">--}}
{{--            <button id="playButton" class="btn btn-outline-primary"><i class="bi bi-play-fill"></i> Play</button>--}}
{{--            <button id="stopButton" class="btn btn-outline-danger"><i class="bi bi-stop-fill"></i> Stop</button>--}}
{{--        </div>--}}
{{--        <audio id="audioPlayer" controls style="display:none;"></audio>--}}
{{--    </div>--}}
{{--</div>--}}

{{--        <h4>--}}
{{--        @if(isset($showFreeBookMessage) && $showFreeBookMessage)--}}
{{--            <div class="alert alert-success">--}}
{{--                <i class="fas fa-gift me-2"></i>--}}
{{--                Buku ini <strong>GRATIS</strong>! Anda dapat membacanya langsung tanpa perlu membeli. Selamat menikmati!--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        @if(isset($showSuccessConfirmation) && $showSuccessConfirmation)--}}
{{--            <div class="alert alert-success">--}}
{{--                <i class="fas fa-check-circle me-2"></i>--}}
{{--                Pembelian Anda telah <strong>Sukses</strong>. Selamat membaca!--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        </h4>--}}

{{--        <div class="zoom-buttons">--}}
{{--    <button class="zoom-button" id="zoomOut" title="Zoom Out">--}}
{{--        <i class="bi bi-zoom-out"></i>--}}
{{--    </button>--}}
{{--    <span id="zoomPercentage">Zoom: 100%</span>--}}
{{--    <button class="zoom-button" id="zoomIn" title="Zoom In">--}}
{{--        <i class="bi bi-zoom-in"></i>--}}
{{--    </button>--}}
{{--</div>--}}

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>--}}
{{--<script>--}}
{{--    document.getElementById('playButton').addEventListener('click', function() {--}}
{{--        const select = document.getElementById('musicSelect');--}}
{{--        const audioPlayer = document.getElementById('audioPlayer');--}}
{{--        const selectedMusic = select.value;--}}

{{--        if (selectedMusic) {--}}
{{--            audioPlayer.src = selectedMusic;--}}
{{--            audioPlayer.play();--}}
{{--        } else {--}}
{{--            alert('Silakan pilih musik terlebih dahulu.');--}}
{{--        }--}}
{{--    });--}}

{{--    document.getElementById('stopButton').addEventListener('click', function() {--}}
{{--        const audioPlayer = document.getElementById('audioPlayer');--}}
{{--        audioPlayer.pause();--}}
{{--        audioPlayer.currentTime = 0; // Reset ke awal--}}
{{--    });--}}
{{--</script>--}}
{{--<script>--}}
{{--    const pdfUrl = '{{ asset('storage/books/pdf/'.$book->pdf_file) }}'; // Update with your PDF path--}}
{{--    const loadingTask = pdfjsLib.getDocument(pdfUrl);--}}
{{--    const leftCanvas = document.getElementById('leftPdfCanvas');--}}
{{--    const rightCanvas = document.getElementById('rightPdfCanvas');--}}
{{--    const leftContext = leftCanvas.getContext('2d');--}}
{{--    const rightContext = rightCanvas.getContext('2d');--}}
{{--    const bookWrapper = document.getElementById('bookWrapper');--}}
{{--    const zoomPercentageDisplay = document.getElementById('zoomPercentage');--}}
{{--    const themeToggle = document.getElementById('themeToggle');--}}
{{--    const themeIcon = document.getElementById('themeIcon');--}}
{{--    const body = document.body;--}}
{{--    let pdf = null;--}}
{{--    let currentPage = 1;--}}
{{--    let totalPages = 0;--}}
{{--    let scale = 1;--}}

{{--    loadingTask.promise.then(loadedPdf => {--}}
{{--        pdf = loadedPdf;--}}
{{--        totalPages = pdf.numPages;--}}
{{--        renderPages(currentPage);--}}
{{--    }).catch(error => {--}}
{{--        console.error('Error loading PDF:', error);--}}
{{--    });--}}

{{--    function renderPage(pageNumber, canvas, context) {--}}
{{--        if (pageNumber <= totalPages) {--}}
{{--            pdf.getPage(pageNumber).then(page => {--}}
{{--                const viewport = page.getViewport({ scale: 1.5 });--}}
{{--                canvas.height = viewport.height;--}}
{{--                canvas.width = viewport.width;--}}

{{--                const renderContext = {--}}
{{--                    canvasContext: context,--}}
{{--                    viewport: viewport--}}
{{--                };--}}

{{--                page.render(renderContext);--}}
{{--            });--}}
{{--        }--}}
{{--    }--}}

{{--    function renderPages(pageNumber) {--}}
{{--        renderPage(pageNumber, leftCanvas, leftContext);--}}
{{--        if (pageNumber + 1 <= totalPages) {--}}
{{--            renderPage(pageNumber + 1, rightCanvas, rightContext);--}}
{{--        } else {--}}
{{--            rightContext.clearRect(0, 0, rightCanvas.width, rightCanvas.height);--}}
{{--        }--}}
{{--    }--}}

{{--    document.getElementById('nextButton').addEventListener('click', () => {--}}
{{--        if (currentPage < totalPages) {--}}
{{--            const leftPage = document.getElementById('leftPage');--}}
{{--            const rightPage = document.getElementById('rightPage');--}}

{{--            rightPage.classList.add('flipping-right');--}}
{{--            leftPage.classList.add('flipping');--}}

{{--            setTimeout(() => {--}}
{{--                currentPage += 2;--}}
{{--                renderPages(currentPage);--}}
{{--                rightPage.classList.remove('flipping-right');--}}
{{--                leftPage.classList.remove('flipping');--}}
{{--            }, 1500);--}}
{{--        }--}}
{{--    });--}}

{{--    document.getElementById('prevButton').addEventListener('click', () => {--}}
{{--        if (currentPage > 1) {--}}
{{--            const leftPage = document.getElementById('leftPage');--}}
{{--            const rightPage = document.getElementById('rightPage');--}}

{{--            leftPage.classList.add('flipping-left');--}}
{{--            rightPage.classList.add('flipping');--}}

{{--            setTimeout(() => {--}}
{{--                currentPage -= 2;--}}
{{--                renderPages(currentPage);--}}
{{--                leftPage.classList.remove('flipping-left');--}}
{{--                rightPage.classList.remove('flipping');--}}
{{--            }, 1500);--}}
{{--        }--}}
{{--    });--}}

{{--    document.getElementById('zoomIn').addEventListener('click', () => {--}}
{{--        if (scale < 2) { // Limit zoom in to 200%--}}
{{--            scale += 0.1;--}}
{{--            bookWrapper.style.transform = `scale(${scale})`;--}}
{{--            updateZoomPercentage();--}}
{{--        }--}}
{{--    });--}}

{{--    document.getElementById('zoomOut').addEventListener('click', () => {--}}
{{--        if (scale > 0.5) { // Limit zoom out to 50%--}}
{{--            scale -= 0.1;--}}
{{--            bookWrapper.style.transform = `scale(${scale})`;--}}
{{--            updateZoomPercentage();--}}
{{--        }--}}
{{--    });--}}

{{--    function updateZoomPercentage() {--}}
{{--        const zoomPercentage = Math.round(scale * 100); // Convert scale to percentage--}}
{{--        zoomPercentageDisplay.textContent = `Zoom: ${zoomPercentage}%`;--}}
{{--    }--}}

{{--    // Add click event listeners to the pages--}}
{{--    document.getElementById('leftPage').addEventListener('click', () => {--}}
{{--        if (currentPage > 1) {--}}
{{--            flipLeftPage();--}}
{{--        }--}}
{{--    });--}}

{{--    document.getElementById('rightPage').addEventListener('click', () => {--}}
{{--        if (currentPage < totalPages) {--}}
{{--            flipRightPage();--}}
{{--        }--}}
{{--    });--}}

{{--    function flipRightPage() {--}}
{{--        const leftPage = document.getElementById('leftPage');--}}
{{--        const rightPage = document.getElementById('rightPage');--}}

{{--        rightPage.classList.add('flipping-right');--}}
{{--        leftPage.classList.add('flipping');--}}

{{--        setTimeout(() => {--}}
{{--            currentPage += 2;--}}
{{--            renderPages(currentPage);--}}
{{--            rightPage.classList.remove('flipping-right');--}}
{{--            leftPage.classList.remove('flipping');--}}
{{--        }, 1500);--}}
{{--    }--}}

{{--    function flipLeftPage() {--}}
{{--        const leftPage = document.getElementById('leftPage');--}}
{{--        const rightPage = document.getElementById('rightPage');--}}

{{--        leftPage.classList.add('flipping-left');--}}
{{--        rightPage.classList.add('flipping');--}}

{{--        setTimeout(() => {--}}
{{--            currentPage -= 2;--}}
{{--            renderPages(currentPage);--}}
{{--            leftPage.classList.remove('flipping-left');--}}
{{--            rightPage.classList.remove('flipping');--}}
{{--        }, 1500);--}}
{{--    }--}}
{{--    themeToggle.addEventListener('click', () => {--}}
{{--        const isDark = body.classList.toggle('dark-theme');--}}

{{--        // Atur warna latar belakang dan teks utama--}}
{{--        body.style.backgroundColor = isDark ? '#1a1a1a' : '#F5F5F5'; // Latar belakang lebih gelap--}}
{{--        body.style.color = isDark ? '#e0e0e0' : '#333'; // Teks sedikit off-white untuk mengurangi silau--}}

{{--        // Atur warna ikon tema--}}
{{--        themeIcon.classList.toggle('bi-sun', !isDark);--}}
{{--        themeIcon.classList.toggle('bi-moon', isDark);--}}
{{--        themeIcon.style.color = isDark ? '#ffffff' : '#FFA500'; // Putih untuk tema gelap, oranye untuk tema terang--}}

{{--        // Atur warna teks untuk elemen-elemen spesifik--}}
{{--        const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');--}}
{{--        headings.forEach(heading => {--}}
{{--            heading.style.color = isDark ? '#ffffff' : '#333'; // Heading putih di tema gelap--}}
{{--        });--}}

{{--        const paragraphs = document.querySelectorAll('p');--}}
{{--        paragraphs.forEach(p => {--}}
{{--            p.style.color = isDark ? '#cccccc' : '#333'; // Paragraf sedikit lebih gelap dari putih--}}
{{--        });--}}

{{--        const links = document.querySelectorAll('a');--}}
{{--        links.forEach(link => {--}}
{{--            link.style.color = isDark ? '#4da6ff' : '#0066cc'; // Biru lebih terang untuk link di tema gelap--}}
{{--        });--}}

{{--        // Atur warna tombol tema--}}
{{--        if (isDark) {--}}
{{--            themeButton.classList.add('btn-dark');--}}
{{--            themeButton.style.backgroundColor = '#333';--}}
{{--            themeButton.style.borderColor = '#ffffff';--}}
{{--        } else {--}}
{{--            themeButton.classList.remove('btn-dark');--}}
{{--            themeButton.style.backgroundColor = '#ffffff';--}}
{{--            themeButton.style.borderColor = '#FFA500';--}}
{{--        }--}}

{{--        // Atur warna untuk elemen-elemen lain jika diperlukan--}}
{{--        const customElements = document.querySelectorAll('.custom-text-element');--}}
{{--        customElements.forEach(element => {--}}
{{--            element.style.color = isDark ? '#f0f0f0' : '#333';--}}
{{--        });--}}
{{--    });--}}


{{--</script>--}}
{{--</body>--}}
{{--</html>--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Flipbook</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 62.5%;
        }

        body {
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            background-color: #f0f0f0;
        }

        .theme-toggle {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 2rem;
            cursor: pointer;
            color: #FFA500; /* Warna untuk matahari */
        }

        .close{
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2rem;
            cursor: pointer;
        }
        .btnClose {
            display: inline-block;
            background-color: transparent; /* Sesuaikan dengan desain kamu */
            border: none;
            cursor: pointer;
            font-size: 2.5rem; /* Sesuaikan ukuran ikon */
            text-decoration: none; /* Menghilangkan garis bawah */
            color: inherit; /* Mengambil warna dari elemen induk */
        }

        .btnClose:hover{
            color: red;
        }

        .btn_1 {
            width: 50px; /* Ukuran lebih besar */
            height: 50px; /* Ukuran lebih besar */
            border: 2px solid #FFA500; /* Tambahkan border */
            border-radius: 50%;
            font-size: 2rem; /* Ukuran ikon lebih besar */
            transition: background-color 0.3s, color 0.3s;
        }

        body.dark-theme .btn_1 {
            border: 2px solid white; /* Warna border untuk tema gelap */
            background-color: black; /* Warna tombol untuk tema gelap */
            color: white; /* Warna ikon untuk tema gelap */
        }

        body:not(.dark-theme) .btn_1 {
            border: 2px solid #FFA500; /* Warna border untuk tema terang */
            background-color: white; /* Warna tombol untuk tema terang */
            color: #FFA500; /* Warna ikon untuk tema terang */
        }


        .bookWrapper {
            margin: 10rem auto; /* Center horizontally */
            width: 70rem;
            height: 45rem;
            position: relative;
            perspective: 2000px;
            transition: transform 0.3s ease;
        }

        .bookBg {
            position: absolute;
            background-color: #000000;
            width: calc(100% + 20px);
            height: calc(100% + 20px);
            top: -10px;
            left: -10px;
            border-radius: 1.2rem;
        }

        .pageWrapper {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .bookPage {
            width: 50%;
            height: 100%;
            background-color: #fff;
            border-radius: 0.5rem;
            position: absolute;
            top: 0;
            transition: transform 1s ease, box-shadow 0.5s ease;
            backface-visibility: hidden;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
        }

        .bookPage.left {
            left: 0;
            transform-origin: right;
        }

        .bookPage.right {
            right: 0;
            transform-origin: left;
        }

        .flipping {
            box-shadow: 10px 0px 50px rgba(0, 0, 0, 0.7);
            z-index: 2;
        }

        .flipping-right {
            transform: rotateY(-160deg);
        }

        .flipping-left {
            transform: rotateY(160deg);
        }

        .nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            cursor: pointer;
            font-size: 3rem;
            color: #333;
            z-index: 10;
            padding: 0.5rem;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .nav-button.left {
            left: -60px;
        }

        .nav-button.right {
            right: -60px;
        }

        .nav-button:hover {
            background-color: rgba(255, 87, 51, 1);
        }

        canvas {
            width: 100%;
            height: 100%;
            border-radius: 0.5rem;
        }

        .zoom-buttons {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
            z-index: 10;
            position: relative;
        }

        .zoom-button {
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            padding: 0.5rem;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .zoom-button:hover {
            background-color: rgba(255, 255, 255, 1);
        }

        .header-buttons {
            position: fixed;
            top: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            z-index: 100;
        }

        .close, .theme-toggle {
            position: relative;
            top: auto;
            left: auto;
            right: auto;
        }
        @media (max-width: 768px) {
            body {
                position: fixed;
                padding-top: 60px;
            }

            .btn_1, .btnClose {
                width: 30px;
                height: 30px;
                font-size: 1.2rem;
            }

            .theme-toggle {
                position: absolute;
                top: 20px; /* Atur posisi tombol tema */
                right: 20px; /* Atur posisi tombol tema */
                font-size: 2rem;
                cursor: pointer;
                color: #FFA500; /* Warna untuk matahari */
                z-index: 100; /* Pastikan tombol di atas elemen lain */
            }

            .btn_1 {
                width: 40px; /* Ukuran tombol */
                height: 40px; /* Ukuran tombol */
                border: 2px solid #FFA500; /* Border */
                border-radius: 50%;
                font-size: 1.5rem; /* Ukuran ikon */
                transition: background-color 0.3s, color 0.3s;
            }

            .btn_1 i {
                font-size: 1.5rem; /* Ukuran ikon */
                margin: 0;
            }

            .bookWrapper {
                width: 90vw; /* Sesuaikan lebar untuk layar kecil */
                height: 50vw; /* Sesuaikan tinggi untuk layar kecil */
                margin-top: 10rem;
                display: flex;
                justify-content: center; /* Center content */
                align-items: center; /* Center vertically */
                position: relative; /* Tambahkan posisi relatif */
            }

            .bookPage {
                width: 100%;
                height: 100%;
                position: relative;
            }

            .nav-button {
                font-size: 2rem;
            }

            .zoom-button {
                font-size: 1.2rem;
            }

            .nav-button {
                position: absolute; /* Letakkan tombol navigasi */
                top: 50%; /* Posisikan di tengah vertikal */
                transform: translateY(-50%); /* Pusatkan tombol secara vertikal */
            }

            .nav-button.left {
                left: -60px; /* Sesuaikan jarak dari kiri */
            }

            .nav-button.right {
                right: -60px; /* Sesuaikan jarak dari kanan */
            }
            h1 {
                font-size: 1.8rem; /* Sesuaikan ukuran font judul */
                font-weight: bold;
                color: #333; /* Sesuaikan warna judul */
                margin-bottom: 1rem; /* Beri jarak dengan elemen di bawah */
                margin-top: 5rem;
            }

            .text-muted {
                font-size: 1.6rem; /* Ukuran font lebih kecil untuk subjudul atau keterangan */
                color: #777;
            }

            .close {
                top: 20px;
                left: 20px; /* Pindahkan ke kiri */
                right: auto; /* Hapus posisi kanan */
            }

            .theme-toggle {
                top: 20px;
                right: 20px; /* Pastikan tetap di kanan */
            }
        }

        .close {
            z-index: 101; /* Lebih tinggi dari tombol tema */
        }
        h1 {
            font-size: 2.4rem; /* Sesuaikan ukuran font judul */
            font-weight: bold;
            color: #333; /* Sesuaikan warna judul */
            margin-bottom: 1rem; /* Beri jarak dengan elemen di bawah */
            text-align: center;
        }

        .text-muted {
            font-size: 1.6rem; /* Ukuran font lebih kecil untuk subjudul atau keterangan */
            color: #777;
        }

        /* Typing Test Styles */
        .typing-section {
            text-align: center;
            margin: 2rem auto;
            max-width: 800px;
        }

        .typing-test {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: 2rem;
        }

        .typing-test-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .typing-test-header h2 {
            margin: 0;
        }

        .text-display {
            font-size: 1.2rem;
            line-height: 1.6;
            margin: 20px 0;
            text-align: left;
        }

        .word {
            padding: 2px 4px;
            margin: 0 2px;
        }

        .current-word {
            background-color: #e6f3ff;
            border-radius: 3px;
        }

        .correct {
            color: #28a745;
        }

        .incorrect {
            color: #dc3545;
            text-decoration: line-through;
        }

        .stats-container {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .stat-box {
            text-align: center;
        }

        .stat-label {
            display: block;
            font-size: 0.9rem;
            color: #666;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            margin: 5px 0;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .Bg {
            background-color: #9ca3af;
            position: absolute;
            width: calc(100%);
            height: calc(100%);
            border-radius: 1.2rem;
            z-index: 0;
        }

    </style>
</head>
<body>
<div class="header-buttons">
    <div class="close" title="Kembali">
        <a href="{{ url()->previous() }}" class="btnClose">
            <i class="bi bi-skip-backward-fill"></i>
        </a>
    </div>
    <div class="theme-toggle" id="themeToggle" title="Toggle Theme">
        <button type="button" class="btn_1" id="themeButton">
            <i class="bi bi-sun" id="themeIcon"></i>
        </button>
    </div>
</div>
<!-- Konten buku -->
<div class="text-center my-5">
    @if($book)
        <h1 class="text-bold">{{ $book->title }} <small class="text-muted"></small></h1>
    @else
        <h1 class="text-danger">Tidak ada buku yang ditemukan.</h1>
    @endif
    <hr style="border-width: 2px; border-color: #333;">
    <div class="bookWrapper mt-5" id="bookWrapper">
        <div class="bookBg"></div>
        <div class="Bg"></div>
        <button class="nav-button left" id="prevButton" title="Previous">
            <i class="bi bi-chevron-left"></i>
        </button>
        <div class="pageWrapper">
            <div class="bookPage left" id="leftPage">
                <canvas id="leftPdfCanvas"></canvas>
            </div>
            <div class="bookPage right" id="rightPage">
                <canvas id="rightPdfCanvas"></canvas>
            </div>
        </div>
        <button class="nav-button right" id="nextButton" title="Next">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
    <h4>
        @if(isset($showFreeBookMessage) && $showFreeBookMessage)
            <div class="alert alert-success">
                <i class="fas fa-gift me-2"></i>
                Buku ini <strong>GRATIS</strong>! Anda dapat membacanya langsung tanpa perlu membeli. Selamat menikmati!
            </div>
        @endif

                @if(isset($showSuccessConfirmation) && $showSuccessConfirmation)
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        Pembelian Anda telah <strong>Sukses</strong>. Selamat membaca!
                    </div>
                @endif
    </h4>

    <div class="zoom-buttons">
        <button class="zoom-button" id="zoomOut" title="Zoom Out">
            <i class="bi bi-zoom-out"></i>
        </button>
        <span id="zoomPercentage">Zoom: 100%</span>
        <button class="zoom-button" id="zoomIn" title="Zoom In">
            <i class="bi bi-zoom-in"></i>
        </button>
    </div>

{{--        Section Typing Test --}}
        <div class="typing-section mt-5" style="margin-bottom: 30%">
            <button id="show-typing-test" class="btn btn-primary btn-lg">
                <i class="bi bi-keyboard"></i> Gunakan Typing Test
            </button>

            <div id="typing-test-container" class="typing-test mt-3" style="display: none;">
                <div class="typing-test-header">
                    <h2>Typing Test</h2>
                    <button id="close-typing-test" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-x-lg"></i> Tutup
                    </button>
                </div>
                <small class="text-info d-flex align-items-center mt-2">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    Teks diambil dari halaman pdf yang sedang dibuka.
                </small>
                <!-- Pilihan jumlah kata -->
                <div class="word-count-selector mb-3">
                    <label for="wordCount">Pilih Jumlah Kata:</label>
                    <select id="wordCount" class="form-control">
                        <option value="10">10 Kata</option>
                        <option value="15">15 Kata</option>
                        <option value="30" selected>30 Kata</option>
                        <option value="50">50 Kata</option>
                    </select>
                </div>

                <!-- Stats Display -->
                <div class="stats-container mb-3">
                    <div class="stat-box">
                        <span class="stat-label">WPM</span>
                        <span id="wpm-display">0</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-label">Accuracy</span>
                        <span id="accuracy-display">0%</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-label">Time</span>
                        <span id="time-display">0s</span>
                    </div>
                </div>

                <!-- Text Display -->
                <div id="text-to-type" class="text-display mb-3"></div>

                <!-- Input Area -->
                <textarea id="typing-input" rows="3" class="form-control mb-3" disabled></textarea>

                <small class="text-info d-flex align-items-center mt-2">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    Teks terlalu sulit? Klik 'Stop Test' dan coba gunakan teks lain
                </small>

                <!-- Controls -->
                <div class="test-controls">
                    <button id="start-test" class="btn btn-primary">Start Test</button>
                    <button id="stop-test" class="btn btn-danger" style="display: none;">Stop Test</button>
                    <button id="new-text" class="btn btn-secondary" style="display: none;">New Text</button>
                </div>

                <!-- Results History -->
                <div id="test-history" class="mt-3">
                    <h4>Hasil Test Terakhir</h4>
                    <div id="history-list">
                        <div class="text-muted">Belum ada hasil test</div>
                    </div>
                </div>
                <div id="zoom-controls" class="mt-3">
                    <button id="zoom-out" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-zoom-out"></i> Perkecil
                    </button>
                    <button id="zoom-in" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-zoom-in"></i> Perbesar
                    </button>
                </div>
            </div>
        </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>
<script>
    const pdfUrl = '{{ asset('storage/books/pdf/'.$book->pdf_file) }}'; // Update with your PDF path
    const loadingTask = pdfjsLib.getDocument(pdfUrl);
    const leftCanvas = document.getElementById('leftPdfCanvas');
    const rightCanvas = document.getElementById('rightPdfCanvas');
    const leftContext = leftCanvas.getContext('2d');
    const rightContext = rightCanvas.getContext('2d');
    const bookWrapper = document.getElementById('bookWrapper');
    const zoomPercentageDisplay = document.getElementById('zoomPercentage');
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const body = document.body;
    let pdf = null;
    let currentPage = 1;
    let totalPages = 0;
    let scale = 1;

    loadingTask.promise.then(loadedPdf => {
        pdf = loadedPdf;
        totalPages = pdf.numPages;
        renderPages(currentPage);
    }).catch(error => {
        console.error('Error loading PDF:', error);
    });

    function renderPage(pageNumber, canvas, context) {
        if (pageNumber <= totalPages) {
            pdf.getPage(pageNumber).then(page => {
                const viewport = page.getViewport({ scale: 1.5 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };

                page.render(renderContext);
            });
        }
    }

    function renderPages(pageNumber) {
        renderPage(pageNumber, leftCanvas, leftContext);
        if (pageNumber + 1 <= totalPages) {
            renderPage(pageNumber + 1, rightCanvas, rightContext);
        } else {
            rightContext.clearRect(0, 0, rightCanvas.width, rightCanvas.height);
        }
    }

    document.getElementById('nextButton').addEventListener('click', () => {
        if (currentPage < totalPages) {
            const leftPage = document.getElementById('leftPage');
            const rightPage = document.getElementById('rightPage');

            rightPage.classList.add('flipping-right');
            leftPage.classList.add('flipping');

            setTimeout(() => {
                currentPage += 2;
                renderPages(currentPage);
                rightPage.classList.remove('flipping-right');
                leftPage.classList.remove('flipping');
            }, 500);
        }
    });

    document.getElementById('prevButton').addEventListener('click', () => {
        if (currentPage > 1) {
            const leftPage = document.getElementById('leftPage');
            const rightPage = document.getElementById('rightPage');

            leftPage.classList.add('flipping-left');
            rightPage.classList.add('flipping');

            setTimeout(() => {
                currentPage -= 2;
                renderPages(currentPage);
                leftPage.classList.remove('flipping-left');
                rightPage.classList.remove('flipping');
            }, 500);
        }
    });

    document.getElementById('zoomIn').addEventListener('click', () => {
        if (scale < 2) { // Limit zoom in to 200%
            scale += 0.1;
            bookWrapper.style.transform = `scale(${scale})`;
            updateZoomPercentage();
        }
    });

    document.getElementById('zoomOut').addEventListener('click', () => {
        if (scale > 0.5) { // Limit zoom out to 50%
            scale -= 0.1;
            bookWrapper.style.transform = `scale(${scale})`;
            updateZoomPercentage();
        }
    });

    function updateZoomPercentage() {
        const zoomPercentage = Math.round(scale * 100); // Convert scale to percentage
        zoomPercentageDisplay.textContent = `Zoom: ${zoomPercentage}%`;
    }

    // Add click event listeners to the pages
    document.getElementById('leftPage').addEventListener('click', () => {
        if (currentPage > 1) {
            flipLeftPage();
        }
    });

    document.getElementById('rightPage').addEventListener('click', () => {
        if (currentPage < totalPages) {
            flipRightPage();
        }
    });

    function flipRightPage() {
        const leftPage = document.getElementById('leftPage');
        const rightPage = document.getElementById('rightPage');

        rightPage.classList.add('flipping-right');
        leftPage.classList.add('flipping');

        setTimeout(() => {
            currentPage += 2;
            renderPages(currentPage);
            rightPage.classList.remove('flipping-right');
            leftPage.classList.remove('flipping');
        }, 1500);
    }

    function flipLeftPage() {
        const leftPage = document.getElementById('leftPage');
        const rightPage = document.getElementById('rightPage');

        leftPage.classList.add('flipping-left');
        rightPage.classList.add('flipping');

        setTimeout(() => {
            currentPage -= 2;
            renderPages(currentPage);
            leftPage.classList.remove('flipping-left');
            rightPage.classList.remove('flipping');
        }, 1500);
    }
    themeToggle.addEventListener('click', () => {
        const isDark = body.classList.toggle('dark-theme');

        // Atur warna latar belakang dan teks utama
        body.style.backgroundColor = isDark ? '#333' : '#F5F5F5'; // Latar belakang lebih gelap
        body.style.color = isDark ? '#e0e0e0' : '#333'; // Teks sedikit off-white untuk mengurangi silau

        // Atur warna ikon tema
        themeIcon.classList.toggle('bi-sun', !isDark);
        themeIcon.classList.toggle('bi-moon', isDark);
        themeIcon.style.color = isDark ? '#ffffff' : '#FFA500'; // Putih untuk tema gelap, oranye untuk tema terang

        // Atur warna teks untuk elemen-elemen spesifik
        const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
        headings.forEach(heading => {
            heading.style.color = isDark ? '#ffffff' : '#333'; // Heading putih di tema gelap
        });

        const paragraphs = document.querySelectorAll('p');
        paragraphs.forEach(p => {
            p.style.color = isDark ? '#cccccc' : '#333'; // Paragraf sedikit lebih gelap dari putih
        });

        const links = document.querySelectorAll('a');
        links.forEach(link => {
            link.style.color = isDark ? '#4da6ff' : '#0066cc'; // Biru lebih terang untuk link di tema gelap
        });

        // Atur warna tombol tema
        if (isDark) {
            themeButton.classList.add('btn-dark');
            themeButton.style.backgroundColor = '#333';
            themeButton.style.borderColor = '#ffffff';
        } else {
            themeButton.classList.remove('btn-dark');
            themeButton.style.backgroundColor = '#ffffff';
            themeButton.style.borderColor = '#FFA500';
        }

        // Atur warna untuk elemen-elemen lain jika diperlukan
        const customElements = document.querySelectorAll('.custom-text-element');
        customElements.forEach(element => {
            element.style.color = isDark ? '#f0f0f0' : '#333';
        });
    });

    // Variabel global
    let currentZoom = 100;
    const zoomStep = 10;
    const minZoom = 80;
    const maxZoom = 150;
    let wordCount = 30;
    let testHistory = null; // Menyimpan hanya satu hasil test
    let currentWordIndex = 0;
    let testActive = false;
    let typingInterval;
    let typingStartTime;
    let typingText = '';
    let timerInterval;
    const MAX_TEST_TIME = 60;
    let timeLeft = MAX_TEST_TIME;

    function updateZoom() {
        document.getElementById('typing-test-container').style.transform = `scale(${currentZoom / 100})`;
    }

    document.getElementById('zoom-in').addEventListener('click', () => {
        if (currentZoom < maxZoom) {
            currentZoom += zoomStep;
            updateZoom();
        }
    });

    document.getElementById('zoom-out').addEventListener('click', () => {
        if (currentZoom > minZoom) {
            currentZoom -= zoomStep;
            updateZoom();
        }
    });

    // Tampilkan typing test dan reset zoom
    document.getElementById('show-typing-test').addEventListener('click', () => {
        document.getElementById('typing-test-container').style.display = 'block';
        currentZoom = 100;
        updateZoom();
    });

    document.getElementById('close-typing-test').addEventListener('click', function() {
        document.getElementById('typing-test-container').style.display = 'none';
        const showButton = document.getElementById('show-typing-test');
        showButton.style.display = 'block';
        showButton.style.margin = '0 auto'; // Memastikan tombol tetap di tengah
        stopTest();
    });

    document.getElementById('show-typing-test').addEventListener('click', function() {
        document.getElementById('typing-test-container').style.display = 'block';
        this.style.display = 'none';
    });

    // Event listeners untuk kontrol test
    document.getElementById('start-test').addEventListener('click', startTypingTest);
    document.getElementById('stop-test').addEventListener('click', stopTest);
    document.getElementById('new-text').addEventListener('click', startTypingTest);

    // Event listener untuk input typing
    document.getElementById('typing-input').addEventListener('input', handleTypingInput);

    // Fungsi untuk mendapatkan teks yang bagus dari PDF
    async function getGoodRandomSentenceFromPDF() {
        if (!pdf) return '';
        const randomPage = Math.floor(Math.random() * totalPages) + 1;
        const page = await pdf.getPage(randomPage);
        const textContent = await page.getTextContent();
        const pageText = textContent.items.map(item => item.str).join(' ');
        const sentences = pageText.match(/[^\.!\?]+[\.!\?]+/g);

        if (!sentences) return getGoodRandomSentenceFromPDF();

        const goodSentences = sentences.filter(sentence => {
            const words = sentence.trim().split(/\s+/);
            return words.length >= 5 &&
                !/^\d+\./.test(sentence) &&
                !/^[A-Z][a-z]+ \d+/.test(sentence) &&
                !/^Table|^Figure|^Gambar|^Tabel/i.test(sentence);
        });

        if (goodSentences.length === 0) return getGoodRandomSentenceFromPDF();

        let text = '';
        while (text.split(/\s+/).length < wordCount) {
            const randomSentence = goodSentences[Math.floor(Math.random() * goodSentences.length)];
            text += ' ' + randomSentence.trim();
        }

        const words = text.trim().split(/\s+/);
        return words.slice(0, wordCount).join(' ');
    }

    // Fungsi untuk memulai test
    async function startTypingTest() {
        // Clear interval yang mungkin masih berjalan
        if (timerInterval) clearInterval(timerInterval);
        if (typingInterval) clearInterval(typingInterval);

        testActive = true;
        wordCount = parseInt(document.getElementById('wordCount').value);
        typingText = await getGoodRandomSentenceFromPDF();
        currentWordIndex = 0;
        testHistory = null;
        timeLeft = MAX_TEST_TIME; // Reset waktu

        // Reset UI
        document.getElementById('typing-input').value = '';
        document.getElementById('typing-input').disabled = false;
        document.getElementById('start-test').style.display = 'none';
        document.getElementById('stop-test').style.display = 'inline-block';
        document.getElementById('new-text').style.display = 'none';
        document.getElementById('wordCount').disabled = true;

        // Format dan tampilkan teks
        const words = typingText.split(' ');
        const formattedText = words.map((word, index) =>
            `<span class="word ${index === 0 ? 'current-word' : ''}">${word}</span>`
        ).join(' ');
        document.getElementById('text-to-type').innerHTML = formattedText;

        // Reset stats
        document.getElementById('wpm-display').textContent = '0';
        document.getElementById('accuracy-display').textContent = '0%';
        document.getElementById('time-display').textContent = MAX_TEST_TIME + 's';

        typingStartTime = new Date();
        document.getElementById('typing-input').focus();
        typingInterval = setInterval(updateTypingStats, 1000);

        // Set timer baru
        timerInterval = setInterval(() => {
            timeLeft--;
            document.getElementById('time-display').textContent = timeLeft + 's';
            if (timeLeft <= 0) {
                stopTest();
            }
        }, 1000);
    }

    // Fungsi untuk menghentikan test
    function stopTest() {
        if (testActive) {
            testActive = false;
            clearInterval(typingInterval);
            document.getElementById('typing-input').disabled = true;
            document.getElementById('start-test').style.display = 'inline-block';
            document.getElementById('stop-test').style.display = 'none';
            document.getElementById('new-text').style.display = 'inline-block';
            document.getElementById('wordCount').disabled = false;
            finishTest();

            // Hentikan countdown timer jika masih berjalan
            clearInterval(timerInterval);
        }
    }

    // Tambahkan fungsi isTestComplete
    function isTestComplete(input) {
        const originalWords = typingText.trim().split(/\s+/);
        const typedWords = input.trim().split(/\s+/);

        // Jika jumlah kata yang diketik sama dengan jumlah kata asli
        if (typedWords.length === originalWords.length) {
            // Cek apakah semua kata sudah benar
            for (let i = 0; i < originalWords.length; i++) {
                if (originalWords[i] !== typedWords[i]) {
                    return false;
                }
            }
            return true; // Semua kata benar
        }
        return false; // Jumlah kata belum sama
    }

    // Modifikasi fungsi updateTypingStats
    function updateTypingStats() {
        if (!testActive) return;

        const input = document.getElementById('typing-input').value;
        const timeTaken = Math.floor((new Date() - typingStartTime) / 1000);
        const wordsTyped = input.trim().split(/\s+/).length;
        const wpm = timeTaken > 0 ? Math.round((wordsTyped / timeTaken) * 60) : 0;
        const accuracy = calculateAccuracy(typingText, input);

        document.getElementById('wpm-display').textContent = wpm;
        document.getElementById('accuracy-display').textContent = accuracy + '%';
        document.getElementById('time-display').textContent = timeTaken + 's';

        // Update highlighting kata
        updateWordHighlighting(input);

        // Cek apakah waktu sudah habis
        if (timeTaken >= MAX_TEST_TIME) {
            console.log("Waktu habis - test berhenti");
            stopTest();
        } else if (isTestComplete(input)) {
            console.log("Test selesai - semua kata benar");
            stopTest();
        }
    }

    // Update fungsi handleTypingInput untuk memanggil updateTypingStats setiap kali ada input
    function handleTypingInput() {
        if (!testActive) return;

        const input = document.getElementById('typing-input').value;
        updateTypingStats();
    }

    // Fungsi untuk menyelesaikan test
    function finishTest() {
        const timeTaken = Math.floor((new Date() - typingStartTime) / 1000);
        testHistory = {
            wpm: parseInt(document.getElementById('wpm-display').textContent),
            accuracy: parseInt(document.getElementById('accuracy-display').textContent),
            wordCount: wordCount,
            time: timeTaken + 's'
        };
        updateHistory();
    }

    // Fungsi untuk mengupdate history
    function updateHistory() {
        const historyList = document.getElementById('history-list');
        if (testHistory) {
            const correctWords = testHistory.wordCount * (testHistory.accuracy / 100);
            historyList.innerHTML = `
            <div class="history-item">
                <span>Hasil Test</span>
                <span>${Math.round(correctWords)} kata benar</span>
                <span>${testHistory.wpm} WPM</span>
                <span>${testHistory.accuracy}% Akurasi</span>
                <span>${testHistory.time}</span>
            </div>
        `;
        } else {
            historyList.innerHTML = '<div class="text-muted">Belum ada hasil test</div>';
        }
    }
    function updateWordHighlighting(input) {
        const words = typingText.split(' ');
        const typedWords = input.split(' ');
        const spans = document.querySelectorAll('.word');

        spans.forEach((span, index) => {
            span.classList.remove('current-word', 'correct', 'incorrect');
            if (index < typedWords.length - 1) {
                if (words[index] === typedWords[index]) {
                    span.classList.add('correct');
                } else {
                    span.classList.add('incorrect');
                }
            } else if (index === typedWords.length - 1) {
                span.classList.add('current-word');
            }
        });
    }

    // Fungsi untuk menghitung akurasi
    function calculateAccuracy(original, typed) {
        const originalWords = original.trim().split(/\s+/);
        const typedWords = typed.trim().split(/\s+/);
        let correctWords = 0;

        for (let i = 0; i < Math.min(originalWords.length, typedWords.length); i++) {
            if (originalWords[i] === typedWords[i]) {
                correctWords++;
            }
        }

        return Math.round((correctWords / originalWords.length) * 100);
    }

</script>
</body>
</html>
