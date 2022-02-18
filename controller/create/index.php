<?php
    require_once('../../core/init.php');
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    //Initialize User
    $user = new User();
    //Initialize Message
    $messages = new Messages();

    $request = new Request();

     // Initislize validation
    $validate = new Validate();

    // Initislize Blog
    $blog = new Blog();

    // Initislize Category
    $category = new Category();

    // print_r('<pre>');
    // print_r($_POST);
    // print_r('</pre>');exit;

    if(isXHR() && Input::exists() && Input::get('what')){
        switch(Input::get('what')){
            case 'logo':
                $validation = $validate->check($_POST, array(
                    'name' => array(
                                        'required' => true,
                                        'max' => 100,
                                        'min' => 4,
                                    ),
                    'email' => array(
                                        'required' => true,
                                        'max' => 50,
                                        'validemail' => true,
                                    ),
                    'phonenumber' => array(
                                        'required' => true,
                                        'max' => 14,
                                        'min' => 9,
                                        'validNumber' => true
                                    ),
                    'message' => array(
                                        'required' => true,
                                        'max' => 150,
                                        'min' => 4,
                                    )
                ));
                if($validation->passed()){
                    try{
                        $request->create(array(
                            'name'          => Input::get('name'),
                            'email'         => Input::get('email'),
                            'phone'         => Input::get('phonenumber'),
                            'message'       => Input::get('message'),
                            'request_service' =>   Input::get('service'),
                            'request_package'   =>Input::get('package'),
                            'read_state'    => 1,
                            'request_state'     => 1,
                            'request_date'       => date('Y-m-d h:i:s', time())
                        ));
                        

                        $sendmessage = "Inquiry from: ".Input::get('name')." Email: ".Input::get('email').", Phone:".Input::get('phonenumber')."\n".Input::get('message');

                        $sms ="New Request from: ".Input::get('name')." Email: ".Input::get('email').", Phone:".Input::get('phonenumber')."Package: ".Input::get('service')."(".Input::get('package').")";
                        //if(Messages::send($sendmessage, Messages::NEW_PUBLIC_MESSAGE_SUBJECT) && Messages::thankYouforContact(Input::get('email'))){

                            
                        //}

                        Messages::smsAPI(trim(Input::get('phonenumber')), "Your Message has been sent....We'll get back  to  you shortly..thank'", 'ETARI');

                        Messages::smsAPI('2347032901083',$sms, 'ETARI');

                        echo myMessage('Request Sent, well get back to you shortly', 'Success');exit;

                    }catch(Exception $e){
                        echo myMessage($e->getMessage(), 'Error');
                    }
                }else{
                    echo myMessage(implode(', ', $validation->errors()), 'Error');
                }
            break;
            case 'graphic':
                $validation = $validate->check($_POST, array(
                    'name' => array(
                                        'required' => true,
                                        'max' => 100,
                                        'min' => 4,
                                    ),
                    'email' => array(
                                        'required' => true,
                                        'max' => 50,
                                        'validemail' => true,
                                    ),
                    'phonenumber' => array(
                                        'required' => true,
                                        'max' => 14,
                                        'min' => 9,
                                        'validNumber' => true
                                    ),
                    'message' => array(
                                        'required' => true,
                                        'max' => 150,
                                        'min' => 4,
                                    )
                ));
                if($validation->passed()){
                    try{
                        $request->create(array(
                            'name'          => Input::get('name'),
                            'email'         => Input::get('email'),
                            'phone'         => Input::get('phonenumber'),
                            'message'       => Input::get('message'),
                            'request_service' =>   Input::get('service'),
                            'request_package'   =>Input::get('package'),
                            'read_state'    => 1,
                            'request_state'     => 1,
                            'request_date'       => date('Y-m-d h:i:s', time())
                        ));
                        
                        $sendmessage = "Inquiry from: ".Input::get('name')." Email: ".Input::get('email').", Phone:".Input::get('phonenumber')."\n".Input::get('message');

                        $sms ="New Request from: ".Input::get('name')." Email: ".Input::get('email').", Phone:".Input::get('phonenumber')."Package: ".Input::get('service')."(".Input::get('package').")";
                        //if(Messages::send($sendmessage, Messages::NEW_PUBLIC_MESSAGE_SUBJECT) && Messages::thankYouforContact(Input::get('email'))){

                            
                        //}

                        Messages::smsAPI(trim(Input::get('phonenumber')), "Your Message has been sent....We'll get back  to  you shortly..thank'", 'ETARI');

                        Messages::smsAPI('2347032901083',$sms, 'ETARI');
                        echo myMessage('Request Sent, well get back to you shortly', 'Success');exit;

                    }catch(Exception $e){
                        echo myMessage($e->getMessage(), 'Error');
                    }
                }else{
                    echo myMessage(implode(', ', $validation->errors()), 'Error');
                }
            break;
            case 'web':
                $validation = $validate->check($_POST, array(
                    'name' => array(
                                        'required' => true,
                                        'max' => 100,
                                        'min' => 4,
                                    ),
                    'email' => array(
                                        'required' => true,
                                        'max' => 50,
                                        'validemail' => true,
                                    ),
                    'phonenumber' => array(
                                        'required' => true,
                                        'max' => 14,
                                        'min' => 9,
                                        'validNumber' => true
                                    ),
                    'message' => array(
                                        'required' => true,
                                        'max' => 150,
                                        'min' => 4,
                                    )
                ));
                if($validation->passed()){
                    try{
                        $request->create(array(
                            'name'          => Input::get('name'),
                            'email'         => Input::get('email'),
                            'phone'         => Input::get('phonenumber'),
                            'message'       => Input::get('message'),
                            'request_service' =>   Input::get('service'),
                            'request_package'   =>Input::get('package'),
                            'read_state'    => 1,
                            'request_state'     => 1,
                            'request_date'       => date('Y-m-d h:i:s', time())
                        ));
                        

                        $sendmessage = "Inquiry from: ".Input::get('name')." Email: ".Input::get('email').", Phone:".Input::get('phonenumber')."\n".Input::get('message');

                        $sms ="New Request from: ".Input::get('name')." Email: ".Input::get('email').", Phone:".Input::get('phonenumber')."Package: ".Input::get('service')."(".Input::get('package').")";
                        //if(Messages::send($sendmessage, Messages::NEW_PUBLIC_MESSAGE_SUBJECT) && Messages::thankYouforContact(Input::get('email'))){

                            
                        //}

                        Messages::smsAPI(trim(Input::get('phonenumber')), "Your Message has been sent....We'll get back  to  you shortly..thank'", 'ETARI');

                        Messages::smsAPI('2347032901083',$sms, 'ETARI');
                        echo myMessage('Request Sent, well get back to you shortly', 'Success');exit;

                    }catch(Exception $e){
                        echo myMessage($e->getMessage(), 'Error');
                    }
                }else{
                    echo myMessage(implode(', ', $validation->errors()), 'Error');
                }
            break;
            case 'contact':
                // print_r('<pre>');
                // print_r($_POST);
                // print_r('</pre>');exit;
                $validation = $validate->check($_POST, array(
                    'name' => array(
                                        'required' => true,
                                        'max' => 100,
                                        // 'min' => 4,
                                    ),
                    'email' => array(
                                        'required' => true,
                                        'max' => 50,
                                        'validemail' => true,
                                    ),
                    'details' => array(
                                        'required' => true,
                                        'max' => 150,
                                        'min' => 4,
                                    ),
                    'phonenumber' => array(
                                        'required' => true,
                                        'max' => 14,
                                        'min' => 9,
                                        'validNumber' => true
                                    ),
                    'budget' => array(
                                        'required' => true,
                                        'max' => 20,
                                        'min' => 4,
                                    )
                ));
                if($validation->passed()){
                    try{
                         $messages->create(array(
                            'name'          => Input::get('name'),
                            'email'         => Input::get('email'),
                            'phone'         => Input::get('phonenumber'),
                            'details'       => Input::get('details'),
                            'budget'        => Input::get('budget'),
                            'read_state'    => 1,
                            'message_state' => 1,
                            'message_date'  => date('Y-m-d h:i:s', time())
                         ));  

                         $sendmessage = "Message from: ".Input::get('name')." Email: ".Input::get('email').", Phone:".Input::get('phonenumber')."\n".Input::get('details')."\nBudget :".Input::get('details');

                        $sms ="New Message from: ".Input::get('name')." Email: ".Input::get('email').", Phone:".Input::get('phonenumber');
                        //if(Messages::send($sendmessage, Messages::NEW_PUBLIC_MESSAGE_SUBJECT) && Messages::thankYouforContact(Input::get('email'))){

                            
                        //}

                        Messages::smsAPI(trim(Input::get('phonenumber')), "Your Message has been sent....We'll get back to you shortly..thank'", 'ETARI');

                        Messages::smsAPI('2347032901083',$sms, 'ETARI');                    

                         echo myMessage('Message Sent, well get back to you shortly', 'Success');exit;
                    }catch(Exception $e){
                        echo myMessage($e->getMessage(), 'Error');
                    }
                }else{
                    echo myMessage(implode(', ', $validation->errors()), 'Error');
                }
            break;
        }
    }
?>