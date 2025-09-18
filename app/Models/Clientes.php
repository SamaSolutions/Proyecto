<?php
namespace App\Models;

use App\Core\Model;

class Clientes extends Model {

    protected $table = 'clientes';
	protected $primaryKey='rutCliente';

    public function findByRut($rut) {
        $query = $this->db->query(
            "SELECT * FROM {$this->table} WHERE rutCliente = ? LIMIT 1", 
            [$rut]
        );
        return $query->fetch();
    }
    
    public function clientesTodos(){
     $query = $this->db->query("SELECT c.rutCliente, p.nombre, p.apellido, p.email, p.localidad, p.numero_puerta, p.calle, t.numeroTelefonico, pr.preferencia FROM personas p JOIN clientes c ON c.rutCliente = p.rut JOIN personas_telefonos t ON c.rutCliente = t.rutPersona JOIN preferencias pr ON c.rutCliente = pr.rutCliente");
    return $query->fetchAll(); 
    }
}
