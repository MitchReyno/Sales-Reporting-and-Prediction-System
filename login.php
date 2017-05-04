<!DOCTYPE html>
<html data-ng-app="" lang="en">
   <head>
      <title>Template that uses Bootstrap</title>
      <meta charset="utf-8">
      <meta content="width= device-width, initial-scale=1.0" name="viewport">
      <!--Boostrap-->
      <link href="CSS/login.css" rel="stylesheet">
      <!--HTML5 shiv and respond.js IE8 support of HTML5 elements and media queries-->
      <!--WARNING: respond.js doesn't work if you view the page via file://-->
      <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
     <div class="container">
       <div class="row">
      <form action="login.php" method="post">
         <div class="imgcontainer">
            <img src="http://www.nationalcollegeofpharmacy.org/images/banner.jpg" alt="pharmacy" class="pharmacy">
         </div>
         <div class="container">
            <label><b>LOGIN ID</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <label><b>PASSWORD</b></label>
            <input type="password" placeholder="Enter Password" name="pass" required>
           <?php
              function loginerror(){
                echo "<p>Check your username/password and try again!</p>";
              }
           ?>
            <button name="submit" type="submit">Login</button>
         </div>
      </form>
         <?php
              if(isset($_POST["uname"])&&isset($_POST["pass"]) && isset($_POST["submit"])){
                  require_once("loginrequire.php");
                  $conn = mysqli_connect($servername, $username, $password, $database);
                  session_start();

                  $username = $_POST["uname"];
                  $password = $_POST["pass"];

                  //$_SESSION['loginuser'] = $username;

                  $loginquery = "select username,password from login where username = '$username' and password = '$password'";

                  $data1 = mysqli_query($conn,$loginquery);
                  $rownum1 = mysqli_fetch_assoc($data1);

                  $usernameData = $rownum1["username"];
                  $passwordData = $rownum1["password"];

                  if($usernameData != $username){
                    loginerror();
                  }else if($passwordData != $password){
                    loginerror();
                  }else{
                    $_SESSION['loginuser'] = $usernameData;
                     header('Location: index.php');
                  }

              }else{

              }

         ?>
         </div>
     </div>
   </body>
</html>
