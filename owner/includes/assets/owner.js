(function( $ ) {


    //file input field trigger when the drop box is clicked
    $('.resdropBox').on('click', function(){
        $('#resfile').click();
    });
    //prevent browsers from opening the file when its drag and drop
    $(document).on('drop dragover',  function(e){
        e.preventDefault();
    });
    

	$('#loginnform').on('submit', function(e){
        e.preventDefault();
        console.log('login form')
    });

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


    var User = {
        init: function(config){
            this.config = config;
            this.bindEvents();
        },
        bindEvents: function(){
            var $self = User;
            // Forms Button Enable/Disable
            $(document).ready(function(){
                $self.config.newUser.thisForminputs.on('keyup blur', function () { // fires on every keyup & blur
                    if (!$self.config.newUser.thisForm.valid()) {   
                        $self.config.newUser.nuserbtn.prop("disabled", "disabled");
                    } else {
                        //console.log($self.config.newUser.nuserbtn);
                        $self.config.newUser.nuserbtn.prop("disabled", false);   // disables button
                    }
                });
                //New user form on Submit
                $self.config.newUser.thisForm.on('submit', function(e){
                    e.preventDefault();                
                    if($self.config.newUser.thisForm.valid()){
                        vr = confirm('Please Confirm');
                        if(vr){
                            $self.createnewUser($self.config.newUser.thisForm.serialize());
                        }                    
                    }   
                });

                //login form on submit
                $self.config.login.thisForm.on('submit', function(e){
                    e.preventDefault();
                    //console.log('got here');
                    $self.login($self.config.login.thisForm.serialize());
                });
            });
            
        },
        createnewUser: function(data){
            var self = Blog;
            console.log(data);
            processHttpRequest('controller/create/index.php', data, 'html').then(function(re){
                if(typeof re === 'string'){
                    $('#newuseralert').html(re);
                }
            }); 
        },
        login: function(data){
            var self = Blog;
            //console.log(data);
            processHttpRequest('controller/create/index.php', data, 'html').then(function(re){
                $('#loginalert').html(re);
                
            });
            // processHttpRequest('owner/controller/create/index.php', data, 'json').then(function(re){
            //     var result = JSON.parse(re);
            //     console.log(re);
            //     if(typeof result.success == 'object'){
            //         (result.success.successful) ? (window.location = 'index.php?goto=dashboard'): (window.location = 'index.php');exit;
            //         $('#loginalert').html(result);
            //     }
            //     if(typeof re === 'string'){
            //         $('#loginalert').html(re);
            //     }
            // });
            //console.log(data);
        }
    }
    User.init({
        newUser: {
            thisForm: $('#newuserform'),
            thisForminputs: $('#newuserform input'),
            nuserbtn: $('#nuserbtn')
        },
        login: {
            thisForm: $('#loginform')
        }
    });
	

    var Blog = {
        init: function(config){
            this.config = config;
            this.bindEvents();
        },
        bindEvents: function(){
            var $self = Blog;
            $(document).ready(function(){                
                //Generate Alias for New Blog Category
                $self.config.blogCat.name.on('keyup', function(e){
                    var $this = $(this);
                    e.preventDefault();
                    $self.Alias($self.config.blogCat.name, $self.config.blogCat.alias);
                });
                //Generate Alias for New Blog
                $self.config.addblog.name.on('keyup', function(e){
                    var $this = $(this);
                    e.preventDefault();
                    $self.Alias($self.config.addblog.name, $self.config.addblog.alias);
                });
            });
            // Forms Button Enable/Disable
            $(document).ready(function(){
                $self.config.blogCat.thisForminputs.on('keyup blur', function () { // fires on every keyup & blur
                    if (!$self.config.blogCat.thisForm.valid()) {   
                        $self.config.blogCat.ncatbtn.prop("disabled", "disabled");
                    } else {
                        $self.config.blogCat.ncatbtn.prop("disabled", false);   // disables button
                    }
                });
                $self.config.addblog.thisForminputs.on('keyup blur', function () { // fires on every keyup & blur
                    if (!$self.config.addblog.thisForm.valid()) {   
                        $self.config.addblog.blogbtn.prop("disabled", "disabled");
                    } else {
                        $self.config.addblog.blogbtn.prop("disabled", false);   // disables button
                    }
                });
            });
            //New Category form on Submit
            $self.config.blogCat.thisForm.on('submit', function(e){
                e.preventDefault();                             
                if($self.config.blogCat.thisForm.valid()){
                    vr = confirm('Please Confirm');
                    if(vr){
                        $self.createNewCat($self.config.blogCat.thisForm.serialize());
                    }                    
                }   
            });
            
            $(document).ready(function(){
                //New Blog form on Submit
                $self.config.addblog.thisForm.on('submit', function(e){
                    var $this = $(this);
                    e.preventDefault();
                    if($.trim($('#summertext').html()) !==''){
                        var textdata = $.trim($('#summertext').html());
                        $('#blogtext').val(textdata);
                        //console.log($('#summertext').html()); 
                        if($self.config.addblog.thisForm.valid()){
                            var blogdata = new FormData(($(this)[0]));
                            vr = confirm('Please Confirm');
                            if(vr){
                                $.ajax({
                                    type: 'POST',
                                    url: 'controller/create/index.php',
                                    data: blogdata,
                                    cache: false,
                                    enctype: 'multipart/form-data',
                                    contentType: false,
                                    processData: false,
                                    success: function(data){
                                        
                                            $('#newblogalert').html(data);
                                        
                                    }
                                });
                            }                    
                        } 
                    }  
                });

                //Delete Blog link on click
                $self.config.del_blog.btn.on('click', function(e){
                    var vr = confirm('Are you sure you want to delete this Blog?');
                    if(vr){
                        var $this = $(this);
                        e.preventDefault();
                        var $data = decodeURIComponent($this.data('deldata'));
                        var data_obj = ((typeof $data) !== 'object') ? JSON.parse($data) : $data;
                        processHttpRequest('controller/delete/index.php',  data_obj, 'json').then(function(re){
                            var result = JSON.parse(re);
                            if(typeof result.success == 'object'){
                                (result.success.successful) ? setTimeout(function(){location.reload(true)}, 3000): false;exit;
                            }
                            if(typeof re === 'string'){
                                $('#blogtablealert').html(re);
                            }
                        });
                    }
                });
                //Delete Cat link on click
                $self.config.del_cat.btn.on('click', function(e){
                    var vr = confirm('Are you sure you want to delete this Blog Category?');
                    if(vr){
                        var $this = $(this);
                        e.preventDefault();
                        // console.log(decodeURIComponent($this.data('deldata')));
                        var $data = decodeURIComponent($this.data('delcat'));
                        var data_obj = ((typeof $data) !== 'object') ? JSON.parse($data) : $data;
                        //console.log(data_obj);
                        processHttpRequest('controller/delete/index.php',  data_obj, 'json').then(function(re){
                            var result = JSON.parse(re);
                            if(typeof result.success == 'object'){
                                (result.success.successful) ? setTimeout(function(){location.reload(true)}, 3000): false;exit;
                            }
                            if(typeof re === 'string'){
                                $('#cattablealert').html(re);
                            }
                        });
                    }
                });
            });
        },
        // generate alias method
        Alias: function(from, to){
            var self = Blog;
            var alias = from.val();
            alias = alias.replace(/\W+(?!$)/g, '-').toLowerCase();
            alias = alias.replace(/\W$/, '').toLowerCase();
            //console.log(alias);
            //self.config.blogCat.alias.val(alias);
            to.val(alias);
        },
        //create new category method
        createNewCat: function(data){
            var self = Blog;
            //console.log(data);
            processHttpRequest('controller/create/index.php', data, 'html').then(function(re){
                if(typeof re === 'string'){
                    //console.log(re);
                    $('#newcatalert').html(re);
                    //window.open('http://localhost:8012/me/index.php?page=profile','_self');
                }
            });            
        },
        loadCatList: function(){
            // processHttpRequest('controller/read/index.php','r_type=cat_list','json').then(function(results){ 
            //  //var $rst = JSON.parse(results);
            //  console.log(results);
            //  // if($rst.total !== undefined){
            //  //  //console.log($rst);
            //  //  $that.config.totalQues = parseInt($rst.total);
            //  //  $('#total_qes').text($rst.total);
            //  // }
                 
            // });
        },
    };
    Blog.init({
        blogCat : {
            thisForm:   $('#newcatform'),
            thisForminputs:   $('#newcatform input'),
            name:   $('#catname'),
            alias:  $('#catalias'),
            ncatbtn:  $('#newcatbtn')
        },
        cat_list: $('.catlist').first(),
        addblog: {
            thisForm: $('#newblogform'),
            thisForminputs:   $('#newblogform input'),
            name:   $('#blogtitle'),
            alias:  $('#blogalias'),
            blogbtn:  $('#newblogbtn')
        },
        del_cat:{
            btn: $('.del-cat'),
        },
        del_blog: {
            btn: $('.del-blog'),
        }
    });


    var Resource = {
        init: function(config){
            this.config = config;
            this.bindEvents();
        },
        bindEvents: function(){
            $self = Resource;
            $self.config.new.thisForm.on('submit', function(e){
                e.preventDefault();
                //$self.processForm($self.new.thisForm.serialize(), $self.config.new.alert);
                var $this = $(this);
                if($self.config.new.thisForm.valid()){
                    var resdata = new FormData(($(this)[0]));
                    console.log(resdata);
                    vr = confirm('Please Confirm');
                    if(vr){
                        $.ajax({
                            type: 'POST',
                            url: 'controller/create/index.php',
                            data: resdata,
                            cache: false,
                            enctype: 'multipart/form-data',
                            contentType: false,
                            processData: false,
                            success: function(data){
                                console.log(data);
                                $self.config.new.alert.html(data);
                            }
                        });
                    }                    
                }
            });
            
        },
        processForm: function(data, alert){
            console.log(data)
            var self = Resource;
            processHttpRequest('controller/create/index.php',  data, 'html').then(function(re){
                if(typeof re === 'string'){
                    //console.log(re);
                    alert.html(re);
                    // setTimeout(function(){
                    //          location.reload(true);
                    //      }, 3000);
                }
            });
        }
    }
    Resource.init({
        new: {
            thisForm: $('#newresform'),
            alert: $('#newresalert')
        }
    });
	

    console.log('owner is heree');

})( jQuery );