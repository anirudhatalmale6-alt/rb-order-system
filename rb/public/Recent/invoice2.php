<?php
include('library/session_info.php');
$pagetitle = ' - Create Students';

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
                            <button type="button" class="hidden-print btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>

                        <h4 class="page-title">Invoice</h4>
                        <ol class="breadcrumb">
                            <li><a href="#">Roxwall</a></li>
                            <li><a href="#">Extras</a></li>
                            <li class="active">Invoice</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="text-right"><img src="assets/site/images/logo_dark.png" alt="velonic"></h4>

                                    </div>
                                    <div class="pull-right">
                                        <h4>Invoice # <br>
                                            <strong>2015-04-23654789</strong>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="pull-left m-t-30">
                                            <address>
                                              <strong>Twitter, Inc.</strong><br>
                                              795 Folsom Ave, Suite 600<br>
                                              San Francisco, CA 94107<br>
                                              <abbr title="Phone">P:</abbr> (123) 456-7890
                                              </address>
                                        </div>
                                        <div class="pull-right m-t-30">
                                            <p><strong>Order Date: </strong> Jun 15, 2015</p>
                                            <p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">Pending</span></p>
                                            <p class="m-t-10"><strong>Order ID: </strong> #123456</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-h-50"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                    <tr><th>#</th>
                                                    <th>Item</th>
                                                    <th>Description</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total</th>
                                                </tr></thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>LCD</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>1</td>
                                                        <td>$380</td>
                                                        <td>$380</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Mobile</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>5</td>
                                                        <td>$50</td>
                                                        <td>$250</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>LED</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>2</td>
                                                        <td>$500</td>
                                                        <td>$1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>LCD</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>3</td>
                                                        <td>$300</td>
                                                        <td>$900</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Mobile</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>5</td>
                                                        <td>$80</td>
                                                        <td>$400</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="border-radius: 0px;">
                                    <div class="col-md-3 col-md-offset-9">
                                        <p class="text-right"><b>Sub-total:</b> 2930.00</p>
                                        <p class="text-right">Discout: 12.9%</p>
                                        <p class="text-right">VAT: 12.9%</p>
                                        <hr>
                                        <h3 class="text-right">USD 2930.00</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                        <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

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

        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>

    </body>
</html>