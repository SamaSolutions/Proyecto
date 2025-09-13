<?php 

namespace App\Controllers;
use App\Core\Controller;
use App\Models\User;

class UsuariosController extends Controller{

private $modelo;


public function __construct(){
$this->modelo = new User();

parent::__construct();

}


public function index(){

$datos = $this->modelo->all();
return $this->render( "usuarios/index", ["titulo" => "Usuarios Registrados" , "datosTabla" => $datos]  );

}


public function paginado(){

$datos = $this->modelo->sqlPaginado();
$datos["baseUrl"] = "/usuarios/pagina";

return $this->render( "usuarios/paginar", $datos );

}


}
