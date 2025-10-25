<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Servicios; 

class ServiciosController extends Controller {

   public function index() {
        if (!$this->auth->check()) {
            $this->redirect('/login');
            return;
        }

        $userData = $this->session->get("user");
        $rutUsuario = $userData['rut'];
        
        $serviciosModel = new Servicios();

        
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; 
        $pagina = max(1, $pagina); 
        
        $serviciosPorPagina = 5; 

        $servicios = $serviciosModel->findByRut($rutUsuario, $pagina, $serviciosPorPagina);
        
        $totalServicios = $serviciosModel->countByRut($rutUsuario);
        
        $totalPaginas = ceil($totalServicios / $serviciosPorPagina);
        
        return $this->render('servicios/index', [
            'title' => 'Mis Servicios',
            "servicios" => $servicios,
            "pagina" => $pagina, 
            "totalPaginas" => $totalPaginas,
            "rutUsuario" => $rutUsuario, 
        ]);
    }
   
   public function eliminar($idServicio) {
    
    if (is_array($idServicio) && isset($idServicio['id'])) {
        $idServicio = $idServicio['id'];
    } else if (is_array($idServicio)) {
        $idServicio = reset($idServicio);
    }
    
    $idServicio = (int)filter_var($idServicio, FILTER_SANITIZE_NUMBER_INT);

    if ($idServicio === 0) {
        $this->session->setFlash('error', 'Error interno: ID de servicio no encontrado o no valido.');
        $this->redirect('/miServicios');
        return;
    }

    if (!$this->auth->check()) {
        $this->redirect('/login');
        return;
    }

    $userData = $this->session->get("user");
    $rutUsuario = $userData['rut'];

    $serviciosModel = new Servicios();
    $eliminado = $serviciosModel->borrarServicio($idServicio, $rutUsuario); 

    if ($eliminado) {
        $this->session->flash('success', 'El servicio fue eliminado correctamente.');
    } else {
        $this->session->flash('error', 'Error al intentar eliminar el servicio o acceso denegado.');
    }

    $this->redirect('/miServicios');
 }


public function editar($idServicio) {
    if (is_array($idServicio)) {
        $idServicio = reset($idServicio); 
    }
    $idServicio = (int)filter_var($idServicio, FILTER_SANITIZE_NUMBER_INT);
    
    if (!$this->auth->check() || $idServicio === 0) {
        $this->redirect('/login');
        return;
    }
    
    $rutUsuario = $this->session->get("user")['rut'];
    $serviciosModel = new Servicios();
    
    $servicio = $serviciosModel->findById($idServicio);

    if (!$servicio || $servicio['rutPropietario'] !== $rutUsuario) {
        $this->session->setFlash('error', 'Servicio no encontrado o permiso denegado.');
        $this->redirect('/miServicios');
        return;
    }

    return $this->render('servicios/editar', [
        'title' => 'Editar Servicio',
        'servicio' => $servicio,
    ]);
 }

public function actualizar($idServicio) {
    if (is_array($idServicio)) {
        $idServicio = reset($idServicio);
    }
    $idServicio = (int)filter_var($idServicio, FILTER_SANITIZE_NUMBER_INT);

    if (!$this->auth->check() || $idServicio === 0) {
        $this->redirect('/login');
        return;
    }

    $datos = $_POST; 
    
    $serviciosModel = new Servicios();

    $servicioExistente = $serviciosModel->findById($idServicio);
    if (!$servicioExistente || $servicioExistente['rutPropietario'] !== $this->session->get("user")['rut']) {
        $this->session->setFlash('error', 'Acceso denegado. No eres el propietario de este servicio.');
        $this->redirect('/miServicios');
        return;
    }

    $actualizado = $serviciosModel->actualizarServicio($idServicio, $datos);
    
    if ($actualizado) {
        $this->session->flash('success', 'Servicio actualizado correctamente.');
    } else {
        $this->session->flash('error', 'No se realizaron cambios o hubo un error al actualizar.');
    }
    
    $this->redirect('/miServicios');
 } 
}
