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
            background-color: #000;
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
    </style>
</head>
<body>
<div class="header-buttons">
    <div class="close" title="Kembali">
        <a href="{{route('frontend.index')}}" class="btnClose">
            <i class="bi bi-skip-backward-fill"></i>
        </a>
    </div>
    <div class="theme-toggle" id="themeToggle" title="Toggle Theme">
        <button type="button" class="btn_1" id="themeButton">
            <i class="bi bi-sun" id="themeIcon"></i>
        </button>
    </div>
</div>
<div class="text-center my-5">
    @if($book)
        <h1 class="text-bold">{{ $book->title }} <small class="text-muted"></small></h1>
    @else
        <h1 class="text-danger">Tidak ada buku yang ditemukan.</h1>
    @endif
    <hr style="border-width: 2px; border-color: #333;">
<div class="bookWrapper mt-5" id="bookWrapper">
    <div class="bookBg"></div>
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

<div class="zoom-buttons">
    <button class="zoom-button" id="zoomOut" title="Zoom Out">
        <i class="bi bi-zoom-out"></i>
    </button>
    <span id="zoomPercentage">Zoom: 100%</span>
    <button class="zoom-button" id="zoomIn" title="Zoom In">
        <i class="bi bi-zoom-in"></i>
    </button>
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
            }, 1500);
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
            }, 1500);
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
        body.style.backgroundColor = isDark ? '#1a1a1a' : '#F5F5F5'; // Latar belakang lebih gelap
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


</script>
</body>
</html>
