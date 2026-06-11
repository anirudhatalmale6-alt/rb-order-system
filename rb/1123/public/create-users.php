<?php

include('library/session_info.php');
$pagetitle = ' - Create User';

$pagedescr = ' ';

$pagekeywords = ' ';

include(INC_PATH . "system-info.php");

include(INC_PATH . "header.php");
?>
    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <!-- Start TOP Navigation -->
				<?php include("includes/topmenu.php"); ?>
				<!-- End TOP Navigation -->	
            </div>

            <div class="navbar-custom">
                <!-- Start Main Menu -->
				<?php include("includes/mainmenu.php"); ?>
				<!-- End Main Menu -->   
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button><ul class="dropdown-menu drop-menu-right" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>

                        <h4 class="page-title">Create User</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
							<li><a href="#">Main Access</a></li> 
							<li><a href="#">System Users</a></li> 
                            <li class="active">Create User</li>
                        </ol>
                    </div>
                </div>
				
				<div class="card-box">
				<?php 
								if (isset($_GET['status'])) {
									$status = $_GET['status'];
									if ($status == 'success') {
										echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>User Details Saved Successfully</b>
												</div>';
									}
									if ($status == 'failed') {
										echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												Error Occer! <b>User Details not Saved</b>
												</div>';
									}
								}
							?>
					<form method="POST" action="functions/function_user_access.php" data-parsley-validate novalidate>
						<div class="card-box-rox">
							<div class="row">												

							</div>
							<div class="card-box-rox">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="m-t-0 header-title"><b></b></h4>
										<div class="form-group col-lg-4">
											<label for="user_name">User Name<span class="text-danger">*</span></label>
											<input type="text" name="user_name" parsley-trigger="change"  placeholder="Enter User Name" class="form-control" id="user_name">
										</div>
										<div class="col-lg-12 col-lg-4">
											<div class="form-group col-lg-6">
												<label for="pass1">Password <span class="text-danger">*</span></label>
												<input id="pass1" type="password" name="password" placeholder="Password"
													   required class="form-control">
											</div>
											<div class="form-group col-lg-6">
												<label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
												<input data-parsley-equalto="#pass1" type="password" required
													   placeholder="Password" name="password2" class="form-control" id="passWord2">
											</div>
										</div>
										<div class="form-group col-lg-2">
											<label for="user_type">User Type<span class="text-danger">*</span></label>
											<select name="user_type" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
                                                <option value="">Select Level</option>
												<?php
                                                $user_level = unserialize (USER_LEVELS);
												foreach ($user_level as $load_user_level) {
												?>
												<option value="<?php echo $load_user_level; ?>" ><?php echo $load_user_level ?></option>
												<?php
												}
												?>
											</select>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="row">				
							<div class="form-group text-center m-b-0">
								<button class="btn btn-primary waves-effect waves-light" name="save_admin_user" type="submit">
									Submit
								</button>
								<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
									Cancel
								</button>
							</div>
						</div>
					</form>
				</div>
                <!-- Footer -->
                <footer class="footer text-right">
                    <!-- Footer Section Starts-->
					<?php include("includes/footer.php"); ?>
					<!-- Footer Section Ends -->
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->



        <!-- jQuery  -->
        <script src="assets/site/js/jquery.min.js"></script>
        <script src="assets/site/js/bootstrap.min.js"></script>
        <script src="assets/site/js/detect.js"></script>
        <script src="assets/site/js/fastclick.js"></script>
        <script src="assets/site/js/jquery.slimscroll.js"></script>
        <script src="assets/site/js/jquery.blockUI.js"></script>
        <script src="assets/site/js/waves.js"></script>
        <script src="assets/site/js/wow.min.js"></script>
        <script src="assets/site/js/jquery.nicescroll.js"></script>
        <script src="assets/site/js/jquery.scrollTo.min.js"></script>
		<!-- Parsly js -->
        <script type="text/javascript" src="assets/site/plugins/parsleyjs/parsley.min.js"></script>

        <script type="text/javascript">
			$(document).ready(function() {
				$('form').parsley();
			});
		</script>
        <script src="assets/site/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="assets/site/plugins/switchery/js/switchery.min.js"></script>
		
        <script type="text/javascript" src="assets/site/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/site/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="assets/site/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="assets/site/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="assets/site/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="assets/site/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="assets/site/pages/autocomplete.js"></script>

        <script type="text/javascript" src="assets/site/pages/jquery.form-advanced.init.js"></script>


        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>

    </body>
</html>