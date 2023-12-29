<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
            // 1. Get the ID of selected Admin
                $identification = $_GET['id'];

            // 2. Create SQL Query to get the details
                $querySelect = "SELECT * FROM tbl_admin WHERE id = $identification";

            // 3. Execute the Query

                $sqlSelect = mysqli_query($conn, $querySelect);

            // Check whether the query is executed or not
            if($sqlSelect == true){
                // Check whether the data is available or not
                $count = mysqli_num_rows($sqlSelect);
                // Check whether we have admin data or not
                if($count == 1){
                    // Get the details
                    // echo ("<script>alert('Admin available')</script>");
                    $row = mysqli_fetch_assoc($sqlSelect);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }else{
                    //redirect to manage admin page
                    echo ("<script>alert('Admin not found')</script>");
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }



        ?>

        <form action="#" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="FORMUpdate_Fullname" value="<?php echo $full_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="FORMUpdate_Username" value="<?php echo $username;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="FORMUpdate_id" value="<?php echo $identification;?>">
                        <input type="submit" name="FORMUpdate_Admin" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>
        
    </div>

</div>


<?php 

    // Check whether the submit button is clicked or not
        if(isset($_POST['FORMUpdate_Admin'])){

            // Get all the values from form to update
            $id = $_POST['FORMUpdate_id'];
            $UpdatedFullname = $_POST['FORMUpdate_Fullname'];
            $UpdatedUsername = $_POST['FORMUpdate_Username'];
 
            // Create a SQL Query to Update Admin
            
            $queryUpdate = "UPDATE tbl_admin SET
            full_name = '$UpdatedFullname', username = '$UpdatedUsername'
            WHERE id = '$id'
            ";

            // Execute the Query
            
            $sqlUpdate = mysqli_query($conn, $queryUpdate);

            if($sqlUpdate == true){

                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
                // echo ("<scr ipt>alert('Galing mo brad, pasok')</script>");
                header('location:'.SITEURL.'admin/manage-admin.php');
            }else{
                // echo ("<script>alert('Ulit tol, di ko nakuha')</script>");
                $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }
?>



<?php
include('partials/footer.php');
?>