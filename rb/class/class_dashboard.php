<?php

class Dashboard
{
    private static $db = null;

    private static function getDb() {
        if (self::$db === null) {
            self::$db = new mysqli("localhost", "trbsysne2_royal", "Royal@508", "trbsysne2_royal");
            self::$db->set_charset("utf8mb4");
        }
        return self::$db;
    }

    public static function count_admin_users()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_admin_active_users()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role='Admin' AND rox_admin_user_status='Active'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_users()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role != 'Admin'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_active_users()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role='User' AND rox_admin_user_status='Active'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_admin_branch_users($bra = "")
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role='Employee' AND rox_admin_user_status='Active' AND rox_branch=?");
        $stmt->bind_param("s", $bra);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_admin_branch_inactive_users($bra = "")
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user WHERE rox_admin_role='Employee' AND rox_admin_user_status='Suspened' AND rox_branch=?");
        $stmt->bind_param("s", $bra);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_total_orders_this_month($date_frm = "", $date_to = "")
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_orders WHERE odr_date BETWEEN ? AND ?");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_pending_orders_this_month($date_frm = "", $date_to = "")
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_orders WHERE odr_date BETWEEN ? AND ? AND odr_order_status='Pending'");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function count_new_users($date_frm = "", $date_to = "")
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_customers WHERE joined_date BETWEEN ? AND ?");
        $stmt->bind_param("ss", $date_frm, $date_to);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }
}

?>
