<?php 

namespace App\Controllers;
use App\Core\Controller;
use App\Models\Clientes;

class ClientesController extends Controller{

private $modelo;


public function __construct(){
$this->modelo = new Clientes();

parent::__construct();

}


public function index(){
$datos = $this->modelo->clientesTodos();
return $this->render( "clientes/index",["clientes" =>  $datos]);

}


}
