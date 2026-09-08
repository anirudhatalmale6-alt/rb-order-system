<?php
/*
 * Dashboard counters.
 *
 * NOTE ON TABLES: the live data lives in `rox_invoice` (173k rows) and
 * `rox_order_info`. The legacy `rox_orders` table is EMPTY (0 rows) - the
 * original dashboard queried it, which is why every card always showed 0.
 * All counters below now read the tables the POS actually writes to.
 */
class Dashboard
{
    private static $db = null;

    private static function getDb()
    {
        if (self::$db === null) {
            require __DIR__ . '/../library/dbconfig.php';
            self::$db = new mysqli($servername, $db_user, $db_pass, $db_dbName);
            rb_prepare_connection(self::$db);
        }
        return self::$db;
    }

    /* Runs a query and returns the first column of the first row. */
    private static function scalar($sql, $types = null, $params = array(), $default = 0)
    {
        $db = self::getDb();
        if (!$db) { return $default; }

        $stmt = $db->prepare($sql);
        if ($stmt === false) { return $default; }

        if ($types !== null && count($params) > 0) {
            $stmt->bind_param($types, ...$params);
        }
        if (!$stmt->execute()) { $stmt->close(); return $default; }

        $res = $stmt->get_result();
        $row = $res ? $res->fetch_row() : null;
        $stmt->close();

        if ($row === null || $row[0] === null) { return $default; }
        return $row[0];
    }

    // ---------------------------------------------------------------
    // User counters
    // ---------------------------------------------------------------

    public static function count_admin_users()
    {
        return (int)self::scalar("SELECT COUNT(*) FROM rox_admin_user");
    }

    public static function count_admin_active_users()
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_admin_user
              WHERE LOWER(rox_admin_role)='admin' AND rox_admin_user_status='Active'");
    }

    public static function count_users()
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_admin_user WHERE LOWER(rox_admin_role) <> 'admin'");
    }

    public static function count_active_users()
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_admin_user
              WHERE LOWER(rox_admin_role)='user' AND rox_admin_user_status='Active'");
    }

    public static function count_admin_branch_users($bra = "")
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_admin_user
              WHERE LOWER(rox_admin_role)='employee' AND rox_admin_user_status='Active' AND rox_branch=?",
            "s", array($bra));
    }

    public static function count_admin_branch_inactive_users($bra = "")
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_admin_user
              WHERE LOWER(rox_admin_role)='employee' AND rox_admin_user_status='Suspened' AND rox_branch=?",
            "s", array($bra));
    }

    // ---------------------------------------------------------------
    // Order / sales counters for a date range
    // ---------------------------------------------------------------

    /* Every invoice raised in the period, cancellations excluded. */
    public static function count_total_orders_this_month($date_frm = "", $date_to = "")
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_invoice
              WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status <> 'Cancelled'",
            "ss", array($date_frm, $date_to));
    }

    /* Orders raised in the period that have not been delivered yet. */
    public static function count_pending_orders_this_month($date_frm = "", $date_to = "")
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_invoice
              WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status = 'Pending'",
            "ss", array($date_frm, $date_to));
    }

    public static function count_delivered_orders($date_frm = "", $date_to = "")
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_invoice
              WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status = 'Delivered'",
            "ss", array($date_frm, $date_to));
    }

    public static function count_cancelled_orders($date_frm = "", $date_to = "")
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_invoice
              WHERE rox_inv_date BETWEEN ? AND ? AND rox_inv_status = 'Cancelled'",
            "ss", array($date_frm, $date_to));
    }

    public static function count_new_users($date_frm = "", $date_to = "")
    {
        return (int)self::scalar(
            "SELECT COUNT(*) FROM rox_customers WHERE joined_date BETWEEN ? AND ?",
            "ss", array($date_frm, $date_to));
    }

    // ---------------------------------------------------------------
    // Money
    // ---------------------------------------------------------------

    /*
     * Value of everything invoiced in the period.
     * rox_dis_calculate_amount is the line total AFTER the line discount,
     * which is the same figure the reports and the printed bill use.
     * Delivery + service charges come from rox_payment.
     */
    public static function total_sales($date_frm = "", $date_to = "")
    {
        return (float)self::scalar(
            "SELECT COALESCE(SUM(oi.rox_dis_calculate_amount),0)
               FROM rox_invoice i
               JOIN rox_order_info oi ON oi.rox_inv_id = i.rox_inv_auto_id
              WHERE i.rox_inv_date BETWEEN ? AND ?
                AND i.rox_inv_status  <> 'Cancelled'
                AND oi.rox_ord_status <> 'Cancelled'",
            "ss", array($date_frm, $date_to), 0);
    }

    /*
     * Cash actually collected in the period: the advance taken when the
     * order was placed, plus every balance payment settled since.
     */
    public static function total_collected($date_frm = "", $date_to = "")
    {
        $advance = (float)self::scalar(
            "SELECT COALESCE(SUM(rox_advc),0) FROM rox_payment
              WHERE rox_pay_date BETWEEN ? AND ?",
            "ss", array($date_frm, $date_to), 0);

        $balance = (float)self::scalar(
            "SELECT COALESCE(SUM(rox_payment),0) FROM rox_balance_payment
              WHERE rox_pay_date BETWEEN ? AND ?",
            "ss", array($date_frm, $date_to), 0);

        return $advance + $balance;
    }

    /* Money still owed on orders invoiced in the period. */
    public static function total_outstanding($date_frm = "", $date_to = "")
    {
        $billed    = self::total_sales($date_frm, $date_to);

        $received = (float)self::scalar(
            "SELECT COALESCE(SUM(p.rox_advc),0)
               FROM rox_payment p
               JOIN rox_invoice i ON i.rox_inv_auto_id = p.rox_inv_id
              WHERE i.rox_inv_date BETWEEN ? AND ? AND i.rox_inv_status <> 'Cancelled'",
            "ss", array($date_frm, $date_to), 0);

        $settled = (float)self::scalar(
            "SELECT COALESCE(SUM(b.rox_payment),0)
               FROM rox_balance_payment b
               JOIN rox_invoice i ON i.rox_inv_auto_id = b.rox_inv_id
              WHERE i.rox_inv_date BETWEEN ? AND ? AND i.rox_inv_status <> 'Cancelled'",
            "ss", array($date_frm, $date_to), 0);

        $due = $billed - $received - $settled;
        return $due > 0 ? $due : 0;
    }
}
