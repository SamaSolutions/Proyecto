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
   
  public function actualizarDatosPerfil($rut, $data) {
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
  
  public function findAllUsersWithDetails()
    {
        $sql = "
            SELECT 
                p.rut, p.nombre, p.apellido, p.email, p.localidad, p.nro, p.calle,
                u.descripcion_del_perfil, u.especialidad, u.experiencia, u.disponibilidad
            FROM 
                Personas p
            LEFT JOIN 
                Usuarios u ON p.rut = u.rutUsuario
            WHERE 
                p.rut NOT IN (SELECT rutAdmin FROM Admin)
            ORDER BY 
                p.rut DESC
        ";
        try {
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error al obtener usuarios: " . $e->getMessage());
            return [];
        }
    }

    public function updateUser($rut, $personaData, $usuarioData) {
        $this->db->beginTransaction();
        try {
            $this->db->query("UPDATE Personas SET nombre=?, apellido=?, email=?, nro=?, calle=?, localidad=? 
                           WHERE rut=?", [
                           $personaData['nombre'], 
                           $personaData['apellido'], 
                           $personaData['email'], 
                           $personaData['nro'],
                           $personaData['calle'], 
                           $personaData['localidad'], 
                           $rut
            ]);
            
            
            $this->db->query("UPDATE Usuarios SET descripcion_del_perfil=?, especialidad=?, experiencia=?, disponibilidad=? 
                              WHERE rutUsuario=?",[
                              $usuarioData['descripcion_del_perfil'],
                              $usuarioData['especialidad'],
                              $usuarioData['experiencia'], 
                              $usuarioData['disponibilidad'],
                              $rut
            ]);

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Error actualizando usuario: " . $e->getMessage());
            return false;
        }
    }

    public function deleteUser($rut)
    {
        $this->db->beginTransaction();
        try {
            $this->db->query("DELETE FROM Contraseñas WHERE rutPersona = ?", [$rut]);
            $this->db->query("DELETE FROM Valoraciones WHERE rutUsuario = ?", [$rut]);
            $this->db->query("DELETE FROM Usuarios WHERE rutUsuario = ?", [$rut]);
            $this->db->query("DELETE FROM Personas WHERE rut = ?", [$rut]);

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Error eliminando usuario: " . $e->getMessage());
            return false;
        }
    }
}    

