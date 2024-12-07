<?php
function secure(){

    if(!isset($_SESSION['id'])){
        set_message('Please Login first to view dashboard');
        header('location: /blog website');
        die();
    }
}
function set_message($message){
    {
        $_SESSION['message'] = $message;
    }
}

function get_message(){
    if(isset($_SESSION['message'])){
        // echo '<p>' .$_SESSION['message'].'</p> <hr>';
        echo "<script type='text/javascript'> showToast('".$_SESSION['message']. "', 'bottom right', 'warning')</script>";

        unset($_SESSION['message']);
    }
}
