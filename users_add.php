<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
secure();
include 'includes\header.php'; 

if(isset($_POST['adduser'])){
    if($stm=$conn->prepare("INSERT INTO users (username,email,password,active)VALUES(?,?,?,?)")){

        $hash=SHA1($_POST['pass']);
        $stm->bind_param('sssi',$_POST['username'],$_POST['email'],$hash,$_POST['active']);
        $stm->execute();

        set_message('A new user has been added '.strtoupper($_POST['username']));
        header('location:users.php');
        $stm->close();
        die();
    }else{
        echo'statement not prepare';
    }

}    
     
?>
<div class="container mt-5">
    <row class="row justify-content-center">
        <div class="col-md-6"><h2>Add Users</h2>
        <form method="post">
        <div class="form-group">
    <label for="exampleInputname1">Username</label>
    <input type="text" class="form-control" name="username" id="exampleInputname1" aria-describedby="nameHelp" placeholder="Enter name">  
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-select">
    <select name="active" id="active">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>
  </div>
  <button  name="adduser" type="submit" class="btn btn-primary">ADD USER</button>
</form>     
</div></row>
</div>

<?php
include 'includes\footer.php';
?>