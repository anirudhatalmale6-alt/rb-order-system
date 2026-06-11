<?php
include('library/session_info.php');
$pagetitle = ' - Create Orders';

$pagedescr = ' ';

$pagekeywords = ' ';

include(INC_PATH . "system-info.php");

include(INC_PATH . "header.php");
?>
<style>
    /* DivTable.com */
    .divTable{
        display: table;
        width: 100%;
    }
    .divTableRow {
        display: table-row;
    }
    .divTableHeading {
        background-color: #EEE;
        display: table-header-group;
    }
    .divTableCell, .divTableHead {

        display: table-cell;
        padding: 3px 2px;
        width: 25%;
    }
    .divTableHeading {
        background-color: #EEE;
        display: table-header-group;
        font-weight: bold;
    }
    .divTableFoot {
        background-color: #EEE;
        display: table-footer-group;
        font-weight: bold;
    }
    .divTableBody {
        display: table-row-group;
    }
</style>
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
        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'success') {
                echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>File (Report_all.csv) Downloaded to "c:Report_all.csv"</b>
												</div>';
            }
            if ($status == 'failed') {
                echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												Error Occer! <b>User Details not Saved</b>
												</div>';
            }
            if($status=='succ')
            {
                echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Saved successfully!!</b>
												</div>';
            }
            if($status=='fail')
            {
                echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Saved unsuccessfully!!</b>
												</div>';
            }
            if($status=='8')
            {
                echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Order Canceled successfully!!</b>
												</div>';
            }
            if($status=='9')
            {
                echo '<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Unsuccessfull!!</b>
												</div>';
            }
            if($status=='edited')
            {
                echo '<div class="alert alert-success alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
													<i class="fa fa-close"></i>
												</button>
												<b>Order Edit successfully!!</b>
												</div>';
            }
        }
        ?>
         <div >
        <div class="row" id="ticketPrintArea">
            <div class="col-sm-12">
                <div class="card-box">
                    <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="250">
                        <thead>
                        <tr>
                            <th data-toggle="true">Invoice ID</th>
                            <th>Make Payment</th>
                            <th>Name</th>
                            <th data-hide="phone, tablet">Date of Delivery</th>
                            <th data-hide="phone, tablet">Total</th>
                            <th data-hide="phone, tablet">Status</th>
                            <th data-hide="phone, tablet">Balance</th>
                            <th data-hide="phone, tablet">Print</th>

                            <th data-hide="phone, tablet">Action</th>

                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        </thead>
                        <div class="form-inline m-b-20">
                            <div class="row">
                                <div class="col-sm-6 text-xs-center">
                                    <div class="form-group">
                                        <label class="control-label m-r-5">Status</label>
                                        <select id="demo-foo-filter-status" class="form-control input-sm">
                                            <option value="">Show all</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Due">Un Paid</option>
                                            <option value="Delivered">Delivered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-xs-center text-right">
                                    <div class="form-group">
                                        <input id="custom-foo-search" onkeypress="custom_search(event)" type="text" placeholder="Search" class="form-control input-sm" autocomplete="on">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <tbody id="load_order">
                        <?php
                        $ttt =null;
                        include("class/class_orders.php");

                        $prdct23=class_orders::select_all_from_inv_without_condi();
                        while($data23=mysqli_fetch_array($prdct23)){
                            $i=$data23['rox_inv_auto_id'];
                            $rox_inv_status=$data23['rox_inv_status'];
                            $rox_inv_balance=$data23['rox_inv_balance'];
                            $rox_inv_cus_id=$data23['rox_inv_cus_id'];
                            $rox_inv_authorization=$data23['rox_inv_authorization'];

                            $prdct233_=class_orders::select_all_from_cust($rox_inv_cus_id);
                            $data233=mysqli_fetch_array($prdct233_);
                            $cus_fname=$data233['cus_fname'];
                            $cus_address=$data233['cus_address'];


                            $prdct2=class_orders::seleect_all_from_odr_info($i);
                            while($data2=mysqli_fetch_array($prdct2)){

                                $rox_prd=$data2['rox_prd_val'];
                                $rox_line_id=$data2['rox_line_id'];
                                $rox_prd_name=$data2['rox_prd'];


                                $prdct2p=class_orders::seleect_all_from_product($rox_prd);
                                $data2p=mysqli_fetch_array($prdct2p);
                                $rox_prd_name1=$data2p['rox_prd_name'];

                                $rox_gre_des=$data2['rox_gre_des'];
                                $rox_gre=$data2['rox_gre'];
                                $rox_gre_info=$data2['rox_gre_info'];
                                $rox_gre_info2=$data2['rox_gre_info2'];
                                $rox_des=$data2['rox_des'];
                                $rox_ord_status=$data2['rox_ord_status'];

                                $bal=class_orders::select_all_from_payments($i);
                                $data_bal=mysqli_fetch_array($bal);
                                $rox_pay_status=$data_bal['rox_pay_status'];

                                $t_date='';
                                $f_date='';
                                $user_id='';

                                $ttt += $rox_inv_balance;
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        if ($rox_inv_authorization == 1){
                                            ?>
                                            <span id="authorized_<?php echo $i;?>" style="padding: 5px" class="label label-table label-success"><i style="font-size: 18px; font-weight: 900;" class="md md-done"></i></span>
                                            <?php
                                        }else{
                                            ?>
                                            <span id="authorized_<?php echo $i;?>" style="padding: 5px" class="label label-table label-success"></span>
                                            <?php
                                        } ?>
                                        <?php
                                        if ($admin_role == 'Admin' || $admin_role == 'Sales'){
                                            // echo '<a href="invoice?inv_code='.$i.'&from_date='.$f_date.'&to_date='.$t_date.'&user_id='.$user_id.'&p_status='.$rox_pay_status.'&d_status='.$rox_ord_status.'" target="_blank"  width=700 height=650 )">'.$i.' </a>';
                                            ?>
                                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=550,height=660',); return false;"  class="wm-default-btn"><span><?php echo $i;  ?></span></a>
                                            <?php
                                        }else {
                                            echo $i;
                                        }
                                        ?>


                                    </td>
                                    <td>
                                        <?php
                                       if ($admin_role == 'Admin' || $admin_role == 'Sales'){
                                        if($rox_pay_status != '0')
                                        {
                                            echo '<a href="#"  data-toggle="modal" data-target="#exampleModalLong'.$i.'">Make Payment</a>';

 ?> <br><br><a onclick="payment_full_Settled('<?= $i ?>','<?=$rox_inv_cus_id?>','<?=$rox_pay_status?>')"   href="#">Settle in full</a>
                                            <?php

                                        }
                                        }
                                        ?>
                                    </td>

                                    <td><?php echo $rox_prd_name;?></td>
                                    <td><?php echo $data23['rox_del_date'];?></td>
                                    <td><?php echo $rox_inv_balance;?></td>
                                    <?php
                                    if ($rox_ord_status == 'Pending'){$d='info';}
                                    if ($rox_ord_status == 'Cancelled'){$d='warning';}
                                    if ($rox_ord_status == 'Delivered'){ $d='success';}
                                    //                                                if($rox_pay_status == '0' && $rox_pay_status!='Cancelled'){}

                                    ?>
                                    <td>
                                        <?php
                                        if ($rox_pay_status == '0'){
                                            ?>
                                            <span class="label label-table label-success"><?php echo 'Delivered'?></span>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="label label-table label-<?php echo $d;?>"><?php echo $rox_ord_status;?></span>
                                            <?php
                                        }
                                        ?>

                                    </td>

                                    <td>
                                        <?php
                                        if ($rox_pay_status != '0'){
                                            $int = intval($rox_pay_status);
                                            if (is_integer($rox_pay_status))
                                            {
                                                echo '<span class="label label-table label-warning">'.number_format($rox_pay_status,2).' Due</span>';
                                            }
                                            else
                                            {
                                                echo '<span class="label label-table label-warning">'.number_format($rox_pay_status,2).' Due</span>';
                                            }

                                            // echo $rox_pay_status.'.00';
                                        }else{
                                            echo '<span class="label label-table label-success">Paid</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($admin_role == 'Admin' || $admin_role == 'Sales'){
                                            // echo '<a href="invoice?inv_code='.$i.'&from_date='.$f_date.'&to_date='.$t_date.'&user_id='.$user_id.'&p_status='.$rox_pay_status.'&d_status='.$rox_ord_status.'" target="_blank"  width=700 height=650 )">'.$i.' </a>';
                                            ?>
                                            <!--<a onclick="window.open('invoice?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span>Print</span></a>-->
                                            <a onclick="window.open('invoice?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=600,height=660',); return false;"  class="wm-default-btn"><span>Print</span></a>
                                        <?php }
                                        else {
                                            ?>
                                            <!--<a onclick="window.open('invoice?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"  class="wm-default-btn"><span>Print</span></a>-->
                                            <a onclick="window.open('invoice?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=600,height=660',); return false;"  class="wm-default-btn"><span>Print</span></a>
                                            <?php
                                        }
                                        ?>
                                        <hr style="margin: 0px; height: 1px; background-color: #cccccc"/>
                                        <?php
                                        if ($admin_role == 'Admin' || $admin_role == 'Sales'){
                                            // echo '<a href="invoice?inv_code='.$i.'&from_date='.$f_date.'&to_date='.$t_date.'&user_id='.$user_id.'&p_status='.$rox_pay_status.'&d_status='.$rox_ord_status.'" target="_blank"  width=700 height=650 )">'.$i.' </a>';
                                            ?>
                                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=550,height=660',); return false;"  class="wm-default-btn"><span>Print-A5</span></a>
                                            <?php
                                        }else {
                                            ?>
                                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $i;  ?>&from_date=<?php echo $f_date;  ?>&to_date=<?php echo $t_date;  ?>&user_id=<?php echo $user_id;  ?>&p_status=<?php echo $rox_pay_status;  ?>&d_status=<?php echo $rox_ord_status;  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=550,height=660',); return false;"  class="wm-default-btn"><span>Print-A5</span></a>
                                            <?php
                                        }
                                        ?>

                                    </td>

                                    <td>
                                        <a href="#"  data-toggle="modal" data-target="#editModal<?php echo $i;?>" >Edit Order</a><br>
                                        <a href="#"  data-toggle="modal" data-target="#exampleModal<?php echo $i;?>" >Cancel Order</a>
                                       <?php  if ($admin_role == 'Admin' || $admin_role == 'Sales'){ if ($rox_inv_authorization == 0){ ?>

                                           <br> <a href="#"  data-toggle="modal" data-target="#authorizedModal<?php echo $i;?>" id="authorized_link_<?php echo $i;?>" >Bill Authorize</a>
                                        <?php } } ?>
                                    </td>
                                </tr>
                                <div class="modal fade<?php echo $i;?>" id="exampleModalLong<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Make Payment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="functions/function_payment.php" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" name="invid" value="<?php echo $i;?>" hidden>
                                                        <input type="text" name="cusid" value="<?php echo $rox_inv_cus_id;?>" hidden>
                                                        <input type="text" id="Mbalance" name="balance" class="Mbalance" value="<?php echo $rox_pay_status;?>" hidden>
                                                        <label for="main_cate">Payment Type</label>
                                                        <!--                            <input type="text" name="type" parsley-trigger="change" required placeholder="Payment Type" class="form-control" id="main_cate">-->
                                                        <select class="form-control" name="type">
                                                            <option value="Cash">Cash</option>
                                                            <option value="Card">Card</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="main_cate_des">Payment</label>
                                                        <span style=" font-weight: normal;color: #f00">(Due Amount is: <?php echo $rox_pay_status;?>)</span>
                                                        <input type="text" name="payment"  required placeholder="Enter payment" class="form-control" id="Payment">
                                                        <!--                                                            <input type="text" name="payment" parsley-trigger="change" required placeholder="Enter payment" class="form-control" id="payment1" value="--><?php //echo $rox_pay_status?><!--">-->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary valSubmit" name="submit" id="valSubmit" onclick=" return validate(<?php echo $rox_pay_status;?>)">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade<?php echo $i;?>" id="exampleModal<?php echo$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">


                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>


                                            <form action="functions/function_payment.php" id="cancel_form<?php echo $i;?>" method="post">

                                                <div class="form-group">
                                                    <input type="text" name="invid" value="<?php echo $i;?>" hidden>
                                                    <img src="assets/site/images/Remove.png" style="margin-left: 202px;"/>
                                                    <h3 style="margin-left: 200px;">Are you sure?</h3>
                                                    <p style="margin-left: 169px;">You Want to Cancel The Order</p>
                                                    <label>Reason for Cancel</label>
                                                    <textarea class="form-control" id="cancel_reason<?php echo $i;?>" name="cancel_reason" required ></textarea>


                                                </div>


                                                <div class="modal-footer">
                                                    <input type="hidden" name="cancel_by"  value="<?php echo $roxwall_u_id; ?>"  readonly class="form-control" id="cancel_by">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" onclick="cancel_form_submit('<?php echo $i;?>')"  class="btn btn-danger "  name="new_cancel" id="new_cancel">Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade<?php echo $i;?>" id="authorizedModal<?php echo$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">


                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>



                                                <div class="form-group">
                                                    <input type="text" name="invid" value="<?php echo $i;?>" hidden>
                                                    <img src="assets/site/images/Remove.png" style="margin-left: 202px;"/>
                                                    <h3 style="margin-left: 200px;">Are you sure?</h3>
                                                    <p style="margin-left: 169px;">You Want to Authorized The Order</p>


                                                </div>


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" onclick="bill_authorized('<?php echo $i;?>')"  class="btn btn-danger " data-dismiss="modal"  name="" id="">Confirm</button>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade<?php echo $i;?>" id="editModal<?php echo$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg " role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit Order <?php echo $i;?> </h4>
                                            </div>


                                            <form action="functions/function_orders.php" method="post">

                                                <div class="form-group">
                                                    <input type="hidden" name="order_edit" value="1">
                                                    <input type="hidden" name="invoice[inv_id]" value="<?php echo $i;?>">
                                                    <input type="hidden" name="invoice[customer_id]" value="<?php echo $rox_inv_cus_id;?>">

<!--                                                    <table>-->
                                                    <?php $products=class_orders::seleect_all_from_odr_info2($i);
                                                    $k=0;
                                                    while($product=mysqli_fetch_array($products)) { ?>
                                                        <input type="hidden" name="order_info[<?= $k ?>][order_info_id]" value="<?php echo $product['rox_line_id'];?>">
                                                        <br>
                                                        <div class="divTableCell"><b><?php echo $product['rox_prd'] ?> - <?php echo $product['rox_prd_qty'] ?></b></div>
                                                            <hr>
                                                        <div class="divTable">
                                                            <div class="divTableBody">
                                                                <div class="divTableRow">


                                                                    <div class="divTableCell">
                                                                        <label>Description</label>
                                                                        <textarea name="order_info[<?= $k ?>][rox_gre_des]" class="form-control"><?php echo $product['rox_gre_des'] ?></textarea></div>
                                                                    <div class="divTableCell">
                                                                        <label>Greetings *</label>
                                                                        <select name="order_info[<?= $k ?>][rox_gre_info]"  class="form-control" data-live-search="true" id="odr_gre_info" data-style="btn-white">
                                                                            <option value="<?php echo $product['rox_gre_info'] ?>"><?php echo $product['rox_gre_info'] ?></option>
                                                                            <option value="">-None-</option>
                                                                            <option value="1st">1st</option>
                                                                            <option value="2nd">2nd</option>
                                                                            <option value="3rd">3rd</option>
                                                                            <option value="4th">4th</option>
                                                                            <option value="5th">5th</option>
                                                                            <option value="6th">6th</option>
                                                                            <option value="7th">7th</option><option value="8th">8th</option><option value="9th">9th</option><option value="10th">10th</option><option value="11th">11th</option><option value="12th">12th</option><option value="13th">13th</option><option value="14th">14th</option><option value="15th">15th</option><option value="16th">16th</option><option value="17th">17th</option><option value="18th">18th</option><option value="19th">19th</option><option value="20th">20th</option><option value="21st">21st</option><option value="22nd">22nd</option><option value="23rd">23rd</option><option value="24th">24th</option><option value="25th">25th</option><option value="26th">26th</option><option value="27th">27th</option><option value="28th">28th</option><option value="29th">29th</option><option value="30th">30th</option><option value="31st">31st</option><option value="32nd">32nd</option><option value="33rd">33rd</option><option value="34th">34th</option><option value="35th">35th</option><option value="36th">36th</option><option value="37th">37th</option><option value="38th">38th</option><option value="39th">39th</option><option value="40th">40th</option><option value="41st">41st</option><option value="42nd">42nd</option><option value="43rd">43rd</option><option value="44th">44th</option><option value="45th">45th</option><option value="46th">46th</option><option value="47th">47th</option><option value="48th">48th</option><option value="49th">49th</option><option value="50th">50th</option><option value="51st">51st</option><option value="52nd">52nd</option><option value="53rd">53rd</option><option value="54th">54th</option><option value="55th">55th</option><option value="56th">56th</option><option value="57th">57th</option><option value="58th">58th</option><option value="59th">59th</option><option value="60th">60th</option><option value="61st">61st</option><option value="62nd">62nd</option><option value="63rd">63rd</option><option value="64th">64th</option><option value="65th">65th</option><option value="66th">66th</option><option value="67th">67th</option><option value="68th">68th</option><option value="69th">69th</option><option value="70th">70th</option><option value="71st">71st</option><option value="72nd">72nd</option><option value="73rd">73rd</option><option value="74th">74th</option><option value="75th">75th</option><option value="76th">76th</option><option value="77th">77th</option><option value="78th">78th</option><option value="79th">79th</option><option value="80th">80th</option><option value="81st">81st</option><option value="82nd">82nd</option><option value="83rd">83rd</option><option value="84th">84th</option><option value="85th">85th</option><option value="86th">86th</option><option value="87th">87th</option><option value="88th">88th</option><option value="89th">89th</option><option value="90th">90th</option><option value="91st">91st</option><option value="92nd">92nd</option><option value="93rd">93rd</option><option value="94th">94th</option><option value="95th">95th</option><option value="96th">96th</option><option value="97th">97th</option><option value="98th">98th</option><option value="99th">99th</option><option value="100th">100th</option>                            </select>
                                                                    </div>
                                                                    <div class="divTableCell">
                                                                        <label>Greetings *</label>
                                                                        <select name="order_info[<?= $k ?>][rox_gre]"  class="form-control" data-live-search="true" id="odr_gre" data-style="btn-white">
                                                                            <option value="<?php echo $product['rox_gre'] ?>"><?php echo $product['rox_gre'] ?></option>
                                                                            <option value="">-None-</option>
                                                                            <option value="Happy Birthday">Happy Birthday</option>
                                                                            <option value="Happy Anniversary">Happy Anniversary </option>
                                                                            <option value="Happy Holy Communion">Happy Holy Communion</option>
                                                                            <option value="Congratulations">Congratulations </option>
                                                                            <option value="Happy Valentines Day">Happy Valentine's Day </option>
                                                                        </select>
                                                                       </div>

                                                                    <div class="divTableCell">
                                                                        <label>Greetings </label>
                                                                        <input name="order_info[<?= $k ?>][rox_gre_info2]" class="form-control" value="<?php echo $product['rox_gre_info2'] ?>" type="text"></div>

                                                                </div>
                                                            </div>
                                                        </div>



                                                    <?php  $k++;  } ?>
                                                    <div class="divTableCell">
                                                        <label>Manufacture Date </label>
                                                        <input min="<?= date('Y-m-d')?>" class="form-control" name="invoice[rox_inv_due]" value="<?php echo $data23['rox_inv_due'];?>" type="date"></div>
                                                    
                                                    <div class="divTableCell">
                                                        <label>Delivery Date </label>
                                                        <input min="<?= date('Y-m-d')?>" class="form-control" name="invoice[delivery_date]" value="<?php echo $data23['rox_del_date'];?>" type="date"></div>
                                                    <div class="divTableCell">
                                                        <label>Delivery Time</label>
                                                        <input class="form-control" name="invoice[delivery_time]" value="<?php echo $data23['rox_inv_time'];?>" type="time"></div>
                                                    <div class="divTableCell">
                                                        <label>Delivery Address</label>
                                                        <input class="form-control" name="invoice[delivery_address]" value="<?php echo $cus_address;?>" type="text"></div>
                                                </div>


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info " >Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php }}?>

                        <div class="col-md-2">
                            <div class="form-group">
                                <?php  if ($admin_role == 'Admin' || $admin_role == 'Sales'){ ?>
                                <a href="javascript:void(0);" class="btn btn-inverse waves-effect waves-light printid" id="btnPrint"><i class="fa fa-print"></i> Print Reoprt</a>
                                <?php  } ?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">


                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               <?php  if ($admin_role == 'Admin' || $admin_role == 'Sales'){ ?>
                                <a class="btn btn-inverse waves-effect waves-light printid" onclick="window.open('bill-authorized','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',); return false;"><i class="glyphicon glyphicon-pawn"></i>Bill Authorized</a>
                               <?php  } ?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="odr_adv" class="control-label">Total Amount</label>

                            </div>
                        </div>
                        <div class="col-md-1" >
                            <div class="form-group">

                                <input type="text" name="" class="form-control" disabled value="<?php echo $ttt;?>">
                            </div>
                        </div>



                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="text-right">
                                    <!-- <ul class="pagination pagination-split m-t-30 m-b-0"></ul> -->
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
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


<script src="assets/site/js/jquery.print.min.js"></script>
<script src="assets/site/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script src="assets/site/pages/jquery.sweet-alert.init.js"></script>
<script>
    function validate(id)
    {
        var vall=id;
        var val = $('input[name=payment]').val();
        if(val > vall)
        {
            alert("Not more than" +vall+".");
            return false
        }
        return true;
    }
</script>
<script>
    jQuery(function($) {
        'use strict';


        $("#ticketPrintArea").find('#btnPrint').on('click', function() {
            //Print ele4 with custom options
            $("#ticketPrintArea").print({
                //Use Global styles
                globalStyles : true,
                //Add link with attrbute media=print
                mediaPrint : false,
                //Custom stylesheet
                // stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
                //Print in a hidden iframe
                iframe : false,
                //Don't print this
                noPrintSelector : ".avoid-this",
                //Add this at top
                // prepend : "Hello World!!!<br/>",
                //Add this on bottom
                //append : "<br/>Buh Bye!",
                //Log to console when printing is done via a deffered callback
                deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
            });
        });
        // Fork https://github.com/sathvikp/jQuery.print for the full list of options
    });


    //            $('#Payment').keyup(function(){
    //                var vall=$('#payment1').val();
    ////                alert(vall);
    //                if ($(this).val() > vall ){
    //                    alert("No numbers above Balance Amount");
    //                    $(this).val(vall);
    //                }
    //            });


    // function cancel_form_submit(form) {
    //     alert(form);
    //     form.PreventDefault();

    // }

</script>

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



<!--        <script src="assets/site/pages/jquery.form-pickers.init.js"></script>-->

<script>
    $("#product_name").on('change',function(){
        //var frm_call = 'load_price';
        //alert (frm_call);
        $("#odr_price").empty();
        var p_id = $(this).val();
        $.ajax({
            url: 'functions/function_orders.php',
            type: 'post',
            data: {
                pr_id :p_id,
            },
            dataType: 'json',
            success:function(response){
                $("#odr_price").val(response);
            }
        });
    });
</script>
<script>
    //        $(document).on('click','valSubmit', function(){
    //
    //
    //            var bal =  $(this).closest("form").find(".Mbalance").val();
    //            var pay =  $(this).closest("form").find(".Payment").val();
    //            alert(bal);
    ////            if( pay < bal  ){
    ////                alert("Not more than" + bal +".");
    ////            }
    //        });


   function cancel_form_submit(id) {
       var cancel_reason=$("#cancel_reason"+id).val();
        if(cancel_reason==''){
            alert("Cancel Reason is Required ");
        }else{
            $("#cancel_form"+id).submit();
            //alert("Cancel Reason is "+cancel_reason);
        }

    }

    function bill_authorized(inv_id) {
        $.ajax({
            url: 'functions/function_orders.php',
            type: 'post',
            data: {
                inv_id :inv_id,bill_authorized:1
            },
            dataType: 'json',
            success:function(response){
                window.open('bill-authorized','My Win','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=0,width=450,height=660',);
                $("#authorized_"+inv_id).html("<i style='font-size: 18px; font-weight: 900;' class='md md-done'></i>");
                $("#authorized_link_"+inv_id).hide();
                $("#authorized_"+inv_id).removeClass("label-info");
                $("#authorized_"+inv_id).addClass("label-success");
            }
        });

        return true;
    }

    // setInterval(function(){

    //     $.ajax({
    //         url: '/manage_orders_ajax',
    //         type: 'post',
    //         success:function(response){
    //             $("#load_order").html(response);

    //         }
    //     });
    // }, 20000);

        function payment_full_Settled(invid,cusid,pay) {


       var balance=pay;
       var type='Cash';
       var payment=pay
       var submit='';
        //
        $.ajax({
            url: '/functions/function_payment.php',
            type: 'post',
            data:{invid:invid,cusid:cusid,balance:balance,type:type,payment:payment,submit:submit},
            success:function(response){
                window.open("../slip?inv_code="+invid+"&paid="+payment+"&bala="+balance,"newwindow","width=450,height=660");
                location.reload();

            }
        });
       }


         function custom_search(event) {
           if(event.keyCode==13){
               var inv_id=$("#custom-foo-search").val();
               $.ajax({
                   url: '/manage_orders_search_ajax',
                   type: 'post',
                   data:{inv_id:inv_id},
                   success:function(response){
                       $("#load_order").html(response);

                   }
               });
           }

       }
</script>



</body>
</html>