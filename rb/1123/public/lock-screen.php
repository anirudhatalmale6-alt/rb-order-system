<?php
$pagetitle = ' - Lock Screen';
//include('library/session_info.php');
session_start();
$pagedescr = ' ';

$pagekeywords = ' ';

include(INC_PATH . "system-info.php");

include(INC_PATH . "header.php");
?>
	<body>

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box">
				<?php
				if (isset($_GET['status'])) {
					$status = $_GET['status'];
					if ($status == 'faild') {
						echo '<div class="alert alert-danger alert-dismissable">
							<button type="button" aria-hidden="true">
								<i class="fa fa-close"></i>
							</button>
							Oops! <b>Invalid Credentials    </b>
							</div>';
					}
					if ($status == '') {
						echo '<div class="alert alert-success alert-dismissable">
								<i class="fa fa-close"></i>
							</button>
							<b>Screen Locked</b>
							</div>';
					}					
				}
				?>
				<div class="panel-body">
					<form method="POST" action="functions/function_login.php" role="form" class="text-center">
						<div class="user-thumb">
							<img src="assets/site/images/users/avatar-1.jpg" class="img-responsive img-circle img-thumbnail" alt="thumbnail">
						</div>
						<div class="form-group">
							<h3><?php  echo  $_SESSION['username'];?></h3>
							<p class="text-muted">
								Enter your password to access the admin.
							</p>
							<div class="input-group m-t-30">
								<input type="password" name="user_password" class="form-control" placeholder="Password" required="">
								<span class="input-group-btn">
									<button type="submit" name="user_admin_login" value="lock" class="btn btn-pink w-sm waves-effect waves-light">
										Log In
									</button> 
								</span>
							</div>
						</div>
						
					</form>
       

				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12 text-center">
					<p>
						Not Chadengle?<a href="./" class="text-primary m-l-5"><b>Sign In</b></a>
					</p>
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