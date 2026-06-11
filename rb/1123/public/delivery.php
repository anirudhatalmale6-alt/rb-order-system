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

        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'success') {
                echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>File (Report_date.csv) Downloaded to "c:Report_date.csv"</b>
												</div>';
            }
            if ($status == 'failed') {
                echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												Error Occer! <b>User Details not Saved</b>
												</div>';
            }
        }
        ?>
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

                <h4 class="page-title">Reports</h4>
                <ol class="breadcrumb">
                    <li><a href="#"><?php echo $companyname; ?></a></li>

                </ol>
            </div>
        </div>


        <div class="card-box">
            <form method="GET" action="#" data-parsley-validate novalidate>
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="m-t-0 header-title"><b>Today's Delivery Reports </b></h4>


                        <!--  <div class="form-group col-lg-4">
                                    <label for="lname">From*</label>
                                    <input type="text" name="from_date" parsley-trigger="change" value="<?php echo $lname;?>" required placeholder="Enter Last Name" class="form-control" id="lname">
                                </div> -->
                        <!--
								<div class="form-group col-lg-4">
									<label for="lname">To*</label>
									<input type="text" name="to_date" parsley-trigger="change" value="<?php echo $lname;?>" required placeholder="Enter Last Name" class="form-control" id="lname">
								</div>-->


                        <div class="form-group col-sm-2">
                            <label for="lname"></label>
                        </div>
                        <div class="form-group col-sm-8">
                            <form method="post" action="">
                            
                            <div class="col-sm-12">
                                <div class="col-md-3">Date of Delivery</div>
                               <div class="col-md-5"><input type="date" class="form-control"  name="from_date" required="required"/></div>
                               <div class="col-md-4">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Search</button></div>
                            </div>
                            
                        </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="row" id="ticketPrintArea">
            <div class="col-sm-12">
                <div class="card-box">
                    <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                        <thead>
                        <tr>
                            <th data-toggle="true">Date of Delivery</th>
                            <th >Invoice ID</th>
                            <th>Name and Qty</th>
                            <th>Cus Name</th>
                            <th>Cus Delivery Address</th>
                            <th data-hide="phone, tablet">Phone</th>

                            
                        </tr>
                        </thead>
                        <div class="form-inline m-b-20">
                            <div class="row">
                                <div class="col-sm-6 text-xs-center">
                                    <div class="form-group">
                                        <label class="control-label m-r-5">Status</label>
                                        <select id="demo-foo-filter-status" class="form-control input-sm">
                                            <option value="">Show all</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Due">Un Paid</option>
                                            <option value="Delivered">Delivered</option>
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
                        $rox_inv_balance='0';
                        $prdct_sum='0';
                        $user_id ='0';
                        $f_date  ='0';
                        $t_date   ='0';

                        if (isset($_GET['from_date'])){
                            $from_date=$_GET['from_date'];
                            $f_date = $from_date;

                            include("class/class_orders.php");

                                $prdct=class_orders::select_all_where_date($f_date,$t_date,$user_id);

                            while($data=mysqli_fetch_array($prdct)){

                                $i=$data['rox_inv_auto_id'];
                                $rox_inv_status=$data['rox_inv_status'];
                                $rox_inv_balance=$data['rox_inv_balance'];

                                $rox_inv_date=$data['rox_inv_date'];
                                $rox_inv_cus_id=$data['rox_inv_cus_id'];
                                $rox_del_date=$data['rox_del_date'];

                                $prdct233_=class_orders::select_all_from_cust($rox_inv_cus_id);
                                $data233=mysqli_fetch_array($prdct233_);
                                $cus_fname=$data233['cus_fname'];
                                $cus_address=$data233['cus_address'];
                                $cus_mobile=$data233['cus_mobile'];

                                $prdct2=class_orders::seleect_all_from_odr_info($data['rox_inv_auto_id']);
                                while($data2=mysqli_fetch_array($prdct2)){

                                    $rox_prd=$data2['rox_prd_val'];
                                    $rox_prdd=$data2['rox_prd'];
                                    $qtyy=$data2['totqty'];
                                    //echo $rox_prd;

                                    $prdct2p=class_orders::seleect_all_from_product($rox_prd);
                                    $data2p=mysqli_fetch_array($prdct2p);

                                    $rox_prd_name=$data2p['rox_prd_name'];

                                    $rox_gre_des=$data2['rox_gre_des'];
                                    $rox_gre=$data2['rox_gre'];
                                    $rox_gre_info=$data2['rox_gre_info'];
                                    $rox_gre_info2=$data2['rox_gre_info2'];
                                    $rox_des=$data2['rox_des'];
                                    $rox_ord_status=$data2['rox_ord_status'];

                                    $bal=class_orders::select_all_from_payments($data['rox_inv_auto_id']);
                                    $data_bal=mysqli_fetch_array($bal);
                                    $rox_pay_status=$data_bal['rox_pay_status'];

                                    ?>
                                    <tr>
                                        <td><?php echo $rox_del_date;?></td>
                                        <td>
                                            
                                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=&user_id=&p_status=&d_status=&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span><?php echo $data['rox_inv_auto_id'];  ?></span></a>

                                        </td>
                                        <td><?php echo $rox_prdd; ?></td>
                                        <td><?php echo $cus_fname?></td>
                                        <td><?php echo ($cus_address!='')? $cus_address:"Pick-Up";?></td>
                                        <td><?php echo $cus_mobile;?></td>

                                        <!-- <td><a href="#"  data-toggle="modal" data-target="#exampleModal<?php echo $i;?>" class="md md-close"></a></td> -->
                                    </tr>
                                    <div class="modal fade<?php echo $i;?>" id="exampleModal<?php echo$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">


                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>


                                                <form action="functions/function_payment.php" method="post">

                                                    <div class="form-group">
                                                        <input type="text" name="invid" value="<?php echo $i;?>" hidden>
                                                        <img src="assets/site/images/Remove.png" style="margin-left: 202px;"/>
                                                        <h3 style="margin-left: 200px;">Are you sure?</h3>
                                                        <p style="margin-left: 169px;">You Want to Cancel The Order</p>


                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger valSubmit" name="cancel" id="valSubmit">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                    $rox_inv_balance += $rox_inv_balance;
                                }}}?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <a href="javascript:void(0);" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Print Reoprt</a>
                            </div>
                        </div>




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

<script src="assets/site/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="assets/site/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/site/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/site/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="assets/site/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="assets/site/js/jquery.print.min.js"></script>

<script>
    jQuery(function($) {
        'use strict';

        $("#ticketPrintArea").find('#btnPrint').on('click', function() {
            //Print ele4 with custom options
            $("#ticketPrintArea").print({
                //Use Global styles
                globalStyles : true,
                //Add link with attrbute media=print
                mediaPrint : false,
                //Custom stylesheet
                // stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
                //Print in a hidden iframe
                iframe : false,
                //Don't print this
                noPrintSelector : ".avoid-this",
                //Add this at top
                // prepend : "Hello World!!!<br/>",
                //Add this on bottom
                //append : "<br/>Buh Bye!",
                //Log to console when printing is done via a deffered callback
                deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
            });
        });
        // Fork https://github.com/sathvikp/jQuery.print for the full list of options
    });

</script>

<!-- Parsly js -->
<script type="text/javascript" src="assets/site/plugins/parsleyjs/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

<script src="assets/site/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="assets/site/plugins/switchery/js/switchery.min.js"></script>
<script type="text/javascript" src="assets/site/plugins/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/site/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
<script src="assets/site/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


<script type="text/javascript" src="assets/site/pages/jquery.form-advanced.init.js"></script>


<!-- App core js -->
<script src="assets/site/js/jquery.core.js"></script>
<script src="assets/site/js/jquery.app.js"></script>

<!--FooTable-->
<script src="assets/site/plugins/footable/js/footable.all.min.js"></script>
<!--FooTable Example-->
<script src="assets/site/pages/jquery.footable.js"></script>



<script src="assets/site/pages/jquery.form-pickers.init.js"></script>

<script>
    $("#product_name").on('change',function(){
        //var frm_call = 'load_price';
        //alert (frm_call);
        $("#odr_price").empty();
        var p_id = $(this).val();
        $.ajax({
            url: 'functions/function_orders.php',
            type: 'post',
            data: {
                pr_id :p_id,
            },
            dataType: 'json',
            success:function(response){
                $("#odr_price").val(response);
            }
        });
    });
</script>


</body>
</html>