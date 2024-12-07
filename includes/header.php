<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<header class="sticky-top bg-primary">
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <a class="navbar-brand" href="home.php" style="color:red"><b>BlogGO</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="link-with-loader" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="link-with-loader" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="link-with-loader" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
</header>

<script>
      function showToast(message, position, type) {
        const toast = document.getElementById("toast");
        toast.className = toast.className + " show";

        if (message) toast.innerText = message;

        if (position !== "") toast.className = toast.className + ` ${position}`;
        if (type !== "") toast.className = toast.className + ` ${type}`;

        setTimeout(function () {
          toast.className = toast.className.replace(" show", "");
        }, 3000);
      }
</script>
<div id="toast"></div>
<?php get_message(); ?>



 

