<?php
include('library/session_info.php');
$pagetitle = ' - Update Invoice';

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
                            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>

                        					
							
				<?php
					
					if(isset($_GET['id'])){
				?>
				<h4 class="page-title">Create Student Invoices</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
                            <li><a href="#">Students</a></li>
                            <li class="active">Create Students Invoices</li>
                        </ol>
                    </div>
                </div>
				
				<div class="card-box">
				<form method="POST" action="functions/function_admin_login.php" data-parsley-validate novalidate>
						<div class="row">	
					<div class="col-lg-6">
								<div class="card-box-rox">
								<h4 class="m-t-0 header-title"><b>Feed Customer Basic Information</b></h4>
									<p class="text-muted font-13 m-b-30">
										Your awesome text goes here.
									</p>
								
									
									<div class="form-group">
										<label for="userName">Invoice No*</label>
										<input type="text" name="in_id" parsley-trigger="change" value="<?php 
										include('class/class_autoid.php');
										echo "INV";
										echo $autoid = Autoid::get_invoice_id(); 
										?>" required placeholder="Invoice No" class="form-control" id="userName" readonly>
									</div>
									<div class="form-group">
										<label for="userName">Student Number*</label>
										<input type="text" name="user_id" parsley-trigger="change" value="<?php echo $_GET['id'];?>"required placeholder="Student Number" class="form-control" id="userName" readonly>
									</div>
									<div class="form-group ">
										<label for="userName"> Status*</label>
										<select name="status" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
											<option></option>
											<option value="Paid">Paid</option>
											<option value="Unpaid">Unpaid</option>
											<option value="Pending">Pending</option>
											<option value="Refund">Refund</option>
											<option value="Cancelled">Cancelled</option>
										</select>
									</div>										
									
								</div>
							</div>
							<div class="col-lg-6">
								<div class="card-box-rox">
									<h4 class="m-t-0 header-title"><b>Feed Customer Invoice Information</b></h4>
									<p class="text-muted font-13 m-b-30">
										Your awesome text goes here.
									</p>
									<div class="form-group">
										<label for="userName">Description*</label>
										<input type="text" name="in_des" parsley-trigger="change" required placeholder="Enter Invoice Description" class="form-control" id="userName">
									</div>
									<div class="form-group">
										<label for="userName">Amount*</label>
										<input type="text" name="in_amo" parsley-trigger="change"  required placeholder="Amount" class="form-control" id="userName">
									</div>
									
									<div class="form-group">
									<label class="control-label col-sm-4">Expired date*</label>

										<input type="text" name="in_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">											
									</div>									
								</div>
							</div>
						</div>
						<div class="row">				
							<div class="form-group text-center m-b-0">
								<button class="btn btn-primary waves-effect waves-light" name="update_user_invoice" type="submit">
									Submit
								</button>
								<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
									Cancel
								</button>
							</div>
						</div>
					</form>
				</div>
					<?php }
					else if(isset($_GET['invid']))
					{ 
				include('class/class_page.php');
				$inv_id= $_GET['invid'];
				 $select_invoice = Page::get_invoice_No($inv_id); 
				 	while ($row = mysqli_fetch_array($select_invoice)) {
				 ?>
				<h4 class="page-title">Update Student Invoices</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
                            <li><a href="#">Students</a></li>
                            <li class="active">Update Students Invoices</li>
                        </ol>
                    </div>
                </div>
				
				<div class="card-box">
				<form method="POST" action="functions/function_admin_login.php" data-parsley-validate novalidate>
						<div class="row">	
							<div class="col-lg-6">						
								<div class="card-box-rox">
								<h4 class="m-t-0 header-title"><b>Feed Customer Basic Information</b></h4>
									<p class="text-muted font-13 m-b-30">
										Your awesome text goes here.
									</p>
									<div class="form-group">
										<label for="userName">Invoice No*</label>
										<input type="text" name="in_id" parsley-trigger="change" value="<?php echo $_GET['invid'];?>" placeholder="Invoice No" class="form-control" id="userName" readonly>
									</div>
									<div class="form-group">
										<label for="userName">Student Number*</label>
										<input type="text" name="user_id" parsley-trigger="change" value="<?php 
										echo $row['rox_user_auto_id']; ?>" placeholder="Student Number" class="form-control" id="userName" readonly>
									</div>
									
									<div class="form-group ">
										<label for="userName"> Status*</label>
										<select name="status" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
											<option value="<?php echo $row['rox_in_status'];?>"><?php echo $row['rox_in_status'];?></option>
											<option value="Paid">Paid</option>
											<option value="Unpaid">Unpaid</option>
											<option value="Pending">Pending</option>
											<option value="Refund">Refund</option>
											<option value="Cancelled">Cancelled</option>
										</select>
									</div>										
									
								</div>
							</div>
							<div class="col-lg-6">
								<div class="card-box-rox">
									<h4 class="m-t-0 header-title"><b>Feed Customer Invoice Information</b></h4>
									<p class="text-muted font-13 m-b-30">
										Your awesome text goes here.
									</p>
									<div class="form-group">
										<label for="userName">Description*</label>
										<input type="text" value="<?php echo $row['rox_inv_des'];?>" name="in_des" parsley-trigger="change" required placeholder="Enter Invoice Description" class="form-control" id="userName">
									</div>
									<div class="form-group">
										<label for="userName">Amount*</label>
										<input type="number" value="<?php echo $row['rox_inv_tot'];?>" name="in_amo" parsley-trigger="change"  required placeholder="Amount" class="form-control" id="userName">
									</div>
									
									<div class="form-group">
									<label class="control-label col-sm-4">Expired date*</label>

										<input type="text" value="<?php echo $row['rox_inv_exp_date'];?>" name="in_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">											
									</div>									
								</div>
							</div>
						</div>
						<div class="row">				
							<div class="form-group text-center m-b-0">
								<button class="btn btn-primary waves-effect waves-light" name="update_invoice" type="submit">
									Update
								</button>
								<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
									Cancel
								</button>
							</div>
						</div>
					</form>
				</div>
					<?php } } ?>				
									
						
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

        <!-- Parsly js -->
        <script type="text/javascript" src="assets/site/plugins/parsleyjs/parsley.min.js"></script>


        <script type="text/javascript">
			$(document).ready(function() {
				$('form').parsley();
			});
		</script>
		


		
		 <!-- plugins js -->
        <script src="assets/site/plugins/moment/moment.js"></script>
     	<script src="assets/site/plugins/timepicker/bootstrap-timepicker.js"></script>
     	<script src="assets/site/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
     	<script src="assets/site/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
     	<script src="assets/site/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
     	<script src="assets/site/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>

        <!-- page js -->
        <script src="assets/site/pages/jquery.form-pickers.init.js"></script>
		
		
		
		<script src="assets/site/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="assets/site/plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="assets/site/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/site/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="assets/site/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="assets/site/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="assets/site/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="assets/site/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="assets/site/pages/autocomplete.js"></script>

        <script type="text/javascript" src="assets/site/pages/jquery.form-advanced.init.js"></script>
    </body>
</html>