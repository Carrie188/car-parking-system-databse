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
        
    
	$sql="SELECT * FROM ".$dbname.".Customer WHERE Is_Regular_Customer = :regular;";  
	$stmnt = $conn->prepare($sql);    
	$stmnt->bindParam(':regular', $_POST['regular']);   

	$stmnt->execute();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $row = $stmnt->fetch();  // fetches the first row of the table
        if ($row) {      // if there is any result from the query
            echo '<table>';
            echo '<tr> <th>Customer ID</th> <th>Customer Name</th> <th>Is Regular</th> <th>Phone Number</th> <th>Date</th> </tr>';
            do {
                echo '<tr><td>' . $row['Customer_Id'] . '</td><td>' . $row['Customer_Name'] . '</td><td>' . $row['Is_Regular_Customer'] . '</td><td>' . $row['Phone_Number'] . '</td><td>' . $row['Registration_Time'] . '</td></tr>';
            } while ($row = $stmnt->fetch());     // fetches another row from the query result, until we reach to the end of the result
            echo '</table>';
        } else {
            echo "<p> No Record Found!</p>";
        }
}
catch (PDOException $err ) {
	echo "<p style='color:red'>Data Search Failed: " . $err->getMessage() . "</p>\r\n";
}
// Close connection
unset($conn);

echo "<a href='../selectQuery.html'>Select More Values</a> <br />";

echo "<a href='../index.html'>Back to the homepage</a>";

?>

</body>
</html>