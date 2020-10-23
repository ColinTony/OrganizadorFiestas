<!DOCTYPE html>
<html lang="es">
<?php
        $uri = service('uri'); // libreria uri
        // checar los segmentos de la uri
        // ($uri->getSegment(1) == 'segmento' ? 'active' : null)
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="Reservador de fiestar y organizador" content="" />
    <meta name="author" content="Colin Heredia Luis Antonio" />
    <title>Fiestas menu</title>
    <link href="/css/styles.css" rel="stylesheet" />
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="/js/konva.min.js"></script>
    <script src="/js/all.min.js" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/miJavascript.js"></script>
    <script src="/js/drag.js"></script>
</head>

<body class="sb-nav-fixed">
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Organizador de fiestas</a>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/dashboard/perfil"><i class="fas fa-cogs"></i> &nbsp; Mi perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/dashboard/cerrar"><i class="fas fa-sign-out-alt"></i>&nbsp; Cerrar Sesion</a>
                </div>
            </li>
        </ul>
    </nav>
        