<?php
error_reporting('E_All');
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/objects.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/site/index.php');
Object::show_all_objects();
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db_close.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/footer.php');
?>