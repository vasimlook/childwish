<?php namespace App\Controllers;

//use App\Models\Frontm\Login_m;

class Home_c extends BaseController
{    
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();                         
    }
    public function index() {
        $data['title'] = FRONT_HOME_TITLE;        
        echo front_view('frontside/home',$data);
    }       
}
