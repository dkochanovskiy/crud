<?php
class Object
{
    public static function add_object($category_name, $object_name, $attribute)
    {
        global $link;
        $current_time = date("Y-m-d H:i:s");
        $query = "INSERT INTO `objects`(`id`, `category_name`, `object_name`, `attribute`, `create_date`, `status`, `count`) VALUES (NULL,'{$category_name}','{$object_name}','{$attribute}','{$current_time}', 'new', '0')";
        $result = mysqli_query($link, $query);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function show_all_objects()
    {
        global $link;
        if(isset($_GET['id']))
        {
            $id = (int)$_GET['id'];
            Object::delete_objects($id);
        }
        echo '<table class="table table-striped">';
        echo "<tr>
            <th>Объект</th>
            <th>Детальный просмотр</th>
            <th>Статус</th>
            </tr>";
        $query = "SELECT * FROM `objects` ";
        $result = mysqli_query($link, $query);
        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $id  = $row['id'];
                echo "<tr><td><b>Категория: </b>".$row['category_name'].", <b>Название объекта: </b>".$row['object_name']." ...</td>
                    <td><a href='../controllers/show.php?id=$id&title=Детальное_описание_объекта'><i class='glyphicon glyphicon-folder-open eye'><i></a></td>";
                if($row['status'] === 'new')
                {
                    echo "<td><i class='glyphicon glyphicon-eye-close eye'><i></td></tr>";
                }
                elseif($row['status'] === 'edited')
                {
                    echo "<td><i class='glyphicon glyphicon-retweet eye'><i></td></tr>";
                }
                elseif($row['status'] === 'reviewed')
                {
                    echo "<td><i class='glyphicon glyphicon-eye-open eye'><i></td></tr>";
                }
            }
            echo '</table>';
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function delete_objects($id)
    {
        global $link;
        $query = "DELETE FROM `objects` WHERE `id` = '$id' LIMIT 1";
        $result = mysqli_query($link, $query);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function edit_object($id, $object_name, $attribute, $update_date)
    {
        global $link;
        $query = "SELECT * FROM `objects` WHERE `id` = '$id'";
        $result = mysqli_query($link, $query);
        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if($row['status'] == 'reviewed')
                {
                    $status = 'edited';
                    $query = "UPDATE `objects` SET `id`='{$id}',`object_name`='{$object_name}',`attribute`='{$attribute}', `update_date`='{$update_date}', `status`='{$status}' WHERE `id`='{$id}';";
                    $result = mysqli_query($link, $query);
                }
                else
                {
                    $query = "UPDATE `objects` SET `id`='{$id}',`object_name`='{$object_name}',`attribute`='{$attribute}', `update_date`='{$update_date}' WHERE `id`='{$id}';";
                    $result = mysqli_query($link, $query);
                }
            }
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function show_one($id)
    {
        global $link;
        echo '<table class="table table-striped">';
        $query = "SELECT * FROM `objects` WHERE `id` = '$id'";
        $result = mysqli_query($link, $query);
        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><th>Категория</th><td>".$row['category_name']."</td></tr>
                    <tr><th>Название объекта</th><td>".$row['object_name']."</td></tr>
                    <tr><th>Атрибут</th><td>".$row['attribute']."</td></tr>
                    <tr><th>Дата и время создания</th><td>".$row['create_date']."</td></tr>";
                if($row['update_date'] !== '')
                {
                    echo "<tr><th>Дата и время последнего изменения</th><td>".$row['update_date']."</td></tr>";
                }
                else
                {
                    echo "<tr><th>Дата и время последнего изменения</th><td>Не редактировался</td></tr>";
                }
                echo "<tr><th>Просмотров</th><td>".$row['count']."</td></tr>
                    <tr><th>Редактирование</th><td><a href='../controllers/edit_objects.php?id=$id&title=Редактирование_объекта'><i class=\"glyphicon glyphicon-pencil\"></i></a></td></tr>
                    <tr><th>Удаление</th><td><a href='../controllers/confirmation.php?id=$id'><i class=\"glyphicon glyphicon-trash\"></i></a></td></tr>";
            }
            echo '</table>';
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function counter($id)
    {
        global $link;
        $query = "SELECT * FROM `objects` WHERE `id` = '$id'";
        $result = mysqli_query($link, $query);
        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $count = $row['count'];
                ++$count;
                $query = "UPDATE `objects` SET `id`='{$id}',`count`='{$count}' WHERE `id`='{$id}';";
                $result = mysqli_query($link, $query);
                if($row['status'] == 'new')
                {
                    $query = "UPDATE `objects` SET `id`='{$id}', `status`='reviewed' WHERE `id`='{$id}';";
                    $result = mysqli_query($link, $query);
                }
            }
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>