<?php
$provider_id_serial = "";
$name = "";
$firm = "";
$phone_number = "";
$email = "";
$password = "";

require_once 'include/db.php';

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['provider_id_serial'];
    $posts[1] = $_POST['name'];
    $posts[2] = $_POST['firm'];
    $posts[3] = $_POST['phone_number'];
    $posts[4] = $_POST['email'];
    $posts[5] = $_POST['password'];
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    if($data[0]==0){
$var1= 'Result Error';

    }
        else{
    $search_Query = "SELECT * FROM Provider WHERE provider_id_serial = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $provider_id_serial = $row['provider_id_serial'];
                $name = $row['name'];
                $firm = $row['firm'];
                $phone_number = $row['phone_number'];
                $email = $row['email'];
                $password = $row['password'];
            }
        }else{
            $var1 ='No Data For This id';
        }
    }else{
        $var1= 'Result Error';
    }
}
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $sanitized_phone_number_insert = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
    $sanitized_email_insert = filter_var($data[4], FILTER_SANITIZE_EMAIL);
    $insert_Query = "INSERT INTO `Provider`(`name`, `firm`, `phone_number`, `email`, `password`) VALUES ('$data[1]','$data[2]','$sanitized_phone_number_insert','$sanitized_email_insert','$data[5]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $var1='Data Inserted';
            }else{
                $var1='Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        $var1='Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();


  $delete_Query = "DELETE FROM `Recipe products` WHERE `product_id_serial` in (SELECT `product_id_serial` FROM `Products` WHERE `provider_id_serial`= $data[0])";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
    } catch (Exception $ex) {
       $var1='Error Delete '.$ex->getMessage();
    }
 $delete_Query = "DELETE FROM `Products` WHERE `provider_id_serial` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
    } catch (Exception $ex) {
        $var1= 'Error Delete '.$ex->getMessage();
    }
    $delete_Query = "DELETE FROM `Provider` WHERE `provider_id_serial` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                 $var1 = 'Data Deleted';
            }else{
                 $var1 = 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
         $var1 = 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $sanitized_phone_number_update = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
    $sanitized_email_update = filter_var($data[4], FILTER_SANITIZE_EMAIL);
    $update_Query = "UPDATE `Provider` SET `name`='$data[1]',`firm`='$data[2]',`phone_number`='$sanitized_phone_number_update',`email`='$sanitized_email_update',`password`='$data[5]' WHERE `provider_id_serial` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
             $var1 = 'Data Updated';
            }else{
                 $var1 = 'Data Not Updated';
            }
        }
    } catch (Exception $ex) {
         $var1 = 'Error Update '.$ex->getMessage();
    }
}

?>

<!DOCTYPE Html>
<html>
    <head>
        <title>Provider</title>
        <link rel="shortcut icon" href="/images/icon_bd.png" type="image/png">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
       <a href="menu.php"><img src="/images/arrow.png" id = f3></a>
        <form action="" method="post">
       <article class="shadowbox" >
        <p id=f2> Provider</p>

        <form action="" method="post">
            <input type="number"  id= f1 name="provider_id_serial" placeholder="id" value="<?php echo $provider_id_serial;?>"><br><br>
            <input type="text" id= f1 name="name" placeholder="Name" value="<?php echo $name;?>"><br><br>
            <input type="text" id= f1 name="firm" placeholder="firm" value="<?php echo $firm;?>"><br><br>
            <input type="text" id= f1 name="phone_number" placeholder="Phone number" value="<?php echo $phone_number;?>"><br><br>
            <input type="text" id= f1 name="email" placeholder="Email" value="<?php echo $email;?>"><br><br>
            <input type="text" id= f1  name="password" placeholder="Password" value="<?php echo $password;?>"><br><br>
            <div>
                <!-- Input For Add Values To Database-->
                <input type="submit" name="insert" value="Add">
                
                <!-- Input For Edit Values -->
                <input type="submit" name="update" value="Update">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given provider_id_serial -->
                <input type="submit" name="search" value="Find">
            </div>
        </form>

        <?php
 
$sql = "SELECT * FROM Provider";
if($result = $connect->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
    echo "<p id =p1> $var1 </p>";
    echo "<p id =p1>Amount of rows: $rowsCount</p>";
    echo "  <table  border=5 id= p1> <tr><th>Id</th><th>Name</th><th>Firm</th><th>Phone number</th><th>Email</th><th>Password</th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row['provider_id_serial'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
 echo "<td>" . $row['firm'] . "</td>";
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
    </body>
</html>