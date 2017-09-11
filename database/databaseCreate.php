<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/8/2017
 * Time: 1:32 PM
 */

    $conn = mysqli_connect("127.0.0.1", "root", "");
    $conn->query("CREATE DATABASE dvd_shop");

    echo "DB dvd_shop created";

    $conn->close();