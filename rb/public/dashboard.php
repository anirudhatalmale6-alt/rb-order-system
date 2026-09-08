<?php
include('library/session_info.php');
$pagetitle = ' - Dashboard';

$pagedescr = ' ';

$pagekeywords = ' ';

include(INC_PATH . "system-info.php");

include(INC_PATH . "header.php");
include('class/class_dashboard.php');
?>
<?php
/*
 * Renders one row of dashboard cards for a date range.
 * Defined once so "This Month" and "Last Month" can never drift apart.
 */
if (!function_exists('rb_dashboard_cards')) {
    function rb_dashboard_cards($date_frm, $date_to)
    {
        $cards = array(
            array('TOTAL <br>ORDERS',       number_format(Dashboard::count_total_orders_this_month($date_frm, $date_to)),   'text-primary'),
            array('PENDING <br>ORDERS',     number_format(Dashboard::count_pending_orders_this_month($date_frm, $date_to)), 'text-pink'),
            array('NEW <br>CUSTOMERS',      number_format(Dashboard::count_new_users($date_frm, $date_to)),                 'text-pink'),
            array('TOTAL <br>SALES',        number_format(Dashboard::total_sales($date_frm, $date_to), 2),                  'text-success'),
            array('AMOUNT <br>COLLECTED',   number_format(Dashboard::total_collected($date_frm, $date_to), 2),              'text-info'),
            array('BALANCE <br>DUE',        number_format(Dashboard::total_outstanding($date_frm, $date_to), 2),            'text-danger'),
        );

        foreach ($cards as $c) {
            echo '<div class="col-md-6 col-sm-6 col-lg-2">'
               .   '<div class="card-box widget-box-1 bg-white">'
               .     '<h4 class="text-dark">' . $c[0] . '</h4>'
               .     '<h2 class="' . $c[2] . ' text-center" style="font-size:22px">' . $c[1] . '</h2>'
               .   '</div>'
               . '</div>';
        }
    }
}
?>
<?php




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
                    /* First and LAST day of the current month.
                     * The old code hard-coded "-30", so the 31st was never
                     * counted and February produced an invalid date. */
                    $date_frm = date("Y-m-01");
                    $date_to  = date("Y-m-t");
                ?>
				<div class="row">
                    <?php rb_dashboard_cards($date_frm, $date_to); ?>
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
                /* Previous month. The old code subtracted 1 from the month
                 * number without rolling the YEAR back in January, and again
                 * hard-coded day 30. strtotime handles both correctly. */
                $prev_month = date("Y-m-01", strtotime("first day of last month"));
                $date_frm   = $prev_month;
                $date_to    = date("Y-m-t", strtotime($prev_month));
                ?>

                <div class="row">
                    <?php rb_dashboard_cards($date_frm, $date_to); ?>
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
