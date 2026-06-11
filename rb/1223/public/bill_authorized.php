<?php
include('library/session_info.php');
$pagetitle = ' - Create Orders';

$pagedescr = ' ';

$pagekeywords = ' ';

include(INC_PATH . "system-info.php");

include(INC_PATH . "header.php");
?>
<style>
    /* DivTable.com */
    .divTable{
        display: table;
        width: 100%;
    }
    .divTableRow {
        display: table-row;
    }
    .divTableHeading {
        background-color: #EEE;
        display: table-header-group;
    }
    .divTableCell, .divTableHead {

        display: table-cell;
        padding: 3px 2px;
        width: 25%;
    }
    .divTableHeading {
        background-color: #EEE;
        display: table-header-group;
        font-weight: bold;
    }
    .divTableFoot {
        background-color: #EEE;
        display: table-footer-group;
        font-weight: bold;
    }
    .divTableBody {
        display: table-row-group;
    }
</style>
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
            if($status=='edited')
            {
                echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Order Edit successfully!!</b>
												</div>';
            }
        }
        ?>
        <div id="load_order">
        <div class="row" id="ticketPrintArea">
            <div class="col-sm-12">
                <div class="card-box">
                    <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="250">
                        <thead>
                        <tr>
                            <th data-toggle="true">Invoice ID</th>
                            <th>Name</th>
                            <th data-hide="phone, tablet">Date of Delivery</th>
                            <th data-hide="phone, tablet">Total</th>
                            <th data-hide="phone, tablet">Status</th>
                            <th data-hide="phone, tablet">Balance</th>
                            <th data-hide="phone, tablet">Print</th>

                            <th data-hide="phone, tablet">Action</th>

                         </tr>
                        </thead>
                        <tbody>
                     <?php
                     $status_color=array("Pending"=>'info',"Cancelled"=>'warning',"Delivered"=>'success');
                        include("class/class_orders.php");
                        $invoices=class_orders::select_all_authorized_from_inv_limit(10);
                     while($invoice=mysqli_fetch_array($invoices)){
                         $product=class_orders::get_invoice_all_products($invoice['rox_inv_auto_id']);
                         $payments=class_orders::get_invoice_payments($invoice['rox_inv_auto_id']);
                         if($payments['rox_pay_status']==0){
                           $rox_pay_status='Paid';
                             $span_class="success";
                             $due_text=" ";
                         }else{
                             $rox_pay_status=$payments['rox_pay_status'];
                             $span_class="warning";
                             $due_text="Due";
                         }
                         ?>
                        <tr>
                            <td><?= $invoice['rox_inv_auto_id']; ?></td>
                            <td><?= $product['rox_prd']?></td>
                            <td><?= $invoice['rox_del_date']; ?></td>
                            <td><?= $invoice['rox_inv_balance']; ?></td>
                            <td><span class="label label-table label-<?= $status_color[$invoice['rox_inv_status']]; ?>"><?php echo $invoice['rox_inv_status'];?></span> </td>
                            <td><span class="label label-table label-<?= $span_class ?>"><?php echo $rox_pay_status." ".$due_text;?></span></td>
                            <td> <a onclick="window.open('invoice-A5?inv_code=<?php echo $invoice['rox_inv_auto_id'];  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=550,height=660',); return false;"  class="wm-default-btn"><span>Print-A5</span></a></td>
                            <td> <a href="#" onclick="open_modal('<?= $invoice['rox_inv_auto_id']; ?>')"  id="authorized_link_<?php echo $invoice['rox_inv_auto_id'];?>" >Bill Authorize</a></td>
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

<div class="modal fade" id="authorizedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>



            <div class="form-group">
                <input type="text" name="invid" id="invid" value="" hidden>
                <img src="assets/site/images/Remove.png" style="margin-left: 202px;"/>
                <h3 style="margin-left: 200px;">Are you sure?</h3>
                <p style="margin-left: 169px;">You Want to Authorized The Order</p>


            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="bill_authorized()"  class="btn btn-danger " data-dismiss="modal"  name="" id="">Confirm</button>
            </div>

        </div>
    </div>
</div>


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


//    function cancel_form_submit(form) {
//        alert(form);
//        form.PreventDefault();
//
//    }

</script>

<!-- Parsly js -->
<script type="text/javascript" src="assets/site/plugins/parsleyjs/parsley.min.js"></script>

<script type="text/javascript">
    setTimeout(function(){
        $.ajax({
            url: '/manage_orders_ajax',
            type: 'post',
            success:function(response){
                $("#load_order").html(response);

            }
        });
    }, 2000);
    $(document).ready(function() {


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


    function cancel_form_submit(id) {
       var cancel_reason=$("#cancel_reason"+id).val();
        if(cancel_reason==''){
            alert("Cancel Reason is Required ");
        }else{
            $("#cancel_form"+id).submit();
        }

    }

    function bill_authorized() {
        var inv_id=$("#invid").val();
        $.ajax({
            url: 'functions/function_orders.php',
            type: 'post',
            data: {
                inv_id :inv_id,bill_authorized:1
            },
            dataType: 'json',
            success:function(response){
                window.open('bill-authorized','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',);
                $("#authorized_"+inv_id).html("<i style='font-size: 18px; font-weight: 900;' class='md md-done'></i>");
                $("#authorized_link_"+inv_id).hide();
                $("#authorized_"+inv_id).removeClass("label-info");
                $("#authorized_"+inv_id).addClass("label-success");
            }
        });

        return true;
    }

    setInterval(function(){

        $.ajax({
            url: '/manage_orders_ajax',
            type: 'post',
            success:function(response){
                $("#load_order").html(response);

            }
        });
    }, 8000);


    function open_modal(inv_id) {
        $("#invid").val(inv_id);
        $("#authorizedModal").modal('show');
    }
</script>



</body>
</html>