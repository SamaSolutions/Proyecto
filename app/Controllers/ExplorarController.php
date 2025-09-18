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
  $servicios = $this->modelo->findByCategoria($_GET['categoria']);
  return $this->render("explorar/servicios", ["servicios" => $servicios]);
 }
}

