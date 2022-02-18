<?php namespace App\Controllers;
require(APPPATH.'/ThirdParty/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError; 
use App\Models\Donation_model;
use App\Models\Customers_model;
use App\Models\Projects_model;
class Donation extends BaseController
{
    private $security;     
    protected $session;
    private $Customers_m;
    private $Donation_m;
    private $Projects_m;
    public function __construct() {                
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->Customers_m = new Customers_model(); 
        $this->Donation_m = new Donation_model(); 
        $this->Projects_m = new Projects_model(); 
        $this->security = \Config\Services::security();          
                         
    }
    public function donation($projectId)
    {
        
        helper('form');
        $data['projects_id'] = $projectId;
        $data['title'] = DONATE_NOW; 
        echo front_view('donation',$data);
    }

    public function donation_step_2(){        
        helper('form');      
        $fullName = (isset($_REQUEST['fullname'])) ? trim($_REQUEST['fullname']) : "";
        $emailAddress = (isset($_REQUEST['email'])) ? trim($_REQUEST['email']) : "";
        $mobileNumber = (isset($_REQUEST['mobile'])) ? trim($_REQUEST['mobile']) : "";
        $amount = (isset($_REQUEST['amount'])) ? trim($_REQUEST['amount']) : "10";
        $date = date("Y-m-d H:i:s");
        $projectsId = (int)$_REQUEST['projects_id'];

        if($fullName !== "" && $emailAddress !== "" && $mobileNumber !== "" && $amount !== ""){
            $customersData = array(
                'fullname' => $fullName,
                'email'=> $emailAddress,
                'phone_number' => $mobileNumber,
                'created_at' => $date
            );
            
    
            $customers_exist = $this->Customers_m->customers_exist($emailAddress);      
    
            if(isset($customers_exist['customers_id'])){
                $customers_id = $customers_exist['customers_id'];
                unset($customersData['created_at']);
                $customersData['updated_at'] = $date;
                $this->Customers_m->update_customers($customers_id,$customersData);
            }else{
                $customers_id = $this->Customers_m->create_customers($customersData);
            }
            
            if($customers_id){            
                $api = new Api(RAZERPAY_KEY,RAZERPAY_KEY_SECRET);
    
                $create_order = $api->order->create(
                                                array(
                                                    'receipt' => '',
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
    
                if($razer_orders_id){
                    $date = date("Y-m-d H:i:s");
                    $ordersData = array(
                        'customers_id' => $customers_id,
                        'razer_orders_id' => $razer_orders_id,
                        'order_creation_date' => $date
                    );
                    $child_oreders_id = $this->Donation_m->create_order($ordersData);
                    if($child_oreders_id){
                        $paymentsData = array(
                            'fullName' => $fullName,
                            'emailAddress' => $emailAddress,
                            'mobileNumber' => $mobileNumber,
                            'amount' => $amount,
                            'orders_id' => $razer_orders_id
                        );
                        $data['razerPay'] = $paymentsData;        
                        $data['projects_id'] = $projectsId;        
                        $data['title'] = DONATE_NOW_STEP_2; 
                        echo front_view('donation_step_2',$data);
                    }               
                }
            }
        }
    }

    public function donation_success(){

        if(isset($_REQUEST['razorpay_payment_id']) && $_REQUEST['razorpay_payment_id'] != ''){
            $api = new Api(RAZERPAY_KEY,RAZERPAY_KEY_SECRET);
            $res = $api->payment->fetch($_REQUEST['razorpay_payment_id']);
            $projects_id = (int)$_REQUEST['projects_id'];            
    
            $res = (array) $res;
            $prefix = chr(0).'*'.chr(0);
            $razer_payments_data = $res[$prefix.'attributes'];
    
            if((is_array($razer_payments_data) && sizeof($razer_payments_data) > 0 ) &&
                (isset($razer_payments_data['order_id']) && $razer_payments_data['order_id'] != '') &&
                (isset($razer_payments_data['status']) && $razer_payments_data['status'] == 'captured') &&
                (isset($razer_payments_data['captured']) && ($razer_payments_data['captured'] == 1 || $razer_payments_data['captured'] == '1' ))
            ){
                $rp = $razer_payments_data;
                $donate_amount = (float)($rp['amount']/100);
                $orders_id = $razer_payments_data['order_id'];
                $paymentDate = date("Y-m-d H:i:s");
                $payments = array(
                    'razer_payment_id' => $rp['id'],
                    'currency' => $rp['currency'],
                    'amount' => $donate_amount,
                    'status' => $rp['status'],
                    'captured' =>  $rp['captured'],
                    'card_id' =>  $rp['card_id'],
                    'method' => $rp['method'],
                    'amount_refunded' => $rp['amount_refunded'],
                    'refund_status' => $rp['refund_status'],
                    'bank' => $rp['bank'],
                    'wallet' => $rp['wallet'],
                    'vpa' => $rp['vpa'],
                    'international' => $rp['international'],
                    'fee' => $rp['fee'],
                    'tax' => $rp['tax'],
                    'entity' => $rp['entity'],
                    'payement_date' => $paymentDate,
                    'projects_id' => $projects_id
                );

               
                if($projects_id > 0){                    
                    $this->Projects_m->update_projects_donation($projects_id,$donate_amount);
                }
                
                $update_payments = $this->Donation_m->update_donation($orders_id,$payments);
                $data['title'] = DONATE_SUCCESS; 
                echo front_view('donation_success',$data);
            }         
        }
        
    }
    public function page404() {        
        $data['title'] = 'error';        
        echo single_page('errors/html/custome_error_404',$data);
    }

    
}
