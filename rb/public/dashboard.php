<?php
include('library/session_info.php');
$pagetitle = ' - Dashboard';

$pagedescr = ' ';

$pagekeywords = ' ';

include(INC_PATH . "system-info.php");

include(INC_PATH . "header.php");
include('class/class_dashboard.php');



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
                            <!-- Start Settings Options -->
							<?php //include("includes/settings.php"); ?>
							<!-- End Settings Options -->
                        </div>

                        <h4 class="page-title">This Month <?php echo  $admin_role;?></h4>
                        <p class="text-muted page-title-alt"><?php /*echo $_SESSION['username'];*/?></p>
                    </div>
                </div>

                <?php
                    $date = date("Y-m");
                    $date_frm=$date.'-01';
                    $date_to=$date.'-30';
                ?>
				<div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">TOTAL <br>ORDERS</h4>
                            <h2 class="text-primary text-center"><span data-plugin="counterup"><?php echo $count_admin_users = Dashboard::count_total_orders_this_month($date_frm,$date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">TOTAL PENDING ORDERS</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo $count_admin_users = Dashboard::count_pending_orders_this_month($date_frm,$date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">TOTAL NEW CUSTOMERS</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo $count_admin_users = Dashboard::count_new_users($date_frm,$date_to); ?></span></h2>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <!-- Start Settings Options -->
							<?php //include("includes/settings.php"); ?>
							<!-- End Settings Options -->
                        </div>

                        <h4 class="page-title">Last Month</h4>
                        <p class="text-muted page-title-alt"><?php /*echo $_SESSION['username'];*/?></p>
                    </div>
                </div>

                <?php
                $date_y = date("Y");
                $date_m = date("m");
                    if($date_m == 01){
                        $date_m = 12;
                    }else{
                        $date_m=$date_m-1;
                    }

                $date_frm=$date_y.'-'.$date_m.'-01';
                $date_to=$date_y.'-'.$date_m.'-30';

//                echo $date_frm;
//                echo $date_to;
                ?>

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">TOTAL <br>ORDERS</h4>
                            <h2 class="text-primary text-center"><span data-plugin="counterup"><?php echo $count_admin_users = Dashboard::count_total_orders_this_month($date_frm,$date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">TOTAL PENDING ORDERS</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo $count_admin_users = Dashboard::count_pending_orders_this_month($date_frm,$date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">TOTAL NEW CUSTOMERS</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo $count_admin_users = Dashboard::count_new_users($date_frm,$date_to); ?></span></h2>
                        </div>
                    </div>
                </div>





                <!-- End row-->


                <!-- Footer -->
                <footer class="footer text-right">
                    <!-- Footer Section Starts-->
					<?php include("includes/footer.php"); ?>
					<!-- Footer Section Ends -->
                </footer>
                <!-- End Footer -->

            </div>
        </div>

        <!-- jQuery  -->
        <script src="assets/site/js/jquery.min.js"></script>
        <script src="assets/site/js/bootstrap.min.js"></script>
        <script src="assets/site/js/jquery.nicescroll.js"></script>
        <script src="assets/site/js/jquery.scrollTo.min.js"></script>


<!--        <script src="assets/site/js/detect.js"></script>-->
        <script src="assets/site/js/fastclick.js"></script>
        <script src="assets/site/js/jquery.slimscroll.js"></script>
        <script src="assets/site/js/jquery.blockUI.js"></script>
        <script src="assets/site/js/waves.js"></script>
        <script src="assets/site/js/wow.min.js"></script>

        <!-- Counterup  -->
        <script src="assets/site/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/site/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Morris chart js -->
        <script src="assets/site/plugins/morris/morris.min.js"></script>
        <script src="assets/site/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard 4 js -->
		<script src="assets/site/pages/jquery.dashboard_4.js"></script>

        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>

    </body>
</html>
