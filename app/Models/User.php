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
   
    public function findAdmin($rut){
      $query = $this->db->query(
       "SELECT rutAdmin from Admin where rutAdmin = ? LIMIT 1",
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
    
    public function getDatosPerfil($rut){
   
     $query = $this->db->query("SELECT * FROM Usuarios where rutUsuario = ?", 
     [$rut]
     );
     return $query->fetch();
    }
    
    public function calcularValoracionPromedio($rut){
    
     $this->db->query("
      SELECT AVG(puntaje) AS valoracion_promedio 
      FROM Valoraciones
      WHERE rutUsuario = ?", [$rut]
     );
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
   
   /**
 * Actualiza los campos de perfil en la tabla Usuarios.
 * @param string $rut El RUT del usuario a actualizar.
 * @param array $data Los datos a actualizar.
 * @return bool Retorna verdadero si la actualización fue exitosa.
 */
public function actualizarDatosPerfil($rut, $data) {
    // 1. Define la consulta SQL UPDATE
    // Usamos marcadores de posición (?) para todos los valores, incluyendo el RUT.
    $this->db->query("
        UPDATE Usuarios 
        SET 
            descripcion_del_perfil = ?,
            especialidad = ?,
            experiencia = ?,
            disponibilidad = ?
        WHERE rutUsuario = ?",[
        $data['descripcion'],
        $data['especialidad'],
        $data['experiencia'],
        $data['disponibilidad'],
        $rut
    ]);

 }    
}
