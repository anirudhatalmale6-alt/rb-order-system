<div class="row" id="ticketPrintArea">
    <div class="col-sm-12">
        <div class="card-box">
            <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0" data-page-size="250">
                <thead>
                <tr>
                    <th data-toggle="true">Invoice ID</th>
                    <th>Name</th>
                    <th data-hide="phone, tablet">Date of Delivery</th>
                    <th data-hide="phone, tablet">Total</th>
                    <th data-hide="phone, tablet">Status</th>
                    <th data-hide="phone, tablet">Balance</th>
                    <th data-hide="phone, tablet">Print</th>

                    <th data-hide="phone, tablet">Action</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $status_color=array("Pending"=>'info',"Cancelled"=>'warning',"Delivered"=>'success');
                include("class/class_orders.php");
                $invoices=class_orders::select_all_authorized_from_inv_limit(10);
                while($invoice=mysqli_fetch_array($invoices)){
                    $product=class_orders::get_invoice_all_products($invoice['rox_inv_auto_id']);
                    $payments=class_orders::get_invoice_payments($invoice['rox_inv_auto_id']);
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
                        <td><?= $invoice['rox_inv_auto_id']; ?></td>
                        <td><?= $product['rox_prd']?></td>
                        <td><?= $invoice['rox_del_date']; ?></td>
                        <td><?= $invoice['rox_inv_balance']; ?></td>
                        <td><span class="label label-table label-<?= $status_color[$invoice['rox_inv_status']]; ?>"><?php echo $invoice['rox_inv_status'];?></span> </td>
                        <td><span class="label label-table label-<?= $span_class ?>"><?php echo $rox_pay_status." ".$due_text;?></span></td>
                        <td> <a onclick="window.open('invoice-A5?inv_code=<?php echo $invoice['rox_inv_auto_id'];  ?>&','My Win','toolbar=no,location=no,addressbar=no,titlebar=no,status=no,menubar=no,scrollbars=yes,directories=no,resizable=0,width=550,height=660',); return false;"  class="wm-default-btn"><span>Print-A5</span></a></td>
                        <td> <a href="#" onclick="open_modal('<?= $invoice['rox_inv_auto_id']; ?>')"  id="authorized_link_<?php echo $invoice['rox_inv_auto_id'];?>" >Bill Authorize</a></td>
                    </tr>
                <?php } ?>
                </tbody>
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
