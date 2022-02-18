(function( $ ) {
    
    //proccess forms Ajax
	function processHttpRequest(url, data, re){
        if(url && data){
            return $.ajax({
               	url: url,
               	data: data,
               	cache: false,
               	type: 'post',
               	datatype: re
            }).promise();
        }
    }
    function convertDate(date){
    	var t = date.split(/[- :]/);
    	var newDate = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
    	return newDate;
    }

    $('.requestrow').on('click', function(e) {
        e.preventDefault(); 
        var url = $(this).data('requesttarget');
        //location.replace(url);
        window.location.href = decodeURIComponent(url);
    });

    $('.messagerow').on('click', function(e) {
        e.preventDefault(); 
        var url = $(this).data('messagetarget');
        //location.replace(url);
        window.location.href = decodeURIComponent(url);
    });
    
    // validate plus hidden fields
	$(document).ready(function(){
	    // ignore nothing
	    $.validator.setDefaults({
	        ignore: []
        });
        
        //var thisForm =  $("#newcatform");
        $('form').each(function() {
            if($(this).length){
                $(this).validate({   
                    onfocusout: function(element){
                        //console.log(this.element(element));
                        !this.element(element) || !$(element).val() || $(element).val() == 'default'? $(element).addClass('red-border') : $(element).addClass('input-no-error');
                        
                    },
                    // Set rules
                    rules: {                        
                        firstname: required = true,
                        lastname: required = true,
                        agree: required = true,
                        dayof: required = true,
                        timeofday: required = true,
                        amount: {
                            required: true,
                            number: true,
                            min: 500
                        },
                        address: {
                            required: true,
                            maxlength: 250
                        },
                        username:{
                            required: true,
                            maxlength: 50,
                            minlength: 4
                        },
                        name: {
                            required: true,
                            minlength: 4,
                            maxlength: 100,
                        },
                        fullname: {
                            required: true,
                            minlength: 4,
                            maxlength: 100,
                            // wordCount: ['2']
                        },
                        phonenumber: {
                            required: true,
                            minlength: 11,
                            maxlength: 14,
                            number: true
                        },
                        password: {
                            required: true,
                            minlength: 6
                        }, 
                        passwordagain: {
                            required: true,
                            minlength: 6,
                            equalTo: "#password"
                        },
                        loginpassword: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        tandc: {
                            required: true
                        },
                        catname:{
                            required: true,
                            minlength: 4
                        },
                        catalias: {
                            required: true,
                            maxlength: 100
                        },
                        blogtitle: {
                            required: true,
                            maxlength: 50
                        },
                        blogcat:{
                            required: true,
                        },
                        shortdesc:{
                            required: true,
                            maxlength: 250,
                            minlength: 150
                        },
                        desc:{
                            required: true,
                            maxlength: 100,
                            minlength: 80
                        },
                        blogtext: {
                            required: true,
                            minlength: 250,
                        },
                        blogimg:{
                            required: true
                        },
                        blogalias: {
                            required: true,
                        },
                        resfile: {
                            required: true,
                            extension: "docx|rtf|doc|pdf",
                            // accept: "image/*,video/*"
                        }
                        
                    },
                    // Message for the rules
                    messages: {                        
                        firstname: "Please enter firstname",
                        lastname: "please enter lastname",
                        agree: "Please agree to this",
                        dayof: "Must not be empty",
                        username:{
                            required: "Enter a username",
                            maxlength: "Must not be longer than 100 characters",
                            minlength: "Must consists of at least 4 characters"
                            
                        },
                        address: {
                            required: "Please provide your address",
                            maxlength: "Address must not be longer than 250 characters."
                        },
                        name: {
                            required: "please enter your name",
                            minlength: "Must consists of al least 4 characters",
                            maxlength: "Must not be longer than 100 characters"
                        },
                        fullname:{
                            required: "Enter your full name starting with surname",
                            minlength: "Must consists of al least 4 characters",
                            maxlength: "Must not be longer than 100 characters",
                            wordCount: 'Minimum of two words required'
                            
                        },
                        phonenumber:{
                            required: "Enter a phone number",
                            minlength: 'This must be a valid phone number!',
                            maxlength: "Must not be more than 14 digits",
                            number:  "Must not be a valid phone number"
                            
                        },
                        password: {
                            required: "Please provide password",
                            minlength: "Password must be atleast 6 characters"
                        }, 
                        passwordagain: {
                            required: "Confirm password is required",
                            minlength: "confirm password must be atleast 6 characters",
                            equalTo: "Please password must match"
                        },
                        loginpassword: {
                            required: "Please Enter your Password"
                        },
                        tandc: {
                            required: "Please accept our terms and conditions"
                        },
                        catname: {
                            required: "Please provide Category Name",
                            minlength: "Password must be atleast 4 characters"
                        },
                        catalias: {
                            required: "Category Alias should not be empty",
                            maxlength: "Must not be more than 100 characters",
                        },
                        blogtitle: {
                            required: "Please Provide a Blog Title",
                            maxlength: "Must not be more than 50 characters"
                        },
                        blogcat:{
                            required: "Please Select a Blog Category",
                        },
                        shortdesc:{
                            required: "Please Provide a Short Description",
                            maxlength: "Must not be more than 250 characters",
                            minlength: "Must not be less than 150 characters"
                        },
                        desc:{
                            required: "Please Provide a Short Description",
                            maxlength: "Must not be more than 100 characters",
                            minlength: "Must not be less than 80 characters"
                        },
                        blogtext: {
                            required: "Please Provide Blog Text",
                            minlength: "Must not be less than 250 characters",
                        },
                        blogimg:{
                            required: "Please Select Blog Image"
                        },
                        blogalias: {
                            required: "This field is reqiured",
                        },
                        resfile:{
                            required:"input type is required",                  
                            extension:"select valid input file format"
                        }
                    }
                });
            }
        });
    });

    var Message = {
        init: function(config){
            this.config = config;
            this.bindEvents();
        },
        bindEvents: function(){
            $self = Message;
            $self.config.contact.thisForm.on('submit',function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                console.log(data);
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            // console.log(re);
                            $('#contactalert').html(re);
                            // setTimeout(function(){
                            //             location.reload(true);
                            //         }, 3000);
                        }
                    });
                }
            });
        }
    };
    Message.init({
        contact: {
            thisForm: $('#contactForm'),
            alert: $('#contactalert'),
        }
    });

    var Services = {
        init: function(config){
            this.config = config;
            this.bindEvents();
        },
        bindEvents: function(){
            $self = Services;
            //Logo Starter Form on Submit
            $self.config.logo.sform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                //console.log('am hereee');
                //console.log($this.serialize());
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            // console.log(re);
                            $('#logostarterformalert').html(re);
                            setTimeout(function(){
                                        location.reload(true);
                                    }, 3000);
                        }
                    });
                }
            });
            //Logo regular Form on Submit
            $self.config.logo.rform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            $('#logoregularformalert').html(re);
                            setTimeout(function(){
                                        location.reload(true);
                                    }, 3000);
                        }
                    });
                }
            });
            //Logo Pro Form on Submit
            $self.config.logo.pform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            $('#logoproformalert').html(re);
                            setTimeout(function(){
                                        location.reload(true);
                                    }, 3000);
                        }
                    });
                }
            });
            //Logo Gold Form on Submit
            $self.config.logo.gform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            $('#logogoldformalert').html(re);
                            setTimeout(function(){
                                        location.reload(true);
                                    }, 3000);
                        }
                    });
                }
            });


            //Grapgics Starter Form on Submit
            $self.config.graphic.sform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                //console.log('am hereee');
                // console.log($this.serialize());
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            //console.log(re);
                            $('#graphicstarterformalert').html(re);
                            setTimeout(function(){
                                        location.reload(true);
                                    }, 3000);
                        }
                    });
                }
            });
            //Grapgics Regular Form on Submit
            $self.config.graphic.rform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            //console.log(re);
                            $('#graphicregularformalert').html(re);
                            setTimeout(function(){
                                        location.reload(true);
                                    }, 3000);
                        }
                    });
                }
            });
            //Grapgics Pro Form on Submit
            $self.config.graphic.pform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            //console.log(re);
                            $('#graphicproformalert').html(re);
                            setTimeout(function(){
                                        location.reload(true);
                                    }, 3000);
                        }
                    });
                }
            });
            //Grapgics Gold Form on Submit
            $self.config.graphic.gform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            //console.log(re);
                            $('#graphicgoldformalert').html(re);
                            setTimeout(function(){
                                        location.reload(true);
                                    }, 3000);
                        }
                    });
                }
            });


            //Web Starter Form on Submit
            $self.config.web.sform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                // console.log('am hereee');
                // console.log($this.serialize());
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            //console.log(re);
                            $('#webstarterformalert').html(re);
                            setTimeout(function(){
                    					location.reload(true);
                    				}, 3000);
                        }
                    });
                }
            });
            //Web Regular Form on Submit
            $self.config.web.rform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            //console.log(re);
                            $('#webregularformalert').html(re);
                            setTimeout(function(){
                    					location.reload(true);
                    				}, 3000);
                        }
                    });
                }
            });
            //Web Pro Form on Submit
            $self.config.web.pform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            //console.log(re);
                            $('#webproformalert').html(re);
                            setTimeout(function(){
                    					location.reload(true);
                    				}, 3000);
                        }
                    });
                }
            });
            //Web Gold Form on Submit
            $self.config.web.gform.on('submit', function(e){
                e.preventDefault();
                var $this = $(this);
                var data = $this.serialize();
                if($this.valid()){
                    processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                        if(typeof re === 'string'){
                            //console.log(re);
                            $('#webgoldformalert').html(re);
                            setTimeout(function(){
                    					location.reload(true);
                    				}, 3000);
                        }
                    });
                }
            });
        },
        processForm: function(data, alert){
            console.log(data)
            var self = Services;
            processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                if(typeof re === 'string'){
                    //console.log(re);
                    alert.html(re);
                    // setTimeout(function(){
					// 			location.reload(true);
					// 		}, 3000);
                }
            });
        }
    };
    Services.init({
        logo: {
            sform: $('#logostarterform'),
            rform: $('#logoregularform'),
            pform: $('#logoproform'),
            gform: $('#logogoldform'),
            salert: $('#logostarterformalert'),
            ralert: $('#logoregularformalert'),
            palert: $('#logoproformalert'),
            galert: $('#logogoldformalert')
        },
        graphic: {
            sform: $('#graphicstarterform'),
            rform: $('#graphicregularform'),
            pform: $('#graphicproform'),
            gform: $('#graphicgoldform'),
            salert: $('#graphicstarterformalert'),
            ralert: $('#graphicregularformalert'),
            palert: $('#graphicproformalert'),
            galert: $('#graphicgoldformalert')
        },
        web: {
            sform: $('#webstarterform'),
            rform: $('#webregularform'),
            pform: $('#webproform'),
            gform: $('#webgoldform'),
            salert: $('#webstarterformalert'),
            ralert: $('#webregularformalert'),
            palert: $('#webproformalert'),
            galert: $('#webgoldformalert')
        }
    });

    //console.log('am here');
})( jQuery );