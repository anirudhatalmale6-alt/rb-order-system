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
								<h4 class="m-t-0 header-title"><b>Select customer information to Filter</b></h4>

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
								 <div class="form-group col-sm-12">
									<div class="col-sm-3">

                                        <select name="user_id" class="selectpicker" data-live-search="true"  data-style="btn-white">
                                            <option value="">Select Customer </option>
                                            <?php
                                            include('class/class_common_access.php');
                                            $load_all_user= Common_access::load_all_cust();
                                            while ($row_cate = mysqli_fetch_array($load_all_user)) {
                                                ?>
                                                <option value="<?php echo $row_cate['cus_id'];?>"><?php echo $row_cate['cus_mobile'].'-'.$row_cate['cus_fname']; ?></option>
                                            <?php } ?>
                                        </select>
									</div>
                                     <div class="col-sm-4">
                                         <div class="input-group date">
                                         <input type="date" class="form-control"  name="date" id="date"   value='<?php date_default_timezone_set("Asia/Kolkata");
                                         $date = date('Y-m-d'); echo  $date; ?>' data-date-format='yy-mm-dd'>
                                             <div class="input-group-addon">
                                                 <span class="glyphicon glyphicon-th"></span>
                                             </div>
                                     </div>
                                 </div>
                                <div class="col-md-1">To</div>
                                 <div class="col-md-4">
                                     <div class="input-group date">
                                         <input type="date" class="form-control"  name="date1" id="date1"   value='<?php date_default_timezone_set("Asia/Kolkata");
                                         $date = date('Y-m-d'); echo  $date; ?>' data-date-format='yy-mm-dd'>
                                             <div class="input-group-addon">
                                                 <span class="glyphicon glyphicon-th"></span>
                                             </div>
                                     </div>
								</div>

							</div>
                            <div class="col-md-12">
                                <button class="btn btn-primary waves-effect waves-light" type="submit" style="margin-left: 49%">Search</button>
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
                                        <th data-toggle="true">Invoice ID</th>
                                        <th>Mobile</th>
                                        <th>Cus Name</th>
                                        <th data-hide="phone">Date</th>
                                        <th data-hide="phone, tablet">Total</th>
                                        <th data-hide="phone, tablet">Status</th>
                                        <th data-hide="phone, tablet">Balance</th>
                                        <th data-hide="phone, tablet">Action</th>
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
                                if (isset($_GET['user_id'])){
                                include("class/class_orders.p
                                    hp");
                                   $dt=$_GET['date'];
                                   $dt1=$_GET['date1'];
                                //echo $_GET['user_id'];
                                    $prdct23=class_orders::select_all_from_inv_by_cus($_GET['user_id'],$dt,$dt1);
                                    $data23=mysqli_fetch_array($prdct23);
                                    $i=$data23['rox_inv_auto_id'];
                                    $rox_inv_status=$data23['rox_inv_status'];
                                    $rox_inv_auto_id=$data23['rox_inv_auto_id'];
                                    $rox_inv_balance=$data23['rox_inv_balance'];
                                    $rox_inv_date=$data23['rox_inv_date'];
                                    $rox_inv_cus_id=$data23['rox_inv_cus_id'];


                                    //echo 'jkh';
                                    $prdct233_=class_orders::select_all_from_cust($rox_inv_cus_id);
                                    $data233=mysqli_fetch_array($prdct233_);
                                    $cus_fname=$data233['cus_fname'];
                                    $cus_mobile=$data233['cus_mobile'];
                                    $cus_address=$data233['cus_address'];
                                    echo $rox_inv_auto_id;

                                    $prdct2w=class_orders::seleect_all_from_odr_info_1_cust($rox_inv_auto_id);
                                    while($data2w=mysqli_fetch_array($prdct2w)){

                                        $rox_prd=$data2w['rox_prd_val'];
                                        //echo $rox_inv_auto_id;

                                        $prdct2p=class_orders::seleect_all_from_product($rox_prd);
                                        $data2p=mysqli_fetch_array($prdct2p);

                                        $rox_prd_name=$data2p['rox_prd_name'];

                                        $rox_gre_des=$data2w['rox_gre_des'];
                                        $rox_gre=$data2w['rox_gre'];
                                        $rox_gre_info=$data2w['rox_gre_info'];
                                        $rox_gre_info2=$data2w['rox_gre_info2'];
                                        $rox_des=$data2w['rox_des'];
                                        $rox_ord_status=$data2w['rox_ord_status'];

                                        $bal=class_orders::select_all_from_payments($rox_inv_auto_id);
                                        $data_bal=mysqli_fetch_array($bal);
                                        $rox_pay_status=$data_bal['rox_pay_status'];

                                ?>
                                    <tr>
                                        <td>
                                            <a href="invoice?inv_code=<?php echo $i;?>&from_date=<?php echo $f_date;?>&to_date=<?php echo $t_date;?>&user_id=<?php echo $user_id?>&p_status=<?php echo $rox_pay_status?>&d_status=<?php echo $rox_ord_status?>" target="_blank"  width=700 height=650 );">

                                            <?php echo $rox_inv_auto_id;?> </a>

                                        </td>
                                        <td><?php echo $cus_mobile;?></td>
                                        <td><?php echo $cus_fname.'<br>'.$cus_address;?></td>
                                        <td><?php echo $rox_inv_date;?></td>
                                        <td><?php echo $rox_inv_balance;?></td>
                                            <?php
                                                if ($rox_ord_status == 'Pending'){$d='info';}
                                                if ($rox_ord_status == 'Cancelled'){$d='warning';}
                                                if ($rox_ord_status == 'Delivered'){ $d='success';}
                                            ?>
                                        <td><span class="label label-table label-<?php echo $d;?>"><?php echo $rox_ord_status;?></span></td>
										<td>
                                            <?php
                                                if ($rox_pay_status != 'Paid'){
                                                    echo '<span class="label label-table label-warning">'.$rox_pay_status.'.00 Due</span>';
                                                   // echo $rox_pay_status.'.00';
                                                }else{
                                                    echo '<span class="label label-table label-success">Paid</span>';
                                                }
                                            ?>
										</td>
                                        <td><a href="#"  data-toggle="modal" data-target="#exampleModal<?php echo $i;?>">Cancel Order</a></td>
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
                                        //$rox_inv_balance += $rox_pay_status;
                                    }}?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="javascript:void(0);" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Print Reoprt</a>
                                    </div>
                                </div>


                                <?php
                                if ($user_id == 0){
                                    echo
                                '<div class="col-md-4">
                                    <div class="form-group">
                                        <a href="functions/function_excell.php?out_by_date_1=yes&s_date='.$f_date.'&e_date='.$t_date.'" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Export</a>
                                    </div>
                                </div>';
                                }else  if ($user_id != 0){
                                    echo
                                '<div class="col-md-4">
                                    <div class="form-group">
                                       <a href="functions/function_excell.php?out_by_date_2=yes&s_date='.$f_date.'&e_date='.$t_date.'&u_code='.$user_id.'" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Export</a>
                                    </div>
                                </div>';
                                }

                                ?>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="odr_adv" class="control-label">Total Amount</label>
                                        <input type="text" name="" class="form-control" disabled value="<?php echo $rox_inv_balance;?>">
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
<script>
    $(function () {
        var $dp1=("#datepicker1");
        $(document).ready(function () {
            $dp1.datepicker({
                changeYear:true,
                changeMonth:true,
                minDate:'0',
                dateFormat:"yy-m-dd",
                yearRange:"-100:+20",
            });
        });
    });
</script>
        <!-- Parsly js -->
        <script type="text/javascript" src="assets/site/plugins/parsleyjs/parsley.min.js"></script>

        <script type="text/javascript">
			$(document).ready(function() {
				$('form').parsley();
			});
		</script>
        <script src="assets/site/plugins/jquery-ui/jquery-ui.min.js"></script>
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