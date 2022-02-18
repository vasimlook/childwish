<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Projects_model extends Model {
    
    protected $db;
    protected $session;   
    public function __construct() {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }

    public function get_projects(){

        $project = $this->db->query("SELECT *
                                    FROM   donation_projects
                                    WHERE  Date(amount_end_date) >= Date(Now())
                                        AND projects_status = 1 ");
        $projects = $project->getResultArray();      
        return $projects;
        
    }   

    public function update_projects_donation($projects_id , $receivedAmount){        
        $result = $this->db->query("UPDATE donation_projects SET received_amount = received_amount + {$receivedAmount} WHERE projects_id  = {$projects_id} ");                                               
        return $result;
    }
   
   
   
}
