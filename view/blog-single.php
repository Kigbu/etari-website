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

    // Initialize Pagination
    $user = new user();

    //get single blog
    $article = !isset($_GET['article']) ? false : $_GET['article'];

	$blog->find(escape($article));
?>
			<div class="banner banner-inner tc-light">
					<div class="banner-block">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div class="banner-content">
										<h1 class="banner-heading">Blog Single</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="bg-image">
							<img src="media/images/banner-sm-g.jpg" alt="banner">
						</div>
					</div>
				</div>
				<!-- .banner -->  
			</div>
		</header>
		<!-- end header -->

		<!-- section/blog -->
		<div class="section blog section-xx">
			<div class="container">
				<div class="row gutter-vr-40px">
					<div class="col-md-8">
						<?php if(!empty($blog->data())){ ?>
						<div class="post post-full post-details">
							<div class="post-thumb">
								<img src="<?php echo $blog->data()->image;?>" alt="">
							</div>
							<div class="post-entry d-sm-flex d-block align-items-start">
								<div class="content-left d-flex d-sm-block">
									<div class="post-date">
										<p><?php echo get_date_month($blog->data()->created);?> <strong><?php echo get_date_date($blog->data()->created);?></strong></p>
									</div>
									<ul class="social text-center">

										<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?app_id=2733063326745199&sdk=&u=http%3A%2F%2Fwww.etaricreatives.com%2Findex.php%3Fgoto=blog-single%26article=<?php echo escape($blog->data()->alias);?>&display=popup&ref=plugin&src=share_button" onlick="return !window.open(this.href, 'Facebook', 'width=640,height580')" class="fac fab fa-facebook-f"></a></li>

										<li><a target="_blank" href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.etaricreatives.com%2Findex.php%3Fgoto=blog-single%26article=<?php echo escape($blog->data()->alias);?>" class="fac fab fa-facebook-f"></a></li>
										
										
										<li><a href="https://twitter.com/share?url=http://www.etaricreatives.com/index.php?goto=blog-single&article=<?php echo escape($blog->data()->alias);?>&text=<?php echo $blog->data()->title;?>" class="twi fab fa-twitter"></a></li>


										<li><a target="_blank" href="http://www.twitter.com/intent/tweet?url=http://www.etaricreatives.com/index.php?goto=blog-single&article=<?php echo escape($blog->data()->alias);?>&text=<?php echo $blog->data()->title;?>&text=<?php echo $blog->data()->title;?>" class="twi fab fa-twitter"></a></li>
										
										<li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fwww.etaricreatives.com%2Findex.php%3Fgoto=blog-single%26article=<?php echo escape($blog->data()->alias);?>" class="twi fab fa-linkedin-in"></a></li>

										<li><a href="https://wa.me/?text=<?php echo escape($blog->data()->title);?> http://www.etaricreatives.com/index.php?goto=blog-single&article=<?php echo escape($blog->data()->alias);?>" class="twi fab fa-whatsapp"></a></li>

									</ul>
								</div>
								<div class="post-content">
									<div class="post-meta d-block d-lg-flex align-items-center">
										<div class="post-author d-flex align-items-center">
											<div class="author-thumb">
												<img src="media/images/user.png" alt="">
											</div>
											<div class="author-name">
												<p><?php echo $blog->data()->author;?></p>
											</div>
										</div>
										<div class="post-tag d-flex">
											<ul class="post-cat">
												<?php $category->find($blog->data()->cat_id);?>
												<li><a href="#"><em class="icon ti-bookmark"></em><span><?php echo $category->data()->name;?></span></a></li>
											</ul>
										</div>
									</div>
									<h3><?php echo $blog->data()->title;?></h3>
									<div class="content align-justify">
										<p><?php echo $blog->data()->content;?></p>
									</div>
								</div>
							</div>
						</div><!-- .post -->
						<?php }else{ echo 'Article not found'; }?>
					</div><!-- .col -->
					<div class="col-md-4 pl-lg-4">
						<div class="sidebar">
							<div class="wgs wgs-sidebar bg-secondary wgs-recents">
								<h3 class="wgs-heading">Recent News</h3>
								<div class="wgs-content">
									<ul class="post-recent">
										<?php
                                            $recents  = $blog->recent();
                                            // print_r('<pre>');
                                            // print_r($recents);
                                            // print_r('</pre>');exit;
                                            if(!empty($recents)){
                                            foreach($recents as $recent){
                                        ?>
                                        <li>
                                            <h5><a href="index.php?goto=blog-single&article=<?php echo escape($recent->alias) ; ?>"><?php echo escape($recent->title); ?> </a></h5>
                                            <p class="post-tag"><?php echo datetime_to_text(escape($recent->created)) ;?></p>
                                        </li>
                                        <?php } } ?>
									</ul>
								</div>
							</div><!-- .wgs -->
						</div><!-- .sidebar -->
					</div><!-- .col -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div>
		<!-- end section/blog -->
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