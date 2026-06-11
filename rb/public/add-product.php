<?php
include('library/session_info.php');
$pagetitle = ' - Add Product';

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

                        <h4 class="page-title">Create Product</h4>
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo $companyname; ?></a></li>
							<li><a href="#">Main Access</a></li> 
							<li><a href="#">Product Info</a></li> 
                            <li class="active">Create Product</li>
                        </ol>
                    </div>
                </div>
                <?php
                if (isset($_GET['status'])) {
                    $status = $_GET['status'];
                    if ($status == 'success') {
                        echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Action success </b>
												</div>';
                    }
                    if ($status == 'failed') {
                        echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												Error ! <b>Something went Wrong </b>
												</div>';
                    }
                }

                ?>
				<form action="functions/function_user_access.php" enctype="multipart/form-data" method="post">
				<div class="card-box">
						<div class="row">
							<h4 class="m-t-0 header-title"><b>Feed Product Item Information</b></h4>
							<p class="text-muted font-13 m-b-30">
								To bill customer you must enter all of your product list
							</p>
							<div id="status_bar"></div>						
							<div class="col-lg-12">
								<div class="form-group col-lg-3" style="display:none;">
									<label for="p_id">Product id*</label>
									<input type="text" name="p_id" parsley-trigger="change" placeholder="Enter First Name" class="form-control" id="p_id">
								</div>
								<div class="form-group col-lg-3">
									<label for="p_cate">Product Main Category</label>
									<select id="p_cate" name="p_cate" class="selectpicker" data-live-search="true"  data-style="btn-white">
									<option value="0" >-- Select  Main Category --</option>
											<?php
											include('class/class_common_access.php');
											$load_acc_cate= Common_access::load_acc_cate();
											while ($row_cate = mysqli_fetch_array($load_acc_cate)) {
											?> 
											<option value="<?php echo $row_cate['rox_main_cate']; ?>"  <?php  if(isset($_REQUEST['cat_id'])){  if($_REQUEST['cat_id']==$row_cate['rox_main_cate']){ ?>  selected="selected" <?php  }   } ?>  ><?php echo $row_cate['rox_main_cate']; ?></option>
											<?php } ?> 
									</select>
									
								</div>
								<div class="form-group col-lg-3">
									<label for="p_sub_cate">Product Sub Category</label>
									<select name="p_sub_cate" id="p_sub_cate" class="selectpicker" data-live-search="true"  data-style="btn-white">
										<option value="0" >-- Select  Sub Category --</option>
                                        <?php
                                            if(isset($_REQUEST['sub_id']))
                                            {
                                                ?>
                                                <option value="<?php echo $_REQUEST['sub_id'];  ?>" selected="selected"><?php echo $_REQUEST['sub_id'];  ?></option>
                                                <?php
                                            }
                                        ?>
                                        ?>
                                    </select>
								</div>
								<div class="form-group col-lg-3">
									<label for="p_name">Product Name*</label>
									<input type="text" name="p_name_add" parsley-trigger="change"  placeholder="Enter Product Name" class="form-control" id="p_name">
								</div>
								<div class="form-group col-lg-3">
									<label for="p_price">Product Price*</label>
									<input type="number" name="p_price" parsley-trigger="change"  placeholder="Example 10.00" class="form-control" id="p_price">
								</div>
								<div class="form-group col-lg-2">
									<label for="p_net_price">Net Weight*</label>
									<input type="number" name="p_net_price" parsley-trigger="change"  placeholder="Net Weight" class="form-control" id="p_net_price">
								</div>
								<!--<div class="form-group col-lg-3">
									<label for="p_dis_status">Product Status*</label>
									<select name="p_dis_status" id="p_dis_status" class="selectpicker" data-live-search="true" required="" data-style="btn-white">
										<option value="Available">Available</option>
										<option value="Out of Stock">Out of Stock</option>
									</select>
								</div>-->
								<div class="form-group col-lg-4">
									<label for="p_des">Description*</label>
									<input type="text" name="p_des" parsley-trigger="change" placeholder="Enter Product Description" class="form-control" id="p_des">
								</div>
								<div class="form-group col-lg-2">
									<label for="p_dis_status">Discount*</label>
									<select name="p_dis_status" id="p_dis_status" class="selectpicker" data-live-search="true"  data-style="btn-white">
										<option value="1">Discount</option>
										<option value="0">Non Discount</option>
									</select>
								</div>
                               
							</div>

						</div>
						<div class="row">				
							<div class="form-group text-center m-b-0">
                                <div id="conte">
                                    <button class="btn btn-primary waves-effect waves-light" value="submit" type="submit">
                                        <span id="ak">Save Product</span>
                                    </button>

                                    <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                                        Cancel
                                    </button>
                                </div>
							</div>
						</div>
				</div>
				</form>
				<div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">                          
                            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="30" >
                            	
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Product ID</th>
                                        <th>Product Name</th>
                                        <th data-hide="phone">Main Category</th>
                                        <th data-hide="phone, tablet">Sub Category</th>
                                        <th data-hide="phone, tablet">Net Weight</th>
                                        <th data-hide="phone, tablet">Price</th>
                                        <th data-hide="phone, tablet">Discount Status</th>
                                        
                                        <th data-hide="phone, tablet">Actions</th>
                                    </tr>
                                </thead>

                                <div class="form-inline m-b-20">
                                    <div class="row">
                                        <div class="col-sm-6 text-xs-center">
                                            <div class="form-group">
                                                <label class="control-label m-r-5">Status</label>
                                                <select id="demo-foo-filter-status" class="form-control input-sm">
                                                    <option value="">Show all</option>
                                                    <option value="Available">Available</option>
                                                    <option value="Out of Stock">Out of Stock</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-xs-center text-right">
                                            <div class="form-group">
                                                <input id="demo-foo-search" type="text" placeholder="Search" class="form-control input-sm" autocomplete="on">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <div class="text-right">
                                                <ul class="pagination pagination-split m-t-30 m-b-0"></ul>
                                            </div>
                                        </td >
                                    </tr>
                                </tfoot>
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

        <script src="assets/site/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="assets/site/plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="assets/site/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/site/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>

        <script src="assets/site/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/site/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

    

		  <!--FooTable-->
		<script src="assets/site/plugins/footable/js/footable.all.min.js"></script>
	    <!--FooTable Example-->
		<script src="assets/site/pages/jquery.footable.js"></script>

        <!-- App core js -->
        <script src="assets/site/js/jquery.core.js"></script>
        <script src="assets/site/js/jquery.app.js"></script>
		<script >
		load_product();
		// $('#imageUploadForm').on('submit',(function(e) {
			
			                       
			// var formData = $(":file").val();
			// var text = $("#image_text").val();
			// var p_name=	$("#p_name").val();
			// var p_cate=	$("#p_cate").val();
			// var p_sub_cate=	$("#p_sub_cate").val();
			// var p_price=	$("#p_price").val();
			// var p_net_price=	$("#p_net_price").val();
			// var p_dis_status=	$("#p_dis_status").val();
			// var p_des=	$("#p_des").val();
			// save_product(p_name,p_cate,p_sub_cate,p_price,p_net_price,p_dis_status,p_des,formData,text);
			// e.preventDefault();
			// }));

//		$(document).on('click','#save_product', function(e)
//		{
//			var formData = 0;
//			var text = 0;
//			var p_name=	0;
//			var p_cate=	0;
//			var p_sub_cate=	0;
//			var p_price= 0;
//			var p_net_price= 0;
//			var p_dis_status= 0;
//			var p_des= 0;
//
//			 formData = $(":file").val();
//			 text = $("#image_text").val();
//			 p_name=	$("#p_name").val();
//			 p_cate=	$("#p_cate").val();
//			 p_sub_cate=	$("#p_sub_cate").val();
//			 p_price=	$("#p_price").val();
//			 p_net_price=	$("#p_net_price").val();
//			 p_dis_status=	$("#p_dis_status").val();
//			 p_des=	$("#p_des").val();
//			console.log(formData);
//			save_product(p_name,p_cate,p_sub_cate,p_price,p_net_price,p_dis_status,p_des,formData,text);
//			e.preventDefault();
//		});
		
		$(document).on('click','#update_product', function(e)
		{

			var p_id=	$("#p_id").val();
			var formData = 0;
			var text = 0;
			var p_name=	0;
			var p_cate=	0;
			var p_sub_cate=	0;
			var p_price= 0;
			var p_net_price= 0;
			var p_dis_status= 0;
			var p_des= 0;
			
			 formData = $(":file").val();
			 text = $("#image_text").val();
			 p_name=	$("#p_name").val();
			 p_cate=	$("#p_cate").val();
			 p_sub_cate=	$("#p_sub_cate").val();
			 p_price=	$("#p_price").val();
			 p_net_price=	$("#p_net_price").val();
			 p_dis_status=	$("#p_dis_status").val();
			 p_des=	$("#p_des").val();
			// console.log(formData);
			update_product(p_id, p_name,p_cate,p_sub_cate,p_price,p_net_price,p_dis_status,p_des,formData,text);
			e.preventDefault();
		});
		
		$('table').on('click', '.edit', function()
		{
				
			var rid = $(this).closest('tr').find('td:first').text();
			var id = $.trim(rid);
			get_product(rid);

		});
		
		$('table').on('click', '.trash', function()
		{
			var rid = $(this).closest('tr').find('td:first').text();
			var id = $.trim(rid);
			delete_product(rid);
		});
 
 

 function save_product(p_name,p_cate,p_sub_cate,p_price,p_net_price,p_dis_status,p_des,formData,text) {
	
	frm_call = 'save_product';
	
	$("#status_bar").empty();
	if(p_name != null){
		$.ajax({
			url: 'functions/function_user_access.php',
			type: 'POST',
			data: {
				paracall : frm_call,
				parap_name : p_name,
				parap_cate : p_cate,
				parap_sub_cate : p_sub_cate,
				parap_price : p_price,
				parap_net_wgdt : p_net_price,
				parap_dis_status : p_dis_status,
				parap_des : p_des,
				parap_img : formData,
//                parap_img_text : text
			},
			//dataType:'text',
			success:function(response){
				// alert(response);
				$('#status_bar').append('<div style="width:600px; background-color:#fafafa !important;" class="alert alert-dismissable">'+
						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
						'	<i class="fa fa-close"></i>'+
						'</button>'+
						'<b>'+response+'</b>'+
						'</div>');
				load_product();
			}
		});
	}
	else{
		alert("Add Details");
	}
 }  
 
 function update_product(p_id,p_name,p_cate,p_sub_cate,p_price,p_net_price,p_dis_status,p_des,formData,text) {
	
	frm_call = 'update_product';
	var str='';
	$('#status_bar').empty();
	if(p_id != 0){
	
		$.ajax({
			url: 'functions/function_user_access.php',
			type: 'POST',
			data: {
				paracall : frm_call,
				parap_id : p_id,
				parap_name : p_name,
				parap_cate : p_cate,
				parap_sub_cate : p_sub_cate,
				parap_price : p_price,
				parap_net_wgdt : p_net_price,
				parap_dis_status : p_dis_status,
				parap_des : p_des,
				parap_img : formData,
				parap_img_text : text,
			},
			dataType: 'text',
			success:function(response){
			
				// alert(response);
				$('#status_bar').append('<div style="width:600px; background-color:#fafafa !important;" class="alert alert-dismissable">'+
						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
						'	<i class="fa fa-close"></i>'+
						'</button>'+
						'<b>'+response+'</b>'+
						'</div>');
				    load_product();
			}
		});
	}
	else{
		alert("Add Details");
	}
 }
 
 function get_product(p_id) {
	
	frm_call = 'get_product';
	var str='';
	if(p_name != 0){
	
		$.ajax({
			url: 'functions/function_user_access.php',
			type: 'POST',
			data: {
				paracall : frm_call,
				parap_id : p_id,
				
			},
			dataType: 'json',
			success:function(response){
			
				var len = response.length;
				var r = 1;
	
				for( var i = 0; i<len; i++){

					var rox_line_id = response[i]['rox_line_id'];
					var rox_prd_main_cate = response[i]['rox_prd_main_cate'];
					var rox_prd_sub_cate = response[i]['rox_prd_sub_cate'];
					var rox_prd_price =response[i]['rox_prd_price'];
					
					var rox_prd_net_wgdt = response[i]['rox_prd_net_wgdt'];
					var rox_dis_status = response[i]['rox_dis_status'];
					var rox_prd_des = response[i]['rox_prd_des'];
					var rox_prd_name = response[i]['rox_prd_name'];
					var rox_img_name = response[i]['rox_img_name'];

				
					$("#p_name").val(rox_prd_name);
					$("#p_cate").val(rox_prd_main_cate);
					$("#p_cate").selectpicker('refresh');
					$("#p_sub_cate").empty();
					$("#p_sub_cate").append('<option value="'+rox_prd_sub_cate+'">'+rox_prd_sub_cate+'</option>');
					$("#p_sub_cate").selectpicker('refresh');
					$("#p_price").val(rox_prd_price);
					$("#p_net_price").val(rox_prd_net_wgdt);
					$("#p_dis_status").val(rox_dis_status);
					$("#p_dis_status").selectpicker('refresh');
					$("#p_des").val(rox_prd_des);
					$("#p_id").val(rox_line_id);
					//var img = new Image();
					//img.src = "../assets/site/uploads/"+rox_prd_name+"/"+rox_prd_sub_cate+".*.*";
                    var rst = "assets/site/uploads/"+rox_prd_name+""+rox_prd_sub_cate+"/"+rox_img_name+" ";
                    $("#umg2").attr("src","assets/site/uploads/"+rox_prd_name+""+rox_prd_sub_cate+"/"+rox_img_name+" ");
					//alert(rst);
					// window.scrollTo(0, 0);

                    $("#conte").html('<button class="btn btn-primary waves-effect waves-light" value="submit" type="submit" id="update_product"> <span id="ak">Update Product</span> </button>	<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">Cancel </button>');
					
							
				}
			}
		});
	}
	else{
		alert("Add Details");
	}
 } 
 
 
 
 
 function delete_product(p_id) {
	
	frm_call = 'delete_product';

	$('#status_bar').empty();
	if(p_name != 0){
	
		$.ajax({
			url: 'functions/function_user_access.php',
			type: 'POST',
			data: {
				paracall : frm_call,
				parap_id : p_id,	
			},
			dataType: 'text',
			success:function(response){
				$('#status_bar').append('<div style="width:600px; background-color:#fafafa !important;" class="alert alert-dismissable">'+
						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
						'	<i class="fa fa-close"></i>'+
						'</button>'+
						'<b>'+response+'</b>'+
						'</div>');
						load_product();
			}
		});
	}
	else{
		alert("Error");
	}
 } 
 
 function load_product() {
	
	frm_call = 'load_product';

	$("#demo-foo-filtering tbody").empty();
	if(p_name != 0){
	
		$.ajax({
			url: 'functions/function_user_access.php',
			type: 'POST',
			data: {
				paracall : frm_call,	
			},
			dataType: 'json',
			success:function(response){
			
				var len = response.length;
				var r = 1;
				
				for( var i = 0; i<len; i++){

					var rox_line_id = response[i]['rox_line_id'];
					var rox_prd_main_cate = response[i]['rox_prd_main_cate'];
					var rox_prd_sub_cate = response[i]['rox_prd_sub_cate'];
					var rox_prd_price =response[i]['rox_prd_price'];
					var rox_prd_net_wgdt = response[i]['rox_prd_net_wgdt'];
					var rox_dis_status = response[i]['rox_dis_status'];
					var rox_prd_des = response[i]['rox_prd_des'];
					var rox_prd_name = response[i]['rox_prd_name'];
                    var rox_img_name = response[i]['rox_img_name'];
                    var rst = "assets/site/uploads/"+rox_prd_name+""+rox_prd_sub_cate+"/"+rox_img_name+" ";
if(rox_dis_status==1)
{
    var status="Discount Product";
    var cls="rgba(255,37,39,0.61)";
}
else if(rox_dis_status==0)
{
    var status="NonDiscount Product";
    var cls="rgb(128, 201, 104);";
}
				$("#demo-foo-filtering tbody").append('<tr>'+
					'<td>'+rox_line_id+'</td>'+
					'<td>'+rox_prd_name+'</td>'+
					'<td>'+rox_prd_main_cate+'</td>'+
					'<td>'+rox_prd_sub_cate+'</td>'+
					'<td>'+rox_prd_net_wgdt+'</td>'+
					'<td>'+rox_prd_price+'</td>'+
                    '<td>'+
                    '<span style="color:'+cls+'">'+status+'</span>' +
                    '</td>'+

                   // $("#umg2").attr("src","assets/site/uploads/"+rox_prd_name+""+rox_prd_sub_cate+"/"+rox_img_name+" ");

                    

					'<td>'+
						'<a href="#" class="edit btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i></a>'+
						'<a href="#" class="trash btn btn-danger waves-effect waves-light"><i class="fa fa-trash"></i></a>'+
					'</td>'+
				'</tr>');
					
							
				}
			}
		});
	}
	else{
		alert("Size can not be 0");
	}
 }	

	$(document).on('change','#p_cate',function(){
		frm_call = 'load_subcat';
		$("#p_sub_cate").empty();
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
			// alert(main_cateid);
				var len = response.length;

				$("#p_sub_cate").empty();
				for( var i = 0; i<len; i++){
					var sub_id = response[i]['sub_id'];
					var sub_name = response[i]['sub_name'];
					$("#p_sub_cate").append("<option value='"+sub_id+"'>"+sub_name+"</option>");
					$('#p_sub_cate').selectpicker('refresh');
				}
			}
			
		});
		$('#p_sub_cate').selectpicker('refresh');
	});
	</script>
		

    </body>
</html>