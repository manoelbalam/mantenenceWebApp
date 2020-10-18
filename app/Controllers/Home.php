<?php namespace App\Controllers;
use App\Models\MaintenanceModel;
class Home extends BaseController
{
	public function index()
	{
        $session = session();
        if(!empty($session->get('logged_in')))
        {
                return view('home', ['session' => $session]);
        }
        return view('auth/login');    
    }
}