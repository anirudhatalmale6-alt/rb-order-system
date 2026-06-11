
                <?php
                $status_color=array("Pending"=>'info',"Cancelled"=>'warning',"Delivered"=>'success');
                include("class/class_orders.php");
                $invoices=class_orders::search_from_inv_limit($_POST['inv_id']);
                while($invoice=mysqli_fetch_array($invoices)){
                    $product=class_orders::get_invoice_all_products($invoice['rox_inv_auto_id']);
                    $payments=class_orders::get_invoice_payments($invoice['rox_inv_auto_id']);
                    $rox_inv_cus_id=$invoice['rox_inv_cus_id'];
                    $rox_inv_authorization=$invoice['rox_inv_authorization'];

                    $custQ=class_orders::select_all_from_cust($rox_inv_cus_id);
                    $cust=mysqli_fetch_array($custQ);
                    $cus_fname=$cust['cus_fname'];
                    $cus_address=$cust['cus_address'];

                    $i=$invoice['rox_inv_auto_id'];
                    if($payments['rox_pay_status']==0){
                        $rox_pay_status='Paid';
                        $span_class="success";
                        $due_text=" ";
                    }else{
                        $rox_pay_status=$payments['rox_pay_status'];
                        $span_class="warning";
                        $due_text="Due";
                    }
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
                            <?= $invoice['rox_inv_auto_id']; ?>
                        </td>
                        <td>
                            <?php

                                if($rox_pay_status != '0')
                                {
                                    echo '<a href="#"  data-toggle="modal" data-target="#exampleModalLong'.$i.'">Make Payment</a>';

                                    ?> <br><br><a onclick="payment_full_Settled('<?= $i ?>','<?=$rox_inv_cus_id?>','<?=$rox_pay_status?>')"   href="#">Settle in full</a>
                                    <?php

                                }

                            ?>
                        </td>
                        <td><?= $product['rox_prd']?></td>
                        <td><?= $invoice['rox_del_date']; ?></td>
                        <td><?= $invoice['rox_inv_balance']; ?></td>
                        <td><span class="label label-table label-<?= $status_color[$invoice['rox_inv_status']]; ?>"><?php echo $invoice['rox_inv_status'];?></span> </td>
                        <td><span class="label label-table label-<?= $span_class ?>"><?php echo $rox_pay_status." ".$due_text;?></span></td>
                        <td>
                            <a onclick="window.open('invoice?inv_code=<?php echo $invoice['rox_inv_auto_id'];  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=550,height=660',); return false;"  class="wm-default-btn"><span>Print</span></a><br>
                            <a onclick="window.open('invoice-A5?inv_code=<?php echo $invoice['rox_inv_auto_id'];  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=550,height=660',); return false;"  class="wm-default-btn"><span>Print-A5</span></a>
                        </td>
                        <td>
                            <a href="#"  data-toggle="modal" data-target="#editModal<?php echo $i;?>" >Edit Order</a><br>
                            <a href="#"  data-toggle="modal" data-target="#exampleModal<?php echo $i;?>" >Cancel Order</a><br>
                            <?php  if ($rox_inv_authorization == 0){ ?>

                            <a href="#"  data-toggle="modal" data-target="#authorizedModal<?php echo $i;?>" id="authorized_link_<?php echo $i;?>" >Bill Authorize</a>
                            <?php  } ?>
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
                                                print_r($cust);
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
                                                    <input min="<?= date('Y-m-d')?>" class="form-control" name="invoice[rox_inv_due]" value="<?php echo $invoice['rox_inv_due'];?>" type="date"></div>

                                                <div class="divTableCell">
                                                    <label>Delivery Date </label>
                                                    <input min="<?= date('Y-m-d')?>" class="form-control" name="invoice[delivery_date]" value="<?php echo $invoice['rox_del_date'];?>" type="date"></div>
                                                <div class="divTableCell">
                                                    <label>Delivery Time</label>
                                                    <input class="form-control" name="invoice[delivery_time]" value="<?php echo $invoice['rox_inv_time'];?>" type="time"></div>
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

                        </td>
                    </tr>


                <?php } ?>
<script>
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
</script>