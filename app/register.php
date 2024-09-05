<?php
require_once("header.php");
?>


<head><link rel="stylesheet" href="../css/register.css"></head>
<?php
if(isset($_SESSION['account_id'])){
 redirect('home');
}
?>


  <div class="container mt-4" >
    
    <div class="cover " >
      <div class="front ">
        <img src="../image/foodback.jpg" >
        
      </div>
      <div class="back">
        <img class="backImg" src="../image/foodhome.webp" alt="not image"> 
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
        <div class="signup-form">
          <div class="title">Signup</div>
        <form action="register.php" method="post">
            <div class="input-boxes">
            <p class="text-center">
                <?php

messagebox();
?>
              </p>
              <div class="input-box">
                <i class="fas fa-user icon"></i>
                <input type="text" placeholder="Enter your name" name="username" >
              </div>
              <div class="input-box">
                <i class="fas fa-envelope icon"></i>
                <input type="text" placeholder="Enter your email" name="useremail">
              </div>
              <div class="input-box">
                <i class="fas fa-lock icon"></i>
                <input type="password" placeholder="Enter your password" name="userpassword">
              </div>
              <div class="input-box">
              <i class="fa fa-solid fa-location-pin icon"></i>
                <input type="text" placeholder="Enter your Location" name="address">
              </div>
              <div class="button input-box">
                <input type="submit" value="Register" name="register">
              </div>
              <div class="text sign-up-text">Already have an account? <a href="login.php"> Login </a></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>

<?php


if (isset($_POST['register'])) {

    // go to database 
    $account_name  = request(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
    $account_email = request(filter_input(INPUT_POST, "useremail", FILTER_VALIDATE_EMAIL));
    $address  = request(filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING));
  
  
  
  
  
    if(empty($account_name)) {
        message('Username is Required ','danger');
        redirect('register.php');
    }
    if(empty($account_email)) {
        message('Email is Required ','danger');
        redirect('register.php');
    }
    if(request($_POST['userpassword'])) {
    $account_password = md5(request($_POST['userpassword']));
  
  }else{
        message('Password is Required ','danger');
        redirect('register.php');
    }
    if(empty($address)) {
        message('Location is Required ','danger');
        redirect('register.php');
    }
  
   
    $checkuser = countData(" SELECT * FROM accounts WHERE account_name='$account_name ' ");
    if($checkuser > 0) {
        message('username Already Added','danger');
        redirect('register.php');
    }
    $checkEmail = countData(" SELECT * FROM accounts WHERE account_email='$account_email ' ");
    if($checkEmail > 0) {
        message('Email Already Added','danger');
        redirect('register.php');
    }else {
  
        $createAccount = execute(" INSERT INTO accounts(account_name,account_email,account_password,account_address) 
        VALUES('$account_name','$account_email','$account_password','{$address}'); ");
             message('Account created login Now','success');
        redirect('login.php');
    }
  }
  
  
  
  
  unset($_SESSION['message']);
  
  
  





