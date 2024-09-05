
                     <!-- foodorder system functions -->
                     

<?php 
function redirect($page){
ob_start();
header('location:'.$page);
exit;
}


function execute($sql) {
global $conn;
return mysqli_query($conn,$sql);
}

function findData($sql) {
$result = execute($sql);
return mysqli_fetch_assoc($result);
}

function allData($sql) {
$result = execute($sql);
$alldata = [];
 while($row = mysqli_fetch_assoc($result)){
     $alldata[] = $row;
 }
 return $alldata;
}

function countData($sql) {
$reqult = execute($sql);
return $count = mysqli_num_rows($reqult );
}


function request($input){
    global $conn;
    return mysqli_real_escape_string($conn,trim($input)); 
}


function message($msg,$type) {
    if(isset($_SESSION['message']) && isset($_SESSION['type'])){
        unset($_SESSION['message']);
        unset($_SESSION['type']);
        $_SESSION['message'] = $msg;
        $_SESSION['type'] = $type;
    }
    else {
        $_SESSION['message'] = $msg;
        $_SESSION['type'] = $type;
    }
}



 function messagebox() {
if(isset($_SESSION['message']) && isset($_SESSION['type'])) {
$message =  $_SESSION['message'];
$type =  $_SESSION['type'];
if($message!=null && $type!=null) {
?>
<div class="alert text-<?=$type;?> alert-dismissible fade show  text-center" role="alert">
     <?=$message;?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php
}
}
}
 



function isAuth(){
if(isset($_SESSION['account_id'])){
$account_id = $_SESSION['account_id'];
$checkAuthQuery = " SELECT * FROM accounts WHERE account_id='{$account_id}' ";
$countAuthData = countData($checkAuthQuery);
if($countAuthData > 0 ) {
return true;
}
else {
return false;
}
}
else {
return false;
}
}


function checkAuth(){
if(isset($_SESSION['account_id'])){
$account_id = $_SESSION['account_id'];
$checkAuthQuery = " SELECT * FROM accounts WHERE account_id='{$account_id}' ";
$countAuthData = countData($checkAuthQuery);
if($countAuthData > 0 ) {
return $account_id;
}
else {
redirect('login');
}
}
else {
redirect('login');
}
}


function getAuth(){
    $account_id = checkAuth();
    $checkAuthQuery = " SELECT * FROM accounts WHERE account_id='{$account_id}' ";
    $getAuthData = findData($checkAuthQuery);
    return $getAuthData;
}

function fetchAuth(){
if(isset($_SESSION['account_id'])){
$account_id = $_SESSION['account_id'];
$checkAuthQuery = " SELECT * FROM accounts WHERE account_id='{$account_id}' ";
$countAuthData = countData($checkAuthQuery);
if($countAuthData > 0 ) {
$checkAuthQuery = " SELECT * FROM accounts WHERE account_id='{$account_id}' ";
$getAuthData = findData($checkAuthQuery);
return $getAuthData;
}
else {
    return null;
}
}
else {
    return null;
}
}




function checkRole(){
    $account_id = checkAuth();
    $checkAuthQuery = " SELECT * FROM accounts WHERE account_id='{$account_id}' ";
    $getAuthData = findData($checkAuthQuery);
    $role = $getAuthData['role'];
    if($role=='admin'){
        return "admin";
    }
    else {
        return "user";
    }
}
?>

<?php
require_once('mail/PHPMailer.php');
require_once('mail/SMTP.php');


function mailer($for,$subject,$body){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug =0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'email-me';                     //SMTP username
        $mail->Password   = '';                               //SMTP password
        $mail->SMTPSecure ='ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('email-me', 'FoodOrder message');
        $mail->addAddress($for);     //Add a recipient
        $mail->addReplyTo('email-me', 'Account Recovery');
      
     
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function encrypt_message($datasuth) {
    $plaintext = $datasuth;
    $encryption_key = "foodorder data auth encryption";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $encryption_key, 0, $iv);
    return $ciphertext;
}



function decrypt_message($GetDataAuth) {
    $ciphertext = $GetDataAuth;
    $encryption_key = "encryption key";
    $iv = "initialization vector";

    $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $encryption_key, 0, $iv);
    return $plaintext;
}







function help($countauth){
    $numberoforder =  countdata("SELECT * FROM orderlist WHERE account_id='$countauth'");
    if($numberoforder == 0){
        return null ;
    }
   return $numberoforder;
    
}




