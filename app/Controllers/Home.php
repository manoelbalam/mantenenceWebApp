<?php namespace App\Controllers;

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
                return view('home', ['session' => $session]);

        }else{

                // $this->session->set_userdata(array('msg'=>'')); 
                //load the login page
                // return $this->load->view('auth/login');
                return view('auth/login');    
        }  


    //     return view('home', ['session' => $session]);
    }
}