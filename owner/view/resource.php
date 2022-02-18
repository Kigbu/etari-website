<?php
	$user = new User();
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
					<h2>Resources</h2>
					<em>Admin Dashboard</em>
				</div>
				<div class="main-content">
					<!-- NAV TABS -->
					<!--<ul class="nav nav-tabs nav-tabs-custom-colored tabs-iconized">
						<li class="active"><a href="#profile-tab" data-toggle="tab"><i class="fa fa-user"></i> Profile</a></li>
						<li><a href="#newuser" data-toggle="tab"><i class="fa fa-plus-square"></i> New User</a></li>
						<li><a href="#settings-tab" data-toggle="tab"><i class="fa fa-gear"></i> Settings</a></li>
					</ul>-->
					<!-- END NAV TABS -->
					<div class="tab-content profile-page">
						<!-- ACTIVITY TAB CONTENT -->
						<div class="tab-pane activity active" id="newuser">
							<div class="row">
								<div class="col-md-8">
									<!-- SHOW HIDE COLUMNS DATA TABLE -->
                                    <div class="widget widget-table">
                                        <div class="widget-header">
                                            <h3><i class="fa fa-table"></i> Resource List</h3> 
                                        </div>
                                        <div class="widget-content">
                                            <table id="datatable-column-interactive" class="table table-sorting table-hover table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Browser</th>
                                                        <th>Operating System</th>
                                                        <th>Visits</th>
                                                        <th>New Visits</th>
                                                        <th>Bounce Rate</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Chrome</td>
                                                        <td>Macintosh</td>
                                                        <td>360</td>
                                                        <td>82.78%</td>
                                                        <td>87.77%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chrome</td>
                                                        <td>Windows</td>
                                                        <td>582</td>
                                                        <td>87.24%</td>
                                                        <td>90.12%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END SHOW HIDE COLUMNS DATA TABLE -->
                                </div>
                                <div class="col-md-4">
									<!-- NEW BLOG CATEGORY FORM -->
									<div class="widget">
										<div class="widget-header">
											<h3><i class="fa fa-edit"></i> Add New Resource Material</h3></div>
										<div class="widget-content">
											<form class="form-horizontal" role="form" action="index.php" method="post" id="newresform" autocomplete="off" enctype="multipart/form-data">
												<div id="newresalert"></div>
												<div class="resdropBox">
													<p>Select file to upload</p>
												</div>
												<div class="form-group">
													<label for="name" class="control-label sr-only">Name of File</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="name" id="resname" placeholder="Name of File">
													</div>
												</div>
												<div class="form-group">
													<label for="shortdesc" class="control-label sr-only">Username</label>
													<div class="col-sm-12">
														<textarea type="text" class="form-control" name="desc" id="desc"  placeholder="Short Description"  rows="2" ></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="resfile" class="control-label sr-only">Upload File</label>
													<div class="resfileInput col-sm-12">
														<input type="file" class="form-control" name="resfile" id="resfile" >
													</div>
												</div>
												<input type="text"  name="what" id="" placeholder="" hidden value="resupload">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="submit" class="btn btn-primary" id="nresbtn" value="Upload">
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

