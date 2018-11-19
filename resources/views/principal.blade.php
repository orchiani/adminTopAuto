<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Dafaack Labs">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Admin</title>
    <!-- Icons -->
    <!-- Main styles for this application -->
    <link href="css/plantilla.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700' rel='stylesheet' type='text/css'>
</head>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<div id="app">
    <header class="test-navbar">
        <div class="admin">Panel de administración 
        </div>
        <div style="padding-left: 45%; color: #fbc02d; ">
        <span class="texto-sesion">Usuario:  </span> <span style="font-weight: bold;" class="texto-sesion"> {{Auth::user()->usuario}} </span>
        <a style="padding-left: 5%;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Cerrar sesion </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"> < {{csrf_field()}} </form>
    
        </header> 


    <div class="app-body">
    @if (Auth::check()) 
          @if(Auth::user()->id_rol == 1)  <!-- Admin -->
            @include('plantilla.menu')
             @elseif(Auth::user()->id_rol == 2) <!-- Full -->
            @include('plantilla.menuparafull') 
            @else  
            @endif  
            
       @endif
        <!-- Contenido Principal -->
       @yield('contenido')
        <!-- /Fin del contenido principal -->
    </div>
    </div>


    <footer>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="js/app.js"> </script>
    <script src="js/plantilla.js"></script>
    
    
</body>

</html>