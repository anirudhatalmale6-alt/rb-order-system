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

                <div class="row">

                    <div class="col-md-12">

                        &nbsp;

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="card-box">

                            <form action="" method="post">

                            <div class="row">

                                <?php

                                    $category_result=  Report::getCategory();

                                ?>

                                <div class="col-md-3">

                                    <label class="control-label"> Item Category</label>

                                </div>

                                <div class="col-md-3">

                                    <select class="form-control" required id="cat_id" name="cat_id" onchange="loadfile(this.value);">

                                        <option value="---" >---</option>

                                        <?php

                                        while($cat_row=  mysqli_fetch_assoc($category_result))

                                        {

                                       ?>  

                                        <option value="<?php echo $cat_row['rox_main_cate']; ?>" <?php if(isset($_REQUEST['cat_id'])){ if($cat_row['rox_main_cate']==$_REQUEST['cat_id']){  ?> selected="selected" <?php } }  ?> ><?php echo $cat_row['rox_main_cate']; ?></option>

                                      <?php      

                                        }

                                        ?>

                                    </select>

                                </div>

                                <div class="col-md-3">

                                    <label class="control-label">Item Sub Category</label>

                                </div>

                                <div class="col-md-3" id="fil_data">

                                    <?php

                                        if(isset($_REQUEST['cat_id']))

                                        {

                                            $cat_id=$_REQUEST['cat_id'];

                                           $sub_cat_result= Report::getSubCategoriesDirect($cat_id);

                                    ?>

                                    <select class="form-control" id="sub_cat" name="sub_cat">

                                       <?php

                                        while($sub_cat_row=  mysqli_fetch_assoc($sub_cat_result))

                                        {

                                            ?>

                                        <option value="<?php echo $sub_cat_row['rox_sub_cate'];  ?>" <?php if(isset($_REQUEST['sub_cat'])){ if($sub_cat_row['rox_sub_cate']==$_REQUEST['sub_cat']){ ?> selected="selected"  <?php  }  } ?> > <?php echo $sub_cat_row['rox_sub_cate'];  ?></option>

                                            <?php

                                        }

                                       

                                       ?>

                                        

                                    </select>

                                    <?php

                                        }

                                    ?>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12">&nbsp;</div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">

                                    <label class="control-label">Item</label>

                                </div>

                                <div class="col-md-3" id="fil_data1">

                                   <?php

                                        if(isset($_REQUEST['item']))

                                        {

                                            $sub_cat_id=$_POST['sub_cat'];

                                        ?>    

                                    <select class="form-control" id="item"  name="item">

                                        <?php

                                          $itemResult= Report::getItemsDirect($sub_cat_id);

                                          while($item_row=  mysqli_fetch_assoc($itemResult))

                                          {

                                         ?>   

                                        <option value="<?php echo $item_row['rox_line_id']; ?>" <?php if($item_row['rox_line_id']==$_REQUEST['item']){ ?> selected="selected" <?php } ?> ><?php echo $item_row['rox_prd_name']; ?></option>

                                         <?php     

                                          }

                                        ?>

                                    </select>

                                       <?php     

                                        }

                                   ?>

                                </div>

                                

                            </div>

                            <div class="row">

                                <div class="col-md-12">&nbsp;</div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">Time Range</div>

                                <div class="col-md-3"><input type="date" class="form-control"  value="<?= $_POST['start_date'] ?>"  name="start_date" id="start_date" required="required"/></div>

                                <div class="col-md-1">To</div>

                                <div class="col-md-3"><input type="date" class="form-control"   value="<?= $_POST['end_date'] ?>"  name="end_date" id="end_date" required="required"/></div>

                            </div>

                            <div class="row">

                                <div class="col-md-12">&nbsp;</div>

                            </div> 

                                <div class="row">

                                    <div class="col-md-3">

                                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>&nbsp;Search</button>

                                    </div>

                                </div>    

                        </form>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

				<div class="card-box">



                            <!--	<form data-parsley-validate novalidate>-->

                        <!--</form>-->

				 <div class="row" id="ticketPrintArea">

                    <div class="col-sm-12">

                        <div class="card-box">

                            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="100">

                                <thead>

                                    <tr>

                                        <th>Main Cat</th>

                                        <th data-hide="phone">Sub Cat</th>

                                        <th data-hide="phone, tablet">Name</th>

                                        <th data-hide="phone, tablet">Price</th>

                                        <th data-hide="phone, tablet">Quantity</th>

                                        <th data-hide="phone, tablet">Total Sales</th>

                                        <!-- <th data-hide="phone, tablet">Action</th> -->



                                    </tr>

                                </thead>

                                <div class="form-inline m-b-20">

                                    <div class="row">

                                        <div class="col-sm-6 text-xs-center">

                                            <div class="form-group">

                                                <label class="control-label m-r-5">Status</label>

                                                <select id="demo-foo-filter-status" class="form-control input-sm">

                                                    <option value="">Show all</option>



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

                                    

                                    <?php

                                      include("class/class_orders.php");

                                  

                                

                                if(!isset($_REQUEST['item']))

                                {

                                $ttt=null;

                                $rox_prd_qty__=null;

                                $total_=null;

                              

                                    

                                    $prdct=class_orders::select_all_from_product_all();





                                    while ($data2p=mysqli_fetch_array($prdct)){



                                    $rox_line_idd=$data2p['rox_line_id'];





                                        $ordr=class_orders::select_all_from_report_where_pro_id($rox_line_idd);

                                        $row=mysqli_fetch_array($ordr);

                                        $totqty=$row['value_sum'];

                                        $idd=$row['rox_prd_val'];

                                        $i=$row['rox_inv_id'];



                                        $prdct1=class_orders::select_all_from_product_all1($idd);

                                        while($row1=mysqli_fetch_array($prdct1)){

                                        $rox_line_id=$row1['rox_line_id'];

                                        $rox_prd_main_cate=$row1['rox_prd_main_cate'];

                                        $rox_prd_sub_cate=$row1['rox_prd_sub_cate'];

                                        $rox_prd_name=$row1['rox_prd_name'];

                                        $rox_prd_price=$row1['rox_prd_price'];

                                ?>

                                    <tr>

                                        <td><?php echo $rox_prd_main_cate.$rox_line_id;?></td>

                                        <td><?php echo $rox_prd_sub_cate;?></td>

                                        <td><?php echo $rox_prd_name;?></td>

                                        <td><?php echo $rox_prd_price;?></td>

                                        <td><?php echo $totqty ?></td>

                                        <td><?php echo $totqty*$rox_prd_price;?></td>

                                        <!-- <td><a href="#"  data-toggle="modal" data-target="#exampleModal<?php echo $i;?>">Cancel Order</a></td> -->









                                    </tr>

                                            <div class="modal fade<?php echo $i;?>" id="exampleModal<?php echo$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">





                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                            <span aria-hidden="true">&times;</span>

                                                        </button>





                                                        <form action="functions/function_payment.php" method="post">



                                                            <div class="form-group">

                                                                <input type="text" name="invid" value="<?php echo $i;?>" hidden>

                                                                <img src="assets/site/images/Remove.png" style="margin-left: 202px;"/>

                                                                <h3 style="margin-left: 200px;">Are you sure?</h3>

                                                                <p style="margin-left: 169px;">You Want to Cancel The Order</p>





                                                            </div>





                                                            <div class="modal-footer">

                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                                <button type="submit" class="btn btn-danger valSubmit" name="cancel" id="valSubmit">Confirm</button>

                                                            </div>

                                                        </form>

                                                    </div>

                                                </div>

                                            </div>

                                <?php }}?>



                                <div class="col-md-4">

                                    <div class="form-group">



                                        <a href="javascript:void(0);" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Print Reoprt</a>

                                    </div>

                                </div>



                                <div class="col-md-4">

                                    <div class="form-group">

                                        <a onclick="reports_products_only_export(event)" href="functions/function_excell.php?out_all=yes" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Export</a>

                                    </div>

                                </div>





                                </tbody>

                                <?php

                                }

                                else

                                {

                                 $item_code=$_REQUEST['item']; 

                                $start_date=$_POST['start_date'];

                                $end_date=$_POST['end_date'];

                                 $ordr=class_orders::select_all_from_report_where_pro_idDate($item_code,$start_date,$end_date);

                                  $row=mysqli_fetch_array($ordr);

                                  $totqty=$row['value_sum'];

                                  $idd=$row['rox_prd_val'];

                                  $i=$row['rox_inv_id'];

                                  

                                  $prdct1=class_orders::select_all_from_product_all1($idd);

                                        while($row1=mysqli_fetch_array($prdct1)){

                                        $rox_line_id=$row1['rox_line_id'];

                                        $rox_prd_main_cate=$row1['rox_prd_main_cate'];

                                        $rox_prd_sub_cate=$row1['rox_prd_sub_cate'];

                                        $rox_prd_name=$row1['rox_prd_name'];

                                        $rox_prd_price=$row1['rox_prd_price'];

                                  

                                  

                                 ?>

                                   <tr>

                                        <td><?php echo $rox_prd_main_cate.$rox_line_id;?></td>

                                        <td><?php echo $rox_prd_sub_cate;?></td>

                                        <td><?php echo $rox_prd_name;?></td>

                                        <td><?php echo $rox_prd_price;?></td>

                                        <td><?php echo $totqty ?></td>

                                        <td><?php echo $totqty*$rox_prd_price;?></td>

                                        <td><a href="#"  data-toggle="modal" data-target="#exampleModal<?php echo $i;?>">Cancel Order</a></td>









                                    </tr>

                                            <div class="modal fade<?php echo $i;?>" id="exampleModal<?php echo$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">





                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                            <span aria-hidden="true">&times;</span>

                                                        </button>





                                                        <form action="functions/function_payment.php" method="post">



                                                            <div class="form-group">

                                                                <input type="text" name="invid" value="<?php echo $i;?>" hidden>

                                                                <img src="assets/site/images/Remove.png" style="margin-left: 202px;"/>

                                                                <h3 style="margin-left: 200px;">Are you sure?</h3>

                                                                <p style="margin-left: 169px;">You Want to Cancel The Order</p>





                                                            </div>

                                                            

                                                               <div class="modal-footer">

                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                                <button type="submit" class="btn btn-danger valSubmit" name="cancel" id="valSubmit">Confirm</button>

                                                            </div>

                                                        </form>

                                                    </div>

                                                </div>

                                            </div>



                                 

                                

                                    <?php

                                }

                                }

                                ?>

                                <tfoot>

                                    <tr>

                                        <td colspan="5">

                                            <div class="text-right">

                                                <ul class="pagination pagination-split m-t-30 m-b-0"></ul>

                                            </div>

                                        </td>

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

            </div>

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



            $(document).on('change','#ord_p_m_typ',function(){

                frm_call = 'load_subcat';

                $("#ord_p_s_typ").empty();

                $("#ord_prd_typ").empty();

                $('#ord_p_s_typ').selectpicker('refresh');

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

                        var len = response.length;

                        var found = false;



                        $("#ord_p_s_typ").empty();

                        $("#ord_p_s_typ").append("<option value=''>select sub cat</option>");

                        for( var i = 0; i<len; i++){

                            var sub_id = response[i]['sub_id'];

                            var sub_name = response[i]['sub_name'];



                            $("#ord_p_s_typ").append("<option value='"+sub_id+"'>"+sub_name+"</option>");

                            $('#ord_p_s_typ').selectpicker('refresh');

                            found = true;

                        }

                        if( found == false ){

                            load_main();

                        }



                    }

                });

            });



            $(document).on('change','#ord_p_s_typ',function(){

                frm_call = 'load_product';

                $("#ord_prd_typ").empty();

                var sub_cateid = $(this).val();

                // if(sub_cateid != null){

                // $("#prd").hide();

                // $("#prd_typ").show();

                // }

                // else{

                // $("#ord_prd_typ").empty();

                // $("#prd").show();

                // $("#prd_typ").hide();

                // }

                $.ajax({

                    url: 'class/class_select_sub_cate.php',

                    type: 'post',

                    data: {

                        product :sub_cateid,

                        paracall : frm_call,

                    },

                    dataType: 'json',

                    success:function(response){

                        // alert(main_cateid);

                        var len = response.length;



                        $("#ord_prd_typ").empty();

                        $("#ord_prd_typ").append("<option value=''>Select Product</option>");

                        for( var i = 0; i<len; i++){

                            var auto_id = response[i]['auto_id'];

                            var prd_name = response[i]['prd_name'];

                            $("#ord_prd_typ").append("<option value='"+auto_id+"'>"+prd_name+"</option>");

                            $('#ord_prd_typ').selectpicker('refresh');

                        }





                    }

                });

            });



        </script>

            <script type="text/javascript">

    

    function loadfile(x)

    {

         var url="functions/function_ajax.php?get_sub_categories=true";

                    $.post(url,{cat_id:x},function(data){

            $("#fil_data").html(data).show();

        });

        

    }

    

     function loadfile2(x)

    {

         var url="functions/function_ajax.php?get_items=true";

                    $.post(url,{sub_cat_id:x},function(data){

            $("#fil_data1").html(data).show();

        });

        

    }

    

    function reports_products_only_export(e) {
        e.preventDefault();

        var cat_id=$("#cat_id").val();
        var sub_cat=$("#sub_cat").val();
        var start_date=$("#start_date").val();
        var end_date=$("#end_date").val();
        var item=$("#item").val();
        var url="functions/function_excell.php?reports_products_only=yes&cat_id="+cat_id+"&sub_cat="+sub_cat+"&start_date="+start_date+"&end_date="+end_date+"&item="+item;
        window.open(url, '_blank');
    }

    </script>





    </body>

</html>