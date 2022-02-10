<!-- Start main-content -->
<div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-6" data-bg-img="http://placehold.it/1920x1280">
        <div class="container pt-60 pb-60">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="font-28 text-white">My Account</h2>
                            <ol class="breadcrumb text-center text-black mt-10">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Pages</a></li>
                                <li class="active text-theme-colored">Page Title</li>
                            </ol>
                    </div>
                </div>
            </div>
        </div>      
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h4 class="text-gray mt-0 pt-5"> Login</h4>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
                    
                    <?php
                        $attributes = ['class' => 'clearfix', 'id' => 'userlogin', 'name' => 'login-form'];
                        echo form_open(FRONT_LOGIN_LINK, $attributes);                
                    ?>
                    <!--<form name="login-form" class="clearfix">-->
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="username">Username/Email</label>
                                <input id="username" name="username" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="password">Password</label>
                                <input id="password" name="password" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="checkbox pull-left mt-15">
                            <label for="form_checkbox">
                                <input id="form_checkbox" name="form_checkbox" type="checkbox">
                                Remember me </label>
                        </div>
                        <div class="form-group pull-right mt-10">
                            <button type="submit" class="btn btn-dark btn-sm">Login</button>
                        </div>
                        <div class="clear text-center pt-10">
                            <a class="text-theme-colored font-weight-600 font-12" href="#">Forgot Your Password?</a>
                        </div>
                        <div class="clear text-center pt-10">
                            <a class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15" href="#" data-bg-color="#3b5998">Login with facebook</a>
                            <a class="btn btn-dark btn-lg btn-block no-border" href="#" data-bg-color="#00acee">Login with twitter</a>
                        </div>
                    <?php 
                        echo form_close(); 
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- end main-content -->