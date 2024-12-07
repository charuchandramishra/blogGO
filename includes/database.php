<?php

$conn=mysqli_connect('localhost:3307','root','','cms');

if(mysqli_connect_errno()){
    exit('something went wrong!!!'.mysqli_connect_error());
}
