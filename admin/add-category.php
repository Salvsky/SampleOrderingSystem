<?php 
include('partials/menu.php');

?>

<div class="main-content">
      <div class="wrapper">
        <h1>Add Category</h1>
            <br><br>

            <?php
            if(isset($_SESSION['add-category'])){
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }

            if(isset($_SESSION['upload-status'])){
                echo $_SESSION['upload-status'];
                unset($_SESSION['upload-status']);
            }
            
            ?>
            <!-- Add Category Form Starts-->
                <form action="#" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title :</td>
                        <td><input type="text" name="FORMTitle" placeholder="Category Title"></td>
                    </tr>

                    <tr>
                        <td>Select Image :</td>
                        <td>
                            <input type="file" name="FORMImage">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured :</td>
                        <td>
                            <input type="radio" name="FORMFeatured" value="Yes"> Yes
                            <input type="radio" name="FORMFeatured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="FORMActive" value="Yes"> Yes
                            <input type="radio" name="FORMActive" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="FORMSubmit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
                </form>
            <!-- Add Category Form End-->
                <?php 
                
                    // Check whether the submit button is clicked or not
                    if(isset($_POST['FORMSubmit'])){
                        $title = $_POST['FORMTitle'];

                        // For radio input type, we need to check whether the button is selected or not
                        if(isset($_POST['FORMFeatured'])){
                            // Get the value from form 
                            $featured = $_POST['FORMFeatured'];
                        }else{
                            // Set the Default Value
                            $featured = "No";
                        }

                        if(isset($_POST['FORMActive'])){
                            $active = $_POST['FORMActive'];
                        }else{
                            $active = "No";
                        }

                        // Check whether the image is selected or not and set the value for image name accordingly
                        //print_r($_FILES['FORMImage']);

                        //die(); // Break the code here.

                        if(isset($_FILES['FORMImage']['name'])){
                            // upload image
                            // To upload image we need image name, source path and destination path
                            $image_name = $_FILES['FORMImage']['name'];
                            

                            // Upload the image only if the image is selected
                            if($image_name != ""){

                            
                            // Auto Rename our image
                            // Get the extension of our image (jpg, png, gif, etc)

                            $ext = end(explode('.', $image_name));

                            // Rename the Image
                            $image_name = "Food_Category_". rand(000,999).'.'. $ext; 



                            $source_path = $_FILES['FORMImage']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;

                            // Finally, upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            // Check whether the image is uploaded or not
                            // And if the image is not uploaded, then we will stop the process and redirect with error message
                            if($upload == false){
                                // set message
                                $_SESSION['upload-status'] = "<div class = 'error'> Failed to Upload Image</div>";
                                header('location:'.SITEURL.'admin/add-category.php');
                                // Stop the process
                                die();
                            }
                        }
                        }else{
                            // don't upload image and set the image_name value as blank
                            $image_name = "";
                        }


                        // Create SQL query to insert category into database
                        $queryInsert = "INSERT INTO tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        ";

                        $sqlInsert = mysqli_query($conn, $queryInsert);
                        
                        if($sqlInsert == true){
                            $_SESSION['add-category'] = "<div class='success'>Category Successfully Added</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }else{
                            $_SESSION['add-category'] = "<div class='error'>Category Failed to beAdded</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                        }

                    }

                ?>



      </div>
</div>









<?php 
include('partials/footer.php');

?>