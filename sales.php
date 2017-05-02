<?php
  $currentpage = "sales";
  include 'base.php';
?>

<?php startblock('title') ?>
  Sales Records
<?php endblock() ?>

<?php startblock('body')
?>
<script>
  function sales(){
    location.replace("add_sales.php");
  }
</script>
  <h2>View current sales records:</h2>
  <fieldset>
    <input type="button" onclick="sales()" value="Add sale" name = "addsales"/>
  </fieldset>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Date</th>
      <th>TODO: ALL TABLE FIELDS</th>
      <th>TODO</th>
      <th>TODO</th>
    </tr>
    <tr>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
    </tr>
    <tr>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
    </tr>
    <tr>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
      <td>Data</td>
    </tr>
  </table>
<?php endblock() ?>
