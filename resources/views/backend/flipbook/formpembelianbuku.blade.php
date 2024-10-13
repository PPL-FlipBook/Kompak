<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Buku Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .book-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .book-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            width: 200px;
            text-align: center;
        }
        .book-card img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .book-card button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: black;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    </style>
</head>
<body>
<h1>Dashboard Buku</h1>
<div class="book-container" id="bookContainer"></div>

<div id="purchaseModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Form Pembelian</h2>
        <form id="purchaseForm">
            <p id="selectedBookInfo"></p>
            <select id="paymentMethod" required>
                <option value="">Pilih metode pembayaran</option>
                <option value="ewallet">E-Wallet</option>
                <option value="bank">Transfer Bank</option>
            </select>
            <div id="accountInfo" style="display: none;"></div>
            <input type="file" id="proofOfPayment" accept="image/*" required>
            <button type="submit">Kirim Bukti Pembayaran</button>
        </form>
    </div>
</div>

<script>
    const books = [
        { id: 1, title: "Buku 1", image: "https://via.placeholder.com/150x200", price: 100000 },
        { id: 2, title: "Buku 2", image: "https://via.placeholder.com/150x200", price: 150000 },
        { id: 3, title: "Buku 3", image: "https://via.placeholder.com/150x200", price: 120000 },
    ];

    const paymentMethods = {
        ewallet: { name: "E-Wallet", accountNumber: "081234567890" },
        bank: { name: "Transfer Bank", accountNumber: "1234567890" },
    };

    const bookContainer = document.getElementById('bookContainer');
    const modal = document.getElementById('purchaseModal');
    const closeBtn = document.getElementsByClassName('close')[0];
    const purchaseForm = document.getElementById('purchaseForm');
    const paymentMethodSelect = document.getElementById('paymentMethod');
    const accountInfo = document.getElementById('accountInfo');
    const selectedBookInfo = document.getElementById('selectedBookInfo');

    // Render books
    books.forEach(book => {
        const bookCard = document.createElement('div');
        bookCard.className = 'book-card';
        bookCard.innerHTML = `
                <img src="${book.image}" alt="${book.title}">
                <h3>${book.title}</h3>
                <p>Harga: Rp ${book.price.toLocaleString()}</p>
                <button onclick="openPurchaseModal(${book.id})">Beli</button>
            `;
        bookContainer.appendChild(bookCard);
    });

    // Open purchase modal
    function openPurchaseModal(bookId) {
        const book = books.find(b => b.id === bookId);
        selectedBookInfo.textContent = `${book.title} - Rp ${book.price.toLocaleString()}`;
        modal.style.display = 'block';
    }

    // Close modal
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Handle payment method change
    paymentMethodSelect.onchange = function() {
        const selectedMethod = paymentMethods[this.value];
        if (selectedMethod) {
            accountInfo.style.display = 'block';
            accountInfo.textContent = `Nomor Akun ${selectedMethod.name}: ${selectedMethod.accountNumber}`;
        } else {
            accountInfo.style.display = 'none';
        }
    }

    // Handle form submission
    purchaseForm.onsubmit = function(e) {
        e.preventDefault();
        const paymentMethod = paymentMethodSelect.value;
        const proofOfPayment = document.getElementById('proofOfPayment').files[0];

        console.log('Pembelian diproses:', {
            book: selectedBookInfo.textContent,
            paymentMethod: paymentMethod,
            proofOfPayment: proofOfPayment ? proofOfPayment.name : 'Tidak ada file'
        });

        alert('Pembelian berhasil diproses!');
        modal.style.display = 'none';
        this.reset();
    }
</script>
</body>
</html>


{{--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Buku dengan Persetujuan Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .book-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .book-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            width: 200px;
            text-align: center;
        }
        .book-card img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .book-card button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: black;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        #adminPanel {
            margin-top: 20px;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 8px;
        }
        .purchase-item {
            background-color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        #readBookModal .modal-content {
            width: 60%;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <h1>Dashboard Buku</h1>
    <div class="book-container" id="bookContainer"></div>

    <div id="purchaseModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Form Pembelian</h2>
            <form id="purchaseForm">
                <p id="selectedBookInfo"></p>
                <select id="paymentMethod" required>
                    <option value="">Pilih metode pembayaran</option>
                    <option value="ewallet">E-Wallet</option>
                    <option value="bank">Transfer Bank</option>
                </select>
                <div id="accountInfo" style="display: none;"></div>
                <input type="file" id="proofOfPayment" accept="image/*" required>
                <button type="submit">Kirim Bukti Pembayaran</button>
            </form>
        </div>
    </div>

    <div id="readBookModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="readBookTitle"></h2>
            <div id="bookContent"></div>
        </div>
    </div>

    <div id="adminPanel">
        <h2>Panel Admin</h2>
        <div id="pendingPurchases"></div>
    </div>

    <script>
        const books = [
            { id: 1, title: "Buku 1", image: "https://via.placeholder.com/150x200", price: 100000, content: "Ini adalah konten dari Buku 1. Silakan baca dengan seksama." },
            { id: 2, title: "Buku 2", image: "https://via.placeholder.com/150x200", price: 150000, content: "Selamat datang di Buku 2. Nikmati bacaan Anda!" },
            { id: 3, title: "Buku 3", image: "https://via.placeholder.com/150x200", price: 120000, content: "Buku 3 siap untuk dibaca. Semoga bermanfaat!" },
        ];

        const paymentMethods = {
            ewallet: { name: "E-Wallet", accountNumber: "081234567890" },
            bank: { name: "Transfer Bank", accountNumber: "1234567890" },
        };

        let purchases = [];

        const bookContainer = document.getElementById('bookContainer');
        const purchaseModal = document.getElementById('purchaseModal');
        const readBookModal = document.getElementById('readBookModal');
        const closeButtons = document.getElementsByClassName('close');
        const purchaseForm = document.getElementById('purchaseForm');
        const paymentMethodSelect = document.getElementById('paymentMethod');
        const accountInfo = document.getElementById('accountInfo');
        const selectedBookInfo = document.getElementById('selectedBookInfo');
        const pendingPurchases = document.getElementById('pendingPurchases');

        // Render books
        function renderBooks() {
            bookContainer.innerHTML = '';
            books.forEach(book => {
                const bookCard = document.createElement('div');
                bookCard.className = 'book-card';
                bookCard.innerHTML = `
                    <img src="${book.image}" alt="${book.title}">
                    <h3>${book.title}</h3>
                    <p>Harga: Rp ${book.price.toLocaleString()}</p>
                    <button onclick="openPurchaseModal(${book.id})">Beli</button>
                `;

                const userPurchase = purchases.find(p => p.bookId === book.id);
                if (userPurchase) {
                    if (userPurchase.status === 'pending') {
                        bookCard.innerHTML += `<p>Status: Menunggu persetujuan</p>`;
                    } else if (userPurchase.status === 'approved') {
                        bookCard.innerHTML += `<button onclick="openReadBookModal(${book.id})">Baca Buku</button>`;
                    }
                }

                bookContainer.appendChild(bookCard);
            });
        }

        // Open purchase modal
        function openPurchaseModal(bookId) {
            const book = books.find(b => b.id === bookId);
            selectedBookInfo.textContent = `${book.title} - Rp ${book.price.toLocaleString()}`;
            purchaseModal.style.display = 'block';
        }

        // Open read book modal
        function openReadBookModal(bookId) {
            const book = books.find(b => b.id === bookId);
            document.getElementById('readBookTitle').textContent = book.title;
            document.getElementById('bookContent').textContent = book.content;
            readBookModal.style.display = 'block';
        }

        // Close modals
        Array.from(closeButtons).forEach(btn => {
            btn.onclick = function() {
                purchaseModal.style.display = 'none';
                readBookModal.style.display = 'none';
            }
        });

        window.onclick = function(event) {
            if (event.target == purchaseModal) {
                purchaseModal.style.display = 'none';
            }
            if (event.target == readBookModal) {
                readBookModal.style.display = 'none';
            }
        }

        // Handle payment method change
        paymentMethodSelect.onchange = function() {
            const selectedMethod = paymentMethods[this.value];
            if (selectedMethod) {
                accountInfo.style.display = 'block';
                accountInfo.textContent = `Nomor Akun ${selectedMethod.name}: ${selectedMethod.accountNumber}`;
            } else {
                accountInfo.style.display = 'none';
            }
        }

        // Handle form submission
        purchaseForm.onsubmit = function(e) {
            e.preventDefault();
            const bookId = parseInt(selectedBookInfo.textContent.split(' - ')[0].replace('Buku ', ''));
            const paymentMethod = paymentMethodSelect.value;
            const proofOfPayment = document.getElementById('proofOfPayment').files[0];

            purchases.push({
                bookId: bookId,
                paymentMethod: paymentMethod,
                proofOfPayment: proofOfPayment ? proofOfPayment.name : 'Tidak ada file',
                status: 'pending'
            });

            alert('Pembelian berhasil diproses! Menunggu persetujuan admin.');
            purchaseModal.style.display = 'none';
            this.reset();
            renderBooks();
            renderPendingPurchases();
        }

        // Render pending purchases for admin
        function renderPendingPurchases() {
            pendingPurchases.innerHTML = '';
            purchases.filter(p => p.status === 'pending').forEach(purchase => {
                const book = books.find(b => b.id === purchase.bookId);
                const purchaseItem = document.createElement('div');
                purchaseItem.className = 'purchase-item';
                purchaseItem.innerHTML = `
                    <p>Buku: ${book.title}</p>
                    <p>Metode Pembayaran: ${purchase.paymentMethod}</p>
                    <p>Bukti Pembayaran: ${purchase.proofOfPayment}</p>
                    <button onclick="approvePurchase(${purchase.bookId})">Setujui</button>
                `;
                pendingPurchases.appendChild(purchaseItem);
            });
        }

        // Approve purchase (admin action)
        function approvePurchase(bookId) {
            const purchaseIndex = purchases.findIndex(p => p.bookId === bookId && p.status === 'pending');
            if (purchaseIndex !== -1) {
                purchases[purchaseIndex].status = 'approved';
                alert('Pembelian disetujui!');
                renderBooks();
                renderPendingPurchases();
            }
        }

        // Initial render
        renderBooks();
        renderPendingPurchases();
    </script>
</body>
</html>--}}
