<?php
include'functions.php';
if(empty($_SESSION['login']))
    header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="favicon.ico"/>
    <?php
        $subtitle = "";
        $getTitle = $_GET[m];

        if($getTitle){
            $subtitle .= ' - '.str_replace('_', ' ', $getTitle);
        }
    ?>
    <title>RSSB Client <?=strtoupper($subtitle)?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
    
    <?php include 'navbar.php'; ?>

    <div class="container">
        <?php
        if(file_exists($mod.'.php'))
            include $mod.'.php';
        else
            include 'home.php';
        ?>
    </div>

    <?php include 'footer.php'; ?>
    
</body>
</html>