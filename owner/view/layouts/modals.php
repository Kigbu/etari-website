<div class="modal fade" id="modalDefaultlogo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="logo-get-started-form">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Start a Project</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <form class="genox-form" action="" method="POST">
                        <div class="form-results"></div>
                        <div class="row">
                            <div class="form-field col-md-12">
                                <input name="cf_name" type="text" placeholder="Your Full Name" class="input bg-secondary">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-field col-md-12">
                                <input name="cf_email" type="text" placeholder="Your Email Address" class="input bg-secondary">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-field col-md-12">
                                <input name="cf_phone" type="text" placeholder="Your Phone Number" class="input bg-secondary">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-field col-md-12">
                                <label>How much are you looking to spend? (Minimum: ₦200,000)</label>
                                <input name="cf_budget" type="text" placeholder="Your Budget" class="input bg-secondary required">
                            </div>
                        </div>   
                        <div class="row">
                            <div class="form-field col-md-12">
                                <input name="cf_logotype" type="text" placeholder="Type of Logo" class="input bg-secondary">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-field col-md-12">
                                <input type="text" class="d-none" name="form-anti-honeypot" value="">
                                <button type="submit" class="btn btn-block">Submit</button>
                            </div>
                        </div>
                    </form><!-- end form -->
                </div>
                <div class="modal-footer">
                    <input class="btn" type="button" value="Close" data-dismiss="modal">
                </div>
            </form>
        </div>
    </div>
</div>