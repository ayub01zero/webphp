<?php
require_once("header.php");
?>

<?php
  if (isset($_GET['addtofavorite'])) {
  $productId = request($_GET['addtofavorite']);
  $checkProduct  = countData(" SELECT * FROM products WHERE product_id='{$productId}' ");
  if($checkProduct > 0){
    $checkfavorite = countData(" SELECT * FROM favorite WHERE 
  product_id='$productId' AND account_id='{$authId}' ");
  if( $checkfavorite > 0){
  message('Already Added !!','warning');

  }
  else {
  execute(" INSERT INTO favorite(product_id,account_id) VALUES('{$productId}','{$authId}'); ");
  message('Added To Favorite !!','success');
  }
  }
  else {
   message('Wrong Id !!','danger');
  }
  redirect("foods");
  }
  
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
    redirect("foods");
    }

?>
<div class="container myfoods">
<div class="row  d-flex justify-content-center align-items-center ">
<div class="col-md-6 col-12 col-lg-8">
    <form class="form mb-4 " action="foods.php" method="get">
        <input type="text"  id="search" name="search" class="form-control form-input meinput w-50 text-center m-auto"
        value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" placeholder="Search for products">
  </form>
</div>
</div>
 <div class="row g-3">

<?php 
if (isset($_GET['search'])) {
$search = $_GET['search'];
$allproducts = allData(" SELECT * FROM products WHERE productname LIKE '%".$search."%' ");
}else{
  $allproducts = allData(" SELECT * FROM products ORDER BY product_id DESC ");
}
foreach($allproducts as $product){

  $pid = $product['product_id'];
  ?>
            <div class="col-12 col-md-6 col-lg-4 ">
                <div class="card">
                   
                <?php echo '<img src="data:image;base64,'.base64_encode($product['P_image']).'" class="rounded">';   ?>     
                    <div class="card-body">
                    <h5 class="card-title"><?=$product["productname"];?></h5>
                 <p class="card-text"><?=$product["description"];?></p>
                 <?php   
     if(isAuth()){
if($authroll !='admin'){
?>
 <a style="background-color:#4eb060;" href="addorder?product_id=<?=$product['product_id'];?>"  class="btn btn-outline text-light btn-sm bold">Order</a>
 <?php
$chechisfav = countData("SELECT * FROM favorite WHERE product_id='$pid' AND account_id='$authId'");
if($chechisfav > 0){
 ?>
<a style="background-color:#ff6c57;" href="foods?removetofavorite=<?=$product['product_id'];?>" class="btn  btn-sm text-light"><i class="fa-solid fa-xmark"></i></a>
<?php
}else{
?>
<a style="background-color:#ff6c57;" href="foods?addtofavorite=<?=$product['product_id'];?>" class="btn btn-outline btn-sm text-light"><i class="far fa-heart"></i></a>
<?php
}
?>
<?php
}
else{
  ?>
<button readonly class="btn btn-outline-success btn-sm">Admin <i class="fa-solid fa-hammer"></i></button> 
<?php
}
}else{
  ?>

<a href="login" class="btn btn-outline text-danger btn-sm">please login to get the food</a>

<?php
}
?>
<button  style="background-color:#ff6c57;"  class="btn  btn-sm text-light "><?=$product["productprice"];?> $</i></button>
                 
                    </div>
                </div>
            </div>

<?php
}
?>

        </div>
    </div>

    

<style>
    img{
        height: 300px!important;
        width: 100%;
   
    }
    .myfoods{
        padding-top: 120px;
    }
   .card{
   margin-top: 20px!important;
    height: 500px!important;
     transition: transform 0.5s ease;
     border: none!important;
     box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;
   }
    .card:hover{
        
        transform: translateY(-10px);
       
    }

    .meinput{
      height: 30px!important;
      border: none!important  ;
      box-shadow: none!important;
      transition: .7s ease-in-out;
    }
    .meinput:hover{
    font-size: 20px!important;
    color: #4eb060; 
    }

</style>

<?php
require_once("footer.php");
?>
