<?php
namespace App\Models;

use App\Core\Model;

class PublicaServicios extends Model {
 
 public function crearServicio($rutVendedor, $nombre, $descripcion, $precio, $duracion, $categoria){
   $this->db->query("INSERT INTO Servicios (precio_estimado, nombre, descripcion, duracion) VALUES ('$precio', '$nombre', '$descripcion', '$duracion')");
        $idServicio = $this->db->lastInsertId();

        $query = $this->db->query("SELECT IdCategoria FROM Categorias WHERE nombre = '$categoria'");
        $categoriaId = $query->fetch()['IdCategoria'] ?? null;

        if (!$categoriaId) {
            $this->db->query("INSERT INTO Categorias (nombre, descripcion) VALUES ('$categoria', '')");
            $categoriaId = $this->db->lastInsertId();
        }

        $this->db->query("INSERT INTO pertenecen (IdServicio, IdCategoria) VALUES ($idServicio, $categoriaId)");

        $this->db->query("INSERT INTO ofrecen (rutUComprador, rutUVendedor, IdServicio, fecha, estado) VALUES (NULL, '$rutVendedor', $idServicio, NOW(), 'Disponible')");

        return $idServicio;
 
 }
}
