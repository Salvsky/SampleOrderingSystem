<?php
include('../config/constants.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Ordering System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login Page</h1>

        <?php
            if(isset($_SESSION['login-status'])){
                echo $_SESSION['login-status'];
                unset($_SESSION['login-status']);
            }

            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

        ?>

    <br>
        <!-- LOGIN FORM STARTS HERE-->
        <form action="#" method="POST" class="text-center">
            Username : 
            <input type="text" name="FORMUsername" placeholder="Enter Username">
            <br><br>
            Password :
            <input type="password" name="FORMPassword" placeholder="Enter Password">
            <br> <br>
            <input type="submit" name="FORMSubmit" value="Login" class="btn-primary">

        </form>
        <br>
        <!-- LOGIN FORM ENDS HERE-->

        <p class="text-center">Created by <a href="https://youtu.be/bk_5SAH7Oyk?si=gyhD11EcknQuBuWL">Salvsky</a></p>
    </div>
</body>
</html>


<?php
    // Check whether the submit button is clicked or not

    if(isset($_POST['FORMSubmit'])){
        // Process for login
        // 1. Get the Data from the Login Form

        $username = $_POST['FORMUsername'];
        $password = md5($_POST['FORMPassword']);


        // 2. SQL to Check whether the user with username and password exist or not

        $queryValidate = "SELECT * FROM tbl_admin WHERE 
        username = '$username' AND password = '$password'";

        $sqlValidate = mysqli_query($conn, $queryValidate);

            if($sqlValidate == true){
                $count = mysqli_num_rows($sqlValidate);
                if($count == 1){
                    $_SESSION['login-status'] = "<div class='success'>Login Successful.</div>";
                    $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout will unset it

                    header("location:".SITEURL.'admin/index.php');
                }else{
                    $_SESSION['login-status'] = "<div class='error text-center'>Login Failed.</div>";
                    header("location:".SITEURL.'admin/login.php');
                }
            }

    }


?>