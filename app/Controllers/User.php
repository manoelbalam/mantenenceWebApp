<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
class User extends Controller {

    public function user_all() {
        helper(['form', 'url']);
        $this->UserModel = new UserModel();
        // $data['maintenances'] = $this->MaintenanceModel->get_all_maintenances();
        // return view('maintenancesView', $data);
        header('Content-Type: application/json');
        return json_encode($this->UserModel->user_all());
    }

}