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
        $params['projects_status'] = 1;
        $params['created_at'] = date("Y-m-d H:i:s");
        $params['created_by'] = (int)$_SESSION['admin']['admin_user_id'];
        $builder = $this->db->table('donation_projects');
        $builder->insert($params);
        return $this->db->insertID();
    }

    public function add_projects_images($params) {       
        $builder = $this->db->table('donation_projects_images');
        $builder->insert($params);
        return $this->db->insertID();
    }

    public function get_projects_images($projectsId){
        $images = array();
        $projectsId = (int)$projectsId;

        if($projectsId === 0)
            return $images;
         
        $projects = $this->db->query("SELECT *
                                        FROM   donation_projects_images
                                    WHERE projects_id = {$projectsId} ");
        $projects_images = $projects->getResultArray();      

        return $projects_images;  
    }

    public function update_projects($params,$projectsId){
        $params['amount_start_date'] = date("Y-m-d", strtotime($params['amount_start_date']));
        $params['amount_end_date'] = date("Y-m-d", strtotime($params['amount_end_date']));
        $params['updated_at'] = date("Y-m-d H:i:s");
        $params['created_by'] = (int)$_SESSION['admin']['admin_user_id'];
        $builder = $this->db->table('donation_projects');
        $builder->where('projects_id', $projectsId);
        return $builder->update($params);
    }

    public function delete_projects_image($imageId){
        $imageId = (int)$imageId;

        if($imageId === 0)
            return false;
        
        $builder = $this->db->table('donation_projects_images');
        $builder->where('image_id', $imageId);
        
        $builder->delete();     
        return true;
    }

    public function update_projects_status($projects_status,$projects_id){
        $projects_id = (int)$projects_id;

        if($projects_id === 0)
            return false;

        $params['projects_status'] = (int)$projects_status;
        $builder = $this->db->table('donation_projects');
        $builder->where('projects_id', $projects_id);
        return $builder->update($params);
        
    }
   
}
