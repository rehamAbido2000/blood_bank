<?php    
ob_start();
session_start();   
$style="updateMember.css";
$page_name = " - جميع طلبات اللقاحات";
include "init.php";

$blood_data = buy_blood(3009072355125,5,2,280);

// foreach ($blood_data as $buying_data){
//     echo "place_id = " . @$buying_data["place_id"] . " ; " . "blood_id = " . @$buying_data["blod_type_id"] . " ; " . "Amount avilable = " . @$buying_data["amount"] . "<br>";
// }
// if($blood_data["place_id"] == 2){
//     echo "true";
// }else{
//     echo "false";
// }

if(isset($blood_data) && gettype($blood_data) == "array"){?>
    <select class="w-100 ui search dropdown">
        <option value="">State</option>
        <?php foreach ($blood_data as $daata){ $place_name = get_all_donate_places_info_with_place_id($daata["place_id"]); ?>
        <option value="AL"><?php echo $place_name["governorate_name"] . " - " . $place_name["city_name"] . " - " . $place_name["place_name"]; ?></option>
        <?php } ?>
    </select>

<?php }else{
    if(gettype($blood_data) != "boolean"){
        echo "sorry blood not found";
    }
}
?>

<?php
require_once "./includes/template/footer.php";

ob_end_flush();