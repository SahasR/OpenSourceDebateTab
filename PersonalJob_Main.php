<?php

session_start();
$connect = mysqli_connect("localhost", "root", "", "dbtournament");
$TName = $_SESSION["TName"];
$sql = "SELECT * FROM";  
$result = mysqli_query($connect, $sql);
?>
<html>  
 <head>  
  <title>Export MySQL to Excel</title>  
 </head>  
 <body>  
  <div class="container">  
   <br />  
   <br />  
   <br />  
   <div class="table-responsive">  
    <h2 align="center">All Debaters of <?php echo "$TName";?></h2><br /> 
    <table class="table table-bordered" style="border-style: 1;">
     <tr>  
                         <th>MemberName</th>  
                         <th>TeamName</th>  
                         <th>SchoolName</th>  
                        <th>Novice</th>
                        <th>FoodPreference</th>
                        <th>ContactDetails</th>
      </tr>
     <?php
     while($row = mysqli_fetch_array($result))  
     {  
        echo '  
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
     ?>
    </table>
    <br />
    <form method="post" action="PersonalJob_Export.php">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
   </div>  
  </div>  
 </body>  
</html>