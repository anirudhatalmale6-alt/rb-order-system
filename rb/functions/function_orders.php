<?php

include('../class/class_orders.php');

if (isset($_POST["paracall"])) {

    if ($_POST["paracall"] == "add_to") {
        $date = date("Y-m-d");

        $ord_inid = $_POST['ord_inid'];
        $ord_p_m_typ = $_POST['ord_p_m_typ'];
        $ord_p_s_typ = $_POST['ord_p_s_typ'];
        $ord_prd_name = $_POST['ordvalodr_name'];
        $ord_prd_val = $_POST['ord_prd_typ'];
        $dis_status = $_POST['dis_status'];
        $odr_price = $_POST['odr_price'];
        $odr_qty = $_POST['odr_qty'];
        $tot = $odr_price * $odr_qty;
        $odr_gre_des = $_POST['odr_gre_des'];
        $odr_gre = $_POST['odr_gre'];
        $odr_gre_info = $_POST['odr_gre_info'];
        $odr_gre_info2 = $_POST['odr_gre_info2'];
        $ord_status = $_POST['ord_status'];
        $ord_desc = '';
        $odr_id_p = $_POST['odr_id_p'];

        $rst_find = class_orders::check_order_info($ord_inid, $ord_prd_val);
        if ($rst_find == 1) {
            class_orders::update_into_order_info($ord_inid, $ord_prd_val, $odr_qty);
        } else {
            class_orders::insert_into_order_info($odr_id_p, $ord_inid, $ord_p_m_typ, $ord_p_s_typ, $ord_prd_name, $ord_prd_val, $odr_price, $odr_qty, $tot, $odr_gre_des, $odr_gre, $odr_gre_info, $odr_gre_info2, $dis_status, $ord_status, $ord_desc, $date);
        }

        $rst_ord_info = class_orders::select_order_info($ord_inid);
        $ord_arr = [];

        while ($row = mysqli_fetch_array($rst_ord_info)) {
            $ord_arr[] = [
                "dis_status" => $row['rox_discount_status'],
                "ord_id" => $row['rox_ord_id'],
                "prd" => $row['rox_prd'],
                "des" => $row['rox_gre_des'],
                "prd_qty" => $row['rox_prd_qty'],
                "prd_price" => $row['rox_prd_price'],
                "rox_gre" => $row['rox_gre_info'],
                "rox_gre1" => $row['rox_gre'],
                "rox_gre2" => $row['rox_gre_info2'],
            ];
        }
        echo json_encode($ord_arr);
    }

    if ($_POST["paracall"] == "delete_from") {
        $ord_inid = $_POST['ord_inid'];
        $ord_id = $_POST['ord_id'];

        class_orders::delete_order_info($ord_inid, $ord_id);

        $rst_ord_info = class_orders::select_order_info($ord_inid);
        $ord_arr = [];

        while ($row = mysqli_fetch_array($rst_ord_info)) {
            $ord_arr[] = [
                "dis_status" => $row['rox_discount_status'],
                "ord_id" => $row['rox_ord_id'],
                "prd" => $row['rox_prd'],
                "des" => $row['rox_gre_des'],
                "rox_gree1" => $row['rox_gre'],
                "rox_gree" => $row['rox_gre_info'],
                "rox_gree2" => $row['rox_gre_info2'],
                "prd_qty" => $row['rox_prd_qty'],
                "prd_price" => $row['rox_prd_price'],
            ];
        }
        echo json_encode($ord_arr);
    }
}

if (isset($_POST["print_order"])) {

    $temp_inv_id = $_POST['inv_id'];

    $mobile = $_POST['mobile'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $tele = $_POST['tele'] ?? '';
    $cuid = $_POST['cusid'];
    $datee = $_POST['d_delivery'];
    $time = $_POST['time'];
    date_default_timezone_set("Asia/Kolkata");
    $date = date('Y-m-d');

    $ord_by = $_POST["ord_by"];
    $pay_type = $_POST["pay_type_odr"];
    $odr_date = $_POST["odr_date"];
    $datei = date('Y-m-d', strtotime($odr_date));
    $odr_dis = $_POST["odr_dis"] ?? 0;
    $odr_adv = $_POST["odr_adv"] ?? 0;
    $odr_del_chrge = $_POST["odr_del_chrge"] ?? 0;
    $odr_sr_chrge = $_POST["odr_sr_chrge"] ?? 0;
    $odr_pay_bal = 1000;
    $tot = $_POST['tot'];

    // Generate real invoice ID atomically
    $real_inv_id = class_orders::generate_invoice_id();

    // Update all temp order items to use the real invoice ID
    class_orders::update_temp_invoice_id($temp_inv_id, $real_inv_id);

    $inv_id = $real_inv_id;

    // Calculate totals with discount logic
    $sum = 0;
    $sum2 = 0;
    $get_product_dis_status = class_orders::get_product_dis_status1($inv_id);
    while ($row = mysqli_fetch_array($get_product_dis_status)) {
        $sum += $row['rox_prd_price'] * $row['rox_prd_qty'];
    }

    $get_product_dis_status = class_orders::get_product_dis_status0($inv_id);
    while ($row = mysqli_fetch_array($get_product_dis_status)) {
        $sum2 += $row['rox_prd_price'] * $row['rox_prd_qty'];
    }

    $odr_dis_val = is_numeric($odr_dis) ? (float)$odr_dis : 0;
    $a11 = $sum * ($odr_dis_val / 100);
    $a12 = $sum - $a11;
    $a23 = $sum2;
    $a34 = $a12 + $a23;

    $odr_del_val = is_numeric($odr_del_chrge) ? (float)$odr_del_chrge : 0;
    $odr_sr_val = is_numeric($odr_sr_chrge) ? (float)$odr_sr_chrge : 0;
    $odr_adv_val = is_numeric($odr_adv) ? (float)$odr_adv : 0;

    $finall = $a34 + $odr_del_val;
    $finall1 = ($odr_sr_val / 100) * $a34;
    $fina = ($finall + $finall1) - $odr_adv_val;

    // Customer handling
    if (!empty($cuid)) {
        $mobile_check = class_orders::select_all_cus_where_mobile($cuid);
        $cou = mysqli_num_rows($mobile_check);
        if ($cou >= 1) {
            $data22 = mysqli_fetch_array($mobile_check);
            $cus_id = $data22['cus_id'];
            class_orders::update_customer($cuid, $fname, $lname, $address, $tele, $mobile);
        } else {
            class_orders::insert_into_customers($fname, $lname, $email, $address, $tele, $mobile, $date);
            $cus_id = class_orders::select_all_cus_where_last();
        }
    } else {
        class_orders::insert_into_customers($fname, $lname, $email, $address, $tele, $mobile, $date);
        $cus_id = class_orders::select_all_cus_where_last();
    }

    class_orders::insert_into_payments($inv_id, $cus_id, $pay_type, $odr_dis_val, $odr_adv_val, $odr_pay_bal, $odr_del_val, $odr_sr_val, $fina, $date);
    $rox_payment_id = class_orders::select_all_pay();

    $result = class_orders::insert_into_invoice($inv_id, $cus_id, $rox_payment_id, $datei, $datee, $time, $tot, $ord_by);

    // Update product discount calculations
    $select_product = class_orders::select_from_product($inv_id);
    while ($pro_row = mysqli_fetch_array($select_product)) {
        $status = $pro_row['rox_discount_status'];
        $per_price = $pro_row['rox_prd_price'];
        $pro_qty = $pro_row['rox_prd_qty'];
        $prod_name = $pro_row['rox_prd'];
        if ($status == 1) {
            $pro_tot = $per_price * $pro_qty;
            $cal_tot1 = $pro_tot * ($odr_dis_val / 100);
            $cal_tot = $pro_tot - $cal_tot1;
            class_orders::update_prod($inv_id, $prod_name, $odr_dis_val, $cal_tot);
        }
        if ($status == 0) {
            $pro_tot = $per_price * $pro_qty;
            $cal_tot = $pro_tot;
            class_orders::update_prod1($inv_id, $prod_name, 0, $cal_tot);
        }
    }

    if ($result == 2) {
        echo '<script type="text/javascript">window.open("../invoice-A5?inv_code=' . $inv_id . '","newwindow","width=450,height=660");</script>';
        echo '<script type="text/javascript">window.location="../add-order?status=success";</script>';
    } else {
        echo '<script type="text/javascript">window.location="../add-order?status=failed";</script>';
    }
}

if (isset($_POST["edit_orders"])) {

    $e_order_id = $_POST['e_order_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $tele = $_POST['tele'];
    $mobile = $_POST['mobile'];

    $product_name = $_POST['product_name'];
    $chef_name = $_POST['chef_name'];
    $desc = $_POST['desc'];
    $odr_price = $_POST['odr_price'];
    $adv = $_POST['adv'];
    $dis = $_POST['dis'];
    $price_dis = $_POST['price_dis'];
    $delivery_chrge = $_POST['delivery_chrge'];
    $service_chrge = $_POST['service_chrge'];
    $greeting = $_POST['greeting'];
    $qty = $_POST['qty'];
    $d_delivery = $_POST['d_delivery'];
    $order_status = $_POST['order_status'];

    $cus_id = $_POST['cus_id'];
    $date = date("Y-m-d H:i:s");

    $result = class_orders::update_into_cus($cus_id, $fname, $lname, $email, $address, $tele, $mobile);
    $result = class_orders::update_into_order($e_order_id, $product_name, $chef_name, $desc, $odr_price, $adv, $dis, $price_dis, $delivery_chrge, $service_chrge, $greeting, $qty, $d_delivery, $order_status, $date);
    if ($result == 2) {
        echo '<script type="text/javascript">window.location="../add-order?status=success";</script>';
    } else {
        echo '<script type="text/javascript">window.location="../add-order?status=failed";</script>';
    }
}

if (isset($_GET["delete_order"])) {
    $result = class_orders::delete_from_order($_GET['delete_order']);
    if ($result == 2) {
        echo '<script type="text/javascript">window.location="../add-order?status=Deleted";</script>';
    } else {
        echo '<script type="text/javascript">window.location="../add-order?status=failed";</script>';
    }
}

if (isset($_GET["edit_order"])) {
    $result = class_orders::get_from_order($_GET['edit_order']);
}

if (isset($_POST["pr_id"])) {
    $pr_id = $_POST['pr_id'];
    $result = class_orders::select_all_from_product1($pr_id);
    $sql = mysqli_fetch_array($result);
    $pri = $sql['rox_prd_price'];
    echo json_encode($pri);
}

if (isset($_POST["cus_id"])) {
    $cus_id = $_POST['cus_id'];
    $result = class_orders::select_all_from_cus($cus_id);
    $sql = mysqli_fetch_array($result);

    $cus_info[] = [
        "cus_mobile" => $sql['cus_mobile'],
        "cus_fname" => $sql['cus_fname'],
        "cus_title" => $sql['cus_title'],
        "cus_land" => $sql['cus_land'],
        "cus_address" => $sql['cus_address'],
        "cus_email" => $sql['cus_email'],
    ];

    echo json_encode($cus_info);
}

if (isset($_POST["order_edit"])) {
    $invoice = $_POST['invoice'];
    $order_info = $_POST['order_info'];

    class_orders::update_invoice_delivery_details($invoice['inv_id'], $invoice['rox_inv_due'], $invoice['delivery_date'], $invoice['delivery_time']);
    class_orders::update_customer_delivery_details($invoice['customer_id'], $invoice['delivery_address']);

    foreach ($order_info as $order) {
        class_orders::update_order_info($order['order_info_id'], $order['rox_gre_des'], $order['rox_gre_info'], $order['rox_gre'], $order['rox_gre_info2']);
    }

    echo '<script type="text/javascript">window.location="../manage_orders?status=edited";</script>';
}

if (isset($_POST["bill_authorized"])) {
    $inv_id = $_POST['inv_id'];
    $result = class_orders::update_invoice_bill_authorized($inv_id);
    echo json_encode(["msg" => $result]);
}

if (isset($_GET['get_costomer'])) {
    $data_cus = [];
    $prdct = class_orders::select_all_cus_auto($_GET['term']);
    while ($data = mysqli_fetch_array($prdct)) {
        $data_cus[] = ["value" => $data['cus_fname'], "label" => $data['cus_fname'], "cus_id" => $data['cus_id']];
    }
    echo json_encode($data_cus);
}

?>
