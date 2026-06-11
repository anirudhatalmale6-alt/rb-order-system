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
                                <?php
                                if (isset($_GET['from_date']))
                                {
                                    $from_date=$_GET['from_date'];
                                    $to_date=$_GET['to_date'];
                                    $f_date = str_replace("/","-",$from_date);
                                    $t_date = str_replace("/","-",$to_date);
                                }
                                ?>
                                <div class="col-md-4" id="prd_typ">
                                    <div class="form-group">
                                        <div class="input-daterange input-group" id="date-range">
                                            <input type="text" class="form-control" required value="<?php if (isset($_GET['from_date']))
                                            { echo $f_date;}?>" name="from_date" />
                                            <span class="input-group-addon bg-custom b-0 text-white">to</span>
                                            <input type="text" class="form-control" required value="<?php  if (isset($_GET['from_date']))
                                            { echo $t_date;}?>" name="to_date" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <select name="user_id" class="selectpicker" data-live-search="true"  data-style="btn-white" required>
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
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Search</button>
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
                                        <th>Main Cat</th>
                                        <th data-hide="phone">Sub Cat</th>
                                        <th data-hide="phone, tablet">Name</th>
                                        <th data-hide="phone, tablet">Price</th>
                                        <th data-hide="phone, tablet">Total Sales</th>
                                        <th data-hide="phone, tablet">Quantity</th>
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
                                $rox_line_id=null;
                                $rox_prd_main_cate=null;
                                $rox_prd_sub_cate=null;
                                $rox_prd_name=null;
                                $rox_prd_price=null;
                                $ttt=null;
                                $rox_prd_qty__=null;
                                $total_=null;
                                $prdct=null;
                                include("class/class_orders.php");


                        if (isset($_GET['from_date'])){
                            $from_date=$_GET['from_date'];
                            $to_date=$_GET['to_date'];
                            $user_id=$_GET['user_id'];

                                $prdct2=class_orders::select_all_from_product_all();

                                while ($data2pp=mysqli_fetch_array($prdct2)){
                                    $rox_line_id=$data2pp['rox_line_id'];
                                    //echo $rox_line_id;
                                        $prdct1=class_orders::get_invoice_id($user_id);
                                        $row=mysqli_fetch_array($prdct1);
                                        $invid=$row['rox_inv_auto_id'];
                                        $prdct=class_orders::select_all_from_product_between_dats($rox_line_id,$from_date,$to_date,$invid);
                                       // echo 'one';
                                            while ($data2p=mysqli_fetch_array($prdct)){

                                    $rox_line_id=$data2p['rox_prd_val'];
                                    $rox_prd_main_cate=$data2p['rox_p_main_typ'];
                                    $rox_prd_sub_cate=$data2p['rox_p_sub_type'];
                                    $rox_prd_name=$data2p['rox_prd'];
                                    $rox_prd_price=$data2p['rox_prd_price'];

                                        $ordr=class_orders::select_all_from_report_where_pro_id_date($rox_line_id,$from_date,$to_date,$invid);
                                           // echo $ordr;
                                ?>
                                    <tr>
                                        <td><?php echo $rox_prd_main_cate;?></td>
                                        <td><?php echo $rox_prd_sub_cate;?></td>
                                        <td><?php echo $rox_prd_name;?></td>
                                        <td><?php echo $rox_prd_price;?></td>
                                        <td><?php echo $ordr*$rox_prd_price;?></td>
                                        <td><?php echo $ordr;?></td>
                                        <td><a href="#"  data-toggle="modal" data-target="#exampleModal<?php echo $invid;?>">Cancel Order</a></td>

                                    </tr>
                                                <div class="modal fade<?php echo $invid;?>" id="exampleModal<?php echo $invid;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">


                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>


                                                            <form action="functions/function_payment.php" method="post">

                                                                <div class="form-group">
                                                                    <input type="text" name="invid" value="<?php echo $invid;?>" hidden>
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
                                <?php }}}?>

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