<?php
namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller {
    public function showLogin() {
        // Si ya está autenticado, redirigir al dashboard
        if ($this->auth->check()) {
            $this->redirect('/dashboard');
        }
        
        return $this->render('auth/login', [
            'title' => 'Iniciar Sesión'
        ]);
    }

    public function login() {
        $email = $this->input('email');
        $password = $this->input('password');
        
        // Validar entradas
        $errors = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (!empty($errors)) {
            return $this->render('auth/login', [
                'title' => 'Iniciar Sesión',
                'errors' => $errors,
                'input' => ['email' => $email]
            ]);
        }
        
        if ($this->auth->attempt($email, $password)) {
            $this->session->flash('success', 'Has iniciado sesión correctamente');
            $this->redirect('/dashboard');
        }
        
        $this->session->flash('error', 'Credenciales incorrectas');
        return $this->render('auth/login', [
            'title' => 'Iniciar Sesión',
            'input' => ['email' => $email]
        ]);
    }
    
    public function showRegisterProveedor() {
        // Si ya está autenticado, redirigir al dashboard
        if ($this->auth->check()) {
            $this->redirect('/dashboard');
        }

        return $this->render('auth/registerProveedor', [
            'title' => 'Registro de Proveedor'
        ]);
    }
 
    public function showRegister() {
        // Si ya está autenticado, redirigir al dashboard
        if ($this->auth->check()) {
            $this->redirect('/dashboard');
        }
        
        return $this->render('auth/register', [
            'title' => 'Registro de Usuario'
        ]);
    }
     public function registerProveedor() {
        $rut = $this->input('rut');
        $nombre = $this->input('nombre');
        $apellido = $this->input('apellido');
        $numeroTelefonico = $this->input('numeroTelefonico');
        $localidad = $this->input('localidad');
        $calle = $this->input('calle');
        $numero_puerta = $this->input('numero_puerta');
        
        $razon_social = $this->input('razon_social');
        $especialidad = $this->input('especialidad');
        $descripcion_del_perfil = $this->input('descripcion_del_perfil');
        $experiencia = $this->input('experiencia');
        $disponibilidad = $this->input('disponibilidad');

        $email = $this->input('email');
        $password = $this->input('password');
        $passwordConfirm = $this->input('password_confirm');
        $estado="activo";
        $tipo="fijo";
        
        if(strlen($numeroTelefonico)>8){
         $tipo="movil";
        }

        // Validar entradas
        $errors = $this->validate([
            'rut' => 'required|numeric|exact_length:8',
            'nombre' => 'required|min:3|max:50',
            'apellido' => 'required|min:3|max:50',
            'numeroTelefonico' => 'required|numeric|min:8|max:9',
            'localidad' => 'required',
            'calle' => 'required|min:3|max:50',
            'numero_puerta' => 'required|numeric|max:11',
            'razon_social' => 'required|min:3|max:100',
            'especialidad' => 'required|min:3|max:50',
            'descripcion_del_perfil' => 'required|min:3',
            'experiencia' => 'required|min:3|max:50',
            'disponibilidad' => 'required|min:3', 
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|max:64'
        ]);

        // Validación adicional para la coincidencia de contraseñas
        if ($password !== $passwordConfirm) {
            $errors['password_confirm'] = 'Las contraseñas no coinciden';
        }

        // Verificar si el email ya está registrado
        $user = (new \App\Models\Proveedor())->findByEmail($email);
        if ($user) {
            $errors['email'] = 'Este email ya está registrado';
        }

        $user = (new \App\Models\Proveedor())->findByRut($rut);
        if ($user) {
            $errors['rut'] = 'Esta CI ya está registrada';
        }
        
        $user = (new \App\Models\Proveedor())->findByTel($numeroTelefonico);
        if ($user) {
            $errors['numeroTelefonico'] = 'Este telefono ya está registrado';
        }
        
        
        if (!empty($errors)) {
            return $this->render('auth/registerProveedor', [
                'title' => 'Registro de Usuario',
                'errors' => $errors,
                'input' => [
                    'rut' => $rut,
                    'nombre' => $nombre
                ]
            ]);
        }

        // Crear el usuario
        $userId = $this->auth->registerProveedor([
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'numeroTelefonico' => $numeroTelefonico,
            'localidad' => $localidad,
            'calle' => $calle,
            'numero_puerta' => $numero_puerta,
            'razon_social' => $razon_social,
            'especialidad' => $especialidad,
            'descripcion_del_perfil' => $descripcion_del_perfil,
            'experiencia' => $experiencia,
            'disponibilidad' => $disponibilidad,
            'password' => $password,
            'tipo' => $tipo,
            'estado' => $estado
        ]);

        if ($userId) {
            // Auto login después del registro
            $this->auth->attempt($email, $password);
            $this->session->flash('success', 'Te has registrado correctamente');
            $this->redirect('/dashboard');
        }

        $this->session->flash('error', 'Error al registrar el Proveedor');
        return $this->render('auth/registerProveedor', [
            'title' => 'Registro de Proveedor',
            'input' => [
                'nombre' => $nombre,
                'email' => $email
            ]
        ]);
    }
    
    public function register() {
        $rut = $this->input('rut');
        $nombre = $this->input('nombre');
        $apellido = $this->input('apellido');
        $email = $this->input('email');
        $numeroTelefonico = $this->input('numeroTelefonico');
        $localidad = $this->input('localidad');
        $calle = $this->input('calle');
        $numero_puerta = $this->input('numero_puerta');
        $password = $this->input('password');
        $passwordConfirm = $this->input('password_confirm');
        
        $estado="activo";
        $tipo="fijo";
        if(strlen($numeroTelefonico)>8){
         $tipo="movil";
        }
  
        // Validar entradas
        $errors = $this->validate([
            'rut' => 'required|numeric|exact_length:8', 
            'nombre' => 'required|min:3|max:50',
            'apellido' => 'required|min:3|max:50',
            'email' => 'required|email|max:100',
            'numeroTelefonico' => 'required|numeric|min:8|max:9',
            'localidad' => 'required',
            'calle' => 'required|min:3|max:50',
            'numero_puerta' => 'required|numeric|max:11',
            'password' => 'required|min:8|max:64'
        ]);
        
        // Validación adicional para la coincidencia de contraseñas
        if ($password !== $passwordConfirm) {
            $errors['password_confirm'] = 'Las contraseñas no coinciden';
        }
        
        // Verificar si el email ya está registrado
        $user = (new \App\Models\User())->findByEmail($email);
        if ($user) {
            $errors['email'] = 'Este email ya está registrado';
        }
        
        $user = (new \App\Models\User())->findByRut($rut);
        if ($user) {
            $errors['rut'] = 'Esta CI ya está registrada';
        }        
        
        $user = (new \App\Models\User())->findByTel($rut);
        if ($user) {
            $errors['numeroTelefonico'] = 'Este telefono ya está registrado';
        }

         
        if (!empty($errors)) {
            return $this->render('auth/register', [
                'title' => 'Registro de Usuario',
                'errors' => $errors,
                'input' => [
                    'rut' => $rut,
                    'nombre' => $nombre
                ]
            ]);
        }
        
        // Crear el usuario
        $userId = $this->auth->register([
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'numeroTelefonico' => $numeroTelefonico,
            'localidad' => $localidad,
            'calle' => $calle,
            'numero_puerta' => $numero_puerta,
            'password' => $password,
            'tipo' => $tipo,
            'estado' => $estado
        ]);
        
        if ($userId) {
            // Auto login después del registro
            $this->auth->attempt($email, $password);
            $this->session->flash('success', 'Te has registrado correctamente');
            $this->redirect('/dashboard');
        }
        
        $this->session->flash('error', 'Error al registrar el usuario');
        return $this->render('auth/register', [
            'title' => 'Registro de Usuario',
            'input' => [
                'nombre' => $nombre,
                'email' => $email
            ]
        ]);
    }

    public function logout() {
        $this->auth->logout();
        $this->session->flash('success', 'Has cerrado sesión correctamente');
        $this->redirect('/');
    }
}
