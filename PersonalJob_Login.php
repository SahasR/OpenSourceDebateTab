<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "dbtournament";
$booleanValidate = "false";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}

if (isset($_POST["btnCont"])) {
	$TournamentName = $_POST["txtCont"];
	$sql = "SELECT * FROM savedata";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)) {
		$NumBreak = $row['NumBreak'];
		$NumRounds = $row['NumRounds'];
		$NumSeed = $row['NumSeed'];
		$RoundNumber= $row['RoundNumber'];
		// $TournamentName = $row['TournamentName'];
		}
		$_SESSION["NumBreak"] = $NumBreak;
		$_SESSION["NumRounds"] = $NumRounds;
		$_SESSION["NumSeed"] = $NumSeed;
		$_SESSION["TName"] = $TournamentName;
		$_SESSION["RoundNumber"] = $RoundNumber;
		// echo "NumBreak: $NumBreak<br>";
		// echo "NumSeed: $NumSeed<br>";
		// echo "NumRounds: $NumRounds<br>";
		if ($RoundNumber > $NumSeed) {
			header("Location:PersonalJob_PowerRound.php");
		}
		else if ($RoundNumber <= $NumSeed) {
			header("Location:PersonalJob_SeedRound.php");
		}
		else {
			header("Location:PersonalJob_Finished.php");
		}
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
	    $sql = "CREATE TABLE savedata (
	    			NumBreak FLOAT,
	    			NumRounds FLOAT,
	    			NumSeed FLOAT,
	    			TournamentName varchar(255),
	    			RoundNumber FLOAT
				)";
	    $result = $conn->query($sql);
	    $sql = "INSERT INTO savedata (NumBreak, NumRounds, NumSeed,TournamentName)
	    		VALUES ($NumBreak, $NumRounds, $NumSeed, '$TournamentName')";
	    $result = $conn->query($sql);	
		
		header("Location: PersonalJob_Reg.php");
		
	}
	else {
		echo "Some data is wrong";
	}
		
}

if (isset($_POST["btnReg"])) {
	$sql = "SELECT * FROM savedata";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)) {
		$NumBreak = $row['NumBreak'];
		$NumRounds = $row['NumRounds'];
		$NumSeed = $row['NumSeed'];
		$RoundNumber= $row['RoundNumber'];
		$TournamentName = $row['TournamentName'];
		}
		$_SESSION["NumBreak"] = $NumBreak;
		$_SESSION["NumRounds"] = $NumRounds;
		$_SESSION["NumSeed"] = $NumSeed;
		$_SESSION["TName"] = $TournamentName;
		// echo "NumBreak: $NumBreak<br>";
		// echo "NumSeed: $NumSeed<br>";
		// echo "NumRounds: $NumRounds<br>";
		header("Location:PersonalJob_Reg.php");
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
	<div id="divStartUp" style="width: 30%; height: 30%; text-align: center; position:absolute; left:0; right:0; margin-left:auto; margin-right:auto; display: inline-block;">
		<form method="POST">
			<table>	
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
		<div id="divContinue" style="float: left; background-color: salmon; text-align: center;">
			If you are continuing the tournament:
			<table>
				<tr>
					<td>
						Enter Tourney Name:
					</td>
					<td>
						<input type="text" name="txtCont" id="txtCont">
					</td>
				</tr>
				<tr>
					<td>	
					</td>
					<td>
						<input type="submit" name="btnCont" id="btnCont" value="Continue Tabbing">
					</td>
				</tr>
				<tr>
					<td>	
					</td>
					<td>
						<input type="submit" name="btnReg" id="btnReg" value="Continue Registration">
					</td>
				</tr>
			</table>
		</div>	
	</form>	
</body>
</html>