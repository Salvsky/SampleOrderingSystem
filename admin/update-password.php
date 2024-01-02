<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br> <br>   

        <?php
            if(isset($_GET['id'])){
                $ChangePasswordId = $_GET['id'];
            }
        
        
        ?>


        <form action="#" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="FORMCurrentPassword" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="FORMNewPassword" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="FORMConfirmNewPassword" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="hidden" name="FORMChangePasswordId" value="<?php echo $ChangePasswordId; ?>">
                    <input type="submit" name="FORMChangePassword"value="Change Password" class="btn-primary">
                </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    //check whether the submit button was click
    if(isset($_POST['FORMChangePassword'])){
        // echo("<script>alert('Ayun gumana brad!')</script>");
        // 1. Get the data from form
        
            $id = $_POST['FORMChangePasswordId'];
            $current_password = md5($_POST['FORMCurrentPassword']);
            $new_password = md5($_POST['FORMNewPassword']);
            $confirm_password = md5($_POST['FORMConfirmNewPassword']);

        // 2 check whether the the user with the current ID and Current Password exists or not
            $querySelect = "SELECT * FROM tbl_admin WHERE 
            id = $id AND password = '$current_password'";

        // Execute the query

            $sqlSelect = mysqli_query($conn, $querySelect);

            if($sqlSelect==true){
                //check whether the data is available or not
                $count = mysqli_num_rows($sqlSelect);
                
                                    if($count == 1){
                                        // user exist and password can be change
                                        // echo ("<script>alert('User Found')</script>");
                                        // Check whether the new password and confirm password match or not
                                                if($new_password == $confirm_password){
                                                    // update the password
                                                    // echo ("<script>alert('Nays pareho')</script>");
                                                    $queryUpdate = "UPDATE tbl_admin SET
                                                        password = '$new_password' WHERE id = $id";
                                                    $sqlUpdate = mysqli_query($conn, $queryUpdate);

                                                                        if($sqlUpdate == true){
                                                                        $_SESSION['password-change'] = "<div class='success'> Password was changed successfully</div>";
                                                                        header('location:'.SITEURL.'admin/manage-admin.php');
                                                                        }else{
                                                                            $_SESSION['password-change'] = "<div class='error'>Password change Unsuccessful</div>";
                                                                            header('location:'.SITEURL.'admin/manage-admin.php');
                                                                                }

                                                }else{
                                                // redirect to manage admin page with error message
                                                    $_SESSION['password-error'] = "<div class='error'>Password did not match</div>";
                                                    header('location:'.SITEURL.'admin/manage-admin.php');
                                                }

                                    }else{
                                        // user does not exist
                                        // echo ("<script>alert('User Not Found')</script>");
                                        $_SESSION['user-status'] = "<div class='error'>User Not Found</div>";
                                        header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
    }

?>



<?php 
include('partials/footer.php');
?>