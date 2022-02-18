<?php
    // phpinfo();exit;
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Initialize Blog
    $blog = new Blog();

    // Initialize Category
    $category = new Category();

    // Initislize Pagination
    $pagination = new Pagination();


    $cat_alias = !isset($_GET['category']) ? false : $_GET['category'];

    $category->returnId(escape($cat_alias));
    $cat_id = $category->data()->id;

    //Blog Pagination
    $page_state = isset($_GET['page'])? trim($_GET['page']): 1;
    $per_page = 9;
    $total_record = $blog->countAll($cat_id);

    $paginate = new Pagination(escape($page_state), $per_page, $total_record);
    $bloglist = $blog->getBlogsPerPageCategory($per_page, $paginate->offset(), $cat_id);

    // print_r('<pre>');
    // print_r($bloglist);
    // print_r('</pre>');exit;
?>
			<div class="banner banner-inner banner-inner-s4 tc-light">
				<div class="banner-block">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-md-8 col-sm-9">
								<div class="banner-content">
									<h1 class="banner-heading t-u">blog</h1>
									<!--<ul class="banner-menu">
										<li><a href="index.html">Home</a></li>
										<li><a>Blog</a> </li>
									</ul>-->
								</div>
							</div><!-- .col -->
						</div><!-- .row -->
					</div><!-- .container -->
					<!-- bg -->
					<div class="bg-image">
						<img src="media/images/banner-sm-i.jpg" alt="banner">
					</div>
					<!-- end bg -->
				</div>
			</div>
			<!-- .banner -->  
		</header>
		<!-- end header -->

		<!-- section-news -->
		<div class="section section-x section-news">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6 text-center">
						<div class="section-head section-md">
							<h5 class="heading-xs">Blog Category</h5>
							<h2><?php echo $category->data()->name; ?></h2>
						</div>
					</div>
				</div><!-- .row -->
				<div class="row gutter-vr-30px text-center justify-content-center">
                    <?php 
						if(!empty($bloglist)){
						foreach($bloglist as $blogs){
					?>
					<div class="col-sm-6 col-lg-4">
						<div class="post post-alt shadow">
							<div class="post-thumb">
								<a href="index.php?goto=blog-single&article=<?php echo escape($blogs->alias) ;?>"><img src="<?php echo escape($blogs->image); ?>" alt="post"></a>
							</div>
							<div class="post-content">
								<p class="post-tag"><?php echo datetime_to_text(escape($blogs->created)) ;?></p>
								<h4><a href="index.php?goto=blog-single&article=<?php echo escape($blogs->alias) ;?>"><?php echo escape($blogs->title) ;?></a></h4>
								<a href="index.php?goto=blog-single&article=<?php echo escape($blogs->alias) ;?>" class="btn btn-arrow">Read More</a>
							</div>
						</div><!-- .post -->
					</div><!-- .col -->
                    <?php } } else{ ?>
                        <h5 class="heading-xs">No Post for this Category</h5>
                    <?php } ?>
				</div><!-- .row -->
				<div class="row">
					<div class="col-12 text-center">
						<div class="button-area button-area-md">
							<ul class="pagination">
                                <?php
                                     if($paginate->has_previous_page()){
                                        echo '<li>';
                                        echo '<a href="index.php?goto=blog-category&category=';echo $cat_alias; echo'&page=';echo $paginate->previous_page() ;
                                        echo'"><</a>';
                                        echo '</li>';
                                    }							
                                    for($i = 1; $i <= $paginate->total_pages(); $i++){
                                        if($i == $page_state){
                                            echo '<li class="active">';
                                            echo '<a href="index.php?goto=blog-category&category=';echo $cat_alias; echo'&page='; echo $i; echo '">'; echo $i; echo '</a>';
                                            echo '</li>';									
                                        } else {
                                            echo '<li class="">';
                                            echo '<a href="index.php?goto=blog-category&category=';echo $cat_alias; echo'&page='; echo $i; echo '">'; echo $i; echo '</a>';
                                            echo '</li>';
                                        }
                                    }
                                    if($paginate->has_next_page()){
                                        echo '<li>';
                                        echo '<a href="index.php?goto=blog-category&category=';echo $cat_alias; echo'&page=';echo $paginate->next_page() ;
                                        echo'">></a>';
                                        echo '</li>';
                                    }
                                ?>
							</ul>
						</div>
					</div><!-- .col -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div>
		<!-- .section-news -->
		
		<!-- section / cta-->
	<div class="section section-cta bg-primary tc-light">
		<div class="container">
			<div class="row gutter-vr-30px align-items-center justify-content-between">
				<div class="col-lg-8 text-center text-lg-left">
					<div class="cta-text">
						<h2>Like what you see? <strong> Let’s work </strong></h2>
					</div>
				</div>
				<div class="col-lg-4 text-lg-right text-center">
					<div class="cta-btn">
						<a href="index.php?goto=contact" class="btn">Contact us</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .section-cta -->