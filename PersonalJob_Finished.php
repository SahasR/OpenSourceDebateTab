<?php  
session_start();
$TName = $_SESSION["TName"];
//export.php  
$connect = mysqli_connect("localhost", "root", "password", "dbtournament");
$sql = "SELECT * FROM savedata";
$result = mysqli_query($connect, $sql);
  while($row = mysqli_fetch_array($result)) {
    $NumRounds = $row['NumRounds']*1;
    // echo "$NumRounds";
}
$sql = "SELECT * FROM speaks";
$result = mysqli_query($connect, $sql);
// echo "$result";

while ($row = mysqli_fetch_array($result)) {
	$Total = $row['Total']*1;
	$MemberName = $row['MemberName'];
  $Count = $row['Count'];
  $Mid = $NumRounds /2;
  if ($Count > $Mid) {
    $Average = $Total/$Count;
    $query = "UPDATE speaks SET Average = '$Average' WHERE MemberName = '$MemberName';";
    // echo "$query";
    $res = mysqli_query($connect, $query);
  }
	
}
$output = '';

   if (isset($_POST["btnGo1"])) {
     $query = "SELECT * FROM wins ORDER BY Wins DESC, Margins DESC, TotalScore DESC";
    $result = mysqli_query($connect, $query);
   if(mysqli_num_rows($result) > 0) {
    $output .= '
     <table class="table" bordered="1">  
                      <tr> 
                           <th>Position</th>   
                           <th>TeamName</th>  
                           <th>Wins</th>  
                           <th>Margins</th>
                           <th>TotalScore</th>
                      </tr>
    ';
    $i = 0;
    while($row = mysqli_fetch_array($result))
    {
      $i = $i +1;
     $output .= '
          <tr>  
             <td>'.($i).'</td>
             <td>'.$row["TeamName"].'</td>  
             <td>'.$row["Wins"].'</td>  
             <td>'.$row["Margins"].'</td>  
             <td>'.$row["TotalScore"].'</td>  
           </tr>  
     ';
    }
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=Breaks.xls');
    echo $output;
   }
   }
  
    if (isset($_POST["btnGo1"])) {
        $query = "SELECT * FROM speaks ORDER BY Average DESC";
    $result = mysqli_query($connect, $query);
    $output = '';
   if(mysqli_num_rows($result) > 0) {
    $output .= '
     <table class="table" bordered="1">  
                      <tr> 
                           <th>Position</th>
                           <th>MemberName<th>   
                           <th>TeamName</th>  
                           <th>SchoolName</th>
                           <th>Count<th>';  
  
    for ($i=1; $i <= $NumRounds ; $i++) { 
      $output .= '<th>Round'.strval($i).'</th>';
    }
    $output .= '<th>Average</th>';
    $output .= '</tr>';
    $Pos = 0;
    while($row = mysqli_fetch_array($result))
    { 
      $Pos = $Pos + 1;
     $output .= '
          <tr>  
             <td>'.($Pos).'</td>
             <td>'.$row["MemberName"].'</td> 
             <td>'.$row["TeamName"].'</td>  
             <td>'.$row["SchoolName"].'</td>
             <td>'.$row["Count"].'</td>'; 
             for ($i=1; $i <= $NumRounds ; $i++) { 
                $X = "Round".strval($i);
                $output .= '<td>'.$row["$X"].'</td>';
                }
                // $output .= '<td><td>';
                $output .= '<td>'.$row["Average"].'</td>';
                $output .= '</tr>';
    }
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=Speaks.xls');
    echo $output;
   }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Completed!</title>
</head>
<body>
  <form method="POST"><input type="submit" name="btnGo1" id="btnGo1" value="Get Breaks!"></form>
</body>
</html>