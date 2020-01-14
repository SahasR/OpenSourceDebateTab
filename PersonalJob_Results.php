<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
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
		// echo "Hello!";
		// echo "$RoundName";
		// echo "$txtFirstPropScore";
		// echo "$lstFirstPropName";
		$sql = "UPDATE speaks SET $RoundName=$txtFirstPropScore where MemberName='$lstFirstPropName'";
  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtSecondPropScore where MemberName='$lstSecondPropName'";
  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtThirdPropScore where MemberName='$lstThirdPropName'";
  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtFirstOppScore where MemberName='$lstFirstOppName'";
  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtSecondOppScore where MemberName='$lstSecondOppName'";
  		$result = $conn->query($sql);

		$sql = "UPDATE speaks SET $RoundName=$txtThirdOppScore where MemberName='$lstThirdOppName'";
  		$result = $conn->query($sql);

  		$PropTotalSpeaks = $txtFirstPropScore + $txtSecondPropScore + $txtThirdPropScore + $PropReplyScore;
  		$OppTotalSpeaks = $txtFirstOppScore + $txtSecondOppScore + $txtThirdOppScore + $OppReplyScore;

  		$sql = "SELECT TotalScore FROM wins WHERE TeamName = '$lstPropName'";
  		$result = $conn->query($sql);
  		while($row = $result->fetch_assoc()) {
  			$Score = $row["TotalScore"];
  		}
  		$Score = $Score + $PropTotalSpeaks;
  		$sql = "UPDATE wins SET TotalScore = $Score WHERE TeamName = '$lstPropName'";
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
	}

}

function Validation() {

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Results Page!</title>
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
							<option value=" ">Select Team Name</option>
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
							<option value=" ">Select Prime Minister Name</option>
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
							<option value=" ">Select Deputy Prime Minister Name</option>
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
							<option value=" ">Select Government Whip Name</option>
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
							<option value=" ">Select Team Name</option>
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
							<option value=" ">Select Opposition Leader Name</option>
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
							<option value=" ">Select Deputy Opposition Leader Name</option>
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
							<option value=" ">Select Opposition Whip Name</option>
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
</form>
</body>
</html>