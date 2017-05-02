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
    <?php
      include "menu.php";
      require_once("require.php");
    $conn = mysqli_connect($servername, $username, $password, $database);
    ?>

    <div class = "container">
    <form action="add_sales.php" method="post">
      <div class="row">
        <div class="col-lg-6">
          <h3>Customer Data</h3>
          <div class="row">
            <div class="col-lg-6">
              <label for="compname">Company Name:</label>
            </div>
            <div class="col-lg-6">
              <input type="text" name="compname" id="compname"/></div>
        </div>
        <div class="row">
          <div class="col-lg-6"><label for="contactnum">Contact Number:</label></div>
          <div class="col-lg-6"><input type="text" name="contactnum" id="contactnum"/></div>
        </div>
          <div class="row">
            <div class="col-lg-6"><label for="address">Address:</label>
            </div>
            <div class="col-lg-6"><input type="text" name="address" id="address"/>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6"><label for="city">City:</label></div>
            <div class="col-lg-6"><input type="text" name="city" id="city"/>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <h3>Order Data</h3>
          <div class="row">
            <div class="col-lg-6"><label for="orderdate">Order date:</label>
            </div>
            <div class="col-lg-6"><input type="date" name="orderdate" id="orderdate"/>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6"><label for="reqdate">Requested date:</label></div>
            <div class="col-lg-6"><input type="date" name="reqdate" id="reqdate"/></div>
            </div>
          <div class="row">
            <div class="col-lg-6"><label for="shipdate">Shipping date:</label></div>
            <div class="col-lg-6"><input type="date" name="shipdate" id="shipdate"/></div>
          </div>
      </div>
    </div>
      <div class="row">
        <h3>Product Details</h3>
        <div class="row">
          <?php
          echo "<div class='col-lg-2'><label name='prod1type'>Product Type:</label></div>";
          echo "<div class='col-lg-2'>";
            $query4select = "Select product_id, product_name from products order by product_name";
            $selectlist = mysqli_query($conn,$query4select);


          echo "<select name='prodtype'>";
          while($selectrowpopu = mysqli_fetch_assoc($selectlist)){
                  echo "<option value = ",$selectrowpopu["product_id"],">",$selectrowpopu["product_name"],"</option>";
          }
              echo"</select>";
          echo "</div>";
          ?>
          </div>
        <div class="row">
            <div class="col-lg-2"><label for="quantity">Quantity :</label></div>
            <div class="col-lg-2">
              <input type="text" name="quantity" id="quantity"/>
          </div>
          </div>
        <div class="row">
            <div class="col-lg-2"><label for="discount">Discount :</label></div>
            <div class="col-lg-3">
              <input type="text" name="discount" id="discount"/><span> &#37;</span>
          </div>
          </div>
      </div>
      <button type="submit" class="btn btn-primary "> Submit Order</button>
      <button type="reset" class="btn btn-primary "> Reset Order</button>
    </form>
      <div>


        <?php
    if(!$conn){
      echo "Problem with data base! Check back later!";
    }else{
      echo "connected to database";

      $errMsg=" \n";
       function sanitise_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
       return $data;
       }

         if(isset($_POST["compname"])&&isset($_POST["contactnum"])&&isset($_POST["address"])&&isset($_POST["city"])&&isset($_POST["orderdate"])&&isset($_POST["reqdate"])&&isset($_POST["shipdate"])){


              $querycusid = "SELECT customer_id FROM customers ORDER BY customer_id DESC LIMIT 1";

              $queryordid="SELECT Order_ID FROM orders ORDER BY Order_ID DESC LIMIT 1";

              $lastIDcus = mysqli_query($conn,$querycusid);
              $lastIDord = mysqli_query($conn,$queryordid);

              $compname=$_POST["compname"];
              $contactnum=$_POST["contactnum"];
              $address=$_POST["address"];
              $city=$_POST["city"];
              $orderdate=$_POST["orderdate"];
              $reqdate=$_POST["reqdate"];
              $shipdate=$_POST["shipdate"];
              $product=$_POST["prodtype"];
              $quantityprod = $_POST["quantity"];
              $discount=$_POST["discount"];

              $compname=sanitise_input($compname);//sanitise the inputs
              $contactnum=sanitise_input($contactnum);
              $address=sanitise_input($address);
              $city=sanitise_input($city);
              $orderdate=sanitise_input($orderdate);
              $reqdate=sanitise_input($reqdate);
              $shipdate=sanitise_input($shipdate);
              $quantityprod=sanitise_input($quantityprod);
              $discount=sanitise_input($discount);

              $rownum1 = mysqli_fetch_assoc($lastIDcus);//get the last customer id
              $rownum2 = mysqli_fetch_assoc($lastIDord);//get the last order id

              $lastIDcus = $rownum1["customer_id"];
              $lastIDord = $rownum2["Order_ID"];

              $newIDcus = $lastIDcus + 1;//increment customer id
              $newIDord = $lastIDord + 2;//increment order id

              $query1forCus = "INSERT INTO customers (customer_id, company_name, contact_num, address, city) VALUES('$newIDcus','$compname','$contactnum','$address','$city')";

                $result1 = mysqli_query($conn,$query1forCus);

              $query2forOrd = "INSERT INTO orders (Order_ID, order_date, req_date, shipping_date) VALUES('$newIDord','$orderdate','$reqdate','$shipdate')";

                $result2 = mysqli_query($conn,$query2forOrd);

              $query3forBoth = "INSERT INTO customer_orders (Customer_ID, Order_ID) VALUES ('$newIDcus','$newIDord')";

                $result3 = mysqli_query($conn,$query3forBoth);

              $query3fororddetails = "INSERT INTO order_details(Order_ID, product_id, Quantity, Discount) VALUES ('$newIDord','$product','$quantityprod','$discount')";

                $result4 = mysqli_query($conn,$query3fororddetails);

            if($result1 && $result2 && $result3 && $result4){
              receipt($newIDord, $product, $quantityprod,$discount,$servername, $username, $password, $database);
                  echo"<p> Database is populated! </p>";
            }else{
              echo "check queries";
            }

         }else{
           $errMsg=$errMsg+"An error occured when populating Database! \n";
           echo $errMsg;
         }

    }

    ?>

        <?php
        function receipt($newIDord,$product, $quantityprod,$discount,$servername, $username, $password, $database){
          require_once("require.php");
          $conn = mysqli_connect($servername, $username, $password, $database);
          echo $newIDord;

          $dataquery1 = "SELECT customers.company_name, customers.contact_num, customers.address, orders.order_date, orders.req_date, orders.shipping_date
FROM customers
INNER JOIN customer_orders ON customers.customer_id = customer_orders.Customer_ID
INNER JOIN orders ON customer_orders.Order_ID = orders.Order_ID
WHERE orders.Order_ID = ".$newIDord;
          $result4 = mysqli_query($conn,$dataquery1);

          $dataquery2 = "SELECT unit_price from products where product_id = ".$product;

          $result5 = mysqli_query($conn,$dataquery2);

          $updatequery = "UPDATE products set unit_on_order = unit_on_order +
            '$quantityprod', recorded_level = 	unit_in_stock - unit_on_order where product_id = '$product'";

          $result6 = mysqli_query($conn,$updatequery);

          $makerecipt = "select * from products where product_id = '$product'";

          $result7 = mysqli_query($conn,$makerecipt);
          $getprddata = mysqli_fetch_assoc($result7);

          $val = $getprddata["unit_price"];
          $totalval = $val * $quantityprod - $val * $discount;
          $name = $getprddata["product_name"];


          echo "<div class='table-responsive'>";
          echo "<h3>Order Details : <br/></h3>";
          echo   "<table class='table table-striped table-hover'>";
          echo     "<tr>"
                 ."<th>Company Name</th>"
                 ."<th>Contact Number</th>"
                 ."<th>Address</th>"
                 ."<th>Order Date</th>"
                 ."<th>Requested Date</th>"
                 ."<th>Shipping Date</th>"
               ."</tr>";
            while($rownum3 = mysqli_fetch_assoc($result4)){
          echo   "<tr>";
          echo     "<td >",$rownum3["company_name"],"</td>";
          echo     "<td >",$rownum3["contact_num"],"</td>";
          echo     "<td >",$rownum3["address"],"</td>";
          echo     "<td >",$rownum3["order_date"],"</td>";
          echo     "<td >",$rownum3["req_date"],"</td>";
          echo     "<td >",$rownum3["shipping_date"],"</td>";
          echo   "</tr>";
            }
          echo  "</table>";
          echo "</div>";

          echo "<div class='table-responsive'>";
          echo   "<table class='table table-striped table-hover'>";
          echo     "<tr>"
                    ."<th>Product Name</th>"
                    ."<th>Unit Price</th>"
                    ."<th>Discount</th>"
                    ."<th>Total Amount</th>"
                  ."</tr>";
          echo   "<tr>";
          echo     "<td >",$name,"</td>";
          echo     "<td >",$val,"</td>";
          echo     "<td >",$discount,"</td>";
          echo     "<td >",$totalval,"</td>";
          echo   "</tr>";
          echo  "</table>";
          echo "</div>";


            mysqli_free_result($result4);
            mysqli_free_result($result7);


        }
        ?>
      </div>
    </div>
  </body>
</html>
