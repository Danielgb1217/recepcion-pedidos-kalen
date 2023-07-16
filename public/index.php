<?php 

require_once __DIR__ . '/../includes/appe.php';

use Controllers\APIController;
use Controllers\LoginController;
use Controllers\ProductosController;
use Controllers\VentaController;
use MVC\Router;

$router = new Router();

$router->get('/', [LoginController::class, 'login']);  //Carag la ruta y la funcion asociada a dicha ruta
$router->post('/', [LoginController::class, 'login']); //Enviar los datos del formulario

$router->get('/logout', [LoginController::class, 'logout']); //Enviar los datos del formulario
$router->post('/logout', [LoginController::class, 'logout']); //Enviar los datos del formulario

//Olvide el Password
$router->get('/missPassword', [LoginController::class, 'miss']);  
$router->post('/missPassword', [LoginController::class, 'miss']); 
$router->get('/missAcount', [LoginController::class, 'missAcount']);  
$router->post('/missAcount', [LoginController::class, 'missAcount']); 



$router->get('/nuestrosProductos', [LoginController::class, 'productos']); //Pagina principal despues del login
$router->post('/nuestrosProductos', [LoginController::class, 'productos']); //Pagina principal despues del login

//$router->get('/detalleProducto', [LoginController::class, 'detalleProducto']);//detalle del producto

$router->get('/admin', [ProductosController::class, 'admin']);//Administracion de Productos
$router->post('/admin', [ProductosController::class, 'admin']);//

//Crear cuenta
$router->get('/createAccount',[LoginController::class, 'create']);
$router->post('/createAccount',[LoginController::class, 'create']);

//confirmar cuenta
$router->get('/confirmarCuenta', [LoginController::class, 'confirmar']);
$router->post('/confirmarCuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//-------------------------------------------------------------Sesion Iniciada---------------------------------

$router->get('/nuestrosProductos', [ProductosController::class, 'index']);


$router->get('/subirProducto', [ProductosController::class, 'upload']);
$router->post('/subirProducto', [ProductosController::class, 'upload']);

//--------------------------------------------------modificar Producto admin----------------------------
$router->get('/uploadProducto', [ProductosController::class, 'uploadProducto']);
$router->post('/uploadProducto', [ProductosController::class, 'uploadProducto']);


//------------------------------------------------------------API---------------------------------------------
$router->get('/api/productos', [APIController::class, 'index']);  //edite por /api/productos
$router->post('/api/pedidos', [APIController::class, 'guardar']);


$router->get('/carritoCompras', [ProductosController::class, 'comprar']);
$router->post('/carritoCompras', [ProductosController::class, 'comprar']);

//----------------------------------------------------------VENTA--------------------------------------------

$router->get('/resumenVenta', [VentaController::class, 'venta']);
$router->post('/resumenVenta', [VentaController::class, 'venta']);

$router->get('/buscarVenta', [VentaController::class, 'buscar']);
$router->post('/buscarVenta', [VentaController::class, 'buscar']);


//-----------------------------------------------------------------------------------------------------------
$router->get('/configurarUsuarios', [LoginController::class, 'configurarUser']);
$router->post('/configurarUsuarios', [LoginController::class, 'configurarUser']);

$router->get('/updateUsuario', [LoginController::class, 'updateUsuario']);
$router->post('/updateUsuario', [LoginController::class, 'updateUsuario']);

$router->get('/crearUsuario', [LoginController::class, 'crearUsuario']);
$router->post('/crearUsuario', [LoginController::class, 'crearUsuario']);


//----------------prueba pdf
$router->get('/reporteVentas', [VentaController::class, 'reporte']);
$router->post('/reporteVentas', [VentaController::class, 'reporte']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();