<?php  
session_start();
$TName = $_SESSION["TName"];
//export.php  
$connect = mysqli_connect("localhost", "root", "password", "dbtournament");
$output = '';

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
  
    if (isset($_POST["btnGo"])) {
      header("Location:PersonalJob_Speaks");
    }
?>