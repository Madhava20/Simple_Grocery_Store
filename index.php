<html>
<meta http-equiv="Content-Type"'.' content="text/html; charset=utf8"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<body>
<?php
session_start();
	if(isset($_POST['ac'])){
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE Grocery";
		$conn->query($sql);

		$sql = "SELECT * FROM grocery WHERE GroceryID = '".$_POST['ac']."'";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
			$GroceryID = $row['GroceryID'];
			$quantity = $_POST['quantity'];
			$price = $row['Price'];
		}

		$sql = "INSERT INTO cart(GroceryID, Quantity, Price, TotalPrice) VALUES('".$GroceryID."', ".$quantity.", ".$price.", Price * Quantity)";
		$conn->query($sql);
	}

	if(isset($_POST['delc'])){
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE Grocery";
		$conn->query($sql);

		$sql = "DELETE FROM cart";
		$conn->query($sql);
	}

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "USE Grocery";
	$conn->query($sql);	

	$sql = "SELECT * FROM grocery";
	$result = $conn->query($sql);
?>	

<?php
if(isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	echo '<a href="index.php"><img src="image/logo.png"></a>';
	echo '<form class="hf" action="logout.php"><input class="hi" type="submit" name="submitButton" value="Logout"></form>';
	echo '<form class="hf" action="edituser.php"><input class="hi" type="submit" name="submitButton" value="Edit Profile"></form>';
	echo '</blockquote>';
	echo '</header>';
}

if(!isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	echo '<a href="index.php"><img src="image/logo.png"></a>';
	echo '<form class="hf" action="Register.php"><input class="hi" type="submit" name="submitButton" value="Register"></form>';
	echo '<form class="hf" action="login.php"><input class="hi" type="submit" name="submitButton" value="Login"></form>';
	echo '</blockquote>';
	echo '</header>';
}
echo '<blockquote>';
	echo "<table id='myTable' style='width:80%; float:left'>";
	echo "<tr>";
    while($row = $result->fetch_assoc()) {
	    echo "<td>";
	    echo "<table>";
	   	echo '<tr><td>'.'<img src="'.$row["Image"].'"width="80%">'.'</td></tr><tr><td style="padding: 5px;">Title: '.$row["Title"].'</td></tr><tr><td style="padding: 5px;">Bar Code: '.$row["BarCode"].'</td></tr><tr><td style="padding: 5px;">Manufacturer: '.$row["Manufacturer"].'</td></tr><tr><td style="padding: 5px;">Type: '.$row["Type"].'</td></tr><tr><td style="padding: 5px;">RM'.$row["Price"].'</td></tr><tr><td style="padding: 5px;">
	   	<form action="" method="post">
	   	Quantity: <input type="number" value="1" name="quantity" style="width: 20%"/><br>
	   	<input type="hidden" value="'.$row['GroceryID'].'" name="ac"/>
	   	<input class="button" type="submit" value="Add to Cart"/>
	   	</form></td></tr>';
	   	echo "</table>";
	   	echo "</td>";
    }
    echo "</tr>";
    echo "</table>";

	$sql = "SELECT grocery.Title, grocery.Image, cart.Price, cart.Quantity, cart.TotalPrice FROM grocery,cart WHERE grocery.GroceryID = cart.GroceryID;";
	$result = $conn->query($sql);

    echo "<table style='width:20%; float:right;'>";
    echo "<th style='text-align:left;'><i class='fa fa-shopping-cart' style='font-size:24px'></i> Cart <form style='float:right;' action='' method='post'><input type='hidden' name='delc'/><input class='cbtn' type='submit' value='Empty Cart'></form></th>";
    $total = 0;
    while($row = $result->fetch_assoc()){
    	echo "<tr><td>";
    	echo '<img src="'.$row["Image"].'"width="20%"><br>';
    	echo $row['Title']."<br>Rs".$row['Price']."<br>";
    	echo "Quantity: ".$row['Quantity']."<br>";
    	echo "Total Price: Rs".$row['TotalPrice']."</td></tr>";
    	$total += $row['TotalPrice'];
    }
    echo "<tr><td style='text-align: right;background-color: #f2f2f2;''>";
    echo "Total: <b>Rs".$total."</b><center><form action='checkout.php' method='post'><input class='button' type='submit' name='checkout' value='CHECKOUT'></form></center>";
    echo "</td></tr>";
	echo "</table>";
	echo '</blockquote>';
?>
</body>
</html>