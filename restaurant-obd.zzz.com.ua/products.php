<?php
$product_id_serial = "";
$name = "";
$provider_id_serial = "";
$number_in_storage = "";
$number_of_ordered = "";
$date_of_creation = "";
$expiration_date = "";
$cost = "";

require_once 'include/db.php';

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['product_id_serial'];
    $posts[1] = $_POST['name'];
    $posts[2] = $_POST['provider_id_serial'];
    $posts[3] = $_POST['number_in_storage'];
    $posts[4] = $_POST['number_of_ordered'];
    $posts[5] = $_POST['date_of_creation'];
    $posts[6] = $_POST['expiration_date'];
    $posts[7] = $_POST['cost'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM Products WHERE product_id_serial  = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $product_id_serial  = $row['product_id_serial'];
                $name = $row['name'];
                $provider_id_serial = $row['provider_id_serial'];
                $number_in_storage = $row['number_in_storage'];
                $number_of_ordered = $row['number_of_ordered'];
                $date_of_creation = $row['date_of_creation'];
                $expiration_date = $row['expiration_date'];
                $cost = $row['cost'];
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
    if(filter_var($data[3],FILTER_VALIDATE_INT)&&filter_var($data[4],FILTER_VALIDATE_INT)) {
    if($data[5]==NULL && $data[6]!=NULL)
    {
         $insert_Query = "INSERT INTO Products( name, provider_id_serial, number_in_storage, number_of_ordered, expiration_date, cost) VALUES ('$data[1]',$data[2],$data[3],$data[4],'$data[6]',$data[7])";
    }
    if($data[6]==NULL && $data[5]!=NULL)
    {
         $insert_Query = "INSERT INTO Products( name, provider_id_serial, number_in_storage, number_of_ordered, date_of_creation, cost) VALUES ('$data[1]',$data[2],$data[3],$data[4],'$data[5]',$data[7])";
    }
    if($data[5]==NULL && $data[6]==NULL)
    {
         $insert_Query = "INSERT INTO Products( name, provider_id_serial, number_in_storage, number_of_ordered, cost) VALUES ('$data[1]',$data[2],$data[3],$data[4],$data[7])";
    }
    if($data[5]!=NULL && $data[6]!=NULL)
    {
    $insert_Query = "INSERT INTO Products( name, provider_id_serial, number_in_storage, number_of_ordered, date_of_creation, expiration_date, cost) VALUES ('$data[1]',$data[2],$data[3],$data[4],'$data[5]','$data[6]',$data[7])";
    }
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                //echo 'Data Inserted';
                $var1="Data Inserted";
            }else{
                 $var1='Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        $var1= 'Error Insert '.$ex->getMessage();
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

  $delete_Query = "DELETE FROM `Recipe products` WHERE `product_id_serial` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
    } catch (Exception $ex) {
         $var1 ='Error Delete '.$ex->getMessage();
    }


    $delete_Query = "DELETE FROM `Products` WHERE `product_id_serial` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $var1='Data Deleted';
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
    if(filter_var($data[3],FILTER_VALIDATE_INT)&&filter_var($data[4],FILTER_VALIDATE_INT)) {
    $update_Query = "UPDATE `Products` SET `name`='$data[1]',`provider_id_serial`=$data[2],`number_in_storage`=$data[3],`number_of_ordered`=$data[4],`date_of_creation`='$data[5]',`expiration_date`='$data[6]',`cost`=$data[7] WHERE `product_id_serial` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                 $var1= 'Data Updated';
            }else{
                 $var1= 'Data Not Updated';
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
        <title>Products</title>
             <link rel="shortcut icon" href="/images/icon_bd.png" type="image/png">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
<a href="menu.php"><img src="/images/arrow.png" id = f3></a>
        <form action="" method="post">
       <article class="shadowbox" >

        <p id=f2> Products</p>
            <input type="number" id=f1 name="product_id_serial" placeholder="id" value="<?php echo $product_id_serial;?>"><br><br>
            <input type="text"  id=f1 name="name" placeholder="Name" value="<?php echo $name;?>"><br><br>
            <input type="number"id=f1  name="provider_id_serial" placeholder="provider id" value="<?php echo $provider_id_serial;?>"><br><br>
            <input type="text"id=f1  name="number_in_storage" placeholder="number in storage" value="<?php echo $number_in_storage;?>"><br><br>
            <input type="text" id=f1 name="number_of_ordered" placeholder="number of ordered" value="<?php echo $number_of_ordered;?>"><br><br>
            <input type="datetime-local" id=f1 name="date_of_creation" placeholder="0000-00-00 00:00:00" value="<?php echo $date_of_creation;?>"><br><br>
            <input type="datetime-local"id=f1  name="expiration_date" placeholder="0000-00-00 00:00:00" value="<?php echo $expiration_date;?>"><br><br>
            <input type="text" name="cost"id=f1  placeholder="cost" value="<?php echo $cost;?>"><br><br>
            <div>
                <!-- Input For Add Values To Database-->
                <input type="submit" name="insert" value="Add">
                
                <!-- Input For Edit Values -->
                <input type="submit" name="update" value="Update">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given product_id_serial -->
                <input type="submit" name="search" value="Find">
            </div>
       
    </form>
<?php
$sql = "SELECT * FROM Products";
if($result = $connect->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
    echo "<p id =p1> $var1 </p>";
    echo "<p id =p1>Amount of rows: $rowsCount</p>";
    echo "  <table  border=5 id= p1> <tr><th>Id</th><th>Name</th><th>Provider id</th><th>Number in storage</th><th>Number of ordered</th><th>Date of creation</th><th>Expiration date</th><th>Cost</th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row['product_id_serial'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['provider_id_serial'] . "</td>";
 echo "<td>" . $row['number_in_storage'] . "</td>";
 echo "<td>" . $row['number_of_ordered'] . "</td>";
echo "<td>" . $row['date_of_creation'] . "</td>";
echo "<td>" . $row['expiration_date'] . "</td>";
echo "<td>" . $row['cost'] . "</td>";

           
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