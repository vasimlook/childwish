<?php namespace App\Controllers;
use App\Models\Projects_model;
class Projects extends BaseController
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
    public function details($projectsId)
    {
        $projects_details =  $this->Projects_m->get_projects_details($projectsId);
        $data['projects_details'] = $projects_details;
        $data['title'] = ABOUT_PROJECT;
        echo front_view('projects_details',$data);
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
