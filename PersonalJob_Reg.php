<?php
session_start();

$TName = $_SESSION["TName"];
$SeedNum = $_SESSION["NumSeed"];
$NumRounds = $_SESSION["NumRounds"];
//echo "$TName";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtournament";
$NumSchools = 0;
$NumTeams = 0;
$NumDebaters = 0;
$ValidateBoo = "false";
$RoundNumber = 1;

// echo "$TName";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}

if (isset($_POST["btnOutPut"])) {
		header("Location:PersonalJob_Export1.php");		
}


if (isset($_POST["btnBeginT"])) {
	$_SESSION["RoundNumber"] = $RoundNumber;
	$sql = "CREATE TABLE speaks
  			AS (SELECT MemberName, TeamName, SchoolName FROM $TName)";
  	$result = $conn->query($sql);
  	for ($Counter=1; $Counter <= $NumRounds; $Counter++) { 
  				$RoundName = "Round" . strval($Counter);
  				$sql = "ALTER TABLE speaks
						ADD $RoundName FLOAT";
				$result = $conn->query($sql);		

  			}
  	$sql = "ALTER TABLE speaks
  			ADD Average FLOAT";
  	$result = $conn->query($sql);

   $sql = "UPDATE savedata
			 SET RoundNumber = 1
			 WHERE TournamentName = '$TName'";
	echo "UPDATE savedata SET RoundNumber = 1 WHERE TournamentName = '$TName'";		

	$result = $conn->query($sql);		
		
  	$sql = "SELECT COUNT(DISTINCT TeamName) AS num FROM $TName";
	//echo "$sql";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		$NumTeams = $row['num'];
	}
	//echo "$NumTeams";

  	if ($NumTeams%2 == 1 ) {
  		$sql = "INSERT INTO $TName (TeamName)
  			VALUES ('Swing Team')";
  		$result = $conn->query($sql);
  		//echo "Hello!";		
  	}

  	$sql = "CREATE TABLE wins
  			AS (SELECT DISTINCT TeamName FROM $TName)";
   	$result = $conn->query($sql);
 	$sql = "ALTER TABLE wins
 			ADD Wins tinyint";
 	$result = $conn->query($sql);
 	$sql = "ALTER TABLE wins
 			ADD TotalScore FLOAT";
 	$result = $conn->query($sql);
 	$sql = "ALTER TABLE wins
 			ADD Margins FLOAT";
 	$result = $conn->query($sql); 							
  	header("Location:PersonalJob_SeedRound.php");

}


// if (isset($_POST["btnStats"])) {
	$sql = "SELECT COUNT(DISTINCT SchoolName) AS num FROM $TName";
	//echo "$sql";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		$NumSchools = $row['num'];
	}
	$sql = "SELECT COUNT(DISTINCT MemberName) AS num FROM $TName";
	//echo "$sql";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		$NumDebaters = $row['num'];
	}
	$sql = "SELECT COUNT(DISTINCT TeamName) AS num FROM $TName";
	//echo "$sql";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		$NumTeams = $row['num'];
		$_SESSION["NumTeams"] = $NumTeams;
	}
// }

if (isset($_POST["btnAddMember"])) {
	$SklName = $_POST["txtSklName"];
	$TeamName = $_POST["txtTeamName"];
	$TeamMember1 = $_POST["txtMemberName1"];
	$TeamMember2 = $_POST["txtMemberName2"];
	$TeamMember3 = $_POST["txtMemberName3"];
	$TeamMember4 = $_POST["txtMemberName4"];
	$TeamMember5 = $_POST["txtMemberName5"];			
	// $Novice = $_POST["lstNovice"];
	// //echo "$Novice";
	// $Food = $_POST["lstFood"];
	// //echo "$Food";
	// $Number = "";
	// $Number = $_POST["txtContact"];
		
	$ValidateBoo = ValidateData($SklName, $TeamName, $TeamMember1, $TeamMember2, $TeamMember3);
	if ($ValidateBoo == "true") {
		$sql = "INSERT INTO $TName (MemberName, TeamName, SchoolName)
					VALUES ('$TeamMember1','$TeamName', '$SklName')";
		//echo "$sql";
    	$result = $conn->query($sql);
    	$sql = "INSERT INTO $TName (MemberName, TeamName, SchoolName)
					VALUES ('$TeamMember2','$TeamName', '$SklName')";
		//echo "$sql";
    	$result = $conn->query($sql);
    	$sql = "INSERT INTO $TName (MemberName, TeamName, SchoolName)
					VALUES ('$TeamMember3','$TeamName', '$SklName')";
		//echo "$sql";
    	$result = $conn->query($sql);
    	if ($TeamMember4 <> "") {
    		$sql = "INSERT INTO $TName (MemberName, TeamName, SchoolName)
					VALUES ('$TeamMember4','$TeamName', '$SklName')";
    		$result = $conn->query($sql);
    	}
    	if ($TeamMember5 <> "") {
    		$sql = "INSERT INTO $TName (MemberName, TeamName, SchoolName)
					VALUES ('$TeamMember5','$TeamName', '$SklName')";
    		$result = $conn->query($sql);
    	}    	
	}
	else {
		echo "Some Data is missing";
	}
}

function ValidateData($pSklName, $pTeamName, $pTeamMember1, $pTeamMember2, $pTeamMember3) {
	if ($pSklName <> "" && $pTeamName <> "" && $pTeamMember1 <> "" && $pTeamMember2 <> "" && $pTeamMember3 <> "") {
		Return "true";
	}
}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Registrations Page</title>
		<script type="text/javascript">
		$(document).keypress(
  		function(event){
    		if (event.which == '13') {
     		event.preventDefault();
    	}
		});
	</script>

</head>
<body>
	<form method="POST">
	<div id="divMain" style="width: 30%; display: block; overflow: auto; text-align: center; position:absolute; left:0; right:0; margin-left:auto; margin-right:auto; background-color: cyan;">	
		<table>
			<tr>
				<td>
					Enter School Name:
				</td>
				<td>
					<input type="text" name="txtSklName" id="txtSklName">
				</td>
			</tr>
			<tr>
				<td>
					Enter Team Name:
				</td>
				<td>
					<input type="text" name="txtTeamName" id="txtTeamName">
				</td>
			</tr>
			<tr>
				<td>
					 Members Name:
				</td>
				<td>
					<input type="text" name="txtMemberName1" id="txtMemberName1">
				</td>
			</tr>
			<tr>
				<td>
					 Members Name:
				</td>
				<td>
					<input type="text" name="txtMemberName2" id="txtMemberName2">
				</td>
			</tr>
			<tr>
				<td>
					 Members Name:
				</td>
				<td>
					<input type="text" name="txtMemberName3" id="txtMemberName3">
				</td>
			</tr>
			<tr>
				<td>
					 Members Name:
				</td>
				<td>
					<input type="text" name="txtMemberName4" id="txtMemberName4">
				</td>
			</tr>
			<tr>
				<td>
					 Members Name:
				</td>
				<td>
					<input type="text" name="txtMemberName5" id="txtMemberName5">
				</td>
			</tr>			
			<tr>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="btnAddMember" id="btnAddMember" value="Add Member">
				</td>
			</tr>
		</table>
	</div>
	<div style="float: right; background-color: salmon;">
		<table>
			<tr>
				<td>
					Begin Tournament!
				</td>
				<td>
					<input type="submit" name="btnBeginT" id="btnBeginT" value="Click Here!">
				</td>
			</tr>
		</table>
	</div>
	<div style="float: left; background-color: silver;">
		<!-- <input type="submit" name="btnStats" id="btnStats" value="Check Stats" > -->
		<table>
			<tr>
				<td>
					Number of Schools:	
				</td>
				<td>
					<input type="text" name="txtCountSchools" id="txtCountSchools" readonly="readonly" value="<?php echo($NumSchools) ?>">
				</td>
			</tr>
			<tr>
				<td>
					Number of Teams:
				</td>
				<td>
					<input type="text" name="txtCountTeams" id="txtCountTeams" readonly="readonly" value="<?php echo($NumTeams) ?>">
				</td>
			</tr>
			<tr>
				<td>
					Number of Debaters:
				</td>
				<td>
					<input type="text" name="txtCountDebaters" id="txtCountDebaters" readonly="readonly" value="<?php echo($NumDebaters)  ?>">
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>Output Data:</td>
				<td><input type="submit" name="btnOutPut" id="btnOutPut" value="Check Database"></td>
			</tr>
		</table>

	</div>	
	</form>
</body>
</html>