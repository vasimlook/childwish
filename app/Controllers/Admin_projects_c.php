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

    public function edit_projects($projects_id){
      helper('form');

      $projects_details = $this->Project_m->get_projects_details($projects_id);
      $has_error = false;
      $error_messages  = array();
      $submitForm = false;
    
      if(is_array($projects_details) && sizeof($projects_details) > 0){
        if(isset($projects_details['amount_start_date'])){
          $projects_details['amount_start_date'] = date("m/d/Y", strtotime($projects_details['amount_start_date']));
        }

        if(isset($projects_details['amount_end_date'])){
          $projects_details['amount_end_date'] = date("m/d/Y", strtotime($projects_details['amount_end_date']));
        }
      }

      if (
        isset($_POST['projects_title']) &&
        isset($_POST['projects_description']) 
      ) {
  
        $submitForm = true;
        $validate = self::validate_projects($_POST);
  
        $has_error = $validate['has_error'];
        $error_messages = $validate['error_messages'];
        $projects_details = $validate['projects_details'];
  
  
        if(isset($_FILES['projects_image'])){
          $main_img = singleImageUpload('projects_image');
          $projectsImage = $main_img[2]['file_name'];
    
          if (empty($projectsImage) || $projectsImage == '') {            
          } else {
            $projects_details['projects_image'] = $projectsImage;
          }
        }       
      }

      if ($submitForm && !$has_error && (is_array($projects_details) && sizeof($projects_details) > 0)) {
        //create projects
  
        $update = $this->Project_m->update_projects($projects_details,$projects_id);
  
        if ($update) {
          successOrErrorMessage("Projects has been successfully updated", 'success');
          return redirect()->to(ADMIN_VIEW_PROJECT_LINK);
        }
      } else if (is_array($error_messages) && sizeof($error_messages) > 0) {
        $errors = implode('<br>', $error_messages);
        successOrErrorMessage($errors, 'error');
      }

      $data['edit_projects'] = true;
      $data['projects_id'] = $projects_id;
      $data['projects_details'] = $projects_details;
      $data['title'] = ADMIN_PROJECT_TITLE; 
      echo admin_view('admin/createproject',$data);
    }

  function validate_projects($projectsData){
    $projects_title = trim($projectsData['projects_title']);
    $projects_description = trim($projectsData['projects_description']);
    $target_amount = (float)trim($projectsData['target_amount']);
    $amount_start_date = trim($projectsData['amount_start_date']);
    $amount_end_date = trim($projectsData['amount_end_date']);

    $has_error = false;
    $projects_details = array();  


    if (empty($projects_title) || $projects_title == '') {
      $has_error = true;
      $error_messages[] = "Projects title can not be empty!";
    } else {
      $projects_details['projects_title'] = $projects_title;
    }

    if (empty($projects_description) || $projects_description == '') {
      $has_error = true;
      $error_messages[] = "Projects descriptions can not be empty!";
    } else {
      $projects_details['projects_description'] = $projects_description;
    }


    if (empty($target_amount) || $target_amount == '' || $target_amount <= 0) {
      $has_error = true;
      $error_messages[] = "Target amount can not be empty!";
    } else {
      $projects_details['target_amount'] = $target_amount;
    }

    if (empty($amount_start_date) || $amount_start_date == '') {
      $has_error = true;
      $error_messages[] = "Start date can not be empty!";
    } else {
      $projects_details['amount_start_date'] = $amount_start_date;
    }

    if (empty($amount_end_date) || $amount_end_date == '') {
      $has_error = true;
      $error_messages[] = "End date can not be empty!";
    } else {
      $projects_details['amount_end_date'] = $amount_end_date;
    }

    if (isset($projectsData['urgent_need']) && $projectsData['urgent_need'] == "on") {
      $projects_details['urgent_need'] = 1;
    }

    return array(
      'has_error' => $has_error,
      'error_messages' => $error_messages,
      'projects_details' => $projects_details
    );
  }

  public function create_project(){

    $has_error = false;
    $error_messages  = array();

    $projects_details = array();

    if (
      isset($_POST['projects_title']) &&
      isset($_POST['projects_description']) &&
      isset($_FILES['projects_image'])
    ) {

      $validate = self::validate_projects($_POST);

      $has_error = $validate['has_error'];
      $error_messages = $validate['error_messages'];
      $projects_details = $validate['projects_details'];


      $main_img = singleImageUpload('projects_image');
      $projectsImage = $main_img[2]['file_name'];

      if (empty($projectsImage) || $projectsImage == '') {
        $has_error = true;
        $error_messages[] = "Please select projects image!";
      } else {
        $projects_details['projects_image'] = $projectsImage;
      }
    }

    if (!$has_error && (is_array($projects_details) && sizeof($projects_details) > 0)) {
      //create projects

      $projectsId = $this->Project_m->create_projects($projects_details);

      if ($projectsId) {
        successOrErrorMessage("Projects has been successfully created", 'success');
        return redirect()->to(ADMIN_VIEW_PROJECT_LINK);
      }
    } else if (is_array($error_messages) && sizeof($error_messages) > 0) {
      $errors = implode('<br>', $error_messages);
      successOrErrorMessage($errors, 'error');
    }

    helper('form');

    $data['projects_details'] = $projects_details;
    $data['title'] = ADMIN_PROJECT_TITLE;
    echo admin_view('admin/createproject', $data);
  }
    public function view_projects(){

      $data['title'] = ADMIN_VIEW_PROJECT_TITLE; 
      echo admin_view('admin/view_projects',$data);

    }
  
  public function update_status(){
    echo $_REQUEST['projects_status'];
  }
    
    
}
?>