<?php namespace App\Controllers;
use App\Models\Projects_model;
use App\Models\Home_model;
class Home_c extends BaseController
{
    private $security;     
    protected $session;
    private $Projects_m;
    private $Home_m;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->Projects_m = new Projects_model();
        $this->Home_m = new Home_model();
        $this->security = \Config\Services::security();                        
    }
    public function index()
    {

        $projects = $this->Projects_m->get_projects();
        $testimonials = $this->Home_m->get_donor_testimonials();       
        $data['projects'] = $projects;
        $data['testimonials'] = $testimonials;
        $data['title'] = HOME; 
        echo front_view('home',$data);
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
