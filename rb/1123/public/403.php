<?php

session_start();
$pagetitle = ' - Billing &amp; Client Management';

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
    	<div class="account-pages"></div>
		<div class="clearfix"></div>
		
        <div class="wrapper-page">
            <div class="ex-page-content text-center">
                <div class="text-error"><span class="text-primary">4</span><i class="ti-face-sad text-pink"></i><span class="text-info">3</span></div>
                <h2>Forbidden</h2>
                <p class="text-muted">For security reason we have ristricted access to this page also you don't have permission to access <b><?php $result = $_SESSION['sendpage']; echo $result; ?> </b> page. Please contact System Administrator to get access to this page</p>
                <a class="btn btn-default waves-effect waves-light" href="dashboard"> Return Home</a>
                
            </div>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>

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