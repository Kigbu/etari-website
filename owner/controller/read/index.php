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

    // Initislize user
    $user = new User();

    if(isXHR() && Input::exists() && Input::get('r_type')){
        switch(Input::get('r_type')){
            case 'cat_list':
                //echo 'here we are';                
            break;
        }
    }
?>