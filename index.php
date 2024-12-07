<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
include 'includes\header.php';

if(isset($_SESSION['id'])){
    header('location:dashboard.php');
    die();
}

if(isset($_POST['email'])){

    if($stm=$conn->prepare("SELECT * FROM users WHERE email=? AND password=? AND active=1")){

        $hash=SHA1($_POST['pass']);
        $stm->bind_param('ss',$_POST['email'],$hash);
        $stm->execute();

        $result=$stm->get_result();
        $user=$result->fetch_assoc();
        
        if($user){

            $_SESSION['id']=$user['id'];
            $_SESSION['username']=$user['username'];
            $_SESSION['email']=$user['email'];

            set_message(htmlspecialchars("you have successfully logged in ".$_SESSION['username']));
            header('location:dashboard.php');
            die();
        }
        else{
            echo'<center><p style="color:red">Wrong Id or Password</p></center>';
        }
        
        $stm->close();
    }   
}

?>
<div class="container mt-5">
    <row class="row justify-content-center">
        <div class="col-md-6">
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</row>
</div>
<?php
include 'includes\footer.php';
?>

