<?php

namespace App\Controllers;

use App\Models\Madmin\Admin_m;
use App\Models\Madmin\Login_m;
use App\Models\Madmin\Area_m;
use App\Models\Madmin\Market_m;
use App\Models\Madmin\Withdrawal_m;

class Admin_c extends BaseController {

    private $Withdrawal_m;
    private $Admin_m;
    private $Market_m;
    private $Area_m;
    private $Login_m;
    private $security;
    protected $session;

    public function __construct() {
        $this->session = \Config\Services::session();
        $this->session->start();
        helper('url');
        helper('functions');
        sessionCheckAdmin();
        $this->Withdrawal_m = new Withdrawal_m();
        $this->Market_m = new Market_m();
        $this->Area_m = new Area_m();
        $this->Admin_m = new Admin_m();
        $this->Login_m = new Login_m();
        $this->security = \Config\Services::security();
    }

    public function index() {                       
        $wallet_amount = $this->Area_m->get_wallet_by_user($_SESSION['admin']['admin_id']);                
        $win_amount = $this->Area_m->get_win_amount_by_user($_SESSION['admin']['admin_id']);                
        $withdrawal_amount = $this->Area_m->get_withdrawal_amount_by_user($_SESSION['admin']['admin_id']);
        $played_amount = $this->Area_m->get_played_amount_by_user($_SESSION['admin']['admin_id']);               
        $mainTotalAmount=$wallet_amount['amount']+$win_amount-$withdrawal_amount-$played_amount;                                
        $market = $this->Market_m->get_market();          
        $data['market'] = $market;
        $data['topup'] = $wallet_amount['amount'];
        $data['wallet'] = $mainTotalAmount;
        $data['withdrawal_amount'] = $withdrawal_amount;
        $data['win_amount'] = $win_amount;
        $data['played_amount'] = $played_amount;        
        $data['title'] = ADMIN_DASHBOARD_TITLE;
        echo main_admin_view('mainadmin/dashboard', $data);
    }
    
    public function live($market_id) {
        helper('form');
        $live_test = array();
        $o_p = '';
        $c_p = '';
        
         if (isset($_POST['fullsangam_entry_openpana'])) {
            $open_panu = $_POST['fullsangam_entry_openpana'];
            $open_panu_1 = $open_panu;
            $o_p = $open_panu;
            if ($open_panu !== '') {
                $open_digit = 0;
                $rem = 0;
                for ($i = 0; $i <= strlen($open_panu); $i++) {
                    $rem = $open_panu % 10;
                    $open_digit = $open_digit + $rem;
                    $open_panu = $open_panu / 10;
                }
                if (count(str_split("$open_digit")) == 2) {
                    $open_digit = str_split("$open_digit")[1];
                }
                if (count(str_split("$open_digit")) == 1) {
                    $open_digit = str_split("$open_digit")[0];
                }
                $live_test['open_panu'] = $open_panu_1;
                $live_test['open_digit'] = $open_digit;
                $live_test['open_pana_type'] = $this->Market_m->get_pana_type($open_panu_1);
                $live_test['open_digit_amount'] = $this->Market_m->get_digit_test('OPEN', $open_digit,$market_id);
                $live_test['open_pana_amount'] = $this->Market_m->get_pana_test('OPEN', $open_panu_1,$market_id);
                $live_test['open_half_sangam_digit_amount'] = $this->Market_m->get_half_sangam_digit_test('OPEN', $open_digit,$market_id);
                $live_test['open_half_sangam_pana_amount'] = $this->Market_m->get_half_sangam_pana_test('CLOSE', $open_panu_1,$market_id);
                $live_test['open_full_sangam_amount'] = $this->Market_m->get_full_sangam_open_test($open_panu_1, 'fullsangam_entry_openpana',$market_id);
            }
        }
        if (isset($_POST['fullsangam_entry_closepana'])) {
            $close_panu = $_POST['fullsangam_entry_closepana'];
            $close_panu_1 = $close_panu;
            $c_p = $close_panu;
            if ($close_panu !== '') {
                $close_digit = 0;
                $rem = 0;
                for ($i = 0; $i <= strlen($close_panu); $i++) {
                    $rem = $close_panu % 10;
                    $close_digit = $close_digit + $rem;
                    $close_panu = $close_panu / 10;
                }
                if (count(str_split("$close_digit")) == 2) {
                    $close_digit = str_split("$close_digit")[1];
                }
                if (count(str_split("$close_digit")) == 1) {
                    $close_digit = str_split("$close_digit")[0];
                }
                $live_test['close_panu'] = $close_panu_1;
                $live_test['close_digit'] = $close_digit;
                $live_test['close_pana_type'] = $this->Market_m->get_pana_type($close_panu_1);
                $live_test['close_digit_amount'] = $this->Market_m->get_digit_test('CLOSE', $close_digit,$market_id);
                $live_test['close_pana_amount'] = $this->Market_m->get_pana_test('CLOSE', $close_panu_1,$market_id);
                $live_test['close_half_sangam_digit_amount'] = $this->Market_m->get_half_sangam_digit_test('CLOSE', $close_digit,$market_id);
                $live_test['close_half_sangam_pana_amount'] = $this->Market_m->get_half_sangam_pana_test('OPEN', $close_panu_1,$market_id);
                $live_test['close_full_sangam_amount'] = $this->Market_m->get_full_sangam_open_test($close_panu_1, 'fullsangam_entry_closepana',$market_id);
            }
        }
        
        
        
        if ($o_p !== '' && $c_p !== '') {
            $live_test['main_jodi_amount'] = $this->Market_m->get_jodi_test($open_digit . $close_digit,$market_id);
            $live_test['main_half_sangam_open_amount'] = $this->Market_m->get_half_sangam_open_test($open_digit, $c_p,$market_id);
            $live_test['main_half_sangam_close_amount'] = $this->Market_m->get_half_sangam_close_test($o_p, $close_digit,$market_id);
            $live_test['main_full_sangam_amount'] = $this->Market_m->get_full_sangam_main_test($o_p, $c_p,$market_id);
        }
        $data['open_digit_res'] = $this->Market_m->get_digit_result('OPEN',$market_id);
        $data['close_digit_res'] = $this->Market_m->get_digit_result('CLOSE',$market_id);
        $data['open_pana_res'] = $this->Market_m->get_pana_result('OPEN',$market_id);
        $data['close_pana_res'] = $this->Market_m->get_pana_result('CLOSE',$market_id);

        $data['jodi_res'] = $this->Market_m->get_jodi_result($market_id);

        $data['open_half_sangam_res'] = $this->Market_m->get_half_sangam_result('OPEN',$market_id);
        $data['close_half_sangam_res'] = $this->Market_m->get_half_sangam_result('CLOSE',$market_id);

        $data['full_sangam_res'] = $this->Market_m->get_full_sangam_result($market_id);

        $data['pana'] = $this->Market_m->get_all_pana_1();
        $data['live_test_result'] = $live_test;

        //******************tables live 40% aankdo***********//
        $today_result = $this->Market_m->get_today_result($market_id);
        $result_40 = array();
        $total_vepar = 0;

        if (!empty($today_result)) {
            if (!empty($today_result['aankdo_open']) && empty($today_result['aankdo_close'])) {
                foreach ($data['pana'] as $second_pana_row) {
                    $ankdo_40 = array();
                    $open_panu = $today_result['aankdo_open'];
                    $open_panu_1 = $open_panu;
                    $open_digit = 0;
                    $rem = 0;
                    for ($i = 0; $i <= strlen($open_panu); $i++) {
                        $rem = $open_panu % 10;
                        $open_digit = $open_digit + $rem;
                        $open_panu = $open_panu / 10;
                    }
                    if (count(str_split("$open_digit")) == 2) {
                        $open_digit = str_split("$open_digit")[1];
                    }
                    if (count(str_split("$open_digit")) == 1) {
                        $open_digit = str_split("$open_digit")[0];
                    }

                    $close_panu = $second_pana_row['panu'];
                    $close_panu_1 = $close_panu;
                    $close_digit = 0;
                    $rem = 0;
                    for ($i = 0; $i <= strlen($close_panu); $i++) {
                        $rem = $close_panu % 10;
                        $close_digit = $close_digit + $rem;
                        $close_panu = $close_panu / 10;
                    }
                    if (count(str_split("$close_digit")) == 2) {
                        $close_digit = str_split("$close_digit")[1];
                    }
                    if (count(str_split("$close_digit")) == 1) {
                        $close_digit = str_split("$close_digit")[0];
                    }

                    $ankdo_40['open_panu'] = $open_panu_1;
                    $ankdo_40['open_digit'] = $open_digit;
                    $ankdo_40['open_pana_type'] = $this->Market_m->get_pana_type($open_panu_1);
                    $ankdo_40['open_digit_amount'] = $this->Market_m->get_digit_test('OPEN', $open_digit,$market_id);
                    $ankdo_40['open_pana_amount'] = $this->Market_m->get_pana_test('OPEN', $open_panu_1,$market_id);

                    $ankdo_40['close_panu'] = $close_panu_1;
                    $ankdo_40['close_digit'] = $close_digit;
                    $ankdo_40['close_pana_type'] = $this->Market_m->get_pana_type($close_panu_1);
                    $ankdo_40['close_digit_amount'] = $this->Market_m->get_digit_test('CLOSE', $close_digit,$market_id);
                    $ankdo_40['close_pana_amount'] = $this->Market_m->get_pana_test('CLOSE', $close_panu_1,$market_id);

                    $ankdo_40['main_jodi_amount'] = $this->Market_m->get_jodi_test($open_digit . $close_digit,$market_id);
                    $ankdo_40['main_half_sangam_open_amount'] = $this->Market_m->get_half_sangam_open_test($open_digit, $close_panu_1,$market_id);
                    $ankdo_40['main_half_sangam_close_amount'] = $this->Market_m->get_half_sangam_close_test($open_panu_1, $close_digit,$market_id);
                    $ankdo_40['main_full_sangam_amount'] = $this->Market_m->get_full_sangam_main_test($open_panu_1, $close_panu_1,$market_id);

                    $total_amount = 0;
                    if (isset($ankdo_40['open_digit_amount'])) {
                        if (!empty($ankdo_40['open_digit_amount'])) {
                            $total_amount = $total_amount + ($ankdo_40['open_digit_amount']['totalprice'] * DIGIT_AMOUNT);
                        }
                    }
                    if (isset($ankdo_40['close_digit_amount'])) {
                        if (!empty($ankdo_40['close_digit_amount'])) {
                            $total_amount = $total_amount + ($ankdo_40['close_digit_amount']['totalprice'] * DIGIT_AMOUNT);
                        }
                    }
                    if (isset($ankdo_40['open_pana_amount'])) {
                        if (!empty($ankdo_40['open_pana_amount'])) {
                            if ($ankdo_40['open_pana_type']['pana_type'] == "SP") {
                                $open_pana_amount = $ankdo_40['open_pana_amount']['totalprice'] * SP_AMOUNT;
                            }
                            if ($ankdo_40['open_pana_type']['pana_type'] == "DP") {
                                $open_pana_amount = $ankdo_40['open_pana_amount']['totalprice'] * DP_AMOUNT;
                            }
                            if ($ankdo_40['open_pana_type']['pana_type'] == "TP") {
                                $open_pana_amount = $ankdo_40['open_pana_amount']['totalprice'] * TP_AMOUNT;
                            }
                            $total_amount = $total_amount + $open_pana_amount;
                        }
                    }
                    if (isset($ankdo_40['close_pana_amount'])) {
                        if (!empty($ankdo_40['close_pana_amount'])) {
                            if ($ankdo_40['close_pana_type']['pana_type'] == "SP") {
                                $close_pana_amount = $ankdo_40['close_pana_amount']['totalprice'] * SP_AMOUNT;
                            }
                            if ($ankdo_40['close_pana_type']['pana_type'] == "DP") {
                                $close_pana_amount = $ankdo_40['close_pana_amount']['totalprice'] * DP_AMOUNT;
                            }
                            if ($ankdo_40['close_pana_type']['pana_type'] == "TP") {
                                $close_pana_amount = $ankdo_40['close_pana_amount']['totalprice'] * TP_AMOUNT;
                            }
                            $total_amount = $total_amount + $close_pana_amount;
                        }
                    }
                    if (isset($ankdo_40['main_jodi_amount'])) {
                        if (!empty($ankdo_40['main_jodi_amount'])) {
                            $total_amount = $total_amount + ($ankdo_40['main_jodi_amount']['totalprice'] * JODI_AMOUNT);
                        }
                    }
                    if (isset($ankdo_40['main_half_sangam_open_amount'])) {
                        if (!empty($ankdo_40['main_half_sangam_open_amount'])) {
                            $total_amount = $total_amount + ($ankdo_40['main_half_sangam_open_amount']['totalprice'] * HALF_SANGAM_AMOUNT);
                        }
                    }
                    if (isset($ankdo_40['main_half_sangam_close_amount'])) {
                        if (!empty($ankdo_40['main_half_sangam_close_amount'])) {
                            $total_amount = $total_amount + ($ankdo_40['main_half_sangam_close_amount']['totalprice'] * HALF_SANGAM_AMOUNT);
                        }
                    }
                    if (isset($ankdo_40['main_full_sangam_amount'])) {
                        if (!empty($ankdo_40['main_full_sangam_amount'])) {
                            $total_amount = $total_amount + ($ankdo_40['main_full_sangam_amount']['totalprice'] * SANGAM_AMOUNT);
                        }
                    }
                    $ankdo_40['total_amount'] = $total_amount;
                    array_push($result_40, $ankdo_40);
                }
            }
        } 
        else {            
            $result_40=array();
            $open_digit_result=$data['open_digit_res'];            
            $open_pana_result=$data['open_pana_res'];            
            $jodi_result=$data['jodi_res'];                
            $open_half_sangam_result=$data['open_half_sangam_res'];  
            $close_half_sangam_res=$data['close_half_sangam_res'];                    
            $full_sangam_result=$data['full_sangam_res'];                                                    
            foreach ($data['pana'] as $pana_row) {
                $dummy_array=array();
                $open_panu = $pana_row['panu'];
                $open_panu_1 = $open_panu;
                $open_digit = 0;
                $rem = 0;
                for ($i = 0; $i <= strlen($open_panu); $i++) {
                    $rem = $open_panu % 10;
                    $open_digit = $open_digit + $rem;
                    $open_panu = $open_panu / 10;
                }
                if (count(str_split("$open_digit")) == 2) {
                    $open_digit = str_split("$open_digit")[1];
                }
                if (count(str_split("$open_digit")) == 1) {
                    $open_digit = str_split("$open_digit")[0];
                }
                $dummy_array['open_panu'] = $open_panu_1;
                $dummy_array['open_digit'] = $open_digit;                                           
                $dummy_array['open_pana_price']=0;
                $dummy_array['open_digit_price']=0;   
                
                $total_amount = 0;                
                if(!empty($open_pana_result)){
                    foreach ($open_pana_result as $row){                       
                        if($row['pana_entry_num']==$open_panu_1){                           
                            if ($pana_row['pana_type'] == "SP") {
                                $dummy_array['open_pana_price']=$row['totalprice'] * SP_AMOUNT;
                            }
                            if ($pana_row['pana_type'] == "DP") {
                                $dummy_array['open_pana_price']=$row['totalprice'] * DP_AMOUNT;
                            }
                            if ($pana_row['pana_type'] == "TP") {
                                $dummy_array['open_pana_price']=$row['totalprice'] * TP_AMOUNT;
                            }                                                        
                        }
                    }
                } 
                if(!empty($open_digit_result)){
                    foreach ($open_digit_result as $row){
                        if($row['digit_entry_num']==$open_digit){
                            $dummy_array['open_digit_price']=$row['totalprice'] * DIGIT_AMOUNT;
                        }
                    }
                }
                $dummy_array['total_amount']=$dummy_array['open_digit_price']+$dummy_array['open_pana_price'];
                array_push($result_40, $dummy_array);
            }
        }
        $get_digit_total_vepar = $this->Market_m->get_digit_total_vepar($market_id);
        $get_pana_total_vepar = $this->Market_m->get_pana_total_vepar($market_id);
        $get_jodi_total_vepar = $this->Market_m->get_jodi_total_vepar($market_id);
        $get_half_sangam_total_vepar = $this->Market_m->get_half_sangam_total_vepar($market_id);
        $get_full_sangam_total_vepar = $this->Market_m->get_full_sangam_total_vepar($market_id);

        if (!empty($get_digit_total_vepar)) {
            $total_vepar = $total_vepar + $get_digit_total_vepar['totalprice'];
        }
        if (!empty($get_pana_total_vepar)) {
            $total_vepar = $total_vepar + $get_pana_total_vepar['totalprice'];
        }
        if (!empty($get_jodi_total_vepar)) {
            $total_vepar = $total_vepar + $get_jodi_total_vepar['totalprice'];
        }
        if (!empty($get_half_sangam_total_vepar)) {
            $total_vepar = $total_vepar + $get_half_sangam_total_vepar['totalprice'];
        }
        if (!empty($get_full_sangam_total_vepar)) {
            $total_vepar = $total_vepar + $get_full_sangam_total_vepar['totalprice'];
        }
        $data['total_vepar'] = $total_vepar;
        $data['result_40'] = $result_40;
     
        $data['market_id']=$market_id;
        $data['title'] = ADMIN_LIVE_TITLE;
        echo main_admin_view('mainadmin/live', $data);
    }
                
    public function add_aankdo($market_id) {
        helper('form');
        $market = $this->Market_m->get_marketby_id($market_id);
        $aankdo = $this->Area_m->get_aankdo(date("Y-m-d"), $market_id);
        if (isset($_POST['aankdo_open'])) {
            $params = array();
            $params['aankdo_open'] = $_POST['aankdo_open'];
            if (isset($_POST['aankdo_close'])) {
                $params['aankdo_close'] = $_POST['aankdo_close'];
            }
            $params['aankdo_date'] = date("Y-m-d");
            $params['refMarket_id'] = $market_id;
            if (!empty($aankdo)) {
                $res = $this->Area_m->update_aankdo($params, $aankdo->aankdo_id);
            } else {
                $res = $this->Area_m->add_aankdo($params);
            }
            if ($res) {
                $deletedata = $this->Area_m->deletedata($market_id, date("Y-m-d"));
                if (!empty($_POST['aankdo_open'])) {
                    $open_panu = $_POST['aankdo_open'];
                    $open_digit = 0;
                    $digit_char = str_split("$open_panu");
                    $open_digit = $digit_char[0] + $digit_char[1] + $digit_char[2];
                    if (count(str_split("$open_digit")) == 2) {
                        $open_digit = str_split("$open_digit")[1];
                    }
                    if (count(str_split("$open_digit")) == 1) {
                        $open_digit = str_split("$open_digit")[0];
                    }
                    $copy_win_res_open = $this->Area_m->copy_win_res_open($market_id, date("Y-m-d"),$open_panu,$open_digit);
                }
                if (isset($_POST['aankdo_close']) && !empty($_POST['aankdo_close'])) {                                        
                    $close_panu = $_POST['aankdo_close'];
                    $close_digit = 0;
                    $digit_char = str_split("$close_panu");
                    $close_digit = $digit_char[0] + $digit_char[1] + $digit_char[2];
                    if (count(str_split("$close_digit")) == 2) {
                        $close_digit = str_split("$close_digit")[1];
                    }
                    if (count(str_split("$close_digit")) == 1) {
                        $close_digit = str_split("$close_digit")[0];
                    }                    
                    $jodi=$open_digit.$close_digit;                    
                    $copy_win_res_close = $this->Area_m->copy_win_res_close($market_id, date("Y-m-d"),$close_panu,$close_digit,$open_panu,$open_digit,$jodi);
                }

                successOrErrorMessage("Aankdo Added Successfully", 'success');
                return redirect()->to(MAIN_ADMIN_ADD_AANKDO_LINK . $market_id);
            } else {
                successOrErrorMessage("Somthing happen wrong", 'error');
            }
        }
        $data['pana'] = $this->Market_m->get_all_pana();
        $data['aankdo'] = $aankdo;
        $data['market'] = $market;
        $data['market_id'] = $market_id;
        $data['title'] = ADMIN_ADD_AANKDO_TITLE;
        echo main_admin_view('mainadmin/addaankdo', $data);
    }

    public function update_profile() {
        $result = array();
        if (isset($_POST['user_current_password']) && $_POST['user_current_password'] != '') {
            if ($this->Login_m->check_current_password($_POST['user_current_password'])) {
                $res = $this->Login_m->update_password($_POST);
                if ($res) {
                    successOrErrorMessage("Password changed successfully", 'success');
                    $result['success'] = "success";
                }
            } else {
                $result['success'] = "fail";
            }
            echo json_encode($result);
            die;
        }
        helper('form');
        $data['title'] = ADMIN_UPDATE_PROFILE_TITLE;
        echo main_admin_view('mainadmin/update_profile', $data);
    }

    public function accept_payment($topup_id) {

        $res = $this->Admin_m->update_topup($topup_id);
        if ($res) {
            $result = $this->Admin_m->update_wallet($res['amount'], $res['refUser_id']);
            successOrErrorMessage("Updated successfully", 'success');
        } else {
            successOrErrorMessage("somthing wrong", 'error');
        }
        return redirect()->to(MAIN_ADMIN_PAYMENT_LIST_LINK);
    }

    public function payment() {
        $data['title'] = ADMIN_PAYMNET_LIST_TITLE;
        echo main_admin_view('mainadmin/payment_list', $data);
    }

    public function payment_list() {
        $list = $this->Admin_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $datarow) {
            $topup_id = $datarow->topup_id;

            $img = "<a href='" . UPLOAD_FOLDER . "original/" . $datarow->screen_shot . "' target='_blank'>View</a>";

            $accept = "";
            if ($datarow->status == 0) {
                $accept = "<a href='" . MAIN_ADMIN_ACCEPT_PAYMENT_LINK . $datarow->topup_id . "' class='btn btn-sm btn-primary'>Accept</a>";
            }
            if($datarow->status==1){
                $accept="<span class='badge badge-success'>Accepted</span>";
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->topup_id;
            $row[] = $datarow->mobile;
            $row[] = $datarow->amount;
            $row[] = $datarow->upload_date;
            $row[] = $accept;
            $row[] = $img;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_m->count_all(),
            "recordsFiltered" => $this->Admin_m->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    
    public function accept_withdrawal($withdrawal_id) {
        $res = $this->Withdrawal_m->accept_withdrawal($withdrawal_id);
     
        if ($res) {           
            successOrErrorMessage("Updated successfully", 'success');
        } else {
            successOrErrorMessage("somthing wrong", 'error');
        }
        return redirect()->to(MAIN_ADMIN_WITHDRAWAL_LIST_LINK);
    }
    
    
    public function reject_withdrawal($withdrawal_id) {       
        $res = $this->Withdrawal_m->reject_withdrawal($withdrawal_id);
     
        if ($res) {           
            successOrErrorMessage("Updated successfully", 'success');
        } else {
            successOrErrorMessage("somthing wrong", 'error');
        }
        return redirect()->to(MAIN_ADMIN_WITHDRAWAL_LIST_LINK);
    }
    
    

    public function withdrawal() {
        $data['title'] = ADMIN_WITHDRAWAL_LIST_TITLE;
        echo main_admin_view('mainadmin/withdrawal_list', $data);
    }
    public function withdrawal_list() {
        $list = $this->Withdrawal_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $datarow) {
            $withdrawal_id = $datarow->withdrawal_id;            
            $accept = "";
            if ($datarow->status == 2) {
                $accept = "<a href='" . MAIN_ADMIN_ACCEPT_WITHDRAWAL_LINK . $datarow->withdrawal_id . "' class='btn btn-sm btn-primary'>Accept</a>&nbsp;<a href='" . MAIN_ADMIN_REJECT_WITHDRAWAL_LINK . $datarow->withdrawal_id . "' class='btn btn-sm btn-warning'>Reject</a>";
            }
            if($datarow->status==1){
                $accept="<span class='badge badge-success'>Accepted</span>";
            }
            if($datarow->status==0){
                $accept="<span class='badge badge-danger'>Rejected</span>";
            }
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $datarow->mobile;
            $row[] = $datarow->amount;
            $row[] = $datarow->req_date;
            $row[] = $accept;           
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_m->count_all(),
            "recordsFiltered" => $this->Admin_m->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
