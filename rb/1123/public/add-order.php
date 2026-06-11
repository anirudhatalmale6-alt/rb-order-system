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
            if ($status == '4') {
                echo '<div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                                Error ! <b>Select the Delivery Date and Time</b>
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

        <div class="card-box">
            <!---->
            <div class="card-box" id="firstcontent">
                <div class="row">
                    <h4 class="m-t-0 header-title"><b>Fill order information</b></h4>
                    <!--	<form data-parsley-validate novalidate>-->
                    <div class="col-md-3" id="divv">
                        <div class="form-group">
                            <label for="ord_p_m_typ">Main-Product-Type*</label>
                            <select name="ord_p_m_typ" id="ord_p_m_typ" class="form-control item_add" data-live-search="true" required data-style="btn-white">
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
                            <select name="ord_p_s_typ" id="ord_p_s_typ" class="form-control item_add" data-live-search="true" data-style="btn-white">
                                <option value="0">Select S-Product Type</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="prd_typ">
                        <div class="form-group">
                            <label for="ord_prd_typ">Product</label>
                            <select name="ord_prd_typ" id="ord_prd_typ" class="form-control item_add"  required="" data-style="btn-white">
                                <option value="0">Select Product Type</option>
                            </select>
                        </div>
                    </div>
                    <!--<div class="col-md-3" id="prd">
                        <div class="form-group">
                            <label for="ord_prd">Product</label>
                            <input name="ord_prd" id="ord_prd"  required="" class="form-control" placeholder="Product Name"/>
                        </div>
                    </div>-->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="odr_price" class="control-label">Price</label>
                            <input type="text" class="form-control item_add" name="odr_price" id="odr_price" >
                            <input type="hidden" class="form-control" name="odr_name" id="odr_name" >
                            <input type="hidden" class="form-control" name="odr_id_p" id="odr_id_p" >
                        </div>
                    </div>
                    <input type="hidden" name="discount_prod" id="discount_prod">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="odr_qty" class="control-label">Qty</label>
                            <input type="text" class="form-control item_add" name="odr_qty" id="odr_qty"  required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="odr_gre_des" class="control-label">Description</label>
                            <input type="text" class="form-control item_add" name="odr_gre_des" id="odr_gre_des" >
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="odr_gre">Greetings *</label>
                            <select name="odr_gre_info"  class="form-control item_add" data-live-search="true"  id="odr_gre_info" data-style="btn-white">
                                <option value="">None</option>
                                <?php
                                for ($x = 1; $x <= 100; $x++) {
                                    $ss=substr("$x", -1);
                                    if($ss == 2){$last='nd';}
                                    else if($ss == 1){$last='st';}
                                    else if($ss == 3){$last='rd';}
                                    else{$last = 'th';}
									if(($x=="11")||($x=="12")||($x=="13"))
									{
										$last="th";
									}
									
                                    echo '<option value="'.$x.$last.'">'.$x.$last.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="odr_gre">Greetings *</label>
                            <select name="odr_gre"  class="form-control item_add" data-live-search="true"  id="odr_gre" data-style="btn-white">
                                <option value="">None</option>
                                <option value="Happy Birthday">Happy Birthday</option>
                                <option value="Happy Anniversary">Happy Anniversary </option>
                                <option value="Happy Holy Communion">Happy Holy Communion</option>
                                <option value="Congratulations">Congratulations </option>
                                <option value="Happy Valentines Day">Happy Valentine's Day </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="odr_gre_info2">Greetings info2</label>
                            <input type="text" name="odr_gre_info2" id="odr_gre_info2" class="form-control item_add">
                        </div>
                    </div>

                    <!--                                <div class="col-md-2">-->
                    <!--                                    <div class="form-group">-->
                    <!--                                        <label for="ord_desc" class="control-label">Description</label>-->
                    <!--                                        <input type="hidden" name="ord_desc" class="form-control" id="ord_desc" placeholder="Description">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <input type="hidden" name="ord_desc" class="form-control" id="ord_desc">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="ord_status">Status*</label>
                            <select name="ord_status" class="form-control item_add" data-live-search="true" required id="ord_status" data-style="btn-white">
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group text-center m-b-0">
                        <input type="hidden" id="odr_code">
                        <button class="btn btn-primary waves-effect waves-light" id="add_to_">Add Product</button>
                    </div>
                </div>
                </div>
                <!--</form>-->
            </div>


            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="ord_add" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                            <thead>
                            <tr>
                                <!--<th data-toggle="true">Odr ID</th>
                                <th>Name</th>-->
                                <th>Product Name</th>
                                <th>Description</th>
                                <th data-hide="phone">Qty</th>
                                <th data-hide="phone, tablet">Unit Price</th>
                                <th data-hide="phone, tablet">Total</th>
                                <th data-hide="phone, tablet">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="tot_td">Total :</td>
                                <td id="tot"></td>

                                <td></td>
                            </tr>
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

            <div class="card-box">
                <form method="POST" action="functions/function_orders.php" data-parsley-validate novalidate>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="m-t-0 header-title"><b>Fill customer information to create order</b></h4>

                            <select  id="mobile_select" class="selectpicker" data-live-search="true"  data-style="btn-white">
                                <option value="">New Customer</option>
                                <?php
                                //include('class/class_orders.php');
                                $prdct=class_orders::select_all_cus();
                                while($data=mysqli_fetch_array($prdct)){
                                    ?>
                                    <option value="<?php echo $data['cus_id'];?>"><?php echo $data['cus_mobile']. '-'.$data['cus_fname'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <br>
                            <br>
                            <div class="form-group col-lg-3">
                                <label for="lname">Title</label>
                                <select id="lname" name="lname" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="M/S">M/S</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Rev">Rev</option>
                                </select>
                                <input type="hidden" id="id" name="cusid">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="fname">First Name*</label>
                                <input type="text" name="fname" parsley-trigger="change"  required  class="form-control" id="fname">
                            </div>
                            <!--									<div class="form-group col-lg-2">-->
                            <!--										<label for="emailAddress">Email Address</label>-->
                            <!--										<input type="email" name="email" parsley-trigger="change"   placeholder="Enter Email Address" class="form-control" id="emailAddress">-->
                            <!--									</div>-->
                            <!--									<div class="form-group col-lg-4">-->
                            <!--										<label for="address">Residential Address</label>-->
                            <!--										<input type="text" name="address" parsley-trigger="change"  placeholder="Enter Residential Address" class="form-control" id="address">-->
                            <!--									</div>-->

                            <input type="hidden" name="email" value="" id="emailAddress">
                            <input type="hidden" name="address" value="" id="address">

                            <div class="form-group col-lg-2">
                                <label for="mobile">Mobile*</label>
                                <input type="text" name="mobile" parsley-trigger="change" required  class="form-control" id="mobile">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="tele">Telephone</label>
                                <input type="text" name="tele" parsley-trigger="change"   class="form-control" id="tele">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="ord_by">Ordered By</label>
                                <input type="text" class="form-control"  parsley-trigger="change"  value="<?php echo $user_check; ?>"  readonly>
                                <input type="hidden" name="ord_by"  value="<?php echo $roxwall_u_id; ?>"  readonly class="form-control" id="ord_by">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="d_delivery" class="control-label">Date of Delivery</label>
                                    <div>
                                        <input type="date" class="form-control" required name="d_delivery"  id="d_delivery" min="<?php echo date("Y-m-d"); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="d_address">Time</label>
                                <input type="time" name="time" parsley-trigger="change" required   class="form-control" id="time">
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="d_address">Delivery Address</label>
                                <input type="text" name="address" parsley-trigger="change"   class="form-control" id="d_address">
                            </div>

                    </div>
                </div>


            </div>

            <div class="card-box">
            <div class="row">
                    <div class="col-lg-12">
                        <h4 class="m-t-0 header-title"><b>Fill Payment information</b></h4>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="odr_pay_type">Payment Type*</label>
                                <select  class="form-control" name="pay_type_odr" >
                                    <option value="Cash">Cash</option>
                                    <option value="Credit">Credit</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="odr_dis" class="control-label">Discount (%)</label>
                                <input type="text" onkeyup="calculate_total()" id="odr_dis" class="form-control" name="odr_dis" >
                                <input type="hidden" class="form-control" name="tot" id="total" hidden>
                            </div>
                        </div>

                        <!--                                    <div class="col-md-2">-->
                        <!--										<div class="form-group">-->
                        <!--											<label for="odr_dis" class="control-label">Order Date</label>-->
                        <!--                                            <input  name="odr_date" class="form-control"  id=To_Date value="20--><?php //echo date("y-m-d");?><!--"/ "/>-->
                        <!--										</div>-->
                        <!--									</div>-->

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="d_delivery" class="control-label">Manufacture Date</label>
                                <div>
                                    <input type="date" class="form-control" id="To_Date" name="odr_date" min="<?php echo date("Y-m-d"); ?>" />
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="odr_adv" class="control-label">Advance <span style=" font-weight: normal;color: #f00" id="spa"></span></label>
                                <input type="text" class=" form-control" onkeyup="calculate_total()" id="odr_adv" name="odr_adv" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="odr_sr_chrge" class="control-label">Service Charge(%)</label>
                                <input type="text" class="form-control" onkeyup="calculate_total()" id="odr_sr_chrge"  name="odr_sr_chrge" >
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="odr_del_chrge" class="control-label">Delivery Charge </label>
                                <input type="text" onkeyup="calculate_total()" id="odr_del_chrge" class="form-control"  name="odr_del_chrge" >
                            </div>
                        </div>


                    </div>
                    <input type="hidden" name="inv_id" value="<?php echo $inv_id;?>">
                    <div class="row">
                        <div class="form-group text-center m-b-0">
                            <input type="hidden" id="odr_code">
                            <button class="btn btn-primary waves-effect waves-light"  name="print_order">Submit</button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">Reset</button>
                        </div>
                    </div>
                </div>

        </div>
            <!-- end Modal -->
            </form>
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


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- jQuery  -->
<!--<script src="assets/site/js/jquery.min.js"></script>-->
<script src="assets/site/js/bootstrap.min.js"></script>

<script>
    $( function() {

        $( "#fname" ).autocomplete({
            source: "functions/function_orders.php?get_costomer=1",
            minLength: 2,
            select: function( event, ui ) {
                console.log( "Selected: " + ui.item.value + " aka " + ui.item.cus_id );
                var c_id = ui.item.cus_id;
                $.ajax({
                    url: 'functions/function_orders.php',
                    type: 'post',
                    data: {
                        cus_id :c_id,
                    },
                    dataType: 'json',
                    success:function(response){
                        //$("#odr_price").val(response);
                        var len = response.length;
                        var r = 1;

                        for( var i = 0; i<len; i++){

                            var cus_mobile = response[i]['cus_mobile'];
                            var cus_fname = response[i]['cus_fname'];
                            var cus_title = response[i]['cus_title'];
                            var cus_land = response[i]['cus_land'];
                            var cus_address =response[i]['cus_address'];
                            var cus_email =response[i]['cus_email'];

                            $("#mobile").val(cus_mobile);
                            $("#id").val(c_id);
                            $("#fname").val(cus_fname);
                            $("#lname").val(cus_title);
                            $("#tele").val(cus_land);
                            $("#d_address").val(cus_address);
                            $("#emailAddress").val(cus_email);
                            $('#mobile_select').val(c_id);
                            $('#mobile_select').selectpicker('refresh')
                        }
                    }
                });
            }
        });
    } );
</script>
<!-- jQuery  -->
<!-- <script src="assets/site/js/jquery.min.js"></script>
<script src="assets/site/js/bootstrap.min.js"></script> -->



<script src="assets/site/js/detect.js"></script>
<script src="assets/site/js/fastclick.js"></script>
<script src="assets/site/js/jquery.slimscroll.js"></script>
<script src="assets/site/js/jquery.blockUI.js"></script>
<script src="assets/site/js/waves.js"></script>
<script src="assets/site/js/wow.min.js"></script>
<script src="assets/site/js/jquery.nicescroll.js"></script>
<script src="assets/site/js/jquery.scrollTo.min.js"></script>

<!--		<script src="assets/site/plugins/timepicker/bootstrap-timepicker.js"></script>-->
<!--		<script src="assets/site/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>-->
<script src="assets/site/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/site/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<!--		<script src="assets/site/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<script src="assets/site/js/moment.js"></script>
<script src="assets/site/js/bootstrap-datetimepicker.min.js"></script>


<!-- Parsly js -->
<script type="text/javascript" src="assets/site/plugins/parsleyjs/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
<script>
    // $('#datetimepicker').datepicker().on('dp.show', function () {
    //     return $(this).data('DateTimePicker').minDate(new Date());
    // });


    // $('#datetimepicker1').datepicker().on('dp.show', function () {
    //     return $(this).data('DateTimePicker').minDate(new Date("y-m-d"));
    // });

    // $("#datetimepicker").change(function(){
        
    //     var selected = $(this).val();
    //     alert(selected);
        
    // });


</script>

<!-- <script src="assets/site/plugins/jquery-ui/jquery-ui.min.js"></script> -->
<script src="assets/site/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="assets/site/plugins/switchery/js/switchery.min.js"></script>
<script type="text/javascript" src="assets/site/plugins/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/site/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>


<script src="assets/site/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="assets/site/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="assets/site/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/site/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="assets/site/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="assets/site/pages/jquery.form-advanced.init.js"></script>
<script type="text/javascript" src="assets/site/pages/jquery.form-pickers.init.orders.js"></script>
<script>
    $(document).ready(function() {

    });
</script>
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

    $('#d_delivery').on('change',function(){
        var d_delivery = $('#d_delivery').val();
        $('#To_Date').val(d_delivery);

    });

    $("#mobile_select").on('change',function(){
        //var frm_call = 'load_price';
        //alert("done");
        //alert (frm_call);
        $("#fname").empty();
        var c_id = $(this).val();
        $.ajax({
            url: 'functions/function_orders.php',
            type: 'post',
            data: {
                cus_id :c_id,
            },
            dataType: 'json',
            success:function(response){
                //$("#odr_price").val(response);
                var len = response.length;
                var r = 1;

                for( var i = 0; i<len; i++){

                    var cus_mobile = response[i]['cus_mobile'];
                    var cus_fname = response[i]['cus_fname'];
                    var cus_title = response[i]['cus_title'];
                    var cus_land = response[i]['cus_land'];
                    var cus_address =response[i]['cus_address'];
                    var cus_email =response[i]['cus_email'];

                    $("#mobile").val(cus_mobile);
                    $("#id").val(c_id);
                    $("#fname").val(cus_fname);
                    $("#lname").val(cus_title);
                    $("#tele").val(cus_land);
                    $("#d_address").val(cus_address);
                    $("#emailAddress").val(cus_email);
                }
            }
        });
    });

    $("#ord_p_m_typ").on("change", function(){
        var x = $(this).val();

        showSubCategory(x);

    });

    $("#ord_p_s_typ").on("change", function(){
        var x = $(this).val();

        showProduct(x);

    });

    function showSubCategory(selected_val) {

        frm_call = 'load_subcat';
        var main_cateid = $.trim(selected_val);
        $.ajax({
            url: 'class/class_select_sub_cate.php',
            type: 'post',
            data: {
                main_cate_id :main_cateid,
                paracall : frm_call,
            },
            dataType: 'json',
            success:function(response){

                var datalen = response.length;
                $('#ord_p_s_typ').empty();
                $("#ord_p_s_typ").append("<option selected disabled>Select</option>");
                $('#ord_prd_typ').empty();
                $("#ord_prd_typ").append("<option selected disabled>Select</option>");

                if($.trim(datalen) == 0){
                    $('#ord_prd_typ').empty();
                    $('#ord_p_s_typ').empty();
                    $("#ord_p_s_typ").append("<option>No Data Available</option>");
                    $("#ord_prd_typ").append("<option>No Data Available</option>");
                }else{
                    //$("#subCat").append(" <option value=\"New Sub Category\"  > New Sub Category</option>");
                    for (var i = 0; i < datalen; i++) {
                        var sub_id = response[i]['sub_id'];
                        var sub_name = response[i]['sub_name'];

                        $("#ord_p_s_typ").append("<option value='"+sub_id+"'>" + sub_name + "</option>");



                    }
                }

            }




        });
    }



    function showProduct(selected_val) {

        frm_call = 'load_product';
        var sub_cateid = $.trim(selected_val);
        $.ajax({
            url: 'class/class_select_sub_cate.php',
            type: 'post',
            data: {
                product :sub_cateid,
                paracall : frm_call,
            },
            dataType: 'json',
            success:function(response){

                var datalen = response.length;
                $('#ord_prd_typ').empty();
                $("#ord_prd_typ").append("<option selected disabled>Select</option>");
                if($.trim(datalen) == 0){
                    $('#ord_prd_typ').empty();
                    $("#ord_prd_typ").append("<option>No Data Available</option>");
                }else{
                    //$("#subCat").append(" <option value=\"New Sub Category\"  > New Sub Category</option>");
                    for (var i = 0; i < datalen; i++) {
                        var auto_id = response[i]['auto_id'];
                        var prd_name = response[i]['prd_name'];

                        $("#ord_prd_typ").append("<option value='"+auto_id+"'>" + prd_name + "</option>");



                    }
                }

            }




        });
    }



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
                    dis_status=response[i]['dis_status']
                    //alert(prd_id_d);
                }
                $("#odr_price").val(prd_price);
                $("#odr_name").val(prd_name_);
                $("#odr_id_p").val(prd_status);
                $("#discount_prod").val(dis_status);
            }
        });
    });


     $(document).on('click','#add_to_', function()
    {

        var frm_call ='add_to';
        var txtinid ="<?php echo $inv_id; ?>";
        var txtord_p_m_typ =$("#ord_p_m_typ").val();
        var txtord_p_s_typ =$("#ord_p_s_typ").val();
        var txtord_prd_typ = $("#ord_prd_typ").text();
        var txtord_prd_typ_val = $("#ord_prd_typ").val();
        var valodr_name = $("#odr_name").val();
        var txtodr_price =$("#odr_price").val();
        var txtodr_qty =$("#odr_qty").val();
        var dis_status=$("#discount_prod").val();
        var txtodr_gre_des =$("#odr_gre_des").val();
        var txtodr_gre =$("#odr_gre").val();
        var txtodr_gre_info =$("#odr_gre_info").val();
        var txtodr_gre_info2 = $("#odr_gre_info2").val();
        var txtord_desc =$("#ord_desc").val();
        var odr_id_p =$("#odr_id_p").val();

//alert(valodr_name);
        var txtord_status =$("#ord_status").val();
        $("#ord_add tbody").empty();
        if(txtord_prd_typ_val!='' && txtord_prd_typ_val!=0 && txtord_prd_typ_val!=null){
            if(txtodr_qty!='' && txtodr_qty!=0) {
                $.ajax({
                    url: 'functions/function_orders.php',
                    type: 'post',
                    data: {
                        ord_inid: txtinid,
                        ord_p_m_typ: txtord_p_m_typ,
                        ord_p_s_typ: txtord_p_s_typ,
                        ord_prd_typ: txtord_prd_typ,
                        ordvalodr_name: valodr_name,

                        odr_price: txtodr_price,
                        odr_qty: txtodr_qty,
                        odr_gre_des: txtodr_gre_des,
                        odr_gre: txtodr_gre,
                        dis_status:dis_status,

                        odr_gre_info: txtodr_gre_info,
                        odr_gre_info2: txtodr_gre_info2,
                        ord_status: txtord_status,
                        ord_desc: txtord_desc,
                        odr_id_p: odr_id_p,

                        paracall: frm_call,
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
//                            $('#ord_p_s_typ').selectpicker('refresh');
//                            $('#ord_p_m_typ').selectpicker('refresh');
                        var len = response.length;
                        if(len!=null)
                        {

                            document.getElementById("odr_qty").value="";
                            document.getElementById("odr_price").value="";
                            document.getElementById("odr_gre_info2").value="";
                            document.getElementById("odr_gre_des").value="";
                            $('#ord_p_m_typ').get(0).selectedIndex = 0;
                            $('#ord_p_s_typ').empty();
                            $("#ord_p_s_typ").append("<option>Select S-product Type</option>");
                            $('#ord_prd_typ').empty();
                            $("#ord_prd_typ").append("<option>Select Product Type</option>");
                            $('#odr_gre_info').get(0).selectedIndex = 0;
                            $('#odr_gre').get(0).selectedIndex = 0;
                            $('#ord_status').get(0).selectedIndex = 0;







                        }

                        var total = 0;
                        for (var i = 0; i < len; i++) {
                            var ord_id = response[i]['ord_id'];
                            var prd = response[i]['prd'];
                            var des = response[i]['des'];
                            var rox_gre = response[i]['rox_gre'];
                            var rox_gre1 = response[i]['rox_gre1'];
                            var rox_gre2 = response[i]['rox_gre2'];
                            var prd_qty = response[i]['prd_qty'];
                            var prd_price = response[i]['prd_price'];
                            var dis_status = response[i]['dis_status'];

                            var sum = parseFloat(prd_price * prd_qty);
                            $("#ord_add tbody").append('<tr>' +
                                '<td><input type="hidden" class="dis_status" value="'+dis_status+'"><input type="hidden"  class="pro_total" value="'+sum+'">' + prd + '</td>' +
                                '<td>' + remove_dash(des,rox_gre,rox_gre1,rox_gre2) + '</td>' +
                                '<td>' + prd_qty + '</td>' +
                                '<td>' + prd_price + '</td>' +
                                '<td>' + sum +'.00' +'</td>' +
                                '<td><a href="#" id="' + ord_id + '" onclick="deleteord(this.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a></td>' +
                                '</tr>');
                            total += sum;

                        }

                        $("#tot").text(total+ '.00');

                        $("#total").val(total);
                        $("#spa").text('Total:'+total+ '.00');
                        calculate_total();

                    }
                });
            }
            else
            {
                alert('Enter Quantity');
            }
        }else{
            alert('Select Product');
        }


    });


    function deleteord(id){
        //var or_id =  id;
        alert('Deleted');

        var frm_call ='delete_from';
        var txtinid ="<?php echo $inv_id; ?>";
        var ordid= id;
        $("#ord_add tbody").empty();
        $.ajax({
            url: 'functions/function_orders.php',
            type: 'post',
            data: {
                ord_inid :txtinid,
                ord_id :ordid,
                paracall : frm_call,
            },
            dataType: 'json',
            success:function(response){
                var len = response.length;
                var total = 0;
                for( var i = 0; i<len; i++){
                    var ord_id = response[i]['ord_id'];
                    var prd = response[i]['prd'];
                    var des = response[i]['des'];
                    var rox_gre = response[i]['rox_gree'];
                    var rox_gre1 = response[i]['rox_gree1'];
                    var rox_gre2 = response[i]['rox_gree2'];
                    var prd_qty = response[i]['prd_qty'];
                    var prd_price = response[i]['prd_price'];
                    var dis_status = response[i]['dis_status'];

                    var sum = parseFloat(prd_price * prd_qty);
                    $("#ord_add tbody").append('<tr>'+
                        '<td><input type="hidden" class="dis_status" value="'+dis_status+'"><input type="hidden"  class="pro_total" value="'+sum+'">' + prd + '</td>' +
                        '<td>' + remove_dash(des,rox_gre,rox_gre1,rox_gre2) + '</td>' +
                        '<td>'+prd_qty+'</td>'+
                        '<td>'+prd_price+'</td>'+
                        '<td>'+sum+'.00'+'</td>'+
                        '<td><a href="#" id="'+ord_id+'" onclick="deleteord(this.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a></td>'+
                        '</tr>');
                    total += sum;
                }
                $("#tot").text(total+'.00');
                $("#total").val(total);
                $("#spa").text('Total:'+total+ '.00');
                calculate_total();

            }
        });
    }



    $('.item_add').keydown(function (e) {
        if (e.which === 13) {

                $('#add_to_').click();

        }
    });

    function remove_dash(des,rox_gre,rox_gre1,rox_gre2) {
        var rox_gre_dash=' ';
        var rox_gre1_dash=' ';
        var rox_gre2_dash=' ';
        if (rox_gre){
            rox_gre_dash=" | ";
        }
        if (rox_gre1){
            rox_gre1_dash=" | ";
        }
        if (rox_gre2){
            rox_gre2_dash=" | ";
        }

        var discription=des+rox_gre_dash+rox_gre+rox_gre1_dash+rox_gre1+rox_gre2_dash+rox_gre2
        if(discription.charAt(1)=="|"  ){
           discription=discription.substring(2);
        }else if(discription.charAt(2)=="|" ){
           discription=discription.substring(3);
        }else if(discription.charAt(3)=="|" ){
           discription=discription.substring(4);
        }
       return discription;
    }


    function calculate_total() {
        var grand_total=0;
        var discount=0;
        var sr_chrge=0;
        var discount_item_total=get_discount_item_total();
        var total=parseFloat($("#total").val());
        var odr_dis=parseFloat($('#odr_dis').val());
        var odr_del_chrge=parseFloat($('#odr_del_chrge').val());
        var odr_sr_chrge=parseFloat($('#odr_sr_chrge').val());
        var odr_adv=parseFloat($('#odr_adv').val());



        if(odr_dis>0 && discount_item_total>0){
            discount=odr_dis*discount_item_total/100;
            grand_total=total-discount;
        }else{
            grand_total=total;
        }
        if(odr_sr_chrge>0){
            sr_chrge=odr_sr_chrge*grand_total/100;
            grand_total=grand_total+sr_chrge;
        }


        if(odr_del_chrge> 0){
            grand_total=grand_total+odr_del_chrge;
        }
        if(odr_adv> 0){
            grand_total=grand_total-odr_adv;
        }

        if($('#discount_row').length){
            $("#discount_span").closest('tr').remove();
        }
        if($('#odr_del_chrge_row').length){
            $("#odr_del_chrge_span").closest('tr').remove();
        }
        if($('#odr_sr_chrge_row').length){
            $("#odr_sr_chrge_span").closest('tr').remove();
        }
        if($('#total_row').length){
            $("#total_span").closest('tr').remove();
        }
        if($('#odr_adv_row').length){
            $("#odr_adv_span").closest('tr').remove();
        }

        if(odr_dis>0 && discount_item_total>0){
            var newRow = $('<tr id="discount_row">');
            var cols = "";
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td><span id="discount_span">Discount :</span>('+odr_dis+'%)</td>';
            cols += '<td>'+discount.toFixed(2)+' (-)</td>';
            cols += '<td></td>';
            newRow.append(cols);
            $("#tot").closest('tr').before(newRow);
        }


        if(odr_sr_chrge>0){
            var newRow = $('<tr id="odr_sr_chrge_row">');
            var cols = "";
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td><span id="odr_sr_chrge_span">Service Charge :</span>('+odr_sr_chrge+'%)</td>';
            cols += '<td>'+sr_chrge.toFixed(2)+'</td>';
            cols += '<td></td>';
            newRow.append(cols);
            $("#tot").closest('tr').before(newRow);
        }

        if(odr_del_chrge>0){
            var newRow = $('<tr id="odr_del_chrge_row">');
            var cols = "";
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td><span id="odr_del_chrge_span">Delivery Charge :</span></td>';
            cols += '<td>'+odr_del_chrge+'.00'+'</td>';
            cols += '<td></td>';
            newRow.append(cols);
            $("#tot").closest('tr').before(newRow);
        }
        if(odr_adv>0){
            var newRow = $('<tr id="odr_adv_row">');
            var cols = "";
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td><span id="odr_adv_span">Advance :</span></td>';
            cols += '<td>'+odr_adv.toFixed(2)+' (-)</td>';
            cols += '<td></td>';
            newRow.append(cols);
            $("#tot").closest('tr').before(newRow);
        }

        if(total!=grand_total){
            var newRow = $('<tr id="total_row">');
            var cols = "";
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td></td>';
            cols += '<td><span id="total_span">Total :</span></td>';
            cols += '<td>'+total.toFixed(2)+'</td>';
            cols += '<td></td>';
            newRow.append(cols);
            $("#ord_add > tfoot > tr:first").before(newRow);
            $("#tot_td").text("Grand Total");
        }else{
            $("#tot_td").text("Total");
        }

        $("#tot").text(grand_total.toFixed(2));
        $("#spa").text('Total:'+grand_total.toFixed(2));

    }

    function get_discount_item_total() {
        var total=0
        $('.pro_total').each(function(i, obj) {
            var val=parseFloat($(this).val());
            if($(this).val()==''){
                val=0;

            }
            if($(this).closest('tr').find('.dis_status').val()=='1'){
                total+=val;
            }
        });
        if(total==0){
            $('#odr_dis').prop('readonly', true);
            $("#odr_dis").val(' ');
        }else{
            $('#odr_dis').prop('readonly', false);
        }
        console.log("get_discount_item_total :"+total)
        return  total;

    }

</script>



</body>
</html>