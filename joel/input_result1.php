<?php 
	
	require 'Database.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Resulate eingeben</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <form class="form-horizontal" action="input_result2.php" method="post">
<fieldset>

<!-- Form Name -->
<legend>Resulate eingeben</legend>

<!-- Select Competition -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Competition</label>
  <div class="col-md-4">
     <label class="label label-success" id="competitonName" >
     
     <?php
     
     $compID = 1; //Session ID
$pdo = Database::connect();
$sql = "SELECT comp_name, comp_ID FROM `tbl_competition` where comp_ID = $compID";
foreach ($pdo->query($sql) as $row):
echo $row["comp_name"];
endforeach;
?>
     </label>



  </div>
</div>


<!-- Select Division -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Division</label>
  <div class="col-md-4">
    <select id="divselectbasic" name="divselectbasic" class="form-control">

<?php
//$pdo = Database::connect();
$sql = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = $compID";

?>

<?php
foreach ($pdo->query($sql) as $row):
?>
    <option value="<?= $row["div_ID"] ?>"><?= $row["div_name"] ?></option>
<?php
endforeach;
?>
<?php
Database::disconnect();
?>

    </select>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btn_save"></label>
  <div class="col-md-4">
    <button id="btn_save" name="btn_save" class="btn btn-primary" >input score</button>
  </div>
</div>

</fieldset>
</form>


</body>
</html>
