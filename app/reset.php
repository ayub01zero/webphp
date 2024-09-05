<?php
require_once("header.php");
?>



<?php
if(isset($_SESSION['account_id'])){
 redirect('home');
}
?>



<section class="reseections">
<div class="container myreset"> 
<form action="reset.php" method="post" class="card text-center " style="width:750px;">
    <div class="card-header h5 text-white "  style="background-color: #ff6c57;"><abbr title="Foodorder security">FS </abbr>- Reset Password</div>
    <div class="card-body px-5">
        <p class="card-text py-2">
           Change you account password through the code we sent
        </p>
        <p>
          <?php
messagebox();
?>
        </p>
        <div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingPassword" name="code" placeholder="Enter code">
  <label for="floatingPassword">Enter the code</label>
</div>
        <div class="form-floating mb-3">
  <input type="password" class="form-control" id="floatingInput" name="newpassword" placeholder="Enter your new pasword">
  <label for="floatingInput">New password</label>
</div>
<div class="form-floating mb-3">
  <input type="password" class="form-control" id="floatingPassword" name="renewpassword" placeholder="Re-Enter password">
  <label for="floatingPassword">Re-Enter password</label>
</div>

        <button  type="submit"  class="btn w-100 mt-4 h5 text-light" name="reset" style="background-color: #ff6c57; ">Reset password <i class="fa-solid fa-lock"></i></button>
        <div class="d-flex justify-content-between mt-4">
            <a class="text-dark" href="login.php">Login</a>
            <a class="text-dark" href="home.php">Contact Us</a>
        </div>
        </div>
</form>
</div>

  </section>

<style>

    .ressection{
        position: relative;

     
    }
    .myreset{
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        margin-top: 45px!important;
       
    }
</style>


<?php 
if (isset($_POST['reset'])) {
    $code = request($_POST['code']);
   
    if(empty($code)) {
        message('Code is Required','danger');
        redirect('reset');
    }
    if(request($_POST['newpassword'])) {
        $newpassword = md5(request($_POST['newpassword']));
    }else{
          message('New Password is Required','warning');
        redirect('reset');
    }
    if(request($_POST['renewpassword'])) {
      $renewpassword = md5(request($_POST['renewpassword']));
  }else{
        message('re-Password is Required','warning');
      redirect('reset');
  }

   
        $checkcode = countData(" SELECT * FROM accounts_forget WHERE code='{$code}' ");
        if($checkcode > 0 ){
        $getEmail = findData(" SELECT * FROM accounts_forget WHERE code='{$code}' ");
        $email = $getEmail['email'];
        if($newpassword != $renewpassword)
        {
          message('Passwords Arent Same','danger');
          redirect('reset');
        }else{

          execute(" UPDATE accounts SET account_password='{$newpassword}' WHERE account_email='{$email}' ");
        execute(" DELETE FROM accounts_forget WHERE email='{$email}' ");
        message('Successfully Changed','success');
        redirect('login');
        }
        }else {
            message('The Code Is Incorrect','danger');
            redirect('reset');
        }
    
}

unset($_SESSION['message']);
  
  


?>
