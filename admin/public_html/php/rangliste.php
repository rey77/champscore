<!DOCTYPE html>
<html lang="en">
<head>
  <title>Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    
     <div class="container">
        
         <?php

           include 'Database.php';
       
        $pdo = Database::connect();
        
          $compID = 1;
          $sql = "SELECT `comp_name` FROM `tbl_competition` where comp_id = $compID";
        
        foreach ($pdo->query($sql) as $row) {
        echo "<h2>Results: ".$row['comp_name']."</h2>";
        }
        
          
          ?>

  
    <form class="form-horizontal" action="rangliste.php" method="post"> 
   <table class="table table-hover">
      <tr>
         <?php
         
          

        $sql = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = $compID";
        
        foreach ($pdo->query($sql) as $row) {
        echo 
            
           "<th><button type='submit' value='".$row['div_ID']."' id='".$row['div_ID']."' name='divselectbasic' class='btn btn-primary'>".$row['div_name']."  </button>  </th> ";
      
        
    
	}
        
        ?>
        
      </tr>
   </table>
  </form>
    
 </div>       

 <?php if (isset($_POST['divselectbasic'])||isset($_POST['wod_button']))
             {
       ?>
    
<div class="container">

  <form class="form-horizontal" action="rangliste.php" method="post"> 
   <table class="table table-hover">
      <tr>
          
          
         <?php
         
         
      
        $wod_array = array();
        $wod_count = 1;
        
        if (isset($_POST['wod_button']))
             {
                      $dataString = $_POST['wod_button'];
                      list ($divison, $selected_wod) = explode('X', $dataString);
                     
             }
             else{
                   $divison = $_POST['divselectbasic'];
             }
             
        echo "<th><button type='submit' value='".$divison."Xoverall123' id='overall' name='wod_button' class='btn btn-primary'>overall</button>  </th> ";
      
      
  //      include 'Database.php';
  //      $pdo = Database::connect();
        $sql = "SELECT evt_ID, wod_ID, wod_name, evt_name FROM `tbl_wod` join tbl_event on fk_evt_ID = evt_ID WHERE `fk_div_ID` = $divison";
        foreach ($pdo->query($sql) as $row) {
        echo 
            
           "<th><button type='submit' value='".$divison."X".$row['wod_ID']."' id='".$row['wod_ID']."' name='wod_button' class='btn btn-primary'>".$row['evt_name']." <br/> ".$row['wod_name']." </button>  </th> ";
      
        
        $wod_array[$wod_count] = $row['wod_ID'];
        
        $wod_count++;
  

	  
	}
        
        ?>
        
      </tr>
   </table>
  </form>
<?php

 

        if (isset($_POST['wod_button']))
             {
             
        
       if ($selected_wod == "overall123"){
           
             echo "<p>Overall Ranking </p>";
           
       }
       else{
          
               $sql=  "SELECT wod_name AS WOD, wod_desc AS Description from tbl_wod where wod_ID =".$selected_wod;
        
      foreach ($pdo->query($sql) as $row) {
        echo "<p>". $row['Description']."</p>";
      }
        
       }

  
  ?>
          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Box</th>
        <th>Points</th>
      </tr>
    </thead>
	<tbody>

	
<?php


  if ($selected_wod == "overall123"){ 
      
$sql = "SELECT u.user_name as Name, u.user_box as Box, SUM(r.res_score) as Punkte FROM tbl_user u inner \n"
    . " join tbl_user_division d\n"
    . " on u.user_ID = d.fk_user_ID inner \n"
    . " join tbl_result r on d.user_div_ID = r.fk_user_div_ID \n"
    . " WHERE d.fk_div_ID = ".$divison." GROUP by Name ORDER by Punkte ASC";
        

$rang = 1;
foreach ($pdo->query($sql) as $row) {
   echo "
      <tr>
        <td>". $rang.". ".$row['Name']."</td>
        <td> ".$row['Box']." </td>
        <td> ".$row['Punkte']." </td>
      </tr>";
  
    $rang++;
	  
	}
      
  }
  
  else{
      
  
  
$sql = "SELECT u.user_name as Name, u.user_box as Box, r.res_score as Punkte FROM tbl_user u inner join tbl_user_division d \n"
    . "on u.user_ID = d.fk_user_ID inner join tbl_result r on d.user_div_ID = r.fk_user_div_ID where r.fk_wod_ID =".$selected_wod." ORDER BY Punkte ASC";
	
$rang = 1;
foreach ($pdo->query($sql) as $row) {
   echo "
      <tr>
        <td>".$rang.". ".$row['Name']."</td>
        <td> ".$row['Box']." </td>
        <td> ".$row['Punkte']." </td>
      </tr>";
  
$rang++;
	  
	}
        
  }     

Database::disconnect();
?>

    </tbody>
  </table>

  <form  action="rangliste_pdf.php" method="post">  

      <button type="submit" value="<?php echo $selected_wod."X".$divison ?>" id="btn_pdf" name="btn_pdf" class="btn btn-primary">PDF Export</button>

</form > 

 <form  action="judges_pdf.php" method="post">  

      <button type="submit" value="<?php echo $selected_wod."X".$divison ?>" id="judges_pdf" name="judges_pdf" class="btn btn-primary">PDF Judges</button>


</form > 

<?php

}
?>
</div>

             <?php 
             
}
       ?>   
</body>
</html>
