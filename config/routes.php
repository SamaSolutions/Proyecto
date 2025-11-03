<?php
/**
 * Definición de rutas de la aplicación
 * Formato: $router->addRoute(método, ruta, controlador@método, [middleware])
 */

use App\Middleware\AuthMiddleware;

// Rutas públicas
$router->addRoute("POST","/apicategorias", "ApiController@index");
$router->addRoute("GET","/apicategorias", "ApiController@index");
$router->addRoute("GET", "/", "HomeController@index");
$router->addRoute("GET", "/login", "AuthController@showLogin");
$router->addRoute("POST", "/login", "AuthController@login");
$router->addRoute("GET", "/logout", "AuthController@logout");
$router->addRoute("GET", "/register", "AuthController@showRegister");
$router->addRoute("POST", "/register", "AuthController@register");
$router->addRoute("GET", "/contacto", "ContactoController@index");

$router->addRoute("GET", "/minuevo", "MinuevoController@index");
$router->addRoute("GET", "/minv/id/:id", "MinuevoController@index");
$router->addRoute("GET", "/clientes", "ClientesController@index");
$router->addRoute("GET", "/explorar", "ExplorarController@index");
$router->addRoute("GET", "/servicios", "ExplorarController@mostrarCategoria");

// Rutas protegidas por middleware de autenticación
$router->addRoute("GET", "/dashboard", "DashboardController@index", [AuthMiddleware::class]);
$router->addRoute("GET", "/dashboard/:id", "DashboardController@show", [AuthMiddleware::class]);
$router->addRoute("GET", "/admin", "DashboardController@adminUsuarios", [AuthMiddleware::class]);
$router->addRoute("POST", "/admin/modificar/:rut", "DashboardController@modificarUsuario", [AuthMiddleware::class]);
$router->addRoute("POST", "/admin/eliminar/:rut", "DashboardController@eliminarUsuario", [AuthMiddleware::class]);
$router->addRoute("GET", "/perfil", "DashboardController@mostrarPerfil", [AuthMiddleware::class]);
$router->addRoute("POST", "/perfil", "DashboardController@cambiarPerfil", [AuthMiddleware::class]);
$router->addRoute("GET", "/publicarServicios", "PublicarServiciosController@index", [AuthMiddleware::class]);
$router->addRoute("POST", "/publicarServicios", "PublicarServiciosController@publicar", [AuthMiddleware::class]);
$router->addRoute("GET", "/miServicios", "ServiciosController@index", [AuthMiddleware::class]);
$router->addRoute("POST", "/miServicios/eliminar/:id", "ServiciosController@eliminar", [AuthMiddleware::class]);
$router->addRoute("GET", "/miServicios/editar/:id", "ServiciosController@editar", [AuthMiddleware::class]); 
$router->addRoute("POST", "/miServicios/actualizar/:id", "ServiciosController@actualizar", [AuthMiddleware::class]);
$router->addRoute("POST", "/mensajes/iniciar", "MensajesController@iniciar", [AuthMiddleware::class]);
$router->addRoute("POST", "/mensajes/enviar", "MensajesController@enviar", [AuthMiddleware::class]);
$router->addRoute("GET", "/mensajes/check", "MensajesController@checkNuevos", [AuthMiddleware::class]);
$router->addRoute("GET", "/mensajes/chat/:id", "MensajesController@mostrarChat", [AuthMiddleware::class]);
$router->addRoute("GET", "/mensajes/inbox", "MensajesController@mostrarBandejaEntrada", [AuthMiddleware::class]);
$router->addRoute("GET", "/api/notificaciones/recientes", "NotificacionController@getRecientes", [AuthMiddleware::class]);
$router->addRoute("POST", "/api/notificaciones/marcar-leida", "NotificacionController@marcarLeida", [AuthMiddleware::class]);
$router->addRoute("POST", "/mensajes/cerrarChat", "MensajesController@cerrarChat");
$router->addRoute("GET", "/mensajes/delete-simple/:id", "MensajesController@deleteSimple", [AuthMiddleware::class]);
