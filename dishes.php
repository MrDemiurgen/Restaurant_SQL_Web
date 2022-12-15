<?php
$dishes_id_serial = "";
$emploeer_id_serial = "";
$name = "";
$category = "";
$weight = "";
$cost = "";
$recipe = "";

require_once 'include/db.php';

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['dishes_id_serial'];
    $posts[1] = $_POST['emploeer_id_serial'];
    $posts[2] = $_POST['name'];
    $posts[3] = $_POST['category'];
    $posts[4] = $_POST['weight'];
    $posts[5] = $_POST['cost'];
    $posts[6] = $_POST['recipe'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM `Dishes` WHERE dishes_id_serial = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $dishes_id_serial = $row['dishes_id_serial'];
                $emploeer_id_serial = $row['emploeer_id_serial'];
                $name = $row['name'];
                $category = $row['category'];
                $weight = $row['weight'];
                $cost = $row['cost'];
                $recipe = $row['recipe'];
            }
        }else{
            $var1= 'No Data For This id';
        }
    }else{
        $var1= 'Result Error';
    }
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    if(filter_var($data[4],FILTER_VALIDATE_INT)){
    $insert_Query = "INSERT INTO `Dishes`(`emploeer_id_serial`,`name`, `category`, `weight`, `cost`, `recipe`) VALUES ($data[1],'$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
               $var1= 'Data Inserted';
            }else{
               $var1= 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}
else{
$var1= "Invalid data";
}
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();

  $delete_Query = "DELETE FROM `Recipe products` WHERE `dishes_id_serial` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }


    $delete_Query = "DELETE FROM `Dishes` WHERE `dishes_id_serial` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $var1= 'Data Deleted';
            }else{
                $var1='Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
       $var1= 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    if(filter_var($data[4],FILTER_VALIDATE_INT)){
    $update_Query = "UPDATE `Dishes` SET `emploeer_id_serial`=$data[1],`name`='$data[2]',`category`='$data[3]',`weight`='$data[4]',`cost`='$data[5]',`recipe`='$data[6]' WHERE `dishes_id_serial` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $var1= 'Data Updated';
            }else{
               $var1='Data Not Updated';
            }
        }
    } catch (Exception $ex) {
       $var1= 'Error Update '.$ex->getMessage();
    }
}
else{
    $var1= "Invalid data";
}
}

?>

<!DOCTYPE Html>
<html>
    <head>
        <title>Dishes</title>
          <link rel="shortcut icon" href="/images/icon_bd.png" type="image/png">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
       <a href="menu.php"><img src="/images/arrow.png" id = f3></a>
        <form action="" method="post">
       <article class="shadowbox" >
        <p id=f2> Dishes</p>
            <input type="number" name="dishes_id_serial" placeholder="id" value="<?php echo $dishes_id_serial;?>"><br><br>
            <input type="number" name="emploeer_id_serial" placeholder="emploeer id" value="<?php echo $emploeer_id_serial;?>"><br><br>
            <input type="text" name="name" placeholder="Name" value="<?php echo $name;?>"><br><br>
            <input type="text" name="category" placeholder="category" value="<?php echo $category;?>"><br><br>
            <input type="text" name="weight" placeholder="weight" value="<?php echo $weight;?>"><br><br>
            <input type="text" name="cost" placeholder="cost" value="<?php echo $cost;?>"><br><br>
            <input type="text" name="recipe" placeholder="recipe" value="<?php echo $recipe;?>"><br><br>
            <div>
                <!-- Input For Add Values To Database-->
                <input type="submit" name="insert" value="Add">
                
                <!-- Input For Edit Values -->
                <input type="submit" name="update" value="Update">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given dishes_id_serial -->
                <input type="submit" name="search" value="Find">
            </div>
        </form>

                <?php
$sql = "SELECT * FROM Dishes";
if($result = $connect->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
    echo "<p id =p1> $var1 </p>";
    echo "<p id =p1>Amount of rows: $rowsCount</p>";
    echo "  <table  border=5 id= p1> <tr><th>Id</th><th>Name</th><th>Emploeer id</th><th>Category</th><th>Weight</th><th>Cost</th><th>Recipe</th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row['dishes_id_serial'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
 echo "<td>" . $row['emploeer_id_serial'] . "</td>";
 echo "<td>" . $row['category'] . "</td>";
echo "<td>" . $row['weight'] . "</td>";
echo "<td>" . $row['cost'] . "</td>";
echo "<td>" . $row['recipe'] . "</td>";
           
        echo "</tr>";
    }
 
    echo "</table>";
    $result->free();
} else{
    echo "Ошибка: " . $connect->error;
}
$connect->close();
?>
    </article>
    </body>
</html>