<?php 
include('partials/menu.php');
?>

<?php 
    $DeleteId = $_GET['id'];

    $queryDelete = "DELETE FROM tbl_category WHERE id = '$DeleteId'";
    
    $sqlDelete = mysqli_query($conn, $queryDelete);

    if($sqlDelete == true){
        $_SESSION['delete-category'] = "<div class = 'success'>Category was successfully deleted</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }else{
        $_SESSION['delete-category.php'] = "<div class = 'error'>Category was not deleted</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>



<?php
include('partials/footer.php');

?>