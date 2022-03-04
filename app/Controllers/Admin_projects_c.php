<?php

namespace App\Controllers;
use App\Models\admin\Project_m;
use App\Models\admin\Login_m;
class Admin_projects_c extends BaseController{
    private $Project_m;
    private $Login_m; 
    private $security;     
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->Project_m = new Project_m();
        $this->Login_m = new Login_m(); 
        $this->security = \Config\Services::security();        
        sessionCheckAdmin();                   
        if (isset($_SESSION['admin']['admin_user_id'])) {            
                $result = $this->Login_m->getTokenAndCheck('admin', $_SESSION['admin']['admin_user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['admin']['admin_tokencheck'] != $token) {                                                                       
                            logoutUser('admin');
                            header('Location: ' . ADMIN_LOGIN_LINK);
                            exit();                        
                    }   
                }else{
                    logoutUser('admin');
                    header('Location: ' . ADMIN_LOGIN_LINK);
                    exit();
                } 
            
        }                      
    }
    public function create_project(){     
        helper('form');
        $data['title'] = ADMIN_PROJECT_TITLE; 
        echo admin_view('admin/createproject',$data);
    }
    
    
}
?>