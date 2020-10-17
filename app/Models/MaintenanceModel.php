<?php

namespace App\Models;

class MaintenanceModel extends \CodeIgniter\Model
{
    protected $table = 'maintenances';
    protected $primaryKey = 'id';

    protected $allowedFields = ['folio', 'client', 'model', 'checkin', 'prority'];

    public function __construct() {
        parent::__construct();
        //$this->load->database();
        $db = \Config\Database::connect();
        $builder = $db->table('maintenances');
    }

    public function get_by_id($id) {
      $sql = 'select * from maintenances where id ='.$id ;
      $query =  $this->db->query($sql);

      return $query->getRow();
    }

    public function get_all_maintenances() {
        $query = $this->db->query('SELECT * FROM maintenances ORDER BY id DESC');
        return $query->getResult();
    }

    public function maintenance_add($data) {
        $query = $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function maintenance_update($where, $data) {
        $this->db->table($this->table)->update($data, $where);
        return $this->db->affectedRows();
    }
    
    public function delete_by_id($id) {
        $this->db->table($this->table)->delete(array('id' => $id)); 
    }

}