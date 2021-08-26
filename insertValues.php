<!doctype html>
<html>
<head>
	<title>Insert Data Into a Database</title>
	<link rel="stylesheet" href="../css/style.css" />
</head>
<body>

<?php
$servername ="localhost";
$dbname = "ParkingSystem";
$username = "root";
$password = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<p style='color:green'>Connection Was Successful</p>";
}
catch (PDOException $err) {
	echo "<p style='color:red'>Connection Failed: " . $err->getMessage() . "</p>\r\n";
}


try {
	$sql="INSERT INTO Customer (Customer_Id,Is_Regular_Customer, Customer_Name,Phone_Number, Registration_Time) VALUES (:custId, :regular, :cName, :phoNum, :date);";  
	$stmnt = $conn->prepare($sql);   
	$stmnt->bindParam(':custId', $_POST['custId']);   
	$stmnt->bindParam(':regular', $_POST['regular']);   
	$stmnt->bindParam(':cName', $_POST['cName']);
	$stmnt->bindParam(':phoNum', $_POST['phoNum']);
	$stmnt->bindParam(':date', $_POST['date']);

	$stmnt->execute();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<p style='color:green'>Data Inserted Into Table Successfully</p>";
}
catch (PDOException $err ) {
	echo "<p style='color:red'>Data Insertion Failed: " . $err->getMessage() . "</p>\r\n";
}
// Close connection
unset($conn);

echo "<a href='../insertData.html'>Insert More Values</a> <br />";

echo "<a href='../index.html'>Back to the homepage</a>";

?>

</body>
</html>