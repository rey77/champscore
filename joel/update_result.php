<?php 
var_dump($_POST);

  include 'Database.php';
  $pdo = Database::connect();
       
$count_res = count($_POST) - 1;
$count = 1;
$valid = true;

foreach($_POST as $key => $value)
{
  $mykey = $key;
  $dataString = $value . "X". $mykey."<br/>";
  
  
  list ($res_score, $res_ID, $user_div_ID, $wod_ID) = split('[X]', $dataString);

//  echo "res_score ". $res_score;
//  echo "res_ID ". $res_ID;
//  echo "user_DivID ". $user_div_ID;
//  echo "wod_ID ". $wod_ID;
  
  
  if ($valid && $res_ID == 0)
  {
      $sql = "INSERT INTO `champscore_net`.`tbl_result` (`fk_wod_ID`, `fk_user_div_ID`, `res_score`) "
              . "VALUES (?,?,?)";
      
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $q = $pdo->prepare($sql);
	 $q->execute(array($wod_ID,$user_div_ID,$res_score)); 
      
  }
  
  if ($valid && $res_ID != 0)
  {
      $pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "UPDATE `champscore_net`.`tbl_result` SET `res_score` = ? WHERE `tbl_result`.`res_id` = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($res_score,$res_ID));
                        
  }
  
  
  if ($count == $count_res)
  {
      break;
 
  }
  
    $count++;
  
  
}


Database::disconnect();

header("Location:rangliste.php");


?>

