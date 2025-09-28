<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Models\Servicios;

class ExplorarController extends Controller{

private $modelo;


public function __construct(){
$this->modelo = new Servicios();

parent::__construct();

}


 public function index(){
  $datos = $this->modelo->CategoriasTodos();
  return $this->render( "explorar/explorar",["explorar" =>  $datos]);
 }

 public function mostrarCategoria(){
  $categoria=$_GET['categoria'] ?? '';
  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $pagina = max(1, $pagina);
  $serviciosPorPagina = 5;
  $servicios = $this->modelo->findByCategoria($categoria, $pagina, $serviciosPorPagina);
  $totalServicios = $this->modelo->countByCategoria($categoria);
  $totalPaginas = ceil($totalServicios / $serviciosPorPagina);
  return $this->render("explorar/servicios", [
   "servicios" => $servicios,
   "pagina" => $pagina,
   "totalPaginas" => $totalPaginas,
   "categoria" => $categoria
   
  ]);
 }
}

