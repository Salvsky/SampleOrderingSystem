<?php 
include('../config/constants.php');


 // 1. Get the ID of Admin to be deleted
$identification = $_GET['id'];

// 2. Create SQL Query to Delete Admin
$queryDelete = "DELETE FROM tbl_admin WHERE id = $identification";

// 3. Execute the Query
$sqlDelete = mysqli_query($conn, $queryDelete);

// Check whether the query executed successfully or not
if($sqlDelete == true){
    // Query Executed successfully and Admin deleted
    // echo ("<script>alert('Admin Deleted Successfully')</script>");
    // Create a Session Variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    // Redirect to Manage Admin Page
    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
    // Failed to Delete Admin
    // echo ("<script>alert('Failed to delete Admin')</script>");
    $_SESSION['delete'] = "<div class='#'>Failed to Delete Admin, Try again later</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

 // 4. Redirect to Manage Admin page with message (Success or error)


?>