<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['filter' => 'noauth']);
$routes->match(['get','post'],'/registro', 'Home::registro',['filter' => 'noauth']);
$routes->match(['get','post'],'/login', 'Home::login',['filter' => 'noauth']);

// DashBoard
$routes->get('/dashboard/cerrar', 'Home::cerrar');
$routes->get('/dashboard/eliminar', 'Dashboard::eliminarCuenta');
$routes->get('dashboard','Dashboard::index',['filter' => 'auth']);
$routes->match(['get','post'],'/dashboard/perfil', 'Dashboard::perfil',['filter' => 'auth']);
$routes->get('/dashboard/eventos','Dashboard::eventos',['filter' => 'auth']);
$routes->match(['get','post'],'/dashboard/newevento', 'Dashboard::crearEvento',['filter' => 'auth']);
$routes->add('/dashboard/eventos/ver/(:num)','Dashboard::verEvento/$1',['filter' => 'auth']);
$routes->add('/dashboard/eventos/modificar/(:num)','Dashboard::modificarEvento/$1',['filter' => 'auth']);
$routes->add('/dashboard/eventos/invitados/(:num)','Dashboard::invitados/$1',['filter' => 'auth']);
$routes->post('/dashboard/modificar_evento','Dashboard::modificarEv',['filter' => 'auth']);
$routes->post('/dashboard/nuevo_invitado','Dashboard::nuevoInvitado',['filter' => 'auth']);
$routes->post('/dashboard/pdf','Dashboard::generate_pdf',['filter' => 'auth']);
$routes->add('/dashboard/invitados/elim/(:num)/(:num)','Dashboard::eliminarInv/$1/$2',['filter' => 'auth']);
$routes->add('/dashboard/invitados/modificar/(:num)/(:num)/(:num)','Dashboard::modificarInv/$1/$2/$3',['filter' => 'auth']);
$routes->add('/dashboard/eventos/elim/(:num)','Dashboard::eliminarEvento/$1',['filter' => 'auth']);
$routes->add('/dashboard/eventos/organizar/(:num)','Dashboard::organizar/$1',['filter' => 'auth']);
$routes->add('/dashboard/ajax/mesa/(:num)/(:num)','Dashboard::peticionAjax/$1/$2',['filter' => 'auth']);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
