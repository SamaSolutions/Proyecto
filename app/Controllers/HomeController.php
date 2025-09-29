<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        $userModel=new \App\Models\User(); 
        $datos=$this->session->get("user");
        $rutAdmin=$userModel->findAdmin($datos['rut']) ;
        return $this->render('home', [
            'title' => 'SAMA Solutions',
            'rutAdmin' => $rutAdmin,
            'check' => $this->auth->check()
        ]);
    }
}
