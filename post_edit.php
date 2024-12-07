<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
secure();
include 'includes\header.php'; 

if(isset($_POST['updatepost'])){
    if($stm=$conn->prepare("UPDATE posts SET title=?,content=?,date=? WHERE id=?")){

        $stm->bind_param('sssi',$_POST['title'],$_POST['content'],$_POST['date'],$_GET['id']);
        $stm->execute();
        $stm->close();

        set_message('post has been updated  '.strtoupper($_POST['username']."  ID: ".$_GET['id']));
        header('location:posts.php');
        
        die();
    }
    else{
        echo' post update statement not prepare';
    }
} 

if(isset($_GET['id'])){
  if($stm=$conn->prepare('SELECT * from posts where id =?')){
    $stm->bind_param('i',$_GET['id']);
    $stm->execute();

    $result = $stm->get_result();
    $post = $result->fetch_assoc();

  if($post){

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Update Post</h2>
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputname1">Title</label>
                    <input type="text" 
                           class="form-control" 
                           name="title" 
                           placeholder="Enter title" 
                           value="<?php echo htmlspecialchars($post['title']); ?>">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" 
                              id="content" 
                              class="form-control" 
                              placeholder="Add content"><?php echo htmlspecialchars($post['content']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Author's Id</label>
                    <input type="text" 
                           class="form-control" 
                           name="author" 
                           placeholder="Author" 
                           value="<?php echo htmlspecialchars($post['author']); ?>">
                </div>
                <div class="form-group">
                     <label for="date">Date</label>
                     <input type="date" 
                            class="form-control" 
                            name="date" 
                            value="<?php echo $post['date']; ?>">
</div>

                <button name="updatepost" type="submit" class="btn btn-primary">UPDATE POST</button>
            </form>
        </div>
    </div>
</div>

<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>

<?php
   }
   $stm->close();
   die();

 }else{
   echo 'statement is not prepare!!!';
 }
}else{
 echo'post is not selected';
}

include 'includes\footer.php';
?>
