<?php require_once("header.php");?>


<?php
if(isAuth()){
?>

<?php
  $favcount = countData("SELECT * FROM favorite WHERE account_id='$authId'");
  if($favcount >0 ){
  ?>




<div class="container myfoods">
        <div class="row g-3">
    <?php 
$favorites = allData(" SELECT * FROM favorite WHERE account_id='$authId'");
foreach($favorites as $favorite){
$favoriteid = $favorite['fav_id'];
$productid = $favorite['product_id'];
$getproduct =  allData(" SELECT * FROM products WHERE product_id='{$productid}' ");
foreach($getproduct as $product){
?>

<div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                <?php echo '<img src="data:image;base64,'.base64_encode($product['P_image']).'" class="rounded">';   ?>     
                    <div class="card-body">
                    <h5 class="card-title"><?=$product["productname"];?></h5>
                 <p class="card-text"><?=$product["description"];?></p>
     <a style="background-color:#4eb060;" href="addorder?product_id=<?=$product['product_id'];?>" class="btn  text-light btn-sm">Order</a>
 <a style="background-color:#ff6c57;" href="favorite?removetofavorite=<?=$product['product_id'];?>" class="btn  btn-sm text-light"><i class="fa-solid fa-xmark"></i></a>
      <a  style="background-color:#ff6c57;" class="btn  btn-sm text-light"><?=$product["productprice"];?> $</i></a>
    
    </div>
   </div>
  </div>



<?php
}
}
?>
 
  </div>
</div>
</section>







<?php

 

  if (isset($_GET['removetofavorite'])) {
  $productId = request($_GET['removetofavorite']);
  $checkProduct  = countData(" SELECT * FROM products WHERE product_id='{$productId}' ");
  if($checkProduct > 0){
    $checkfavorite = countData(" SELECT * FROM favorite WHERE 
    product_id='$productId' AND account_id='{$authId}' ");
  if($checkfavorite > 0){
  execute(" DELETE FROM favorite WHERE product_id='{$productId}' AND account_id='{$authId}' ");
  message('Removed From Favorite !!','danger');
  }
  }
  else {
   message('Wrong Id !!','danger');
  }
  redirect("favorite");
  }
?>


<?php
}else{
?>

<section class="caresection">  
<div class="container mycart"> 
     <h1 class="text-center " style="margin-top: 100px;">  <span style="color: #ff6c57;">E</span>mpty <i class="far fa-heart"></i></h1>
     </section>
     </div>

<?php
  }
  ?>


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


<?php
}
?>


<style>
.cartsection{
        position: relative;
        
    }
    .mycart{
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
        padding-bottom: 100px;
    }


.mecont{
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
      
      
    }
.error-template {padding: 40px 15px;text-align: center; }
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }

img{
        height: 300px!important;
        width: 100%;
   
    }
    .myfoods{
        padding-top: 120px;
    }
   .card{
     transition: transform 0.5s ease;
     border: none!important;
   }
    .card:hover{
        
        transform: translateY(-10px);
       
    }


</style>





<?php require_once("footer.php");?>

