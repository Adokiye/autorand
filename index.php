<?php
require("connections.php");
$conn = conn();
// add referral option in menu
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
$sql = "SELECT * FROM `users` WHERE `phone_number`='$phoneNumber'";
$numbers = ['1','2','3','4','5','6'];
$result = selectSql($sql);
if(!$result){
$pieces = explode("*", $text);
if ($text == "") {    
    $response  = "CON Register: \n";
    $response .= "1. Patron(private vehicle) \n";
    $response .= "2. Commercial driver \n";
    $response .= "3. Fleet partner \n";  
    $response .= "4. Fleet manager \n";            
} else if ($text == "1") {
    $response = "CON Patron: \n";
    $response .= "1. Bike \n";
    $response .= "2. Keke \n";
    $response .= "3. Sedan \n";
    $response .= "4. SUV \n";
    $response .= "5. Bus \n";
    $response .= "6. Trucks \n";
} else if ($text == "2") {
    $response = "CON Enter first name \n";
} else if ($text == "3") {
    $response = "CON Enter first name \n";
} else if ($text == "4") {
    $response = "CON Enter first name \n";
} else if($text == "1*1") { 
    $response = "CON Enter first name \n";
} else if ( $text == "1*2" ) {
    $response = "CON Enter first name \n";
}else if ( $text == "1*3" ) {
    $response = "CON Enter first name \n";
}else if ( $text == "1*4" ) {
    $response = "CON Enter first name \n";
}else if ( $text == "1*5" ) {
    $response = "CON Enter first name \n";
}else if ( $text == "1*6" ) {
    $response = "CON Enter first name \n";
}else if($pieces[1] && !empty($pieces[1])&& in_array($pieces[1], $numbers)){
if($pieces[2] && !empty($pieces[2])){
    $response = "CON Enter last name \n";
}else if($pieces[3] && !empty($pieces[3]) && $pieces[2] && !empty($pieces[2])){
    $response = "CON Enter vehicle plate number \n";
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2])){
/*    $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`, `patron_id`)
                                                    VALUES ('$phoneNumber',
                                                    '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
                                                    '" . mysqli_real_escape_string($conn, $pieces[3]) . "',
                                                    '$pieces[0]',
                                                     '" . mysqli_real_escape_string($conn, $pieces[4]) . "',
                                                    '$pieces[1]',)";
                    $save_user = sqlInsert($sql);*/
    $response = "CON Please where you referred by anyone \n";
    $response .= "1. Yes \n";
    $response .= "2. No \n";
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3]) && $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '1'){
    $response = "CON Please enter the phone number of who referred you \n";
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '2'){
    $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`, `patron_id`)
                                                    VALUES ('$phoneNumber',
                                                    '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
                                                    '" . mysqli_real_escape_string($conn, $pieces[3]) . "',
                                                    '$pieces[0]',
                                                     '" . mysqli_real_escape_string($conn, $pieces[4]) . "',
                                                    '$pieces[1]',)";
                    $save_user = sqlInsert($sql);
    $response = "END Congratulations you\'ll be contacted soon";
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '1' && $pieces[6] && !empty($pieces[6])){
    $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`, `patron_id`)
                                                    VALUES ('$phoneNumber',
                                                    '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
                                                    '" . mysqli_real_escape_string($conn, $pieces[3]) . "',
                                                    '$pieces[0]',
                                                     '" . mysqli_real_escape_string($conn, $pieces[4]) . "',
                                                    '$pieces[1]',)";
                    $save_user = sqlInsert($sql);
    if($save_user){
    $sql2 = "INSERT INTO `referrals` (`user_id`, `phone_no`)
    VALUES ('$conn->insert_id',
    '" . mysqli_real_escape_string($conn, $pieces[6]) . "')";
    $save_user2 = sqlInsert($sql2);  
    $response = "END Congratulations you\'ll be contacted soon";     
    }else{
    $response = "END There was a problem while inserting your referral, please try again later";    
    }                
    
}
}else if($pieces[1] && !empty($pieces[1])&& !in_array($pieces[1], $numbers)){
    if($pieces[1] && !empty($pieces[1])){
        $response = "CON Enter last name \n";
    }else if($pieces[2] && !empty($pieces[2]) && $pieces[1] && !empty($pieces[1])){
        $response = "CON Enter vehicle plate number \n";
    }else if($pieces[3] && !empty($pieces[3]) && $pieces[2] && !empty($pieces[2])&& $pieces[1] && !empty($pieces[1])){
    /*    $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`)
                                                        VALUES ('$phoneNumber',
                                                        '" . mysqli_real_escape_string($conn, $pieces[1]) . "',
                                                        '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
                                                        '$pieces[0]',
                                                         '" . mysqli_real_escape_string($conn, $pieces[3]) . "',)";
                        $save_embassy = sqlInsert($sql);            */ 
    $response = "CON Please where you referred by anyone \n";
    $response .= "1. Yes \n";
    $response .= "2. No \n";
    }else if($pieces[4] && $pieces[4] == '1' && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2])){
    $response = "CON Please enter the phone number of who referred you \n";    
    }else if($pieces[4] && $pieces[4] == '2' && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2])){
        $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`)
        VALUES ('$phoneNumber',
        '" . mysqli_real_escape_string($conn, $pieces[1]) . "',
        '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
        '$pieces[0]',
         '" . mysqli_real_escape_string($conn, $pieces[3]) . "',)";
        $save_user = sqlInsert($sql);
        $response = "END Congratulations you\'ll be contacted soon";        
    }else if($pieces[4] && $pieces[4] == '2' && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2])
    && $pieces[5] && !empty($pieces[5])){
        $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`)
        VALUES ('$phoneNumber',
        '" . mysqli_real_escape_string($conn, $pieces[1]) . "',
        '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
        '$pieces[0]',
         '" . mysqli_real_escape_string($conn, $pieces[3]) . "',)";
        $save_user = sqlInsert($sql);
        if($save_user){
            $sql2 = "INSERT INTO `referrals` (`user_id`, `phone_no`)
            VALUES ('$conn->insert_id',
            '" . mysqli_real_escape_string($conn, $pieces[5]) . "')";
            $save_user2 = sqlInsert($sql2);  
            $response = "END Congratulations you\'ll be contacted soon";     
            }else{
            $response = "END There was a problem while inserting your referral, please try again later";    
            }        
    }
    }
}else{
    $pieces = explode("*", $text);
if($result['menu_id'] == 2){   
    if ($text == "") { 
    $response = "CON Enter city \n";    
    }else if($pieces[0] && !empty($pieces[0])){
    $response = "CON Enter Driving License Number \n";   
    }else if($pieces[0] && !empty($pieces[0]) && $pieces[1] && !empty($pieces[1])){
    $response  = "CON Choose vehicle plan \n";
    $response .= "1. Weekly rental \n";
    $response .= "2. Hire purchase \n";
    }else if($pieces[0] && !empty($pieces[0]) && $pieces[1] && !empty($pieces[1]) 
    && $pieces[2] && !empty($pieces[2])&& in_array($pieces[2], ['1','2'])){
        $response = "CON Patron: \n";
        $response .= "1. Bike \n";
        $response .= "2. Keke \n";
        $response .= "3. Painted taxi \n";
        $response .= "4. Non-painted taxi \n";
        $response .= "5. Bus \n";
        $response .= "6. Trucks \n";
    }else if($pieces[0] && !empty($pieces[0]) && $pieces[1] && !empty($pieces[1]) 
    && $pieces[2] && !empty($pieces[2])&& in_array($pieces[2], ['1','2']) && $pieces[3] && 
    !empty($pieces[3])&& in_array($pieces[3], ['1','2','3','4','5','6'])){
        $response .= "CON 1. Request vehicle \n";
        $response .= "2. Unpair from a vehicle \n";
    }else if($pieces[0] && !empty($pieces[0]) && $pieces[1] && !empty($pieces[1]) 
    && $pieces[2] && !empty($pieces[2])&& in_array($pieces[2], ['1','2']) && $pieces[3] && 
    !empty($pieces[3])&& in_array($pieces[3], ['1','2','3','4','5','6'])&&
    $pieces[4] && 
    !empty($pieces[4])&& in_array($pieces[4], ['1'])){
        $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($pieces[0] && !empty($pieces[0]) && $pieces[1] && !empty($pieces[1]) 
    && $pieces[2] && !empty($pieces[2])&& in_array($pieces[2], ['1','2']) && $pieces[3] && 
    !empty($pieces[3])&& in_array($pieces[3], ['1','2','3','4','5','6'])&&
    $pieces[4] && 
    !empty($pieces[4])&& in_array($pieces[4], ['2'])){
        $response .= "CON Enter vehicle plate number \n";
    }else if($pieces[0] && !empty($pieces[0]) && $pieces[1] && !empty($pieces[1]) 
    && $pieces[2] && !empty($pieces[2])&& in_array($pieces[2], ['1','2']) && $pieces[3] && 
    !empty($pieces[3])&& in_array($pieces[3], ['1','2','3','4','5','6'])&&
    $pieces[4] && 
    !empty($pieces[4])&& in_array($pieces[4], ['2'])&& $pieces[5] && !empty($pieces[5])){
        $response .= "CON Enter fleet manager's phone number \n";
    }else if($pieces[0] && !empty($pieces[0]) && $pieces[1] && !empty($pieces[1]) 
    && $pieces[2] && !empty($pieces[2])&& in_array($pieces[2], ['1','2']) && $pieces[3] && 
    !empty($pieces[3])&& in_array($pieces[3], ['1','2','3','4','5','6'])&&
    $pieces[4] && 
    !empty($pieces[4])&& in_array($pieces[4], ['2'])&& $pieces[5] && !empty($pieces[5])
    && $pieces[6] && !empty($pieces[6])){
        $response .= "END Congratulations! you will be contacted soon. \n";
    }
}else if($result['menu_id'] == 3){
    if ($text == "") { 
    $response .= "CON 1. New Fleet manager \n";
    $response .= "2. Add vehicle \n";
    $response .= "3. Change Fleet manager \n";
    $response .= "4. Inspect your vehicle \n";
    $response .= "5. Report issues \n";
    }else if ($text == "1") {
    $response = "CON Enter City \n";
    }else if($pieces[0] && $pieces[0] == '1'&& $pieces[1] && !empty($pieces[1])){
    $response .= "CON Type of vehicle \n";
    $response .= "1. Bike \n";
    $response .= "2. Keke \n";
    $response .= "3. Painted taxi \n";
    $response .= "4. Non-painted taxi \n";
    $response .= "5. Bus \n";
    $response .= "6. Trucks \n";
    }else if($pieces[0] && $pieces[0] == '1' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && in_array($pieces[2], ['1','2','3','4','5','6'])){
    $response .= "CON Payment Plan \n";
    $response .= "1. Weekly rental \n";
    $response .= "2. Hire purchase \n";
    }else if($pieces[0] && $pieces[0] == '1' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && in_array($pieces[2], ['1','2','3','4','5','6'])
    && $pieces[3] && in_array($pieces[3], ['1','2'])){
    $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == "2"){
    $response = "CON Enter plate number \n";
    }else if($pieces[0] && $pieces[0] == '2'&& $pieces[1] && !empty($pieces[1])){
    $response .= "CON Type of vehicle \n";
    $response .= "1. Bike \n";
    $response .= "2. Keke \n";
    $response .= "3. Painted taxi \n";
    $response .= "4. Non-painted taxi \n";
    $response .= "5. Bus \n";
    $response .= "6. Trucks \n";
    }else if($pieces[0] && $pieces[0] == '2' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && in_array($pieces[2], ['1','2','3','4','5','6'])){
    $response = "CON Enter City \n";    
    }else if($pieces[0] && $pieces[0] == '2' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && in_array($pieces[2], ['1','2','3','4','5','6'])&& 
    $pieces[3] && !empty($pieces[3])){
    $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == 3){
    $response = "CON Enter City \n";     
    }else if($pieces[0] && $pieces[0] == '3'&& $pieces[1] && !empty($pieces[1])){
    $response = "CON Enter former fleet manager's phone number \n";
    }else if($pieces[0] && $pieces[0] == '3'&& $pieces[1] && !empty($pieces[1])
    && $pieces[2] && !empty($pieces[2])){
    $response = "CON Enter plate number \n";
    }else if($pieces[0] && $pieces[0] == '3'&& $pieces[1] && !empty($pieces[1])
    && $pieces[2] && !empty($pieces[2]) && $pieces[3] && !empty($pieces[3])){
    $response .= "CON Type of vehicle \n";
    $response .= "1. Bike \n";
    $response .= "2. Keke \n";
    $response .= "3. Painted taxi \n";
    $response .= "4. Non-painted taxi \n";
    $response .= "5. Bus \n";
    $response .= "6. Trucks \n";
    }else if($pieces[0] && $pieces[0] == '3'&& $pieces[1] && !empty($pieces[1])
    && $pieces[2] && !empty($pieces[2]) && $pieces[3] && !empty($pieces[3])
    && $pieces[4] && in_array($pieces[4], ['1','2','3','4','5','6'])){
    $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == '4'){
    $response .= "CON Inspect your vehicle \n";
    $response .= "1. Within 24 hours \n";
    $response .= "2. Within 48 hours \n";
    $response .= "3. Within 72 hours \n";
    $response .= "4. Recall vehicle \n";
    }else if($pieces[0] && $pieces[0] == '4' && $pieces[1] && in_array($pieces[1],['1','2','3','4'])){
    $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == '5'){
    $response .= "CON Enter your report \n";    
    }else if($pieces[0] && $pieces[0] == '5'&& $pieces[1] && !empty($pieces[1])){
    $response .= "END Congratulations! you will be contacted soon. \n";
    }
}else if($result['menu_id'] == 4){
    if($text == ""){
        $response .= "CON 1. Add new vehicle \n";
        $response .= "2. Add new driver \n";
        $response .= "3. Remove vehicle \n";
        $response .= "4. Remove driver \n";
        $response .= "5. Confirm driver payments \n";
        $response .= "6. Report issues \n";    
    }else if($text == '1'){
        $response .= "CON Enter Plate number \n";
    }else if($pieces[0] && $pieces[0]==1 && $pieces[1] && !empty($pieces[1])){
        $response .= "CON Enter City \n";
    }else if($pieces[0] && $pieces[0]=='1' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && !empty($pieces[2])){
        $response .= "CON Type of vehicle \n";
        $response .= "1. Bike \n";
        $response .= "2. Keke \n";
        $response .= "3. Painted taxi \n";
        $response .= "4. Non-painted taxi \n";
        $response .= "5. Bus \n";
        $response .= "6. Trucks \n";
    }else if($pieces[0] && $pieces[0] == '1' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && !empty($pieces[2]) && $pieces[3] && in_array($pieces[3], ['1','2','3','4','5','6'])){
    $response .= "CON Payment Plan \n";
    $response .= "1. Weekly rental \n";
    $response .= "2. Hire purchase \n";
    }else if($pieces[0] && $pieces[0] == '1' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && !empty($pieces[2]) && $pieces[3] && in_array($pieces[3], ['1','2','3','4','5','6'])
    && $pieces[4] && in_array($pieces[4], ['1','2'])){
    $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == '2'){
        $response .= "CON Enter City \n";
    }else if($pieces[0] && $pieces[0]== '2' && $pieces[1] && !empty($pieces[1])){
        $response .= "CON Type of vehicle \n";
        $response .= "1. Bike \n";
        $response .= "2. Keke \n";
        $response .= "3. Painted taxi \n";
        $response .= "4. Non-painted taxi \n";
        $response .= "5. Bus \n";
        $response .= "6. Trucks \n";
    }else if($pieces[0] && $pieces[0]== '2' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && in_array($pieces[2], ['1','2','3','4','5','6'])){
        $response .= "CON Payment Plan \n";
        $response .= "1. Weekly rental \n";
        $response .= "2. Hire purchase \n";
    }else if($pieces[0] && $pieces[0]== '2' && $pieces[1] && !empty($pieces[1])
    && $pieces[2] && in_array($pieces[2], ['1','2','3','4','5','6'])
    && $pieces[3] && in_array($pieces[3], ['1','2'])){
        $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == '3'){
        $response = "CON Enter vehicle plate number \n";
    }else if($pieces[0] && $pieces[0]=='3'&& $pieces[1] && !empty($pieces[1])){
        $response .= "CON Reasons for removal \n";
        $response .= "1. Maintenace issues \n";
        $response .= "2. Manager/partner conflicts \n";
        $response .= "3. Low ROI \n";
        $response .= "4. None \n";
    }else if($pieces[0] && $pieces[0]=='3'&& $pieces[1] && !empty($pieces[1])
    && $pieces[2] && in_array($pieces[2], ['1','2','3','4'])){
        $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == '4'){
        $response .= "CON Enter Driver Phone number \n";
    }else if($pieces[0] && $pieces[0]=='4'&& $pieces[1] && !empty($pieces[1])){
        $response .= "CON Reasons for removal \n";
        $response .= "1. Manager/driver conflicts \n";
        $response .= "2. Non Compliance \n";
        $response .= "3. Repair/maintenance issues \n";
        $response .= "4. None \n";
    }else if($pieces[0] && $pieces[0]=='4'&& $pieces[1] && !empty($pieces[1])
    && $pieces[2] && in_array($pieces[2], ['1','2','3','4'])){
        $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == '5'){
        $response .= "CON Enter Driver Phone number \n";
    }else if($pieces[0] && $pieces[0]=='5'&& $pieces[1] && !empty($pieces[1])){
        $response = "CON Enter vehicle plate number \n";
    }else if($pieces[0] && $pieces[0]=='5'&& $pieces[1] && !empty($pieces[1])
    && $pieces[2] && !empty($pieces[2])){
        $response .= "END Congratulations! you will be contacted soon. \n";
    }else if($text == '6'){
        $response = "CON Enter your report \n";
    }else if($pieces[0] && $pieces[0]=='6'&& $pieces[1] && !empty($pieces[1])){
        $response .= "END Congratulations! you will be contacted soon. \n";
    }
}
}
header('Content-type: text/plain');
echo $response;