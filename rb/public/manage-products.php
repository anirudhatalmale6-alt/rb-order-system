<?php
include('library/session_info.php');
$pagetitle = ' - Manage Products';

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
                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>

                        <h4 class="page-title">Products</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#"><?php echo $companyname; ?></a>
                            </li>
                            <li>Product Info</li>
                            <li class="active">Manage Products</li>
                        </ol>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Filtering</b></h4>
                            <p class="text-muted m-b-30 font-13">
                                include filtering in your FooTable.
                            </p>

                            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="7">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Product ID</th>
                                        <th>Product Name</th>
                                        <th data-hide="phone">Main Category</th>
                                        <th data-hide="phone, tablet">Sub Category</th>
                                        <th data-hide="phone, tablet">Net Weight</th>
                                        <th data-hide="phone, tablet">Price</th>
                                        <th data-hide="phone, tablet">Status</th>
                                        <th data-hide="phone, tablet">Actions</th>
                                    </tr>
                                </thead>
                                <div class="form-inline m-b-20">
                                    <div class="row">
                                        <div class="col-sm-6 text-xs-center">
                                            <div class="form-group">
                                                <label class="control-label m-r-5">Status</label>
                                                <select id="demo-foo-filter-status" class="form-control input-sm">
                                                    <option value="">Show all</option>
                                                    <option value="Available">Available</option>
                                                    <option value="Out of Stock">Out of Stock</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-xs-center text-right">
                                            <div class="form-group">
                                                <input id="demo-foo-search" type="text" placeholder="Search" class="form-control input-sm" autocomplete="on">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <tbody>
                                    <tr>
                                        <td>CAKE0012</td>
                                        <td>Caramal Cake</td>
                                        <td>NON Vegeterian</td>
                                        <td>Cake</td>
                                        <td>1.5 Kg</td>
                                        <td>4, 000 LKR</td>
                                        <td><span class="label label-table label-warning">Available</span></td>
										<td>
											<a href="#" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i></a>
											<a href="#" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash"></i></a>
										</td>
                                    </tr>
                                    <tr>
                                        <td>CAKE0013</td>
                                        <td>Dates Cake</td>
                                        <td>Vegeterian</td>
                                        <td>Cake</td>
                                        <td>2 Kg</td>
                                        <td>3, 000 LKR</td>
                                        <td><span class="label label-table label-inverse">Out of Stock</span></td>
										<td>
											<a href="#" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i></a>
											<a href="#" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash"></i></a>
										</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <div class="text-right">
                                                <ul class="pagination pagination-split m-t-30 m-b-0"></ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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

        <!--FooTable-->
		<script src="assets/site/plugins/footable/js/footable.all.min.js"></script>

		<script src="assets/site/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>

        <!--FooTable Example-->
		<script src="assets/site/pages/jquery.footable.js"></script>


    </body>
</html>