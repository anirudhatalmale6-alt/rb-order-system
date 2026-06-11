<?php
include('library/session_info.php');
$pagetitle = ' - Manage Orders';

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

                </div>

                <h4 class="page-title">Cancelled Orders</h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><?php echo $companyname; ?></a>
                    </li>
                    <li class="active">Cancelled Orders</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                        <thead>
                        <tr>
                            <th>Invoice Id</th>
                            <th>Reason</th>
                            <th>Cancelled By</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <div class="form-inline m-b-20">
                            <div class="row">
                                <div class="col-sm-6 text-xs-center">
                                    <div class="form-group">
                                        <label class="control-label m-r-5">Status</label>
                                        <select id="demo-foo-filter-status" class="form-control input-sm">
                                            <option value="">Show all</option>
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

                        <?php
                        include('class/class_orders.php');
                        $load = class_orders::load_cancel_orders();
                        while ($row = mysqli_fetch_array($load)) {
                            ?>
                            <tr class="active">

                                <td>
                                    <a onclick="window.open('invoice-A5?inv_code=<?php echo $row['rox_inv_id'];  ?>&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=550,height=660',); return false;"  class="wm-default-btn"><span><?php echo $row['rox_inv_id'];  ?></span></a>

                                </td>

                                <td>
                                    <b><a href="#" class="text-dark"><b><?php echo $row['odr_cancel_reason']; ?></b></a> </b>
                                </td>
                                <td>
                                    <b><a href="#" class="text-dark"><b><?php echo $row['rox_user_name']; ?></b></a> </b>
                                </td>
                                <td>
                                    <b><a href="#" class="text-dark"><b><?php echo $row['cancel_date']; ?></b></a> </b>
                                </td>

                             </tr>
                        <?php } ?>

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