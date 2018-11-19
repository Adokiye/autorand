<?php
// 8 zeros(9)
use AfricasTalking\SDK\AfricasTalking;
$username = "sandbox";
$apikey   = "ff4bd028356602b0aff181d10bdf8889c926052df21f52e35da1bc5007cace1c";
$AT       = new AfricasTalking($username, $apiKey);
$payments   = $AT->payments();
$bank_code = '';
$totality = false;
$skylark = false;
function BankValidate($otp, $transactionId) {
    try {
        $result = $payments->bankCheckoutValidate([
            "transactionId" => $transactionId,
            "otp"           => $otp
        ]);
        return $result;
    } catch (Exception $e) {
        echo "Error: ".$e.getMessage();
    }
}
function BankCheckout($accountName, $accountNumber, $bankCode, $dateOfBirth) {
    $productName = "Registration";
    $bankAccount = [
        "accountName"   => $accountName,
        "accountNumber" => $accountNumber,
        "bankCode"      => $bankCode,
        "dateOfBirth"   => $dateOfBirth 
    ];
    $currencyCode       = "NGN";
    $amount             = 200;
    $narration          = "Registration charge";
    $metadata = [
        "agentId"   => "555",
        "productId" => "1111"
    ];
    try {
        $result = $payments->bankCheckoutCharge([
            "productName"  => $productName,
            "bankAccount"  => $bankAccount,
            "currencyCode" => $currencyCode,
            "amount"       => $amount,
            "narration"    => $narration,
            "metadata"     => $metadata
        ]);
        return $result;
    } catch(Exception $e) {
        echo "Error: ".$e.getMessage();
    }
}
require("connections.php");
$conn = conn();
// add referral option in menu
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
$sql = "SELECT * FROM `users` WHERE `phone_number`='$phoneNumber'";
$numbers = ['1','2','3','4','5','6'];
//$result = selectSql($sql);
$result = false;
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
    $response = "CON You\'ll be charged 200 naira from your bank account for you to be fully registered, 
    this amount will be included in your wallet, you\'ll be required to input your bank account number 
    and bank account name, then an OTP will be sent to you, which you will input in the required space 
    when you\'re asked to, proceed? \n";
    $response .= "1. Yes \n";
    $response .= "2. No \n";
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '2' && $pieces[6] && in_array($pieces[6], ['1', '2'])){
    if($pieces[6] == '2'){
    $response = "END Thank you for your time";    
    }else{
    $response = "CON Please select your bank \n";
    $response .= "1. FCMB Nigeria \n";
    $response .= "2. Zenith Nigeria \n";
    $response .= "3. Access Nigeria \n";
    $response .= "4. Providus Nigeria \n";
    $response .= "5. Sterling Nigeria \n";
    $response .= "6. None of the above \n";   
    /*
    FCMB Nigeria
    234001
    Zenith Nigeria
    234002
    Access Nigeria
    234003
    Providus Nigeria
    234007
    Sterling Nigeria
    234010   
    */ 
    }   
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '2' && $pieces[6] && in_array($pieces[6], ['1']) && $pieces[7] && 
in_array($pieces[7], ['1','2','3','4','5'])){
    if($pieces[7] == '1'){
        $bank_code = 234001;
    }else if($pieces[7] == '2'){
        $bank_code = 234002;
    }else if($pieces[7] == '3'){
        $bank_code = 234003;
    }else if($pieces[7] == '4'){
        $bank_code = 234007;
    }else if($pieces[7] == '5'){
        $bank_code = 234010;
    }
    $response = "CON Please enter your bank account name \n";      
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '2' && $pieces[6] && in_array($pieces[6], ['1']) && $pieces[7] && 
in_array($pieces[7], ['1','2','3','4','5']) && $pieces[8] && !empty($pieces[8])){
    $response = "CON Please enter your bank account number \n";      
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '2' && $pieces[6] && in_array($pieces[6], ['1']) && $pieces[7] && 
in_array($pieces[7], ['1','2','3','4','5']) && $pieces[8] && !empty($pieces[8]) && $pieces[9] && !empty($pieces[9])){
    $response = "CON Please enter your date of birth \n";      
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '2' && $pieces[6] && in_array($pieces[6], ['1']) && $pieces[7] && 
in_array($pieces[7], ['1','2','3','4','5']) && $pieces[8] && !empty($pieces[8]) && $pieces[9] && !empty($pieces[9])
&& $pieces[10] && !empty($pieces[10])){
    $result = BankCheckout($pieces[8],$pieces[9],$bank_code, $pieces[10]);
    if($result->status == 'PendingValidation'){
    $totality == true;    
    $response = "CON Please enter the OTP sent to you \n";    
    }else{
    $response = "END".$response->description;    
    }         
}else if( $totality && $pieces[11] && !empty($pieces[11])){
    $result_v = BankValidate($pieces[11], $result->transactionId);
    if($result_v->status == 'Success'){
        $skylark = true;
        $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`, 
        `patron_id`, `paid`)
        VALUES ('$phoneNumber',
        '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
        '" . mysqli_real_escape_string($conn, $pieces[3]) . "',
        '$pieces[0]',
         '" . mysqli_real_escape_string($conn, $pieces[4]) . "',
        '$pieces[1]', true)";
$save_user = sqlInsert($sql);    
    $response = "END Congratulations you\'ve successfully registered";   
    }else{
    $response = "END".$result_v->description;    
    }         
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '1' && $pieces[6] && !empty($pieces[6])){
 /*   $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`, `patron_id`)
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
    }                */
    $response = "CON You\'ll be charged 200 naira from your bank account for you to be fully registered, 
    this amount will be included in your wallet, you\'ll be required to input your bank account number 
    and bank account name, then an OTP will be sent to you, which you will input in the required space 
    when you\'re asked to, proceed? \n";
    $response .= "1. Yes \n";
    $response .= "2. No \n";   
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '1' && $pieces[7] && in_array($pieces[7], ['1', '2']) 
&& $pieces[6] && !empty($pieces[6])){
    if($pieces[7] == '2'){
    $response = "END Thank you for your time";    
    }else{
    $response = "CON Please select your bank \n";
    $response .= "1. FCMB Nigeria \n";
    $response .= "2. Zenith Nigeria \n";
    $response .= "3. Access Nigeria \n";
    $response .= "4. Providus Nigeria \n";
    $response .= "5. Sterling Nigeria \n";
    $response .= "6. None of the above \n";   
    /*
    FCMB Nigeria
    234001
    Zenith Nigeria
    234002
    Access Nigeria
    234003
    Providus Nigeria
    234007
    Sterling Nigeria
    234010   
    */ 
    }   
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '1' 
&& $pieces[6] && !empty($pieces[6]) && $pieces[7] && in_array($pieces[7], ['1'])
 && $pieces[8] && 
in_array($pieces[8], ['1','2','3','4','5'])){
    if($pieces[8] == '1'){
        $bank_code = 234001;
    }else if($pieces[8] == '2'){
        $bank_code = 234002;
    }else if($pieces[8] == '3'){
        $bank_code = 234003;
    }else if($pieces[8] == '4'){
        $bank_code = 234007;
    }else if($pieces[8] == '5'){
        $bank_code = 234010;
    }
    $response = "CON Please enter your bank account name \n";      
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '1' 
&& $pieces[6] && !empty($pieces[6]) && $pieces[7] && in_array($pieces[7], ['1']) && $pieces[8] && 
in_array($pieces[8], ['1','2','3','4','5']) && $pieces[9] && !empty($pieces[9])){
    $response = "CON Please enter your bank account number \n";      
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '1' && $pieces[6] && !empty($pieces[6]) && $pieces[7] &&
 in_array($pieces[7], ['1']) && $pieces[8] && in_array($pieces[8], ['1','2','3','4','5']) 
 && $pieces[9] && !empty($pieces[9]) && $pieces[10] && !empty($pieces[10])){
    $response = "CON Please enter your date of birth \n";      
}else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
&& $pieces[5] && $pieces[5] == '1'
&& $pieces[6] && !empty($pieces[6]) && $pieces[7] && in_array($pieces[7], ['1']) && $pieces[8] && 
in_array($pieces[8], ['1','2','3','4','5']) && $pieces[9] && !empty($pieces[9]) && $pieces[10] && !empty($pieces[10])
 && $pieces[11] && !empty($pieces[11])){
    $result = BankCheckout($pieces[9],$pieces[10],$bank_code, $pieces[11]);
    if($result->status == 'PendingValidation'){
    $totality = true;
    $response = "CON Please enter the OTP sent to you \n";    
    }else{
    $response = "END".$response->description;    
    }         
}else if($totality && $pieces[12] && !empty($pieces[12])){
    $result_v = BankValidate($pieces[12], $result->transactionId);
    if($result_v->status == 'Success'){
     $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`, `patron_id`, `paid`)
                                                    VALUES ('$phoneNumber',
                                                    '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
                                                    '" . mysqli_real_escape_string($conn, $pieces[3]) . "',
                                                    '$pieces[0]',
                                                     '" . mysqli_real_escape_string($conn, $pieces[4]) . "',
                                                    '$pieces[1]', true)";
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
    $response = "END Congratulations you\'ve successfully registered";   
    }else{
    $response = "END".$result_v->description;    
    }         
}
}else if($pieces[1] && !empty($pieces[1])&& !in_array($pieces[1], $numbers)){
    if($pieces[1] && !empty($pieces[1])){
        $response = "CON Enter last name \n";
    }else if($pieces[2] && !empty($pieces[2]) && $pieces[1] && !empty($pieces[1])){
        $response = "CON Enter vehicle plate number \n";
    }else if($pieces[3] && !empty($pieces[3]) && $pieces[2] && !empty($pieces[2])&& $pieces[1] && !empty($pieces[1])){
    $response = "CON Please where you referred by anyone \n";
    $response .= "1. Yes \n";
    $response .= "2. No \n";
    }else if($pieces[4] && $pieces[4] == '1' && $pieces[3] && !empty($pieces[3]) && $pieces[2] && !empty($pieces[2])){
    $response = "CON Please enter the phone number of who referred you \n";    
    }else if($pieces[4] && $pieces[4] == '2' && $pieces[3] && !empty($pieces[3]) && $pieces[2] && !empty($pieces[2])){
        $response = "CON You\'ll be charged 200 naira from your bank account for you to be fully registered, 
        this amount will be included in your wallet, you\'ll be required to input your bank account number 
        and bank account name, then an OTP will be sent to you, which you will input in the required space 
        when you\'re asked to, proceed? \n";
        $response .= "1. Yes \n";
        $response .= "2. No \n";
    }else if($pieces[4] && $pieces[4] == '2' && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2])
    && $pieces[5] && !empty($pieces[5]) && $pieces[6] && in_array($pieces[6], ['1','2'])){
            if($pieces[6] == '2'){
                $response = "END Thank you for your time";    
                }else{
                $response = "CON Please select your bank \n";
                $response .= "1. FCMB Nigeria \n";
                $response .= "2. Zenith Nigeria \n";
                $response .= "3. Access Nigeria \n";
                $response .= "4. Providus Nigeria \n";
                $response .= "5. Sterling Nigeria \n";
                $response .= "6. None of the above \n";   
                }    
    }else if($pieces[4] && $pieces[4] == '2' && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2])
    && $pieces[5] && !empty($pieces[5]) && $pieces[6] && in_array($pieces[6], ['1','2'])
    && $pieces[7] && in_array($pieces[7], ['1','2','3','4','5'])){
        if($pieces[7] == '1'){
                $bank_code = 234001;
            }else if($pieces[7] == '2'){
                $bank_code = 234002;
            }else if($pieces[7] == '3'){
                $bank_code = 234003;
            }else if($pieces[7] == '4'){
                $bank_code = 234007;
            }else if($pieces[7] == '5'){
                $bank_code = 234010;
            }
            $response = "CON Please enter your bank account name \n";   
    }else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
    && $pieces[5] && $pieces[5] == '1' 
    && $pieces[6] && !empty($pieces[6]) && $pieces[7] && in_array($pieces[7], ['1']) && $pieces[8] && 
    in_array($pieces[8], ['1','2','3','4','5']) && $pieces[9] && !empty($pieces[9])){
        $response = "CON Please enter your ban                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            k account number \n";      
    }else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2] && !empty($pieces[2]) 
    && $pieces[5] && $pieces[5] == '1' && $pieces[6] && !empty($pieces[6]) && $pieces[7] &&
     in_array($pieces[7], ['1']) && $pieces[8] && in_array($pieces[8], ['1','2','3','4','5']) 
     && $pieces[9] && !empty($pieces[9]) && $pieces[10] && !empty($pieces[10])){
        $response = "CON Please enter your date of birth \n";      
    }else if($pieces[4] && !empty($pieces[4]) && $pieces[3] && !empty($pieces[3])&& $pieces[2]
    && $pieces[5] && $pieces[5] == '1'
    && $pieces[6] && !empty($pieces[6]) && $pieces[7] && in_array($pieces[7], ['1']) && $pieces[8] && 
    in_array($pieces[8], ['1','2','3','4','5']) && $pieces[9] && !empty($pieces[9]) && $pieces[10] && !empty($pieces[10])
     && $pieces[11] && !empty($pieces[11])){
        $result = BankCheckout($pieces[9],$pieces[10],$bank_code, $pieces[11]);
        if($result->status == 'PendingValidation'){
        $totality = true;
        $response = "CON Please enter the OTP sent to you \n";    
        }else{
        $response = "END".$response->description;    
        }         
    }else if($totality && $pieces[12] && !empty($pieces[12])){
        $result_v = BankValidate($pieces[12], $result->transactionId);
        if($result_v->status == 'Success'){
         $sql = "INSERT INTO `users` (`phone_number`, `first_name`, `last_name`,`menu_id`,`plate_number`, `patron_id`, `paid`)
                                                        VALUES ('$phoneNumber',
                                                        '" . mysqli_real_escape_string($conn, $pieces[2]) . "',
                                                        '" . mysqli_real_escape_string($conn, $pieces[3]) . "',
                                                        '$pieces[0]',
                                                         '" . mysqli_real_escape_string($conn, $pieces[4]) . "',
                                                        '$pieces[1]', true)";
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
        $response = "END Congratulations you\'ve successfully registered";   
        }else{
        $response = "END".$result_v->description;    
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
?>