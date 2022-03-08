
<div role="main" class="main">
    <div class="container-fluid position-relative" id="home">               
        <div class="row align-items-center pt-5">
            <div class="col-lg-7 pt-5 mt-2" style="padding-right: 0px;padding-left: 0px;">
                <img src="<?php echo ASSETS_FOLDER; ?>img/banner/slide11.png" class="img-fluid" alt=""/>
            </div>
            <div class="col-lg-5 pt-md-4 mt-md-4 pt-xs-0 mt-xs-0">
                <div>
                    <h1 class="mb-4 mb-md-0 mb-xl-3"><strong>Help Change A Child’s Life FOREVER!</strong><br>Every Child Is Unique!</h1>
                </div>
                <div>
                    <p class="text-4 mb-5">It Just Needs Healthy Food, Good Education & Lots Of Love</p>
                </div>
                <div class="row mb-2 counters text-dark hide-xs hide-sm hide-md">                                                                              
                    <div class="col-xs-4 col-sm-4 col-lg-4 hide-xs hide-sm hide-md">
                        <div class="counter">
                            <strong data-to="15">0</strong>
                            <label>DONORS</label>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-lg-4 hide-xs hide-sm hide-md">
                        <div class="counter">
                            <strong data-to="12">0</strong>
                            <label>ISSUES</label>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-lg-4 hide-xs hide-sm hide-md">
                        <div class="counter">
                            <strong data-to="3">0</strong>
                            <label>COMPLETED ISSUES</label>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12 mb-2 pt-md-5">
                    <a href="<?php echo DONATION_LINK; ?>" class="btn btn-primary font-weight-semibold text-4 btn-px-5 btn-py-2 col-sm-12">Donate Now</a>
                </div>                 
            </div>            
        </div>        
    </div>                
<section class="section bg-primary border-0 m-0">
        <div class="container">            
            <div class="row align-items-center">                
                <div class="col-lg-9">
                    <h2 class="font-weight-semibold line-height-3 text-6 text-lg-5 text-xl-6 mb-3 mb-lg-0 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="100" style="color:#fff;">Have any questions for us? Chat with our team on WhatsApp Now</h2>
                </div>
                <div class="col-lg-3">                   
                    <a href="#demo-form" class="btn btn-light font-weight-semibold text-3 btn-px-5 btn-py-2 order-1 order-lg-2 d-md-block mr-3 mr-lg-0" style="width:100%"><i class="fab fa-whatsapp"></i> (+91 8866195788)</a>                    
                </div>
            </div>
        </div>
</section>
    <div class="container-fluid" style="background-color: #f7f7f7;">
        <div class="row pt-5">
            <div class="col text-center">
                <h2 class="font-weight-bold line-height-2 text-7 mb-1">ISSUES AND VIEWS</h2>
                <span class="d-block text-color-dark text-3 pb-2 mb-4 opacity-7">View the projects that are most active right now</span>
            </div>
        </div>
        <div class="row">                  
                <div class="owl-carousel owl-theme stage-margin nav-style-1 " data-plugin-options="{'items': 3, 'margin': 50, 'loop': true, 'nav': false, 'dots': false, 'stagePadding': 30}">                        

                    <?php
                         if(is_array($projects) && sizeof($projects) > 0){
                            foreach($projects as $key => $project){            
                                $projectId = $project['projects_id'];
                                $projectsTitle = $project['projects_title'];
                                $projectsDescription = $project['projects_description'];
                                $projectsImage = $project['projects_image'];
                                $targetAmount = number_format($project['target_amount'],2,'.','');
                                $receivedAmount = number_format($project['received_amount'],2,'.','');
                                $AmountstartDate = strtotime($project['amount_start_date']);
                                $amountEndDate = strtotime($project['amount_end_date']);                                
                                $datediff = $amountEndDate - $AmountstartDate;

                                $totalPercent = 0;                                
                                if(floatval($project['received_amount']) > 0){
                                   $totalPercent = ((float)$receivedAmount * 100) / (float)$project['target_amount'];
                                   $totalPercent = ceil($totalPercent);
                                }

                                $daysLeft =  round($datediff / (60 * 60 * 24));
                                ?>
                                 <div class="col-md-12 mb-5 mb-md-0" style="background-color: #fff;border-radius:15px;padding-right: 0px;padding-left: 0px;">
                                    <article>
                                        <a href="<?= PROJECTS_DETAILS.'/'.$projectId  ?>">
                                            <span class="thumb-info thumb-info-no-borders custom-thumb-info-style-1 pb-2 mb-2 mb-md-4">
                                                <span class="thumb-info-wrapper">
                                                    <img src="<?php echo UPLOAD_FOLDER; ?>original/<?= $projectsImage ?>" class="full-width" alt="" style="border-top-left-radius:10px;border-top-right-radius:10px">
                                                </span>
                                            </span>
                                        </a>
                                        <div style="padding-right: 15px;padding-left: 15px;">
                                            <h2 class="font-weight-semibold custom-fs-1 line-height-3 ls-0 mb-2"><a href="demo-seo-blog-post.html" class="text-color-dark text-decoration-none"><?= $projectsTitle ?></a></h2>
                                            <!-- <p class="mb-0">Every child deserves to be educated.</p> -->
                                            <p><?= $projectsDescription ?></p>
                                            <div class="progress-label">
                                                <span class="text-4"><strong><i class="fas fa-rupee-sign"></i> <?= $receivedAmount ?></strong> raised out of <strong><i class="fas fa-rupee-sign"></i><?= $targetAmount ?></strong> </span>
                                            </div>
                                            <div class="progress progress-sm mb-2 mt-2">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $totalPercent ?>%;">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-5 offset-1 text-3 float-left mt-3">
                                                    <i class="fas fa-clock" style="color:#000"></i> <?= $daysLeft ?> Days left
                                                </div>
                                                <div class="offset-5 col-xs-1 float-right text-3 mt-3">
                                                    <i class="fas fa-heart" style="color:#ea4335"></i> 2688
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                
                                                    <a href="<?= PROJECT_DONATION_LINK.'/'.$projectId   ?>"  class="col-md-12 btn btn-primary btn-outline  font-weight-semibold text-4 btn-px-5 btn-py-2">Donate Now</a>
                                            
                                            </div>
                                        </div>                                                     
                                    </article>
                                </div>
                           <?php }
                        }
                    ?>                        
                          
                </div>            
        </div>       
    </div>

    <section class="section section-height-3 bg-light border-0 m-0 appear-animation" data-appear-animation="fadeIn" id="reviews">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="font-weight-bold line-height-2 text-7 mb-1">DONOR TESTIMONIALS</h2>
                    <span class="d-block text-color-dark text-5 pb-2 mb-4 opacity-7">REVIEWS</span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-11 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
                    <div class="owl-carousel owl-theme nav-bottom rounded-nav mb-0" data-plugin-options="{'items': 1, 'loop': false}">
                        <?php 
                        if(is_array($testimonials) && sizeof($testimonials) > 0){
                            foreach($testimonials as $key => $testimonial){
                                
                                $description = $testimonial['description'];
                                $author = $testimonial['author'];
                                $author_image = $testimonial['author_image'];
                                $author_address	 = $testimonial['author_address'];

                                ?>
                                <div>
                                    <div class="testimonial testimonial-style-2 testimonial-with-quotes mb-0">
                                        <div class="testimonial-author mb-0">
                                            <img src="<?php echo ASSETS_FOLDER; ?>img/clients/<?= $author_image ?>" class="img-fluid rounded-circle mb-1" alt="">
                                        </div>
                                        <blockquote>
                                            <p class="text-color-dark opacity-7 mb-0"><?= $description ?></p>
                                        </blockquote>
                                        <div class="testimonial-author mb-3">
                                            <p><strong class="font-weight-bold"><?= $author ?></strong><span class="font-weight-normal"><?= $author_address ?></span></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

<!--    <section class="section border-0 m-0">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="owl-carousel owl-theme carousel-center-active-item mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 1}, '768': {'items': 5}, '992': {'items': 5}, '1200': {'items': 5}}, 'autoplay': true, 'autoplayTimeout': 3000, 'stagePadding': 0, 'dots': false, 'nav': false}">
                        <div class="px-3">
                            <img class="img-fluid" src="<?php echo ASSETS_FOLDER; ?>img/logos/logo-1.png" alt="">
                        </div>
                        <div class="px-3">
                            <img class="img-fluid" src="<?php echo ASSETS_FOLDER; ?>img/logos/logo-2.png" alt="">
                        </div>
                        <div class="px-3">
                            <img class="img-fluid" src="<?php echo ASSETS_FOLDER; ?>img/logos/logo-3.png" alt="">
                        </div>
                        <div class="px-3">
                            <img class="img-fluid" src="<?php echo ASSETS_FOLDER; ?>img/logos/logo-4.png" alt="">
                        </div>
                        <div class="px-3">
                            <img class="img-fluid" src="<?php echo ASSETS_FOLDER; ?>img/logos/logo-5.png" alt="">
                        </div>
                        <div class="px-3">
                            <img class="img-fluid" src="<?php echo ASSETS_FOLDER; ?>img/logos/logo-6.png" alt="">
                        </div>
                        <div class="px-3">
                            <img class="img-fluid" src="<?php echo ASSETS_FOLDER; ?>img/logos/logo-4.png" alt="">
                        </div>
                        <div class="px-3">
                            <img class="img-fluid" src="<?php echo ASSETS_FOLDER; ?>img/logos/logo-2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->



