<?php namespace App\Controllers;
class Careers extends BaseController
{
    private $security;     
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();                        
    }
    public function index()
    {
        $data['title'] = CAREER; 
        echo front_view('careers',$data);
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
