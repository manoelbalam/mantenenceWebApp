<?php namespace App\Controllers;
use App\Models\MaintenanceModel;
class Home extends BaseController
{
	public function index()
	{
        // $sess_id = $this->session->userdata('id');
        // $session = \Config\Services::session($config);
        $session = session();
        // var_dump($session->get('logged_in'));

        if(!empty($session->get('logged_in')))
        {
                // $session = session();
                $this->MaintenanceModel = new MaintenanceModel();
                $data['maintenances'] = $this->MaintenanceModel->get_all_maintenances();
                // return view('maintenancesView', $data);
                // return json_encode($data);
                
                return view('home', ['session' => $session, 'data' => $data]);

        }
        // else{

                // $this->session->set_userdata(array('msg'=>'')); 
                //load the login page
                // return $this->load->view('auth/login');
                return view('auth/login');    
        // } 


    //     return view('home', ['session' => $session]);
    }
}