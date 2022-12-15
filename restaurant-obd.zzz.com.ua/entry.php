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
    
    $sanitized_email = filter_var($data[5], FILTER_SANITIZE_EMAIL);
    $search_Query = "SELECT * FROM Employees WHERE email = '$sanitized_email' AND password='$data[6]'";
    
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
   echo  "<a href=menu.php> <p id =btn><u> $name, you have been successfully entered.
Please follow the link to proceed.</u> </p></a>";
        }
     
        else{
            echo  "<p id =btn><u>Error to log in.
Please try again.</u> </p>";
        }
    }else{
        echo 'Result Error';
    }
        
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
      #btn {
        position: absolute;
        left: 30%;
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
<link rel="shortcut icon" href="/images/icon_bd.png" type="image/png">
</head>
<body>

<form action=" " method="post">
  <div class="container">
    <h1>Entry</h1>
    <p>Please fill out this form to sign in to your account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" name="search" class="registerbtn">Entry</button>
  </div>
  
  <div class="container signin">
    <p>Don't have an account? <a href="/registration.php">Register in</a>.</p>
  </div>
</form>

</body>
</html>