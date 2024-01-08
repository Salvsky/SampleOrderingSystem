<?php 
include('partials/menu.php');
?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>

            <br><br>


                <?php
                    // Check whether the id is set or not
                    if(isset($_GET['id'])){
                        // Get the ID and all the other details
                        // echo "Get all the data";
                        $id = $_GET['id'];

                        // Create SQL Query to get all other details

                        $querySelect = "SELECT * FROM tbl_category WHERE id=$id";
                        
                        // Execute the query
                        $sqlSelect = mysqli_query($conn, $querySelect);

                        // Count the rows to check whether the id is valid or not

                        $count = mysqli_num_rows($sqlSelect);
                        
                        if($count == 1){
                            // get all the data
                            $row = mysqli_fetch_assoc($sqlSelect);
                            $update_title = $row['title'];
                            $update_current_image_name =  $row['image_name'];
                            $update_featured = $row['featured'];
                            $update_active = $row['active'];
            
                        }else{
                            // Redirect to manage category with session message
                            $_SESSION['no-category-found'] = "<div class='error'> Category Not found</div>";
                            header("location:".SITEURL.'admin/manage-category.php');
                        }


                    }else{
                        // Redirect to manage category

                        header("location:".SITEURL.'admin/manage-category.php');
                    }
                
                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td>
                                <input type="text" name="FORMUpdateTitle" value="<?php echo $update_title; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>Current Image:</td>
                            <td>
                                <?php 
                                    if($update_current_image_name != ""){
                                        //display the image
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $update_current_image_name;?>" width="150px" height="150px">
                                        <?php
                                    }else{
                                        // diplay message
                                        echo "<div class='error'>Image not added</div>";
                                    }
                                
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>New Image: </td>
                            <td>
                                <input type="file" name="FORMUpdate_image_name" id="">
                            </td>
                        </tr>

                        <tr>
                            <td>Featured: </td>
                            <td>
                                <input <?php if($update_featured=="Yes"){echo "checked";}?> type="radio" name="FORMUpdateFeatured" value="Yes">Yes
                                <input <?php if($update_featured=="No"){echo "Checked";}?> type="radio" name="FORMUpdateFeatured" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <td>Active: </td>
                            <td>
                                <input <?php if($update_active == "Yes"){ echo "checked";}?> type="radio" name="FORMUpdateActive" value="Yes">Yes
                                <input <?php if($update_active == "No"){ echo "checked";}?> type="radio" name="FORMUpdateActive" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <td>
                            <input type="hidden" name="FORMCurrentImage" value="<?php echo $update_current_image_name;?>">
                            <input type="hidden" name="FORMId" value="<?php echo $id; ?>">
                            <input type="submit" name="FORMUpdateCategory" value="Update Category" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
        
                <?php 
                    if(isset($_POST['FORMUpdateCategory'])){
                        // echo "Clicked";
                        // Get all the values from our form
                        $id = $_POST['FORMId'];
                        $updated_title = $_POST['FORMUpdateTitle'];
                        $current_image = $_POST['FORMCurrentImage'];
                        $updated_featured = $_POST['FORMUpdateFeatured'];
                        $updated_active = $_POST['FORMUpdateActive'];

                        // 2. Updating new image if selected
                        // Check whether the image is selected or not
                        if(isset($_FILES['image']['name'])){
                            // Get the Image details
                            $updated_image_name = $_FILES['image']['name'];

                            // Check whether the image is available or not

                            if($updated_image_name != ""){
                                // Image Available

                            // A. Upload the new image
                            // Auto Rename our image
                            // Get the extension of our image (jpg, png, gif, etc)

                            $ext = end(explode('.', $update_current_image_name));

                            // Rename the Image
                            $updated_image_name = "Food_Category_". rand(000,999).'.'. $ext; 



                            $source_path = $_FILES['FORMUpdate_image_name']['tmp_name'];
                            $destination_path = "../images/category/".$updated_image_name;

                            // Finally, upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            // Check whether the image is uploaded or not
                            // And if the image is not uploaded, then we will stop the process and redirect with error message
                            if($upload == false){
                                // set message
                                $_SESSION['upload-status'] = "<div class = 'error'> Failed to Upload Updated Image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                // Stop the process
                                die();
                            }
                                // 
                                // B. Remove the current image if available
                                if($current_image !=""){
                                    $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);

                                // Check whether the image is remove or not
                                // if failed to remove then display message and stop the process
                                if($remove == false){
                                    // Failed to remove image
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                    header("location:".SITEURL.'admin/manage-category.php');
                                    die();
                                }
                                }
                                
                            }else{
                                // Image not available
                                // Update as current image
                                $updated_image_name = $update_current_image_name;
                            }


                        }else{
                            $updated_image_name = $update_current_image_name;
                        }

                        // 3. Update the database

                        $queryUpdate = "UPDATE tbl_category SET
                        title = '$updated_title',
                        image_name = '$updated_image_name',
                        featured = '$updated_featured',
                        active = '$updated_active' WHERE id = $id
                        ";

                        // Execute the query

                        $sqlUpdate = mysqli_query($conn, $queryUpdate);

                        // 4. Redirect to manage category with message
                        // Check whether the query is executed or not

                        if($sqlUpdate == true){
                            // Category Updated
                            $_SESSION['update-category'] = "<div class='success'>Category Updated Successfully</div>";
                            header("location:".SITEURL.'admin/manage-category.php');
                        }else{
                            // Failed to Update Category
                            $_SESSION['update-category'] = "<div class='error'>Update Category Failed</div>";
                            header("location:".SITEURL.'admin/manage-category.php');
                        }
                    
                    }
                
                ?>

        </div>
    </div>


<?php 
include('partials/footer.php');
?>