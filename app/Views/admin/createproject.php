<?php
    $projects_title = "";
    $projects_description = "";
    $target_amount  = "";
    $amount_start_date = "";
    $amount_end_date = "";
    $urgent_need = "";

    if(isset($projects_details) && (is_array($projects_details) && sizeof($projects_details) > 0)){
        $projects_title = (isset($projects_details['projects_title'])) ? $projects_details['projects_title'] : '';
        $projects_description = (isset($projects_details['projects_description'])) ? $projects_details['projects_description'] : '';
        $target_amount = (isset($projects_details['target_amount'])) ? $projects_details['target_amount'] : '';
        $amount_start_date = (isset($projects_details['amount_start_date'])) ? $projects_details['amount_start_date'] : '';
        $amount_end_date = (isset($projects_details['amount_end_date'])) ? $projects_details['amount_end_date'] : '';

        if(isset($projects_details['urgent_need'])){
            if($projects_details['urgent_need'] == 1){
                $urgent_need = "checked";
            }
        }
    }
?>

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">   
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Create Project</h3>
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">                   
                    <div class="card">
                        <div class="card-inner">
                             <?php
                                $attributes = ['id' => 'frm_change_password','class'=>'gy-3', 'enctype' => 'multipart/form-data'];
                                echo form_open(ADMIN_CREATE_PROJECT_LINK,$attributes);
                               ?>                            
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label float-right" for="projects_title">Projects Title:</label>                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" value = "<?= $projects_title ?>" class="form-control" name="projects_title" id="projects_title" placeholder="Enter projects title" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                            
                                            <label class="form-label float-right" for="projects_description">Projects Descriptions:</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <textarea class="form-control" name="projects_description" id="projects_description" required> <?= $projects_description ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                             
                                             <label class="form-label float-right" for="projects_image">Projects Image: </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                 <input type="file"  name="projects_image" id="projects_image"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                             
                                             <label class="form-label float-right" for="target_amount">Target Amount: </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                 <input type="text" class="form-control" value = "<?=$target_amount ?>"   name="target_amount" id="target_amount" placeholder="Enter target amount" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                             
                                             <label class="form-label float-right" for="amount_start_date">Start Date: </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                 <input type="text" class="form-control date-picker" value = "<?= $amount_start_date ?>"  name="amount_start_date" id="amount_start_date" placeholder="Select start date" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                             
                                             <label class="form-label float-right" for="amount_end_date">End Date: </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                 <input type="text" class="form-control date-picker" value = "<?= $amount_end_date ?>"  name="amount_end_date" id="amount_end_date" placeholder="Select end date" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                             
                                             <label class="form-label float-right" for="urgent_need">Urgent need?: </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                 <input type="checkbox" <?= $urgent_need ?>  name="urgent_need" id="urgent_need" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>                                
                                <div class="row g-3">
                                    <div class="col-lg-7 offset-lg-5">
                                        <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-lg btn-primary">Create Project</button>                                          
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close();?> 
                        </div>
                    </div><!-- card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>