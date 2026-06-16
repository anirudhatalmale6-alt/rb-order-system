<?php

class Common_access
{
    private static $db = null;

    private static function getDb() {
        if (self::$db === null || !self::$db->ping()) {
            self::$db = new mysqli("localhost", "trbsysne2_royal", "Royal@508", "trbsysne2_royal");
            self::$db->set_charset("utf8mb4");
        }
        return self::$db;
    }

    public static function load_user_level()
    {
        $stmt = self::getDb()->prepare("SELECT rox_line_id, rox_u_level FROM rox_user_level WHERE rox_status = '1' ORDER BY rox_u_level ASC");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_acc_cate()
    {
        $stmt = self::getDb()->prepare("SELECT rox_line_id, rox_main_cate, rox_main_cate_des, rox_auto_id FROM rox_acc_main_cate ORDER BY rox_main_cate ASC");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_acc_cate_sub()
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_acc_sub_cate");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_all_users()
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_admin_user");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_all_cust()
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_customers ORDER BY cus_fname ASC");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_all_products()
    {
        $stmt = self::getDb()->prepare("SELECT * FROM rox_product");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_agent()
    {
        $stmt = self::getDb()->prepare("SELECT rox_agent_id, rox_agent_name, rox_agent_nic, rox_agent_email, rox_agent_address, rox_agent_mobile, rox_agent_company FROM rox_agents WHERE rox_status = '1'");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_agent_company()
    {
        $stmt = self::getDb()->prepare("SELECT rox_agent_id, rox_agent_company FROM rox_agents WHERE rox_status = '1'");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_access_level()
    {
        $stmt = self::getDb()->prepare("SELECT rox_line_id, rox_web_access, rox_chief_acc, rox_manager, rox_employee, rox_acc FROM rox_access");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_select_country()
    {
        $stmt = self::getDb()->prepare("SELECT rox_line_id, rox_country, rox_auto_id FROM rox_country");
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function load_select_province($rox_country = "")
    {
        $stmt = self::getDb()->prepare("SELECT rox_line_id, rox_country, rox_province, rox_auto_id FROM rox_province WHERE rox_country = ?");
        $stmt->bind_param("s", $rox_country);
        $stmt->execute();
        return $stmt->get_result();
    }
}

?>
