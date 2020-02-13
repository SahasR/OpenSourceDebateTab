<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "dbtournament";

$TName = $_SESSION["TName"];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
};

if (isset($_POST["btnRename"])) {
	$Name = $_POST["txtName"];
	$NewName = $_POST["txtNewName"];
	$sql = "UPDATE $TName SET MemberName='$NewName' WHERE MemberName='$Name';";
	// echo "$sql";
	$result = $conn->query($sql);
}

if (isset($_POST["btnAddDebator"])) {
	$Name = $_POST["txtNewDebator"];
	$TeamName = $_POST["txtTeamName"];
	$School = $_POST["txtSchoolName"];
	$sql = "INSERT INTO $TName (MemberName, TeamName, SchoolName) VALUES ('$Name','$TeamName','$School');";
	$result = $conn->query($sql);
}

if (isset($_POST["btnRemoveDebator"])) {
	$Name = $_POST["txtRemoveDebator"];
	$sql = "DELETE FROM $TName WHERE MemberName='$Name'";
	$result = $conn->query($sql);
}

if (isset($_POST["btnDropTeam"])) {
	$TeamName = $_POST["txtDropTeamName"];
	$sql = "DELETE FROM $TName WHERE TeamName='$TeamName'";
	$result = $conn->query($sql);
	$sql = "DELETE FROM wins WHERE TeamName='$TeamName'";
	$result = $conn->query($sql);
}

if (isset($_POST["btnSwingTeam"])) {
	$sql = "INSERT INTO $TName (TeamName) VALUES ('Swing Team');";
	$result = $conn->query($sql);
}

if (isset($_POST["btnDropRound"])) {
	$sql = "SELECT * FROM savedata";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
	$NumRounds = $row['NumRounds'];	
	}
	$NumRounds = $NumRounds-1;
	$sql = "UPDATE savedata SET NumRounds='$NumRounds' WHERE TournamentName='$TName';";
	$result = $conn->query($sql);
}

  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Page!</title>
</head>
<body>
	<form method="POST">
		<table>
			<tr>
				<td>
					Replace Name:
				</td>
				<td>
					<input type="text" name="txtName" id="txtName">
				</td>
				<td>
					With:
				</td>
				<td>
					<input type="text" name="txtNewName" id="txtNewName">
				</td>
				<td>
					<input type="submit" name="btnRename" id="btnRename" value="Rename">
				</td>
			</tr>
			<tr>
				<td>
					Add a Debator to a Team:
				</td>
				<td>
					<input type="text" name="txtNewDebator" id="txtNewDebator">
				</td>
				<td>
					Team Name:
				</td>
				<td>
					<input type="text" name="txtTeamName" id="txtTeamName">
				</td>
				<td>
					School Name:
				</td>
				<td>
					<input type="text" name="txtSchoolName" id="txtSchoolName">
				</td>
				<td>
					<input type="submit" name="btnAddDebator" id="btnAddDebator" value="Add Debator">
				</td>
			</tr>
				<td>
					Remove a Debator to a Team:
				</td>
				<td>
					<input type="text" name="txtRemoveDebator" id="txtRemoveDebator">
				</td>
				<td>
					<input type="submit" name="btnRemoveDebator" id="btnRemoveDebator" value="Remove Debator">
				</td>
			</tr>
			<tr>
				<td>
					Drop a Team:
				</td>
				<td>
					<input type="text" name="txtDropTeamName" id="txtDropTeamName">
				</td>
				<td>
					<input type="submit" name="btnDropTeam" id="btnDropTeam" value="Drop Team">
				</td>
			</tr>
			<tr>
				<td>
					Add a Swing Team:
				</td>
				<td>
					<input type="submit" name="btnSwingTeam" id="btnSwingTeam" value="AddASwing">
				</td>
			</tr>
			<tr>
				<td>
					Drop a Round:
				</td>
				<td>
					<input type="submit" name="btnDropRound" id="btnDropRound" value="Drop A Round">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>