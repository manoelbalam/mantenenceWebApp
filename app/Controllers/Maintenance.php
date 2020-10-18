<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\MaintenanceModel;
class Maintenance extends Controller {

    use ResponseTrait;

    public function index() {
        helper(['form', 'url']);
        $this->MaintenanceModel = new MaintenanceModel();
        $data['maintenances'] = $this->MaintenanceModel->get_all_maintenances();
        return view('maintenancesView', $data);
    }

    public function maintenance_all() {
        helper(['form', 'url']);
        $this->MaintenanceModel = new MaintenanceModel();
        return $this->respond($this->MaintenanceModel->get_all_maintenances(), 200);
    }

    public function maintenance_get($id) {
        $this->MaintenanceModel = new MaintenanceModel();
        $data = $this->MaintenanceModel->get_by_id($id);
        return $this->respond($data, 200);

    }

    public function maintenance_add() {
        // echo json_encode(array("return" => $this->request->getPost('priority')));die;
        helper(['form', 'url']);
        $this->MaintenanceModel = new MaintenanceModel();
        $data = array(
            'folio' => $this->request->getPost('folio'),
            'client' => $this->request->getPost('client'),
            'model' => $this->request->getPost('model'),
            'checkin' => $this->request->getPost('checkin'),
            'priority' => $this->request->getPost('priority'),
        );
        $insert = $this->MaintenanceModel->maintenance_add($data);
        return $this->respond(array("status" => TRUE, "message" => 'Mantenimiento Creado con Exito'), 200);
        
    }

    public function maintenance_update() {
        // echo 'maintenance_update';die;
        helper(['form', 'url']);
        $this->MaintenanceModel = new MaintenanceModel();
        // var_dump($this->request->getPost('id'));die;
        $data = array(
            'folio' => $this->request->getPost('folio'),
            'client' => $this->request->getPost('client'),
            'model' => $this->request->getPost('model'),
            'checkin' => $this->request->getPost('checkin'),
            'priority' => $this->request->getPost('priority'),
        );
        $this->MaintenanceModel->maintenance_update(array('id' => $this->request->getPost('id')), $data);
        return $this->respond(array("status" => TRUE, "message" => 'Mantenimiento Actualilzado con Exito'), 200);   
    }

    public function maintenance_delete($id) {
        helper(['form', 'url']);
        $this->MaintenanceModel = new MaintenanceModel();
        $this->MaintenanceModel->delete_by_id($id);
        return $this->respond(array("status" => TRUE, "message" => 'Mantenimiento Eliminado'), 200);
    }

}