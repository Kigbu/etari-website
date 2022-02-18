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


    //Blog Pagination
    $page_state = isset($_GET['page'])? trim($_GET['page']): 1;
    $per_page = 3;
    $total_record = $blog->countAll();
    $paginate = new Pagination(escape($page_state), $per_page, $total_record);
    $bloglist = $blog->getBlogsPerPage($per_page, $paginate->offset());
    // print_r('<pre>');
    // print_r($bloglist);
    // print_r('</pre>');exit;

	// share blog post
	?>			
			<div class="banner banner-inner tc-light">
				<div class="banner-block">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="banner-content">
									<h1 class="banner-heading">Blog</h1>
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
	<div class="section blog tc-bunker">
		<div class="container">

			<div class="row gutter-vr-30px">
				<div class="col-md-8">
					<?php 
						if(!empty($bloglist)){
						foreach($bloglist as $blogs){
					?>
					<div class="post post-full">
						<div class="post-thumb">
							<a href="index.php?goto=blog-single&article=<?php echo escape($blogs->alias);?>">
								<img src="<?php echo escape($blogs->image); ?>" alt="">
							</a>
						</div>
						<div class="post-entry d-sm-flex d-block align-items-start">
							<div class="post-date">
							<p><?php echo get_date_month($blogs->created);?> <strong><?php echo get_date_date($blogs->created);?></strong></p>
							</div>
							<div class="post-content">
								<div class="post-author d-flex align-items-center">
									<div class="author-thumb">
										<img src="media/images/user.png" alt="">
									</div>
									<div class="author-name">
										<p><?php echo escape($blogs->author) ;?></p>
									</div>
								</div>
								<h2><a href="index.php?goto=blog-single&article=<?php echo escape($blogs->alias) ;?>"><?php echo $blogs->title;?></a></h2>
								<div class="content">
									<p><?php echo escape($blogs->short_desc) ;?></p>
								</div>
								<div class="post-tag d-flex">
									<?php $category->find($blogs->cat_id);?>
									<ul class="post-cat">
										<li><a href="#"><em class="icon ti-bookmark"></em> <span><?php echo $category->data()->name;?></span></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div><!-- .post -->
					<?php } } ?>
				</div><!-- .col -->
				<div class="col-md-8 order-md-last">
					<div class="button-area pagination-area">
						<ul class="pagination text-center text-md-right">
						<?php							
							for($i = 1; $i <= $paginate->total_pages(); $i++){							
								 if($i == $page_state){
									echo '<li class="active">';
									echo '<a href="index.php?goto=blog&page='; echo $i; echo '">'; echo $i; echo '</a>';
									echo '</li>';									
								 } else {
									echo '<li class="">';
									echo '<a href="index.php?goto=blog&page='; echo $i; echo '">'; echo $i; echo '</a>';
									echo '</li>';
								 }
							 }
						?>
						</ul>
					</div>
				</div><!-- .col -->
				<div class="col-md-4 pl-lg-4">
					<div class="sidebar">
						<div class="wgs wgs-sidebar bg-secondary wgs-recents">
							<h3 class="wgs-heading">Categories</h3>
							<div class="wgs-content">
								<ul class="post-recent">
									<?php
										$cats  =  $category->find();
										// print_r('<pre>');
										// print_r($recents);
										// print_r('</pre>');exit;
										if(!empty($cats)){
										foreach($cats as $cat){
											if($cat->state != 0){
									?>
									<li>
										<h5><a href="index.php?goto=blog-category&category=<?php echo escape($cat->alias) ; ?>"><?php echo escape($cat->name); ?></a></h5>
									</li>
									<?php } } } ?>
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