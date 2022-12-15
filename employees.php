<?php
$employes_id_serial = "";
$name = "";
$role = "";
$restaurant = "";
$phone_number = "";
$email = "";
$password = "";

require_once 'include/db.php';

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['employes_id_serial'];
    $posts[1] = $_POST['name'];
    $posts[2] = $_POST['role'];
    $posts[3] = $_POST['restaurant'];
    $posts[4] = $_POST['phone_number'];
    $posts[5] = $_POST['email'];
    $posts[6] = $_POST['password'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM Employees WHERE employes_id_serial = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $employes_id_serial = $row['employes_id_serial'];
                $name = $row['name'];
                $role = $row['role'];
                $restaurant = $row['restaurant'];
                $phone_number = $row['phone_number'];
                $email = $row['email'];
                $password = $row['password'];
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
    $sanitized_phone_number_insert = filter_var($data[4], FILTER_SANITIZE_NUMBER_INT);
    $sanitized_email_insert = filter_var($data[5], FILTER_SANITIZE_EMAIL);
    $insert_Query = "INSERT INTO `Employees`(`name`, `role`, `restaurant`, `phone_number`, `email`, `password`) VALUES ('$data[1]','$data[2]','$data[3]','$sanitized_phone_number_insert','$sanitized_email_insert','$data[6]')";
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
        $var1= 'Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();

  $delete_Query = "DELETE FROM `Recipe products` WHERE `dishes_id_serial` in (SELECT `dishes_id_serial` FROM `Dishes` WHERE `emploeer_id_serial`= $data[0])";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
    } catch (Exception $ex) {
       $var1= 'Error Delete '.$ex->getMessage();
    }



 $delete_Query = "DELETE FROM `Dishes` WHERE `emploeer_id_serial` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
    } catch (Exception $ex) {
        $var1= 'Error Delete '.$ex->getMessage();
    }


    $delete_Query = "DELETE FROM `Employees` WHERE `employes_id_serial` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $var1= 'Data Deleted';
            }
            else{
               $var1= 'Data Not Deleted';
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
    $sanitized_phone_number_update = filter_var($data[4], FILTER_SANITIZE_NUMBER_INT);
    $sanitized_email_update = filter_var($data[5], FILTER_SANITIZE_EMAIL);
    $update_Query = "UPDATE `Employees` SET `name`='$data[1]',`role`='$data[2]',`restaurant`='$data[3]',`phone_number`='$sanitized_phone_number_update',`email`='$sanitized_email_update',`password`='$data[6]' WHERE `employes_id_serial` = $data[0]";
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
        $var1='Error Update '.$ex->getMessage();
    }
}

?>

<!DOCTYPE Html>
<html>
    <head>
        <title>Employees</title>
         <link rel="shortcut icon" href="/images/icon_bd.png" type="image/png">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
       <a href="menu.php"><img src="/images/arrow.png" id = f3></a>
        <form action="" method="post">
       <article class="shadowbox" >
        <p id=f2> Employees</p>
            <input type="number" name="employes_id_serial" placeholder="id" value="<?php echo $employes_id_serial;?>"><br><br>
            <input type="text" name="name" placeholder="Name" value="<?php echo $name;?>"><br><br>
            <input type="text" name="role" placeholder="Role" value="<?php echo $role;?>"><br><br>
            <input type="text" name="restaurant" placeholder="Restaurant" value="<?php echo $restaurant;?>"><br><br>
            <input type="text" name="phone_number" placeholder="Phone number" value="<?php echo $phone_number;?>"><br><br>
            <input type="text" name="email" placeholder="Email" value="<?php echo $email;?>"><br><br>
            <input type="text" name="password" placeholder="Password" value="<?php echo $password;?>"><br><br>
            <div>
                <!-- Input For Add Values To Database-->
                <input type="submit" name="insert" value="Add">
                
                <!-- Input For Edit Values -->
                <input type="submit" name="update" value="Update">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given employes_id_serial -->
                <input type="submit" name="search" value="Find">
            </div>
                    <?php
$sql = "SELECT * FROM Employees";
if($result = $connect->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
    echo "<p id =p1> $var1 </p>";
    echo "<p id =p1>Amount of rows: $rowsCount</p>";
    echo "  <table  border=5 id= p1> <tr><th>Id</th><th>Name</th><th>Role</th><th>Restaurant</th> <th>Phone number</th> <th>Email</th><th>Password</th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row['employes_id_serial'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
 echo "<td>" . $row['role'] . "</td>";
 echo "<td>" . $row['restaurant'] . "</td>";
 echo "<td>" . $row['phone_number'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['password'] . "</td>";


           
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
        </form>
    </body>
</html>