<?php
//include('../library/session.php');
$pagetitle=' - Reset Portal Password';

//include("../includes/admin/author-information.php");

//include("../includes/admin/admin-header.php");

include(INC_PATH . "system-info.php");

include(INC_PATH . "header.php");
?>
    <body>
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center"> Change Password</h3>
            </div> 

            <div class="panel-body">
				<form class="form-horizontal m-t-20" action="../functions/function_reset.php" method="get">
					
					<div class="form-group ">
						<label for="pass1">Reset Code*</label>
							<input class="form-control" type="text" name="code_reset" required="" placeholder="Reset Code">

					</div>
					<div class="form-group">
						<label for="pass1">Password*</label>
						<input id="pass1" type="password" name="password_new" placeholder="Password" required class="form-control">
					</div>
					<div class="form-group">
						<label for="passWord2">Confirm Password *</label>
						<input data-parsley-equalto="#pass1" type="password" required placeholder="Password" class="form-control" id="passWord2">
					</div>
					
					<div class="form-group text-center m-t-40">
						<div class="col-xs-12">
							<button name="reset_password" value="change" class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit" name="reset_password">Change Password</button>
						</div>
					</div>

				</form> 
            
            </div>   
            </div>                              
                <div class="row">
            	<div class="col-sm-12 text-center">
            		&copy; <?php echo DATE('Y'); ?> Design &amp; Developed By<a href="<?php echo $authorurl; ?>" target="_blank" class="text-primary m-l-5"><b><?php echo $author; ?></b></a>
                    </div>
            </div>
            
        </div>
        
        

        
    	<script>
            var resizefunc = [];
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


        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>
	
	</body>
</html>