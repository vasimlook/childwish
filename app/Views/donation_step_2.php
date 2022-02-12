<?php   
    $fullName = $razerPay['fullName'];
    $emailAddress = $razerPay['emailAddress'];
    $mobileNumber = $razerPay['mobileNumber'];
    $amount = (float)$razerPay['amount'];
    $id = rand().$mobileNumber;
?>

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

                            <form action="<?= DONATION_SUCCESS ?>" method="POST">
                                <script
                                    src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="<?= RAZERPAY_KEY ?>" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
                                    data-amount="<?= $amount * 100 ?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
                                    data-currency="INR"// You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
                                    data-id="<?= $id ?>"// Replace with the order_id generated by you in the backend.
                                    data-buttontext="Donate Now"
                                    data-name="Child wish"
                                    data-description="Help Change A Child’s Life FOREVER! Every Child Is Unique!"
                                    data-image="https://dashboard-activation.s3.amazonaws.com/org_100000razorpay/main_logo/phpAJgHea"
                                    data-prefill.name="<?= $fullName ?>"
                                    data-prefill.email = "<?= $emailAddress ?>"
                                    data-prefill.contact="<?= $mobileNumber ?>"
                                    data-theme.color="#F37254"
                                ></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>

                        </div>
                        <div class="col-lg-6">

                        </div>

                    </div>

                </div>