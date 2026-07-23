<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PT Pisang Nusantara' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>

        body{
            background:#f4f6f9;
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
        }

        /* ================= SIDEBAR ================= */

        .sidebar{
            width:250px;
            min-height:100vh;
            position:fixed;
            left:0;
            top:0;
            background:#198754;
            color:#fff;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
        }

        .sidebar-brand{
            text-decoration:none;
            color:white;
            padding:20px;
            display:flex;
            align-items:center;
            gap:12px;
            background:#146c43;
        }

        .sidebar-menu{
            list-style:none;
            margin:0;
            padding:10px 0;
        }

        .sidebar-menu li a{

            color:white;
            text-decoration:none;
            display:flex;
            align-items:center;
            gap:12px;
            padding:13px 20px;
            transition:.2s;

        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active{

            background:#146c43;
            font-weight:bold;

        }

        .sidebar-footer{

            padding:15px;

        }

        /* ================= CONTENT ================= */

        .main-wrapper{

            margin-left:250px;
            padding:25px;

        }

        .top-header{

            background:white;
            border-radius:10px;
            padding:15px 20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
            box-shadow:0 2px 8px rgba(0,0,0,.05);

        }

    </style>

</head>

<body>

<!-- ================= SIDEBAR ================= -->

<div class="sidebar">

    <div>

        <a href="{{ route('dashboard') }}" class="sidebar-brand">

            <span style="font-size:32px;">🍌</span>

            <div>

                <h5 class="mb-0 fw-bold text-white">

                    PT Pisang Nusantara

                </h5>

                <small style="color:#d8f3dc;">

                    Sistem Informasi Gudang

                </small>

            </div>

        </a>

        <ul class="sidebar-menu">

            <li>

                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <i class="bi bi-speedometer2"></i>

                    Dashboard

                </a>

            </li>

            <li>

                <a href="{{ route('kategori.index') }}"
                   class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">

                    <i class="bi bi-tags-fill"></i>

                    Kategori Pisang

                </a>

            </li>

            <li>

                <a href="{{ route('barang.index') }}"
                   class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">

                    <i class="bi bi-basket-fill"></i>

                    Data Pisang

                </a>

            </li>

            <li>

                <a href="{{ route('supplier.index') }}"
                   class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}">

                    <i class="bi bi-people-fill"></i>

                    Supplier

                </a>

            </li>

            <li>

                <a href="{{ route('barang-masuk.index') }}"
                   class="{{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}">

                    <i class="bi bi-box-arrow-in-down"></i>

                    Pisang Masuk

                </a>

            </li>

            <li>

                <a href="{{ route('barang-keluar.index') }}"
                   class="{{ request()->routeIs('barang-keluar.*') ? 'active' : '' }}">

                    <i class="bi bi-truck"></i>

                    Distribusi Pisang

                </a>

            </li>

            <li>

                <a href="{{ route('laporan.barang.pdf') }}">

                    <i class="bi bi-file-earmark-pdf-fill"></i>

                    Laporan PDF

                </a>

            </li>

        </ul>

    </div>

    <div class="sidebar-footer">

        @auth

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="btn btn-warning w-100">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </button>

            </form>

        @endauth

    </div>

</div>

<!-- ================= CONTENT ================= -->

<div class="main-wrapper">

    <div class="top-header">

        <div>

            <h4 class="fw-bold mb-0">

                🍌 Sistem Informasi Gudang Distribusi Pisang

            </h4>

            <small class="text-muted">

                PT Pisang Nusantara

            </small>

        </div>

        <div class="text-end">

            @auth

                <strong>

                    {{ Auth::user()->name }}

                </strong>

                <br>

                <span class="badge bg-success">

                    {{ ucfirst(Auth::user()->role) }}

                </span>

            @endauth

        </div>

    </div>

    @yield('content')

    <hr>

    <div class="text-center text-muted mt-4">

        <small>

            © {{ date('Y') }}

            PT Pisang Nusantara |

            Sistem Informasi Gudang Distribusi Pisang |

            Universitas Malikussaleh

        </small>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')

</body>
</html>