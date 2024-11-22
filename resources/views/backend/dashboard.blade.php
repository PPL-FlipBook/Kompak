@extends('layout')
@section('content')
<main class="main-content position-relative border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
            </nav>
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="ni ni-like-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="ni ni-bell-55"></i>
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </nav>
    <div class="container-fluid py-4">
        <div class="row">
            @can('admin/superadmin')
            <div class="container-fluid py-4">
                <div class="row">
                    <!-- Books Section -->
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Buku</p>
                                            <h5 class="font-weight-bolder">
                                                {{ $totalBooks }} <!-- Total number of books -->
                                            </h5>
                                            <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">
                                        {{ $changeBooks > 0 ? '+' . $changeBooks : $changeBooks }} <!-- Change in number of books since last week -->
                                    </span>
                                                since last week
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                            <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Users Section -->
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Pengguna</p>
                                            <h5 class="font-weight-bolder">
                                                {{ $totalUsers }} <!-- Total number of users -->
                                            </h5>
                                            <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">
                                        {{ $changeUsers > 0 ? '+' . $changeUsers : $changeUsers }} <!-- Change in number of users since last week -->
                                    </span>
                                                since last week
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                            <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Pembelian</p>
                                            <h5 class="font-weight-bolder">
                                                {{ $totalPurchases }} <!-- Total number of purchases -->
                                            </h5>
                                            <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">
                                {{ $changePurchases > 0 ? '+' . $changePurchases : $changePurchases }} <!-- Change in number of purchases since last week -->
                            </span>
                                                since last week
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                            <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Buku Terbaca</p>
                                            <h5 class="font-weight-bolder">
                                                103
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+5</span> since last week
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <i class="ni ni-books text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
    <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Sales overview</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-lg-5">
            <div class="card card-carousel overflow-hidden h-100 p-0">
{{--                <div class="card-header pb-0 pt-3 bg-transparent">--}}
{{--                    <h6 class="text-capitalize">Aktivitas Terbaru</h6>--}}
{{--                </div>--}}
                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100">
                        <div class="carousel-item h-100 active" style="background-image: url('{{asset('assets/img/carousel-1.jpg')}}');
      background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-cloud-upload-96 text-dark opacity-10"></i> <!-- Ikon upload buku baru -->
                                </div>
                                <h5 class="text-white mb-1 position-relative">Buku Baru Diunggah<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">Baru</span></h5>
                                @if($subjectId)
                                    <div>
                                        <p>{{ $subjectId->description }}</p>
                                    </div>
                                @else
                                    <div>
                                        <p>Tidak ada deskripsi terbaru.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="background-image: url('{{asset('assets/img/carousel-2.jpg')}}');
      background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-credit-card text-dark opacity-10"></i> <!-- Ikon pembelian buku -->
                                </div>
                                <a href="#">
                                    <h5 class="text-white mb-1 position-relative">Pembelian Buku<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">Verifikasi</span></h5>
                                </a>
                                <p>Mahasiswa A membeli buku "Introduction to PHP".</p>
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="background-image: url('{{asset('assets/img/carousel-3.jpg')}}');
      background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-bell-55 text-dark opacity-10"></i> <!-- Ikon error sistem -->
                                </div>
                                <h5 class="text-white mb-1 position-relative">Error Sistem<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">Error</span></h5>
                                <p>Sistem mengalami error pada saat pembacaan buku.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Manajemen Pengguna</h6>
                            @can('super admin')
                                <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambahUser ">
                                    + Tambah
                                </button>
                            @endcan
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="p-3"> <!-- Add padding here -->
                            <table class="table table-bordered table-striped">
                                <thead class="bg-dark text-white">
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center">Nama</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center">Email</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center">Role</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center">Tanggal Bergabung</th>
                                    @can('super admin')
                                        <th class="text-uppercase text-xxs font-weight-bolder text-center">Aksi</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $row)
                                    <tr>
                                        <td class="text-center">
                                            <h6 class="text-sm mb-0">{{ $row->name }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm mb-0">{{ $row->email }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm mb-0">{{ $row->role }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm mb-0">{{ $row->created_at->format('d M Y') }}</h6>
                                        </td>
                                        @can('super admin')
                                            <td class="text-center">
                                                <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#editUser -{{ $row->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#hapusUser -{{ $row->id }}" class="text-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- End of padding div -->
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm">
                                {{-- Previous Page Link --}}
                                @if ($users->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">&laquo;</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($users->links()->elements as $element)
                                    @if (is_string($element))
                                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                                    @endif

                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $users->currentPage())
                                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($users->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true"><span class="page-link ">&raquo;</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>


            <!-- Modal Tambah User-->
            <div class="modal fade" id="tambahUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">TAMBAH USER</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('user.prosesCreate')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Name:</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input name="password" value="{{ old('password') }}" type="password" class="form-control" id="password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="col-form-label">Role:</label>
                                    <select name="role" class="form-select" id="role">
                                    <option value="User" {{ old('role', $user->role ?? '') == 'User' ? 'selected' : '' }}>User</option>
                                    <option value="Author" {{ old('role', $user->role ?? '') == 'Author' ? 'selected' : '' }}>Author</option>
                                    <option value="Super Admin" {{ old('role', $user->role ?? '') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn btn-primary" >Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Ubah User-->
            @foreach($users as $row)
                <div class="modal fade" id="editUser-{{ $row->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserLabel-{{ $row->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editUserLabel-{{ $row->id }}">EDIT USER</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('user.update', $row->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Name:</label>
                                        <input name="name" value="{{ $row->name }}" type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="col-form-label">Email:</label>
                                        <input name="email" value="{{ $row->email }}" type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="col-form-label">Password:</label>
                                        <input name="password" type="password" class="form-control" id="password">
                                        <small class="text-muted">Leave empty if you don't want to change the password</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="col-form-label">Role:</label>
                                        <select name="role" class="form-select" id="role">
                                            <option value="author" {{ $row->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="User" {{ $row->role == 'User' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Modal Hapus User -->
                <div class="modal fade" id="hapusUser-{{ $row->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">HAPUS USER</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus user ini?
                            </div>
                            <form method="POST" action="{{ route('user.destroy', $row->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            @endcan
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Aktivitas Terbaru</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-info shadow text-center">
                                        <i class="ni ni-books text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Buku Baru Diunggah</h6>
                                        <span class="text-xs">
                                            @if($subjectId)
                                                <div>
                                                    <p class="mb-0 text-xs">{{ $subjectId->description }}</p>
                                                </div>
                                                    @else
                                                <div>
                                                    <p class="mb-0 text-xs">Tidak ada deskripsi terbaru.</p>
                                                </div>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('books.index') }}" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                        <i class="ni ni-bold-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center">
                                        <i class="ni ni-credit-card text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Pembelian Buku</h6>
                                        <span class="text-xs">Mahasiswa A membeli buku "Introduction to PHP".</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                        <i class="ni ni-bold-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-danger shadow text-center">
                                        <i class="ni ni-bell-55 text-white opacity-10"></i> <!-- Ikon peringatan -->
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Error Sistem</h6>
                                        <span class="text-xs">Sistem mengalami error pada saat pembacaan buku.</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                        <i class="ni ni-bold-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</main>
@endsection
