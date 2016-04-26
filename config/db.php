<?php
$link = mysqli_connect("localhost", "root", "", "crud");
if (mysqli_connect_errno()) {
    echo "Подключение не установлено";
    die();
}
?>