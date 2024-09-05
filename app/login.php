<?php
require_once("header.php");
?>

<head><link rel="stylesheet" href="../css/login.css"></head>

<?php
if(isset($_SESSION['account_id'])){
 redirect('home');
}
?>

  <div class="container" >
    
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
          <div class="login-form">
            <div class="title">Login</div>
          <form action="login.php" method="post">
            <div class="input-boxes">
              <p class="text-center">
<?php
messagebox();
?>
              </p>
              <div class="input-box">
                <i class="fas fa-envelope icon"></i>
                <input type="text" placeholder="Email Or username" name="useroremail">
              </div>
              <div class="input-box">
                <i class="fas fa-lock icon"></i>
                <input type="password" placeholder="Enter your password" name="userpassword">
              </div>
              <div class="text"><a href="forget.php">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Login" name="login">
              </div>
              <div class="text sign-up-text">Don't have an account? <a href="register.php">Sign up now</a> </div>
            </div>
        </form>
      </div>

    </div>
    </div>
  </div>

<?php
if (isset($_POST['login'])) {
 $username = request($_POST['useroremail']);
 if(empty($username) && empty($password)) {
  message('All Fields are Required','warning');
  redirect('login');  
 }if(empty($username)) {
  message('Username Or Email is Required','warning');
  redirect('login');
 }
 if(request($_POST['userpassword'])) {
  $password = md5(request($_POST['userpassword']));
 }else{
  message('Password is Required','warning');
  redirect('login');
 }
  

 $authQuery = " SELECT * FROM accounts 
 WHERE (account_email='{$username}' OR account_name='{$username}') AND account_password='{$password}'  ";
  $checkAuth = countData($authQuery);
 if($checkAuth > 0) {
  $getAuthdata = findData($authQuery);
  $account_id = $getAuthdata['account_id'];
  $_SESSION['account_id']=$account_id;
 //check email security 
 
 $checksecure =  countData("SELECT email_address FROM secure WHERE account_id= '$account_id'");
 if($checksecure > 0){
 $checkemail = findData("SELECT * FROM secure WHERE account_id = '$account_id' ");
 $email = $checkemail['email_address'];
 mailer($email,' foodorder security ','
 someone login your foodorder account that is you ? <br> please check it '. null
);
 }
  redirect('home');
 }
 else {
  message(' email address or password is incorrect ','danger');
  redirect('login');
 }
}

unset($_SESSION['message']);
  
  




?>

