<?php
/**
 * Created by PhpStorm.
 * User: jackob
 * Date: 2018/3/27
 * Time: 下午1:25
 */
include('./classes/DB.php');
include('./classes/Login.php');

if (!Login::isLoggedIn()) {
    die("Not logged in.");
}

if (isset($_POST['confirm'])) {

    if (isset($_POST['alldevices'])) {

        DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));

    } else {
        if (isset($_COOKIE['SNID'])) {
            DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
        }
        setcookie('SNID', '1', time()-3600);
        setcookie('SNID_', '1', time()-3600);
    }

}

?>