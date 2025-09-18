<?php
namespace App\Models;

use App\Core\Model;

class User extends Model {
    protected $table = 'personas';

    public function findByEmail($email) {
        $query = $this->db->query(
            "SELECT c.hash_contraseña FROM personas p JOIN contraseñas c ON p.rut = c.rutPersona WHERE p.email = ? LIMIT 1",
            [$email]
        );
        return $query->fetch();
    }
     
    public function findByRut($rut) {
        $query = $this->db->query(
            "SELECT * FROM {$this->table} WHERE rut = ? LIMIT 1",
            [$rut]
        );
        return $query->fetch();
    } 
    
    public function findByTel($tel){
      $query = $this->db->query(
       "SELECT rutPersona from personas_telefonos where numeroTelefonico = ? LIMIT 1",
        [$tel]
      );
      return $query->fetch();
    }      

    public function allUsers(){
     $query = $this->db->query(
      "SELECT * FROM personas p JOIN personas_telefonos pt on(p.rut=pt.rutPersona)"
     );
     return $query->fetch();
    }
    
    public function create(array $data) {     
  
        $this->db->query("INSERT INTO personas VALUES (?,?,?,?,?,?,?)",[
         $data['rut'],
         $data['nombre'],
         $data['apellido'],
         $data['localidad'],
         $data['email'],
         $data['numero_puerta'],
         $data['calle']
        ]);

        $this->db->query("INSERT INTO personas_telefonos VALUES(?,?,?)",[
         $data['rut'],
         $data['numeroTelefonico'],
         $data['tipo']
        ]);

        $this->db->query("INSERT INTO contraseñas(rutPersona, hash_contraseña, estado) VALUES(?,?,?)",[
         $data['rut'],
         $data['password'],
         $data['estado']
        ]);

        return $this->db->lastInsertId();
    
    }
    
}
