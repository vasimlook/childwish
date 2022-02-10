<?php namespace App\Controllers;

use App\Models\Frontm\Login_m;

class Login_c extends BaseController
{
    private $Login_m;   
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->security = \Config\Services::security();                         
        $this->Login_m = new Login_m();
    }      
    public function index() {        
        helper('form');
        $result = false;                  
        if (isset($_POST['username']) && isset($_POST['password'])) {                
            $result = $this->Login_m->customer_login_select($_POST['username'], $_POST['password']);
            if ($result == true) {               
                return redirect()->to(BASE_URL); 
            }
        }
        if ($result == false) {
            $data['title'] = FRONT_LOGIN_TITLE;        
            echo front_view('frontside/login',$data);
        }
    }
      public function logout() {
        logoutUser('customer');
        return redirect()->to(FRONT_LOGIN_LINK); 
    }
}
