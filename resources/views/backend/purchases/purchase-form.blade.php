<!-- Book Information -->
                <div class="book-info bg-light p-3 rounded-3 mb-4">
                    <div class="row align-items-start">
                        <div class="col-md-3">
                            @if($flipbook->cover_image)
                                <img src="{{ asset('storage/books/images/' . $flipbook->cover_image) }}"
                                     class="img-fluid rounded shadow-sm"
                                     alt="{{ $flipbook->title }}"
                                     style="max-height: 500px;">
                            @else
                                <div class="placeholder-image bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-book fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <h5 class="text-primary mb-2">{{ $flipbook->title }}</h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-user me-2"></i>{{ $flipbook->author }}
                            </p>
                            <h4 class="text-success mb-3">
                                <i class="fas fa-tag me-2"></i>Rp {{ number_format($flipbook->price, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <div class="description">
                                <h6 class="text-secondary mb-2">Deskripsi:</h6>
                                <p class="text-muted">{!! nl2br(e($flipbook->description)) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purchase Form -->
                <form action="{{ route('purchases.store', $flipbook->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Quantity -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fas fa-shopping-basket me-2"></i>Jumlah Pembelian
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control bg-light" value="1" readonly>
                            <input type="hidden" name="quantity" value="1">
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fas fa-credit-card me-2"></i>Informasi Pembayaran
                        </label>
                        <div class="payment-methods row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                            <!-- Bank BRI -->
                            @if($salesInfo && $salesInfo->bank_bri)
                                <div class="col">
                                    <div class="payment-item alert alert-info h-100 mb-0">
                                        <h6 class="fw-bold"><i class="fas fa-university me-2"></i>Bank BRI</h6>
                                        <div class="payment-details">
                                            <p class="mb-1">Nomor Rekening: {{ $salesInfo->bank_bri }}</p>
                                            <p class="mb-0">Atas Nama: {{ $salesInfo->bank_bri_name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <!-- Bank BCA -->
                            @if($salesInfo && $salesInfo->bank_bca)
                                <div class="col">
                                    <div class="payment-item alert alert-info h-100 mb-0">
                                        <h6 class="fw-bold"><i class="fas fa-university me-2"></i>Bank BCA</h6>
                                        <div class="payment-details">
                                            <p class="mb-1">Nomor Rekening: {{ $salesInfo->bank_bca }}</p>
                                            <p class="mb-0">Atas Nama: {{ $salesInfo->bank_bca_name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Bank Mandiri -->
                            @if($salesInfo && $salesInfo->bank_mandiri)
                                <div class="col">
                                    <div class="payment-item alert alert-info h-100 mb-0">
                                        <h6 class="fw-bold"><i class="fas fa-university me-2"></i>Bank Mandiri</h6>
                                        <div class="payment-details">
                                            <p class="mb-1">Nomor Rekening: {{ $salesInfo->bank_mandiri }}</p>
                                            <p class="mb-0">Atas Nama: {{ $salesInfo->bank_mandiri_name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- DANA -->
                            @if($salesInfo && $salesInfo->dana)
                                <div class="col">
                                    <div class="payment-item alert alert-info h-100 mb-0">
                                        <h6 class="fw-bold"><i class="fas fa-wallet me-2"></i>DANA</h6>
                                        <div class="payment-details">
                                            <p class="mb-1">Nomor: {{ $salesInfo->dana }}</p>
                                            <p class="mb-0">Atas Nama: {{ $salesInfo->dana_name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- OVO -->
                            @if($salesInfo && $salesInfo->ovo)
                                <div class="col">
                                    <div class="payment-item alert alert-info h-100 mb-0">
                                        <h6 class="fw-bold"><i class="fas fa-wallet me-2"></i>OVO</h6>
                                        <div class="payment-details">
                                            <p class="mb-1">Nomor: {{ $salesInfo->ovo }}</p>
                                            <p class="mb-0">Atas Nama: {{ $salesInfo->ovo_name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- GoPay -->
                            @if($salesInfo && $salesInfo->gopay)
                                <div class="col">
                                    <div class="payment-item alert alert-info h-100 mb-0">
                                        <h6 class="fw-bold"><i class="fas fa-wallet me-2"></i>GoPay</h6>
                                        <div class="payment-details">
                                            <p class="mb-1">Nomor: {{ $salesInfo->gopay }}</p>
                                            <p class="mb-0">Atas Nama: {{ $salesInfo->gopay_name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <small class="text-muted mt-3 d-block">
                            <i class="fas fa-info-circle me-1"></i>
                            Silahkan transfer sesuai dengan nominal pembelian yaitu <strong>Rp {{ number_format($flipbook->price, 0, ',', '.') }}</strong> ke salah satu rekening di atas
                        </small>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fas fa-credit-card me-2"></i>Metode Pembayaran
                        </label>
                        <select name="payment_method" class="form-select" required>
                            <option value="">Pilih metode pembayaran</option>
                            <option value="Bank BRI">Bank BRI</option>
                            <option value="Bank BCA">Bank BCA</option>
                            <option value="Bank Mandiri">Bank Mandiri</option>
                            <option value="DANA">DANA</option>
                            <option value="OVO">OVO</option>
                            <option value="GoPay">GoPay</option>
                        </select>
                        <small class="text-muted mt-3 d-block">
                            <i class="fas fa-info-circle me-1"></i>
                            Silahkan pilih metode pembayaran yang sesuai
                        </small>
                    </div>

                    <!-- Payment Proof -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fas fa-file-image me-2"></i>Bukti Pembayaran
                        </label>
                        <input type="file" name="payment_proof"
                               class="form-control @error('payment_proof') is-invalid @enderror"
                               accept="image/*">
                        @error('payment_proof')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted mt-2 d-block">
                            <i class="fas fa-info-circle me-1"></i>
                            Format yang diterima: JPG, JPEG, PNG (Maksimal 2MB)
                        </small>
                        <div id="payment_proof_preview" class="mt-2"></div>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-2">
                            <i class="fas fa-shopping-cart me-2"></i>Beli Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>

@push('styles')
    <style>

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            border-bottom: none;
        }

        .book-info {
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .form-label {
            color: #495057;
        }

        .form-control, .form-select {
            border: 1px solid #ced4da;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }

        .invalid-feedback {
            font-size: 0.875rem;
            color: #dc3545;
        }

        #payment_proof_preview img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .book-info {
                padding: 1rem;
            }

            .col-md-3 {
                margin-bottom: 1rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethod = document.getElementById('payment_method');
            const paymentDetails = document.getElementById('payment_details');
            const accountInfo = document.getElementById('account_info');
            const paymentProofInput = document.getElementById('payment_proof');
            const paymentProofPreview = document.getElementById('payment_proof_preview');

            // Payment method change handler
            paymentMethod.addEventListener('change', function() {
                const selectedMethod = this.value;
                const accountDetails = {
                    bank_bri: {
                        name: 'Bank BRI',
                        account: '{{ $flipbook->bank_bri }}'
                    },
                    bank_bca: {
                        name: 'Bank BCA',
                        account: '{{ $flipbook->bank_bca }}'
                    },
                    bank_mandiri: {
                        name: 'Bank Mandiri',
                        account: '{{ $flipbook->bank_mandiri }}'
                    },
                    dana: {
                        name: 'Dana',
                        account: '{{ $flipbook->dana }}'
                    },
                    ovo: {
                        name: 'OVO',
                        account: '{{ $flipbook->ovo }}'
                    },
                    gopay: {
                        name: 'GoPay',
                        account: '{{ $flipbook->gopay }}'
                    }
                };

                const selectedAccount = accountDetails[selectedMethod];

                if (selectedAccount && selectedAccount.account) {
                    accountInfo.innerHTML = `
                <strong>${selectedAccount.name}:</strong><br>
                Nomor Rekening/Akun: ${selectedAccount.account}<br>
                Atas Nama: {{ $flipbook->user->name ?? 'Admin' }}
                    `;
                    paymentDetails.classList.remove('d-none');
                } else {
                    paymentDetails.classList.add('d-none');
                }
            });

            // Payment proof preview handler
            paymentProofInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file melebihi 2MB');
                        this.value = '';
                        paymentProofPreview.innerHTML = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.classList.add('img-fluid', 'mt-2', 'rounded');
                        paymentProofPreview.innerHTML = '';
                        paymentProofPreview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                } else {
                    paymentProofPreview.innerHTML = '';
                }
            });
        });
    </script>
@endpush
