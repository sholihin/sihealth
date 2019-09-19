<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>LOGIN</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/signin.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>     
  </head>

  <body>
    <div class="container">
      <form class="form-signin" action="?act=login" method="post">     
      <h2>Silahakan Masuk </h2>
        <?php     if($_POST) include 'aksi.php';  ?>
        <label for="inputEmail" class="sr-only">Usernames</label>
        <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
          <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="user" autofocus />
        </div>

        <label for="inputPassword" class="sr-only">Password</label>
        <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
           <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pass" /> 
        </div>   
        <button class="btn btn-lg btn-success btn-block" type="submit">Masuk</button>        
      </form>      
    </div>
</html>
