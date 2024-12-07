<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
secure();
include 'includes\header.php'; 

if(isset($_POST['update'])){
    if($stm=$conn->prepare("UPDATE users SET username=?,email=?,active=? WHERE id=?")){

        $stm->bind_param('ssii',$_POST['username'],$_POST['email'],$_POST['active'],$_GET['id']);
        $stm->execute();
        $stm->close();

        if(!empty($_POST['pass'])){
          if($stm=$conn->prepare("UPDATE users SET password=? WHERE id=?")){
            $hash=sha1($_POST['pass']);
            $stm->bind_param('si',$hash,$_GET['id']);
            $stm->execute();
            echo "<script>alert('Password updated successfully!');</script>";
            $stm->close();
            
          }else{
            echo'could not prepare password statement';
          }
        }

        set_message('User has been updated '.strtoupper($_POST['username']."  ID: ".$_GET['id']));
        header('location:users.php');
        
        die();
    }
    else{
        echo' user update statement not prepare';
    }
} 

if(isset($_GET['id'])){
  if($stm=$conn->prepare('SELECT * from users where id =?')){
    $stm->bind_param('i',$_GET['id']);
    $stm->execute();

    $result = $stm->get_result();
    $user = $result->fetch_assoc();

    if($user){

?>
<div class="container mt-5">
    <row class="row justify-content-center">
        <div class="col-md-6"><h2>Edit Users</h2>
        <form method="post">
        <div class="form-group">
    <label for="exampleInputname1">Username</label>
    <input type="text" class="form-control" name="username" id="exampleInputname1" aria-describedby="nameHelp" placeholder="Enter name" value="<?php echo $user['username'] ?>">  
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $user['email'] ?>">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-select">
    <select name="active" id="active">
        <option <?php echo ($user['active'])?"selected":"";?> value="1">Active</option>
        <option <?php echo ($user['active'])?" ":"selected";?> value="0">Inactive</option>
    </select>
  </div>
  <button  name="update" type="submit" class="btn btn-primary"> UPDATE USER</button>
</form>     
</div></row>
</div>

<?php
   }
   $stm->close();
   die();

 }else{
   echo 'statement is not prepare!!!';
 }
}else{
 echo'user is not selected';
}

include 'includes\footer.php';
?>