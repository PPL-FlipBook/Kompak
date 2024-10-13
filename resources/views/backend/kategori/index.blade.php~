@extends('layout')

@section('content')
    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Kategori</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Kategori</h6>
                </nav>
            </div>
        </nav>
        <div class="row m-md-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Data Kategori</h6>
                            <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambahKategori">
                                + Tambah Kategori
                            </button>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div class="ms-2">
                                                <h6 class="text-sm mb-0">{{ $category->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#editKategori-{{ $category->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#hapusKategori-{{ $category->id }}" class="text-danger">
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
                            @if ($categories->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($categories->links()->elements as $element)
                                @if (is_string($element))
                                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $categories->currentPage())
                                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($categories->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="tambahKategori" tabindex="-1" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nama Kategori</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>
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

    <!-- Modal Edit Kategori -->
    @foreach($categories as $category)
        <div class="modal fade" id="editKategori-{{ $category->id }}" tabindex="-1" aria-labelledby="editKategoriLabel-{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKategoriLabel-{{ $category->id }}">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kategory.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name-{{ $category->id }}">Nama Kategori</label>
                                        <input type="text" name="name" id="name-{{ $category->id }}" class="form-control" value="{{ $category->name }}" required>
                                    </div>
                                </div>
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

    <!-- Modal Hapus Kategori -->
    @foreach($categories as $category)
        <div class="modal fade" id="hapusKategori-{{ $category->id }}" tabindex="-1" aria-labelledby="hapusKategoriLabel-{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusKategoriLabel-{{ $category->id }}">Hapus Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus kategori "{{ $category->name }}"?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('kategory.destroy', $category->id) }}" method="POST">
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
            @foreach($categories as $category)
            const statusSelectEdit = document.getElementById('status-edit-{{ $category->id }}');
            const priceGroupEdit = document.getElementById('price-group-edit-{{ $category->id }}');
            const priceInputEdit = document.getElementById('price-edit-{{ $category->id }}');

            // Function to show/hide price input based on status
            function togglePriceInputEdit() {
                if (statusSelectEdit.value === 'Paid') {
                    priceGroupEdit.classList.remove('d-none');
                    priceInputEdit.setAttribute('required', 'required'); // Set required if Paid
                } else {
                    priceGroupEdit.classList.add('d-none');
                    priceInputEdit.removeAttribute('required'); // Remove required if Free
                }
            }

            // Attach event listener to status select
            statusSelectEdit.addEventListener('change', togglePriceInputEdit);

            // Initial call in case the modal is opened and Paid is already selected
            togglePriceInputEdit();
            @endforeach
        });
    </script>
@endsection
