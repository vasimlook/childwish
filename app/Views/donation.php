<div role="main" class="main">
    <section class="page-header page-header-classic page-header-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 data-title-border>Donate now</h1>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-right">
                        <li><a href="#">Home</a></li>
                        <li class="active">Donate now</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<!--
    <div id="googlemaps" class="google-map mt-0" style="height: 500px;"></div>-->
                <div class="container">
                    <div class="row py-4">
                        <div class="col-lg-6">

                            <h2 class="font-weight-bold text-8 mt-2 mb-0">Donate Now</h2>                                                                        
                                <?php
                                    $attributes = ['class' => 'donation-form', 'method' => 'POST', 'name' => 'donation_form'];
                                    echo form_open(DONATION_STEP_2_LINK, $attributes);
                                ?> 

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="mb-1 text-2">Full Name</label>
                                        <input type="text" value="" data-msg-required="Please enter your full name." maxlength="100" class="form-control text-3 h-auto py-2" name="fullname" required>
                                    </div>
                                </div>
                                <div class="form-row">                               
                                    <div class="form-group col">
                                        <label class="mb-1 text-2">Email Address</label>
                                        <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control text-3 h-auto py-2" name="email" required>
                                    </div>
                                </div>
                                <div class="form-row">                               
                                    <div class="form-group col">
                                        <label class="mb-1 text-2">Mobile Number</label>
                                        <input type="number" value="" data-msg-required="Please enter mobile number." data-msg-email="Please enter a valid email address." maxlength="10" class="form-control text-3 h-auto py-2" name="mobile" required>
                                    </div>
                                </div>                                
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="mb-1 text-2">Amount</label>
                                        <input type="number" value="" data-msg-required="Please enter amount." data-msg-email="Please enter a valid amount." class="form-control text-3 h-auto py-2" name="amount" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="hidden" value = "<?= $projects_id ?>" name="projects_id" >
                                        <input type="submit" value="Donate Now" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                                    </div>
                                </div>
                                <?php echo form_close(); ?> 

                        </div>
                        <div class="col-lg-6">

                        </div>

                    </div>

                </div>