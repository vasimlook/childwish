<?php

$edit_mode = false;

if (isset($edit_projects) && $edit_projects == true) {
    $edit_mode = true;
}

$imageRequired = true;
$projectsImage = "";

$pageTitle = "Create Project";
$ActionLink = ADMIN_CREATE_PROJECT_LINK;

$projects_title = "";
$projects_description = "";
$target_amount  = "";
$amount_start_date = "";
$amount_end_date = "";
$urgent_need = "";

if (isset($projects_details) && (is_array($projects_details) && sizeof($projects_details) > 0)) {
    $projects_title = (isset($projects_details['projects_title'])) ? $projects_details['projects_title'] : '';
    $projects_description = (isset($projects_details['projects_description'])) ? $projects_details['projects_description'] : '';
    $target_amount = (isset($projects_details['target_amount'])) ? $projects_details['target_amount'] : '';
    $amount_start_date = (isset($projects_details['amount_start_date'])) ? $projects_details['amount_start_date'] : '';
    $amount_end_date = (isset($projects_details['amount_end_date'])) ? $projects_details['amount_end_date'] : '';

    if (isset($projects_details['urgent_need'])) {
        if ($projects_details['urgent_need'] == 1) {
            $urgent_need = "checked";
        }
    }
}

if ($edit_mode) {
    $ActionLink = ADMIN_EDIT_PROJECT_LINK . '/' . $projects_id;
    $pageTitle = "Edit Project";

    if (isset($projects_details['projects_image']) && $projects_details['projects_image'] != '') {
        $imageRequired = false;
        $projectsImage = $projects_details['projects_image'];
    }
    
    $otherImageHtml = '';

    if(isset($projects_details['other_images']) && is_array(($projects_details['other_images'])) && sizeof($projects_details['other_images']) > 0){
        foreach($projects_details['other_images'] as $key => $other_image){
            $imageName = $other_image['image_name'];
            $imageId = $other_image['image_id'];      
            $imagePATH = UPLOAD_FOLDER.'original/'.$imageName;     

            $otherImageHtml .= '<div class="outer col-md-2" id="img_'.$imageId.'">
                                    <ion-card class="inner" *ngFor="let i of images">
                                        <img src="'.$imagePATH.'" />
                                        <span  class="close-icon delete-image" data-id="'.$imageId.'">X</span>
                                    </ion-card>
                                </div> ';        }
    }

    echo " <style>

    .close-icon {
      position: absolute;
      right: -8rem;
      margin-top: -10rem;
      color: red;
      font-size: 18px;
     }
    
    .inner {
      position: relative;
      /* background: #ccc; */
      height: 40px;
      width: 100%;
      margin: 5px;
    }
    .close-icon:hover{
      cursor: pointer;
    }
    .outer {
      height: 90px;
      width: 100px;
    }
    </style>";
}
?>

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?= $pageTitle ?></h3>
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">
                    <div class="card">
                        <div class="card-inner">
                            <?php
                            $attributes = ['id' => 'frm_projects_manipulation', 'class' => 'gy-3', 'enctype' => 'multipart/form-data'];
                            echo form_open($ActionLink, $attributes);
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
                                            <input type="text" value="<?= $projects_title ?>" class="form-control" name="projects_title" id="projects_title" placeholder="Enter projects title" required="" autocomplete="off">
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
                                            <input type="file" accept="image/*" name="projects_image" id="projects_image" <?= ($imageRequired) ? "required" : "" ?>>
                                        </div>
                                        <?php if ($edit_mode && $projectsImage != '') : ?>
                                            <div style="margin-top: 10px;">
                                                <img src="<?= UPLOAD_FOLDER . 'original/' . $projectsImage ?>">
                                            </div>
                                        <?php endif; ?>
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
                                            <input type="text" class="form-control" value="<?= $target_amount ?>" name="target_amount" id="target_amount" placeholder="Enter target amount" required="" autocomplete="off">
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
                                            <input type="text" class="form-control date-picker" value="<?= $amount_start_date ?>" name="amount_start_date" id="amount_start_date" placeholder="Select start date" required="" autocomplete="off">
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
                                            <input type="text" class="form-control date-picker" value="<?= $amount_end_date ?>" name="amount_end_date" id="amount_end_date" placeholder="Select end date" required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label float-right" for="other_images">Other images: </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="file" name="other_projects_images[]" id="other_projects_images" accept="image/*" multiple>
                                        </div>

                                        <?php if ($edit_mode && $otherImageHtml != '') : ?>                                           
                                            <div class="form-group bordered-group">
                                                <div class="row">
                                                    <?=  $otherImageHtml ?>                                                  
                                                </div>
                                            </div>                                           
                                        <?php endif; ?>    
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
                                                <input type="checkbox" <?= $urgent_need ?> name="urgent_need" id="urgent_need">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-lg-7 offset-lg-5">
                                        <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-lg btn-primary"><?= $pageTitle ?></button>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div><!-- card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>