<?php 
    include('partials/menu.php');
?>

<br><br>
    <?php 
        if (isset($_SESSION['login-status'])){
            echo ($_SESSION['login-status']);
            echo ('Welcome to the admin panel ' .$_SESSION['user']);
            unset($_SESSION['login-status']);
        }
    
    
    ?>
<br> <br>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content Section Ends -->
<?php
    include('partials/footer.php');
?>