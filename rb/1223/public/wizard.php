<?php
include('library/session_info.php');
$pagetitle = ' - Create Orders';

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

                <h4 class="page-title">Create Order</h4>
                <ol class="breadcrumb">
                    <li><a href="#"><?php echo $companyname; ?></a></li>
                    <li><a href="#">Orders</a></li>
                    <li class="active">Create Orders</li>
                </ol>
            </div>
        </div>

        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'success') {
                echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Action success </b>
												</div>';
            }
            if ($status == 'failed') {
                echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												Error ! <b>Something went Wrong </b>
												</div>';
            }
        }
        $chars="ABCDEFGHIJKLMNOPQRSTUVWQYZ123456789";
        $passcode= substr(str_shuffle($chars),0,10);
        include('class/class_orders.php');
        $rst_in_id = class_orders::select_inv_id();
        $inv_id = 'RB-0'.$rst_in_id;
        //echo $inv_id;
        ?>


        <!---->

        <div id="rootwizard">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <ul>
                            <li><a href="#tab1" data-toggle="tab">First</a></li>
                            <li><a href="#tab2" data-toggle="tab">Second</a></li>
                            <li><a href="#tab3" data-toggle="tab">Third</a></li>
                            <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                            <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                            <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                            <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    1
                </div>
                <div class="tab-pane" id="tab2">
                    2
                </div>
                <div class="tab-pane" id="tab3">
                    3
                </div>
                <div class="tab-pane" id="tab4">
                    4
                </div>
                <div class="tab-pane" id="tab5">
                    5
                </div>
                <div class="tab-pane" id="tab6">
                    6
                </div>
                <div class="tab-pane" id="tab7">
                    7
                </div>
                <ul class="pager wizard">
                    <li class="previous first"><a href="javascript:;">First</a></li>
                    <li class="previous"><a href="javascript:;">Previous</a></li>
                    <li class="next last"><a href="javascript:;">Last</a></li>
                    <li class="next"><a href="javascript:;">Next</a></li>
                    <li class="finish"><a href="javascript:;">Finish</a></li>
                </ul>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer text-right">
            <!-- Footer Section Starts-->
            <?php include("includes/footer.php");
            ?>
            <!-- Footer Section Ends -->
        </footer>
        <!-- End Footer -->

    </div> <!-- end container -->
</div>
<!-- end wrapper -->
<!-- Modal-->



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


<script src="assets/site/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/site/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>

<script src="assets/site/js/moment.js"></script>
<script src="assets/site/js/bootstrap-datetimepicker.min.js"></script>

<!--Form Wizard-->
<script src="assets/site/plugins/jquery.steps/js/jquery.steps.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/site/plugins/jquery-validation/js/jquery.validate.min.js"></script>

<!--wizard initialization-->
<script src="assets/site/pages/jquery.wizard-init.js" type="text/javascript"></script>

<!-- Parsly js -->
<script type="text/javascript" src="assets/site/plugins/parsleyjs/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
<script>
    $('#datetimepicker').datetimepicker().on('dp.show', function () {
        return $(this).data('DateTimePicker').minDate(new Date());
    });


    $('#datetimepicker1').datetimepicker().on('dp.show', function () {
        return $(this).data('DateTimePicker').minDate(new Date());
    });



</script>

<script src="assets/site/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/site/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="assets/site/plugins/switchery/js/switchery.min.js"></script>
<script type="text/javascript" src="assets/site/plugins/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/site/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>


<script src="assets/site/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/timepicker/bootstrap-timepicker.js"></script>


<script type="text/javascript" src="assets/site/pages/jquery.form-advanced.init.js"></script>
<script type="text/javascript" src="assets/site/pages/jquery.form-pickers.init.orders.js"></script>

<!-- App core js -->
<script src="assets/site/js/jquery.core.js"></script>
<script src="assets/site/js/jquery.app.js"></script>

<script src="assets/site/pages/jquery.form-pickers.init.js"></script>

<!--FooTable-->
<script src="assets/site/plugins/footable/js/footable.all.min.js"></script>
<!--FooTable Example-->
<script src="assets/site/pages/jquery.footable.js"></script>
<script src="assets/site/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
        }});
        $('#rootwizard .finish').click(function() {
            alert('Finished!, Starting over!');
            $('#rootwizard').find("a[href*='tab1']").trigger('click');
        });
    });
</script>



</body>
</html>