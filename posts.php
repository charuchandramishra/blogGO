<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
secure();
include 'includes\header.php'; 

if(isset($_GET['delete'])){
    if($stm=$conn->prepare('DELETE from posts where id =?')){
      $stm->bind_param('i',$_GET['delete']);
      $stm->execute();

      set_message('Post deleted sucessfully :'.$_GET['delete']);
      header('location:posts.php');
      $stm->close();
      die();
    }
}    
if($stm=$conn->prepare("SELECT * FROM posts")){
$stm->execute();

$content=$stm->get_result();


if($content->num_rows>0){

?>
 <div class="container mt-5">
        <h2 class="display-6 text-center content-section sticky-top bg-light p-3 ">POST MANAGEMENT</h2>
        <center>
            <a href="posts_add.php" class="btn btn-danger mb-3">Add New Post</a>
        </center>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark sticky-top p-3 mt-10">
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($record = mysqli_fetch_assoc($content)) { ?>
                    <tr>
                        <td><?php echo $record['id']; ?></td>
                        <td><?php echo $record['title']; ?></td>
                        <td><?php echo $record['content']; ?></td>
                        <td><?php echo $record['author']; ?></td>
                        <td><?php echo $record['date']; ?></td>
                        <td>
                          <a href="post_edit.php?id=<?php echo $record['id']; ?>" class="btn btn-warning btn-sm link-with-loader">Edit</a>
                          <a href="posts.php?delete=<?php echo $record['id']; ?>" class="btn btn-danger btn-sm link-with-loader">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
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

