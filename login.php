<?php
    session_start();     
    if(isset($_SESSION['username'])){
        header("location: home.php");
        exit;
    }

    require_once "config.php";


    if ($_SERVER['REQUEST_METHOD'] == "POST"){   
        $username = trim($_POST['username']);              
        $password = trim($_POST['password']);         
        if(!empty($email) || !empty($password)){        //check if any of the email or password field are empty
            //validate the username and password
            $sql = "SELECT * FROM user WHERE username='{$username}'";
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query)>0){              //check if user credentials matched
                $row = mysqli_fetch_assoc($query);
                echo strcmp($password,$row['password']);
                if(strcmp($password,$row['password'])==0){    //check if the entered password & password in database is same
                    //assigingig session variables
                    $_SESSION['username'] = $row['username'];
                    //Redirect user to welcome page
                    header("location: home.php");
                }else{
                    $_POST['error']='Password is not valid';
                }
            }else{
                $_POST['error']='User is not registred.';
            }
        }else{
            $_POST['error']='All input fields are required';
        }
    }
    mysqli_close($conn);        // closing 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LogIn</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="form_wrapper">
      <section class="signup_form">
        <h3>LogIn Form</h3>
        <form action="<?php $_PHP_SELF?>" method="post">
          <div class="field username">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" placeholder="Username">
          </div>
          <div class="field password">
              <label for="password">Password</label>
              <div class="password_eye">
                <input type="password" id="password" name="password" placeholder="Password">
              </div>
          </div> 
          <div class="field button_submit">
            <input type="submit" value="Log In">
          </div>
        </form>
        <?php 
            if(isset($_POST["error"])){ 
              $errorData = $_POST['error'];
                echo "<div class='error-txt'> $errorData </div>";
            }
        ?>
      </section>
    </div>
  </body>
</html>
