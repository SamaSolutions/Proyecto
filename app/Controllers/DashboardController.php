<?php
namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller {
    public function index() {
        $datos=$this->session->get("user");
        $userModel = new \App\Models\User();
        $rutAdmin = $userModel->findAdmin($datos["rut"]); 
        return $this->render('dashboard/index', [
            'title' => 'Dashboard',
            'user' => $this->auth->user(),
            'rutAdmin' => $rutAdmin,
            'nombre' => $datos['nombre']
        ]);
    }
    
    public function show($params = []) {
        if (!$this->auth->check()) {
            $this->redirect('/login');
        }

        return $this->render('dashboard/show', [
            'title' => 'Usuario',
            'user' => $this->auth->user(),
            'userId' => $params['id'] ?? null
        ]);
    }
   
    public function mostrarPerfil() {
    $datos=$this->session->get("user");
    $rut=$datos["rut"]; 
    
    $perfilModel = new \App\Models\User();
    
    $datosPerfil = $perfilModel->getDatosPerfil($rut);
    $valoracion = $perfilModel->calcularValoracionPromedio($rut);
    
    $datos = $datosPerfil ?? [
        'descripcion' => '',
        'especialidad' => '',
        'experiencia' => '',
        'disponibilidad' => ''
    ];

    return $this->render('dashboard/perfil', [
        "datos" => $datos,
        "valoracionPromedio" => number_format($valoracion, 2, ',', '.') 
    ]);
    }
    
    public function cambiarPerfil($rut){
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: /perfil");
        exit;
    }

    $data = [
        'descripcion'    => htmlspecialchars($_POST['descripcion'] ?? ''),
        'especialidad'   => htmlspecialchars($_POST['especialidad'] ?? ''),
        'experiencia'    => htmlspecialchars($_POST['experiencia'] ?? ''),
        'disponibilidad' => htmlspecialchars($_POST['disponibilidad'] ?? ''),
    ];

    $datos = $this->session->get("user");
    $rut = $datos["rut"]; 

    if (empty($rut)) {
        header("Location: /login");
        exit;
    }

    $userModel = new \App\Models\User();

    $exito = $userModel->actualizarDatosPerfil($rut, $data);

    if ($exito) {
        $this->session-set("mensaje_perfil", "Perfil actualizado exitosamente.");
    } else {
        $this->session->set("error_perfil", "Hubo un error al guardar los cambios.");
    }

    header("Location: /perfil");
    exit;

    }    
}
