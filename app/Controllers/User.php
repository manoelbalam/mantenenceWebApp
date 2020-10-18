<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
class User extends Controller {

    use ResponseTrait;

    public function user_all() {
        helper(['form', 'url']);
        $this->UserModel = new UserModel();
        return $this->respond($this->UserModel->user_all(), 200);
    }

    public function user_add() {
        helper(['form', 'url']);
        $this->UserModel = new UserModel();
        $data = array(
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        );
        $insert = $this->UserModel->user_add($data);
        return $this->respond(array("status" => TRUE, "message" => 'Usuario Creado con Exito'), 200);
        
    }

}