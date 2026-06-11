<?php

if (isset($_POST['paracall'])) {

    $db = new mysqli("localhost", "trbsysne2_royal", "Royal@508", "trbsysne2_royal");
    $db->set_charset("utf8mb4");

    if ($_POST['paracall'] == "load_subcat") {
        $main_cate_id = $_POST["main_cate_id"];
        $stmt = $db->prepare("SELECT rox_sub_cate, rox_main_cate_id, rox_auto_id FROM rox_acc_sub_cate WHERE rox_main_cate_id = ? AND rox_status = '1' ORDER BY rox_sub_cate ASC");
        $stmt->bind_param("s", $main_cate_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $sub_arr = [];
        while ($row = $result->fetch_assoc()) {
            $sub_arr[] = ["sub_id" => $row['rox_sub_cate'], "sub_name" => $row['rox_sub_cate']];
        }
        echo json_encode($sub_arr);
    }

    if ($_POST['paracall'] == "load_product") {
        $product = $_POST["product"];
        $stmt = $db->prepare("SELECT rox_prd_name, rox_line_id FROM rox_product WHERE rox_prd_sub_cate = ? ORDER BY rox_prd_name ASC");
        $stmt->bind_param("s", $product);
        $stmt->execute();
        $result = $stmt->get_result();

        $prd_arr = [];
        while ($row = $result->fetch_assoc()) {
            $prd_arr[] = ["prd_name" => $row['rox_prd_name'], "auto_id" => $row['rox_line_id']];
        }
        echo json_encode($prd_arr);
    }

    if ($_POST['paracall'] == "load_main_prd") {
        $product = $_POST["main_cate_id"];
        $stmt = $db->prepare("SELECT rox_prd_name, rox_auto_id FROM rox_product WHERE rox_prd_main_cate = ? AND rox_prd_sub_cate = ''");
        $stmt->bind_param("s", $product);
        $stmt->execute();
        $result = $stmt->get_result();

        $prd_arr = [];
        while ($row = $result->fetch_assoc()) {
            $prd_arr[] = ["prd_name" => $row['rox_prd_name'], "auto_id" => $row['rox_auto_id']];
        }
        echo json_encode($prd_arr);
    }

    if ($_POST['paracall'] == "load_prd_price") {
        $prd_price = $_POST["prd_price"];
        $stmt = $db->prepare("SELECT rox_prd_price, rox_dis_status, rox_prd_name, rox_line_id FROM rox_product WHERE rox_line_id = ?");
        $stmt->bind_param("i", $prd_price);
        $stmt->execute();
        $result = $stmt->get_result();

        $prd_arr = [];
        while ($row = $result->fetch_assoc()) {
            $prd_arr[] = [
                "prd_price" => $row['rox_prd_price'],
                "prd_status" => $row['rox_line_id'],
                "prd_name" => $row['rox_prd_name'],
                "prd_id_dd" => $row['rox_line_id'],
                "dis_status" => $row['rox_dis_status']
            ];
        }
        echo json_encode($prd_arr);
    }

    if ($_POST['paracall'] == "search_product") {
        $term = $_POST["term"] ?? '';
        $search = "%" . $term . "%";
        $stmt = $db->prepare("SELECT rox_line_id, rox_prd_name, rox_prd_price, rox_prd_main_cate, rox_prd_sub_cate, rox_dis_status FROM rox_product WHERE rox_prd_name LIKE ? ORDER BY rox_prd_name ASC LIMIT 20");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();

        $prd_arr = [];
        while ($row = $result->fetch_assoc()) {
            $prd_arr[] = [
                "auto_id" => $row['rox_line_id'],
                "prd_name" => $row['rox_prd_name'],
                "prd_price" => $row['rox_prd_price'],
                "main_cate" => $row['rox_prd_main_cate'],
                "sub_cate" => $row['rox_prd_sub_cate'],
                "dis_status" => $row['rox_dis_status']
            ];
        }
        echo json_encode($prd_arr);
    }

    $db->close();
}
