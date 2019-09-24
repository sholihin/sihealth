<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="../favicon.ico"/>

    <title>RSSB Client</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/css/general.css" rel="stylesheet"/>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script> 
    <?php include '../functions.php'; ?>  
</head>
<body>
    
    <?php include 'navbar.php'; ?>

    <div class="container">
        <?php 
        $page = $_GET[page];
        switch ($page) {
            case 'register':
                include 'register.php'; 
                break;
            
            case 'pasien':
                include 'medical-records.php'; 
                break;
            
            default:
                include '404.php'; 
                break;
        }
        ?>
    </div>

    <?php include '../footer.php'; ?>
    
</body>
</html>