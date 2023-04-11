
<?php
 include'../includes/connection.php';
 include'../includes/sidebar.php';
 $query = 'SELECT DATE  ,SUM(CASH) as SALES from transaction GROUP by DATE;';


  $result = mysqli_query($db, $query) or die(mysqli_error($db));
  $dataPoints = array();

    while($row = mysqli_fetch_array($result)){
		$date = $row['DATE'];
		$SALES = $row['SALES'];
		$array_element =  array("y" => $SALES, "label" => $date);
		array_push($dataPoints,$array_element);
	}

 
?>
<!DOCTYPE HTML>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
	
	
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Sales this month"
	},
	axisY: {
		title: "Total Sale"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<br>
<br>
<br>
<h3 style = "text-align: center;"><b> Transaction History</b></h3></div>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Transaction Id</th>
      <th scope="col">Supplier</th>
      <th scope="col">Part</th>
      <th scope="col">Quantity</th>
	  <th scope="col">Price</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
  <?php
 $query_supply = "SELECT * FROM supply";


  $supply_transaction = mysqli_query($db, $query_supply) or die(mysqli_error($db));
  
  // echo mysqli_num_rows($supply_transaction);
    while($row = mysqli_fetch_array($supply_transaction)){
		echo "<tr>
		<th scope='row'>".$row['TRANSACTION_ID']."</th>
		<th>".$row['SUPPLIER_ NAME']."</th>
		<th>".$row['PART_NAME']."</th>
		<th>".$row['QUANTITY']."</th>
		<th>".$row['PRICE']."</th>
		<th>".$row['DATE']."</th>
	  </tr>";	
// 	echo "<tr>
// 	<th >Transaction Id</th>
// 	<th >Supplier</th>
// 	<th >Part</th>
// 	<th >Quantity</th>
// 	<th >Price</th>
// 	<th >Date</th>
//   </tr>";
	}

 
?>
  </tbody>
</table>
<?php
// include'../includes/footer.php';
?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>     