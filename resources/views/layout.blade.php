<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/jpg" href="{{asset('assets/img/icon-flipbook.jpg')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .book-image {
            width: 100%; /* Mengatur lebar gambar agar sesuai dengan kolom */
            height: 100%; /* Mengatur tinggi gambar agar sesuai dengan wrapper */
            object-fit: cover; /* Memastikan gambar mengisi area dengan baik */
        }

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
            height: 200px; /* Atur tinggi gambar */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa; /* Warna latar belakang untuk gambar */
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Pastikan gambar mengisi area dengan baik */
        }

        .card-img-placeholder {
            width: 100%;
            height: 100%;
            background-color: #f8f9fa; /* Warna latar belakang untuk placeholder */
            color: #adb5bd;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-title {
            font-size: 0.9rem;
            line-height: 1.2;
            height: 2.4rem; /* Atur tinggi untuk judul */
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Batasi jumlah baris judul */
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
                height: 150px; /* Atur tinggi gambar untuk layar kecil */
            }
        }
    </style>
  <title>
    FlipBook Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{route("frontend.index")}}" target="_blank" title="Landing Page">
        <img src="{{asset('assets/img/flipbook.jpg')}}" class="navbar-brand-img h-100 radius" alt="main_logo">
        <span class="ms-1 font-weight-bold">FlipBook</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
      <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Dashboard</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('books.index') ? 'active' : '' }}" href="{{ route('books.index') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-book-bookmark text-warning text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Book</span>
                  </a>
              </li>
              @can('admin')
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('sales-information.index') ? 'active' : '' }}" href="{{ route('sales-information.index') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-chart-pie-35 text-danger text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Sales Information</span>
                  </a>
              </li>
              @endcan
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('dashboard.billing') ? 'active' : '' }}" href="{{ route('dashboard.billing') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Transactions</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('kategory.index') ? 'active' : '' }}" href="{{ route('kategory.index') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-world-2 text-info text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Kategori</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('purchases.index') ? 'active' : '' }}" href="{{ route('purchases.index') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-cart text-info text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Pembelian</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('library.index') ? 'active' : '' }}" href="{{ route('library.index') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-book-bookmark text-primary text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Perpustakaan</span>
                  </a>
              </li>
              <li class="nav-item mt-3">
                  <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->is('pages/profile.html') ? 'active' : '' }}" href="{{ asset('pages/profile.html') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Profile</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('auth.index') ? 'active' : '' }}" href="{{ route('auth.index') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Sign In</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->is('pages/sign-up.html') ? 'active' : '' }}" href="{{ asset('pages/sign-up.html') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-collection text-info text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Sign Up</span>
                  </a>
              </li>
          </ul>
      </div>

      <div class="sidenav-footer mx-3">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Need help?</h6>
            <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
          </div>
        </div>
      </div>
      <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
    </div>
  </aside>

  <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
          <div class="container-fluid py-1 px-3">
              <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                  <div class="d-flex align-items-center me-auto">
                      <div class="input-group"> <!-- Ganti w-50 sesuai kebutuhan -->
                          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                          <input type="text" class="form-control pe-12" placeholder="Type here...">
                      </div>
                  </div>
                  <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                  <p class="text-white my-auto fw-bold">Hi, {{ auth()->user()->role }}</p>
                  </div>
                  <ul class="navbar-nav justify-content-end">
                      <li class="nav-item d-flex align-items-center">
                          <a href="{{ route('auth.logout') }}" class="nav-link text-white font-weight-bold px-0">
                              <i class="fa fa-sign-out"></i>
                              <span class="d-sm-inline d-none">Log Out</span>
                          </a>
                      </li>
                      <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                          <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                              <div class="sidenav-toggler-inner">
                                  <i class="sidenav-toggler-line bg-white"></i>
                                  <i class="sidenav-toggler-line bg-white"></i>
                                  <i class="sidenav-toggler-line bg-white"></i>
                              </div>
                          </a>
                      </li>
                      <li class="nav-item px-3 d-flex align-items-center">
                          <a href="javascript:;" class="nav-link text-white p-0">
                              <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                          </a>
                      </li>
                      <li class="nav-item dropdown pe-2 d-flex align-items-center">
                          <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-bell cursor-pointer"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                              <!-- Dropdown items here -->
                          </ul>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
      <!-- End Navbar -->

      @yield('content')


  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft User: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/argon-dashboard.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Hapus kelas 'active' dari semua link
                navLinks.forEach(link => link.classList.remove('active'));

                // Tambahkan kelas 'active' pada link yang diklik
                this.classList.add('active');
            });
        });
    });

</script>
</body>

</html>
