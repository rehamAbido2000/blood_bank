<?php 
include "connect_db.php";
include "includes/functions/function.php";
if(isset($_POST["id"])){
    $citiess = all_city_by_gov($_POST["id"]);
    
    
    foreach($citiess as $city_data){
         ?>
        <option value="<?php echo $city_data['id'];?>"><?php echo $city_data["name"]; ?></option>
        <?php } 
}
?>