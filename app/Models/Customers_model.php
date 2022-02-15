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
   
}
