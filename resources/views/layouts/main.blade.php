<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Pulsa</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">

    <link rel="stylesheet" href="/assets/vendors/iconly/bold.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/"><img src="/assets/images/logo/logo.png" alt="Logo"></a>
                        </div>
                        <div class="toggler">
                            <a href="/#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="/index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) == 'produk' ? 'active' : '' }} has-sub">
                            <a href="/#" class='sidebar-link'>
                                <i class="bi bi-journal-bookmark-fill"></i>
                                <span>Produk</span>
                            </a>
                            <ul class="submenu {{ Request::segment(1) == 'produk' ? 'active' : '' }}">
                                <li class="submenu-item {{ Request::segment(1) == 'produk' && Request::segment(2) == 'create' ? 'active' : '' }}">
                                    <a href="/produk/create">Input Transaksi</a>
                                </li>
                                <li class="submenu-item {{ Request::segment(1) == 'produk' && Request::segment(2) == null ? 'active' : '' }} ">
                                    <a href="/produk">Data Transaksi</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) == 'bank' ? 'active' : '' }} has-sub">
                            <a href="/#" class='sidebar-link'>
                                <i class="bi bi-credit-card-fill"></i>
                                <span>Bank</span>
                            </a>
                            <ul class="submenu {{ Request::segment(1) == 'bank' ? 'active' : '' }}">
                                <li class="submenu-item {{ Request::segment(1) == 'bank' && Request::segment(2) == 'create' ? 'active' : '' }}">
                                    <a href="/bank/create">Input Bank</a>
                                </li>
                                <li class="submenu-item {{ Request::segment(1) == 'bank' && Request::segment(2) == null ? 'active' : '' }}">
                                    <a href="/bank">Data Bank</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) == 'pelanggan' ? 'active' : '' }} has-sub">
                            <a href="/#" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Pelanggan</span>
                            </a>
                            <ul class="submenu {{ Request::segment(1) == 'pelanggan' ? 'active' : '' }}">
                                <li class="submenu-item {{ Request::segment(1) == 'pelanggan' && Request::segment(2) == 'create' ? 'active' : '' }}">
                                    <a href="/pelanggan/create">Input Pelanggan</a>
                                </li>
                                <li class="submenu-item {{ Request::segment(1) == 'pelanggan' && Request::segment(2) == null ? 'active' : '' }}">
                                    <a href="/pelanggan">Data Pelanggan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) == 'transaksi' ? 'active' : '' }} has-sub">
                            <a href="/#" class='sidebar-link'>
                                <i class="bi bi-journal-bookmark-fill"></i>
                                <span>Transaksi</span>
                            </a>
                            <ul class="submenu {{ Request::segment(1) == 'transaksi' ? 'active' : '' }}">
                                <li class="submenu-item {{ Request::segment(1) == 'transaksi' && Request::segment(2) == 'create' ? 'active' : '' }}">
                                    <a href="/transaksi/create">Input Transaksi</a>
                                </li>
                                <li class="submenu-item {{ Request::segment(1) == 'transaksi' && Request::segment(2) == null ? 'active' : '' }} ">
                                    <a href="/transaksi">Data Transaksi</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) == 'pengeluaran' ? 'active' : '' }} has-sub">
                            <a href="/#" class='sidebar-link'>
                                <i class="bi bi-journal-bookmark-fill"></i>
                                <span>Pengeluaran</span>
                            </a>
                            <ul class="submenu {{ Request::segment(1) == 'pengeluaran' ? 'active' : '' }}">
                                <li class="submenu-item {{ Request::segment(1) == 'pengeluaran' && Request::segment(2) == 'create' ? 'active' : '' }}">
                                    <a href="/pengeluaran/create">Input Pengeluaran</a>
                                </li>
                                <li class="submenu-item {{ Request::segment(1) == 'pengeluaran' && Request::segment(2) == null ? 'active' : '' }} ">
                                    <a href="/pengeluaran">Data Pengeluaran</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="/#" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Laporan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="/laporan/transaksi/per-tanggal">Laporan Transaksi Harian / Mingguan</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/laporan/transaksi/per-bulan">Laporan Transaksi Bulanan</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/laporan/saldo-akhir-bank">Saldo Akhir Bank</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/laporan/pendapatan">Pendapatan</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/laporan/histori-kas">Histori Kas</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="/" class='sidebar-link'>
                                <i class="bi bi-gear-fill"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="/#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            @yield('content')
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Sadewa</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="/http://ahmadsaugi.com">Nanda Teknik</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="/assets/js/pages/dashboard.js"></script>
    <script src="/assets/select2/js/select2.min.js"></script>

    <script src="/assets/js/main.js"></script>

    {{-- <script>
        // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.select-pelanggan').select2();
    });
    </script> --}}
    {{-- <script type="text/javascript">
        $('.select-pelanggan').select2({
          placeholder: 'Select an item',
          ajax: {
            url: '{{url('/transaksi/search')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.name,
                          id: item.id
                      }
                  })
              };
            },
            cache: true
          }
        });
        </script> --}}
    @yield('script')
</body>

</html>