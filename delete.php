<?php
  $currentpage = "sales";
  include 'base.php';
?>

<?php
   require_once("require.php");
  $conn = mysqli_connect($servername, $username, $password, $database);
  if (!$conn) {
    echo '<p>Could not connect to the database</p>';
  } else {

  echo"connected to database";
  if(isset($_GET['id'])){
      $id = $_GET['id'];
      echo"<p>ID",$id,"</p>";
      $query = "DELETE from customer_orders where Order_ID = ".$id;
      $result = mysqli_query($conn, $query);
      $query1 = "DELETE from order_details where Order_ID = ".$id;
      $result1 = mysqli_query($conn, $query1);
      $query2 = "DELETE from orders where Order_ID = ".$id;
      $result2 = mysqli_query($conn, $query2);
    }
  if ($result2){
  echo"sucess";
  header("location:sales.php");
  }else{
        echo"error";
    }
  }
?>





