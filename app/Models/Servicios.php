<?php
namespace App\Models;

use App\Core\Model;
use \PDO;
class Servicios extends Model {

    protected $table = 'Servicios';
        protected $primaryKey='idServicio';
    
   
   public function borrarServicio($idServicio, $rutUsuario) {
    $query = $this->db->query(
        "SELECT COUNT(*) FROM ofrecen WHERE IdServicio = ? AND rutUVendedor = ?",
        [$idServicio, $rutUsuario]
    );

    if ($query->fetchColumn() == 0) {
        return false;
    }


    $this->db->query("DELETE FROM pertenecen WHERE IdServicio = ?", [$idServicio]);

    $this->db->query("DELETE FROM ofrecen WHERE IdServicio = ?", [$idServicio]);
    $query = $this->db->query("DELETE FROM Servicios WHERE IdServicio = ?", [$idServicio]);
    
    return $query->rowCount() > 0;
}
  
 public function findByRut($rut, $pagina = 1, $offset = 5){
    $inicio = ($pagina - 1) * $offset;
    
    $query = $this->db->query("
        SELECT 
            S.IdServicio, 
            S.nombre, 
            S.descripcion, 
            S.precio_estimado AS precio, 
            S.duracion
        FROM
            Servicios AS S
        INNER JOIN
            ofrecen AS O ON S.IdServicio = O.IdServicio
        WHERE
            O.rutUVendedor = ? 
        LIMIT $inicio, $offset", 
        [$rut]
    );
    return $query->fetchAll(\PDO::FETCH_ASSOC); 
}

public function countByRut($rut) {
    $query = $this->db->query(
        "SELECT COUNT(S.IdServicio)
        FROM Servicios AS S
        INNER JOIN ofrecen AS O ON S.IdServicio = O.IdServicio
        WHERE O.rutUVendedor = ?",
        [$rut]
    );
    return $query->fetchColumn(); 
}
 
    
    public function findByCategoria($categoria, $pagina = 1, $offset = 5){
    $inicio = ($pagina - 1) * $offset;
    $query = $this->db->query("
        SELECT 
            ps.nombre,
            s.precio_estimado,
            s.descripcion,
            s.duracion,
            s.nombre AS tipo,
            c.IdCategoria,
            u.rutUsuario as rutVendedor,
            s.IdServicio
        FROM Servicios s
        JOIN pertenecen p ON s.IdServicio = p.IdServicio
        JOIN Categorias c ON p.IdCategoria = c.IdCategoria
        JOIN ofrecen o ON s.IdServicio = o.IdServicio
        JOIN Usuarios u ON o.rutUVendedor = u.rutUsuario
        JOIN Personas ps ON ps.rut=u.rutUsuario
        WHERE c.nombre = ? LIMIT $inicio, $offset",
   [$categoria]
    );
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

    public function countByCategoria($categoria){
    $query = $this->db->query("
        SELECT COUNT(*) AS total
        FROM Servicios s
        JOIN pertenecen p ON s.IdServicio = p.IdServicio
        JOIN Categorias c ON p.IdCategoria = c.IdCategoria
        WHERE c.nombre = ?
    ", [$categoria]);

    return $query->fetch(PDO::FETCH_ASSOC)['total'];
}

    public function CategoriasTodos(){
     $query = $this->db->query("SELECT * from Categorias");
    return $query->fetchAll();
    }
  
public function findById($idServicio) {
    $query = $this->db->query(
        "SELECT 
            S.IdServicio, 
            S.nombre, 
            S.descripcion, 
            S.precio_estimado AS precio, 
            S.duracion,
            O.rutUVendedor AS rutPropietario 
        FROM Servicios AS S 
        INNER JOIN ofrecen AS O ON S.IdServicio = O.IdServicio 
        WHERE S.IdServicio = ? LIMIT 1",
        [$idServicio]
    );
    return $query->fetch(); 
 }
 
public function findByIdEspecifica($id) {
    $query = $this->db->query("
     SELECT 
    p.nombre AS dueño,
    s.nombre,
    s.descripcion,
    s.precio_estimado AS precio,
    s.duracion,
    c.nombre AS categoria
 FROM ofrecen o
 JOIN Usuarios u ON o.rutUVendedor = u.rutUsuario
 JOIN Personas p ON u.rutUsuario = p.rut
 JOIN Servicios s ON o.IdServicio = s.IdServicio
 JOIN pertenecen pe ON s.IdServicio = pe.IdServicio
 JOIN Categorias c ON pe.IdCategoria = c.IdCategoria
 WHERE s.IdServicio = ?", [$id]);
    return $query->fetch();
 }

public function findByIdConversacion($id){
   $query= $this->db->query("
     SELECT idServicio
     FROM Conversaciones
     WHERE id=?",[$id]
   );
  $resultado = $query->fetch();
  return $resultado["idServicio"];
}

public function actualizarServicio($idServicio, $datos) {
    
    $query = $this->db->query("
        UPDATE Servicios 
        SET 
            nombre = ?, 
            descripcion = ?, 
            precio_estimado = ?, 
            duracion = ?
        WHERE IdServicio = ?",
        [
            $datos['nombre'],
            $datos['descripcion'],
            $datos['precio_estimado'], 
            $datos['duracion'],
            $idServicio
        ]
    );
    return $query->rowCount() > 0;
}
}


