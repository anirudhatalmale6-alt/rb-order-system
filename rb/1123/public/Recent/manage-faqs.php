<?php
include('library/session_info.php');
$pagetitle = ' - Manage-faqs';

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

                        <h4 class="page-title">Frequantly Asked Questions</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
                            <li><a href="#">Main Site</a></li>
                            <li class="active">FAQs</li>
                        </ol>
                    </div>
                </div>
				
				<div class="card-box">
					<form action="functions/function_admin_login.php" method="POST" data-parsley-validate novalidate>
						<div class="row">						
							<div class="col-lg-12">
								<div class="card-box-rox">
									<h4 class="m-t-0 header-title"><b>Feed FAQ Qustions &amp; Answers</b></h4>
									<p class="text-muted font-13 m-b-30">
										FAQs added on here will be shown on main site faq page.
									</p>
									<div class="form-group col-lg-4">
										<label for="userName">FAQ Title</label>
										<input type="text" name="faq_title" parsley-trigger="change" name="" required placeholder="Enter FAQ Title" class="form-control" id="userName">
									</div>								
									<div class="form-group col-lg-3">
										<label for="userName">FAQ Category</label>
										<select name="faq_cate" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
										<?php
									include('class/class_page.php');

									$select_cate_id = Page::select_category();
									while ($row = mysqli_fetch_array($select_cate_id)) {
									?>
											<option value="<?php echo $row['rox_cate']; ?>"><?php echo $row['rox_cate']; ?></option>

												<?php }?>	
										</select>
									</div>				
									<div class="form-group col-lg-5">
										<label for="userName">Description</label>
										<input type="text" name="faq_des" parsley-trigger="change" required placeholder="Enter FAQ Description" class="form-control" id="userName">
									</div>	
								</div>
							</div>
						</div>
						<div class="row">				
							<div class="form-group text-center m-b-0">
								<button name="save_faq"class="btn btn-primary waves-effect waves-light" type="submit">
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
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$sel_faq = Page::select_faq();
									while ($row2 = mysqli_fetch_array($sel_faq)){
								?> 
                                    <tr class="gradeA">
                                        <td><?php echo $row2['rox_faqs_id']; ?></td>
                                        <td><?php echo $row2['rox_faq_title']; ?></td>
                                        <td><?php echo $row2['rox_faq_cate']; ?></td>
                                        <td><?php echo $row2['rox_faq_des']; ?></td>
                                        <td class="actions">
                                            <a href="#" onclick="send()" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
									<?php } ?>
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
		function send(){				
				var somevalue	=	$("input[name=faq0]").val();
				var somevalue1	=	$("input[name=faq1]").val();
				var somevalue2	=	$("input[name=faq2]").val();
				var somevalue3	=	$("input[name=faq3]").val();
				var xhttp = new XMLHttpRequest();
				
				var params = '' +'faqid='+somevalue+'&faqtit='+somevalue1+'&faqcate='+somevalue2+'&faq_des='+somevalue3;
				var url = "functions/function_admin_login.php";
				//alert(JSON.stringify(params));
											
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
						
		function deletefaq(id){				
				var somevalue=id;				
				var xhttp = new XMLHttpRequest();
				
				var params = '' +'deletefaq='+somevalue;
				var url = "functions/function_admin_login.php";
				// alert(JSON.stringify(somevalue));
								
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
        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>
		
		
        <!-- Examples -->
	    <script src="assets/site/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
	    <script src="assets/site/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
	    <script src="assets/site/plugins/datatables/dataTables.bootstrap.js"></script>
	    <script src="assets/site/plugins/tiny-editable/mindmup-editabletable.js"></script>
	    <script src="assets/site/plugins/tiny-editable/numeric-input-example.js"></script>

	    <script src="assets/site/pages/datatables.editable.init.faq.js"></script>
		
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