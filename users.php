<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
secure();
include 'includes\header.php'; 

if(isset($_GET['delete'])){
    if($stm=$conn->prepare('DELETE from users where id =?')){
      $stm->bind_param('i',$_GET['delete']);
      $stm->execute();

      set_message('User deleted sucessfully :'.$_GET['delete']);
      header('location:users.php');
      $stm->close();
      die();
    }
}    
if($stm=$conn->prepare("SELECT * FROM users")){
$stm->execute();

$result=$stm->get_result();


if($result->num_rows>0){

?>
 <div class="container mt-5">
        <h2 class="display-6 text-center text-danger">USER MANAGEMENT</h2>
        <center>
            <a class="sticky-top bg-light p-3link-with-loader" href="users_add.php" class="btn btn-danger mb-3">Add New User</a>
        </center>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark sticky">
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($record = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $record['id']; ?></td>
                        <td><?php echo $record['username']; ?></td>
                        <td><?php echo $record['email']; ?></td>
                        <td><?php echo $record['active']; ?></td>
                        <td>
                            <a  class="btn btn-warning btn-sm link-with-loader" href="users_edit.php?id=<?php echo $record['id']; ?>" class="btn btn-warning btn-sm link-with-loader">Edit</a>
                            <a  class="btn btn-danger btn-sm link-with-loader" href="users.php?delete=<?php echo $record['id']; ?>" class="btn btn-danger btn-sm link-with-loader">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
                               

die();
}
else{
    echo'<center><p style="color:red">No, Users Found</p></center>';
}

$stm->close();
}

include 'includes\footer.php';
?>

