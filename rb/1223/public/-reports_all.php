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
                <?php
                if (isset($_GET['status'])) {
                    $status = $_GET['status'];
                    if ($status == 'success') {
                        echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>File (Report_all.csv) Downloaded to "c:Report_all.csv"</b>
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
                    if($status=='succ')
                    {
                        echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Saved successfully!!</b>
												</div>';
                    }
                    if($status=='fail')
                    {
                        echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Saved unsuccessfully!!</b>
												</div>';
                    }
                    if($status=='8')
                    {
                        echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Order Canceled successfully!!</b>
												</div>';
                    }
                    if($status=='9')
                    {
                        echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Unsuccessfull!!</b>
												</div>';
                    }
                }
                ?>
				 <div class="row" id="ticketPrintArea">
                    <div class="col-sm-12">
                        <div class="card-box">                           
                            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="250">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Invoice ID</th>
                                        <th>Make Payment</th>
                                        <th>Name</th>
                                        <th data-hide="phone, tablet">Date of Delivery</th>
                                        <th data-hide="phone, tablet">Total</th>
                                        <th data-hide="phone, tablet">Status</th>
                                        <th data-hide="phone, tablet">Balance</th>
                                        <th data-hide="phone, tablet">Print</th>

                                        <th data-hide="phone, tablet">Action</th>

                                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                $ttt =null;
                                include("class/class_orders.php");

                                    $prdct23=class_orders::select_all_from_inv_without_condi();
                                    while($data23=mysqli_fetch_array($prdct23)){
                                        $i=$data23['rox_inv_auto_id'];
                                        $rox_inv_status=$data23['rox_inv_status'];
                                        $rox_inv_balance=$data23['rox_inv_balance'];
                                        $rox_inv_cus_id=$data23['rox_inv_cus_id'];

                                        $prdct233_=class_orders::select_all_from_cust($rox_inv_cus_id);
                                        $data233=mysqli_fetch_array($prdct233_);
                                        $cus_fname=$data233['cus_fname'];
                                        $cus_address=$data233['cus_address'];


                                    $prdct2=class_orders::seleect_all_from_odr_info($i);
                                    while($data2=mysqli_fetch_array($prdct2)){

                                        $rox_prd=$data2['rox_prd_val'];
                                        $rox_line_id=$data2['rox_line_id'];
                                        $rox_prd_name=$data2['rox_prd'];


                                            $prdct2p=class_orders::seleect_all_from_product($rox_prd);
                                            $data2p=mysqli_fetch_array($prdct2p);
                                                $rox_prd_name1=$data2p['rox_prd_name'];

                                        $rox_gre_des=$data2['rox_gre_des'];
                                        $rox_gre=$data2['rox_gre'];
                                        $rox_gre_info=$data2['rox_gre_info'];
                                        $rox_gre_info2=$data2['rox_gre_info2'];
                                        $rox_des=$data2['rox_des'];
                                        $rox_ord_status=$data2['rox_ord_status'];

                                        $bal=class_orders::select_all_from_payments($i);
                                        $data_bal=mysqli_fetch_array($bal);
                                        $rox_pay_status=$data_bal['rox_pay_status'];

                                        $t_date='';
                                        $f_date='';
                                        $user_id='';

                                        $ttt += $rox_inv_balance;
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($admin_role == 'Admin' || $admin_role == 'Sales'){
                                               // echo '<a href="invoice?inv_code='.$i.'&from_date='.$f_date.'&to_date='.$t_date.'&user_id='.$user_id.'&p_status='.$rox_pay_status.'&d_status='.$rox_ord_status.'" target="_blank"  width=700 height=650 )">'.$i.' </a>';
                                           ?>
                                                <a onclick="window.open('invoice-A5?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span><?php echo $i;  ?></span></a>
                                                <?php
                                            }else {
                                                echo $i;
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php

                                            if($rox_pay_status != '0')
                                            {
                                                echo '<a href="#"  data-toggle="modal" data-target="#exampleModalLong'.$i.'">Make Payment</a>';



                                            }
                                            ?>
                                        </td>

                                        <td><?php echo $rox_prd_name;?></td>
                                        <td><?php echo $data23['rox_del_date'];?></td>
                                        <td><?php echo $rox_inv_balance;?></td>
                                            <?php
                                                if ($rox_ord_status == 'Pending'){$d='info';}
                                                if ($rox_ord_status == 'Cancelled'){$d='warning';}
                                                if ($rox_ord_status == 'Delivered'){ $d='success';}
//                                                if($rox_pay_status == '0' && $rox_pay_status!='Cancelled'){}

                                            ?>
                                        <td>
                                        <?php
                                        if ($rox_pay_status == '0'){
                                            ?>
                                            <span class="label label-table label-success"><?php echo 'Delivered'?></span>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="label label-table label-<?php echo $d;?>"><?php echo $rox_ord_status;?></span>
                                            <?php
                                        }
                                        ?>

                                        </td>
										<td>
                                            <?php
                                                if ($rox_pay_status != '0'){
                                                    $int = intval($rox_pay_status);
                                                    if (is_integer($rox_pay_status))
                                                    {
                                                        echo '<span class="label label-table label-warning">'.$rox_pay_status.'.00 Due</span>';
                                                    }
                                                    else
                                                    {
                                                        echo '<span class="label label-table label-warning">'.$rox_pay_status.'.00 Due</span>';
                                                    }

                                                   // echo $rox_pay_status.'.00';
                                                }else{
                                                    echo '<span class="label label-table label-success">Paid</span>';
                                                }
                                            ?>
										</td>
                                        <td>
                                            <?php
                                            if ($admin_role == 'Admin' || $admin_role == 'Sales'){
                                                // echo '<a href="invoice?inv_code='.$i.'&from_date='.$f_date.'&to_date='.$t_date.'&user_id='.$user_id.'&p_status='.$rox_pay_status.'&d_status='.$rox_ord_status.'" target="_blank"  width=700 height=650 )">'.$i.' </a>';
                                                ?>
                                                <a onclick="window.open('invoice?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span>Print</span></a>
                                                <?php
                                            }else {
                                                echo $i;
                                            }
                                            ?>

                                               <hr style="margin: 0px; height: 1px; background-color: #cccccc"/>
                                            <?php
                                            if ($admin_role == 'Admin' || $admin_role == 'Sales'){
                                                // echo '<a href="invoice?inv_code='.$i.'&from_date='.$f_date.'&to_date='.$t_date.'&user_id='.$user_id.'&p_status='.$rox_pay_status.'&d_status='.$rox_ord_status.'" target="_blank"  width=700 height=650 )">'.$i.' </a>';
                                                ?>
                                                <a onclick="window.open('invoice-A5?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span>Print-A5</span></a>
                                                <?php
                                            }else {
                                                echo $i;
                                            }
                                            ?>

                                        </td>

                                        <td><a href="#"  data-toggle="modal" data-target="#exampleModal<?php echo $i;?>" >Cancel Order</a></td>
                                    </tr>
                                        <div class="modal fade<?php echo $i;?>" id="exampleModalLong<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Make Payment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="functions/function_payment.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" name="invid" value="<?php echo $i;?>" hidden>
                                                            <input type="text" name="cusid" value="<?php echo $rox_inv_cus_id;?>" hidden>
                                                            <input type="text" id="Mbalance" name="balance" class="Mbalance" value="<?php echo $rox_pay_status;?>" hidden>
                                                            <label for="main_cate">Payment Type</label>
                                                            <!--                            <input type="text" name="type" parsley-trigger="change" required placeholder="Payment Type" class="form-control" id="main_cate">-->
                                                            <select class="form-control" name="type">
                                                                <option value="Cash">Cash</option>
                                                                <option value="Card">Card</option>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="main_cate_des">Payment</label>
                                                            <input type="text" name="payment"  required placeholder="Enter payment" class="form-control payment" id="Payment">
<!--                                                            <input type="text" name="payment" parsley-trigger="change" required placeholder="Enter payment" class="form-control" id="payment1" value="--><?php //echo $rox_pay_status?><!--">-->
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary valSubmit" name="submit" id="valSubmit" onclick=" return validate(<?php echo $rox_pay_status;?>)">Submit</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                <?php }}?>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="javascript:void(0);" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Print Reoprt</a>
                                </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="functions/function_excell.php?out_all=yes" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Export</a>
                                </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="odr_adv" class="control-label">Total Amount</label>
                                        <input type="text" name="" class="form-control" disabled value="<?php echo $ttt;?>">
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
        <script src="assets/site/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
        <script src="assets/site/pages/jquery.sweet-alert.init.js"></script>
        <script>
            function validate(id)
            {


                 var vall=id;
                 var val = $('input[name=payment]').val();
                if(val > vall)
                {
                    alert("Not more than" +vall+".");
                    return false
                }
                return true;
            }
        </script>
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


//            $('#Payment').keyup(function(){
//                var vall=$('#payment1').val();
////                alert(vall);
//                if ($(this).val() > vall ){
//                    alert("No numbers above Balance Amount");
//                    $(this).val(vall);
//                }
//            });

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



<!--        <script src="assets/site/pages/jquery.form-pickers.init.js"></script>-->

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
    <script>
//        $(document).on('click','valSubmit', function(){
//
//
//            var bal =  $(this).closest("form").find(".Mbalance").val();
//            var pay =  $(this).closest("form").find(".Payment").val();
//            alert(bal);
////            if( pay < bal  ){
////                alert("Not more than" + bal +".");
////            }
//        });


    </script>



    </body>
</html>