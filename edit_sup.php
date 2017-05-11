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
        location.replace("suppliers_view.php");
      }
    </script>
  <body class = "container">
    <?php
      $currentpage = "suppliers_edit";
       //include 'base.php';
      require_once("require.php");
      $conn = mysqli_connect($servername, $username, $password, $database);

      function sanitise_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
       return $data;
       }

      if(isset($_POST["hidden"])){
        $num = $_POST["hidden"];
        $num1=sanitise_input($num);
        $num1 = preg_replace('/[^A-Za-z0-9\-]/', '', $num1);
        $query1 = "select * from suppliers where supplier_id ='$num1'";
        $result = mysqli_query($conn,$query1);
        $row = mysqli_fetch_assoc($result);
      }else{
        $row['company_name'] = "-----";
        $row['contact_num'] = "-----";
        $row['address'] = "-----";
        $row['city'] = "-----";
      }

        if(isset($_POST["delete"]) && isset($_POST["hidden2"])){
          $num = $_POST["hidden2"];
          $num1=sanitise_input($num);
          $num1 = preg_replace('/[^A-Za-z0-9\-]/', '', $num1);
          $deleteQuery1 = "Delete from suppliers where supplier_id ='$num1' ";
          $deleteQuery2="Delete from product_supplier where supplier_id ='$num1'";
          $result2 = mysqli_query($conn,$deleteQuery1);
          $result3 = mysqli_query($conn,$deleteQuery2);
          if($result2 && $result3){
            echo "<h3>Supplier data has been dropped successfully!</h3>";
          }
        }else{
        }

         if(isset($_POST["update"]) && isset($_POST["hidden2"])
           && isset($_POST["compname"]) && isset($_POST["contactnum"]) && isset($_POST["address"]) && isset($_POST["city"])){
          $num = $_POST["hidden2"];
          $num1=sanitise_input($num);
          $num1 = preg_replace('/[^A-Za-z0-9\-]/', '', $num1);
          $compname = $_POST["compname"];
          $contactnum = $_POST["contactnum"];
          $address = $_POST["address"];
          $city = $_POST["city"];
          $deleteQuery1 = "UPDATE suppliers SET company_name= '$compname', contact_num='$contactnum', address ='$address', city = '$city' where supplier_id ='$num1' ";

          $result2 = mysqli_query($conn,$deleteQuery1);

          if($result2){
            echo "<h3>Supplier data has been updated successfully!</h3>";
          }else{
            echo "wrong";
          }
        }else{
        }


    ?>
    <div>
      <form action="edit_sup.php" method="post">
      <div class="row">
       <div class="col-lg-6">
              <h3>Supplier Data</h3>
            <div class="row">
              <div class="col-lg-6"><label for="compname">Company Name:</label>
              </div>
              <div class="col-lg-6">
              <input type="text" name="compname" id="compname" value = "<?php  echo $row['company_name']; ?>"/></div>
            </div>
            <div class="row">
              <div class="col-lg-6"><label for="contactnum">Contact Number:</label></div>
              <div class="col-lg-6"><input type="text" name="contactnum" id="contactnum" value = "<?php echo $row['contact_num']; ?>"/></div>
            </div>
            <div class="row">
              <div class="col-lg-6"><label for="address">Address:</label>
              </div>
              <div class="col-lg-6"><input type="text" name="address" id="address" value = "<?php echo $row['address']; ?>"/>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6"><label for="city">City:</label></div>
              <div class="col-lg-6"><input type="text" name="city" id="city" value = "<?php echo $row['city']; ?>"/>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-6">
                    <input type="submit" name="update" class="btn btn-primary" value ="Edit Supplier"/>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <input type = 'hidden' name='hidden2' value = "<?php echo $num ?>" />
                <input type="submit" name="delete" class="btn btn-primary" value ="Delete Supplier"/>
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
