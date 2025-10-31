<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Notificacion;

class NotificacionController extends Controller {
    protected $modeloNotificacion;

    public function __construct() {
        $this->modeloNotificacion = new Notificacion();
        parent::__construct();
    }
    
    private function sendJson($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    
    public function getRecientes() {
        $resultado= $this->session->get('user');
        $rutUsuario =$resultado['rut'];

        if (!$rutUsuario) {
            $this->sendJson(['status' => 'error', 'message' => 'Acceso denegado.'], 403);
            return;
        }

        $notificaciones = $this->modeloNotificacion->getRecientes($rutUsuario, 5);
        $conteo = $this->modeloNotificacion->countNoLeidas($rutUsuario);

        $this->sendJson([
            'status' => 'success',
            'conteo_no_leidas' => $conteo,
            'notificaciones' => $notificaciones
        ]);
    }
    
    public function marcarLeida() {
        $data = json_decode(file_get_contents('php://input'), true); 
        $notificacionId = $data['id'] ?? null;

        if (!$notificacionId) {
            $this->sendJson(['status' => 'error', 'message' => 'ID no proporcionado.'], 400);
            return;
        }

        $this->modeloNotificacion->marcarComoLeida($notificacionId);
        $this->sendJson(['status' => 'success']);
    }
}
