<?php
    require_once "config.php";
    session_start();
    if(!isset($_SESSION['username'])){              
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Welcome to my page -- @<?php echo $_SESSION['username']; ?></h3>  
    <?php if(isset($_SESSION['username'])) echo "<div class='logout'><a href='logout.php'>LogOut</a></div>"; ?>  
</body>
</html>