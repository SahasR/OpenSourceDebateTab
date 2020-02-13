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
$sql = "SELECT * FROM savedata;";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$NumRounds = $row['NumRounds'];
}
$NumBreak = $_SESSION["NumBreak"];
$RoundNumber = $_SESSION["RoundNumber"];
// echo "$RoundNumber";
$NumTeams = $_SESSION["NumTeams"];
$Checking = "true";
// echo "$NumTeams";
// echo "$TName";
// echo "$SeedNum";
// echo "$NumRounds";
// echo "$RoundNumber";
$RoundName = "Round" . $RoundNumber;
// echo "$RoundName";
if(empty($_SESSION['count'])) $_SESSION['count'] = 0;
// echo "$NumRounds";

if (isset($_POST["btnNext"])) {
	$order = $_SESSION["count"];
	$Remaining = $NumTeams - $order;
	// $Remaining = 4;
	if ($Remaining == 0) {
		unset($_SESSION['count']);
		$RoundNumber = $RoundNumber +1;
		$_SESSION["RoundNumber"] = $RoundNumber;
  		$sql = "UPDATE savedata SET RoundNumber = $RoundNumber WHERE TournamentName = '$TName'";
 		$result = $conn->query($sql);  			
 		unset($_SESSION["Proposition"]);
 		unset($_SESSION["Opposition"]);
		if ($RoundNumber > $SeedNum && $RoundNumber <= $NumRounds) {
			header("Location:PersonalJob_PowerRound.php");
		}
		elseif ($RoundNumber <= $SeedNum) {
			header("Location:PersonalJob_SeedRound.php");
		}
		elseif ($RoundNumber > $NumRounds) {
			header("Location:PersonalJob_Finished.php");
		}
		
	}
	else {
		echo "Some values still need to be entered.";
	}
}
// echo "$RoundNumber";


if (isset($_POST["btnResults"])) {
	// echo "Hello!";
	$lstPropName = $_POST["lstPropName"];
	$lstFirstPropName = $_POST["lstFirstPropName"];
	$lstSecondPropName = $_POST["lstSecondPropName"];
	$lstThirdPropName = $_POST["lstThirdPropName"];
	$lstOppName = $_POST["lstOppName"];
	$lstFirstOppName = $_POST["lstFirstOppName"];
	$lstSecondOppName = $_POST["lstSecondOppName"];
	$lstThirdOppName = $_POST["lstThirdOppName"];
	$txtFirstPropScore = $_POST["txtFirstPropScore"]*1;
	$txtSecondPropScore = $_POST["txtSecondPropScore"]*1;
	$txtThirdPropScore = $_POST["txtThirdPropScore"]*1;
	$PropReplyScore = $_POST["PropReplyScore"]*1;


	$txtFirstOppScore = $_POST["txtFirstOppScore"]*1;
	$txtSecondOppScore = $_POST["txtSecondOppScore"]*1;
	$txtThirdOppScore = $_POST["txtThirdOppScore"]*1;
	$OppReplyScore = $_POST["OppReplyScore"]*1;

	// $Checking = Validation();

	if ($Checking == "true") {

		$sql = "UPDATE speaks SET $RoundName=$txtFirstPropScore where MemberName='$lstFirstPropName'";
  		$result = $conn->query($sql);

	  		$sql = "SELECT Total FROM speaks WHERE MemberName = '$lstFirstPropName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Total = $row["Total"];
	  		} 

	  		$Total = $Total + $txtFirstPropScore;
	  		$sql = "UPDATE speaks SET Total = $Total WHERE MemberName = '$lstFirstPropName'";
	  		$result = $conn->query($sql);

	  		$sql = "SELECT Count FROM speaks WHERE MemberName = '$lstFirstPropName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Count = $row["Count"];
	  		} 
	  		$Count = $Count + 1;
	  		$sql = "UPDATE speaks SET Count = $Count WHERE MemberName = '$lstFirstPropName'";
	  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtSecondPropScore where MemberName='$lstSecondPropName'";
  		$result = $conn->query($sql);

  			$sql = "SELECT Total FROM speaks WHERE MemberName = '$lstSecondPropName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Total = $row["Total"];
	  		} 

	  		$Total = $Total + $txtSecondPropScore;
	  		$sql = "UPDATE speaks SET Total = $Total WHERE MemberName = '$lstSecondPropName'";
	  		$result = $conn->query($sql);

	  		$sql = "SELECT Count FROM speaks WHERE MemberName = '$lstSecondPropName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Count = $row["Count"];
	  		} 
	  		$Count = $Count + 1;
	  		$sql = "UPDATE speaks SET Count = $Count WHERE MemberName = '$lstSecondPropName'";
	  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtThirdPropScore where MemberName='$lstThirdPropName'";
  		$result = $conn->query($sql);

  			$sql = "SELECT Total FROM speaks WHERE MemberName = '$lstThirdPropName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Total = $row["Total"];
	  		} 

	  		$Total = $Total + $txtThirdPropScore;
	  		$sql = "UPDATE speaks SET Total = $Total WHERE MemberName = '$lstThirdPropName'";
	  		$result = $conn->query($sql);

	  		$sql = "SELECT Count FROM speaks WHERE MemberName = '$lstThirdPropName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Count = $row["Count"];
	  		} 
	  		$Count = $Count + 1;
	  		$sql = "UPDATE speaks SET Count = $Count WHERE MemberName = '$lstThirdPropName'";
	  		$result = $conn->query($sql);


		$sql = "UPDATE speaks SET $RoundName=$txtFirstOppScore where MemberName='$lstFirstOppName'";
  		$result = $conn->query($sql);

	  		$sql = "SELECT Total FROM speaks WHERE MemberName = '$lstFirstOppName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Total = $row["Total"];
	  		} 

	  		$Total = $Total + $txtFirstOppScore;
	  		$sql = "UPDATE speaks SET Total = $Total WHERE MemberName = '$lstFirstOppName'";
	  		$result = $conn->query($sql);

	  		$sql = "SELECT Count FROM speaks WHERE MemberName = '$lstFirstOppName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Count = $row["Count"];
	  		} 
	  		$Count = $Count + 1;
	  		$sql = "UPDATE speaks SET Count = $Count WHERE MemberName = '$lstFirstOppName'";
	  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtSecondOppScore where MemberName='$lstSecondOppName'";
  		$result = $conn->query($sql);

  			$sql = "SELECT Total FROM speaks WHERE MemberName = '$lstSecondOppName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Total = $row["Total"];
	  		} 

	  		$Total = $Total + $txtSecondOppScore;
	  		$sql = "UPDATE speaks SET Total = $Total WHERE MemberName = '$lstSecondOppName'";
	  		$result = $conn->query($sql);

	  		$sql = "SELECT Count FROM speaks WHERE MemberName = '$lstSecondOppName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Count = $row["Count"];
	  		} 
	  		$Count = $Count + 1;
	  		$sql = "UPDATE speaks SET Count = $Count WHERE MemberName = '$lstSecondOppName'";
	  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtThirdOppScore where MemberName='$lstThirdOppName'";
  		$result = $conn->query($sql);

  			$sql = "SELECT Total FROM speaks WHERE MemberName = '$lstThirdOppName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Total = $row["Total"];
	  		} 

	  		$Total = $Total + $txtThirdOppScore;
	  		$sql = "UPDATE speaks SET Total = $Total WHERE MemberName = '$lstThirdOppName'";
	  		$result = $conn->query($sql);

	  		$sql = "SELECT Count FROM speaks WHERE MemberName = '$lstThirdOppName'";
	  		$result = $conn->query($sql);
	  		while($row = $result->fetch_assoc()) {
	  			$Count = $row["Count"];
	  		} 
	  		$Count = $Count + 1;
	  		$sql = "UPDATE speaks SET Count = $Count WHERE MemberName = '$lstThirdOppName'";
	  		$result = $conn->query($sql);	


  		$PropTotalSpeaks = $txtFirstPropScore + $txtSecondPropScore + $txtThirdPropScore + $PropReplyScore;
  		$OppTotalSpeaks = $txtFirstOppScore + $txtSecondOppScore + $txtThirdOppScore + $OppReplyScore;

  		$PropMargin = $PropTotalSpeaks - $OppTotalSpeaks;
  		$OppMargin = $OppTotalSpeaks - $PropTotalSpeaks;

  		$sql = "SELECT Margins FROM wins WHERE TeamName = '$lstPropName'";
  		$result = $conn->query($sql);
  		while($row = $result->fetch_assoc()) {
  			$Margins = $row["Margins"];
  		} 

  		$Margins = $Margins + $PropMargin;
  		$sql = "UPDATE wins SET Margins = $Margins WHERE TeamName = '$lstPropName'";
  		$result = $conn->query($sql);

  		$sql = "SELECT Margins FROM wins WHERE TeamName = '$lstOppName'";
  		$result = $conn->query($sql);
  		while($row = $result->fetch_assoc()) {
  			$Margins = $row["Margins"];
  		} 

  		$Margins = $Margins + $OppMargin;
  		$sql = "UPDATE wins SET Margins = $Margins WHERE TeamName = '$lstOppName'";
  		$result = $conn->query($sql); 		

  		$sql = "SELECT TotalScore FROM wins WHERE TeamName = '$lstPropName'";
  		// echo "$sql";
  		// echo "$PropTotalSpeaks";
  		$result = $conn->query($sql);
  		while($row = $result->fetch_assoc()) {
  			$Score = $row["TotalScore"];
  		}
  		$Score = $Score + $PropTotalSpeaks;
  		// echo "$Score";
  		$sql = "UPDATE wins SET TotalScore = $Score WHERE TeamName = '$lstPropName'";
  		// echo "$sql";
  		$result = $conn->query($sql);

  		$sql = "SELECT TotalScore FROM wins WHERE TeamName = '$lstOppName'";
  		$result = $conn->query($sql);
  		while($row = $result->fetch_assoc()) {
  			$Score = $row["TotalScore"];
  		}
  		$Score = $Score + $OppTotalSpeaks;
  		$sql = "UPDATE wins SET TotalScore = $Score WHERE TeamName = '$lstOppName'";
  		$result = $conn->query($sql);

  		if ($PropTotalSpeaks > $OppTotalSpeaks) {
  			$sql = "SELECT Wins FROM wins WHERE TeamName = '$lstPropName'";
  			$result = $conn->query($sql);
  			while ($row = $result->fetch_assoc()) {
  				$UpdatedWins = $row["Wins"];
  			}
  			$UpdatedWins = $UpdatedWins + 1;
  			$sql = "UPDATE wins SET Wins = $UpdatedWins WHERE TeamName = '$lstPropName'";
  			$result = $conn->query($sql);
  		}
  		else {
  			$sql = "SELECT Wins FROM wins WHERE TeamName = '$lstOppName'";
  			$result = $conn->query($sql);
  			while ($row = $result->fetch_assoc()) {
  				$UpdatedWins = $row["Wins"];
  			}
  			$UpdatedWins = $UpdatedWins + 1;
  			$sql = "UPDATE wins SET Wins = $UpdatedWins WHERE TeamName = '$lstOppName'";
  			$result = $conn->query($sql);  			
  		}
  		$order =  $_SESSION['count']+2;
 		$_SESSION['count'] =  $order;
 		$Remaining = $NumTeams - $order;
 		echo "Number of Teams Left to Submit: $Remaining";
	}

}

function Validation() {
	if ($lstPropName <> "" && $lstFirstPropName <> "" && $lstSecondPropName <> "" && $lstThirdPropName <> "" && $txtFirstPropScore <> "" && $txtSecondPropScore <> "" && $txtThirdPropScore <> "" && $PropReplyScore <> "" && $lstOppName <> "" && $lstFirstOppName <> "" && $lstSecondOppName <> "" && $lstThirdOppName <> "" && $txtFirstOppScore <> "" && $txtSecondOppScore <> "" && $txtThirdOppScore <> "" && $OppReplyScore <> "" ) {
		echo "Input valid data!";
	}
	else {
		return "true";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Results Page!</title>
		<script type="text/javascript">
		$(document).keypress(
  		function(event){
    		if (event.which == '13') {
     		event.preventDefault();
    	}
		});
	</script>

<!-- 	<script type="text/javascript">
		function LetsGo() {
			alert("Hello");
			var $Test = document.getElementByID('lstPropName').value;
			alert($Test);
		}
	</script> -->
</head>
<body>
	<form  method="post">
	<div style="text-align: center;">
		<div style="float: left; background-color: cyan; width: 50%">
	
			<table>
				<tr>
					<td colspan="2">Proposition</td>				
				</tr>
				<tr>
					<!-- <td>
						Enter Team Name:
					</td> -->
					<td>
						<select id="lstPropName" name="lstPropName">
							<option value="">Select Team Name</option>
							<?php
    							$sql = "SELECT DISTINCT TeamName from $TName";
    							$result = $conn->query($sql);
								while ($row = $result->fetch_assoc()) {
								$lstPropName = $row['TeamName']; 
    						?>
    						<option value="<?php echo $row['TeamName'];?>"><?php echo $row['TeamName'];?></option>

    						<?php
    							} 
    						?>
						</select>
					</td>
				</tr>
				<tr>
					<!-- <td>
						Enter 1st Speaker Name & Score:
					</td> -->
					<td>
						<select id="lstFirstPropName" name="lstFirstPropName">
							<option value="">Select Prime Minister Name</option>
							<?php
    							$sql = "SELECT DISTINCT MemberName from $TName";
    							$result = $conn->query($sql);
								while ($row = $result->fetch_assoc()) { 
    						?>
    						<option value="<?php echo $row['MemberName'];?>"><?php echo $row['MemberName'];?></option>

    						<?php
    							} 
    						?>						
						</select>
					</td>
					<td><input type="text" name="txtFirstPropScore" id="txtFirstPropScore"></td>
				</tr>
				<tr>
					<!-- <td>
						Enter 2nd Speaker Name & Score:
					</td> -->
					<td>
						<select id="lstSecondPropName" name="lstSecondPropName">
							<option value="">Select Deputy Prime Minister Name</option>
							<?php
    							$sql = "SELECT DISTINCT MemberName from $TName";
    							$result = $conn->query($sql);
								while ($row = $result->fetch_assoc()) { 
    						?>
    						<option value="<?php echo $row['MemberName'];?>"><?php echo $row['MemberName'];?></option>

    						<?php
    							} 
    						?>								
						</select>
					</td>
					<td><input type="text" name="txtSecondPropScore" id="txtSecondPropScore"></td>
				</tr>
				<tr>
					<!-- <td>
						Enter 3rd Speaker Name & Score:
					</td> -->
					<td>
						<select id="lstThirdPropName" name="lstThirdPropName">
							<option value="">Select Government Whip Name</option>
							<?php
    							$sql = "SELECT DISTINCT MemberName from $TName";
    							$result = $conn->query($sql);
								while ($row = $result->fetch_assoc()) { 
    						?>
    						<option value="<?php echo $row['MemberName'];?>"><?php echo $row['MemberName'];?></option>

    						<?php
    							} 
    						?>								
						</select>
					</td>
					<td><input type="text" name="txtThirdPropScore" id="txtThirdPropScore"></td>
				</tr>
				<tr>
					<td>
						Enter Reply Speech Score:
					</td>
					<td><input type="text" name="PropReplyScore" id="PropReplyScore"></td>
				</tr>
			</table>	
		</div>
		<div style="float: right; background-color: salmon; width: 50%">	
			<table>
				<tr>
					<td colspan="2">Opposition</td>				
				</tr>
				<tr>
					<!-- <td>
						Enter Team Name:
					</td> -->
					<td>
						<select id="lstOppName" name="lstOppName">
							<option value="">Select Team Name</option>
							<?php
    							$sql = "SELECT DISTINCT TeamName from $TName";
    							$result = $conn->query($sql);
								while ($row = $result->fetch_assoc()) { 
    						?>
    						<option value="<?php echo $row['TeamName'];?>"><?php echo $row['TeamName'];?></option>

    						<?php
    							} 
    						?>

						</select>
					</td>
				</tr>
				<tr>
					<!-- <td>
						Enter 1st Speaker Name & Score:
					</td> -->
					<td>
						<select id="lstFirstOppName" name="lstFirstOppName">
							<option value="">Select Opposition Leader Name</option>
							<?php
    							$sql = "SELECT DISTINCT MemberName from $TName";
    							$result = $conn->query($sql);
								while ($row = $result->fetch_assoc()) { 
    						?>
    						<option value="<?php echo $row['MemberName'];?>"><?php echo $row['MemberName'];?></option>

    						<?php
    							} 
    						?>								

						</select>
					</td>
					<td><input type="text" name="txtFirstOppScore" id="txtFirstOppScore"></td>
				</tr>
				<tr>
					<!-- <td>
						Enter 2nd Speaker Name & Score:
					</td> -->
					<td>
						<select id="lstSecondOppName" name="lstSecondOppName">
							<option value="">Select Deputy Opposition Leader Name</option>
							<?php
    							$sql = "SELECT DISTINCT MemberName from $TName";
    							$result = $conn->query($sql);
								while ($row = $result->fetch_assoc()) { 
    						?>
    						<option value="<?php echo $row['MemberName'];?>"><?php echo $row['MemberName'];?></option>

    						<?php
    							} 
    						?>								

						</select>
					</td>
					<td><input type="text" name="txtSecondOppScore" id="txtSecondOppScore"></td>
				</tr>
				<tr>
					<!-- <td>
						Enter 3rd Speaker Name & Score:
					</td> -->
					<td>
						<select id="lstThirdOppName" name="lstThirdOppName">
							<option value="">Select Opposition Whip Name</option>
							<?php
    							$sql = "SELECT DISTINCT MemberName from $TName";
    							$result = $conn->query($sql);
								while ($row = $result->fetch_assoc()) { 
    						?>
    						<option value="<?php echo $row['MemberName'];?>"><?php echo $row['MemberName'];?></option>

    						<?php
    							} 
    						?>								

						</select>
					</td>
					<td><input type="text" name="txtThirdOppScore" id="txtThirdOppScore"></td>
				</tr>
				<tr>
					<td>
						Enter Reply Speech Score:
					</td>
					<td><input type="text" name="OppReplyScore" id="OppReplyScore"></td>
				</tr>
			</table>
		</div>
		
		<div>
			<input type="submit" name="btnResults" id="btnResults" value="Submit Values" onclick="LetsGo()">
		</div>
	</div>
	<div style="float: right; background-color: violet;">
		<table>
			<tr>
				<td>Go to next round!</td>
				<td><input type="submit" name="btnNext" id="btnNext" value="Go to Next Round"></td>
			</tr>
		</table>
	</div>
</form>
</body>
</html>