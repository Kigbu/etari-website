<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    // Initialize Blog
    $message = new Messages();

    // Initislize Pagination
    $pagination = new Pagination();

    // Initialize User
	$user = new User();

	$r_id = isset($_GET['r_id'])? trim($_GET['r_id']): false;
	$message->find($r_id);

    // print_r('<pre>');
    // print_r($message);
    // print_r('</pre>');exit;
?>
<body class="topnav-fixed ">
	<!-- WRAPPER -->
	<div id="wrapper" class="wrapper">
		<?php include("layouts/top-bar.php"); ?>
		<?php include("layouts/side-bar.php"); ?>
		<!-- MAIN CONTENT WRAPPER -->
		<div id="main-content-wrapper" class="content-wrapper expanded">
			<!-- top general alert -->
			<div class="alert alert-danger top-general-alert">
				<span>If you <strong>can't see the logo</strong> on the top left, please reset the style on right style switcher (for upgraded theme only).</span>
				<button type="button" class="close">&times;</button>
			</div>
			<!-- end top general alert -->
			<div class="row">
				<div class="col-lg-4 ">
					<ul class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php?goto=dashboard">Dashboard</a></li>
						<li><a href="index.php?goto=messages">Requests</a></li>
					</ul>
				</div>
				<!--<div class="col-lg-8 ">
					<div class="top-content">
						<ul class="list-inline quick-access">
							<li>
								<a href="charts-statistics-interactive.html">
									<div class="quick-access-item bg-color-green">
										<i class="fa fa-bar-chart-o"></i>
										<h5>CHARTS</h5><em>basic, interactive, real-time</em>
									</div>
								</a>
							</li>
							<li>
								<a href="page-inbox.html">
									<div class="quick-access-item bg-color-blue">
										<i class="fa fa-envelope"></i>
										<h5>INBOX</h5><em>inbox with gmail style</em>
									</div>
								</a>
							</li>
							<li>
								<a href="tables-dynamic-table.html">
									<div class="quick-access-item bg-color-orange">
										<i class="fa fa-table"></i>
										<h5>DYNAMIC TABLE</h5><em>tons of features and interactivity</em>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>-->
			</div>
			<!-- main -->
			<div class="content">
				<div class="main-header">
					<h2>View Message</h2>
					<!--<em>3 unread messages</em>-->
				</div>
				<div class="main-content">
					<!-- INBOX -->
					<div class="inbox">
						<div class="top">
							<div class="row">
								<div class="col-lg-2">
									<button class="btn btn-primary btn-block btn-compose"> </button>
								</div>
								<div class="col-lg-10">
									<div class="top-menu">
										<ul class="list-inline top-menu-group2">
											<li class="top-menu-more"></li>
										</ul>
										<div class="navigation">
											<button type="button" class="btn btn-link hidden-sm hidden-md hidden-lg inbox-nav-toggle"><i class="fa fa-bars"></i></button>
											<div class="pager-wrapper">
                                                
                                                
											</div>
										</div>
									</div>
									<!-- /top-menu -->
								</div>
							</div>
							<!-- /row -->
						</div>
						<!-- /top -->
						<div class="bottom">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-lg-12">
									<div class="single-message-item">
										<div class="header-top">
											<h2><?php echo 'Mesage From: '.$message->data()->name.'('.$message->data()->email.')';?></h2>
											<!--<span class="label-with-btn">
								            <span class="label message-label label3">Password</span>
											<button class="btn btn-default" type="button">&times;</button>
											</span>-->
											<span class="timestamp pull-right text-muted"><?php echo datetime_to_text($message->data()->message_date);?></span>
										</div>
										<div class="media clearfix header-bottom">
											<div class="media-left">
												<img height="64" width="64" src="includes/assets/img/user.png" alt="Michael" class="media-object img-circle">
											</div>
											<div class="media-body">
												<a href="https://api.whatsapp.com/send?phone=<?php echo $message->data()->phone;?>"><?php echo $message->data()->phone;?><br><span class="text-muted username"><?php echo $message->data()->email;?></span></a>
												<div class="btn-group pull-right">
													<button type="button" class="btn btn-primary btn-reply"><i class="fa fa-mail-reply"></i></button>
													<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="#"><i class="fa fa-mail-reply"></i> Reply</a></li>
														<li><a href="#"><i class="fa fa-trash"></i> Delete this message</a></li>
													</ul>
												</div>
											</div>
										</div>
										<hr />
										<div class="message-body">
											<div class="message-body-text">
												<span><?php echo 'Budget: '.$message->data()->budget;?></span>
												<br/>
												<br/>
												<p><?php echo $message->data()->details?></p>
											</div>
											<hr />
											<div id="reply-section" class="well well-lg reply-box">
												Click here to <a href="#">reply</a></a>
											</div>
										</div>
									</div>
								</div>
								<!-- end right main content, the messages -->
							</div>
						</div>
					</div>
					<!-- END INBOX -->
				</div>
			</div>
			<!-- /main -->
			<!-- FOOTER -->
			<footer class="footer">
				&copy; etari creatives
			</footer>
			<!-- END FOOTER -->
		</div>
		<!-- END CONTENT WRAPPER -->
	</div>
	<!-- END WRAPPER -->