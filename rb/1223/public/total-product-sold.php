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
					<form method="GET" action="" >
						<div class="row">
							<div class="col-lg-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ord_p_m_typ">Main-Product-Type*</label>
                                        <select name="m_c" id="ord_p_m_typ" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
                                            <option value="0">Select M-Product Type</option>
                                            <?php
                                            include('class/class_common_access.php');
                                            $load_acc_cate= Common_access::load_acc_cate();
                                            while ($row_cate = mysqli_fetch_array($load_acc_cate)) {
                                                ?>
                                                <option value="<?php echo $row_cate['rox_main_cate']; ?>"><?php echo $row_cate['rox_main_cate']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ord_p_s_typ">Sub-Product-Type</label>
                                        <select name="s_c" id="ord_p_s_typ" class="selectpicker" data-live-search="true" data-style="btn-white">
                                            <option value="">Select S-Product Type</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="prd_typ">
                                    <div class="form-group">
                                        <label for="ord_prd_typ">Product</label>
                                        <select name="pro" id="ord_prd_typ" class="selectpicker"   data-style="btn-white">
                                            <option value="">Select Product</option>
                                        </select>
                                    </div>
                                </div>
                                                     
								</div>
                                <div class="col-md-12">
                                       <div class="col-sm-4">
                                         <div class="input-group date" data-provide="datepicker">
                                         <input type="text" class="form-control"  name="date" id="date"   value='<?php date_default_timezone_set("Asia/Kolkata");
                                         $date = date('Y-m-d'); echo  $date; ?>' data-date-format='yy-mm-dd'>
                                             <div class="input-group-addon">
                                                 <span class="glyphicon glyphicon-th"></span>
                                             </div>
                                     </div>
                                 </div>
                                <div class="col-md-1">To</div>
                                 <div class="col-md-4">
                                     <div class="input-group date" data-provide="datepicker">
                                         <input type="text" class="form-control"  name="date1" id="date1"   value='<?php date_default_timezone_set("Asia/Kolkata");
                                         $date = date('Y-m-d'); echo  $date; ?>' data-date-format='yy-mm-dd'>
                                             <div class="input-group-addon">
                                                 <span class="glyphicon glyphicon-th"></span>
                                             </div>
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Search</button>
                                </div>
                                </div>
                                
								</div>
							</div>
					</form>
                            <!--	<form data-parsley-validate novalidate>-->
                        <!--</form>-->
				 <div class="row" id="ticketPrintArea">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Invoice ID</th>
                                        <th>Name</th>
                                        <th data-hide="phone">Description</th>
                                        <th data-hide="phone, tablet">Date of Delivery</th>
                                        <th data-hide="phone, tablet">Invoice date</th>
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
                                $ttt=null;
                                include("class/class_orders.php");
                                $prdct=class_orders::select_all_from_odr_all();

                                if (isset($_GET['m_c']) != '' || isset($_GET['s_c'])== '' || isset($_GET['date']) || isset($_GET['date1'])) {
                                    $prdct=class_orders::select_all_from_odr_main(isset($_GET['m_c']),isset($_GET['date']),isset($_GET['date1']));
                                } if ( isset($_GET['s_c'])!= '') {
                                    $prdct=class_orders::select_all_from_odr_sub($_GET['m_c'],$_GET['s_c'],$_GET['date'],$_GET['date1']);
                                }if (isset($_GET['pro']) != '' ) {
                                    $prdct=class_orders::select_all_from_odr_pro($_GET['m_c'],$_GET['s_c'],$_GET['pro'],$_GET['date'],$_GET['date1']);
                                }
                                if (isset($_GET['m_c'])== '') {
                                    $prdct=class_orders::select_all_from_odr_all();
                                }
                                 
                                while($data=mysqli_fetch_array($prdct)){

                                    $rox_inv_id=$data['rox_inv_id'];
                                    $rox_prd=$data['rox_prd'];
                                    $rox_prd_val=$data['rox_prd_val'];
                                    //echo $rox_inv_id;

                                    $prdct23=class_orders::select_all_from_inv($rox_inv_id);
                                    $data23=mysqli_fetch_array($prdct23);
                                        $i=$data23['rox_inv_auto_id'];
                                        $rox_inv_status=$data23['rox_inv_status'];
                                        $rox_inv_balance=$data23['rox_inv_balance'];
                                        $rox_inv_date=$data23['rox_inv_date'];
                                        $rox_inv_cus_id=$data23['rox_inv_cus_id'];

                                    $prdct233_=class_orders::select_all_from_cust($rox_inv_cus_id);
                                    $data233=mysqli_fetch_array($prdct233_);
                                    $cus_fname=$data233['cus_fname'];
                                    $cus_address=$data233['cus_address'];
                                    //echo $rox_inv_cus_id;


                                    $prdct2p=class_orders::seleect_all_from_product($rox_prd_val);
                                    $data2p=mysqli_fetch_array($prdct2p);

                                    $rox_prd_name=$data2p['rox_prd_name'];

                                    //$rox_gre_des=$data2p['rox_gre_des'];
                                    $rox_gre=$data['rox_gre'];
                                    $rox_gre_info=$data['rox_gre_info'];
                                    $rox_gre_info2=$data['rox_gre_info2'];
                                    $rox_des=$data['rox_des'];
                                    //$rox_ord_status=$data['rox_ord_status'];
                                    $rox_gre_des=$data['rox_gre_des'];

                                    $bal=class_orders::select_all_from_payments($rox_inv_id);
                                    $data_bal=mysqli_fetch_array($bal);
                                        $rox_pay_status=$data_bal['rox_pay_status'];

                                        $ttt += $rox_inv_balance;

                                ?>
                                    <tr>
                                        <td>
                                            <a href="invoice?inv_code=<?php echo $i;?>&from_date=<?php //echo $f_date;?>&to_date=<?php //echo $t_date;?>&user_id=<?php //echo $user_id?>" target="_blank"  width=700 height=650 );">

                                            <?php echo $rox_inv_id;?> </a>
                                        </td>
                                        <td><?php echo $cus_fname.'<br>'.$cus_address;?></td>
                                        <td><?php echo $rox_gre_des.$rox_gre.$rox_gre_info.$rox_gre_info2.$rox_des;?></td>
                                        <td><?php echo $rox_inv_date;?></td>
                                        <td><?php echo $data23['rox_del_date'].'-'.$data23['rox_inv_time'];?></td>

                                        <td><?php echo $rox_inv_balance;?></td>
                                            <?php //$d='info'; echo $rox_inv_status;
                                                if ($rox_inv_status == 'Pending'){$d='info';}
                                                if ($rox_inv_status == 'Cancelled'){$d='warning';}
                                                if ($rox_inv_status == 'Delivered'){ $d='success';}
                                                if($rox_inv_status == ''){ $d='';}
                                                //$d=0;
                                            ?>
                                        <td><span class="label label-table label-<?php echo $d;?>"><?php echo $rox_inv_status;?></span></td>
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
                                 }
                                ?>

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

            $(document).on('change','#ord_p_m_typ',function(){
                frm_call = 'load_subcat';
                $("#ord_p_s_typ").empty();
                $("#ord_prd_typ").empty();
                $('#ord_p_s_typ').selectpicker('refresh');
                var main_cateid = $(this).val();

                $.ajax({
                    url: 'class/class_select_sub_cate.php',
                    type: 'post',
                    data: {
                        main_cate_id :main_cateid,
                        paracall : frm_call,
                    },
                    dataType: 'json',
                    success:function(response){
                        var len = response.length;
                        var found = false;

                        $("#ord_p_s_typ").empty();
                        $("#ord_p_s_typ").append("<option value=''>select sub cat</option>");
                        for( var i = 0; i<len; i++){
                            var sub_id = response[i]['sub_id'];
                            var sub_name = response[i]['sub_name'];

                            $("#ord_p_s_typ").append("<option value='"+sub_id+"'>"+sub_name+"</option>");
                            $('#ord_p_s_typ').selectpicker('refresh');
                            found = true;
                        }
                        if( found == false ){
                            load_main();
                        }

                    }
                });
            });

            $(document).on('change','#ord_p_s_typ',function(){
                frm_call = 'load_product';
                $("#ord_prd_typ").empty();
                var sub_cateid = $(this).val();
                // if(sub_cateid != null){
                // $("#prd").hide();
                // $("#prd_typ").show();
                // }
                // else{
                // $("#ord_prd_typ").empty();
                // $("#prd").show();
                // $("#prd_typ").hide();
                // }
                $.ajax({
                    url: 'class/class_select_sub_cate.php',
                    type: 'post',
                    data: {
                        product :sub_cateid,
                        paracall : frm_call,
                    },
                    dataType: 'json',
                    success:function(response){
                        // alert(main_cateid);
                        var len = response.length;

                        $("#ord_prd_typ").empty();
                        $("#ord_prd_typ").append("<option value=''>Select Product</option>");
                        for( var i = 0; i<len; i++){
                            var auto_id = response[i]['auto_id'];
                            var prd_name = response[i]['prd_name'];
                            $("#ord_prd_typ").append("<option value='"+auto_id+"'>"+prd_name+"</option>");
                            $('#ord_prd_typ').selectpicker('refresh');
                        }


                    }
                });
            });

        </script>


    </body>
</html>