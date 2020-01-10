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
$NumTeams = $_SESSION["NumTeams"];
$Checking = "false";
// echo "$NumTeams";
// echo "$TName";
// echo "$SeedNum";
// echo "$NumRounds";
// echo "$RoundNumber";
if (isset($_POST["btnResults"])) {
	echo "Hello!";
	$lstPropName = $_POST["lstPropName"];
	$lstFirstPropName = $_POST["lstFirstPropName"];
	$lstSecondPropName = $_POST["lstSecondPropName"];
	$lstThirdPropName = $_POST["lstThirdPropName"];
	$lstOppName = $_POST["lstOppName"];
	$lstFirstOppName = $_POST["lstFirstOppName"];
	$lstSecondOppName = $_POST["lstSecondOppName"];
	$lstThirdOppName = $_POST["lstThirdOppName"];
	echo "$lstPropName";

}

function Validation() {

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Results Page!</title>
</head>
<body>
	<div style="text-align: center;">
		<div style="float: left; background-color: cyan; width: 50%">

		<form method="POST">	
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
    						<option value="<?php echo $lstPropName;?>"><?php echo $lstPropName;?></option>

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
		</form>	
		</div>
		<div style="float: right; background-color: salmon; width: 50%">
			<form method="POST">	
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
		</form>	
		</div>
		<form method="POST">
		<div>
			<input type="submit" name="btnResults" id="btnResults" value="Submit Values">
		</div>
		</form>
	</div>
</body>
</html>