<?php namespace App\Controllers;
class Donation extends BaseController
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
    public function donation()
    {
        $data['title'] = DONATE_NOW; 
        echo front_view('donation',$data);
    }

    public function donation_step_2(){

        $fullName = (isset($_REQUEST['fullname'])) ? trim($_REQUEST['fullname']) : "Vishal Patel";
        $emailAddress = (isset($_REQUEST['email'])) ? trim($_REQUEST['email']) : "ivishalonline@gmail.com";
        $mobileNumber = (isset($_REQUEST['mobile'])) ? trim($_REQUEST['mobile']) : "9978780710";
        $amount = (isset($_REQUEST['amount'])) ? trim($_REQUEST['amount']) : "10";
      
        $paymentsData = array(
            'fullName' => $fullName,
            'emailAddress' => $emailAddress,
            'mobileNumber' => $mobileNumber,
            'amount' => $amount
        );

        $data['razerPay'] = $paymentsData;        
        $data['title'] = DONATE_NOW_STEP_2; 
        echo front_view('donation_step_2',$data);
    }

    public function donation_success(){        
        $data['title'] = DONATE_SUCCESS; 
        echo front_view('donation_success',$data);
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
