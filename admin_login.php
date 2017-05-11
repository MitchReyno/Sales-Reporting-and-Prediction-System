
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8 " />
  <title>Admin Login </title>
  <link href="CSS/login.css" rel="stylesheet">
</head>
<body>
  <div class="container">
       <div class="row">
  <form method="post" action = "admin_login.php" >
    <p>Admin Name:
      <input type="text" name="username" />
    </p>
    <p>Admin Password:
      <input type="password" name="password" />
    </p>
    <p>
      <input type="submit" value="Login" />
    </p>

  </form>

  <?php
    if(isset($_POST["username"]) && isset($_POST["password"])){
      session_start();
      $name = $_POST["username"];
      $pass = $_POST["password"];
      if($name == "admin" && $pass == "admin"){
        $_SESSION['loginuser'] = $name;
        header('Location: index.php');
      }
    }

  ?></div>
     </div>
</body>
</html>
