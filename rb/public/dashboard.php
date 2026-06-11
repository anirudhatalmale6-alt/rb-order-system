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
                <?php include("includes/topmenu.php"); ?>
            </div>
            <div class="navbar-custom">
                <?php include("includes/mainmenu.php"); ?>
            </div>
        </header>

        <div class="wrapper">
            <div class="container">

                <!-- This Month -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">This Month <?php echo $admin_role; ?></h4>
                    </div>
                </div>

                <?php
                    $date_frm = date("Y-m-01");
                    $date_to = date("Y-m-t");
                ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="This Month"></i>
                            <h4 class="text-dark">TOTAL <br>ORDERS</h4>
                            <h2 class="text-primary text-center"><span data-plugin="counterup"><?php echo Dashboard::count_total_orders_this_month($date_frm, $date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="This Month"></i>
                            <h4 class="text-dark">PENDING ORDERS</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo Dashboard::count_pending_orders_this_month($date_frm, $date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="This Month"></i>
                            <h4 class="text-dark">DELIVERED</h4>
                            <h2 class="text-success text-center"><span data-plugin="counterup"><?php echo Dashboard::count_delivered_orders($date_frm, $date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="This Month"></i>
                            <h4 class="text-dark">NEW CUSTOMERS</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo Dashboard::count_new_users($date_frm, $date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="This Month"></i>
                            <h4 class="text-dark">TOTAL REVENUE</h4>
                            <h2 class="text-primary text-center"><span data-plugin="counterup"><?php echo number_format(Dashboard::get_total_revenue($date_frm, $date_to), 2); ?></span></h2>
                        </div>
                    </div>
                </div>


                <!-- Last Month -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Last Month</h4>
                    </div>
                </div>

                <?php
                $last_month = new DateTime('first day of last month');
                $date_frm = $last_month->format('Y-m-01');
                $date_to = $last_month->format('Y-m-t');
                ?>

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last Month"></i>
                            <h4 class="text-dark">TOTAL <br>ORDERS</h4>
                            <h2 class="text-primary text-center"><span data-plugin="counterup"><?php echo Dashboard::count_total_orders_this_month($date_frm, $date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last Month"></i>
                            <h4 class="text-dark">PENDING ORDERS</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo Dashboard::count_pending_orders_this_month($date_frm, $date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last Month"></i>
                            <h4 class="text-dark">DELIVERED</h4>
                            <h2 class="text-success text-center"><span data-plugin="counterup"><?php echo Dashboard::count_delivered_orders($date_frm, $date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last Month"></i>
                            <h4 class="text-dark">NEW CUSTOMERS</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo Dashboard::count_new_users($date_frm, $date_to); ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last Month"></i>
                            <h4 class="text-dark">TOTAL REVENUE</h4>
                            <h2 class="text-primary text-center"><span data-plugin="counterup"><?php echo number_format(Dashboard::get_total_revenue($date_frm, $date_to), 2); ?></span></h2>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="footer text-right">
                    <?php include("includes/footer.php"); ?>
                </footer>

            </div>
        </div>

        <!-- jQuery  -->
        <script src="assets/site/js/jquery.min.js"></script>
        <script src="assets/site/js/bootstrap.min.js"></script>
        <script src="assets/site/js/jquery.nicescroll.js"></script>
        <script src="assets/site/js/jquery.scrollTo.min.js"></script>

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
