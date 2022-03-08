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

    public function get_projects_details($projectsId){
        $details = array();
        $projectsId = (int)$projectsId;

        if($projectsId === 0)
            return $details;
         
        $projects = $this->db->query("SELECT *
                                        FROM   donation_projects
                                    WHERE projects_id = {$projectsId} ");
        $projects_details = $projects->getRowArray();      

        return $projects_details;    

    }
    
    public function create_projects($params) {
        $params['amount_start_date'] = date("Y-m-d", strtotime($params['amount_start_date']));
        $params['amount_end_date'] = date("Y-m-d", strtotime($params['amount_end_date']));         
        $builder = $this->db->table('donation_projects');
        $builder->insert($params);
        return $this->db->insertID();
    }

    public function update_projects($params,$projectsId){
        $params['amount_start_date'] = date("Y-m-d", strtotime($params['amount_start_date']));
        $params['amount_end_date'] = date("Y-m-d", strtotime($params['amount_end_date']));
        $builder = $this->db->table('donation_projects');
        $builder->where('projects_id', $projectsId);
        return $builder->update($params);
    }
   
}
