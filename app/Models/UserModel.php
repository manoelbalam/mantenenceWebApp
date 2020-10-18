<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'username', 'password'];

    public function user_all() {
        $query = $this->db->query("SELECT * FROM $this->table ORDER BY id DESC");
        return $query->getResult();
    }

    public function user_add($data) {
        $query = $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }
}