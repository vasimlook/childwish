<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Donation_model extends Model {
    
    protected $db;
    protected $session;   
    public function __construct() {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }  
    
    public function create_order($orders_data){
        $orders = $this->db->table('child_wish_donation');
        $orders->insert($orders_data);
        return $this->db->insertID();
    }

    public function update_donation($razer_orders_id,$donationData){
        $builder = $this->db->table('child_wish_donation');
        $builder->where('razer_orders_id', $razer_orders_id);        
        return $builder->update($donationData);
    }   
}
