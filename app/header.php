<?php
require_once('../server/app.php');
?>

<?php
$getAuth = fetchAuth();
if($getAuth!=null) {
$authId = $getAuth['account_id'];
$authName = $getAuth['account_name'];
$authEmail = $getAuth['account_email'];
$authroll = $getAuth['account_roll'];
}
else {
$authId = null;
$authName = null;
$authEmail = null;
$authroll=null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>foodorder management system</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fontawesome.css">
  
</head>
<body>
<script src="../js/bootstrap.js"></script>
<script src="../js/fontawesome.js"></script>

<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php"> <span style="color: #4eb060;">F</span>oodOrder <i style="color:#ff6c57;" class="fa-solid fa-burger"></i><a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span  ><i class="fa fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
       
      <li class="nav-item">
          <a class="nav-link "  href="home.php" style="color:#4eb060">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="foods.php">Foods</a>
        </li>
        <?php
if(isAuth()){
  if($authroll==='admin'){
redirect('dashboard.php');

  }
  else{
    ?>

<li class="nav-item">
          <a class="nav-link" href="favorite.php" >Favorite</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Orders.php" > Orders </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php" >Cart <span><?=help($authId);?></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Security.php" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Privacy</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php" >Logout</a>
        </li>



<?php
  }
  ?>

<?php
}else{
  ?>

        <li class="nav-item">
          <a class="nav-link" href="login.php" >Login</a>
        </li>

<?php
}
?>
      </ul>
    </div>
  </div>
</nav>



<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Privacy and Security <i class=" fa-solid fa-eye"></i></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
   <p>At [security account], we take the privacy and security of our users'
     personal information very seriously. To ensure that your data is protected, 
     we have implemented various measures such as using SSL encryption, regularly
      monitoring our systems for vulnerabilities, and following industry best practices
       for data storage and handling. If you have any questions or concerns regarding your
        privacy and security on our platform, please don't hesitate to contact us at 
        [home -> Contact Us]</p>

        <div class="dropdown mt-3">
      <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" style="color: #4eb060;border:none;">
        <span><?php echo $authName ?></span> account
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="security.php">Update & security</a></li>
      </ul>
    </div>
  </div>
</div>


<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  
}


  .navbar-toggler{
    border: none!important;
    box-shadow: none!important;
  }
.navbar{
  background-color:whitesmoke!important;
  
}
.nav-link {
  font-size: 18px;
  /* color: #ff6c57!important; */
} 
.navbar-brand{
  font-size: 24px;
  color:  black!important;
  font-weight: 600;
}
.navbar-brand::first-letter{
  font-size: 30px;
}

html::-webkit-scrollbar{
    width: .5rem;
}

html::-webkit-scrollbar-track{
    background: transparent;
}

html::-webkit-scrollbar-thumb{
    background: #ff6c57;
    border-radius: 5rem;
}

</style>