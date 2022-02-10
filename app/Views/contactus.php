<div role="main" class="main">
    <section class="page-header page-header-classic page-header-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 data-title-border>Contact us</h1>
                </div>
                <div class="col-md-4 order-1 order-md-2 align-self-center">
                    <ul class="breadcrumb d-block text-md-right">
                        <li><a href="#">Home</a></li>
                        <li class="active">Contact us</li>
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

                            <h2 class="font-weight-bold text-8 mt-2 mb-0">Contact Us</h2>
                            <p class="mb-4">Feel free to ask for details, don't save any questions!</p>

                            <form class="contact-form" action="php/contact-form.php" method="POST">
                                <div class="contact-form-success alert alert-success d-none mt-4">
                                    <strong>Success!</strong> Your message has been sent to us.
                                </div>

                                <div class="contact-form-error alert alert-danger d-none mt-4">
                                    <strong>Error!</strong> There was an error sending your message.
                                    <span class="mail-error-message text-1 d-block"></span>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label class="mb-1 text-2">Full Name</label>
                                        <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control text-3 h-auto py-2" name="name" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="mb-1 text-2">Email Address</label>
                                        <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control text-3 h-auto py-2" name="email" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="mb-1 text-2">Subject</label>
                                        <input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control text-3 h-auto py-2" name="subject" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="mb-1 text-2">Message</label>
                                        <textarea maxlength="5000" data-msg-required="Please enter your message." rows="8" class="form-control text-3 h-auto py-2" name="message" required></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <input type="submit" value="Send Message" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="col-lg-6">

                            <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="800">
                                <h4 class="mt-2 mb-1">Our <strong>Office</strong></h4>
                                <ul class="list list-icons list-icons-style-2 mt-2">
                                    <li><i class="fas fa-map-marker-alt top-6"></i> <strong class="text-dark">Address:</strong> 133, saimall, Vyara, Gujarat-394650</li>
                                    <li><i class="fas fa-phone top-6"></i> <strong class="text-dark">Phone:</strong> (820) 0119651</li>
                                    <li><i class="fas fa-envelope top-6"></i> <strong class="text-dark">Email:</strong> <a href="mailto:help@childwishfoundation.org">help@childwishfoundation.org</a></li>
                                </ul>
                            </div>

                            <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="950">
                                <h4 class="pt-5">Business <strong>Hours</strong></h4>
                                <ul class="list list-icons list-dark mt-2">
                                    <li><i class="far fa-clock top-6"></i> Monday - Saturday - 8am to 10pm</li>                              
                                </ul>
                            </div>
                            <h4 class="pt-5">Get in <strong>Touch</strong></h4>
                            <p class="lead mb-0 text-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                        </div>

                    </div>

                </div>