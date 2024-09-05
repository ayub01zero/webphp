<?php
require_once("header.php");
?>

<?php
if(isset($_SESSION['account_id'])){
 redirect('home');
}
?>
<div class="container myback mt-4">   
    <div class="row">
      <div class="col-md-6 offset-md-3 ">
        <form action="forget.php" method="POST" class="Signup shadow-lg">
          <h3 class="text-dark"> <span style="color: #ff6c57;">F</span>oodorder  <span style="color:#4eb060;">S</span>ecurity </h3>
          <div class="form-group ">
            <p class="text-center">
              <?php
messagebox();
              ?>
            </p>
            <input type="text" class="form-control" placeholder="Enter your email " name="emailrecovery" >
          </div>
          <button type="submit" name="send" class="btn btn-success">Send <i class="fa fa-solid fa-paper-plane"></i></button>
          <hr>
          <div class="form-group">
            <p class="not-yet"> have a problem ? <a href="usebackup.php">Use backup</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>


  <style>
    .myback{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50% , -60%);
    }
    form.Signup {
        border-radius: 20px;
    border: 1px solid #ddd;
    padding: 0px 20px;
    margin: 50px 0px;
    background-color: white;
}
form.Signup input,label{
    text-align: center!important;
}

.Signup .btn {
    width: 100%;
    margin: 10px 0px;
    font-size: 18px;
    background-color: #ff6c57;
    border: none;
}
.Signup h3 {
    margin: 20px 0px 30px;
    padding: 0px 0px 25px;
    text-align: center;
    border-bottom: 1px solid #ddd;
     color: #27E6A3;
}
p.not-yet {
    text-align: center;
}
  </style>

<?php
if (isset($_POST['send'])) {
    $email = request($_POST['emailrecovery']);
    if(empty($email)) {
        message('Email is Required','warning');
        redirect('forget');
    }
    else {
        $checkemail = countData(" SELECT * FROM accounts WHERE account_email='{$email}' ");
        if($checkemail > 0 ){
            $code = rand(111111,999999);
            mailer($email,'Forget Password','
                This is Your Recovery Code '. $code
            );
            execute(" DELETE FROM accounts_forget WHERE email='{$email}' ");
            execute(" INSERT INTO accounts_forget(email,code) VALUES('{$email}','{$code}') ");
            redirect('reset');
        }
        else {
            message('Email is not Exist in FoodOrder','danger');
            redirect('forget');
        }
    }
}
unset($_SESSION['message']);
?>
  






