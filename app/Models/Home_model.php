<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Home_model extends Model {
    
    protected $db;
    protected $session;   
    public function __construct() {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }

    public function get_donor_testimonials(){

        $testimonial = $this->db->query("SELECT *
                                    FROM   donor_testimonials
                                    WHERE is_active = 1 ");
        $testimonials = $testimonial->getResultArray();      
        return $testimonials;
        
    } 
   
}
