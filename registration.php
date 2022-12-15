<?php 
namespace example;
require_once 'include/db.php';
$employes_id_serial = "";
$name = "";
$role = "";
$restaurant = "";
$phone_number = "";
$email = "";
$password = "";
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


if(isset($_POST['insert']))
{
    $data = getPosts();
    $sanitized_email = filter_var($data[5], FILTER_SANITIZE_EMAIL);
    $insert_Query = "INSERT INTO `Employees`(`name`, `role`, `restaurant`, `phone_number`, `email`, `password`) VALUES ('$data[1]','$data[2]','$data[3]','$data[4]','$sanitized_email','$data[6]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
       
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
    echo "<a href=menu.php> <p id =btn><u> You have been successfully registered.
Please follow the link to proceed.</u> </p></a>";
}

?>

<!DOCTYPE Html>
<style>
      #btn {
        position: absolute;
        left: 40%;
    display: inline-block; 
    background: #8C959D; 
    color: #fff; 
    padding: 2rem 1.5rem; 
    text-decoration: none; 
    border-radius: 3px; 
   }
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #EDC7B7;
    border: 1px solid;
}

* {
    box-sizing: border-box;
}

/* Add padding to containers */
.container {
    padding: 16px;
    background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
    background-color: #f1f1f1;
    text-align: center;
}
</style>
<html>
    <head>
        <title>Registration form</title>
         <link rel="shortcut icon" href="/images/icon_bd.png" type="image/png">
    </head>
    <body>  
        <form action="" method="post">
       <article class="container" >
    <h1>Register</h1>
     <p>Please fill in this form to create an account.</p>
              <label for="email"><b>Name</b></label>
            <input type="text" name="name" placeholder="Name" value="<?php echo $name;?>"><br><br>
             <label for="email"><b>Email</b></label>
            <input type="text" name="email" placeholder="Email" value="<?php echo $email;?>"><br><br>
            <label for="email"><b>Password</b></label>
            <input type="password" name="password" placeholder="Password" value="<?php echo $password;?>"><br><br>
                <!-- Input For Add Values To Database-->

               <input type="submit" name="insert"  class="registerbtn" value="Register">
            
              <div class="container signin">
    <p>Already have an account? <a href="/entry.php">Sign in</a>.</p>
  </div>
        </article>
        </form>
    </body>
</html>