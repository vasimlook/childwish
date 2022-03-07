<?php

namespace App\Controllers;
use App\Models\admin\Project_m;
use App\Models\admin\Login_m;
class Admin_projects_c extends BaseController{
    private $Project_m;
    private $Login_m; 
    private $security;     
    protected $session;
    public function __construct() {   
        $this->session = \Config\Services::session();
        $this->session->start(); 
        helper('url');
        helper('functions');
        $this->Project_m = new Project_m();
        $this->Login_m = new Login_m(); 
        $this->security = \Config\Services::security();        
        sessionCheckAdmin();                   
        if (isset($_SESSION['admin']['admin_user_id'])) {            
                $result = $this->Login_m->getTokenAndCheck('admin', $_SESSION['admin']['admin_user_id']);
                if ($result) {
                    $token = $result['token'];
                    if ($_SESSION['admin']['admin_tokencheck'] != $token) {                                                                       
                            logoutUser('admin');
                            header('Location: ' . ADMIN_LOGIN_LINK);
                            exit();                        
                    }   
                }else{
                    logoutUser('admin');
                    header('Location: ' . ADMIN_LOGIN_LINK);
                    exit();
                } 
            
        }                      
    }
    public function create_project(){ 
        
        $has_error = false;
        $error_messages  = array();

        $projects_details = array();        

        if(isset($_POST['projects_title']) && 
           isset($_POST['projects_description']) &&
           isset($_FILES['projects_image'])){
               $projects_title = trim($_POST['projects_title']);
               $projects_description = trim($_POST['projects_description']);
               $target_amount = (float)trim($_POST['target_amount']);
               $amount_start_date = trim($_POST['amount_start_date']);
               $amount_end_date = trim($_POST['amount_end_date']);


               $main_img = singleImageUpload('projects_image');
               $projectsImage = $main_img[2]['file_name'];

               if(empty($projectsImage) || $projectsImage == ''){
                 $has_error = true;
                 $error_messages[] = "Please select projects image!";
               }else{
                $projects_details['projects_image'] = $projectsImage;
               }
              

               if(empty($projects_title) || $projects_title == ''){
                    $has_error = true;
                    $error_messages[] = "Projects title can not be empty!";
               }else{
                   $projects_details['projects_title'] = $projects_title;
               }

               if(empty($projects_description) || $projects_description == ''){
                $has_error = true;
                $error_messages[] = "Projects descriptions can not be empty!";
               }else{
                $projects_details['projects_description'] = $projects_description;
               }


              if(empty($target_amount) || $target_amount == '' || $target_amount <= 0){
                $has_error = true;
                $error_messages[] = "Target amount can not be empty!";
              }else{
                $projects_details['target_amount'] = $target_amount;
               }

              if(empty($amount_start_date) || $amount_start_date == ''){
                $has_error = true;
                $error_messages[] = "Start date can not be empty!";
              }else{
                $projects_details['amount_start_date'] = $amount_start_date;
               }

              if(empty($amount_end_date) || $amount_end_date == ''){
                $has_error = true;
                $error_messages[] = "End date can not be empty!";
              }else{
                $projects_details['amount_end_date'] = $amount_end_date;
               }

               if(isset($_POST['urgent_need']) && $_POST['urgent_need'] == "on"){
                $projects_details['urgent_need'] = 1;
               }
           }

           if(!$has_error && (is_array($projects_details) && sizeof($projects_details) > 0)){
               //create projects

               $projectsId = $this->Project_m->create_projects($projects_details);

               if($projectsId){
                successOrErrorMessage("Projects has been successfully created", 'success');
                return redirect()->to(ADMIN_VIEW_PROJECT_LINK);
               }
           }else if(is_array($error_messages) && sizeof($error_messages) > 0){                           
               $errors = implode('<br>',$error_messages);
               successOrErrorMessage($errors, 'error');               
           }

        helper('form');

        $data['projects_details'] = $projects_details;
        $data['title'] = ADMIN_PROJECT_TITLE; 
        echo admin_view('admin/createproject',$data);
    }
    public function view_projects(){

      $data['title'] = ADMIN_VIEW_PROJECT_TITLE; 
      echo admin_view('admin/view_projects',$data);

    }
    
    
}
?>