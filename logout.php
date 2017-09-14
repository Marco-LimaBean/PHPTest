<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/14/2017
 * Time: 7:40 AM
 */
session_start();
session_destroy();
header("Location: index");