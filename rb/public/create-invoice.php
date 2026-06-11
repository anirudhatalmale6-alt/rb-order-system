<?php
include('library/session_info.php');
$pagetitle = ' - Create Invoice';

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

                        <h4 class="page-title">Create Invoice</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
							<li><a href="#">Invoice</a></li> 
                            <li class="active">Create Invoice</li>
                        </ol>
                    </div>
                </div>
				
				<div class="card-box">
					<form method="POST" action="functions/function_manager_access.php" data-parsley-validate novalidate>
						<div class="row">						
							<div class="col-lg-12">
								<h4 class="m-t-0 header-title"><b>Fill customer information to create invoice</b></h4>
								<p class="text-muted font-13 m-b-30">
									Please enter customer information to proceed further.
								</p>
								<div class="form-group col-lg-4">
									<label for="fname">First Name*</label>
									<input type="text" name="fname" parsley-trigger="change" required placeholder="Enter First Name" class="form-control" id="fname">
								</div>
								<div class="form-group col-lg-4">
									<label for="lname">Last Name*</label>
									<input type="text" name="lname" parsley-trigger="change" required placeholder="Enter Last Name" class="form-control" id="lname">
								</div>
								<div class="form-group col-lg-4">
									<label for="emailAddress">Email Address*</label>
									<input type="email" name="email" parsley-trigger="change" required placeholder="Enter Email Address" class="form-control" id="emailAddress">
								</div>
								<div class="form-group col-lg-4">
									<label for="address">Residential Address*</label>
									<input type="text" name="address" parsley-trigger="change" required placeholder="Enter Residential Address" class="form-control" id="address">
								</div>
								<div class="form-group col-lg-4">
									<label for="tele">Telephone*</label>
									<input type="text" name="tele" parsley-trigger="change" required placeholder="Enter Telephone" class="form-control" id="tele">
								</div>
								<div class="form-group col-lg-4">
									<label for="mobile">Mobile*</label>
									<input type="text" name="mobile" parsley-trigger="change" required placeholder="Enter Mobile" class="form-control" id="mobile">
								</div>
							</div>
						</div>
						<div class="row">				
							<div class="form-group text-center m-b-0">
								<button class="btn btn-primary waves-effect waves-light" name="save_admin_user" data-toggle="modal" data-target="#createOrder" type="submit">
									Create Invoice
								</button>
								<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
									Cancel
								</button>
							</div>
						</div>
					</form>
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
<div id="createOrder" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Create Invoice</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="user_status">Product*</label>
							<select name="user_status" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
								<option value="Caramal Cake">Caramal Cake</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="user_status">Qty*</label>
							<input type="text" class="form-control" id="field-4" placeholder="01">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="user_status">Discount Type*</label>
							<select name="user_status" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
								<option value="Fixed Amount">Fixed Amount</option>
								<option value="Persentage">Persentage</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="user_status">Discount*</label>
							<input type="text" class="form-control" id="field-4" placeholder="01">
						</div>
					</div>				
					<div class="col-md-4">
						<div class="form-group">
							<label for="field-3" class="control-label">Price*</label>
							<input type="text" class="form-control" id="field-3" placeholder="Address">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="field-6" class="control-label">Date of Delivery</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="DD/MM/YYYY" id="datepicker-autoclose">
								<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9">
						<div class="form-group">
							<label for="field-4" class="control-label">Note</label>
							<input type="text" class="form-control" id="field-4" placeholder="Write any important thing here.">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="user_status">Status*</label>
							<select name="user_status" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
								<option value="Paid">Paid</option>
								<option value="Unpaid">Unpaid</option>
								<option value="Cancelled">Cancelled</option>
								<option value="Refunded">Refunded</option>
							</select>
						</div>
					</div>
				</div>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info waves-effect waves-light">Save changes</button>
			</div>
		</div>
	</div>
</div><!-- /.modal -->
<!-- end Modal -->


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


        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>

    </body>
</html>