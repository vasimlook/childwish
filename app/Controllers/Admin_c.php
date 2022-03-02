<?php

namespace App\Controllers;

class Admin_c extends BaseController{
    private $security;     
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();                        
    }
    public function admin_dashboard()
    {
        ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
        $data['title'] = ADMIN_DASHBOARD; 
        echo admin_view('admin/dashboard',$data);
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
?>