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

    if(isXHR() && Input::exists() && Input::get('what')){
        switch(Input::get('what')){
            case 'del_blog':
                if($user->isLoggedIn()){
                    if($blog->find(Input::get('blog_id'))){
                        $update = $blog->update(array(
                            'state' => 0
                            ), $blog->data()->blog_id);
                        if($update){
                            echo json_encode(array("success" => ["successful" => true])); exit;
                        }else{
                            echo myMessage('Some Error Occured, Please Try Again', 'Error');exit;
                        }
                    }
                }
            break;
            case 'del_cat':
            if($user->isLoggedIn()){
                if($category->find(Input::get('cat_id'))){                    
                    $update = $category->update(array(
                        'state' => 0
                        ), $category->data()->id);
                    if($update){
                        echo json_encode(array("success" => ["successful" => true])); exit;
                    }else{
                        echo myMessage('Some Error Occured, Please Try Again', 'Error');exit;
                    }
                }
            }
            break;
        }

    }else{
        Redirect::to('../../index.php');exit;
    }
    // print_r('<prev>');
    // print_r($blog);
    // print_r('</prev>');exit;
?>