<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtournament";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}

$TName = $_SESSION["TName"];
$SeedNum = $_SESSION["NumSeed"];
$NumRounds = $_SESSION["NumRounds"];
$NumBreak = $_SESSION["NumBreak"];
$RoundNumber = $_SESSION["RoundNumber"];
// $RoundNumber = $RoundNumber + 1;
$sql = "SELECT COUNT(DISTINCT TeamName) AS num FROM $TName";
	//echo "$sql";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$NumTeams = $row['num'];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtournament";
$booleanValidate = "false";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}
$TempArray = Array();
$sql = "SELECT DISTINCT TeamName from $TName";
$result = $conn->query($sql);
$i=0;
while ($row = $result->fetch_assoc()) {
	$TempArray[$i] = $row;
	$i++;	
}

$i=0;
foreach ($TempArray as  $value) {
	$TempArray[$i] = $value["TeamName"];
	$i++;
}


$RandomShuffle = shuffle($TempArray);
$Proposition = Array();
$Opposition = Array();
$Transition = Array();
$Split = $NumTeams / 2;
// echo "$Split";
 for ($i=0; $i < $Split; $i++) { 
 	$Proposition[$i] = $TempArray[$i];
 }
$Index = 0;
for ($i=$Split; $i < $NumTeams ; $i++) { 
	$Opposition[$Index] = $TempArray[$i];
	$Index = $Index + 1;  
}
echo "Proposition"."<br>";
for ($i=0; $i < $Split ; $i++) { 
	echo $Proposition[$i]."<br>";
}
echo "Opposition"."<br>";
for ($i=0; $i < $Split ; $i++) { 
	echo $Opposition[$i]."<br>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Seed Round</title>
</head>
<body>

</body>
</html>