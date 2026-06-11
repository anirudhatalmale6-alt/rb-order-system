<?php
include('library/session_info.php');
include 'class/class.report.php';
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

                                                                            <select name="customer" class="form-control">
                                          <?php
                                                       $customerResult= Report::getAllInvoiceCustomers();
                                                       while($customer_row=  mysqli_fetch_assoc($customerResult))
                                                       {
                                           ?>    
                                            <option value="<?php echo $customer_row['cus_id'] ?>" <?php if(isset($_REQUEST['customer'])){  if($customer_row['cus_id']==$_REQUEST['customer']){ ?> selected="selected " <?php }  } ?> > <?php echo $customer_row['cus_fname'];  ?> </option>
                                            <?php               
                                                       }
                                                       
                                          ?>
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

				 <div class="row" id="ticketPrintArea">
                
                    <div class="col-sm-12">
                        <div class="card-box"> 
<?php if(isset($_REQUEST['customer'])) { ?>
     <div class="row">
      <div class="col-md-12">
      <?php
		 $cus_id=$_REQUEST['customer'];
 		 $detailResult=Report::getCus($cus_id);
		 $details_row=mysqli_fetch_assoc($detailResult);
		 echo "<strong>Name: </strong>". $details_row['cus_title']." ".$details_row['cus_fname'];
		 echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
		 echo "<strong>Contact Number: </strong>". $details_row['cus_land'];
		 echo " <hr/> ";
	  ?> 	
       </div>
      </div>
<?php } ?>                        
                            <?php
                                if(isset($_REQUEST['customer']))
                                {
									
                                    $customer_id=$_REQUEST['customer'];
									
                                   $start_date=$_REQUEST['date'];
                                   $end_date=$_REQUEST['date1'];
                            ?>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Mobile</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Total Paid</th>
                                    <th>Status</th>
                                    <th>Balance</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                  $invoiceReport= Report::getCustomerInvoices($customer_id, $start_date, $end_date);  
                                  while($invoice_row=  mysqli_fetch_assoc($invoiceReport))
                                  {
                                      $invoice_code=$invoice_row['rox_inv_auto_id'];
                                      $total_invoice=  Report::getInvoiceTotal($invoice_code);
                                      $total_paid=  Report::getInvoicePaid($invoice_code);
                                      if($total_paid=="")
                                      {
                                          $total_paid=0.0;
                                      }
                                      $total_paid=  number_format($total_paid,2);
                                    ?>
                                 <tr>
                                    <td><?php echo $invoice_row['rox_inv_auto_id']; ?></td>
                                    <td>Mobile</td>
                                    <td>Customer Name</td>
                                    <td><?php echo $invoice_row['rox_inv_date']; ?></td>
                                    <td align="right">Rs <?php echo $total_invoice; ?></td>
                                    <td align="right">Rs <?php echo $total_paid; ?></td>
                                    <td><?php echo $invoice_row['rox_inv_status']; ?></td>
                                    <td align="right">Rs <?php  echo $invoice_row['rox_inv_balance']; ?></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                                  }
                                ?>
                                </tbody>
                            </table>
                            <?php
                            
                                }
                            ?>
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