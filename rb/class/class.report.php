<?php

class Report
{
    private static ?mysqli $db = null;

    private static function getDb(): mysqli {
        if (self::$db === null || !self::$db->ping()) {
            self::$db = new mysqli("localhost", "trbsysne2_royal", "Royal@508", "trbsysne2_royal");
            self::$db->set_charset("utf8mb4");
        }
        return self::$db;
    }

    public static function getCategory()
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_acc_main_cate ORDER BY rox_main_cate ASC");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getSubCategories($category)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_acc_sub_cate WHERE rox_main_cate_id = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getSubCategoriesDirect($category)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_acc_sub_cate WHERE rox_main_cate_id = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getItems($sub_cat_id)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_product WHERE rox_prd_sub_cate = ?");
        $stmt->bind_param("s", $sub_cat_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getItemsDirect($sub_cat_id)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_product WHERE rox_prd_sub_cate = ?");
        $stmt->bind_param("s", $sub_cat_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getCus($cus_id)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_customers WHERE cus_id = ?");
        $stmt->bind_param("i", $cus_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getAllInvoiceCustomers()
    {
        $stmt = self::getDb()->prepare("SELECT DISTINCT c.* FROM rox_customers c INNER JOIN rox_invoice i ON c.cus_id = i.rox_inv_cus_id ORDER BY c.cus_fname ASC");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getCustomerInvoices($customer_id, $date1, $date2)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_invoice WHERE rox_inv_cus_id = ? AND rox_inv_date BETWEEN ? AND ? AND rox_inv_status != 'Cancelled'");
        $stmt->bind_param("iss", $customer_id, $date1, $date2);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getAllCustomerInvoices($date1, $date2)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_invoice WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status != 'Cancelled' ORDER BY rox_inv_id DESC");
        $stmt->bind_param("ss", $date1, $date2);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getInvoiceTotal($invoice_id)
    {
        $stmt = self::getDb()->prepare("SELECT SUM(rox_prd_price * rox_prd_qty) AS sumtot FROM rox_order_info WHERE rox_inv_id = ?");
        $stmt->bind_param("s", $invoice_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['sumtot'] ?? 0;
    }

    public static function getInvoicePaid($invoice_code)
    {
        $stmt = self::getDb()->prepare("SELECT SUM(rox_payment) AS sumtot FROM rox_balance_payment WHERE rox_inv_id = ?");
        $stmt->bind_param("s", $invoice_code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['sumtot'] ?? 0;
    }

    public static function getInvoicePaymentType($invoice_id, $payment_type)
    {
        if ($payment_type != "") {
            $stmt = self::getDb()->prepare("SELECT * FROM rox_payment WHERE rox_inv_id = ? AND rox_pay_typ = ?");
            $stmt->bind_param("ss", $invoice_id, $payment_type);
        } else {
            $stmt = self::getDb()->prepare("SELECT * FROM rox_payment WHERE rox_inv_id = ?");
            $stmt->bind_param("s", $invoice_id);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_cus_details($fromdate, $enddate, $payment_type = '')
    {
        if ($payment_type != '') {
            $stmt = self::getDb()->prepare("SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id = c.cus_id AND p.rox_pay_date BETWEEN ? AND ? AND rox_pay_typ = ? ORDER BY p.rox_inv_id ASC");
            $stmt->bind_param("sss", $fromdate, $enddate, $payment_type);
        } else {
            $stmt = self::getDb()->prepare("SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id = c.cus_id AND p.rox_pay_date BETWEEN ? AND ? ORDER BY p.rox_inv_id ASC");
            $stmt->bind_param("ss", $fromdate, $enddate);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_date_time($invid)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_invoice WHERE rox_inv_auto_id = ?");
        $stmt->bind_param("s", $invid);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_cus_details1($user_id, $fromdate, $enddate)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id = c.cus_id AND p.rox_pay_date BETWEEN ? AND ? AND p.rox_cust_id = ?");
        $stmt->bind_param("sss", $fromdate, $enddate, $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_cus_details2($paymethod, $fromdate, $enddate)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id = c.cus_id AND p.rox_pay_date BETWEEN ? AND ? AND p.rox_pay_typ = ?");
        $stmt->bind_param("sss", $fromdate, $enddate, $paymethod);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_cus_details3($user_id, $paymethod, $fromdate, $enddate)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id = c.cus_id AND p.rox_pay_date BETWEEN ? AND ? AND p.rox_pay_typ = ? AND p.rox_cust_id = ?");
        $stmt->bind_param("ssss", $fromdate, $enddate, $paymethod, $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_total($invid)
    {
        $stmt = self::getDb()->prepare("SELECT SUM(rox_dis_calculate_amount) AS cal_amnt, rox_ord_status FROM rox_order_info WHERE rox_inv_id = ? GROUP BY rox_ord_status");
        $stmt->bind_param("s", $invid);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_paid($cus_id, $invid)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_balance_payment WHERE rox_cust_id = ? AND rox_inv_id = ?");
        $stmt->bind_param("ss", $cus_id, $invid);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_paid1($fromdate, $enddate, $payment_type = '')
    {
        if ($payment_type != '') {
            $stmt = self::getDb()->prepare("SELECT p.rox_inv_id, p.rox_cust_id, p.rox_pay_typ, SUM(p.rox_payment) AS totpaid, p.rox_pay_date, c.cus_fname FROM rox_balance_payment p, rox_customers c WHERE p.rox_cust_id = c.cus_id AND rox_pay_date BETWEEN ? AND ? AND rox_pay_typ = ? GROUP BY p.rox_inv_id ORDER BY p.rox_inv_id ASC");
            $stmt->bind_param("sss", $fromdate, $enddate, $payment_type);
        } else {
            $stmt = self::getDb()->prepare("SELECT p.rox_inv_id, p.rox_cust_id, p.rox_pay_typ, SUM(p.rox_payment) AS totpaid, p.rox_pay_date, c.cus_fname FROM rox_balance_payment p, rox_customers c WHERE p.rox_cust_id = c.cus_id AND rox_pay_date BETWEEN ? AND ? GROUP BY p.rox_inv_id ORDER BY p.rox_inv_id ASC");
            $stmt->bind_param("ss", $fromdate, $enddate);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getInvoiceItem($inv_id)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_order_info WHERE rox_inv_id = ?");
        $stmt->bind_param("s", $inv_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getInvoiceItem1($item, $date1, $date2)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_order_info WHERE rox_prd_val = ? AND ord_date BETWEEN ? AND ?");
        $stmt->bind_param("sss", $item, $date1, $date2);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getCustname($inv_id)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_invoice i INNER JOIN rox_customers c ON i.rox_inv_cus_id = c.cus_id WHERE i.rox_inv_auto_id = ?");
        $stmt->bind_param("s", $inv_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getInvoiceItem2($inv_id, $item)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_order_info WHERE rox_inv_id = ? AND rox_prd_val = ?");
        $stmt->bind_param("ss", $inv_id, $item);
        $stmt->execute();
        return $stmt->get_result();
    }
}
