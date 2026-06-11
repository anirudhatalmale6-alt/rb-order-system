<?php
include('library/session_info.php');
$pagetitle = ' - ';

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

                        <h4 class="page-title">Manage User Authority</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
                            <li><a href="#">System Users</a></li>
                            <li class="active">User Authority</li>
                        </ol>
                    </div>
                </div>
								
                <div class="panel">

                    <div class="panel-body">
                       
                        <div class="">
                            <table class="table table-striped" id="datatable-editable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Page Access</th>
										<th align="center">Chief Accountant</th>
										<th align="center">Manager</th>
										<th align="center">Employee</th>
										<th align="center">Accountant</th>
                                        <!--<th>Actions</th>-->
                                    </tr>
                                </thead>
                                <tbody>
								 <?php
									include('class/class_common_access.php');
									$load = Common_access::load_access_level();
									while ($row_access_level = mysqli_fetch_array($load)) {
									?>  
								
                                    <tr class="gradeA">
                                        <td><?php echo $row_access_level['rox_line_id']; ?></td>
                                        <td><?php echo $row_access_level['rox_web_access']; ?></td>
										<td align="center"><?php if($row_access_level['rox_chief_acc']==1)
										{
											echo ' <input type="checkbox" value="'.$row_access_level['rox_chief_acc'].'" name="chief_acc" id="chief_acc" Checked>';
										}
										else{
											echo ' <input type="checkbox" value="'.$row_access_level['rox_chief_acc'].'" name="chief_acc" id="chief_acc">';
										}
										?>
										
										</td>
										<td align="center"><?php if($row_access_level['rox_manager']==1)
										{
											echo ' <input type="checkbox" value="'.$row_access_level['rox_chief_acc'].'" name="manager" Checked>';
										}
										else{
											echo ' <input type="checkbox" value="'.$row_access_level['rox_chief_acc'].'" name="manager">';
										}
										?>
										
										</td>
										<td align="center"><?php if($row_access_level['rox_employee']==1)
										{
											echo ' <input type="checkbox" value="'.$row_access_level['rox_chief_acc'].'" name="employee" Checked>';
										}
										else{
											echo ' <input type="checkbox" value="'.$row_access_level['rox_chief_acc'].'" name="employee">';
										}
										?>
										
										</td>
										<td align="center"><?php if($row_access_level['rox_acc']==1)
										{
											echo ' <input type="checkbox" value="'.$row_access_level['rox_chief_acc'].'" id="accountant" Checked>';
										}
										else{
											echo ' <input type="checkbox" value="'.$row_access_level['rox_chief_acc'].'" id="accountant">';
										}
										?>
										
										</td>
										                                            <!--<<td class="actions">
                                            <a href="#" onclick ="send()" class="on-default edit-row"><i class="fa fa-save"></i></a>
                                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>-->
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
		
	
	
	<script>
		
						
		function deletemagcate(id){				
				var somevalue=id;

				
				var xhttp = new XMLHttpRequest();
				
				var params = '' +'deletemagcate='+somevalue;
				var url = "functions/function_common_access.php";
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
         
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>
        <!-- Examples -->
	    <script src="assets/site/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
	    <script src="assets/site/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
	    <script src="assets/site/plugins/datatables/dataTables.bootstrap.js"></script>
	    <script src="assets/site/plugins/tiny-editable/mindmup-editabletable.js"></script>
	    <script src="assets/site/plugins/tiny-editable/numeric-input-example.js"></script>

	    <script src="assets/site/pages/datatables.editable.init.manage.authority.js"></script>
		
		<script src="assets/site/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="assets/site/plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="assets/site/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/site/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
       
        <script src="assets/site/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="assets/site/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="assets/site/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="assets/site/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="assets/site/pages/autocomplete.js"></script>

       
		
        <!-- App core js -->
 

        <script>
			$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
		</script>
		
		<script>
		$(document).on('change', 'input[type="checkbox"]', function(e){
             var ckbox = $("input[name='chief_acc']");

			if(ckbox.is(":checked"))
			{
				alert("This chief_acc Will Display");
				var somevalue= $(this).closest('tr').find('.sorting_1').text();
				var somevalue2= 1;	
				alert(JSON.stringify(somevalue));	alert(JSON.stringify($('#chief_acc').val()));					
				var xhttp = new XMLHttpRequest();				
				var params = '' +'com_id='+somevalue+'&checkbox='+somevalue2;
				var url = "functions/function_common_access .php";
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
			else if($(".manager").is(":checked"))
			{
				alert("This manager Will not Display");
				var somevalue= $(this).closest('tr').find('.sorting_1').text();
				var somevalue2= 0;							
				var xhttp = new XMLHttpRequest();				
				var params = '' +'com_id='+somevalue+'&checkbox='+somevalue2;
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
		});
	</script>

    </body>
</html>