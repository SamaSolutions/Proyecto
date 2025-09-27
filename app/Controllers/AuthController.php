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
    
 
    public function showRegister() {
        // Si ya está autenticado, redirigir al dashboard
        if ($this->auth->check()) {
            $this->redirect('/dashboard');
        }
        
        return $this->render('auth/register', [
            'title' => 'Registro de Usuario'
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

    $estado = "activo";
    $tipo = strlen($numeroTelefonico) > 8 ? "movil" : "fijo";

    $errors = $this->validate([
        'rut' => 'required|numeric|exact_length:8',
        'nombre' => 'required|min:3|max:100',
        'apellido' => 'required|min:3|max:100',
        'email' => 'required|email|max:150',
        'numeroTelefonico' => 'required|numeric|min:8|max:20',
        'localidad' => 'required|max:100',
        'calle' => 'required|min:3|max:100',
        'numero_puerta' => 'required|numeric|max:11',
        'password' => 'required|min:8|max:64'
    ]);

    if ($password !== $passwordConfirm) {
        $errors['password_confirm'] = 'Las contraseñas no coinciden';
    }

    $userModel = new \App\Models\User();

    if ($userModel->findByRut($rut)) {
        $errors['rut'] = 'Esta CI ya está registrada';
    }

    if ($userModel->findByEmail($email)) {
        $errors['email'] = 'Este email ya está registrado';
    }

    if ($userModel->findByTel($numeroTelefonico)) {
        $errors['numeroTelefonico'] = 'Este teléfono ya está registrado';
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

    $userId=$this->auth->register([
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
