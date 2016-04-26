<?php
error_reporting('E_All');
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/objects.php');
if (isset($_GET['id']) != null && isset($_POST['object_name']) != null && isset($_POST['attribute']) != null && isset($_POST['save']))
{
    global $link;
    $id = (int)$_GET['id'];
    $object_name = mysqli_real_escape_string($link,$_POST['object_name']);
    $attribute = mysqli_real_escape_string($link,$_POST['attribute']);
    $current_time = date("Y-m-d H:i:s");
    Object::edit_object($id, $object_name, $attribute, $current_time);
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db_close.php');
    header('Location: show.php?id='.$id);
}
if(isset($_GET['id']) != null && isset($_POST['back']))
{
    $id = (int)$_GET['id'];
    header('Location: show.php?id='.$id);
}
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/header.php');
?>
<form class="form-inline" method="post" action="">
    <input class="btn btn-primary" type="submit" name="back" value="Назад" /><br>
    <h3>Редактирование объекта</h3><br>
    Название обекта: <input class="form-control" type="text" name="object_name" value="<?php
    if(isset($_GET['id']) != null)
    {
        global $link;
        $id = (int)$_GET['id'];
        $query = "SELECT * FROM `objects` WHERE `id` = '{$id}'";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_assoc($result))
        {
            echo $row['object_name'];
        }
    }
    ?>" />
    Атрибут: <input class="form-control" type="text" name="attribute"  value="<?php
    if (isset($_GET['id']) != null)
    {
        global $link;
        $id = (int)$_GET['id'];
        $query = "SELECT * FROM `objects` WHERE `id` = '{$id}'";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_assoc($result))
        {
            echo $row['attribute'];
        }
    }
    ?>" />
    <input class="btn btn-primary" type="submit" name="save" value="Сохранить изменения" />
</form>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db_close.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/footer.php');
?>