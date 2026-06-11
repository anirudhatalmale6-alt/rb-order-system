<?php
include('library/session_info.php');
$pagetitle = ' - ';

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
                    <ul class="dropdown-menu drop-menu-right" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>

                <h4 class="page-title">Make Balance Payment</h4>
                <ol class="breadcrumb">
                    <li><a href="#"><?php echo $companyname; ?></a></li>
                    <li><a href="#">Main Access</a></li>
                    <li><a href="active">Make Payment</a></li>

                </ol>
            </div>
        </div>

        <div class="card-box">
            <form action="functions/function_user_access.php" method="POST" data-parsley-validate novalidate>
                <div class="row">
                    <div class="col-lg-12">

                        <h4 class="m-t-0 header-title"><b>Make Balance Payment</b></h4>
                        <p class="text-muted font-13 m-b-30">

                        </p>
                        <?php
                        if (isset($_GET['sa'])) {
                            $status = $_GET['sa'];
                            if ($status == 'success') {
                                echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Main Categories Details Saved Successfully</b>
												</div>';
                            }
                            if ($status == 'failed') {
                                echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												Error Occer! <b>Main Categories Details not Saved</b>
												</div>';
                            }
                        }
                        ?>

                        <div class="form-group col-lg-4">
                            <label for="main_cate">Main Category</label>
<!--                            <input type="text" name="type" parsley-trigger="change" required placeholder="Payment Type" class="form-control" id="main_cate">-->
                                <select class="form-control">
                                    <option>Cash</option>
                                    <option>Card</option>
                                </select>

                        </div>
                        <div class="form-group col-lg-5">
                            <label for="main_cate_des">Payment</label>
                            <input type="text" name="Payment" parsley-trigger="change" required placeholder="Enter Main Category Description" class="form-control" id="Payment" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group text-center m-b-0">
                        <button name="save_main_cate" class="btn btn-primary waves-effect waves-light" type="submit">
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
<!-- MODAL -->

<!-- end Modal -->
<!-- jQuery  -->

<script>

</script>
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
<!-- App core js -->
<script src="assets/site/js/jquery.core.js"></script>
<script src="assets/site/js/jquery.app.js"></script>
<!-- Examples -->
<script src="assets/site/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
<script src="assets/site/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="assets/site/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="assets/site/plugins/tiny-editable/mindmup-editabletable.js"></script>
<script src="assets/site/plugins/tiny-editable/numeric-input-example.js"></script>

<script src="assets/site/pages/datatables.editable.init.main.category.js"></script>

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


<script>

</script>

</body>
</html>