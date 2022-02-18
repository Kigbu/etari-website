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


    //Message Pagination
    $page_state = isset($_GET['page'])? trim($_GET['page']): 1;
    $per_page = 10;
    $total_record = $message->countAll();

    $paginate = new Pagination($page_state, $per_page, $total_record);
    $messagelist = $message->getMessages($per_page, $paginate->offset());
    // print_r('<pre>');
    // print_r($messagelist);
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
						<li><a href="index.php?goto=messages">Messages</a></li>
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
					<h2>Messages</h2>
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
                                                <nav aria-label="...">
                                                    <ul class="pagination justify-content-center pagination-sm">
                                                    <?php 
                                                        // Add pagination on the account that there is enough data
                                                        if($paginate->total_pages() >= 1){
                                                            if($paginate->has_previous_page()){
                                                                echo '<li class="page-item">';
                                                                echo '<a class="page-link" href="index.php?goto=messages&page=';echo $paginate->previous_page() ; echo'" aria-label="Previous">';   echo '<span aria-hidden="true">&laquo;</span>';  
                                                                echo '<span class="sr-only">Previous</span>';
                                                                echo '</a></li>';
                                                            }
                                                            for($i = 1; $i <= $paginate->total_pages(); $i++){
                                                                if($i == $page_state){
                                                                    echo '<li class="page-item active">';
                                                                    echo '<a class="page-link active href="index.php?goto=messages&page='; echo $i; echo '">'; echo $i; echo '</a>';
                                                                    echo "</li>";
                                                                }else{
                                                                    echo '<li class="page-item">';
                                                                    echo '<a class="page-link" href="index.php?goto=messages&page='; echo $i; echo '">'; echo $i; echo '</a>';	
                                                                    echo '</li>';
                                                                }
                                                            }
                                                            if($paginate->has_next_page()){
                                                                echo '<li class="page-item"><a class="page-link" href="index.php?goto=messages&page=';
                                                                echo $paginate->next_page();
                                                                echo '"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
                                                            }
                                                        }
                                                    ?>
                                                    </ul>
                                                </nav>
                                                <!--<span class="info">Showing 1-10 of 32</span>-->
                                                
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
									<div class="messages">
										<table class="table-condensed message-table">
											<colgroup>
												<col class="col-check">
												<col class="col-star">
												<col class="col-from">
												<col class="col-title">
												<!--<col class="col-attachment">-->
												<col class="col-timestamp">
											</colgroup>
											<tbody>
                                                <?php 
                                                    if(!empty($messagelist)){
                                                    foreach($messagelist as $messages){
														$view = urlencode('index.php?goto=viewmessage&r_id='.escape($messages->message_id));
                                                ?>
												<tr class="messagerow" data-messagetarget="<?php echo $view; ?>" >
													<td>
														<label class="fancy-checkbox">
															<input type="checkbox">
															<span>&nbsp;</span>
														</label>
													</td>
													<td><i class="fa fa-star-o"></i></td>
													<td><span class="from" title=""><?php echo escape($messages->name);?> </span></td>
													<td><span class="message-label label2">New</span>
														<span class="title"><?php echo escape($messages->email);?></span> <span class="preview">- <?php echo escape($messages->details);?> </span></td>
													<!--<td><span class="icon-attachment"><i class="fa fa-paperclip"></i></span></td>-->
													<td><span class="timestamp"><?php echo datetime_to_text(escape($messages->message_date));?></span></td>
												</tr>
                                                <?php } }?>
											</tbody>
										</table>
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