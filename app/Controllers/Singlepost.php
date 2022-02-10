<?php namespace App\Controllers;
class Singlepost extends BaseController
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
        $data['title'] = ABOUT_US; 
        echo front_view('singlepost',$data);
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
