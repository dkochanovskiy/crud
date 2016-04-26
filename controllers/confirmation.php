<?php
error_reporting('E_ALL');
include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/models/objects.php');
if(isset($_GET['id']) && isset($_POST['action']))
{
    $id = (int)$_GET['id'];
    Object::delete_objects($id);
    header("Location: ../index.php");
}
$title = 'Удаление объекта';
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/views/site/confirmation.php');
?>
<a href="../controllers/show.php?id=<?php
 if(isset($_GET['id']))
{
    $id = (int)$_GET['id'];
    echo $id;
}
 ?>" class="btn btn-primary">Нет</a>
</form>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/footer.php');
?>