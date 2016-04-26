<?php
error_reporting('E_All');
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/objects.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/categories.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/header.php');
?>
<a href="../index.php" class="btn btn-primary"><i class="glyphicon glyphicon-home"></i> На главную</a><br>
<h3>Добавление объекта</h3><br>
<form class="form-inline" method="post" action="">
    <div class="form-group">
        <select autofocus class="form-control" id="sel1" name="category">
            <option disabled selected>Выберите категорию</option>
            <?php Category::change_category(); ?>
</select>
</div><br><br>
Название объекта: <input class="form-control" type="text" name="object_name" />
Атрибут объекта: <input class="form-control" type="text" name="attribute" />
<input class="btn btn-primary" type="submit" value="Добавить" />
</form>
<?php
if($_POST['category'] != null && $_POST['object_name'] != null && $_POST['attribute'] != null)
{
    global $link;
    $category = mysqli_real_escape_string($link, $_POST['category']);
    $object_name = mysqli_real_escape_string($link, $_POST['object_name']);
    $attribute = mysqli_real_escape_string($link, $_POST['attribute']);
    $create_date = mysqli_real_escape_string($link, $_POST['create_date']);
    Object::add_object($category, $object_name, $attribute);
}
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db_close.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/footer.php');
?>