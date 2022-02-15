<?php namespace App\Controllers;
require(APPPATH.'/ThirdParty/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError; 
use App\Models\Customers_model;
class Donation extends BaseController
{
    private $security;     
    protected $session;
    private $Customers_m;
    public function __construct() {         
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->Customers_m = new Customers_model(); 
        $this->security = \Config\Services::security();          
                         
    }
    public function donation()
    {
        helper('form');
        $data['title'] = DONATE_NOW; 
        echo front_view('donation',$data);
    }

    public function donation_step_2(){  
        // helper('form');      
        $fullName = (isset($_REQUEST['fullname'])) ? trim($_REQUEST['fullname']) : "";
        $emailAddress = (isset($_REQUEST['email'])) ? trim($_REQUEST['email']) : "";
        $mobileNumber = (isset($_REQUEST['mobile'])) ? trim($_REQUEST['mobile']) : "";
        $amount = (isset($_REQUEST['amount'])) ? trim($_REQUEST['amount']) : "10";
        $date = date("Y-m-d H:i:s");
        $customersData = array(
            'fullname' => $fullName,
            'email'=> $emailAddress,
            'phone_number' => $mobileNumber,
            'created_at' => $date
        );
        

        $customers_exist = $this->Customers_m->customers_exist($emailAddress);

        if(isset($customers_exist['customers_id'])){
            $customers_id = $customers_exist['customers_id'];
        }else{
            $customers_id = $this->Customers_m->create_customers($customersData);
        }

        echo $customers_id;exit;
        if($customers_id){
            $api = new Api(RAZERPAY_KEY,RAZERPAY_KEY_SECRET);

            $create_order = $api->order->create(
                                            array(
                                                'receipt' => '123',
                                                'amount' => $amount * 100,
                                                'currency' => 'INR',
                                                'notes'=>
                                                array(
                                                    'key1'=> 'value3',
                                                    'key2'=> 'value2'
                                                )
                                            )
                                        );
            $array = (array) $create_order;
            $prefix = chr(0).'*'.chr(0);
            $razer_orders_data = $array[$prefix.'attributes'];
            $razer_orders_id = $razer_orders_data['id'];

          
            $paymentsData = array(
                'fullName' => $fullName,
                'emailAddress' => $emailAddress,
                'mobileNumber' => $mobileNumber,
                'amount' => $amount,
                'orders_id' => $razer_orders_id
            );
            $data['razerPay'] = $paymentsData;        
            $data['title'] = DONATE_NOW_STEP_2; 
            echo front_view('donation_step_2',$data);
        }
       
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
