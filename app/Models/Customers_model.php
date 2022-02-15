<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Customers_model extends Model {
    
    protected $db;
    protected $session;   
    public function __construct() {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }

    public function create_customers($customersData){
        $customer = $this->db->table('child_wish_customers');
        $customer->insert($customersData);
        return $this->db->insertID();
    }

    public function customers_exist($email_address){

        $customer = $this->db->table('child_wish_customers');
        $customer->where('email', $email_address);         
        $query = $customer->get();

        $customers = $query->getRowArray();

        if(is_array($customers) && sizeof($customers) > 0 && $customers['customers_id']){

            return array(
                'exist'=> true,
                'customers_id' => $customers['customers_id']
            );            
        }

        return array(
            'exist' => false,
        );       
        
    }   

    public function update_customers($customers_id,$customersData){
        $builder = $this->db->table('child_wish_customers');
        $builder->where('customers_id', $customers_id);        
        return $builder->update($customersData);
    }
   
}
