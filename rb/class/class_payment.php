<?php

class class_payment
{
    private static ?mysqli $db = null;

    private static function getDb(): mysqli {
        if (self::$db === null || !self::$db->ping()) {
            self::$db = new mysqli("localhost", "trbsysne2_royal", "Royal@508", "trbsysne2_royal");
            self::$db->set_charset("utf8mb4");
        }
        return self::$db;
    }

    public static function balance_payment($inid = "", $cusid = "", $type = "", $pay = "", $date = "")
    {
        $stmt = self::getDb()->prepare("INSERT INTO rox_balance_payment (rox_inv_id, rox_cust_id, rox_pay_typ, rox_payment, rox_pay_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisds", $inid, $cusid, $type, $pay, $date);
        if ($stmt->execute()) {
            return 1;
        }
        return 2;
    }

    public static function getcus_id($inid = "")
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_invoice WHERE rox_inv_auto_id = ?");
        $stmt->bind_param("s", $inid);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_bal_amount($inv_code)
    {
        $stmt = self::getDb()->prepare("SELECT rox_payment FROM rox_balance_payment WHERE rox_inv_id = ? ORDER BY rox_bid DESC LIMIT 1");
        $stmt->bind_param("s", $inv_code);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_bal_amo($inv_code)
    {
        $stmt = self::getDb()->prepare("SELECT rox_pay_status FROM rox_payment WHERE rox_inv_id = ?");
        $stmt->bind_param("s", $inv_code);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_bal_amount1($inv_code)
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_balance_payment WHERE rox_inv_id = ? ORDER BY rox_bid ASC");
        $stmt->bind_param("s", $inv_code);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_bal($inid = "")
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_payment WHERE rox_inv_id = ?");
        $stmt->bind_param("s", $inid);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function update_bal($inid = "", $balan = "")
    {
        $stmt = self::getDb()->prepare("UPDATE rox_payment SET rox_pay_status = ? WHERE rox_inv_id = ?");
        $stmt->bind_param("ss", $balan, $inid);
        if ($stmt->execute()) {
            return 1;
        }
        return 2;
    }

    public static function update_status($invoid)
    {
        $stmt = self::getDb()->prepare("UPDATE rox_order_info SET rox_ord_status = 'Cancelled' WHERE rox_inv_id = ?");
        $stmt->bind_param("s", $invoid);
        if ($stmt->execute()) {
            return 1;
        }
        return 2;
    }

    public static function update_invoice_status($invoid)
    {
        $stmt = self::getDb()->prepare("UPDATE rox_invoice SET rox_inv_status = 'Cancelled' WHERE rox_inv_auto_id = ?");
        $stmt->bind_param("s", $invoid);
        if ($stmt->execute()) {
            return 1;
        }
        return 2;
    }

    public static function delete_order_payment($inid)
    {
        $stmt = self::getDb()->prepare("DELETE FROM rox_payment WHERE rox_inv_id = ?");
        $stmt->bind_param("s", $inid);
        if ($stmt->execute()) {
            return 1;
        }
        return 2;
    }

    public static function delete_order_invoice($inid)
    {
        $stmt = self::getDb()->prepare("DELETE FROM rox_invoice WHERE rox_inv_auto_id = ?");
        $stmt->bind_param("s", $inid);
        if ($stmt->execute()) {
            return 1;
        }
        return 2;
    }

    public static function delete_order_order_info($inid)
    {
        $stmt = self::getDb()->prepare("DELETE FROM rox_order_info WHERE rox_inv_id = ?");
        $stmt->bind_param("s", $inid);
        if ($stmt->execute()) {
            return 1;
        }
        return 2;
    }
}
