<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['button'])) {
            $solution = mailer($_POST['first_name'],$_POST['last_name'],$_POST['phone_number'],
            $_POST['ref_phone_number'], $_POST['type_of_vehicle'], $_POST['vehicle_model'],
            $_POST['vehicle_plate_no']) . "<br/>";
            echo $solution;   
}
function mailer($first_name, $last_name, $phone_number, $ref_phone_number, $type_of_vehicle, $vehicle_model,
$vehicle_plate_no){
require_once "vendor/autoload.php";

//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = "earlybird@mendelsmore.com";
$mail->FromName = $first_name." ".$last_name;

//To address and name
$mail->addAddress("mendelsnzeh@mendelsmore.com"); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("info@mendelsmore.com", "Reply");

//Send HTML or Plain Text email


$mail->Subject = "Early Bird Subscription for ".$first_name." ".$last_name;
$message = '<html><body>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $first_name." ".$last_name . "</td></tr>";
$message .= "<tr><td><strong>Phone No:</strong> </td><td>" . $phone_number . "</td></tr>";
$message .= "<tr><td><strong>Referral Phone Number:</strong> </td><td>" . $ref_phone_number . "</td></tr>";
$message .= "<tr><td><strong>Type of vehicle:</strong> </td><td>" . $type_of_vehicle . "</td></tr>";
$message .= "<tr><td><strong>Vehicle Model:</strong> </td><td>" . $vehicle_model . "</td></tr>";
$message .= "<tr><td><strong>Vehicle Plate Number:</strong> </td><td>" . $vehicle_plate_no . "</td></tr>";
$mail->Body = $message;
$mail->isHTML(true);
// $mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    return "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    return "Message has been sent successfully";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mendelsmore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        .form-div{

        }
 </style>

</head>
    <body>
        <h2>Early Bird Subscription</h2>
        <div class="row" style="margin-left: 10px;">
            <form name="mailer" method="post">
            <div class="form-group">
<input type="text" name="first_name" class="form-control" placeholder="First Name" required>
</div>
<div class="form-group">
<input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
</div>
<div class="form-group">
<input type="number" name="phone_number" class="form-control" placeholder="Phone Number" required>
</div>
<div class="form-group">
<input type="number" name="ref_phone_number" class="form-control" placeholder="Referral Phone Number" required>
</div>
<div class="form-group">
<input type="text" name="type_of_vehicle" class="form-control" placeholder="Type of Vehicle" required>
</div>
<div class="form-group">
<input type="text" name="vehicle_model" class="form-control" placeholder="Vehicle Model" required>
</div>
<div class="form-group">
<input type="text" name="vehicle_plate_no" class="form-control" placeholder="Vehicle Plate Number" required>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block btn-flat" name="button">Sign Up</button>
</div>           </form>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
</script>
    </body>
</html>