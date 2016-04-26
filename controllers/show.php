<?php
error_reporting('E_ALL');
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/objects.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/site/show.php');
if(isset($_GET['id']))
{
    $id = (int)$_GET['id'];
    Object::counter($id);
    Object::show_one($id);
}
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/footer.php');
?>