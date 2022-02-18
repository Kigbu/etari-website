<?php
    require_once('../../../core/init.php');
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Initislize validation
    $validate = new Validate();

    // Initislize Blog
    $blog = new Blog();

    // Initislize Category
    $category = new Category();

    // Initislize User
    $user = new User();
    
    //Initialize Image
    $image = New Image();

    if(isXHR() && Input::exists() && Input::get('what')){
        switch(Input::get('what')){
            case 'newblogcat':
                $validation = $validate->check($_POST, array(
                    'catname' => array(
                                        'required' => true,
                                        'max' => 100,
                                    ),
                    'catalias' => array(
                                        'required' => true,
                                        'max' => 50,
                                    )
                ));
                if($validation->passed()){
                    if(!$category->find(Input::get('catalias'))){
                        try{
                            $category->create(array(
                                'name' => Input::get('catname'),
                                'access_level' => 1,
                                'alias' => Input::get('catalias'),
                                'state' => '1',
                                'created' =>date('Y-m-d h:i:s', time())
                            ));
                            echo myMessage('Category Added', 'Success');exit;
                        }catch(Exception $e){
                            echo myMessage($e->getMessage(), 'Error');
                        }
                    }else{
                        echo myMessage('Category Already Exist', 'Error');exit;
                    }
                }else{
                    echo myMessage('Some Error occured! Please fill all required fields', 'Error');
                    //echo myMessage(implode(', ', $validation->errors()), 'Error');
                }
            break;
            case 'newblog':
                // print_r('<pre>');
                // print_r($_FILES);
                // print_r('</pre>');exit();
                $validation = $validate->check($_POST, array(
                    'blogtitle' => array(
                                        'required' => true,
                                        'max' => 50,
                                    ),
                    'blogalias' => array(
                                        'required' => true,
                                    ),
                    'blogcat' => array(
                                        'required' => true,
                                    ),
                    'shortdesc' => array(
                                        'required' => true,
                                        'max' => 250,
                                        'min' =>150
                                    ),
                    'btext' => array(
                                        'required' => true,
                                        'min' => 250,
                                    )
                ));
                if($validation->passed()){
                    if(!$blog->find(Input::get('blogalias'))){
                        try{
                            if(!empty($_FILES['blogimg'])){
                                //resize and upload images
                                $server_dir = "../../../media/images/blog_img/";
                                $img_data = Image::validateImage('admin'.'_'.Input::get('blogalias'), $_FILES, $_FILES['blogimg'], $server_dir, 'blog', '1000');
                                if($img_data != ''){
                                    $blog->create(array(
                                        'cat_id'        => Input::get('blogcat'),
                                        'title'         => Input::get('blogtitle'),
                                        'short_desc'    => Input::get('shortdesc'),
                                        'content'       => Input::get('btext'),
                                        'image'         => $img_data,
                                        'author'        => 'Admin',
                                        'alias'         => Input::get('blogalias'),
                                        'state'         => 1,
                                        'created'       => date('Y-m-d h:i:s', time())
                                    ));
                                    echo myMessage('New Blog Added, Please Refresh Page', 'Success');exit;
                                    //echo json_encode(array("success" => ["successful" => true])); exit;
                                }else{
                                    echo myMessage('Image Upload Failed,Please Try Again', 'Error');exit;
                                }
                            }else{
                                echo myMessage('Please Upload Image', 'Error');exit;
                            }
                        }catch(Exception $e){
                            echo myMessage($e->getMessage(), 'Error');
                        }
                    }
                    else{
                        echo myMessage('Another Article with Title Already Exist', 'Error');exit;
                    }
                }
                else{
                    echo myMessage('Some Error occured! Please fill all required fields', 'Error');
                    //echo myMessage(implode(', ', $validation->errors()), 'Error');
                }
            break;
            case 'newuser':
                $validation = $validate->check($_POST, array(
                    'fullname' => array(
                                        'required' => true,
                                        'max' => 50,
                                    ),
                    'username' => array(
                                        'required' => true,
                                        'min' => 4,
                                        'max' => 10,
                                        'unique' => 'user_access',
                                        'lettersonly' => true,
                                    ),
                    'email'  =>  array(
                                        'required' => true,
                                        'max' => 50,
                                        'validemail' => true,
                                        'unique' => 'user_access'
                                        ),
                    'phonenumber' => array(
                                        'required' => true,
                                        'max' => 14,
                                        'min' => 9,
                                        'validNumber' => true
                                    ),
                    'password' => array(
                                        'required' => true,
                                        'min' => 6
                                    ),
                    'passwordagain' => array(
                                        'required' => true,
                                        'matches' => 'password'
                                    )
                ));
                if($validation->passed()){
                    try{
                        $user->create(array(
                            'username'      => Input::get('username'),
                            'phone'         => Input::get('phonenumber'),
                            'email'         => Input::get('email'),
                            'fullname'      => Input::get('fullname'),
                            'password'      => Hash::make(Input::get('password')),
                            'logged_in'     => 0,
                            'confirmed'     => 1,
                            'access_level'  => 1,
                            'user_status'   => 1,
                            'created'       => date('Y-m-d h:i:s', time())
                        ));
                        echo myMessage('New User Created', 'Success');exit;
                    }catch(Exception $e){
                        echo myMessage($e->getMessage(), 'Error');
                    }
                }else{
                    echo myMessage('Some Error occured! Please fill all required fields', 'Error');
                    //echo myMessage(implode(', ', $validation->errors()), 'Error');
                }
            break;
            case 'logging':

                $validation = $validate->check($_POST, array(
                    'username' => array('required' => true, 'min' => 4), 
                    'loginpassword' => array('required' => true)
                ));

                if($validation->passed()){
                    if($user->find(Input::get('username'))){
                        // print_r('<pre>');
                        // print_r($user);
                        // print_r('</pre>');exit();
                        $remember = (Input::get('remember') === 'on')? True : false;
                        $login = $user->login(trim(Input::get('username')), Input::get('loginpassword'), $remember);
                        if($login){
                            echo "<script type='text/javascript'>window.location='index.php?goto=dashboard'</script>";exit();
                            //echo json_encode(array("success" => ["successful" => true])); exit;
                        }else{
                            echo myMessage('Sorry, Logging in Failed.', 'Error');exit;
                        }
                    } else {
                         echo myMessage('You Dont have an account. Please contact the Admin', 'Error');exit;
                    }
                } else {
                    echo myMessage(implode(', ', $validation->errors()), 'Error');exit;
                }
            break;
            case 'resupload': 

                // print_r('<pre>');
                // print_r($_FILES);
                // print_r("</pre>");exit();              
                $validation = $validate->check($_POST, array(
                    'name' => array(
                                        'required' => true,
                                        'min' => 4,
                                        'max' => 100,
                                    ),
                    'desc' => array(
                                        'required' => true,
                                        'max' => 100,
                                        'min' => 80
                                    )
                ));
                if($validation->passed()){                    
                    if(!empty($_FILES['resfile'])){
                        try{
                            
                                

                        } catch (Exception $e){
                            echo myMessage($e->getMessage(), 'Error');
                        }
                    }else{
                        echo myMessage('Please Upload File', 'Error');
                    }
                } else {
                    echo myMessage('Some Error occured! Please fill all required fields', 'Error');
                    //echo myMessage(implode(', ', $validation->errors()), 'Error');exit;
                }
            break;
        }

    }else{
        Redirect::to('../../index.php');exit;
    }


?>