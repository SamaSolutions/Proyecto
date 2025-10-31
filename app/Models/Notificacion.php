<?php
namespace App\Models;

use App\Core\Model;

class Notificacion extends Model {
    protected $table = 'Notificaciones';

    public function getRecientes($rutUsuario, $limite = 5) {
        $query =$this->db->query("
            SELECT id, contenido, url, leida, created_at
            FROM " . $this->table . "
            WHERE rutUsuario = ?
            ORDER BY created_at DESC
            LIMIT ?
        ", [
           $rutUsuario,
           $limite
           ]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function countNoLeidas($rutUsuario) {
        $query = $this->db->query("
            SELECT COUNT(id) FROM " . $this->table . "
            WHERE rutUsuario = ? AND leida = 0
        ", [
           $rutUsuario
           ]);
        return (int)$query->fetchColumn(); 
    }

    public function marcarComoLeida($notificacionId) {
    $sql = "UPDATE " . $this->table . " SET leida = 1 WHERE id = ?";
    
    $this->db->query($sql, [$notificacionId]);
}
 
public function crearNotificacion(string $rutUsuario, string $contenido, string $url) {
    $this->db->query("
        INSERT INTO " . $this->table . " (rutUsuario, contenido, url, leida)
        VALUES (?, ?, ?, 0)", [
        $rutUsuario,
        $contenido,
        $url
        ]);
}
      
}
