<?php
namespace App\Models;

use App\Core\Model;
use \PDO;
class Servicios extends Model {

    protected $table = 'Servicios';
        protected $primaryKey='idServicio';
    
    public function findByCategoria($categoria){
     $query = $this->db->query("SELECT pds.razon_social, s.precio_estimado, s.descripcion, s.duracion, s.tipo, s.categoria from servicios s JOIN proveedores_de_sl pds on(s.rutProveedor=pds.rutProveedor) where categoria = ?",

     [$categoria]     
     );
     return $query->fetchAll(PDO::FETCH_ASSOC); 
 }
    public function CategoriasTodos(){
     $query = $this->db->query("SELECT * from categorias");
    return $query->fetchAll();
    }
}
