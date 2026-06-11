<?php
include('library/session_info.php');
$pagetitle = ' - Repor Income';

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

                        <h4 class="page-title">Add your business branches</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
                            <li><a href="#">Main Site</a></li>
                            <li><a href="#">Reports</a></li>
                            <li class="active">Incomes</li>
                        </ol>
                    </div>
                </div>
				
				<div class="card-box">
					<form action="#" method="POST" data-parsley-validate novalidate>
						<div class="row">						
							<div class="col-lg-6">
								<div class="card-box-rox">
									<h4 class="m-t-0 header-title"><b>Feed Branch Contact Information</b></h4>
									<p class="text-muted font-13 m-b-30">
										Branches added on here will be shown on down below.
									</p>
									<div class="form-group ">
										<label for="user_status">Province</label>
										<select class="selectpicker" data-live-search="true" required="" data-style="btn-white" name="br_province">
											<option value="Central Province">Central Province</option>
											<option value="Eastern Province">Eastern Province</option>
											<option value="North Central Province">North Central Province</option>
											<option value="North Western Province">North Western Province</option>
											<option value="Northern Province">Northern Province</option>
											<option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
											<option value="Southern Province">Southern Province</option>
											<option value="Uva Province">Uva Province</option>
											<option value="Western Province">Western Province</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="card-box-rox">
								<h4 class="m-t-0 header-title"><b>Feed Branch Location Information</b></h4>
									<p class="text-muted font-13 m-b-30">
										Branches added on here will be shown on down below.
									</p>
									<div class="form-group ">
										<label for="user_status">Province</label>
										<select class="selectpicker" data-live-search="true" required="" data-style="btn-white" name="br_province">
											<option value="Central Province">Central Province</option>
											<option value="Eastern Province">Eastern Province</option>
											<option value="North Central Province">North Central Province</option>
											<option value="North Western Province">North Western Province</option>
											<option value="Northern Province">Northern Province</option>
											<option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
											<option value="Southern Province">Southern Province</option>
											<option value="Uva Province">Uva Province</option>
											<option value="Western Province">Western Province</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">				
							<div class="form-group text-center m-b-0">
								<button class="btn btn-primary waves-effect waves-light" type="submit" name="save_branch">
									Submit
								</button>
								<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
									Cancel
								</button>
							</div>
						</div>
					</form>
				</div>
				
                <div class="panel">

                    <div class="panel-body">
                       
                        <div class="">
                            <table class="table table-striped" id="datatable-editable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
										<th>Address</th>
										<th>Hotline no</th>
										<th>Tel No</th>                                      
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="gradeA">
                                        <td>abc</td>
                                        <td>abc</td>
										<td>abc</td>
										<td>abc</td>
										<td>abc</td>
                                        
                                        <td class="actions">
                                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end: page -->

                </div> <!-- end Panel -->

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
		<!-- MODAL -->
        <div id="dialog" class="modal-block mfp-hide">
            <section class="panel panel-info panel-color">
                <header class="panel-heading">
                    <h2 class="panel-title">Are you sure?</h2>
                </header>
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="modal-text">
                            <p>Are you sure that you want to delete this row?</p>
                        </div>
                    </div>

                    <div class="row m-t-20">
                        <div class="col-md-12 text-right">
                            <button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
                            <button id="dialogCancel" class="btn btn-default waves-effect">Cancel</button>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        <!-- end Modal -->
		<script>
		
		
						
		function deletebranch(id){				
				var somevalue=id;				
				var xhttp = new XMLHttpRequest();				
				var params = '' +'delete_branch='+somevalue;
				var url = "functions/function_user_access.php";
				//Send the proper header information along with the request
				
				xhttp.onreadystatechange = function() {//Call a function when the state changes.
					if(xhttp.readyState == 4 && xhttp.status == 20000) {
						alert(xhttp.responseText);
					}
				}
				xhttp.open("POST", url, true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send(params);
			}
		</script>
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
	
        <!-- Examples -->
	    <script src="assets/site/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
	    <script src="assets/site/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
	    <script src="assets/site/plugins/datatables/dataTables.bootstrap.js"></script>
	    <script src="assets/site/plugins/tiny-editable/mindmup-editabletable.js"></script>
	    <script src="assets/site/plugins/tiny-editable/numeric-input-example.js"></script>

	    <script src="assets/site/pages/datatables.editable.init.branch.js"></script>
		
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

        <script>
			$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
		</script>

    </body>
</html>