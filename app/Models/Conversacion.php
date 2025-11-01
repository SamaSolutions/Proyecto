<?php
namespace App\Models;

// Asume que hereda la conexión a la base de datos
use App\Core\Model; 
use \PDO;

class Conversacion extends Model {
    protected $table = 'Conversaciones';
    protected $primaryKey = 'id';

    public function findOrCreate($rut1, $rut2, $idServicio = null) {
    // Normalizar para que la búsqueda sea siempre en el mismo orden
    $rutComprador = min($rut1, $rut2);
    $rutVendedor = max($rut1, $rut2);

    // 1. Buscar conversación existente
    $query = $this->db->query(
        "SELECT id FROM Conversaciones 
        WHERE rutComprador = ? AND rutVendedor = ? AND idServicio = ?
        LIMIT 1",[
        $rutComprador, $rutVendedor, $idServicio 
        ]);

    $resultado = $query->fetch(\PDO::FETCH_ASSOC);

    if ($resultado !== false) {
        // La conversación existe.
        return ['id' => $resultado['id'], 'action' => 'existente'];
    } else {
        // La conversación no existe, crearla.
        $datosNueva = [
            'rutComprador' => $rutComprador,
            'rutVendedor' => $rutVendedor,
            'idServicio' => $idServicio
        ];

        $idNueva = $this->create($datosNueva);

        return ['id' => $idNueva, 'action' => 'creada'];
    }
}
 
    public function esParticipante($idConversacion, $rutUsuario) {
        
        $query =$this->db->query( "SELECT id FROM " . $this->table . " 
                WHERE id = ? 
                AND (rutComprador = ? OR rutVendedor = ?)
                LIMIT 1",[
            (int)$idConversacion, 
            $rutUsuario,    
            $rutUsuario    
        ]);
        $resultado=$query->fetch(PDO::FETCH_ASSOC);
        return $resultado !== false;
    }

public function getNombreDueño($rutComprador,$id){
 
 $query=$this->db->query("
   
  SELECT 
    CASE
        WHEN c.rutComprador = ? THEN pV.nombre     
        ELSE pC.nombre                             
    END AS dueño
   FROM Conversaciones c
   JOIN Usuarios uC ON c.rutComprador = uC.rutUsuario
   JOIN Personas pC ON uC.rutUsuario = pC.rut
   JOIN Usuarios uV ON c.rutVendedor = uV.rutUsuario
   JOIN Personas pV ON uV.rutUsuario = pV.rut
   WHERE c.id = ?",[$rutComprador, $id]
 );
 return $query->fetchColumn();
}

public function getConversacionesPorRut($rutUsuario) {
    $query = $this->db->query("
        SELECT 
            c.id,
            c.updated_at,
            
            CASE 
                WHEN c.rutComprador = ? THEN c.rutVendedor
                ELSE c.rutComprador
            END AS otroRut,
            
            (SELECT p.nombre FROM Usuarios u JOIN Personas p ON u.rutUsuario = p.rut WHERE u.rutUsuario = 
                CASE 
                    WHEN c.rutComprador = ? THEN c.rutVendedor
                    ELSE c.rutComprador
                END
            ) AS otroNombre
            
        FROM Conversaciones c
        WHERE c.rutComprador = ? OR c.rutVendedor = ?
        ORDER BY c.updated_at DESC;
    ",[
     $rutUsuario,
     $rutUsuario,
     $rutUsuario,
     $rutUsuario
     ]);

    return $query->fetchAll(\PDO::FETCH_ASSOC);
}  

 public function getOtroParticipante($conversacionId, $miRut){
    $sql = "
        SELECT 
            CASE 
                WHEN rutComprador = ? THEN rutVendedor
                ELSE rutComprador
            END AS rutDestinatario
        FROM " . $this->table . "
        WHERE id = ?
    ";
    
    $query = $this->db->query($sql, [$miRut, $conversacionId]);
    $resultado = $query->fetch(\PDO::FETCH_ASSOC);

    return $resultado['rutDestinatario'] ?? null;
}

} 
