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
    <script src="/js/draga.js"></script>
</head>
<body class="sb-nav-fixed">
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Organizador de fiestas</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>>
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
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                       
                        <div class="sb-sidenav-menu-heading">PANEL DE CONTROL</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-glass-cheers"></i></div>
                            &nbsp; Eventos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/dashboard/eventos">Mis eventos</a>
                                <a class="nav-link" href="/dashboard/nuevo_evento">Crear evento</a>
                            </nav>
                        </div>                        
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Creador por:</div>
                    Colin Heredia Luis Antonio
                </div>
            </nav>
        </div>