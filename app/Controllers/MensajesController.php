<?php

namespace App\Controllers;

use App\Core\Controller; 
use App\Models\Mensaje;
use App\Models\Conversacion;
use App\Models\Notificacion;
use App\Models\Servicios;


class MensajesController extends Controller {

    private $modeloMensaje;
    private $modeloConversacion;
    private $modeloNotificacion; 
    private $modeloServicio; 
   
    public function __construct() {
        $this->modeloMensaje = new Mensaje();
        $this->modeloConversacion = new Conversacion();
        $this->modeloNotificacion = new Notificacion();
        $this->modeloServicio = new Servicios();
        parent::__construct();
    }
    
    private function getRutUsuario() {
        $usuario = $this->session->get('user');
        return $usuario['rut'] ?? null; 
    }

    private function sendJson($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

 public function iniciar() {

    // 1. OBTENCIÓN DE DATOS BÁSICOS
    $rutUsuario = $this->getRutUsuario();
    $usuario = $this->session->get("user");
    $nombreUsuario = $usuario['nombre'];

    $rutDestinatario = $_POST['rutDestinatario'] ?? null;
    $idServicio = $_POST['idServicio'] ?? null;

    // Los datos del servicio vienen del formulario POST al iniciar el chat
    $servitipo=[
        'nombre' => $_POST['nombre'] ?? '', 
        'precio' => $_POST['precio_estimado'] ?? 0,
        'categoria' => $_POST['categoria'] ?? 'N/A',
        'descripcion' => $_POST['descripcion'] ?? 'Sin descripción.',
        'dueño' => $_POST['razon_social'] ?? 'Vendedor',
        'duracion' => $_POST['duracion'] 
    ];

    // Lógica para manejar el ID del servicio
    if (!empty($idServicio)) {
        $idServicio = (int)$idServicio;
    }
    if ($idServicio === 0 || empty($idServicio)) {
        $idServicio = null;
    }

    // 2. VALIDACIÓN BÁSICA
    if (!$rutUsuario || !$rutDestinatario || $rutUsuario === $rutDestinatario) {
        $this->session->flash('Error', 'Datos de chat incompletos o inválidos.');
        $this->redirect("/explorar");
        return; 
    }

     
    $resultado = $this->modeloConversacion->findOrCreate($rutUsuario, $rutDestinatario, $idServicio);
    $conversacionId = $resultado['id'];
    $action = $resultado['action'] ?? null; 

    if ($action === 'creada') {
        $urlChat = "/mensajes/chat/{$conversacionId}";
        $contenido = "¡Nuevo chat iniciado por {$nombreUsuario}!";
        $this->modeloNotificacion->crearNotificacion(
            $rutDestinatario,
            $contenido,
            $urlChat
        );
    }

    if ($conversacionId) {
        
        $historialData = $this->modeloMensaje->getHistorial($conversacionId); 
        $historial = $historialData['mensajes'] ?? [];
        $ultimoId = $historialData['ultimoId'] ?? 0;

        $data = [
            'conversacion_id'   => $conversacionId,
            'miRut'             => $rutUsuario,
            'rutDestinatario'   => $rutDestinatario,
            'ultimoId'          => $ultimoId,
            'servicio'          => $servitipo,    
            'historial'         => $historial
        ];
        
        $this->render("/mensajes/chat", $data);

    } else {
        $this->session->flash('Error', 'Error al crear la conversación en la base de datos.');
        $this->redirect("/explorar");
    }
} 
     
    public function enviar() {
    $rutRemitente = $this->getRutUsuario();

    if (!$rutRemitente) {
        $this->sendJson(['status' => 'error', 'message' => 'Acceso denegado. Usuario no autenticado.']);
        return;
    }

    $idConversacion = $_POST['conversacion_id'] ?? null;
    $contenido = $_POST['contenido'] ?? '';

    if (!$idConversacion || empty($contenido)) {
        $this->sendJson(['status' => 'error', 'message' => 'Datos incompletos.']);
        return;
    }

    $datosMensaje = [
        'idConversacion' => $idConversacion,
        'rutRemitente' => $rutRemitente,
        'contenido' => $contenido,
        'leido' => 0 
    ];

    $idNuevoMensaje = $this->modeloMensaje->create($datosMensaje);

    if ($idNuevoMensaje) {
        $rutDestinatario = $this->modeloConversacion->getOtroParticipante($idConversacion, $rutRemitente);

        if ($rutDestinatario) {
            $urlChat = "/mensajes/chat/{$idConversacion}";
            
            $mensajeCorto = substr(strip_tags($contenido), 0, 40); 
            $contenidoNotificacion = "Nuevo mensaje: \"{$mensajeCorto}...\"";
            
            $this->modeloNotificacion->crearNotificacion(
                $rutDestinatario,
                $contenidoNotificacion,
                $urlChat
            );
        }
    }
    
    $this->sendJson([
        'status' => 'success', 
        'message' => 'Mensaje guardado y notificado.', 
        'new_id' => $idNuevoMensaje 
    ]);
}   
 
    public function checkNuevos() {
        
        $rutUsuario = $this->getRutUsuario();
        $conversacionId = $_GET['chat_id'] ?? 0; 
        $ultimoIdRecibido = $_GET['last_id'] ?? 0;

        if (!$rutUsuario || !$conversacionId) {
            $this->sendJson(['status' => 'error', 'message' => 'Faltan parámetros de sesión o chat.']);
            return;
        }
        
        if (!$this->modeloConversacion->esParticipante($conversacionId, $rutUsuario)) {
            $this->sendJson(['status' => 'error', 'message' => 'Prohibido. No eres parte de esta conversación.']);
            return;
        }
        
        $nuevosMensajes = $this->modeloMensaje->findNuevos($conversacionId, $ultimoIdRecibido);

        $this->sendJson([
            'status' => 'success',
            'data' => $nuevosMensajes
        ]);
    }

    public function mostrarChat($idConversacion) {
       if(is_array($idConversacion)) {
            $idConversacion = $idConversacion['id'] ?? '';
        }
        
        $rutUsuario = $this->getRutUsuario();
        
        if (empty($idConversacion)) {
            die('Error: ID de Conversación no proporcionado o inválido.');
        }

        $idConversacion = (int) $idConversacion;
         
        if (!$rutUsuario) {
            die('Error: No autenticado.');
        }

        if (!$this->modeloConversacion->esParticipante($idConversacion, $rutUsuario)) {
          die('Error: Prohibido. No tienes permiso para ver este chat.');
        }
        $servicio = $this->modeloServicio->findByIdEspecifica($this->modeloServicio->findByIdConversacion($idConversacion)); 
        $servicio["dueño"]=$this->modeloConversacion->getNombreDueño($rutUsuario, $idConversacion);
        $historial = $this->modeloMensaje->getHistorial($idConversacion);
        $ultimoId = empty($historial) ? 0 : end($historial)['id'];

        $this->render("mensajes/chat", [
            "titulo" => "Chat", 
            "historial" => $historial,
            "conversacion_id" => $idConversacion,
            "ultimoId" => $ultimoId,
            "miRut" => $rutUsuario,
            "servicio" => $servicio
        ]);
    }
    

public function mostrarBandejaEntrada() {
    $rutUsuario = $this->getRutUsuario();

    if (!$rutUsuario) {
        $this->redirect('/login');
        return;
    }

    $conversaciones = $this->modeloConversacion->getConversacionesPorRut($rutUsuario);

    $this->render("mensajes/inbox", [
        "titulo" => "Bandeja de Entrada",
        "conversaciones" => $conversaciones,
        "miRut" => $rutUsuario
    ]);
 }      
}

