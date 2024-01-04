<?php
include('partials/menu.php');
?>
<div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add-category'])){
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }

                if(isset($_SESSION['delete-category'])){
                    echo $_SESSION['delete-category'];
                    unset($_SESSION['delete-category']);
                }
            
            ?>

<br><br>
            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br> <br> <br>

            <table class="tbl-full">
                <tr>
                    <th>Number</th>
                    <th>Category Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>


                <tr>
                    <?php 
                        $querySelect = "SELECT * FROM tbl_category";
                        $sqlSelect = mysqli_query($conn, $querySelect);

                        if($sqlSelect== true){
                            $count = mysqli_num_rows($sqlSelect);
                            $Number = 1;
                            if($count > 0){
                                while($rows = mysqli_fetch_assoc($sqlSelect)){
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    $image = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $Number++;?></td>
                                        <td><?php echo $title;?></td>
                                        <td>
                                            <?php
                                                // Check whether image name is available or not
                                                if($image !=""){
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image; ?>" width="100px" height ="100px">
                                                    <?php
                                                }else{
                                                    // Display the message
                                                    echo "<div class='error'>Image not added</div>";
                                                }

                                            ?>

                                        </td>
                                        <td><?php echo $featured;?></td>
                                        <td><?php echo $active;?></td>
                                        <td>
                                        <a href="#" class="btn-secondary">Update Category</a>
                                        <a href="delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                                        </td>
                                    </tr>
                                    

                                    <?php
                                    
                                }
                            }else{
                                ?>
                                    <tr>
                                        <td colspan="6"><div class="error text-center">No Category Added</div></td>
                                    </tr>


                                <?php
                            }
                        }
                    
                    ?>


                    
                </tr>

            </table>

        </div>
    </div>
<?php
include('partials/footer.php');
?>