<?php

/*
 * this class is used to verify user password and user id
 * when user login to system class will create the session for user
 * redirect to dashboard if user logon and if user log out system will redirect to home page it means login page.
 * */



class Rrandom_password
{

    public static function reset_code($length = 20)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }
    public static function vacancy_code($length = 30)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

    public static function random_password_employee($length = 20)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$#!";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

}

?>