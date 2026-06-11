<?php
include('library/session_info.php');
include 'class/class.report.php';
$pagetitle = ' - Overall Reports';

$customerResult=  Report::getAllInvoiceCustomers();

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
                <div class="row">
                    <div class="col-md-12">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <form action="" method="post">
                            
                                <div class="row">
                                    <div class="col-md-3">Customer</div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="customer_name">
                                            <option value="">---</option>
                                            <?php
                                              while($customer_row=  mysqli_fetch_assoc($customerResult))
                                              {
                                            ?>
                                            <option value="<?php echo $customer_row['cus_id'];  ?>"><?php echo $customer_row['cus_fname']." "; ?></option>
                                            <?php
                                              }
                                            ?>
                                        </select>
                                    </div>
                                </div>      
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>    
                                <div class="row">
                                    <?php
                                        $category_result=  Report::getCategory();
                                    ?>
                                    <div class="col-md-2">
                                        <label class="control-label"> Item Category</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" required name="cat_id" onchange="loadfile(this.value);">
                                            <option>---</option>
                                            <?php
                                            while($cat_row=  mysqli_fetch_assoc($category_result))
                                            {
                                           ?>  
                                            <option value="<?php echo $cat_row['rox_main_cate']; ?>" <?php if(isset($_REQUEST['cat_id'])){ if($cat_row['rox_main_cate']==$_REQUEST['cat_id']){  ?> selected="selected" <?php } }  ?> ><?php echo $cat_row['rox_main_cate']; ?></option>
                                          <?php      
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Item Sub Category</label>
                                    </div>
                                    <div class="col-md-2" id="fil_data">
                                        <?php
                                            if(isset($_REQUEST['cat_id']))
                                            {
                                                $cat_id=$_REQUEST['cat_id'];
                                               $sub_cat_result= Report::getSubCategoriesDirect($cat_id);
                                        ?>
                                        <select class="form-control" name="sub_cat">
                                           <?php
                                            while($sub_cat_row=  mysqli_fetch_assoc($sub_cat_result))
                                            {
                                                ?>
                                            <option value="<?php echo $sub_cat_row['rox_sub_cate'];  ?>" <?php if(isset($_REQUEST['sub_cat'])){ if($sub_cat_row['rox_sub_cate']==$_REQUEST['sub_cat']){ ?> selected="selected"  <?php  }  } ?> > <?php echo $sub_cat_row['rox_sub_cate'];  ?></option>
                                                <?php
                                            }

                                           ?>

                                        </select>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label">Item</label>
                                    </div>
                                    <div class="col-md-3" id="fil_data1">
                                       <?php
                                            if(isset($_REQUEST['item']))
                                            {
                                                $sub_cat_id=$_POST['sub_cat'];
                                            ?>    
                                        <select class="form-control"  name="item">
                                            <?php
                                              $itemResult= Report::getItemsDirect($sub_cat_id);
                                              while($item_row=  mysqli_fetch_assoc($itemResult))
                                              {
                                             ?>   
                                            <option value="<?php echo $item_row['rox_line_id']; ?>" <?php if($item_row['rox_line_id']==$_REQUEST['item']){ ?> selected="selected" <?php } ?> ><?php echo $item_row['rox_prd_name']; ?></option>
                                             <?php     
                                              }
                                            ?>
                                        </select>
                                           <?php     
                                            }
                                       ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Time Range</div>
                                    <div class="col-md-3"><input type="date" class="form-control"  name="start_date" required="required"/></div>
                                    <div class="col-md-1">To</div>
                                    <div class="col-md-3"><input type="date" class="form-control"  name="end_date" required="required"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Payment Method</div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="payment_method">
                                            <option value="">Select Payment Type</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Credit">Credit</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Staff">Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">&nbsp;</div>
                                </div> 
                                <div class="row">
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-default" name="search"><span class="glyphicon glyphicon-search"></span>&nbsp;Search</button>
                                        </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
				<div class="card-box">

                            <!--	<form data-parsley-validate novalidate>-->
                        <!--</form>-->
				 <div class="row" id="ticketPrintArea">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <?php
                            if(isset($_POST['search']))
                            {
                                if(($_POST['customer_name']!="")&&(!isset($_POST['item'])))
                                {
                                    $date1=$_POST['start_date'];
                                    $date2=$_POST['end_date'];
                                    $customer_id=$_POST['customer_name'];
                                    $cusdetailsResult=Report::getCus($customer_id);
                                    $cusdetails_row=  mysqli_fetch_assoc($cusdetailsResult);
                                    $cusReportResult=  Report::getCustomerInvoices($customer_id,$date1,$date2)
                            ?>
                            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Customer Name</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($inv_row=  mysqli_fetch_assoc($cusReportResult))
                                        {
                                            $invoice_id=$inv_row['rox_inv_id'];
                                            $avResult=Report::getInvoicePaymentType($inv_row['rox_inv_auto_id'],$_POST['payment_method']);
                                            $av_count=  mysqli_num_rows($avResult);
                                            if($av_count>0)
                                            {
                                                $invoice_total=  Report::getInvoiceItem($inv_row['rox_inv_auto_id']);
                                                while($item_row=mysqli_fetch_array($invoice_total))
                                                {
                                                
                                    ?>
                                    <tr>
                                        <td>
                                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $inv_row['rox_inv_auto_id'];  ?>&from_date=<?php echo $date1;  ?>&to_date=&user_id=&p_status=&d_status=&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span><?php echo $inv_row['rox_inv_id'];  ?></span></a>
                                            
                                                
                                            </td>
                                        <td><?php echo $cusdetails_row['cus_fname']; ?></td>
                                        <td><?php echo $item_row['rox_prd']?></td>
                                        <td><?php echo number_format($item_row['rox_prd_price'],2); ?></td>
                                        <td><?php echo $item_row['rox_prd_qty']; ?></td>
                                        <td><?php echo number_format($item_row['rox_prod_tot_price'],2); ?></td>
                                        
                                    </tr>
                                    <?php
                                            }
                                        }
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                                }
                                else if(($_POST['customer_name']=="")&&(!isset($_POST['item'])))
                                {
                                    $date1=$_POST['start_date'];
                                    $date2=$_POST['end_date'];
                                    
                                    
                                    
                                    $cusReportResult=  Report::getAllCustomerInvoices($date1,$date2);
                                    
                                ?>    
                                  <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Customer Name</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                       

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($inv_row=  mysqli_fetch_assoc($cusReportResult))
                                        {
                                            $customer_id=$inv_row['rox_inv_cus_id'];
                                            $cusdetailsResult=Report::getCus($customer_id);
                                            $cusdetails_row=  mysqli_fetch_assoc($cusdetailsResult);
                                            
                                            $invoice_id=$inv_row['rox_inv_auto_id'];
                                            $invoice_total=  Report::getInvoiceItem($invoice_id);
                                                while($item_row=mysqli_fetch_array($invoice_total))
                                                {
                                          
                                    ?>
                                    <tr>
                                        <td>
                                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $inv_row['rox_inv_auto_id'];  ?>&from_date=<?php echo $date1;  ?>&to_date=&user_id=&p_status=&d_status=&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span><?php echo $inv_row['rox_inv_id'];  ?></span></a>
                                        </td>
                                        <td><?php echo $cusdetails_row['cus_fname']; ?></td>
                                        <td><?php echo $item_row['rox_prd']?></td>
                                        <td><?php echo number_format($item_row['rox_prd_price'],2); ?></td>
                                        <td><?php echo $item_row['rox_prd_qty']; ?></td>
                                        <td><?php echo number_format($item_row['rox_prod_tot_price'],2); ?></td>
                                       
                                    </tr>
                                    <?php
                                        
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>  
                               <?php     
                                }
                                else if(($_POST['item']!="")&&($_POST['customer_name']==""))
                                {
                                    ?>
                                    <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Customer Name</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                      
                                       

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $item=$_POST['item'];
                                    $date1=$_POST['start_date'];
                                    $date2=$_POST['end_date'];
                                    $invoice_total=  Report::getInvoiceItem1($item,$date1,$date2);
                                                while($item_row=mysqli_fetch_array($invoice_total))
                                                {
                                                    $inv_id=$item_row['rox_inv_id'];
                                                    $customer=Report::getCustname($inv_id);
                                                    while($cust_row=mysqli_fetch_array($customer))
                                                    {


                                                    ?>
                                                    <tr>
                                        <td>
                                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $item_row['rox_inv_id'];  ?>&from_date=<?php echo $date1;  ?>&to_date=&user_id=&p_status=&d_status=&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span><?php echo $cust_row['rox_inv_id'];  ?></span></a>
                                        </td>
                                        <td><?php echo $cust_row['cus_fname']; ?></td>
                                        <td><?php echo $item_row['rox_prd']?></td>
                                        <td><?php echo number_format($item_row['rox_prd_price'],2); ?></td>
                                        <td><?php echo $item_row['rox_prd_qty']; ?></td>
                                        <td><?php echo number_format($item_row['rox_prod_tot_price'],2); ?></td>
                                       
                                    </tr>
                         
                             <?php    
                                                }   
                                            }
                                }
                                else if(($_POST['customer_name']!="")&&($_POST['item']!=""))
                                {
                                    $item=$_POST['item'];
                                    $date1=$_POST['start_date'];
                                    $date2=$_POST['end_date'];
                                    $customer_id=$_POST['customer_name'];
                                    $cusdetailsResult=Report::getCus($customer_id);
                                    $cusdetails_row=  mysqli_fetch_assoc($cusdetailsResult);
                                    $cusReportResult=  Report::getCustomerInvoices($customer_id,$date1,$date2)
                            ?>
                            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Customer Name</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($inv_row=  mysqli_fetch_assoc($cusReportResult))
                                        {
                                            $invoice_id=$inv_row['rox_inv_id'];
                                            
                                            
                                                $invoice_total=  Report::getInvoiceItem2($inv_row['rox_inv_auto_id'],$item);
                                                while($item_row=mysqli_fetch_array($invoice_total))
                                                {
                                                
                                    ?>
                                    <tr>
                                        <td>
                                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $inv_row['rox_inv_auto_id'];  ?>&from_date=<?php echo $date1;  ?>&to_date=&user_id=&p_status=&d_status=&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span><?php echo $inv_row['rox_inv_id'];  ?></span></a>
                                        </td>
                                        <td><?php echo $cusdetails_row['cus_fname']; ?></td>
                                        <td><?php echo $item_row['rox_prd']?></td>
                                        <td><?php echo number_format($item_row['rox_prd_price'],2); ?></td>
                                        <td><?php echo $item_row['rox_prd_qty']; ?></td>
                                        <td><?php echo number_format($item_row['rox_prod_tot_price'],2); ?></td>
                                        
                                    </tr>
                                    <?php
                                            
                                        }
                                        }
                                    }
                                }
                                    ?>
                                </tbody>
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
            </div>
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
            <script type="text/javascript">
    
    function loadfile(x)
    {
         var url="functions/function_ajax.php?get_sub_categories=true";
                    $.post(url,{cat_id:x},function(data){
            $("#fil_data").html(data).show();
        });
        
    }
    
     function loadfile2(x)
    {
         var url="functions/function_ajax.php?get_items=true";
                    $.post(url,{sub_cat_id:x},function(data){
            $("#fil_data1").html(data).show();
        });
        
    }
    
    </script>


    </body>
</html>