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
      <form action="/action_page.php">
         <div class="imgcontainer">
            <img src="IMAGES/pharm.png" alt="pharmacy" class="pharmacy">
         </div>
         <div class="container">
            <label><b>LOGIN ID</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <label><b>PASSWORD</b></label>
            <input type="password" placeholder="Enter Password" name="pass" required>
            <button type="submit">Login</button>
            <input type="checkbox" checked="checked"> Remember me..
         </div>
         <div class="container" style="background-color:WHITE">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="pass">Forgot <a href="#">Password?</a></span>
         </div>
      </form>
         </div>
     </div>
   </body>
</html>
