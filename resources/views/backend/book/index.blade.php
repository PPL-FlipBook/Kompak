@extends('layout')

@section('content')
    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Buku</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Buku</h6>
                </nav>
            </div>
        </nav>

        <div class="row m-md-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Data Buku</h6>
                            <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambahBuku">
                                + Tambah Buku
                            </button>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategory</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gambar Sampul</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Unggah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penulis</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div class="ms-2">
                                                <h6 class="text-sm mb-0">{{ $book->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($book->categories as $category)
                                            {{ $category->name }}@if (!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @if($book->cover_image)
                                            <img src="{{ Storage::url('books/images/' . $book->cover_image) }}" alt="Gambar Sampul" width="75" height="75" class="rounded">
                                        @else
                                            <p>No image available</p>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-sm mb-0">{{ $book->upload_date->format('d M Y') }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-sm mb-0">{{ $book->author }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-sm mb-0">{{ $book->status }}</h6>
                                    </td>
                                    <td class="text-center">
                                        @if($book->status === 'Paid')
                                            <h6 class="text-sm mb-0">Rp {{ number_format($book->price, 0, ',', '.') }}</h6>
                                        @else
                                            <h6 class="text-sm mb-0">Free</h6>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('frontend.example1', $book->id) }}"><i class="fas fa-eye"></i></a>
                                        <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#editBook-{{ $book->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#hapusBook-{{ $book->id }}" class="text-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($books->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $books->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($books->links()->elements as $element)
                                @if (is_string($element))
                                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $books->currentPage())
                                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($books->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $books->nextPageUrl() }}" rel="next">&raquo;</a></li>
                            @else
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="tambahBuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBukuLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Judul Buku</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="author">Penulis</label>
                                    <input type="text" name="author" id="author" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="upload_date">Tanggal Unggah</label>
                                    <input type="date" name="upload_date" id="upload_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status-tambah" class="form-select" required>
                                        <option value="Free">Free</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row d-none" id="price-group-tambah">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" id="price-tambah" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categories">Kategori</label>
                                    <select name="categories[]" id="categories" class="form-select" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pdf_file">Upload PDF</label>
                                    <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept="application/pdf">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cover_image">Upload Gambar Sampul</label>
                                    <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $book->description ?? '') }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit Buku -->
    @foreach($books as $book)
        <div class="modal fade" id="editBook-{{ $book->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBookLabel-{{ $book->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBookLabel-{{ $book->id }}">Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Judul Buku</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="author">Penulis</label>
                                        <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upload_date">Tanggal Unggah</label>
                                        <input type="date" name="upload_date" id="upload_date" class="form-control" value="{{ $book->upload_date->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status-edit-{{ $book->id }}" class="form-select" required>
                                            <option value="Free" {{ $book->status == 'Free' ? 'selected' : '' }}>Free</option>
                                            <option value="Paid" {{ $book->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Group (initially hidden if status is 'Free') -->
                            <div class="row {{ $book->status == 'Paid' ? '' : 'd-none' }}" id="price-group-edit-{{ $book->id }}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="price">Harga</label>
                                        <input type="number" name="price" id="price-edit-{{ $book->id }}" class="form-control" step="0.01" min="0" value="{{ $book->price }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="categories[]" id="category_id" class="form-select" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $book->categories->contains($category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pdf_file">Upload PDF</label>
                                        <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept="application/pdf">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cover_image">Upload Gambar Sampul</label>
                                        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $book->description ?? '') }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Hapus Buku -->
    @foreach($books as $book)
        <div class="modal fade" id="hapusBook-{{ $book->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusBookLabel-{{ $book->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusBookLabel-{{ $book->id }}">Hapus Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus buku "{{ $book->title }}"?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Script tambah-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.getElementById('status-tambah');
            const priceGroup = document.getElementById('price-group-tambah');
            const priceInput = document.getElementById('price-tambah');

            // Function to show/hide price input based on status
            function togglePriceInput() {
                if (statusSelect.value === 'Paid') {
                    priceGroup.classList.remove('d-none');
                    priceInput.setAttribute('required', 'required'); // Set required if Paid
                } else {
                    priceGroup.classList.add('d-none');
                    priceInput.removeAttribute('required'); // Remove required if Free
                }
            }

            // Attach event listener to status select
            statusSelect.addEventListener('change', togglePriceInput);

            // Initial call in case the modal is opened and Paid is already selected
            togglePriceInput();
        });
    </script>

    {{-- Script Edit --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach($books as $book)
            const statusSelectEdit = document.getElementById('status-edit-{{ $book->id }}');
            const priceGroupEdit = document.getElementById('price-group-edit-{{ $book->id }}');

            statusSelectEdit.addEventListener('change', function () {
                if (this.value === 'Paid') {
                    priceGroupEdit.classList.remove('d-none');
                } else {
                    priceGroupEdit.classList.add('d-none');
                }
            });
            @endforeach
        });

    </script>
@endsection
