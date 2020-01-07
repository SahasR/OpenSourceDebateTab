<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtournament";
$booleanValidate = "false";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}

if (isset($_POST["btnStart"])) {
	$NumBreak = $_POST["txtBreak"] * 1;
	$NumSeed = $_POST["txtNumSeeds"];
	$TournamentName = $_POST["txtEnterTName"];
	$TournamentName = str_replace(' ', '', $TournamentName);
	$NumRounds = $_POST["txtNumRounds"];
	$Try = ValidatePage($NumBreak, $NumSeed, $TournamentName, $NumRounds);
	//echo "$booleanValidate";
	if ($Try == "true") {
		$_SESSION["NumBreak"] = $NumBreak;
		$_SESSION["NumRounds"] = $NumRounds;
		$_SESSION["NumSeed"] = $NumSeed;
		$_SESSION["TName"] = $TournamentName;
		$sql = "CREATE TABLE $TournamentName (
					MemberName varchar(255),
					TeamName varchar(255),
					SchoolName varchar(255),
					Novice boolean,
					FoodPreference varchar(20),
					ContactDetails varchar(25)
				);";		
	    $result = $conn->query($sql);
		header("Location: PersonalJob_Reg.php");
		
	}
	else {
		echo "Some data is wrong";
	}
		
}

function ValidatePage($pNumBreak, $pNumSeed, $pTournamentName, $pNumRounds) {
	if ($pNumBreak <> "" && $pNumSeed <> "" && $pTournamentName <> "" && $pNumRounds <> "" ) {
		if ($pNumBreak%2 == 0 ) {
			//echo "$pNumBreak";
			//echo "$pNumSeed";
			//echo "$pTournamentName";
			//echo "$pNumRounds";
			$booleanValidate = "true";
			return "$booleanValidate";
			//echo "$booleanValidate";
		}
	}
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>WebBasedDebate</title>
</head>
<body>
	<div id="divStartUp" style="width: 30%; height: 30%; text-align: center; position:absolute; left:0; right:0; margin-left:auto; margin-right:auto;">
		<form method="POST">
			<table>
				<tr>
					<td>
						Not a New Tournament?
					</td>
					<td>
						<input type="submit" name="btnNotNew" id="btnNotNew" value="Load Old Data">
					</td>			
				</tr>
				<tr>
					<td>Else....</td>
				</tr>	
				<tr>
					<td>
						Enter Tournament Name:
					</td>
					<td>	
						<input type="text" name="txtEnterTName" id="txtEnterTName">
					</td>
				</tr>
				<tr>
					<td>
						Number of Prelimanry Rounds:
					</td>
					<td>
						<input type="text" name="txtNumRounds" id="txtNumRounds">
					</td>
				</tr>	
				<tr>
					<td>
						Number of Seeded Rounds:
					</td>
					<td>
						<input type="text" name="txtNumSeeds" id="txtNumSeeds">
					</td>
				</tr>
				<tr>
					<td>
						Number of Teams Breaking:
					</td>
					<td>
						<input type="text" name="txtBreak" id="txtBreak">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="btnStart" id="btnStart" value="Create Tournament">
					</td>
				</tr>
			</table>
		</div>
		<div id="divBoast" style="float: right; background-color: cyan; width: 20%; text-align: center;">No Rights Reserved by Sahas Gunasekara cause Communism Comrades.</div>		
	</form>	
</body>
</html>