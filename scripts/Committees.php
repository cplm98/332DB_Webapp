<!DOCTYPE html>
<html>
<head>
<link href="Committees.css" type="text/css" rel="stylesheet" >
</head>
<body>
<h2>Sub-committee Information</h2>


<?php

$SubCommittee = $_POST["SubCommittee"];
echo "<p>$SubCommittee Members:</p>";
echo "<table><tr><th>First Name</th><th>Last Name</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=Conference', "root", "");

$sql = "select Fname, Lname from SubCommittee";
$statement = $pdo->prepare($sql);   	#create the query
$statement->execute([$SubCommittee]);  	#bind the parameters

#statement contains the result of the program execution
#use fetch to get results row by row.
while ($row = $statement->fetch()) {
	echo "<tr><td>".$row["name"]."</td><td>".$row["salary"]."</td></tr>";
}


?>
</table>
</body>
</html> 
