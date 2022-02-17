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

        $project = $this->db->table('donation_projects');       
        $project->where('projects_status','1');
        $query =  $project->get();
        $projects = $query->getResult();       
        return $projects;
        
    }   
   
   
}
