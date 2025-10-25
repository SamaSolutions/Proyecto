<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\PublicaServicios;

class PublicarServiciosController extends Controller{
    private $modelo;

    public function __construct() {
        $this->modelo = new PublicaServicios();
        parent::__construct();
    }
    
    public function index() {
  
    return $this->render('publicaServicios/index', [
     'title' => 'Publica Tu Servicio:'
    ]);   
    }
    
    public function publicar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $user=$this->session->get("user");
            $rutVendedor = $user["rut"]; 
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $duracion = $_POST['duracion'];
            $categoria = $_POST['categoria'];
        
            $this->modelo->crearServicio($rutVendedor, $nombre, $descripcion, $precio, $duracion, $categoria);
            $this->session->flash("success", "¡Servicio publicado correctamente!");
            $this->redirect("publicaServicios");
        }
    }
}
