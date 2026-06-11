<?php
include('library/session_info.php');
$pagetitle = ' - Create Orders';

$pagedescr = ' ';

$pagekeywords = ' ';

$rox_inv_due='';

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
												<b>File (Report_date.csv) Downloaded to "Report_date.csv"</b>
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

                <h4 class="page-title"> Order Reports</h4>

            </div>
        </div>


        <div class="card-box">
            <form method="GET" action="#" data-parsley-validate novalidate>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary waves-effect waves-light" type="submit" style="margin-top: 24px !important;">Search</button>
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
                                    <option value="0">Select S-Product Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="prd_typ">
                            <div class="form-group">
                                <label for="ord_prd_typ">Product</label>
                                <select name="pro" id="ord_prd_typ" class="selectpicker"   data-style="btn-white">
                                    <option value="0">Select Product</option>
                                </select>
                            </div>
                        </div>



                    </div>
                    <div class="col-md-8" style="margin-left: 10px; !important;">
                        <label for="ord_p_m_typ">Select two dates</label>
                        <!--                        --><?php
                        //                        if (isset($_GET['from_date']))
                        //                        {
                        //                            $from_date=$_GET['from_date'];
                        //                            $to_date=$_GET['to_date'];
                        //                            $f_date = str_replace("/","-",$from_date);
                        //                            $t_date = str_replace("/","-",$to_date);
                        //                        }
                        //                        ?>
                        <div class="input-daterange input-group" id="date-range">
                            <input type="text" class="form-control"  name="from_date" id="from_date"   value='<?php date_default_timezone_set("Asia/Kolkata");
                            $date = date('Y-m-d'); echo  $date; ?>' data-date-format='yy-mm-dd'>
                            <span class="input-group-addon bg-custom b-0 text-white">to</span>
                            <input type="text" class="form-control"  name="to_date" id="to_date"   value='<?php date_default_timezone_set("Asia/Kolkata");
                            $date = date('Y-m-d'); echo  $date; ?>' data-date-format='yy-mm-dd'>
                        </div>

                    </div>
                </div>


            </form>
        </div>
        <div class="row" id="ticketPrintArea">
            <div class="col-sm-12">
                <div class="card-box">
                    <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                        <thead>
                        <tr>
                            <th data-toggle="true">Delivery Date</th>
                            <th >Invoice ID</th>
                            <th>Product Name</th>
                            <th data-hide="phone">Description</th>

                            <th>Qty</th>
                            <!--                            <th>Action</th>-->
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
                            $to_date=$_GET['to_date'];
                            $cat=$_GET['m_c'];

                            if(isset($_GET['pro'])){
                                if($_GET['pro']=='undefined'){
                                    $pro='';
                                }else{
                                    $pro=$_GET['pro'];
                                }

                            }else{
                                $pro='';
                            }
                            if(isset($_GET['s_c'])){
                                if($_GET['s_c']=='undefined'){
                                    $sub='';
                                }else{
                                    $sub=$_GET['s_c'];
                                }

                            }else{
                                $sub='';
                            }




                            $f_date = str_replace("/","-",$from_date);
                            $t_date = str_replace("/","-",$to_date);
                            include("class/class_orders.php");
                            if (isset($_GET['from_date'])){
                                $prdct=class_orders::select_all_between_date_only_chef($f_date,$t_date);
                                //$prdct_sum=class_orders::select_all_between_date_only_sum($f_date,$t_date);
                            }else{
                                $prdct=class_orders::select_all_between($f_date,$t_date,$user_id);
                                //$prdct_sum=class_orders::select_all_between_sum($f_date,$t_date,$user_id);
                            }

                            while($data=mysqli_fetch_array($prdct)){

                                $i=$data['rox_inv_auto_id'];
                                $rox_inv_status=$data['rox_inv_status'];
                                $rox_inv_balance=$data['rox_inv_balance'];

                                $prdct23=class_orders::select_all_from_inv($i);
                                $data23=mysqli_fetch_array($prdct23);
                                $i=$data23['rox_inv_auto_id'];
                                $rox_inv_status=$data23['rox_inv_status'];
                                //$rox_inv_balance=$data23['rox_inv_balance'];
                                $rox_inv_date=$data23['rox_inv_date'];
                                $rox_inv_cus_id=$data23['rox_inv_cus_id'];

                                $prdct233_=class_orders::select_all_from_cust($rox_inv_cus_id);
                                $data233=mysqli_fetch_array($prdct233_);
                                $cus_fname=$data233['cus_fname'];
                                $cus_address=$data233['cus_address'];

                                $prdct2=class_orders::seleect_all_from_odr_info1($data['rox_inv_auto_id'],$cat,$sub,$pro);

                                while($data2=mysqli_fetch_array($prdct2)){

                                    $rox_prd=$data2['rox_prd_val'];
                                    //echo $rox_prd;

                                    $prdct2p=class_orders::seleect_all_from_product1($rox_prd,$pro);
                                    $data2p=mysqli_fetch_array($prdct2p);
                                    //rox_prd
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
                                    $rox_inv_due=$data['rox_inv_due'];
                                    ?>
                                    <tr>
                                        <td><?php echo $data['rox_del_date'];?> <?php echo date("g:i a", strtotime($data['rox_inv_time'])); ?></td>
                                        <td><?php echo $data['rox_inv_auto_id'];?></td>
                                        <td><?php echo $data2['rox_prd'];;?></td>
                                        <td><?php echo $rox_gre_des.' '.$rox_gre.' '.$rox_gre_info.' '.$rox_gre_info2.' '.$rox_des;?></td>

                                        <td><?php echo $data2['rox_prd_qty'];?></td>
                                        <!--                                        <td><a href="#"  data-toggle="modal" data-target="#exampleModal--><?php //echo $i;?><!--">Cancel Order</a></td>-->
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


                        <div class="col-md-4">
                            <div class="form-group">
                                   <a href="functions/function_excell.php?out_by_date_2_cheff=yes&<?php echo $_SERVER['QUERY_STRING']?>"   class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Export</a>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                Manufacture Date: <?= $rox_inv_due ?>
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
    setTimeout(function () {
        <?php if(isset($_SESSION['downloaded_file'])){ $downloaded_file=$_SESSION['downloaded_file']; if(file_exists($downloaded_file)){unlink($downloaded_file); } unset($_SESSION['downloaded_file']); }else{ $downloaded_file=''; } ?>
    },7000);
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
                $("#ord_p_s_typ").append("<option value='"+sub_id+"'>select sub cat</option>");
                for( var i = 0; i<len; i++){
                    var sub_id = response[i]['sub_id'];
                    var sub_name = response[i]['sub_name'];

                    $("#ord_p_s_typ").append("<option value='"+sub_name+"'>"+sub_name+"</option>");
                    $('#ord_p_s_typ').selectpicker('refresh');
                    found = true;
                }
                if( found == false ){
                    load_main();
                }

            }
        });
    });

    function load_main(){
        frm_call = 'load_main_prd';
        $("#ord_p_s_typ").empty();
        $("#ord_prd_typ").empty();
        $('#ord_p_s_typ').selectpicker('refresh');
        var main_cateid = $("#ord_p_m_typ").val();

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
                $("#ord_prd_typ").empty();
                $("#ord_prd_typ").append("<option value='0'>Select Product</option>");
                for( var i = 0; i<len; i++){
                    var prd_name = response[i]['prd_name'];
                    var auto_id = response[i]['auto_id'];
                    $("#ord_prd_typ").append("<option value='"+prd_name+"'>"+prd_name+"</option>");
                    $('#ord_prd_typ').selectpicker('refresh');
                }

            }
        });
    }
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
                $("#ord_prd_typ").append("<option value='"+auto_id+"'>Select Product</option>");
                for( var i = 0; i<len; i++){
                    var auto_id = response[i]['auto_id'];
                    var prd_name = response[i]['prd_name'];
                    $("#ord_prd_typ").append("<option value='"+prd_name+"'>"+prd_name+"</option>");
                    $('#ord_prd_typ').selectpicker('refresh');
                }


            }
        });
    });

    $(document).on('change','#ord_prd_typ',function(){
        frm_call = 'load_prd_price';
        var product_price = $(this).val();
        $.ajax({
            url: 'class/class_select_sub_cate.php',
            type: 'post',
            data: {
                prd_price :product_price,
                paracall : frm_call,
            },
            dataType: 'json',
            success:function(response){
                var len = response.length;
                var prd_price = 0;
                var prd_status = 0;
                var prd_name_ = 0;
                for( var i = 0; i<len; i++){
                    prd_price = response[i]['prd_price'];
                    prd_status = response[i]['prd_status'];
                    prd_name_ = response[i]['prd_name'];
                    prd_id_d = response[i]['prd_id_dd'];

                    //alert(prd_id_d);
                }
                $("#odr_price").val(prd_price);
                $("#odr_name").val(prd_name_);
                $("#odr_id_p").val(prd_status);
            }
        });
    });
</script>


</body>
</html>