<?php
include('library/session_info.php');
$pagetitle = ' - Manage System Users';

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
                        <h4 class="page-title">Manage Users</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
							<li><a href="#">Main Access</a></li> 
							<li><a href="#">System Users</a></li> 
                            <li class="active">Manage Users</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
				<?php
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                if ($status == 'failed') {
                    echo 	'<div class="alert alert-danger">
								<strong>Failed!</strong> Indicates a dangerous or potentially negative action.
							</div>';
                }
                if ($status == 'success') {
                    echo 	'<div class="alert alert-success">
								<strong>Success!</strong> Indicates a successful or positive action.
							</div>';
                }
            }
			if (isset($_GET['dstatus'])) {
                $dstatus = $_GET['dstatus'];
                if ($dstatus == 'failed') {
                    echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
								<i class="fa fa-close"></i>
							</button>
							<b>Invalid Credentials    </b>
							</div>';
                }
                if ($dstatus == 'success') {
                    echo '<div class="alert">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
								<i class="fa fa-close"></i>
							</button>
						<b>Deleted successfully</b>
							</div>';
                }
            }
			if (isset($_GET['ustatus'])) {
                $ustatus = $_GET['ustatus'];
                if ($ustatus == 'failed') {
                    echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
								<i class="fa fa-close"></i>
							</button>
							<b>Invalid Credentials    </b>
							</div>';
                }
                if ($ustatus == 'success') {
                    echo '<div class="alert">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
								<i class="fa fa-close"></i>
							</button>
						<b>Updated successfully</b>
							</div>';
                }
            }
            ?>
                    <div class="col-lg-12">
                        <div class="card-box">

                            <div class="table-responsive">
                                <table class="table table-hover mails m-0 table table-actions-bar">
                                    <thead>
                                        <tr>                                           
                                            <th>User Name</th>
                                            <th>User Role</th>
                                            <th style="min-width: 120px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
									 <?php
									include('class/class_user_access.php');
									$load = User_access::load_user_new();
									while ($row = mysqli_fetch_array($load)) {
									?>
                                        <tr class="active">

                                            <td>
                                                <?php echo $row['rox_user_name']; ?>
                                            </td>

                                            <td>
                                                <b><a href="#" class="text-dark"><b><?php echo $row['rox_admin_role']; ?></b></a> </b>
                                            </td>

                                            <td>
                                                <a href="update-users?id=<?php echo $row['rox_admin_id']; ?>" class="table-action-btn"><i class="md md-edit"></i></a>												
                                                <a href="functions/function_user_access.php?delid=<?php echo $row['rox_admin_id']; ?>" class="table-action-btn"><i class="md md-close"></i></a>							
                                            </td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> <!-- end col -->


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

        <!-- Modal-Effect -->
        <script src="assets/site/plugins/custombox/js/custombox.min.js"></script>
        <script src="assets/site/plugins/custombox/js/legacy.min.js"></script>

        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>

    </body>
</html>