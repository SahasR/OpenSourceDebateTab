<?php  
session_start();
$TName = $_SESSION["TName"];
//export.php  
$connect = mysqli_connect("localhost", "root", "", "dbtournament");
$output = '';
if(isset($_POST["export"]))
  {
   $query = "SELECT * FROM $TName";
   $result = mysqli_query($connect, $query);
   if(mysqli_num_rows($result) > 0) {
    $output .= '
     <table class="table" bordered="1">  
                      <tr>  
                          <th>MemberName</th>  
                           <th>TeamName</th>  
                           <th>SchoolName</th>  
                           <th>Novice</th>
                           <th>FoodPreference</th>
                           <th>ContactDetails</th>
                      </tr>
    ';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
          <tr>  
             <td>'.$row["MemberName"].'</td>  
             <td>'.$row["TeamName"].'</td>  
             <td>'.$row["SchoolName"].'</td>  
             <td>'.$row["Novice"].'</td>  
             <td>'.$row["FoodPreference"].'</td>
             <td>'.$row["ContactDetails"].'</td>
           </tr>  
     ';
    }
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=Database.xls');
    echo $output;
   }
  }
?>