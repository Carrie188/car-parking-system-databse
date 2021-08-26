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
	$sql="UPDATE ".$dbname.".Customer SET Customer_Name = :cName WHERE Customer_Id = :custId;";  
	$stmnt = $conn->prepare($sql);   
	$stmnt->bindParam(':custId', $_POST['custId']);    
	$stmnt->bindParam(':cName', $_POST['cName']);
	

	$stmnt->execute();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<p style='color:green'>Data Update Successfully</p>";
}
catch (PDOException $err ) {
	echo "<p style='color:red'>Data Update Failed: " . $err->getMessage() . "</p>\r\n";
}
// Close connection
unset($conn);

echo "<a href='../updateRecord.html'>Update More Values</a> <br />";

echo "<a href='../index.html'>Back to the homepage</a>";

?>

</body>
</html>