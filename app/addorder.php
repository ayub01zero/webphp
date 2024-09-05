<?php
require_once("header.php");
?>

<?php
if(isAuth()){
?>



<?php   
$productId = request($_GET['product_id']);
$sql = " SELECT * FROM products WHERE product_id='{$productId}' ";
$checkproduct  = countData($sql);

$getproduct  = findData($sql);
if($checkproduct == 0){
redirect('home');
}

?>

<div class="container-fluid col-lg-8 col-sm-8 col-md-10 mt-3 pt-4 myaddorder ">
<div class="row bg-white shadow rounded text-dark rounded p-2 m-2 text-center mt-5 myaddform" > 
<button class="btn btn-danger text-light p-1 m-1" style="width:50px;"
onclick="window.history.back()">
<span class="fa fa-arrow-left"></span>
</button>

<div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto text-center">
<h3><span  style="color:#4eb060;"> Yala </span>  <span style="color: #ff6c57;">Order Now</span> </h3> 
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto text-center">
    <?php
      messagebox();
    ?>
</div>

<hr>


<div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 m-auto text-center mt-2">
<form action="addorder?product_id=<?=$productId;?>" method="POST" class=" p-2 rounded text-center">

<div class="form-group mb-2 text-start">
<label for="orderNumberLabel"> Order Number</label>
<input type="text" min="1" name="number" class="form-control mb-3" id="orderNumberLabel" readonly 
value="<?=uniqid();?>" required>
</div>


<div class="form-group mb-2 text-start">
<label for="priceLabel"> Price</label>
<input type="number" min="1" name="price" step="any" class="form-control mb-3" id="priceLabel" readonly 
value="<?=$getproduct['productprice'];?>" required>

</div>


<div class="form-group mb-2 text-start">
<label for="quantityLabel"> Quantity</label>
<input type="number" min="1" value="0" name="qty" class="form-control mb-3" id="quantityLabel" 
placeholder="Enter Quantity" required>
</div>



<button style="width: 200px;height:50px; color:#4eb060;" class="btn btn-dark btn-lg mb-2 mt-3" name="addorder"> 
<span class="fa fa-shopping-cart"></span> Order
</button>
</form> 
</div>




<div class="col-12 col-sm-112 col-md-6 col-lg-6 col-xl-4 m-auto text-center mt-2 p-2 rounded">

<?php echo '<img src="data:image;base64,'.base64_encode($getproduct['P_image']).'" style="width:100%;height:200px;  object-fit:contain  "  class="card-img"  >';   ?> 


<h4 class="mt-3" style="font-size: 20px;"><?=$getproduct['description'];?></h4>
</div>
</div>
</div>


<?php 

if (isset($_POST['addorder'])) {
$number = request($_POST['number']);
$price = request($_POST['price']);
$qty = request($_POST['qty']);
$amount = (double)$price * (double)$qty;

$date = date('Y-m-d h-i-s');
if($qty > $getproduct['productquantity']) {
message('Enough Quantity Is Not Exist From Store','warning');
redirect('addorder?product_id='.$productId);
}
else {
execute(" INSERT INTO orderlist(ordernumber,product_id,account_id,price,qty,amount,date) 
VALUES('{$number}','{$productId}','{$authId}','{$price}','{$qty}','{$amount}','{$date}') ");

help($authId);

execute(" UPDATE products SET productquantity=productquantity-'$qty'  WHERE product_id='$productId'");
message('Add to cart','success');
}

redirect('foods');
}   
?>

<?php
}else{
    ?>


<div class="container mecont">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1 class="text-light">
                    Oops!</h1>
                <h2 class="text-light">
                    404 Not Found</h2>
                <div class="error-details text-light">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div class="error-actions ">
                    <a href="home" class="btn btn-light btn-lg "><span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a><a  href="contactus" class="btn btn-default btn-lg text-light"><span class="glyphicon glyphicon-envelope "></span> Contact Support </a>
                </div>
            </div>
        </div>
    </div>
</div>


  <?php
}
?>



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

input{
    
    border: 2px solid #4eb060!important;
    box-shadow: none!important;
    border-radius: 60px!important;
}
.myaddorder{

    margin-top: 80px!important;

}
@media screen and (max-width: 768px) {
   
    .myaddorder{

margin-top: 30px!important;
padding-bottom: 15px!important;

}
}
body{
    height: auto;
}



</style>




<?php
require_once("footer.php");
?>
