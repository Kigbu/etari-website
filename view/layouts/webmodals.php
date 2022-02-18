<div class="modal fade" id="webstarter" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="webstarterform">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Starter web Design Package</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <div id="webstarterformalert"></div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <input name="name" id="wsname" type="text" placeholder="Your Full Name" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-6">
                            <input name="email" id="wsemail" type="text" placeholder="Your Email Address" class="input bg-secondary">
                        </div>
                        <div class="form-field col-md-6">
                            <input name="phonenumber" id="wsphonenumber" type="number" placeholder="Your Phone Number" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <textarea name="message" id="wsmessage" rows="3" type="text" placeholder="Message" class="input bg-secondary"></textarea>
                        </div>
                    </div> 
                    <input name="what" value="web" hidden>
                    <input name="service" value="Web Design" hidden>
                    <input name="package" value="Starter" hidden>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <!--<input type="text" class="d-none" name="form-anti-honeypot" value="Come">-->
                            <input type="submit" class="btn btn-block" value="Send Request">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="webregular" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="webregularform">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Regular web Design Package</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <div id="webregularformalert"></div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <input name="name" id="wrname" type="text" placeholder="Your Full Name" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-6">
                            <input name="email" id="wremail" type="text" placeholder="Your Email Address" class="input bg-secondary">
                        </div>
                        <div class="form-field col-md-6">
                            <input name="phonenumber" id="wrphonenumber" type="number" placeholder="Your Phone Number" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <textarea name="message" id="wrmessage" rows="3" type="text" placeholder="Message" class="input bg-secondary"></textarea>
                        </div>
                    </div>
                    <input name="what" value="web" hidden>
                    <input name="service" value="Web Design" hidden>
                    <input name="package" value="Regular" hidden>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <!--<input type="text" class="d-none" name="form-anti-honeypot" value="">-->
                            <input type="submit" class="btn btn-block" value="Send Request">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="webpro" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="webproform">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Pro web Design Package</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <div id="webproformalert"></div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <input name="name" id="wpname" type="text" placeholder="Your Full Name" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-6">
                            <input name="email" id="wpemail" type="text" placeholder="Your Email Address" class="input bg-secondary">
                        </div>
                        <div class="form-field col-md-6">
                            <input name="phonenumber" id="wpphonenumber" type="number" placeholder="Your Phone Number" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <textarea name="message" id="wpmessage" rows="3" type="text" placeholder="Message" class="input bg-secondary"></textarea>
                        </div>
                    </div>
                    <input name="what" value="web" hidden>
                    <input name="service" value="Web Design" hidden>
                    <input name="package" value="Pro" hidden>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <!--<input type="text" class="d-none" name="form-anti-honeypot" value="">-->
                            <input type="submit" class="btn btn-block" value="Send Request">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="webgold" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="webgoldform">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Gold web Design Package</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <div id="webgoldformalert"></div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <input name="name" id="wgname" type="text" placeholder="Your Full Name" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-6">
                            <input name="email" id="wgemail" type="text" placeholder="Your Email Address" class="input bg-secondary">
                        </div>
                        <div class="form-field col-md-6">
                            <input name="phonenumber" id="wgphonenumber" type="number" placeholder="Your Phone Number" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <textarea name="message" id="wgmessage" rows="3" type="text" placeholder="Message" class="input bg-secondary"></textarea>
                        </div>
                    </div> 
                    <input name="what" value="web" hidden>
                    <input name="service" value="Web Design" hidden>
                    <input name="package" value="Gold" hidden>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <!--<input type="text" class="d-none" name="form-anti-honeypot" value="">-->
                            <input type="submit" class="btn btn-block" value="Send Request">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>