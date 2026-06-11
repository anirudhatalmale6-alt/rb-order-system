<?php
include('library/session_info.php');
$pagetitle = ' - Manage faq-categories';

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

                        <h4 class="page-title">Manage Frequantly Asked Questions Categories</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
                            <li><a href="#">Main Site</a></li>
                            <li class="active">FAQs</li>
                        </ol>
                    </div>
                </div>
			
				
                <div class="panel">

                    <div class="panel-body">
                     <div class="row">
                            <div class="col-sm-6">
                                <div class="m-b-30">
                                    <button id="addToTable" class="btn btn-default waves-effect waves-light">Add <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <table class="table table-striped" id="datatable-editable">
								<thead>
                                    <tr>
                                        <td></td>
                                        <td>Income</td>
                                        <td></td>
                                        <td>Expense</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Statement</th>
                                        <th>Amount</th>
                                        <th>Statement</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                   
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
				var somevalue=$("input[name=faqcate0]").val();
				var somevalue1=$("input[name=faqcate1]").val();
				var somevalue2=$("input[name=faqcate2]").val();
				
				var xhttp = new XMLHttpRequest();
				
				var params = '' +'cateid='+somevalue+'&cate='+somevalue1+'&cate_des='+somevalue2;
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
						
		function deletecate(id){				
				var somevalue=id;

				
				var xhttp = new XMLHttpRequest();
				
				var params = '' +'deletecateid='+somevalue;
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
		     <!-- <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
       App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>
		
        <!-- Examples -->
	    <script src="assets/site/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
	    <script src="assets/site/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
	    <script src="assets/site/plugins/datatables/dataTables.bootstrap.js"></script>
	    <script src="assets/site/plugins/tiny-editable/mindmup-editabletable.js"></script>
	    <script src="assets/site/plugins/tiny-editable/numeric-input-example.js"></script>

	    <script src="assets/site/pages/datatables.editable.init.faq.category.js"></script>
		
		<script src="assets/site/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="assets/site/plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="assets/site/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/site/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
      



      

        
		
       
       

        
	

    </body>
</html>