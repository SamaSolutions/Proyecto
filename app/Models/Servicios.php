<?php
namespace App\Models;

use App\Core\Model;
use \PDO;
class Servicios extends Model {

    protected $table = 'Servicios';
        protected $primaryKey='idServicio';
    
    public function findByCategoria($categoria){
    $query = $this->db->query("
        SELECT 
            u.razon_social,
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
        WHERE c.nombre = ?",
   [$categoria]
    );
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

    public function CategoriasTodos(){
     $query = $this->db->query("SELECT * from Categorias");
    return $query->fetchAll();
    }
}
