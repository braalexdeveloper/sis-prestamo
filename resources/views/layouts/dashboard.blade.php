<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Préstamos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body,
        html {
            height: 100%;
        }

        #wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        #sidebar-wrapper {
            width: 250px;
            background-color: #0e397aff;
            /* Bootstrap primary */
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem;
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        #sidebar-wrapper .list-group-item {
            background-color: transparent;
            color: white;
            border: none;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Page content */
        #page-content-wrapper {
            flex-grow: 1;
            overflow-y: auto;
        }

        /* Top navbar */
        .navbar {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                Sistema de Préstamos
            </div>
            <div class="list-group list-group-flush flex-grow-1">
                <a href="" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{route('clients.index')}}" class="list-group-item list-group-item-action">Clientes</a>
                <a href="{{route('loans.index')}}" class="list-group-item list-group-item-action">Préstamos</a>
                <a href="" class="list-group-item list-group-item-action">Pagos</a>
                @role('Admin')
                <a href="{{route('users.index')}}" class="list-group-item list-group-item-action">Usuarios</a>
                <a href="{{route('roles.index')}}" class="list-group-item list-group-item-action">Roles</a>
                @endrole
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
                <div class="container-fluid d-flex justify-content-between">
                    <span class="navbar-brand mb-0 h1">Dashboard</span>
                    
                         <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    
                    <div class="dropdown">

                        <button class="btn btn-secondary dropdown-toggle" type="button" id="accountMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Cuenta
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountMenu">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li>
                                csd
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
</body>

</html>