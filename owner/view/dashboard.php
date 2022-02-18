<?php
	//Initailize User
	$user = new User();

	// Initislize Pagination
    $pagination = new Pagination();


	//Category List Pagination
    $page_state = isset($_GET['page'])? trim($_GET['page']): 1;
    $per_page = 10;
    $total_record = $user->countAll();
    $paginate = new Pagination($page_state, $per_page, $total_record);
	$userlist = $user->getUsers($per_page, $paginate->offset()); 
	
	// print_r('<pre>');
    // print_r($userlist);
    // print_r('</pre>');exit;
?>
<body class="topnav-fixed">
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
			<!-- main -->
			<div class="content">
				<div class="main-header">
					<h2>Dashboard</h2>
					<em>Admin Dashboard</em>
				</div>
				<div class="main-content">
					<!-- NAV TABS -->
					<ul class="nav nav-tabs nav-tabs-custom-colored tabs-iconized">
						<li class="active"><a href="#profile-tab" data-toggle="tab"><i class="fa fa-user"></i> Profile</a></li>
						<li><a href="#newuser" data-toggle="tab"><i class="fa fa-plus-square"></i> New User</a></li>
						<li><a href="#settings-tab" data-toggle="tab"><i class="fa fa-gear"></i> Settings</a></li>
					</ul>
					<!-- END NAV TABS -->
					<div class="tab-content profile-page">
						<!-- PROFILE TAB CONTENT -->
						<div class="tab-pane profile active" id="profile-tab">
							<div class="row">
								<div class="col-md-3">
									<div class="user-info-left">
										<img height="113px" width="113px" src="includes/assets/img/user.png" alt="Profile Picture" />
										<h2><?php echo $user->data()->fullname;?> <i class="fa fa-circle green-font online-icon"></i><sup class="sr-only">online</sup></h2>
										<div class="contact">
											<!--<a href="#" class="btn btn-block btn-custom-primary"><i class="fa fa-envelope-o"></i> Send Message</a>
											<a href="#" class="btn btn-block btn-custom-secondary"><i class="fa fa-book"></i> Add To Contact</a>-->
											<ul class="list-inline social">
												<li><a href="#" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
												<li><a href="#" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>
												<li><a href="#" title="Google Plus"><i class="fa fa-google-plus-square"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-md-9">
									<div class="user-info-right">
										<div class="basic-info">
											<h3><i class="fa fa-square"></i> Basic Information</h3>
											<p class="data-row">
												<span class="data-name">Username</span>
												<span class="data-value"><?php echo $user->data()->username;?></span>
											</p>
											<p class="data-row">
												<span class="data-name">Email</span>
												<span class="data-value"><?php echo $user->data()->email;?></span>
											</p>
											<p class="data-row">
												<span class="data-name">Phone Number</span>
												<span class="data-value"><?php echo $user->data()->phone;?></span>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END PROFILE TAB CONTENT -->
						<!-- ACTIVITY TAB CONTENT -->
						<div class="tab-pane activity" id="newuser">
							<div class="row">
								<div class="col-md-8">
									<!-- SHOW HIDE COLUMNS DATA TABLE -->
                                    <div class="widget widget-table">
                                        <div class="widget-header">
                                            <h3><i class="fa fa-table"></i> Users List</h3> 
                                        </div>
                                        <div class="widget-content">
                                            <table id="datatable-column-interactive" class="table table-sorting table-hover table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Username</th>
														<th>Fullname</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Created</th>
														<th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
                                                    $No=0;
                                                    if(!empty($userlist)){
                                                    foreach($userlist as $users){
                                                        if($users->username != 'kigbu'){
                                                        $No++;?>
                                                        <tr>
                                                            <td><?php echo $No;?></td>
                                                            <td><?php echo escape($users->username);?></td>
                                                            <td><?php echo escape($users->fullname);?></td>
    														<td><?php echo escape($users->phone);?></td>
    														<td><?php echo escape($users->email);?></td>
                                                            <td><?php echo datetime_to_text(escape($users->created));?></td>
                                                            <td><input class="btn btn-prmary" type="submit" value="Delete"></td>
                                                        </tr>
                                                        <?php } } }?>
                                                </tbody>
                                            </table>
											<nav aria-label="...">
												<ul class="pagination justify-content-center pagination-sm">
												<?php 
													// Add pagination on the account that there is enough data
													for($i = 1; $i <= $paginate->total_pages(); $i++){
														if($i == $page_state){
															echo "<li class='page-item active'>";
															echo "<a class=\"page-link active\" href=\"index.php?goto=blog&page={$i}\">{$i}</a>";
															echo "</li>";
														}else{
															echo "<li class='page-item'>";
															echo "<a class=\"page-link\" href=\"index.php?goto=blog&page={$i}\">{$i}</a>";	
															echo "</li>";
														}
													}
												?>
												</ul>
											</nav>
                                        </div>
                                    </div>
                                    <!-- END SHOW HIDE COLUMNS DATA TABLE -->
                                </div>
                                <div class="col-md-4">
									<!-- NEW BLOG CATEGORY FORM -->
									<div class="widget">
										<div class="widget-header">
											<h3><i class="fa fa-edit"></i> Add New User</h3></div>
										<div class="widget-content">
											<form class="form-horizontal" role="form" action="index.php" method="post" id="newuserform" autocomplete="off">
												<div id="newuseralert"></div>
												<div class="form-group">
													<label for="fulname" class="control-label sr-only">Full Name</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
													</div>
												</div>
												<div class="form-group">
													<label for="username" class="control-label sr-only">Username</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="username" id="username" placeholder="Username" >
													</div>
												</div>
												<div class="form-group">
													<label for="email" class="control-label sr-only">Email</label>
													<div class="col-sm-12">
														<input type="email" class="form-control" name="email" id="email" placeholder="Email">
													</div>
												</div>
												<div class="form-group">
													<label for="phone" class="control-label sr-only">Phone Number</label>
													<div class="col-sm-12">
														<input type="number" class="form-control" name="phonenumber" id="phonenumber" placeholder="Phone Number">
													</div>
												</div>
												<div class="form-group">
													<label for="password" class="control-label sr-only">Password</label>
													<div class="col-sm-12">
														<input autocomplete="off" type="password" class="form-control" name="password" id="password" placeholder="password">
													</div>
												</div>
												<div class="form-group">
													<label for="passwordagain" class="control-label sr-only">Confirm Password</label>
													<div class="col-sm-12">
														<input autocomplete="off" type="password" class="form-control" name="passwordagain" id="passwordagain" placeholder="Confirm Password">
													</div>
												</div>
												<input type="text"  name="what" id="" placeholder="" hidden value="newuser">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="submit" disabled="disabled" class="btn btn-primary" id="nuserbtn" value="Add">
													</div>
												</div>
											</form>
										</div>
									</div>
									<!-- END NEW BLOG CATEGORY FORM -->
								</div>
							</div>
						</div>
						<!-- END ACTIVITY TAB CONTENT -->
						<!-- SETTINGS TAB CONTENT -->
						<div class="tab-pane settings" id="settings-tab">
							<form class="form-horizontal" role="form" id="resetpassword" action="index.php" method="post" autocomplete="off">
								<fieldset>
									<h3><i class="fa fa-square"></i> Change Password</h3>
									<div class="form-group">
										<label for="currentpassword" class="col-sm-3 control-label">Old Password</label>
										<div class="col-sm-4">
											<input autocomplete="off" type="password" id="currentpassword" name="currentpassword" class="form-control">
										</div>
									</div>
									<hr />
									<div class="form-group">
										<label for="password" class="col-sm-3 control-label">New Password</label>
										<div class="col-sm-4">
											<input autocomplete="off" type="password" id="pass1" name="pass1" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="password2" class="col-sm-3 control-label">Repeat Password</label>
										<div class="col-sm-4">
											<input autocomplete="off" type="password" id="pass2" name="pass2" class="form-control">
										</div>
									</div>
								</fieldset>
							</form>
							<p class="text-center"><a href="#" class="btn btn-custom-primary"><i class="fa fa-floppy-o"></i> Save Changes</a></p>
						</div>
						<!-- END SETTINGS TAB CONTENT -->
					</div>
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

