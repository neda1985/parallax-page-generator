<?php
session_start();
include 'include/config.php';
//include PRESENTATION_DIR . 'application.php';
//include BUSINESS_DIR . 'class.DatabaseHandler.php';
//include BUSINESS_DIR . 'models/model.cms.php';
$page = new Application();
$page->display('master.tpl');
?>