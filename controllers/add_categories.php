<?php
error_reporting('E_All');
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/categories.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/site/add_categories.php');
if($_POST['category_name'] != null)
{
    global $link;
    $category = mysqli_real_escape_string($link, $_POST['category_name']);
    Category::add_category($category);
}
Category::show_all_categories();
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db_close.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/footer.php');
?>