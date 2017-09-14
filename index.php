<?php
if (!isset($_SESSION)) session_start();
$title = "PHP SpliceTest";
include("html/defaultHeader.html");
include("html/welcome.html");
echo "Logged in: ";
echo isset($_SESSION['loggedIn']) ? htmlspecialchars($_SESSION['loggedIn']) : "false.";
include("html/defaultFooter.html");
