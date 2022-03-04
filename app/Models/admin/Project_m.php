<?php namespace App\Models\admin;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
class Project_m extends Model{
    protected $db;
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }  
    
    public function create_projects($params) {
        $builder = $this->db->table('donation_projects');
        $builder->insert($params);
        return $this->db->insertID();
    }
   
}
