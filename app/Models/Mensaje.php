<?php
namespace App\Models;

use App\Core\Model;

class Mensaje extends Model {
    protected $table = 'Mensajes';
    protected $primaryKey = 'id';

    /**
     * Busca mensajes nuevos para una conversación a partir de un ID.
     * @param int $idConversacion
     * @param int $ultimoId
     * @return array
     */
    public function findNuevos($idConversacion, $ultimoId) {
        // La consulta se une a Personas para obtener nombre/apellido del remitente
        $query = sprintf(
            "SELECT 
                M.id, 
                M.rutRemitente, 
                M.contenido, 
                M.created_at,
                P.nombre as nombreRemitente,
                P.apellido as apellidoRemitente
            FROM %s M 
            JOIN Personas P ON M.rutRemitente = P.rut
            WHERE 
                M.idConversacion = %d 
                AND M.id > %d
                ORDER BY M.id ASC",
            $this->table,
            intval($idConversacion),
            intval($ultimoId)
        );

        return $this->executeRawQuery($query);
    }

    public function getHistorial($idConversacion) {
        $sql = sprintf(
            "SELECT 
                M.id, 
                M.rutRemitente, 
                M.contenido, 
                M.created_at,
                P.nombre as nombreRemitente
            FROM %s M 
            JOIN Personas P ON M.rutRemitente = P.rut
            WHERE M.idConversacion = %d 
            ORDER BY M.id ASC 
            LIMIT 50", // Límite de 50 mensajes para el historial inicial
            $this->table,
            intval($idConversacion)
        );

        return $this->executeRawQuery($sql);
    }

}


