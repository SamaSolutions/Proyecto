<?php

namespace App\Controllers;

use App\Core\Controller;

class ContactoController extends Controller {

   public function index() {
          return $this->render('contacto/index', [
          'title' => 'Contacto'
          ]);
   }
}
