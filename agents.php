<?php
use AfricasTalking\SDK\AfricasTalking;
$username = "sandbox";
$apikey   = "ff4bd028356602b0aff181d10bdf8889c926052df21f52e35da1bc5007cace1c";
$AT       = new AfricasTalking($username, $apiKey);
require("connections.php");
$conn = conn();
$bool = '';
// add referral option in menu
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
/*$sql = "SELECT * FROM `users` WHERE `phone_number`='$phoneNumber'";
$result = selectSql($sql);*/
$pieces = explode("*", $text);
if ($text == "") {    
    $response  = "CON Select State: \n";
    $response .= "1. Abia \n";
    $response .= "2. Adamawa \n";
    $response .= "3. Gombe \n";  
    $response .= "4. Lagos \n";            
} else if ($text == "1") {
    $response = "CON Select LGA: \n";
    $response .= "1. Alimosho \n";
    $response .= "2. Lekki \n";
    $response .= "3. Abaranje \n";
} else if ($text == "1*1") {
    $response = "CON Select Filling station \n";
    $response .= "1. Timothy Filling station \n";
    $response .= "2. Arthur Filling station \n";
    $response .= "3. A/B Filling station \n";
}else if($text == "1*1*1"){
    $response = "CON Select Avalaibility \n";
    $response .= "1. Available \n";
    $response .= "2. Not Available \n";
}else if($text == "1*1*1*1" || $text == "1*1*1*2"){
    if($pieces[3] == '1'){
    $bool = true;
    }else if($pieces[3] == '2'){
    $bool = false;    
    }
    $sql_select = "SELECT * FROM `filling_stations` WHERE `ussd_id`='$pieces[2]' 
    AND `state_id`='$pieces[0]' AND `zone_id`='$pieces[1]'";
    $sql_result = selectSql($sql_select);
    $sql_update                = "UPDATE `filling_stations`
                                        SET `availability` = $bool
                                        WHERE `id` = ".$sql_result['id'];
                                        $update_status      = selectSql($sql_update);
    $response = "END Thank you, your data has been saved \n";
}