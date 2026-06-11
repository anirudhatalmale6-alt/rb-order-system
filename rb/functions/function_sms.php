<?php

include("../class/class_orders.php");
include("../class/class_sms.php");


if (isset($_POST['txt_msg'])){

    $msg=$_POST['txt_msg'];
    $inv=class_sms::select_all_from_cus();
    while($row=mysqli_fetch_array($inv)){
        $num=$row['cus_mobile'];
        //echo '94'.$num;
        $url = 'https://digitalreachapi.dialog.lk/refresh_token.php';

// DATA JASON ENCODED
        $data = array("u_name" => "royalbakery1", "passwd" => "royal@12345");
        $data_json = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// DATA ARRAY
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false)
            $response = curl_error($ch);
        echo stripslashes($response);
        curl_close($ch);
        $url = 'https://digitalreachapi.dialog.lk/camp_req.php';


// DATA JASON ENCODED
        $data = array(
            "msisdn" => "94$num",
            "channel" => "1",
            "mt_port" => "RoyalBakery",
            "s_time" => "2017-11-01 17:05:00",
            "e_time" => "2019-11-01 17:20:00",
            "msg" => "$msg",

            "callback_url" => "https://digitalreachapi.dialog.lk//call_back.php"
        );
        $data_json = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        $obj = json_decode($response);
        $data_1=$obj->{'access_token'}; // 12345

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:'.$data_1.' '));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// DATA ARRAY
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false)
            $response = curl_error($ch);
        echo stripslashes($response);

        curl_close($ch);

        $obj = json_decode($response);
        $data_1=$obj->{'error'};
    }

    echo '<script type="text/javascript">window.location="../Promotions?status=success";</script>';
}



