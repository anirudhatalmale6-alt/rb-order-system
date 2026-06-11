<?php
$pagetitle = ' - 404 Page Not Found';

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

                <div class="wrapper-page">
                    <div class="ex-page-content text-center">
                        <div class="text-error">
                            <span class="text-primary">4</span><i class="ti-face-sad text-pink"></i><span class="text-info">4</span>
                        </div>
                        <h2>Oops! Page not found</h2>
                        <br>
                        <p class="text-muted">
                            This page cannot found or is missing.
                        </p>
                        <p class="text-muted">
                            Use the navigation above or the button below to get back and track.
                        </p>
                        <br>
                        <a class="btn btn-default waves-effect waves-light" href="dashboard"> Return Home</a>

                    </div>
                </div>
                <!-- end wrapper page -->

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

        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>

    </body>
</html>