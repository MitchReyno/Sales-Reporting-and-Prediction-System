<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Template that uses Bootstrap</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
                                   initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5
      elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page
        via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <script>
      function back(){
        location.replace("users_view.php");
      }
    </script>
  <body class = "container">
    <?php
      $currentpage = "suppliers_edit";
       //include 'base.php';
      require_once("require.php");
      $conn = mysqli_connect($servername, $username, $password, $database2);

      function sanitise_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
       return $data;
       }

      if(isset($_POST["hidden1"]) && isset($_POST["hidden0"])&& isset($_POST["id"])){
        $name = $_POST["hidden0"];
        $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        $pass = $_POST["hidden1"];
        $pass = preg_replace('/[^A-Za-z0-9\-]/', '', $pass);
        $id = $_POST["id"];
        $id = preg_replace('/[^A-Za-z0-9\-]/', '', $id);
        echo $id;
        $pass = sanitise_input($pass);
        $name = sanitise_input($name);
      }else{
        $row['username'] = "-----";
        $row['password'] = "-----";

      }

        if(isset($_POST["delete"]) && isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["idd"])){
          $name = $_POST["name"];
          $pass = $_POST["password"];
          $deleteQuery1 = "Delete from login where username ='$name' ";
          $result2 = mysqli_query($conn,$deleteQuery1);
          if($result2){
            echo "<h3>User data has been dropped successfully!</h3>";
            $name = "-----";
            $pass = "-----";
          }
        }else{
        }

         if(isset($_POST["update"]) && isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["idd"]) ){
          $name = $_POST["name"];
          $pass = $_POST["password"];
           $idd = $_POST["idd"];
           echo "idd";
           echo $idd;

           $que = "select * from login where username ='$name'";
           $result11 = mysqli_query($conn,$que);
           $row = mysqli_fetch_assoc($result11);
           $name1 = $row['username'];
           echo $name + "\n";
           echo "username" + $name1;
           echo $pass +"\n";
          $deleteQuery1 = "UPDATE login SET username = '$name',password = '$pass'  where username ='$name1' ";

          $result2 = mysqli_query($conn,$deleteQuery1);
           echo $result2;
          if($result2){
            echo "<h3>User data has been updated successfully!</h3>";
          }else{
            echo "wrong";
          }
        }else{
        }


    ?>
    <div>
      <form action="alter_users.php" method="post">
      <div class="row">
       <div class="col-lg-6">
              <h3>Supplier Data</h3>
            <div class="row">
              <div class="col-lg-6"><label for="name">User Name:</label>
              </div>
              <div class="col-lg-6">
              <input type="text" name="name" id="name" value = "<?php  echo $name; ?>"/></div>
            </div>
            <div class="row">
              <div class="col-lg-6"><label for="password">Password:</label></div>
              <div class="col-lg-6"><input type="text" name="password" id="password" value = "<?php echo $pass; ?>"/></div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-6">
                    <input type = 'hidden' name='idd' value = "<?php echo $id; ?>" />
                    <input type="submit" name="update" class="btn btn-primary" value ="Edit User"/>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <input type = 'hidden' name='hidden2' value = "<?php echo $num ?>" />
                <input type="submit" name="delete" class="btn btn-primary" value ="Delete User"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6"></div>
          <div class="col-lg-6">
            <?php

              echo "<input type='button' class='btn btn-primary' onclick='back()' value='Back'/>";
            ?>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
