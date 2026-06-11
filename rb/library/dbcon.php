<?php
/* DB Information */
$servername = "localhost";
$db_user = "trbsysne2_royal";
$db_pass = "Royal@508";
$db_dbName = "trbsysne2_royal";

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            global $servername, $db_user, $db_pass, $db_dbName;
            try {
                self::$instance = new PDO(
                    "mysql:host=$servername;dbname=$db_dbName;charset=utf8mb4",
                    $db_user,
                    $db_pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

// Backward compatibility: $conn as mysqli for files not yet migrated
$conn = new mysqli($servername, $db_user, $db_pass, $db_dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

function db(): PDO {
    return Database::getInstance();
}
?>
