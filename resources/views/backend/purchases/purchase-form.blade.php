<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-primary text-white py-3">
        <h4 class="mb-0">
            <i class="fas fa-shopping-cart me-2"></i>Detail Pembelian
        </h4>
    </div>

    <div class="card-body p-4">
        <!-- Book Information -->
        <div class="book-info bg-light p-3 rounded-3 mb-4">
            <div class="row align-items-start">
                <div class="col-md-3">
                    @if($flipbook->cover_image)
                        <img src="{{ asset('storage/books/images/' . $flipbook->cover_image) }}"
                             class="img-fluid rounded shadow-sm"
                             alt="{{ $flipbook->title }}"
                             style="max-height: 200px;">
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
                    <i class="fas fa-credit-card me-2"></i>Metode Pembayaran
                </label>
                <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                    <option value="" selected disabled>Pilih metode pembayaran</option>
                    <option value="Credit Card">Kartu Kredit</option>
                    <option value="Bank Transfer">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Other">Lainnya</option>
                </select>
                @error('payment_method')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
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
        document.getElementById('payment_proof').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file melebihi 2MB');
                    this.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.classList.add('img-fluid', 'mt-2');
                    const previewDiv = document.getElementById('payment_proof_preview');
                    previewDiv.innerHTML = '';
                    previewDiv.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
