<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
secure();
include 'includes\header.php'; 
?>
<div class="container mt-5">
    <row class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="display-1">DASHBOARD</h2>
            <h3 style="text-align: center;"><a href="users.php">USERS</a> | <a href="posts.php">POSTS</a></h3>
        </div>
    </row>
</div>
<?php
include 'includes\footer.php';
?>

