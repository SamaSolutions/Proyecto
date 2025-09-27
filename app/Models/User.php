<?php
namespace App\Models;
use PDO;
use App\Core\Model;

class User extends Model {
    protected $table = 'Personas';

    public function findByEmail($email) {
    $query = $this->db->query(
        "SELECT p.rut, p.nombre, p.apellido, p.email, c.hash_contraseña AS password_hash
         FROM Personas p 
         JOIN Contraseñas c ON p.rut = c.rutPersona 
         WHERE p.email = ? 
         LIMIT 1",
        [$email]
    );
    return $query->fetch(PDO::FETCH_ASSOC);
}
     
    public function findByRut($rut) {
        $query = $this->db->query(
            "SELECT * FROM Personas WHERE rut = ? LIMIT 1",
            [$rut]
        );
        return $query->fetch();
    } 
    
    public function findByTel($tel){
      $query = $this->db->query(
       "SELECT rutPersona from Personas_Telefonos where numeroTelefonico = ? LIMIT 1",
        [$tel]
      );
      return $query->fetch();
    }      

    public function allUsers(){
     $query = $this->db->query(
      "SELECT * FROM Personas p JOIN Personas_Telefonos pt on(p.rut=pt.rutPersona)"
     );
     return $query->fetch();
    }
    
    public function create(array $data) {     
       
     $this->db->query(
            "INSERT INTO Personas (rut, nombre, apellido, localidad, email, nro, calle) VALUES (?,?,?,?,?,?,?)",
            [
                $data['rut'],
                $data['nombre'],
                $data['apellido'],
                $data['localidad'],
                $data['email'],
                $data['numero_puerta'],
                $data['calle']
            ]
        );

        $this->db->query(
            "INSERT INTO Personas_Telefonos (rutPersona, numerotelefonico, tipo) VALUES (?,?,?)",
            [
                $data['rut'],
                $data['numeroTelefonico'],
                $data['tipo']
            ]
        );

        $this->db->query(
            "INSERT INTO Contraseñas (rutPersona, hash_contraseña, estado) VALUES (?,?,?)",
            [
                $data['rut'],
                $data['password'],
                $data['estado']
            ]
        );

        $this->db->query(
            "INSERT INTO Usuarios (rutUsuario, descripcion_del_perfil, especialidad, experiencia, disponibilidad, razon_social) VALUES (?,?,?,?,?,?)",
            [
                $data['rut'],
                '',
                '',
                '',
                '',
                ''
            ]
        );
        return $data['rut'];
    
    }
    
}
