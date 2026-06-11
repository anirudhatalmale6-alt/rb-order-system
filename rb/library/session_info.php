<?php
/* Login and Lock Screen validations*/
/* 28-07-2017 4.30 PM*/

session_start();
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 'off');

	$conn = null;
	$login_rox_table_name = null;
	$authority_rox_table_name = null;
	$login_rox_table_filed_email = null;
	$login_rox_table_filed_level = null;
	$authority_rox_status = null;
	$login_rox_user_level = null;
	$roxwall_AUTH_ID = null;
	$authority_rox_table_filed_web_access = null;
	$authority_rox_table_filed_chief_acc = null;
	$authority_rox_table_filed_manager = null;
	$authority_rox_table_filed_employee = null;
	$authority_rox_table_filed_acc = null;

	include('library/dbcon.php');
	include('library/table_info.php');

	$roxwall_AUTH_IDMD5 = null;
	$roxwall_rowcount = null;
	$roxwall_u_id = null;
	$user_check = $_SESSION['admin_user_email'] ?? null;
	$roxwall_AUTH_IDMD5 = $user_check !== null ? md5($user_check) : null;
	$admin_role = null;
	$link = $_GET['page'] ?? '';

	if (isset($_SESSION) && $user_check !== null) {

		if ($roxwall_AUTH_IDMD5 === $roxwall_AUTH_ID) {

			$roxwall_u_id = 1;
			$f_name = 'Super Admin';
			$l_name = 'Master';
			$admin_role = 'Admin';
		} else {

			$stmt = $conn->prepare("SELECT rox_admin_id, rox_admin_role FROM rox_admin_user WHERE rox_user_name = ?");
			$stmt->bind_param("s", $user_check);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_assoc()) {
				$roxwall_u_id = $row['rox_admin_id'];
				$admin_role = $row['rox_admin_role'];
			}
			$stmt->close();
		}

		if ($roxwall_u_id !== null) {
			$_SESSION['sendpage'] = null;
			$_SESSION['sendpage'] = $link;
			$authority_rox_table_filed = null;

			if ($admin_role === "Manager") {
				$authority_rox_table_filed = $authority_rox_table_filed_manager;
			} else if ($admin_role === "Employee") {
				$authority_rox_table_filed = $authority_rox_table_filed_employee;
			} else if ($admin_role === "Accountant") {
				$authority_rox_table_filed = $authority_rox_table_filed_acc;
			} else if ($admin_role === "Chief Accountant") {
				$authority_rox_table_filed = $authority_rox_table_filed_chief_acc;
			} else if ($admin_role === "Sales") {
				$authority_rox_table_filed = $authority_rox_table_filed_rox_sales ?? null;
			}

			if ($admin_role !== "Admin") {

				$sql2 = "SELECT count(*) FROM " . $authority_rox_table_name . " WHERE " . $authority_rox_table_filed_web_access . " = ? AND " . ($authority_rox_table_filed ?? '') . " = ?";
				$stmt2 = $conn->prepare($sql2);
				if ($stmt2) {
					$stmt2->bind_param("ss", $link, $authority_rox_status);
					$stmt2->execute();
					$result2 = $stmt2->get_result();
					if ($result2) {
						while ($row = $result2->fetch_array()) {
							$roxwall_rowcount = $row[0];
						}
					}
					$stmt2->close();
				}
			}

			if ($admin_role === "Admin") {
				$roxwall_rowcount = 1;
			}
			if ($roxwall_rowcount == 0) {
				check_permission($admin_role);
			}
		}
		if ($roxwall_u_id === null) {
			echo '<script type="text/javascript">window.location="index";</script>';
		}
	} else {
		echo '<script type="text/javascript">window.location="index";</script>';
	}

	function check_permission($admin_role) {

		$user_level = unserialize(USER_LEVELS);
		$cashier_permissions = unserialize(CASHIER_PERMISSIONS);
		$accountant_permissions = unserialize(ACCOUNTANT_PERMISSIONS);
		$page = $_GET['page'] ?? '';

		if ($admin_role === ($user_level[1] ?? '')) {
			if (!in_array($page, $accountant_permissions)) {
				echo '<script type="text/javascript">window.location="403";</script>';
			}
		}
		if ($admin_role === ($user_level[2] ?? '')) {
			if (!in_array($page, $cashier_permissions)) {
				echo '<script type="text/javascript">window.location="403";</script>';
			}
		}
	}

?>
