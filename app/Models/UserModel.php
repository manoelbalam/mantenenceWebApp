<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['first_name', 'last_name', 'email', 'username', 'password'];

    // public function user_all() {
    //     helper(['form', 'url']);
    //     $this->MaintenanceModel = new MaintenanceModel();
    //     // $data['maintenances'] = $this->MaintenanceModel->get_all_maintenances();
    //     // return view('maintenancesView', $data);
    //     header('Content-Type: application/json');
    //     return json_encode($this->MaintenanceModel->get_all_maintenances());
    // }

    public function user_all() {
        $query = $this->db->query('select id,first_name,last_name,username,email from users');
        return $query->getResult();
    }
}