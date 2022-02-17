<?php namespace App\Controllers;
use App\Models\Projects_model;
class Home_c extends BaseController
{
    private $security;     
    protected $session;
    private $Projects_m;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->Projects_m = new Projects_model();
        $this->security = \Config\Services::security();                        
    }
    public function index()
    {

        $projects = $this->Projects_m->get_projects();       
        $data['projects'] = $projects;
        $data['title'] = HOME; 
        echo front_view('home',$data);
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
