
<?php 
    include('../config/constants.php');
    // echo "Delete page";
    // check whether the id and image_name is set or not

    if(isset($_GET['id']) && isset($_GET['image_name'])){
         // get the value and delete
        //  echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove the physical image file if available
        if($image_name != ""){
            // image is available. So remove it
            $path = "../images/category/".$image_name;
            // remove the Image

            $remove = unlink($path);

            // if failed to remove image then add an error message and stop the process
            if($remove == false){
                // set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove Category Image</div>";
                // redirect to manage category page
                header("location:".SITEURL.'admin/manage-category.php');
                // stop the process
                die();
            }

        }
        // delete Data from database
        // sql query to delete data from the database
        $queryDelete = "DELETE FROM tbl_category WHERE id = $id";

        //execute the query
        $sqlDelete = mysqli_query($conn, $queryDelete);

        // Check whether the data is deleted from database or not

        if($sqlDelete==true){
            // Set successs message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header("location:".SITEURL.'admin/manage-category.php');
        }else{
            // set Fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Category Failed to be deleted</div>";
            header("location:".SITEURL.'admin/manage-category.php');
        }
        

    }else{
        // redirect to manage category page
        header("location:".SITEURL.'admin/manage-category.php');
    }




    // $DeleteId = $_GET['id'];

    // $queryDelete = "DELETE FROM tbl_category WHERE id = '$DeleteId'";
    
    // $sqlDelete = mysqli_query($conn, $queryDelete);

    // if($sqlDelete == true){
    //     $_SESSION['delete-category'] = "<div class = 'success'>Category was successfully deleted</div>";
    //     header('location:'.SITEURL.'admin/manage-category.php');
    // }else{
    //     $_SESSION['delete-category.php'] = "<div class = 'error'>Category was not deleted</div>";
    //     header('location:'.SITEURL.'admin/manage-category.php');
    // }

?> 
