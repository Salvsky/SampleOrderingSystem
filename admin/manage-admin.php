<?php
include('partials/menu.php');
?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; // Displaying Session Message
                    unset($_SESSION['add']); // Removing Session Message
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }


            ?>
            <br><br><br>
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                    // Query to Get all admin
                    $sql = "SELECT * FROM tbl_admin";
                    // executing the query
                    $res = mysqli_query($conn, $sql);

                    // Check whether the Query is executed or Not
                    if($res==TRUE){
                        //count rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res); // Function to get all the rows in Database

                        // Check the num of rows
                        if($count>0){
                            // We HAVE data in Database
                            while($rows=mysqli_fetch_assoc($res)){
                                // using while loop to get all the data from database
                                // And while loop will run as long as we have data in Database

                                // Get Individual Data
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                // Display the values in our table
                                ?>
                                <tr>
                                    <td><?php echo $id ?> </td>
                                    <td><?php echo $full_name?></td>
                                    <td><?php echo $username?></td>
                                    <td>
                                        <a href="#" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>


                                <?php
                            }
                        }else{
                            // We DON'T HAVE data in Database
                        }
                    }
                ?>

            </table>
        </div>
    </div>

<?php
include('partials/footer.php')
?>


</body>
</html>