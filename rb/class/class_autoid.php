<?php

class Autoid
{
    private static $db = null;

    private static function getDb() {
        if (self::$db === null || !self::$db->ping()) {
            require __DIR__ . '/../library/dbconfig.php';
            self::$db = new mysqli($servername, $db_user, $db_pass, $db_dbName);
            rb_prepare_connection(self::$db);
        }
        return self::$db;
    }

    public static function get_branch_id()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_branch");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }

    public static function get_users_id()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "EMP" . ($row['cnt'] + 1899);
    }

    public static function get_admin_users_id2()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_admin_user");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "STD" . ($row['cnt'] + 1005708);
    }

    public static function get_FAQ_id()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_faqs");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "FAQCAT" . ($row['cnt'] + 99);
    }

    public static function get_FAQ_cate_id()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_faq_category");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "FAQCAT" . ($row['cnt'] + 99);
    }

    public static function get_main_cate_id()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_acc_main_cate");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "MCAT" . ($row['cnt'] + 1);
    }

    public static function get_province_id()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_province");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "PROV" . ($row['cnt'] + 1);
    }

    public static function get_sub_cate_id()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_acc_sub_cate");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "SCAT" . ($row['cnt'] + 1);
    }

    public static function get_invoice_id()
    {
        $stmt = self::getDb()->prepare("SELECT COALESCE(MAX(rox_inv_id), 1005707) AS max_id FROM rox_invoice");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['max_id'] + 1;
    }

    public static function get_desti_id()
    {
        $stmt = self::getDb()->prepare("SELECT COUNT(*) AS cnt FROM rox_destination");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "DESTI" . ($row['cnt'] + 1000);
    }
}

?>
