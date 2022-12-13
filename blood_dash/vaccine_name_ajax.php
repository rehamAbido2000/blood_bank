<?php 
include "connect_db.php";
include "includes/functions/function.php";
if(isset($_POST["vac_id"])){
$vaccines = all_vaccines_by_id($_POST["vac_id"]);
foreach($vaccines as $vac_data){ ?>
    <option value="<?php echo $vac_data['id'];?>"><?php echo $vac_data["scientific_name"]; ?></option>
    <?php } 
}
?>