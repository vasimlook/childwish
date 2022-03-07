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
        $params['amount_start_date'] = date("Y-m-d", strtotime($params['amount_start_date']));
        $params['amount_end_date'] = date("Y-m-d", strtotime($params['amount_end_date']));         
        $builder = $this->db->table('donation_projects');
        $builder->insert($params);
        return $this->db->insertID();
    }
   
}