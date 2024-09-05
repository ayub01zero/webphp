<?php
require_once("header.php");
?>


<?php
if(isset($_SESSION['account_id'])){
 redirect('home');
}
?>



<div class="container myback ">   
    <div class="row">
      <div class="col-md-6 offset-md-3 ">
        <form action="usebackup" method="POST" class="Signup shadow-lg">
          <h3 class="text-dark"> <span style="color: #ff6c57;">B</span>ackup  <span style="color:#4eb060;">C</span>ode </h3>
          <div class="form-group ">
            <div class="text-center"> <?php  messagebox(); ?> </div>
            <input type="text" class="form-control" placeholder="Enter the code " name="mybackup" >
          </div>
          <button type="submit" name="usemybackup" class="btn btn-success">Login <i class="fa fa-solid fa-right-to-bracket"></i></button>
          <hr>
          <div class="form-group">
            <p class="not-yet"><a href="login.php">Go login</a></p>
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


if(isset($_POST['usemybackup'])){

$codereq = $_POST['mybackup'];

if(empty($codereq)){
  message('code required ','warning');
  redirect('usebackup');
}else{

  $authQuery = " SELECT * FROM secure 
  WHERE backupcode  = '$codereq' ";
      $checkAuth = countData($authQuery);
     if($checkAuth > 0) {
         $getAuthdata = findData($authQuery);
         $account_id = $getAuthdata['account_id'];
         $_SESSION['account_id']=$account_id;
         
                 execute("UPDATE secure SET backupcode = null  WHERE account_id = '$account_id' ");

         redirect('home');

     }
     else {
         message(' Code incorrect','danger');
         redirect('usebackup');
     }


}

}


unset($_SESSION['message']);
  
  







