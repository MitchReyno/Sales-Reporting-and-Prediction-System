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
  <body class = "container">
    <script>
      function back(){
        location.replace("suppliers_view.php");
      }
    </script>
    <?php
      $currentpage = "add_suppliers";
       //include 'base.php';
      require_once("require.php");
    $conn = mysqli_connect($servername, $username, $password, $database);
    $button = false;
    ?>
    <div>
      <form action="add_suppliers.php" method="post">
      <div class="row">
       <div class="col-lg-6">
              <h3>Supplier Data</h3>
            <div class="row">
              <div class="col-lg-6"><label for="compname">Company Name:</label>
              </div>
              <div class="col-lg-6">
              <input type="text" name="compname" id="compname" required/></div>
            </div>
            <div class="row">
              <div class="col-lg-6"><label for="contactnum">Contact Number:</label></div>
              <div class="col-lg-6"><input type="text" name="contactnum" id="contactnum" required/></div>
            </div>
            <div class="row">
              <div class="col-lg-6"><label for="address">Address:</label>
              </div>
              <div class="col-lg-6"><input type="text" name="address" id="address" required/>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6"><label for="city">City:</label></div>
              <div class="col-lg-6"><input type="text" name="city" id="city" required/>
              </div>
            </div>
              <button type="submit" class="btn btn-primary "> Submit </button>
              <button type="reset" class="btn btn-primary "> Reset </button>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6"></div>
          <div class="col-lg-6">
            <?php
            if(!$button)
              echo "<input type='button' class='btn btn-primary' onclick='back()' value='Back'/>";
            ?>
          </div>
        </div>
      </form>
    </div>
    <div>
      <?php
      if(isset($_POST["compname"])&&isset($_POST["contactnum"])&&isset($_POST["address"])&&isset($_POST["city"])){
        $idquery = "Select supplier_id from suppliers order by supplier_id DESC LIMIT 1";
        $lastidsup = mysqli_query($conn,$idquery);
        $rownum1 = mysqli_fetch_assoc($lastidsup);
        $lastIDsup = $rownum1["supplier_id"];

        $newIDsup = $lastIDsup + 1;

        $compname=$_POST["compname"];
        $contactnum=$_POST["contactnum"];
        $address=$_POST["address"];
        $city=$_POST["city"];

        $query1forsup = "INSERT INTO suppliers (supplier_id, company_name, contact_num, address, city) VALUES('$newIDsup','$compname','$contactnum','$address','$city')";

        $result1 = mysqli_query($conn,$query1forsup);

        if($result1){
          echo "<h2>New supplier has been added successfully!</h2>";

        }
      }
      ?>
    </div>
  </body>
</html>
