<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetCare Dashboard</title>

    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <!-- Custom CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/user.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    {{-- <link rel="stylesheet" href="{{ asset('css/user.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            background: linear-gradient(180deg, #1e3a8a, #2563eb);
            color: white;
            padding: 20px;
            transition: 0.3s;
            position: fixed;
            height: 100vh;
            overflow: hidden;
        }

        .layout.collapsed .sidebar {
            width: 85px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px;
            margin-bottom: 10px;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.3s;
        }

        .menu li:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .menu li i {
            min-width: 20px;
            text-align: center;
        }

        .layout.collapsed .sidebar span {
            display: none;
        }

        .layout.collapsed .sidebar .menu li {
            justify-content: center;
        }

        /* MAIN */
        .main {
            margin-left: 230px;
            flex: 1;
            transition: 0.3s;
        }

        .layout.collapsed .main {
            margin-left: 85px;
        }

        /* HEADER */
        .topbar {
            height: 75px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            margin-right: 10px
        }

        .burger {
            border: none;
            background: #2563eb;
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
        }

        .content {
            padding: 30px;
        }

        @media(max-width:768px) {

            .sidebar {
                left: -260px;
            }

            .layout.collapsed .sidebar {
                left: 0;
                width: 260px;
            }

            .main,
            .layout.collapsed .main {
                margin-left: 0;
            }

            .layout.collapsed .sidebar span {
                display: inline;
            }
        }
    </style>

</head>

<body>

    <div class="layout" id="layout">

        {{-- SIDEBAR --}}
        @include('admin.layout.sidebar')

        <div class="main">

            {{-- HEADER --}}
            @include('admin.layout.header')

            {{-- PAGE CONTENT --}}
            <div class="content">
                @yield('content')

            </div>

        </div>
    </div>


    <!-- DataTables CSS -->


    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Routing -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <!-- FIX: marker icons -->
    <script>
        delete L.Icon.Default.prototype._getIconUrl;

        L.Icon.Default.mergeOptions({
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png'
        });
    </script>

    @stack('scripts')
</body>

</html>
