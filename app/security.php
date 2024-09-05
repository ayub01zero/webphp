<?php
require_once("header.php");
?>

<head><link rel="stylesheet" href="../css/security.css"></head>

<?php
if(isAuth()){

    
   //  <!-- foodorder Privacy and security -->
   //<!--  ayub mutalib mohammed -->


   
$getmynumber = findData("SELECT account_phoneno FROM accounts WHERE account_id='$authId'");
$mynumber  = $getmynumber['account_phoneno'];



$backup = null;

if (isset($_POST['generate'])) {
    
	$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
	$characters = str_shuffle($characters);
	$backup = substr($characters, 0, 16);
   message('code created' , 'success');
   
}
?>


<div class="container card-0 justify-content-center">
  <div class="card-body px-sm-4 px-0">
    <div class="row mycardstyle justify-content-center ">
      <div class="col-md-10 col">
        <h3 class="font-weight-bold ml-md-0 mx-auto text-center text-sm-left mt-4">Privacy and Security</h3>
        <p class="mt-md-4 ml-md-0 ml-2 text-center text-sm-left mt-4">Settings and recommendations to help you keep your account secure , if you have any problem please contact us</p>
      </div>
    </div>
    <div class="row justify-content-center round ">
      <div class="col-lg-10 col-md-12 ">
        <div class="card shadow-lg card-1 ">
        
          <div class="card-body inner-card ">
 <?php
 if(isset($_SESSION['message']) && isset($_SESSION['type'])){
 ?>

       <h6 class="text-center text-dark mb-5">
         <?php
messagebox();
?>
          </h6>
<?php
 }
 ?>
   
 <div class="row justify-content-center pb-4">

 <form action="security.php" method="post" class="col-lg-10 col-md-6 col-sm-12 " id="user_form">
  <h5>Update profile and password</h5>
  <hr>
 <div class="form-group">
 <label for="first-name">change Username</label>
 <input type="text" class="form-control" id="first-name" placeholder="Enter your username" value="<?=$authName;?>" name="username">
 </div>
 <div class="form-group">
 <label for="Mobile-Number">change Email</label>
 <input type="email" class="form-control" id="Mobile-Number" placeholder="Enter your email" value="<?=$authEmail;?>" name="email">
 </div>


 <div class="form-group">
 <label for="time">Old password</label>
 <input type="password" class="form-control" id="time" placeholder="Enter the old password" name="oldpassword">
 </div>
 <div class="form-group">
 <label for="skill">New password</label>
 <input type="password" class="form-control" id="skill" placeholder="Enter the new password" name="newpassword">
 </div>
 <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-3" role="group" aria-label="Basic mixed styles example">
  <button type="submit " id="tn_save"  class="btn text-light btn-dark" name="updateprofile">Save profile</button>
  <button type="submit" id="tn_save" class="btn text-light btn-dark" name="updatepassword">Save Password</button>
</div>
	

<div class="mt-5 " >
  <h6> *Please insert the phone number to contact you when it is delivered</h6>
</div>
<div class="input-group form-group ">
				
				<input name="userphone" value="<?=$mynumber;?>" type="text" class="form-control mt-2" placeholder="Enter phone number" aria-label="Recipient's username" aria-describedby="basic-addon2">
				<button name="addphone" type="submit" class="btn btn-dark mt-2 mb-2" style="border: none;"> <span style="background-color: trasparent;border:none;" class="input-group-text bg-dark text-light "  id="basic-addon2">Add </span></button> 
			  </div>
	
</form>



 <form action="security.php" method="POST" class="col-lg-10 col-md-6 col-sm-12">
			  <div class="accordion" id="accordionExample" >
 
  <div class="accordion-item " style="border: none;">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed "  type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
       Whats is email and backup security ?
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse " aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body"  >
       <strong>email security</strong> Used to increase the security of your account Through this new email, we'll provide you with a new feature When you activate this section, we'll add a useful feature to you ، Whenever someone is login your account, we'll notify you through that new email. And you can check your account,
       <strong>backup code</strong> This section is used when there is no way to be inside your account And that's through the special code that's made for you , You can use it if you can't restore the password or you forgot the password ,
       How do we activate this section? First, be careful in the bottom one, we have two parts that are not related to each other And also, the purpose of the password means to enter the password account of the foodorder First click Generate to create a code for you, then click setup . please copy the code before setup and keep safe
      </div>
    </div>
  </div>
  <hr>
</div>
 <div class="form-group ">
 <label for="last-name">Enter new email</label>
 <input type="email" class="form-control"  name="newemail" placeholder="Enter your email">
 </div>
 <div class="form-group">
 <label for="phone">Enter password</label>
 <input type="password" class="form-control"  name="accpassword" placeholder="Enter your password">
 </div>
 <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
 <button type="submit" name="addemail"  class="btn text-light btn-dark">Set email security</button>
</div>
 <div class="form-group mt-5">
 <label for="Company-Name">generate backup</label>
 <input type="text" class="form-control" name="backup" value="<?php  echo  $backup;   ?>" readonly placeholder="click generate to create a code">
 </div>

				<div class="form-group ">
 <label for="Company-Name">Enter password</label>
 <input type="password" class="form-control"  placeholder="Enter your password" name="passwordback">
 </div>

 <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3" role="group" aria-label="Basic mixed styles example">
  <button type="submit "  class="btn text-light btn-dark"name="generate" >Generate code</button>
  <button type="submit"  class="btn text-light btn-dark" name="setbackup">Set backup</button>
</div>

</form>
 </div>
         
<div class="row justify-content-center mt-3">
<section id="contact " class="mt-5 ">
        <div class="container">
 <div class="row mb-5">
 <div class="col-md-8 mx-auto text-center">
   <h6 class="text-success">CONTACT US</h6>
   <h1>Get In Touch</h1>
   <p>We value your feedback and welcome any 
     questions or concerns you may have. Please do not hesitate to
      contact us via phone, email, or social media with any inquiries. Our team is available to assist you and address any issues 
     promptly. We look forward to hearing from you and appreciate your continued support</p>
 </div>
 </div>

 <form action="security.php" method="POST" class="row g-3 justify-content-center">
 <div class="col-md-5">
   <input type="text" name="feedback1" class="form-control" placeholder="Full Name "  required>
 </div>
 <div class="col-md-5">
   <input type="text" name="feedback2" class="form-control" placeholder="Enter E-mail" required>
 </div>
 <div class="col-md-10">
   <input type="text" name="feedback3" class="form-control" placeholder="Enter Subject" required>
 </div>
 <div class="col-md-10">
   <textarea cols="30" rows="5" class="form-control" name="feedbacktext" required
       placeholder="Enter Message"></textarea>
 </div>
 <div class="col-md-10 d-grid">
   <button type="submit" name="sendfeedback" class="btn btn-success">Contact</button>
 </div>
 </form>

        </div>
    </section>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
}else{
    ?>
<div class="container mecont mt-5">
    <div class="row mt-2">
        <div class="col-md-12">
 <div class="error-template ">
 <h1 class="text-dark">
   Oops!</h1>
 <h2 class="text-dark">
   404 Not Found</h2>
 <div class="error-details text-dark">
   Sorry, an error has occured, Requested page not found!
 </div>
 <div class="error-actions ">
   <a href="home" style="background-color: #ff6c57;" class="btn btn-lg "><span class="glyphicon glyphicon-home"></span>
       Take Me Home </a><a   href="login" class="btn  btn-lg text-dark"><span class="glyphicon glyphicon-envelope "></span> Login in </a>
 </div>
 </div>
        </div>
    </div>
</div>

<style>
    .mecont{
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
.error-template {padding: 40px 15px;text-align: center; }
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>

  <?php
}
?>


<?php
if(isset($_POST['addphone'])){
  $userphone = request($_POST['userphone']);
  if(empty($userphone)){
    message('Please enter the phone number ','warning');
    redirect('security');
  }else{
    $findphone = findData("SELECT * FROM accounts WHERE account_id='$authId' ");
    $get_phone = $findphone['account_phoneno'];
    if($get_phone === null){
      execute(" UPDATE accounts SET account_phoneno = '$userphone' WHERE account_id= '$authId'");
      message('phone number added  ','warning');
      redirect('security');
    }else{
      message('phone number already added  ','warning');
      redirect('security');
    }
  }
}

if (isset($_POST['updateprofile'])) {
    $username = request($_POST['username']);
    $email = request($_POST['email']);
    if(empty($username) && empty($email)) {
    message('All Fields are Required','warning');
    redirect('security');
    }
    if(empty($username)) {
    message('Username is Required','warning');
    redirect('security');
    }
    if(empty($email)) {
    message('Email is Required','warning');
    redirect('security');
    }
    
    $checkDuplicateData = countData(" SELECT * FROM accounts 
    WHERE (account_name='{$username}' OR account_email='{$email}') AND account_id!='{$authId}'  ");
    if($checkDuplicateData===0){
    execute(" UPDATE accounts SET account_name='{$username}',account_email='{$email}' 
    WHERE account_id ='{$authId}' ");
    message('Profile Updated ! ','success');
    redirect('security');
    }
    else {
    message('Already Added','warning');
    redirect('security');
    }
    
    }
    
    if (isset($_POST['updatepassword'])) {

    if(request($_POST['oldpassword']) && request($_POST['newpassword'])) {
        $oldpassword = md5(request($_POST['oldpassword']));
        $newpassword = md5(request($_POST['newpassword']));
    }else{
  message('Old Password & New Password are Required','warning');
    redirect('security');
    }
    
    
    $checkDuplicateData = countData(" SELECT * FROM accounts 
    WHERE account_password='{$oldpassword}' AND account_id='{$authId}'  ");
    if($checkDuplicateData > 0){
    execute(" UPDATE accounts SET account_password='{$newpassword}'
    WHERE account_id ='{$authId}' ");
    message('Password Updated ! ','success');
    redirect('security');
    }
    else {
    message('Old Password Not Found in FoodOrder','danger');
    redirect('security');
    }
    }

if(isset($_POST['addemail'])){


    $newemail = $_POST['newemail'];
    $password = md5( request($_POST['accpassword'] ));

    if(empty($newemail)){
        message('email required ' , 'warning');
        redirect('security');
    }elseif(empty($_POST['accpassword'] )){
        message('password required ' , 'warning');
        redirect('security');
    }
    else{

        $checkpassword = countData(" SELECT * FROM accounts 
        WHERE account_password='{$password}' AND account_id='{$authId}'  ");
         if($checkpassword > 0 )
         {

 $checkaccount = countData("SELECT * FROM secure WHERE account_id='$authId' ");
        if($checkaccount > 0){

 $findemail = findData("SELECT * FROM secure WHERE account_id='$authId' ");
 $get_email = $findemail['email_address'];
 if($get_email === null ){
 execute("UPDATE secure SET email_address = '$newemail' WHERE account_id= '$authId'");
 message('email added ' , 'success');
 redirect('security');
}else{
 message(' this field already added ','warning');
 redirect('security');
}
         }else{
          $countemail =  countData("SELECT * FROM accounts WHERE account_email ='$newemail'");
          if($countemail === 0){
     $countemailsecure =  countData("SELECT * FROM secure WHERE email_address ='$newemail'");
       if($countemailsecure === 0 ){
   $checkpassword = countData(" SELECT * FROM accounts 
          WHERE account_password='{$password}' AND account_id='{$authId}'  ");
          if($checkpassword > 0){
          execute("INSERT INTO secure(email_address,account_id) VALUES('$newemail' , '$authId')");
          message('email security added ', 'success');
          redirect('security');
  
          }
          else
      {
          message('password incorect ' , 'danger');
          redirect('security');
      }
      }
      
          else{
   message('email already added' , 'danger');
   redirect('security');
          }
  
          }
          else{
  redirect('security');
   message('Email is  already added ' , 'danger');
          }
         }
       
        }else{
          message('password incorect ' , 'danger');
          redirect('security');
        }
    }
}


    if(isset($_POST['setbackup'])){
    
        $passwordback = md5(request($_POST['passwordback']));
        $backup = $_POST['backup'];
        $password1 = request($_POST['passwordback']);


        if(empty($_POST['passwordback']) && empty($backup) ){
        message('password and code required ' , 'warning');
        redirect('security');
        }

        if(empty($backup)){

 message('backup code required ' , 'warning');
 redirect('security');
    
 }
      
     if(empty($_POST['passwordback'])){

 message('password required ' , 'warning');
 redirect('security');
    
 }

       
        else{

 $checkaccount = countData("SELECT * FROM secure WHERE account_id='$authId' ");
 $passwordrecover = countData(" SELECT * FROM accounts 
 WHERE account_password='{$passwordback}' AND account_id='{$authId}'  ");
 if($checkaccount > 0){


        if($passwordrecover > 0){
 execute("UPDATE secure SET backupcode = '$backup' WHERE account_id= '$authId'");
 message('backup generated ' , 'success');
 redirect('security');
        }else{
 message('password incorect' , 'danger');
 redirect('security');
        }
 }
 else{
  if($passwordrecover > 0){

 execute("INSERT INTO secure (backupcode , account_id) VALUES ('$backup' , '$authId') ");
 message('backup generated ' , 'success');
 redirect('security');

  }else{
    message('password incorect' , 'danger');
    redirect('security');

  }

 }
        }
    }


    if(isset($_POST['sendfeedback'])){
      $feedback1 = $_POST['feedback1'];
      $feedback2 = $_POST['feedback2'];
      $feedback3 = $_POST['feedback3'];
      $feedbacktext = $_POST['feedbacktext'];
      $createAccount = execute(" INSERT INTO feedback(account_id,full_name,user_email,fed_subject,fed_message) 
      VALUES('$authId','$feedback1','$feedback2','$feedback3','$feedbacktext'); ");
message('message send we will contact with you soon','success');
      redirect('security.php');
    }
?>


<?php
require_once("footer.php");
?>