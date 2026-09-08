<?php
/* ------------------------------------------------------------------
 * Single source of truth for the database credentials.
 * Every connection in the system (dbcon.php + all class files) reads
 * from here, so the credentials only ever need to be changed in ONE
 * place when the site is moved to another server.
 * ------------------------------------------------------------------ */

$servername = "localhost";
$db_user    = "trbsysne2_royal";
$db_pass    = "Royal@508";
$db_dbName  = "trbsysne2_royal";

/* PHP 8.1 turned mysqli errors into thrown exceptions by default.
 * This code base relies on mysqli_query() simply returning FALSE on
 * error, so we restore the old behaviour globally. Without this a
 * single bad query anywhere kills the whole page with a blank 500. */
if (function_exists('mysqli_report')) {
    mysqli_report(MYSQLI_REPORT_OFF);
}

if (!function_exists('rb_prepare_connection')) {
    /**
     * Settings every connection in the system needs.
     *
     * MySQL 5.7/8 enable STRICT_TRANS_TABLES, NO_ZERO_DATE and
     * ONLY_FULL_GROUP_BY by default. This application was written for
     * MySQL 5.x defaults and depends on all three being off:
     *
     *   - invoices are written with rox_inv_2_date = '0000-00-00'
     *     ("balance not settled yet"), which NO_ZERO_DATE rejects;
     *   - the order/report queries SELECT many columns while grouping
     *     by rox_inv_id, which ONLY_FULL_GROUP_BY rejects.
     *
     * Relaxing the mode for THIS connection only keeps the behaviour
     * identical to the old server without touching the database or any
     * other application sharing it.
     */
    function rb_prepare_connection($conn)
    {
        if (!$conn || $conn->connect_error) {
            return $conn;
        }
        $conn->set_charset("utf8mb4");
        @$conn->query("SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION'");
        return $conn;
    }
}
