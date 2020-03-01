<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "dbtournament";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
};

// if(isset($_POST["btnResults"])){ 
// 	<script type="text/javascript">
//        window.open('PersonalJob_Results.php', '_blank');
//     </script>
// }
$NumTeams = $_SESSION["NumTeams"];
$TName = $_SESSION["TName"];
$SeedNum = $_SESSION["NumSeed"];
$sql = "SELECT * FROM savedata;";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$NumRounds = $row['NumRounds'];
}
$NumBreak = $_SESSION["NumBreak"];
$RoundNumber = $_SESSION["RoundNumber"];
// $RoundNumber = $RoundNumber + 1;
$sql = "SELECT COUNT(DISTINCT TeamName) AS num FROM $TName";
	//echo "$sql";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$NumTeams = $row['num'];
}

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "dbtournament";
// $booleanValidate = "false";

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
// 	die("Connection Failed: ". $conn->connect_error);
// }
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

$Split = $NumTeams/2;

// echo "$Split";
 for ($i=0; $i < $Split; $i++) { 
 	$Proposition[$i] = $TempArray[$i];
 }
$Index = 0;
for ($i=$Split; $i < $NumTeams ; $i++) { 
	$Opposition[$Index] = $TempArray[$i];
	$Index = $Index + 1;  
 }
//echo "Proposition"."<br>";
// for ($i=0; $i < $Split ; $i++) { 
	//echo $Proposition[$i]."<br>";
// }
//echo "Opposition"."<br>";
// for ($i=0; $i < $Split ; $i++) { 
	//echo $Opposition[$i]."<br>";
// }

$output = '';
$output .=' 
	<table class="table" border="1" style="text-align:center;">
		<tr>
			<td>Room</td>
			<td>Proposition Team</td>
			<td>Opposition Team</td>
			<td colspan="5"  style="text-align:center;">Judges</td>
		</tr>
';


	for ($i=0; $i < $Split ; $i++) {
		$output .= '
		<tr>
			<td>'.($i + 1).'</td>
			<td>'.$Proposition[$i].'</td>
			<td>'.$Opposition[$i].'</td>
			<td><input type="text" name="txtJudge" id="txtJudge"><td>
			<td><input type="text" name="txtJudge" id="txtJudge"><td>
			<td><input type="text" name="txtJudge" id="txtJudge"><td>
		</tr> 
		';
			}
	$output .= '</table>';
	//echo "$output";	


			
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo "$RoundNumber"?></title>
	<script type="text/javascript">
		function InsertResults() {
			window.open('PersonalJob_Results.php', '_blank');
		}
		// alert("Press 'Ctr' + '+' to make page larger!")
	</script>
		<script type="text/javascript">
		$(document).keypress(
  		function(event){
    		if (event.which == '13') {
     		event.preventDefault();
    	}
		});
	</script>

<style type="text/css">
/*table {
  border-collapse: collapse;
}
*/table td {
  border: 1px solid; 
  /*align-content: center;*/
}
table tr:first-child td {
  border-top: 1;
}
table tr td:first-child {
  border-left: 1;
}
table tr:last-child td {
  border-bottom: 1;
}
table tr td:last-child {
  border-right: 1;
}
</style>
</head>
<body>
	<div style="height: 100%; width: 80%; box-sizing: border-box;">
		<?php echo $output;?>
	</div>
	<form method="POST">
		<!-- <div style="float: right; background-color: cyan;">Press 'Ctrl' + '+' sign to make page larger! </div> -->
		<div><input type="button" name="btnResults" id="btnResults" value="Enter Results" onclick="InsertResults()"></div>
	</form>
</body>
<!-- <?php  
		
	// header('Content-Type: application/xls');
 //    header('Content-Disposition: attachment; filename=Matchup.xls');
?> -->
</html>