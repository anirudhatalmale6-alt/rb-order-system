<?php

class Dashboard
{
    private static ?mysqli $db = null;

    private static function getDb(): mysqli {
        if (self::$db === null || !self::$db->ping()) {
            self::$db = new mysqli("localhost", "trbsysne2_royal", "Royal@508", "trbsysne2_royal");
            self::$db->set_charset("utf8mb4");
        }
        return self::$db;
    }

    public static function count_admin_users(): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_admin_active_users(): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role='Admin' AND rox_admin_user_status='Active'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_users(): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role != 'Admin'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_active_users(): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role='User' AND rox_admin_user_status='Active'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_admin_branch_users($bra = ""): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role='Employee' AND rox_admin_user_status='Active' AND rox_branch=?");
        $stmt->bind_param("s", $bra);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_admin_branch_inactive_users($bra = ""): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role='Employee' AND rox_admin_user_status='Suspened' AND rox_branch=?");
        $stmt->bind_param("s", $bra);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_total_orders_this_month($date_frm = "", $date_to = ""): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_invoice WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status != 'Cancelled'");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_pending_orders_this_month($date_frm = "", $date_to = ""): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_invoice WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status='Pending'");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_new_users($date_frm = "", $date_to = ""): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_customers WHERE joined_date BETWEEN ? AND ?");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function get_total_revenue($date_frm = "", $date_to = ""): float
    {
        $stmt = self::getDb()->prepare("SELECT COALESCE(SUM(rox_inv_balance), 0) AS total FROM rox_invoice WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status != 'Cancelled'");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (float)$row['total'];
    }

    public static function get_total_paid($date_frm = "", $date_to = ""): float
    {
        $stmt = self::getDb()->prepare("SELECT COALESCE(SUM(rox_payment), 0) AS total FROM rox_balance_payment WHERE rox_pay_date BETWEEN ? AND ?");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (float)$row['total'];
    }

    public static function count_delivered_orders($date_frm = "", $date_to = ""): int
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_invoice WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status='Delivered'");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }
}

?>
