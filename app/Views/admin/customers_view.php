<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Users / <strong class="text-primary small"><?php echo $customer['customer_first_name'].' '.$customer['customer_last_name']; ?></strong></h3>
                            <div class="nk-block-des text-soft">
                                <ul class="list-inline">
                                    <li><b>User ID</b>: <span class="text-base"><?php echo $customer['user_unique_id']; ?></span></li>
                                    <li><b>Total Earning</b>: <span class="text-base"><?php echo (($count_earning) * (EARNING_AMOUNT)); ?></span></li>
                                    <li><b>Total Withdrawal</b>: <span class="text-base"><?php echo $count_withdrawal; ?></span></li>
                                    <li><b>Total Remain Balance</b>: <span class="text-base"><?php echo (($count_earning) * (EARNING_AMOUNT)) - $count_withdrawal; ?></span></li>
                                </ul>
                            </div>
                        </div>                        
                    </div>
                </div><!-- .nk-block-head -->
                
                <hr>
                <div class="components-preview mx-auto">   
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Referral Customers List</h4>
                                <div class="nk-block-des">                                   
                                </div>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                                    <thead>
                                        <tr>                                            
                                            <th>Index</th>
                                            <th>ID</th>
                                            <th>Password</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>                                                                                                                                  
                                            <th>Gender</th>                                            
                                            <th>Mobile</th>
                                            <th>Email</th>                                                                                        
                                            <th>Action</th>                                          
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Index</th>
                                            <th>ID</th>
                                            <th>Password</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>                                                                                                                                  
                                            <th>Gender</th>                                            
                                            <th>Mobile</th>
                                            <th>Email</th>                                                                                        
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div>                
                </div><!-- .components-preview -->
                <hr>
                <div class="components-preview mx-auto">   
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Withdrawal History</h4>
                                <div class="nk-block-des">                                   
                                </div>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <table id="example2" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                                    <thead>
                                        <tr>                                            
                                            <th>Index</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                                                                     
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>Index</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>