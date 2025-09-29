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
    
    public function adminUsuarios() {
       
       $datos=$this->session->get("user");
        $userModel = new \App\Models\User();
        $rutAdmin = $userModel->findAdmin($datos["rut"]);

        
       if($rutAdmin){
        $usuarios = $userModel->findAllUsersWithDetails();
        $mensaje = $_SESSION['admin_mensaje'] ?? null;
        unset($_SESSION['admin_mensaje']);
        
        return $this->render('dashboard/admin', [
            'usuarios' => $usuarios,
            'mensaje' => $mensaje 
        ]);
       }else{
        $this->session->flash("Error", "Debes ser administrador para ingresar aqui.");
        header("location: /home");
        exit;
       }
       
    }

    public function modificarUsuario($params)
    {
        $rut = $params['rut'] ?? null;
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($rut)) {
            header("Location: /admin");
            exit;
        }

         $userModel = new \App\Models\User();  
      
        $personaData = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'apellido' => trim($_POST['apellido'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'nro' => trim($_POST['nro'] ?? ''), 
            'calle' => trim($_POST['calle'] ?? ''), 
            'localidad' => trim($_POST['localidad'] ?? '') 
        ];
        
        $usuarioData = [
            'descripcion_del_perfil' => trim($_POST['descripcion'] ?? ''),
            'especialidad' => trim($_POST['especialidad'] ?? ''),
            'experiencia' => trim($_POST['experiencia'] ?? ''),
            'disponibilidad' => trim($_POST['disponibilidad'] ?? '')
        ];

        if ($userModel->updateUser($rut, $personaData, $usuarioData)) {
            $_SESSION['admin_mensaje'] = ['tipo' => 'exito', 'texto' => "Usuario $rut modificado exitosamente."];
        } else {
            $_SESSION['admin_mensaje'] = ['tipo' => 'error', 'texto' => "Error al modificar el usuario $rut."];
        }

        header("Location: /admin");
        exit;
    }
    
    public function eliminarUsuario($params){
        
        $rut = $params['rut'] ?? null;
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($rut)) {
            $_SESSION['admin_mensaje'] = ['tipo' => 'error', 'texto' => "Acceso inválido o RUT no especificado."];
            header("Location: /admin");
            exit;
        }
        
         $userModel = new \App\Models\User();
       
        if ($userModel->deleteUser($rut)) {
            $_SESSION['admin_mensaje'] = ['tipo' => 'exito', 'texto' => "Usuario $rut eliminado correctamente."];
        } else {
            $_SESSION['admin_mensaje'] = ['tipo' => 'error', 'texto' => "Error al intentar eliminar el usuario $rut."];
        }

        header("Location: /admin");
        exit;
    }
}    

