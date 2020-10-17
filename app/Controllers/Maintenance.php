<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
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
        // $data['maintenances'] = $this->MaintenanceModel->get_all_maintenances();
        // return view('maintenancesView', $data);
        header('Content-Type: application/json');
        return json_encode($this->MaintenanceModel->get_all_maintenances());
    }

    public function getmaintenance($id) {
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
        // echo "maintenance_delete $id";die;
        helper(['form', 'url']);
        $this->MaintenanceModel = new MaintenanceModel();
        $this->MaintenanceModel->delete_by_id($id);
        return $this->respond(array("status" => TRUE, "message" => 'Mantenimiento Eliminado'), 200);
        // echo json_encode(array("status" => TRUE));
    }



    // // Generic response method
    // respond($data, 200);
    // // Generic failure response
    // fail($errors, 400);
    // // Item created response
    // respondCreated($data);
    // // Item successfully deleted
    // respondDeleted($data);
    // // Command executed by no response required
    // respondNoContent($message);
    // // Client isn't authorized
    // failUnauthorized($description);
    // // Forbidden action
    // failForbidden($description);
    // // Resource Not Found
    // failNotFound($description);
    // // Data did not validate
    // failValidationError($description);
    // // Resource already exists
    // failResourceExists($description);
    // // Resource previously deleted
    // failResourceGone($description);
    // // Client made too many requests
    // failTooManyRequests($description);


    // public function maintenance() {
    //     helper(['form', 'url']);
    //     $this->MaintenanceModel = new MaintenanceModel();

    //     if ($this->request->getMethod() === 'post') {
    //         var_dump($this->request->getPost());die;

    //         $data = array(
    //             'folio' => $this->request->getPost('folio'),
    //             'client' => $this->request->getPost('client'),
    //             'model' => $this->request->getPost('model'),
    //             'checkin' => $this->request->getPost('checkin'),
    //             'priority' => $this->request->getPost('priority'),
    //         );
    //         $insert = $this->MaintenanceModel->maintenance_add($data);
    //         return json_encode(array("status" => TRUE));
	// 	}

    //     if ($this->request->getMethod() === 'put') {
    //         // echo 'PUT METHOD';die;
    //         var_dump($this->request->getPost(''));die;
    //         $data = array(
    //             'folio' => $this->request->getPost('folio'),
    //             'client' => $this->request->getPost('client'),
    //             'model' => $this->request->getPost('model'),
    //             'checkin' => $this->request->getPost('checkin'),
    //             'priority' => $this->request->getPost('priority'),
    //         );
    //         $this->MaintenanceModel->maintenance_update(array('id' => $this->request->getPost('id')), $data);
    //         return json_encode(array("status" => TRUE));
	// 	}

    //     $data['maintenances'] = $this->MaintenanceModel->get_all_maintenances();
    //     return view('maintenancesView', $data);
    // }

    // public function book_add() {

    //     helper(['form', 'url']);
    //     $this->MaintenanceModel = new MaintenanceModel();

    //     $data = array(
    //         'book_isbn' => $this->request->getPost('book_isbn'),
    //         'book_title' => $this->request->getPost('book_title'),
    //         'book_author' => $this->request->getPost('book_author'),
    //         'book_category' => $this->request->getPost('book_category'),
    //     );
    //     $insert = $this->MaintenanceModel->book_add($data);
    //     echo json_encode(array("status" => TRUE));
    // }

    
    // public function ajax_edit($id) {
    //     var_dump($id);die;
    //     echo 'ajax_edit';die;

    //     $this->MaintenanceModel = new MaintenanceModel();

    //     $data = $this->MaintenanceModel->get_by_id($id);

    //     echo json_encode($data);
    // }

    // public function book_update() {

    //     helper(['form', 'url']);
    //     $this->MaintenanceModel = new MaintenanceModel();

    //     $data = array(
    //         'book_isbn' => $this->request->getPost('book_isbn'),
    //         'book_title' => $this->request->getPost('book_title'),
    //         'book_author' => $this->request->getPost('book_author'),
    //         'book_category' => $this->request->getPost('book_category'),
    //     );
    //     $this->MaintenanceModel->book_update(array('book_id' => $this->request->getPost('book_id')), $data);
    //     echo json_encode(array("status" => TRUE));
    // }

    public function book_delete($id) {

        helper(['form', 'url']);
        $this->MaintenanceModel = new MaintenanceModel();
        $this->MaintenanceModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}