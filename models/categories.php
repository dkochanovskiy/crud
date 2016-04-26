<?php
class Category
{
    public static function add_category($category_name)
    {
        global $link;
        $query = "INSERT INTO `categories`(`id`, `category_name`) VALUES (NULL,'{$category_name}');";
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
    public static function show_all_categories(){
        global $link;
        if(isset($_GET['id']))
        {
            $id = (int)$_GET['id'];
            Category::delete_category($id);
        }
        echo '<table class="table table-striped">';
        $query = "SELECT * FROM `categories` ";
        $result = mysqli_query($link, $query);
        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $id  = $row['id'];
                echo '<tr><td>'.$row['category_name']."</td>
                <td><a href='../controllers/add_categories.php?id=$id&title=Добавление_категории'><i class=\"glyphicon glyphicon-trash\"></i></a></td></tr>";
            }
            echo '</table>';
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function delete_category($id)
    {
        global $link;
        $query = "DELETE FROM `categories` WHERE `id` = '$id' LIMIT 1";
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
    public static function change_category()
    {
        global $link;
        $query = "SELECT * FROM `categories` WHERE 1";
        $result = mysqli_query($link, $query);
        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<option value=".$row['category_name'].">".$row['category_name']."</option>";
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