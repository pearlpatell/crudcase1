<html>
<head>
<h1>Food List</h1>
</head>
</html>

<?php
require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

$restaurantid = $_GET['restaurantid'];
$query = "Select * from Restaurant join Food where Restaurant.restaurant_ID=Food.restaurant_ID and Food.restaurant_ID=$restaurantid"; //this is the query 
$result = $conn->query($query); //this will run the query
if(!$result) die($conn->error); //if result is false, pull up the error

session_start();
$_SESSION['restaurantid'] = $restaurantid;

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	echo $row['Restaurant_Name'];
	echo '<br>';
	echo $row['Name'];
	echo "<a href='add-review.php?foodid=$row[Food_ID]'>Add Review</a>";
	//echo "Food: <a href=food-list.php?restaurantid=$row[Restaurant_ID]>$row[Restaurant_Name] </a><br>";
	
	echo '<br>';
}



$result->close();
$conn->close();

?>