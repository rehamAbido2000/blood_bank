<?php 
include "connect_db.php";
include "includes/functions/function.php";
if(isset($_POST["gov_id"])){
$cities = all_city_by_gov($_POST["gov_id"]);
foreach($cities as $cities_data){ ?>
    <option value="<?php echo $cities_data['id'];?>"><?php echo $cities_data["name"]; ?></option>
    <?php } 
}elseif(isset($_POST["city_id"])){
    $places = all_places_by_city($_POST["city_id"]);
        foreach($places as $places_data){ ?>
            <option value="<?php echo $places_data['id'];?>"><?php echo $places_data["place_name"]; ?></option>
            <?php } 
    }
?>