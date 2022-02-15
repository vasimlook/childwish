<?php

namespace App\Models\Madmin;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Area_m extends Model {

    protected $db;
    protected $session;
    var $table = 'area';
    var $column_order = array(null, 'area_name');
    var $column_search = array('area_name');
    var $order = array('area_id' => 'desc'); // default order 

    public function __construct() {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }
    public function _get_datatables_query($builder) {
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $builder->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $builder->like($item, $_POST['search']['value']);
                } else {
                    $builder->orLike($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $builder->groupEnd(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing
            $builder->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $builder->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $builder = $this->db->table($this->table);
        $builder->where('refAgent_id', $_SESSION['admin']['admin_id']);
        $this->_get_datatables_query($builder);
        if ($_POST['length'] != -1)
            $builder->limit($_POST['length'], $_POST['start']);
        $query = $builder->get();
        return $query->getResult();
    }

    function count_filtered() {
        $builder = $this->db->table($this->table);
        $builder->where('refAgent_id', $_SESSION['admin']['admin_id']);
        $this->_get_datatables_query($builder);
        return $builder->countAllResults();
    }
    public function count_all() {
        $builder = $this->db->table($this->table);
        $builder->where('refAgent_id', $_SESSION['admin']['admin_id']);
        return $builder->countAllResults();
    }
    public function add_area($params) {
        $builder = $this->db->table('area');
        $builder->insert($params);
        return $this->db->insertID();
    }
    public function add_single_digt($params) {
        $builder = $this->db->table('digit_entry');
        $builder->insert($params);
        return $this->db->insertID();
    }
    public function add_single_pana($params) {
        $builder = $this->db->table('pana_entry');
        $builder->insert($params);
        return $this->db->insertID();
    }
    public function add_jodi($params) {
        $builder = $this->db->table('jodi_entry');
        $builder->insert($params);
        return $this->db->insertID();
    }
     public function add_half_sangam($params) {
        $builder = $this->db->table('halfsangam_entry');
        $builder->insert($params);
        return $this->db->insertID();
    }
    public function add_full_sangam($params) {
        $builder = $this->db->table('fullsangam_entry');
        $builder->insert($params);
        return $this->db->insertID();
    }
    function get_area() {
        $builder = $this->db->table('area');
        $builder->where('refAgent_id', $_SESSION['admin']['admin_id']);        
        $query = $builder->get();
        return $query->getResult();
    }
    function get_agent_list() {
        $builder = $this->db->table('master_admin');
        $builder->where('user_type','AGENT');        
        $query = $builder->get();
        return $query->getResult();
    }
    function get_aankdo($date,$market_id) {
        $builder = $this->db->table('aankdo');
        $builder->where('DATE(aankdo_date)', $date); 
        $builder->where('refMarket_id', $market_id);         
        $query = $builder->get();
        return $query->getRow();
    }
    
    function get_bank_details($user_id) {
        $builder = $this->db->table('master_admin');
        $builder->where('admin_id', $user_id); 
        $builder->where('user_type','USER');
        $query = $builder->get();
        return $query->getRowArray();
    }
    
    function get_wallet_by_user($refUser_id) {        
        $cntWallet = $this->db->query("SELECT SUM(amount) as amount FROM `wallet` WHERE refUser_id= '$refUser_id'");                        
        $cntWallet1 = $cntWallet->getRowArray();       
        return $cntWallet1;
    }   
    
    public function update_wallet_minus($refUserid,$amount) {                                             
        $result = $this->db->query("UPDATE wallet SET amount = amount - $amount WHERE refUser_id = '$refUserid' ");                                               
        return $result;
    }
    
    public function add_aankdo($params) {
        $builder = $this->db->table('aankdo');
        $builder->insert($params);
        return $this->db->insertID();
    } 
    public function update_aankdo($params,$aankdo_id) {
        $builder = $this->db->table('aankdo');
        $builder->where('aankdo_id', $aankdo_id);
        return $builder->update($params);
    }
    
    public function update_bank($params,$user_id) {     
        $builder = $this->db->table('master_admin');
        $builder->where('admin_id', $user_id);
        $builder->where('user_type','USER');
        return $builder->update($params);
    }
    
    
    function add_single_digt_batch($params){
        $builder = $this->db->table('digit_entry');
        return $builder->insertBatch($params);                 
    }
    function add_single_pana_batch($params){
        $builder = $this->db->table('pana_entry');
        return $builder->insertBatch($params);                 
    }
    function add_single_jodi_batch($params){
        $builder = $this->db->table('jodi_entry');
        return $builder->insertBatch($params);                 
    }
    function add_single_halfsangam_batch($params){
        $builder = $this->db->table('halfsangam_entry');
        return $builder->insertBatch($params);                 
    }
    function add_single_fullsangam_batch($params){
        $builder = $this->db->table('fullsangam_entry');
        return $builder->insertBatch($params);                 
    } 
    
    function deletedata($market_id,$date){
        $builder = $this->db->table('digit_entry_win');
        $builder->where('refMarket_id', $market_id);
        $builder->where('digit_entry_date', $date); 
        $builder->delete();  
        
        $builder = $this->db->table('pana_entry_win');
        $builder->where('refMarket_id', $market_id);
        $builder->where('pana_entry_date', $date); 
        $builder->delete(); 
        
        $builder = $this->db->table('jodi_entry_win');
        $builder->where('refMarket_id', $market_id);
        $builder->where('jodi_entry_date', $date); 
        $builder->delete(); 
        
        $builder = $this->db->table('halfsangam_entry_win');
        $builder->where('refMarket_id', $market_id);
        $builder->where('halfsangam_entry_date', $date); 
        $builder->delete(); 
        
        $builder = $this->db->table('fullsangam_entry_win');
        $builder->where('refMarket_id', $market_id);
        $builder->where('fullsangam_entry_date', $date); 
        $builder->delete(); 
        
        return true;
    }
    
    function copy_win_res_open($market_id,$date,$open_panu,$open_digit){  
        $digit_insert = $this->db->query("INSERT INTO digit_entry_win 
                (digit_entry_type,digit_entry_num,digit_entry_date,digit_entry_price,refAgent_id,refUser_id,refMarket_id) 
                SELECT digit_entry_type,digit_entry_num,digit_entry_date,digit_entry_price,refAgent_id,refUser_id,refMarket_id 
                FROM digit_entry WHERE digit_entry_type='OPEN' AND refMarket_id=$market_id AND digit_entry_date='$date' AND digit_entry_num=$open_digit");  
        
        $pana_insert = $this->db->query("INSERT INTO pana_entry_win 
                (pana_entry_type,pana_entry_num,pana_entry_date,pana_entry_price,refAgent_id,refUser_id,refMarket_id) 
                SELECT pana_entry_type,pana_entry_num,pana_entry_date,pana_entry_price,refAgent_id,refUser_id,refMarket_id 
                FROM pana_entry WHERE pana_entry_type='OPEN' AND refMarket_id=$market_id AND pana_entry_date='$date' AND pana_entry_num=$open_panu");                  
        return true;
    }
    function copy_win_res_close($market_id,$date,$close_panu,$close_digit,$open_panu,$open_digit,$jodi){  
        $digit_insert = $this->db->query("INSERT INTO digit_entry_win 
                (digit_entry_type,digit_entry_num,digit_entry_date,digit_entry_price,refAgent_id,refUser_id,refMarket_id) 
                SELECT digit_entry_type,digit_entry_num,digit_entry_date,digit_entry_price,refAgent_id,refUser_id,refMarket_id 
                FROM digit_entry WHERE digit_entry_type='CLOSE' AND refMarket_id=$market_id AND digit_entry_date='$date' AND digit_entry_num=$close_digit");  
                
        $pana_insert = $this->db->query("INSERT INTO pana_entry_win 
                (pana_entry_type,pana_entry_num,pana_entry_date,pana_entry_price,refAgent_id,refUser_id,refMarket_id) 
                SELECT pana_entry_type,pana_entry_num,pana_entry_date,pana_entry_price,refAgent_id,refUser_id,refMarket_id 
                FROM pana_entry WHERE pana_entry_type='CLOSE' AND refMarket_id=$market_id AND pana_entry_date='$date' AND pana_entry_num=$close_panu");  
                
        $jodi_insert = $this->db->query("INSERT INTO jodi_entry_win 
                (jodi_entry_num,jodi_entry_date,jodi_entry_price,refAgent_id,refUser_id,refMarket_id) 
                SELECT jodi_entry_num,jodi_entry_date,jodi_entry_price,refAgent_id,refUser_id,refMarket_id 
                FROM jodi_entry WHERE refMarket_id=$market_id AND jodi_entry_date='$date' AND jodi_entry_num=$close_panu"); 
        
        $halfsangam_insert_o = $this->db->query("INSERT INTO halfsangam_entry_win 
                (halfsangam_entry_type,halfsangam_entry_num,halfsangam_entry_pana,halfsangam_entry_date,halfsangam_entry_price,refAgent_id,refUser_id,refMarket_id) 
                SELECT halfsangam_entry_type,halfsangam_entry_num,halfsangam_entry_pana,halfsangam_entry_date,halfsangam_entry_price,refAgent_id,refUser_id,refMarket_id 
                FROM halfsangam_entry WHERE refMarket_id=$market_id AND halfsangam_entry_date='$date' AND halfsangam_entry_type='OPEN' AND halfsangam_entry_num=$open_digit AND halfsangam_entry_pana=$close_panu"); 
        
        $halfsangam_insert_c = $this->db->query("INSERT INTO halfsangam_entry_win 
                (halfsangam_entry_type,halfsangam_entry_num,halfsangam_entry_pana,halfsangam_entry_date,halfsangam_entry_price,refAgent_id,refUser_id,refMarket_id) 
                SELECT halfsangam_entry_type,halfsangam_entry_num,halfsangam_entry_pana,halfsangam_entry_date,halfsangam_entry_price,refAgent_id,refUser_id,refMarket_id 
                FROM halfsangam_entry WHERE refMarket_id=$market_id AND halfsangam_entry_date='$date' AND halfsangam_entry_type='CLOSE' AND halfsangam_entry_num=$open_panu AND halfsangam_entry_pana=$close_digit"); 
        
        $fullsangam_insert = $this->db->query("INSERT INTO fullsangam_entry_win 
                (fullsangam_entry_openpana,fullsangam_entry_closepana,fullsangam_entry_date,fullsangam_entry_price,refAgent_id,refUser_id,refMarket_id) 
                SELECT fullsangam_entry_openpana,fullsangam_entry_closepana,fullsangam_entry_date,fullsangam_entry_price,refAgent_id,refUser_id,refMarket_id 
                FROM fullsangam_entry WHERE refMarket_id=$market_id AND fullsangam_entry_date='$date' AND fullsangam_entry_openpana=$open_panu AND fullsangam_entry_closepana=$close_panu");         
        return true;
    }  
    
    
    function get_win_amount_by_user($user_id){  
        $cntDigit = $this->db->query("SELECT SUM(digit_entry_price) AS total_amount FROM `digit_entry_win` WHERE refUser_id= '$user_id'");                        
        $cntDigit1 = $cntDigit->getRowArray();
        
        $cntPana = $this->db->query("SELECT SUM(pana_entry_price) AS total_amount FROM `pana_entry_win` WHERE refUser_id= '$user_id'");                        
        $cntPana1 = $cntPana->getRowArray();
        
        $cntJodi = $this->db->query("SELECT SUM(jodi_entry_price) AS total_amount FROM `jodi_entry_win` WHERE refUser_id= '$user_id'");                        
        $cntJodi1 = $cntJodi->getRowArray();
        
        $cntHP = $this->db->query("SELECT SUM(halfsangam_entry_price) AS total_amount FROM `halfsangam_entry_win` WHERE refUser_id= '$user_id'");                        
        $cntHP1 = $cntHP->getRowArray();
        
        $cntFP = $this->db->query("SELECT SUM(fullsangam_entry_price) AS total_amount FROM `fullsangam_entry_win` WHERE refUser_id= '$user_id'");                        
        $cntFP1 = $cntFP->getRowArray(); 
        
        return $cntDigit1['total_amount']+$cntPana1['total_amount']+$cntJodi1['total_amount']+$cntHP1['total_amount']+$cntFP1['total_amount'];
    }
    
    
    function get_played_amount_by_user($user_id){  
        $cntDigit = $this->db->query("SELECT SUM(digit_entry_price) AS total_amount FROM `digit_entry` WHERE refUser_id= '$user_id'");                        
        $cntDigit1 = $cntDigit->getRowArray();
        
        $cntPana = $this->db->query("SELECT SUM(pana_entry_price) AS total_amount FROM `pana_entry` WHERE refUser_id= '$user_id'");                        
        $cntPana1 = $cntPana->getRowArray();
        
        $cntJodi = $this->db->query("SELECT SUM(jodi_entry_price) AS total_amount FROM `jodi_entry` WHERE refUser_id= '$user_id'");                        
        $cntJodi1 = $cntJodi->getRowArray();
        
        $cntHP = $this->db->query("SELECT SUM(halfsangam_entry_price) AS total_amount FROM `halfsangam_entry` WHERE refUser_id= '$user_id'");                        
        $cntHP1 = $cntHP->getRowArray();
        
        $cntFP = $this->db->query("SELECT SUM(fullsangam_entry_price) AS total_amount FROM `fullsangam_entry` WHERE refUser_id= '$user_id'");                        
        $cntFP1 = $cntFP->getRowArray(); 
        
        return $cntDigit1['total_amount']+$cntPana1['total_amount']+$cntJodi1['total_amount']+$cntHP1['total_amount']+$cntFP1['total_amount'];
    }
    
    function get_withdrawal_amount_by_user($user_id){  
        $cntWithdrawal = $this->db->query("SELECT SUM(amount) AS total_amount FROM `withdrawal` WHERE refUser_id= '$user_id' AND (status=1 OR status=2)");                        
        $cntWithdrawal1 = $cntWithdrawal->getRowArray();       
        return $cntWithdrawal1['total_amount']+0;
    }
    
    function get_withdrawal_list($user_id) {
        $builder = $this->db->table('withdrawal');
        $builder->where('refUser_id',$user_id);        
        $query = $builder->get();
        return $query->getResultArray();
    }
}
