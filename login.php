<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/13/2017
 * Time: 4:00 PM
 */

if (!isset($_SESSION)) session_start();

include_once('functionsCustomer.php');
include_once('functionsMain.php');

if (isset($_POST['customerID'], $_POST['customerPassword']) && is_string($_POST['customerID'])
    && is_string($_POST['customerPassword'])) {

    if (login($_POST['customerID'], $_POST['customerPassword'])) {
        //passed password verification.
        $_SESSION['loggedIn'] = $_POST['customerID'];
        refresh();
    } else {
        jsAlert("Username or password incorrect, please try again.");
        unset($_SESSION['loggedIn']);
    }
}

include('html/loginForm.html');