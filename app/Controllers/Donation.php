<?php namespace App\Controllers;
require(APPPATH.'/ThirdParty/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError; 
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
        helper('form');
        $data['title'] = DONATE_NOW; 
        echo front_view('donation',$data);
    }

    public function donation_step_2(){  
        helper('form');      
        $fullName = (isset($_REQUEST['fullname'])) ? trim($_REQUEST['fullname']) : "";
        $emailAddress = (isset($_REQUEST['email'])) ? trim($_REQUEST['email']) : "";
        $mobileNumber = (isset($_REQUEST['mobile'])) ? trim($_REQUEST['mobile']) : "";
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
        $api = new Api(RAZERPAY_KEY,RAZERPAY_KEY_SECRET);
        $res=$api->payment->fetch($_REQUEST['razorpay_payment_id']);
        print_r($res);die;
        $data['title'] = DONATE_SUCCESS; 
        echo front_view('donation_success',$data);
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }
}
