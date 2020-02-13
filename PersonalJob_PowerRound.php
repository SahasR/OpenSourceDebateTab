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

$TName = $_SESSION["TName"];
$SeedNum = $_SESSION["NumSeed"];
$NumRounds = $_SESSION["NumRounds"];
$NumBreak = $_SESSION["NumBreak"];
$RoundNumber = $_SESSION["RoundNumber"];


$sql = "SELECT COUNT(DISTINCT TeamName) AS num FROM $TName";
	//echo "$sql";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$NumTeams = $row['num'];
}

$TempArray = Array();
$TempArrayWins = Array();

$sql = "SELECT TeamName from wins ORDER BY Wins DESC, Margins DESC, TotalScore DESC";
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

$sql = "SELECT Wins from wins ORDER BY Wins DESC";
$result = $conn->query($sql);
$i=0;
while ($row = $result->fetch_assoc()) {
	$TempArrayWins[$i] = $row;
	$i++;	
}

$i=0;
foreach ($TempArrayWins as  $value) {
	$TempArrayWins[$i] = $value["Wins"];
	$i++;
}

// for ($i=0; $i < $NumTeams ; $i++) { 
// 	echo "$TempArray[$i]".":"."$TempArrayWins[$i]<br>";
// }

$Proposition = Array();
$Opposition = Array();
$Transition = Array();
$Split = $NumTeams / 2;
$CountNew = 0;
while ($CountNew < $NumTeams-1) { 
	if ($CountNew==0) {
		array_push($Transition, $TempArray[$CountNew]);	
	}
	if ($TempArrayWins[$CountNew] == $TempArrayWins[$CountNew+1] ) {
		array_push($Transition, $TempArray[$CountNew+1]);
		$CountNew = $CountNew + 1;
		if ($CountNew == $NumTeams -1) {
			$SplitNew = Count($Transition) / 2;

			for ($i=0; $i < $SplitNew ; $i++) { 
				array_push($Proposition,$Transition[$i]);
			}
			for ($i=$SplitNew; $i < Count($Transition); $i++) { 
				array_push($Opposition,$Transition[$i]);
			}
			$Transition = Array();
		}
	}
	else {
		if (Count($Transition) % 2 == 1) {
			array_push($Transition, $TempArray[$CountNew+1]);
			$SplitNew = Count($Transition) / 2;

			for ($i=0; $i < $SplitNew ; $i++) { 
				array_push($Proposition,$Transition[$i]);
			}
			for ($i=$SplitNew; $i < Count($Transition); $i++) { 
				array_push($Opposition,$Transition[$i]);
			}
			$Transition = Array();
			$CountNew = $CountNew + 2;
			if ($CountNew < count($TempArray)) {
				array_push($Transition, $TempArray[$CountNew]);
			}
			
			
		}
		else {
			$SplitNew = Count($Transition) / 2;

			for ($i=0; $i < $SplitNew ; $i++) { 
				array_push($Proposition,$Transition[$i]);
			}
			for ($i=$SplitNew; $i < Count($Transition); $i++) { 
				array_push($Opposition,$Transition[$i]);
			}
			$Transition = Array();
			$CountNew = $CountNew + 1;
			array_push($Transition, $TempArray[$CountNew]);			
		}
	}
	
}


if (isset($_POST["btnSwitch"])) {
	if (isset($_SESSION["Proposition"]))
		{
		    $Proposition = $_SESSION["Proposition"];
			$Opposition = $_SESSION["Opposition"];
		}
	$Index = $_POST["txtSwitch"]*1;
	$Index = $Index-1;
	echo "$Proposition[$Index]"."Hello!";
	echo "$Opposition[$Index]";	
	$Temp = $Proposition[$Index];
	$Proposition[$Index] = $Opposition[$Index];
	$Opposition[$Index] = $Temp;
	$_SESSION["Proposition"] = $Proposition;
	$_SESSION["Opposition"] = $Opposition;

}
// echo "$Proposition[2]";

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
	<div style="width: 80%; box-sizing: border-box;">
		<?php echo $output;?>
	</div>
	<form method="POST">
		<!-- <div style="float: right; background-color: cyan;">Press 'Ctrl' + '+' sign to make page larger! </div> -->
		<div><input type="button" name="btnResults" id="btnResults" value="Enter Results" onclick="InsertResults()"></div>
		<table>
			<tr>
				<td><input type="text" name="txtSwitch" id="txtSwitch"></td>
				<td><input type="submit" name="btnSwitch" id="btnSwitch" value="Switch a Room:"></td>
			</tr>		
		</table>
	</form>
</body>
<!-- <?php  
		
	// header('Content-Type: application/xls');
 //    header('Content-Disposition: attachment; filename=Matchup.xls');
?> -->
</html>