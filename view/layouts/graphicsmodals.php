<div class="modal fade" id="graphicstarter" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="graphicstarterform">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Starter Graphic Design Package</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <div id="graphicstarterformalert"></div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <input name="name" id="gsname" type="text" placeholder="Your Full Name" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-6">
                            <input name="email" id="gsemail" type="text" placeholder="Your Email Address" class="input bg-secondary">
                        </div>
                        <div class="form-field col-md-6">
                            <input name="phonenumber" id="gsphonenumber" type="number" placeholder="Your Phone Number" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <textarea name="message" id="gsmessage" rows="3" type="text" placeholder="Message" class="input bg-secondary"></textarea>
                        </div>
                    </div> 
                    <input name="what" value="graphic" hidden>
                    <input name="service" value="Graphic Design" hidden>
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

<div class="modal fade" id="graphicregular" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="graphicregularform">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Regular Graphic Design Package</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <div id="graphicregularformalert"></div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <input name="name" id="grname" type="text" placeholder="Your Full Name" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-6">
                            <input name="email" id="gremail" type="text" placeholder="Your Email Address" class="input bg-secondary">
                        </div>
                        <div class="form-field col-md-6">
                            <input name="phonenumber" id="grphonenumber" type="number" placeholder="Your Phone Number" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <textarea name="message" id="grmessage" rows="3" type="text" placeholder="Message" class="input bg-secondary"></textarea>
                        </div>
                    </div>
                    <input name="what" value="graphic" hidden>
                    <input name="service" value="Graphic Design" hidden>
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

<div class="modal fade" id="graphicpro" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="graphicproform">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Pro Graphic Design Package</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <div id="graphicproformalert"></div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <input name="name" id="gpname" type="text" placeholder="Your Full Name" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-6">
                            <input name="email" id="gpemail" type="text" placeholder="Your Email Address" class="input bg-secondary">
                        </div>
                        <div class="form-field col-md-6">
                            <input name="phonenumber" id="gpphonenumber" type="number" placeholder="Your Phone Number" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <textarea name="message" id="gpmessage" rows="3" type="text" placeholder="Message" class="input bg-secondary"></textarea>
                        </div>
                    </div>
                    <input name="what" value="graphic" hidden>
                    <input name="service" value="Graphic Design" hidden>
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


<div class="modal fade" id="graphicgold" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="graphicgoldform">
                <div class="modal-header">                        
                    <h4 class="heading-xs dash fw-4">Gold Graphic Design Package</h4>
                    <!-- <p>Describe your project and leave us your contact info</p> -->
                </div>
                <div class="modal-body">
                    <div id="graphicgoldformalert"></div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <input name="name" id="ggname" type="text" placeholder="Your Full Name" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-6">
                            <input name="email" id="ggemail" type="text" placeholder="Your Email Address" class="input bg-secondary">
                        </div>
                        <div class="form-field col-md-6">
                            <input name="phonenumber" id="ggphonenumber" type="number" placeholder="Your Phone Number" class="input bg-secondary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field col-md-12">
                            <textarea name="message" id="ggmessage" rows="3" type="text" placeholder="Message" class="input bg-secondary"></textarea>
                        </div>
                    </div> 
                    <input name="what" value="graphic" hidden>
                    <input name="service" value="Graphic Design" hidden>
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