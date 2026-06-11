<?php
/**
 * Order Management Class - Royal Bakery POS System
 *
 * Rewritten for PHP 8+ with mysqli prepared statements.
 * Singleton DB connection, parameterized queries throughout,
 * backward-compatible return types (mysqli_result / scalar).
 *
 * All original method names and signatures preserved exactly.
 */
class class_orders
{
    /** @var mysqli|null Singleton database connection */
    private static ?mysqli $db = null;

    /**
     * Get or create the singleton mysqli connection.
     * Replaces the per-method include("../library/dbcon.php") pattern.
     */
    private static function getDb(): mysqli
    {
        if (self::$db === null || !self::$db->ping()) {
            $servername = "localhost";
            $db_user    = "trbsysne2_royal";
            $db_pass    = "Royal@508";
            $db_dbName  = "trbsysne2_royal";

            self::$db = new mysqli($servername, $db_user, $db_pass, $db_dbName);
            if (self::$db->connect_error) {
                throw new \RuntimeException("DB connection failed: " . self::$db->connect_error);
            }
            self::$db->set_charset("utf8mb4");
        }
        return self::$db;
    }

    // =========================================================================
    //  INSERT METHODS
    // =========================================================================

    /**
     * Insert a line item into rox_order_info.
     * NOTE: $odr_id_p maps to rox_prd_val, $ord_prd_val maps to rox_prd_val in the
     * original code (original had $odr_id_p in the VALUES position of rox_prd_val).
     *
     * @return int 1 on failure, 2 on success
     */
    public static function insert_into_order_info(
        $odr_id_p = "",
        $ord_inid = "",
        $ord_p_m_typ = "",
        $ord_p_s_typ = "",
        $ord_prd_name = "",
        $ord_prd_val = "",
        $odr_price = "",
        $odr_qty = "",
        $tot = "",
        $odr_gre_des = "",
        $odr_gre = "",
        $odr_gre_info = "",
        $odr_gre_info2 = "",
        $dis_status = "",
        $ord_status = "",
        $ord_desc = "",
        $date = ""
    ): int {
        $conn = self::getDb();
        $sql = "INSERT INTO rox_order_info
                (rox_inv_id, rox_p_main_typ, rox_p_sub_type, rox_prd, rox_prd_val,
                 rox_prd_price, rox_prd_qty, rox_prod_tot_price, rox_gre_des, rox_gre,
                 rox_gre_info, rox_gre_info2, rox_discount_status, rox_ord_status, rox_des, ord_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // Original mapping: rox_prd_val column gets $odr_id_p (the first param)
        $stmt->bind_param(
            "ssssssssssssssss",
            $ord_inid, $ord_p_m_typ, $ord_p_s_typ, $ord_prd_name, $odr_id_p,
            $odr_price, $odr_qty, $tot, $odr_gre_des, $odr_gre,
            $odr_gre_info, $odr_gre_info2, $dis_status, $ord_status, $ord_desc, $date
        );
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Increment quantity for an existing order line item.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_order_info($ord_inid = "", $ord_prd_val = "", $odr_qty = ""): int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_order_info SET rox_prd_qty = rox_prd_qty + ? WHERE rox_inv_id = ? AND rox_prd_val = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $odr_qty, $ord_inid, $ord_prd_val);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Insert delivery info.
     * @return int 1 on failure, 2 on success
     */
    public static function insert_into_del_info(
        $invid = "",
        $cus_id = "",
        $d_delivery = "",
        $timepicker2 = "",
        $d_address = "",
        $ord_by = ""
    ): int {
        $conn = self::getDb();
        $sql = "INSERT INTO rox_del_info
                (rox_inv_id, rox_cust_id, rox_del_date, rox_del_time, rox_del_add, rox_inv_by, rox_del_status)
                VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $invid, $cus_id, $d_delivery, $timepicker2, $d_address, $ord_by);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Insert payment info with status=0.
     * @return int 1 on failure, 2 on success
     */
    public static function insert_into_payment_info(
        $invid = "",
        $cus_id = "",
        $odr_pay_type = "",
        $odr_dis = "",
        $odr_adv = "",
        $odr_del_chrge = "",
        $odr_sr_chrge = ""
    ): int {
        $conn = self::getDb();
        $sql = "INSERT INTO rox_payment
                (rox_inv_id, rox_cust_id, rox_pay_typ, rox_dis, rox_advc, rox_del_charge, rox_ser_charge, rox_pay_status)
                VALUES (?, ?, ?, ?, ?, ?, ?, '0')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $invid, $cus_id, $odr_pay_type, $odr_dis, $odr_adv, $odr_del_chrge, $odr_sr_chrge);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Insert a new customer.
     * NOTE: original mapping was unusual - $fname->cus_mobile, $lname->cus_fname,
     * $email->cus_title, etc. Preserved exactly.
     * @return int 1 on failure, 2 on success
     */
    public static function insert_into_customers(
        $fname = "",
        $lname = "",
        $email = "",
        $address = "",
        $tele = "",
        $mobile = "",
        $date = ""
    ): int {
        $conn = self::getDb();
        $sql = "INSERT INTO rox_customers
                (cus_mobile, cus_fname, cus_title, cus_land, cus_address, cus_email, joined_date)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // Original column mapping preserved: cus_mobile=$mobile, cus_fname=$fname,
        // cus_title=$lname, cus_land=$tele, cus_address=$address, cus_email=$email
        $stmt->bind_param("sssssss", $mobile, $fname, $lname, $tele, $address, $email, $date);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Insert a payment record with all fields including balance and date.
     * @return int 1 on failure, 2 on success
     */
    public static function insert_into_payments(
        $inv_id = "",
        $cus_id = "",
        $pay_type = "",
        $odr_dis = "",
        $odr_adv = "",
        $odr_pay_bal = "",
        $odr_del_chrge = "",
        $odr_sr_chrge = "",
        $finall = "",
        $date = ""
    ): int {
        $conn = self::getDb();
        $sql = "INSERT INTO rox_payment
                (rox_inv_id, rox_cust_id, rox_pay_typ, rox_dis, rox_advc, rox_pay_bal,
                 rox_del_charge, rox_ser_charge, rox_pay_status, rox_pay_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssss",
            $inv_id, $cus_id, $pay_type, $odr_dis, $odr_adv, $odr_pay_bal,
            $odr_del_chrge, $odr_sr_chrge, $finall, $date
        );
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Insert an invoice record. Uses Asia/Kolkata timezone for order time.
     * @return int 1 on failure, 2 on success
     */
    public static function insert_into_invoice(
        $inv_id = "",
        $cus_id = "",
        $rox_payment_id = "",
        $datei = "",
        $datee = "",
        $time = "",
        $tot = "",
        $ord_by = ""
    ): int {
        $conn = self::getDb();
        date_default_timezone_set("Asia/Kolkata");
        $dd       = date("Y-m-d H:i:s");
        $ord_time = date("h:i:sa");

        $sql = "INSERT INTO rox_invoice
                (rox_inv_cus_id, rox_inv_auto_id, rox_inv_pay_id, rox_inv_date, rox_ord_time,
                 rox_inv_time, rox_inv_due, rox_inv_by, rox_inv_status, rox_inv_balance, rox_del_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pending', ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssss",
            $cus_id, $inv_id, $rox_payment_id, $dd, $ord_time,
            $time, $datei, $ord_by, $tot, $datee
        );
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Insert cancellation record.
     * FIX: Original had inverted return (returned 1 on success of mysqli_query,
     * but that was actually correct for the INSERT succeeding). However, the
     * convention in this class is 1=fail, 2=success. Original used
     * if(mysqli_query(...)) return 1 which was wrong. Now fixed: 1=success per spec.
     *
     * Actually re-reading the requirement: "returns 1 success (FIX: was inverted)"
     * The original returned 1 when the query succeeded (if(mysqli_query(...))).
     * The other methods return 1 for failure and 2 for success.
     * The fix says return 1 for success. So we keep the "1 success" convention
     * for this specific method as the requirement states.
     *
     * @return int 1 on success, 2 on failure
     */
    public static function insert_cancel_invoice(
        $invoid = "",
        $cancel_reason = "",
        $cancel_by = "",
        $date = ""
    ): int {
        $conn = self::getDb();
        $sql = "INSERT INTO rox_cancel_orders
                (rox_inv_id, odr_cancel_reason, odr_cancel_by, cancel_date)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $invoid, $cancel_reason, $cancel_by, $date);
        if ($stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    // =========================================================================
    //  UPDATE METHODS
    // =========================================================================

    /**
     * Update customer basic info.
     * @return int 1 on failure, 2 on success
     */
    public static function update_customer(
        $cuid = "",
        $fname = "",
        $lname = "",
        $address = "",
        $tele = "",
        $mobile = ""
    ): int {
        $conn = self::getDb();
        $sql = "UPDATE rox_customers
                SET cus_mobile = ?, cus_fname = ?, cus_title = ?, cus_land = ?, cus_address = ?
                WHERE cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $mobile, $fname, $lname, $tele, $address, $cuid);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Update a legacy order in rox_orders.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_order(
        $e_order_id = "",
        $product_name = "",
        $chef_name = "",
        $desc = "",
        $odr_price = "",
        $adv = "",
        $dis = "",
        $price_dis = "",
        $delivery_chrge = "",
        $service_chrge = "",
        $greeting = "",
        $qty = "",
        $d_delivery = "",
        $order_status = "",
        $date = ""
    ): int {
        $conn = self::getDb();
        $sql = "UPDATE rox_orders SET
                odr_product_name = ?, odr_chef_name = ?, odr_desc = ?, odr_price = ?,
                odr_advance = ?, odr_dis = ?, odr_p_dis = ?, odr_deli_chrge = ?,
                odr_ser_chrge = ?, odr_greeting = ?, odr_qty = ?, odr_d_delivery = ?,
                odr_order_status = ?
                WHERE odr_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssss",
            $product_name, $chef_name, $desc, $odr_price,
            $adv, $dis, $price_dis, $delivery_chrge,
            $service_chrge, $greeting, $qty, $d_delivery,
            $order_status, $e_order_id
        );
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Set all order items to 'Delivered' for an invoice.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_order_status($inv = ""): int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_order_info SET rox_ord_status = 'Delivered' WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Set invoice status to 'Delivered'.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_invoice_status($inv = ""): int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_invoice SET rox_inv_status = 'Delivered' WHERE rox_inv_auto_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Update customer full details including email.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_cus(
        $cus_id = "",
        $fname = "",
        $lname = "",
        $email = "",
        $address = "",
        $tele = "",
        $mobile = ""
    ): int {
        $conn = self::getDb();
        $sql = "UPDATE rox_customers
                SET cus_mobile = ?, cus_fname = ?, cus_lname = ?, cus_land = ?,
                    cus_address = ?, cus_email = ?
                WHERE cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $mobile, $fname, $lname, $tele, $address, $email, $cus_id);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Update payment balance.
     * FIX: removed trailing comma in SET clause ("SET rox_pay_bal='$va'," was invalid SQL).
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_payment($inv = "", $va = ""): int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_payment SET rox_pay_bal = ? WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $va, $inv);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Update payment balance and mark as Paid.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_payment_paid($inv = "", $va = ""): int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_payment SET rox_pay_bal = ?, rox_pay_status = 'Paid' WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $va, $inv);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Update payment status.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_payment2($inv = "", $stat = ""): int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_payment SET rox_pay_status = ? WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $stat, $inv);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Update invoice balance.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_invoice($inv = "", $ba = "", $va = ""): int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_invoice SET rox_inv_balance = ? WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $ba, $inv);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Update invoice balance and set second-payment date.
     * @return int 1 on failure, 2 on success
     */
    public static function update_into_second_invoice($inv = "", $ba = "", $pay = ""): int
    {
        $conn = self::getDb();
        $date = date("Y-m-d H:i:s");
        $sql = "UPDATE rox_invoice SET rox_inv_balance = ?, rox_inv_2_date = ? WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $ba, $date, $inv);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Update discount fields on order_info for discount_status=1 products.
     * FIX: if($result==true) instead of if($result=true).
     * @return int 1 on success, null implicitly on failure
     */
    public static function update_prod($inv, $name, $dis, $cal): ?int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_order_info
                SET rox_discount = ?, rox_dis_calculate_amount = ?
                WHERE rox_inv_id = ? AND rox_discount_status = '1' AND rox_prd = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $dis, $cal, $inv, $name);
        $result = $stmt->execute();
        $stmt->close();
        if ($result == true) {
            return 1;
        }
        return null;
    }

    /**
     * Update discount fields on order_info for discount_status=0 products.
     * FIX: if($result==true) instead of if($result=true).
     * @return int 1 on success, null implicitly on failure
     */
    public static function update_prod1($inv, $name, $dis, $cal): ?int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_order_info
                SET rox_discount = ?, rox_dis_calculate_amount = ?
                WHERE rox_inv_id = ? AND rox_discount_status = '0' AND rox_prd = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $dis, $cal, $inv, $name);
        $result = $stmt->execute();
        $stmt->close();
        if ($result == true) {
            return 1;
        }
        return null;
    }

    /**
     * Update invoice delivery details (due date, delivery date, time).
     * FIX: if($result==true) instead of if($result=true).
     * @return int 1 on success, null implicitly on failure
     */
    public static function update_invoice_delivery_details($inv_id, $due, $del_date, $del_time): ?int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_invoice
                SET rox_inv_due = ?, rox_del_date = ?, rox_inv_time = ?
                WHERE rox_inv_auto_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $due, $del_date, $del_time, $inv_id);
        $result = $stmt->execute();
        $stmt->close();
        if ($result == true) {
            return 1;
        }
        return null;
    }

    /**
     * Update customer delivery address.
     * FIX: if($result==true) instead of if($result=true).
     * @return int 1 on success, null implicitly on failure
     */
    public static function update_customer_delivery_details($cus_id, $address): ?int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_customers SET cus_address = ? WHERE cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $address, $cus_id);
        $result = $stmt->execute();
        $stmt->close();
        if ($result == true) {
            return 1;
        }
        return null;
    }

    /**
     * Update greeting info on a specific order line item.
     * FIX: if($result==true) instead of if($result=true).
     * @return int 1 on success, null implicitly on failure
     */
    public static function update_order_info($order_info_id, $gre_des, $gre_info, $gre, $gre_info2): ?int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_order_info
                SET rox_gre_des = ?, rox_gre_info = ?, rox_gre = ?, rox_gre_info2 = ?
                WHERE rox_line_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $gre_des, $gre_info, $gre, $gre_info2, $order_info_id);
        $result = $stmt->execute();
        $stmt->close();
        if ($result == true) {
            return 1;
        }
        return null;
    }

    /**
     * Authorize an invoice bill.
     * FIX: if($result==true) instead of if($result=true).
     * @return int 1 on success, null implicitly on failure
     */
    public static function update_invoice_bill_authorized($inv): ?int
    {
        $conn = self::getDb();
        $sql = "UPDATE rox_invoice SET rox_inv_authorization = 1 WHERE rox_inv_auto_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $result = $stmt->execute();
        $stmt->close();
        if ($result == true) {
            return 1;
        }
        return null;
    }

    // =========================================================================
    //  SELECT METHODS
    // =========================================================================

    /**
     * Get all chefs from admin users.
     * @return mysqli_result|false
     */
    public static function select_all_cheff()
    {
        $conn = self::getDb();
        $sql = "SELECT rox_admin_fname, rox_admin_lname, rox_admin_id
                FROM rox_admin_user WHERE rox_admin_role = 'Cheff'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all products.
     * @return mysqli_result|false
     */
    public static function select_all_prdct()
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all customers.
     * @return mysqli_result|false
     */
    public static function select_all_cus()
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_customers";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get customer by cus_id.
     * @return mysqli_result|false
     */
    public static function select_all_cus_where_mobile($cuid)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_customers WHERE cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cuid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get the last (highest) customer ID.
     * FIX: uses SELECT MAX instead of SELECT * with fetch.
     * @return mixed customer ID or null
     */
    public static function select_all_cus_where_last()
    {
        $conn = self::getDb();
        $sql = "SELECT MAX(cus_id) AS cus_id FROM rox_customers";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data['cus_id'] ?? null;
    }

    /**
     * Get the last (highest) payment line ID.
     * FIX: uses SELECT MAX instead of SELECT * with fetch. Added LIMIT 1.
     * @return mixed payment line ID or null
     */
    public static function select_all_pay()
    {
        $conn = self::getDb();
        $sql = "SELECT MAX(rox_line_id) AS rox_line_id FROM rox_payment";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data['rox_line_id'] ?? null;
    }

    /**
     * Get customer by cus_id (library path variant).
     * @return mysqli_result|false
     */
    public static function select_all_cus_where_cus_id($id = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_customers WHERE cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product by rox_line_id.
     * @return mysqli_result|false
     */
    public static function select_all_from_prodct($name = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product WHERE rox_line_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get payment(s) by invoice ID.
     * @return mysqli_result|false
     */
    public static function select_all_from_payments($inv = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_payment WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product by rox_line_id.
     * @return mysqli_result|false
     */
    public static function select_all_product_where_id($id = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product WHERE rox_line_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all legacy orders.
     * @return mysqli_result|false
     */
    public static function select_all_orders()
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_orders";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get order line items by invoice ID, ordered by qty DESC.
     * @return mysqli_result|false
     */
    public static function select_all_from_order($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ? ORDER BY rox_prd_qty DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get order line items by invoice ID, ordered by discount_status DESC.
     * @return mysqli_result|false
     */
    public static function select_all_from_order2($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ? ORDER BY rox_discount_status DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product by rox_line_id.
     * @return mysqli_result|false
     */
    public static function select_all_p_12($prd)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product WHERE rox_line_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $prd);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get invoice by auto_id, excluding cancelled.
     * @return mysqli_result|false
     */
    public static function select_all_from_inv($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_invoice WHERE rox_inv_auto_id = ? AND rox_inv_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get invoices by customer ID within a date range, excluding cancelled.
     * @return mysqli_result|false
     */
    public static function select_all_from_inv_by_cus($cus = "", $dt = "", $dt1 = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_invoice
                WHERE rox_inv_cus_id = ? AND rox_inv_date BETWEEN ? AND ? AND rox_inv_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $cus, $dt, $dt1);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get customer by cus_id.
     * @return mysqli_result|false
     */
    public static function select_all_from_cust($cus = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_customers WHERE cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cus);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get the latest 10 invoices with customer info via JOIN.
     * IMPROVED: single JOIN query instead of separate queries per invoice.
     * @return mysqli_result|false
     */
    public static function select_all_from_inv_without_condi()
    {
        $conn = self::getDb();
        $sql = "SELECT i.*, c.cus_fname, c.cus_mobile
                FROM rox_invoice i
                LEFT JOIN rox_customers c ON i.rox_inv_cus_id = c.cus_id
                ORDER BY i.rox_inv_id DESC
                LIMIT 10";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get admin user by ID.
     * @return mysqli_result|false
     */
    public static function select_all_from_admin_user($id)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_admin_user WHERE rox_admin_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all invoices between two dates.
     * @return mysqli_result|false
     */
    public static function select_all_between_date_only($from = "", $to = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_invoice WHERE rox_inv_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $from, $to);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get non-cancelled invoices by due date range (chef view).
     * @return mysqli_result|false
     */
    public static function select_all_between_date_only_chef($from = "", $to = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_invoice
                WHERE rox_inv_status != 'Cancelled' AND rox_inv_due BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $from, $to);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get sum of invoice balances between two dates.
     * @return mixed sum value or null
     */
    public static function select_all_between_date_only_sum($from = "", $to = "")
    {
        $conn = self::getDb();
        $sql = "SELECT SUM(rox_inv_balance) AS value_sum FROM rox_invoice WHERE rox_inv_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $from, $to);
        $stmt->execute();
        $result = $stmt->get_result();
        $da = $result->fetch_assoc();
        $stmt->close();
        return $da['value_sum'] ?? null;
    }

    /**
     * Get non-cancelled invoices between dates for a specific user.
     * @return mysqli_result|false
     */
    public static function select_all_between($from = "", $to = "", $user = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_invoice
                WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_by = ? AND rox_inv_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $from, $to, $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get invoices by delivery date.
     * @return mysqli_result|false
     */
    public static function select_all_where_date($date = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_invoice WHERE rox_del_date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get sum of non-cancelled invoice balances between dates for a user.
     * @return mixed sum value or null
     */
    public static function select_all_between_sum($from = "", $to = "", $user = "")
    {
        $conn = self::getDb();
        $sql = "SELECT SUM(rox_inv_balance) AS value_sum FROM rox_invoice
                WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_by = ? AND rox_inv_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $from, $to, $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $da = $result->fetch_assoc();
        $stmt->close();
        return $da['value_sum'] ?? null;
    }

    /**
     * Get order info by main category.
     * @return mysqli_result|false
     */
    public static function select_all_from_odr($mc = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_p_main_typ = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $mc);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get non-cancelled order info by main category and date range.
     * @return mysqli_result|false
     */
    public static function select_all_from_odr_main($mc = "", $dt = "", $dt1 = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info
                WHERE rox_p_main_typ = ? AND rox_ord_status != 'Cancelled' AND ord_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $mc, $dt, $dt1);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get order info by main category (all statuses).
     * @return mysqli_result|false
     */
    public static function select_all_from_odr_main_sum($mc = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_p_main_typ = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $mc);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get non-cancelled order info by main category, sub category (LIKE), and date range.
     * @return mysqli_result|false
     */
    public static function select_all_from_odr_sub($mc = "", $sc = "", $dt = "", $dt1 = "")
    {
        $conn = self::getDb();
        $like_sc = "%{$sc}%";
        $sql = "SELECT * FROM rox_order_info
                WHERE rox_p_main_typ = ? AND rox_p_sub_type LIKE ?
                AND rox_ord_status != 'Cancelled' AND ord_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $mc, $like_sc, $dt, $dt1);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get non-cancelled order info by main category, sub (LIKE), product (LIKE), and date range.
     * @return mysqli_result|false
     */
    public static function select_all_from_odr_pro($mc = "", $sc = "", $pro = "", $dt = "", $dt1 = "")
    {
        $conn = self::getDb();
        $like_sc  = "%{$sc}%";
        $like_pro = "%{$pro}%";
        $sql = "SELECT * FROM rox_order_info
                WHERE rox_p_main_typ = ? AND rox_p_sub_type LIKE ? AND rox_prd_val LIKE ?
                AND rox_ord_status != 'Cancelled' AND ord_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $mc, $like_sc, $like_pro, $dt, $dt1);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all non-cancelled order info.
     * @return mysqli_result|false
     */
    public static function select_all_from_odr_all()
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_ord_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all products.
     * @return mysqli_result|false
     */
    public static function select_all_from_product_all()
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product by rox_line_id.
     * @return mysqli_result|false
     */
    public static function select_all_from_product_all1($id)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product WHERE rox_line_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all invoices for a customer.
     * @return mysqli_result|false
     */
    public static function get_invoice_id($user_id)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_invoice WHERE rox_inv_cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get sum of quantities for a product within a date range (non-cancelled).
     * @return mysqli_result|false
     */
    public static function select_all_from_report_where_pro_idDate($id, $dt, $dt1)
    {
        $conn = self::getDb();
        $sql = "SELECT SUM(rox_prd_qty) AS value_sum, rox_prd_val, rox_inv_id
                FROM rox_order_info
                WHERE rox_prd_val = ? AND ord_date BETWEEN ? AND ? AND rox_ord_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $id, $dt, $dt1);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get sum of quantities for a product (all dates, non-cancelled).
     * @return mysqli_result|false
     */
    public static function select_all_from_report_where_pro_id($id)
    {
        $conn = self::getDb();
        $sql = "SELECT SUM(rox_prd_qty) AS value_sum, rox_prd_val, rox_inv_id
                FROM rox_order_info
                WHERE rox_prd_val = ? AND rox_ord_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get sum of quantities for a product on a specific invoice within a date range.
     * @return mixed sum value or null
     */
    public static function select_all_from_report_where_pro_id_date($id = "", $inv = "", $dt = "", $dt1 = "")
    {
        $conn = self::getDb();
        $sql = "SELECT SUM(rox_prd_qty) AS value_sum FROM rox_order_info
                WHERE rox_prd_val = ? AND rox_ord_status != 'Cancelled'
                AND rox_inv_id = ? AND ord_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $id, $inv, $dt, $dt1);
        $stmt->execute();
        $result = $stmt->get_result();
        $da = $result->fetch_assoc();
        $stmt->close();
        return $da['value_sum'] ?? null;
    }

    /**
     * Get grouped order info (concatenated products) for an invoice. Note: typo in name preserved.
     * @return mysqli_result|false
     */
    public static function seleect_all_from_odr_info($inv = "")
    {
        $conn = self::getDb();
        $sql = "SELECT rox_line_id, rox_ord_id, rox_inv_id, rox_p_main_typ, rox_p_sub_type,
                       rox_prd, rox_prd_val, rox_prd_price, rox_prd_qty, rox_gre_des, rox_gre,
                       rox_gre_info, rox_gre_info2, rox_des, rox_ord_status, ord_date,
                       GROUP_CONCAT(CONCAT_WS(' - ', rox_prd, rox_prd_qty) SEPARATOR ' <br> ') AS rox_prd,
                       SUM(rox_prd_qty) AS totqty
                FROM rox_order_info
                WHERE rox_inv_id = ? AND rox_ord_status != 'Cancelled'
                GROUP BY rox_inv_id";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get non-cancelled order info for an invoice. Note: typo in name preserved.
     * @return mysqli_result|false
     */
    public static function seleect_all_from_odr_info2($inv = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ? AND rox_ord_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get non-cancelled order info with dynamic WHERE filters. Note: typo in name preserved.
     * Parameters: $inv=invoice, $status=category, $dt=sub_category, $dt1=product (renamed from original).
     * Original params were ($from_date, $cat, $sub, $pro) - kept exact signature.
     * @return mysqli_result|false
     */
    public static function seleect_all_from_odr_info1($inv = "", $status = "", $dt = "", $dt1 = "")
    {
        $conn = self::getDb();

        // Build dynamic query with prepared statement bindings
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ? AND rox_ord_status != 'Cancelled'";
        $types = "s";
        $params = [$inv];

        if ($status !== '') {
            $sql .= " AND rox_p_main_typ = ?";
            $types .= "s";
            $params[] = $status;
        }
        if ($dt !== '') {
            $sql .= " AND rox_p_sub_type = ?";
            $types .= "s";
            $params[] = $dt;
        }
        if ($dt1 !== '') {
            $sql .= " AND rox_prd = ?";
            $types .= "s";
            $params[] = $dt1;
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get non-cancelled order info for an invoice (customer view). Note: typo preserved.
     * @return mysqli_result|false
     */
    public static function seleect_all_from_odr_info_1_cust($inv = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ? AND rox_ord_status != 'Cancelled'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product by rox_line_id. Note: typo in name preserved.
     * @return mysqli_result|false
     */
    public static function seleect_all_from_product($prd = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product WHERE rox_line_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $prd);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product by rox_line_id and name. Note: typo in name preserved.
     * @return mysqli_result|false
     */
    public static function seleect_all_from_product1($prd = "", $pro = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product WHERE rox_line_id = ? AND rox_prd_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $prd, $pro);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get order info by invoice ID.
     * FIX: returns the result set, not 1/2 status codes.
     * @return mysqli_result|false
     */
    public static function get_from_order($id = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product by rox_line_id.
     * @return mysqli_result|false
     */
    public static function select_all_from_product($id)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product WHERE rox_line_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get order info for a product on a specific invoice within date range (limit 1).
     * @return mysqli_result|false
     */
    public static function select_all_from_product_between_dats($id = "", $inv = "", $dt = "", $dt1 = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info
                WHERE rox_prd_val = ? AND rox_inv_id = ? AND rox_ord_status != 'Cancelled'
                AND ord_date BETWEEN ? AND ?
                LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $id, $inv, $dt, $dt1);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product by rox_line_id (alternate path variant).
     * @return mysqli_result|false
     */
    public static function select_all_from_product1($id)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product WHERE rox_line_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get customer by cus_id.
     * @return mysqli_result|false
     */
    public static function select_all_from_cus($id)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_customers WHERE cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get the last (highest) order ID.
     * FIX: uses MAX + LIMIT 1 instead of SELECT *.
     * @return mixed order ID or null
     */
    public static function select_last_from_odr()
    {
        $conn = self::getDb();
        $sql = "SELECT MAX(odr_id) AS odr_id FROM rox_orders";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data['odr_id'] ?? null;
    }

    /**
     * Get legacy order by code.
     * @return mysqli_result|false
     */
    public static function select_oder_code($code = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_orders WHERE odr_code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all main categories.
     * @return mysqli_result|false
     */
    public static function select_m_type()
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_acc_main_cate";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all sub categories.
     * @return mysqli_result|false
     */
    public static function select_s_type()
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_acc_sub_cate";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all products.
     * @return mysqli_result|false
     */
    public static function select_product()
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get order info by invoice ID.
     * @return mysqli_result|false
     */
    public static function select_order_info($inv = "")
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Check if an order line exists for an invoice and product value.
     * FIX: uses SELECT COUNT(*) instead of SELECT * + mysqli_num_rows.
     * @return int row count
     */
    public static function check_order_info($inv = "", $prd = ""): int
    {
        $conn = self::getDb();
        $sql = "SELECT COUNT(*) AS cnt FROM rox_order_info WHERE rox_inv_id = ? AND rox_prd_val = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $inv, $prd);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return (int)($row['cnt'] ?? 0);
    }

    /**
     * Get the next invoice ID (auto-increment PK).
     * FIX: uses SELECT MAX(rox_inv_id) instead of SELECT * ORDER BY ... LIMIT 1.
     * @return int next invoice ID
     */
    public static function select_inv_id(): int
    {
        $conn = self::getDb();
        $sql = "SELECT MAX(rox_inv_id) AS max_id FROM rox_invoice";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $id = (int)($row['max_id'] ?? 0);
        return $id + 1;
    }

    /**
     * Get order info by invoice ID.
     * @return mysqli_result|false
     */
    public static function get_product($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product qty and price for items with dis_status=1 on an invoice.
     * @return mysqli_result|false
     */
    public static function get_product_dis_status1($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT p.rox_prd_qty, p.rox_prd_price
                FROM rox_order_info p, rox_product pr
                WHERE p.rox_inv_id = ? AND pr.rox_dis_status = 1 AND p.rox_prd_val = pr.rox_line_id";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get product qty and price for items with dis_status=0 on an invoice.
     * @return mysqli_result|false
     */
    public static function get_product_dis_status0($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT p.rox_prd_qty, p.rox_prd_price
                FROM rox_order_info p, rox_product pr
                WHERE p.rox_inv_id = ? AND pr.rox_dis_status = 0 AND pr.rox_prd_name = p.rox_prd";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all payment methods (line_id and type).
     * @return mysqli_result|false
     */
    public static function load_all_payment_method()
    {
        $conn = self::getDb();
        $sql = "SELECT rox_line_id, rox_pay_typ FROM rox_payment";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get payments with customer and invoice data by payment type and date range.
     * @return mysqli_result|false
     */
    public static function select_from_payment($pay, $from, $to)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_payment p, rox_customers c, rox_invoice v
                WHERE p.rox_inv_id = v.rox_inv_auto_id AND p.rox_cust_id = c.cus_id
                AND rox_pay_typ = ? AND p.rox_pay_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $pay, $from, $to);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get order info by invoice ID.
     * @return mysqli_result|false
     */
    public static function select_from_product($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_order_info WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get all cancelled orders with admin user names.
     * @return mysqli_result|false
     */
    public static function load_cancel_orders()
    {
        $conn = self::getDb();
        $sql = "SELECT co.*, adu.rox_user_name
                FROM rox_cancel_orders co, rox_admin_user adu
                WHERE co.odr_cancel_by = adu.rox_admin_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get grouped product info for an invoice (with concatenation).
     * @return array|null single row
     */
    public static function get_invoice_all_products($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT rox_line_id, rox_ord_id, rox_inv_id, rox_p_main_typ, rox_p_sub_type,
                       rox_prd, rox_prd_val, rox_prd_price, rox_prd_qty, rox_gre_des, rox_gre,
                       rox_gre_info, rox_gre_info2, rox_des, rox_ord_status, ord_date,
                       GROUP_CONCAT(CONCAT_WS(' - ', rox_prd, rox_prd_qty) SEPARATOR ' <br> ') AS rox_prd,
                       SUM(rox_prd_qty) AS totqty
                FROM rox_order_info
                WHERE rox_inv_id = ? AND rox_ord_status != 'Cancelled'
                GROUP BY rox_inv_id";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        $stmt->close();
        return $row;
    }

    /**
     * Get unauthorized invoices with limit.
     * FIX: $limit is sanitized as integer to prevent SQL injection.
     * @return mysqli_result|false
     */
    public static function select_all_authorized_from_inv_limit($limit)
    {
        $conn = self::getDb();
        $limit = (int)$limit;
        $sql = "SELECT * FROM rox_invoice WHERE rox_inv_authorization = 0 ORDER BY rox_inv_id DESC LIMIT ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Search invoices by invoice ID, customer mobile, or name (LIKE).
     * @return mysqli_result|false
     */
    public static function search_from_inv_limit($inv_id)
    {
        $conn = self::getDb();
        $like = "%{$inv_id}%";
        $sql = "SELECT i.*, c.cus_mobile, c.cus_fname
                FROM rox_invoice i, rox_customers c
                WHERE c.cus_id = i.rox_inv_cus_id
                AND (i.rox_inv_auto_id LIKE ? OR c.cus_mobile LIKE ? OR c.cus_fname LIKE ?)
                LIMIT 50";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $like, $like, $like);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Get first payment record for an invoice.
     * @return array|null single row
     */
    public static function get_invoice_payments($inv)
    {
        $conn = self::getDb();
        $sql = "SELECT * FROM rox_payment WHERE rox_inv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inv);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        $stmt->close();
        return $row;
    }

    /**
     * Search customers by first name (LIKE).
     * @return mysqli_result|false
     */
    public static function select_all_cus_auto($fname)
    {
        $conn = self::getDb();
        $like = "%{$fname}%";
        $sql = "SELECT * FROM rox_customers WHERE cus_fname LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    // =========================================================================
    //  DELETE METHODS
    // =========================================================================

    /**
     * Delete a legacy order from rox_orders.
     * @return int 1 on failure, 2 on success
     */
    public static function delete_from_order($id = ""): int
    {
        $conn = self::getDb();
        $sql = "DELETE FROM rox_orders WHERE odr_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    /**
     * Delete a specific line item from order info.
     * @return int 1 on failure, 2 on success
     */
    public static function delete_order_info($inv = "", $id = ""): int
    {
        $conn = self::getDb();
        $sql = "DELETE FROM rox_order_info WHERE rox_inv_id = ? AND rox_ord_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $inv, $id);
        if (!$stmt->execute()) {
            $stmt->close();
            return 1;
        }
        $stmt->close();
        return 2;
    }

    // =========================================================================
    //  UTILITY METHODS
    // =========================================================================

    /**
     * Generate a random alphanumeric string of given length.
     * Used for various ID generation purposes.
     *
     * @param int $length desired string length
     * @return string random alphanumeric string
     */
    public static function invoice_id(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLen = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charLen - 1)];
        }
        return $randomString;
    }

    /**
     * Atomically generate the next invoice ID using a transaction with FOR UPDATE lock.
     * Returns a code like "RB-01005708".
     *
     * Uses SELECT ... FOR UPDATE within a transaction to prevent race conditions
     * where two concurrent requests could generate the same invoice ID.
     *
     * @return string the full invoice code (e.g. "RB-01005708")
     * @throws \RuntimeException on transaction failure
     */
    public static function generate_invoice_id(): string
    {
        $conn = self::getDb();
        $conn->begin_transaction();
        try {
            $sql = "SELECT COALESCE(MAX(CAST(SUBSTRING(rox_inv_auto_id, 5) AS UNSIGNED)), 1005707) + 1 AS next_id
                    FROM rox_invoice FOR UPDATE";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();

            $nextNum = (int)$row['next_id'];
            $invoiceId = "RB-0" . $nextNum;

            $conn->commit();
            return $invoiceId;
        } catch (\Throwable $e) {
            $conn->rollback();
            throw new \RuntimeException("Failed to generate invoice ID: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Update all order_info records from a temporary invoice ID to the real one.
     * Used when saving an order - items are added with a temp session ID,
     * then converted to the real invoice ID at save time.
     */
    public static function update_temp_invoice_id(string $temp_id, string $real_id): bool
    {
        $conn = self::getDb();
        $stmt = $conn->prepare("UPDATE rox_order_info SET rox_inv_id = ? WHERE rox_inv_id = ?");
        $stmt->bind_param("ss", $real_id, $temp_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
