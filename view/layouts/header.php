<?php
  // echo phpinfo();exit;
  if(isset($_GET['goto'])){
    switch($_GET['goto']){
      case 'blog-single':
        // Initialize Blog
        $blogdata = new Blog();
        $meta_title = !isset($_GET['article']) ? false : $_GET['article'];
        if(!$blogdata->find(escape($meta_title))){
          $blogdata = "";
        }

        // print_r('<pre>');
        // print_r($blogdata); 
        // //print_r('am here babe');
        // print_r('</pre>');
      break;
    }
  }
 
?>

<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
  <meta charset="utf-8">
  <meta name="author" content="etari">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Design Angency, Logo Design, Graphics Design, Web Develoment and Design, Print Shop">
  <meta name="keywords" content="logo, design, web, graphics, print, seo, Nigeria, Abuja">

  

  <!-- Open Graph Meta Tag  $title, $des, $img, $url -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@EtariCreatives" />
  <meta name="twitter:creator" content="@EtariCreatives" />
  <?php 
    if(!empty($blogdata)){
      $url = "http://etaricreatives.com/index.php?goto=blog-single&article=". $blogdata->data()->alias;
      metaData($blogdata->data()->title, $blogdata->data()->short_desc, $blogdata->data()->image, $url);
    }
  ?>

  <!-- Fav Icon  -->
  <link rel="shortcut icon" href="media/images/favicon.png">
  <!-- Site Title  -->
  <title>etari - Creative Agency &amp; Digital Web Agency</title>
  <!-- Bundle and Base CSS -->
  <link rel="stylesheet" href="includes/assets/css/custom.css">
  <link rel="stylesheet" href="includes/assets/css/vendor.bundleba3a.css?ver=101">
  <link id="color-sheet" rel="stylesheet" href="includes/assets/css/styleba3a.css?ver=101">
  <link rel="stylesheet" href="includes/assets/css/themeba3a.css?ver=10
</head>
 1">
<body class="body-wider">
 <!-- Load Facebook SDK for JavaScript -->
 <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
    <!-- Header -->
    <header class="is-transparent is-sticky is-shrink" id="header">
        <div class="header-main">
        <div class="header-container container">
          <div class="header-wrap">
            <!-- Logo  -->
            <div class="header-logo logo">
              <a href="index.php" class="logo-link">
                <img class="logo-dark" src="media/images/logo.png" srcset="media/images/logo.png 2x" alt="logo">
                <img class="logo-light" src="media/images/logo-white.png" srcset="media/images/logo-white.png 2x" alt="logo">
              </a>
                        </div>
                        
                        <!-- Menu Toogle -->
            <div class="header-nav-toggle">
              <a href="#" class="search search-mobile search-trigger"><i class="icon ti-search "></i></a>
              <a href="#" class="navbar-toggle" data-menu-toggle="header-menu">
                <div class="toggle-line">
                  <span></span>
                </div>
              </a>
            </div>
            <!-- Menu Toogle -->
            
            <!-- Menu -->
            <div class="header-navbar">
              <nav class="header-menu" id="header-menu">
                <ul class="menu">
                  <li class="menu-item">
                    <a class="menu-link nav-link active" href="index.php">Home</a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link nav-link" href="index.php#services">Services</a>
                  </li>
                  <li class="menu-item"><a class="menu-link nav-link" href="index.php?goto=projects">Projects</a></li>
                  <li class="menu-item"><a class="menu-link nav-link" href="index.php?goto=pricing">Pricing</a></li>
                  <!-- <li class="menu-item"><a class="menu-link nav-link" href="index.php?goto=contact">Contact</a></li> -->
                  <li class="menu-item"><a class="menu-link nav-link" href="index.php?goto=blog">Blog</a></li>
                </ul>
                <ul class="menu-btns">
                  <li><a href="" class="btn search search-trigger"><i class="icon ti-search "></i></a></li>
                  <li><a href="index.php?goto=contact" class="btn btn-sm">Get Started</a></li>
                </ul>
              </nav>
            </div><!-- .header-navbar -->  
    
                        <!-- header-search -->
                        <div class="header-search">
                            <form role="search" method="POST" class="search-form" action="#">
                                <div class="search-group">
                                    <input type="text" class="input-search" placeholder="Search ...">
                                    <button class="search-submit" type="submit"><i class="icon ti-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- . header-search -->
          </div>
        </div>
      </div>