<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-md fixed-to navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Multi Tenancy (Company)</a>
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('company.dashboard',['subdomain'=>session()->get('domain')])}}">Dashboard <span class="sr-only"></span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Employees</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                      <a class="dropdown-item" href="{{route('company-employees',['subdomain'=>session()->get('domain')])}}">All Employees</a>
                      <a class="dropdown-item" href="{{route('company.create-employee',['subdomain'=>session()->get('domain')])}}">Create Employee</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/logout">Logout<span class="sr-only"></span></a>
                </li>
                
            </ul>
            
            </div>
        </nav>
        <hr>
        <main role="main" class="container" id="app">
            <div class="container-fluid pt-100">
                <div class="row">
                @yield('content')
                </div>
            </div>
        </main>
    </body>
</html>
