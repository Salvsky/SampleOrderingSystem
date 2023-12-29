<?php
include('partials/menu.php');
?>
<div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br> <br>

            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
            ?>

            <br> <br>
            <form action="#" method="POST">

                    <table class="tbl-30">
                        <tr>
                            <td>Full Name: </td>
                            <td><input type="text" name="FORMfull_name" placeholder="Enter your name"></td>
                        </tr>

                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="FORMuser_name" placeholder="Enter your username"></td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="FORMpassword"></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="FORMsubmit" value="Add Admin" class="btn-secondary">
                            </td>
                        </tr>
                    </table>

            </form>
        </div>
    </div>


<?php
include('partials/footer.php');
?>



<?php
    // process the value from form and save it in Database
    // check whether the submit button is clicked or not

    if(isset($_POST['FORMsubmit'])){
        // Button clicked
        // echo"Button Clicked";
        // 1. Get the Data from form

        $full_name = $_POST['FORMfull_name'];
        $username = $_POST['FORMuser_name'];
        $password = md5($_POST['FORMpassword']); // Password Encryption with MD5

        // SQL Query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        ";

        // 3. Executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (query is executed) data is inserted or not and display appropriate message.
        if($res==TRUE){
            // Data inserted
            // echo "Data INSERTED";
            // Create a Session variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            // Redirect page Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{
            //Data NOT inserted
            // echo "FAILED to Insert Data";
            // Create a Session variable to Display Message
            $_SESSION['add'] = "<div class='erro'>Failed to Add Admin.</div>";
            // Redirect page Add Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }

    }

?>