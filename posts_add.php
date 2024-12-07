<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
secure();
include 'includes\header.php'; 

if(isset($_POST['addpost'])){
    if($stm=$conn->prepare("INSERT INTO posts (title,content,author,date)VALUES(?,?,?,?)")){

        $stm->bind_param('ssss',$_POST['title'],$_POST['content'],$_SESSION['id'],$_POST['date']);
        $stm->execute();

        set_message('A new post has been added : '.strtoupper($_POST['username']));
        header('location:posts.php');
        $stm->close();
        die();
    }else{
        echo'statement not prepare';
    }

}    
     
?>
<div class="container mt-6">
    <row class="row justify-content-center">
        <div class="col-md-8"><h2>Add Post</h2>
        <form method="post">
        <div class="form-group">
    <label for="exampleInputname1">Title</label>
    <input type="text" class="form-control" name="title" id="" aria-describedby="nameHelp" placeholder="Enter title">  
  </div>
  <div class="form-group">
    <textarea name="content" id="content" placeholder="add content"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Author</label>
    <input type="text" class="form-control" name="author" id="" placeholder="author">
  </div>
  <div class="form-select">
  <label >date</label>
  <input type="date" class="form-control" name="date" id="">   
  </div>

  <button  name="addpost" type="submit" class="btn btn-primary">POST</button>
</form>     
</div></row>
</div>
<script src="js\tinymce\tinymce.min.js"></script>
<script>
  tinymce.init({
    selector:'#content'
  }); 
</script>
<?php
include 'includes\footer.php';
?>