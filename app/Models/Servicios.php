<?php
namespace App\Models;

use App\Core\Model;
use \PDO;
class Servicios extends Model {

    protected $table = 'Servicios';
        protected $primaryKey='idServicio';
    
    public function findByCategoria($categoria, $pagina = 1, $offset = 5){
    $inicio = ($pagina - 1) * $offset;
    $query = $this->db->query("
        SELECT 
            ps.nombre,
            s.precio_estimado,
            s.descripcion,
            s.duracion,
            s.nombre AS tipo,
            c.IdCategoria
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
}
