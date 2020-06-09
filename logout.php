<?php
session_start();
require "library/Config.php";
$config = new Config();
unset($_SESSION['login']);
unset($_SESSION['id_user']);
unset($_SESSION['role']);
$config->redirectUrl('login.php?sts=logout');
?>