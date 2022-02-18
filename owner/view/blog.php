<?php
    // phpinfo();exit;
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    // Initislize Blog
    $blog = new Blog();

    // Initislize Category
    $category = new Category();

    // Initislize Pagination
    $pagination = new Pagination();

    // Initislize Pagination
    $user = new user();

    //Category List Pagination
    $page_state = isset($_GET['category-page'])? trim($_GET['category-page']): 1;
    $per_page = 20;
    $total_record = $category->countAll();
    $paginate = new Pagination($page_state, $per_page, $total_record);
    $catlist = $category->getCatsPerPage($per_page, $paginate->offset());  


    //Blog Pagination
    $blog_page_state = isset($_GET['page'])? trim($_GET['page']): 1;
    $blog_per_page = 20;
    $blog_total_record = $blog->countAll();
    $blog_paginate = new Pagination(escape($blog_page_state), $blog_per_page, $blog_total_record);
    $bloglist = $blog->getBlogsPerPage($blog_per_page, $blog_paginate->offset());
    // print_r('<pre>');
    // print_r($bloglist);
    // print_r('</pre>');exit;
?>
<body class="topnav-fixed text-editor">
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
						<li class="active"><a href="#blog-tab" data-toggle="tab"><i class="fa fa-user"></i> Blogs</a></li>
						<li><a href="#newblog-tab" data-toggle="tab"><i class="fa fa-rss"></i> New Blog</a></li>
						<li><a href="#categories-tab" data-toggle="tab"><i class="fa fa-gear"></i> Categories</a></li>
					</ul>
					<!-- END NAV TABS -->
					<div class="tab-content profile-page">
						<!-- PROFILE TAB CONTENT -->
						<div class="tab-pane profile active" id="blog-tab">
							<div class="row">
								<div class="col-md-9">
									<!-- SHOW HIDE COLUMNS DATA TABLE -->
                                    <div class="widget widget-table">
                                        <div class="widget-header">
                                            <h3><i class="fa fa-table"></i> Blog List</h3> 
                                        </div>
                                        <div class="widget-content">
                                            <div id="blogtablealert" ></div>
                                            <table id="datatable-column-interactive" class="table table-sorting table-hover table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Author</th>
                                                        <th>Created</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $No=0;
                                                    if(!empty($bloglist)){
                                                        $No =0;
                                                        foreach($bloglist as $blogs){
                                                        $del_data = urlencode('{"blog_id":"' . $blogs->blog_id . '","alias":"' . $blogs->alias .'","what":"del_blog"}');

                                                        $blog_edit_data = urlencode('{"blog_id":"' . $blogs->blog_id . '","title":"' . $blogs->title . '","short_desc":"' . $blogs->short_desc . '","content":"' . $blogs->content . '","image":"'. $blogs->image .'","what":"edit_blog"}');
                                                        $No++;?>
                                                    <tr class="blogrow">
                                                        <td><?php echo $No;?></td>
                                                        <td><?php echo escape($blogs->title);?></td>
                                                        <td><?php echo escape($blogs->author);?></td>
                                                        <td><?php echo datetime_to_text(escape($blogs->created))?></td>
                                                        <td><a data-deldata="<?php echo $del_data; ?>"  class="del-blog btn btn-prmary" >Delete</a> <a data-blogdata="<?php echo $blog_edit_data;?>" class="edit-blog btn btn-prmary">Edit</a></td>
                                                    </tr>
                                                    <?php } }?>
                                                </tbody>
                                            </table>
                                            <nav aria-label="...">
                                                <ul class="pagination justify-content-center pagination-sm">
                                                <?php 
                                                    // Add pagination on the account that there is enough data
                                                    for($i = 1; $i <= $blog_paginate->total_pages(); $i++){
                                                        if($i == $blog_page_state){
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
                                <div class="col-md-3">

								</div>
							</div>
						</div>
                        <!-- END PROFILE TAB CONTENT -->

						<!-- NEW BLOG TAB CONTENT -->
						<div class="tab-pane activity" id="newblog-tab">
                            <div class="row">
								<div class="col-md-9">
									<div class="user-info-right">
                                        <!-- NEW BLOG FORM -->
                                        <div class="widget">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-edit"></i> Add New</h3></div>
                                            <div class="widget-content">
                                                <form class="form-horizontal" action="index.php" method="post" role="form" id="newblogform"  enctype="multipart/form-data">
                                                <div id="newblogalert"></div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="blogtitle" class="control-label sr-only">Title</label>
                                                                <input type="text" class="form-control" id="blogtitle" name="blogtitle" placeholder="Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="blogalias" class="control-label sr-only">Alias</label>
                                                                <input type="text" readonly="readonly" class="form-control" id="blogalias" name="blogalias" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <select id="blogcat" name="blogcat" class="form-control">
                                                                    <option value="">Select Category...</option>
                                                                    <?php   $selectcategory = $category->find();
                                                                    foreach($selectcategory as $select){
                                                                        if($select->state != 0){?>
                                                                    <option value="<?php echo $select->id;?>"><?php echo $select->name;?></option>
                                                                    <?php } }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shortdesc" class="control-label sr-only">Short Description</label>
                                                        <div class="col-sm-12">
                                                            <textarea type="text" class="form-control" name="shortdesc" id="shortdesc" placeholder="Short Description"  rows="2" cols="30"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="widget-content no-padding">
                                                        <div class="summernote">
                                                        </div>
                                                    </div>
                                                    <div class="form-group" hidden="hidden">
                                                        <label for="blogtext" class="control-label sr-only">Text</label>
                                                        <div class="col-sm-12">
                                                            <textarea  class="form-control" name="btext" id="blogtext"  placeholder="Text"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input type="file" class="form-control" name="blogimg" id="blogimg" accept="image/gif,image/GIF, image/jpg, image/JPG, image/jpeg, image/JPEG, image/png, image/PNG, image/bmp, image/BMP" onchange="readURL(this);" >       
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">          
                                                                <img id="blah" src="" alt="" style="width:50px; height:50px; border-radius:5px; margin-right:5px; margin-left:5px;" />        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text"  name="what" id="blogwhat" placeholder="" hidden value="newblog">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button type="submit" id="newblogbtn" disabled="disabled" class="btn btn-primary">Add Blog</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- NEW BLOG FORM -->
									</div>
                                </div>
                                <div class="col-md-3">
									<div class="user-info-left">
										
									</div>
								</div>
							</div>
						</div>
                        <!-- NEW BLOG TAB CONTENT -->
                        
						<!-- BLOG CATEGORY TAB CONTENT -->
						<div class="tab-pane settings" id="categories-tab">
                            <div class="row">
                                    <div class="col-md-8">
                                        <!-- SHOW BLOG CATEGORY DATA TABLE -->
                                        <div class="widget widget-table">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-table"></i> Category List</h3> 
                                            </div>
                                            <div class="widget-content">
                                                <table id="datatable-column-interactive" class="table table-sorting table-hover table-bordered datatable">
                                                    <thead>
                                                        <div id="cattablealert"></div>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Date Added</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="catlist">
                                                    <?php
                                                        $No=0;
                                                        if(!empty($catlist)){
                                                        foreach($catlist as $categories){
                                                            $del_cat = urlencode('{"cat_id":"' . $categories->id . '","alias":"' . $categories->alias .'","what":"del_cat"}');
                                                        $No++;?>
                                                        <tr>
                                                            <td><?php echo $No;?></td>
                                                            <td><?php echo escape($categories->name)?></td>
                                                            <td><?php echo datetime_to_text(escape($categories->created))?></td>
                                                            <td><a data-delcat="<?php echo $del_cat;?>" class="del-cat btn btn-prmary">Delete</a></td>
                                                        </tr>
                                                        <?php } }?>
                                                    </tbody>
                                                </table>
                                                <nav aria-label="...">
                                                    <ul class="pagination justify-content-center pagination-sm">
                                                    <?php 
                                                        // Add pagination on the account that there is enough data
                                                        for($i = 1; $i <= $paginate->total_pages(); $i++){
                                                            if($i == $page_state){
                                                                echo "<li class='page-item active'>";
                                                                echo "<a class=\"page-link active\" href=\"index.php?goto=blog&category-page={$i}\">{$i}</a>";
                                                                echo "</li>";
                                                            }else{
                                                                echo "<li class='page-item'>";
                                                                echo "<a class=\"page-link\" href=\"index.php?goto=blog&category-page={$i}\">{$i}</a>";	
                                                                echo "</li>";
                                                            }
                                                        }
                                                    ?>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                        <!-- END SHOW BLOG CATEGORY DATA TABLE -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- NEW BLOG CATEGORY FORM -->
                                        <div class="widget">
                                            <div class="widget-header">
                                                <h3><i class="fa fa-edit"></i> Add New Category</h3></div>
                                            <div class="widget-content">
                                                <form class="form-horizontal" role="form" action="index.php" method="post" id="newcatform" autocomplete="off">
                                                    <div id="newcatalert"></div>
                                                    <div class="form-group">
                                                        <label for="catname" class="control-label sr-only">Category Name</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="catname" id="catname" placeholder="Category Name" autocomplete="new-password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contact-subject" class="control-label sr-only">Alias</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="catalias" id="catalias" readonly="readonly" placeholder="Alias">
                                                        </div>
                                                    </div>
                                                    <input type="text"  name="what" id="" placeholder="" hidden value="newblogcat">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="submit" disabled="disabled" class="btn btn-primary" id="newcatbtn" value="Save">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- END NEW BLOG CATEGORY FORM -->
                                    </div>
                                </div>
                                <!-- <p class="text-center"><a href="#" class="btn btn-custom-primary"><i class="fa fa-floppy-o"></i> Save Changes</a></p> -->
                            </div>
                        </div>
						<!-- BLOG CATEGORY TAB CONTENT -->
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

