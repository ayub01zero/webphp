<?php
require_once("header.php");
?>

<?php
if(isAuth()){

  $ordercount = countData("SELECT * FROM orders WHERE account_id='$authId'");
  if($ordercount >0 )
{
 ?>

<div class="col-md-8 mx-auto text-center topof">
              
              <h1 style="color: #ff6c57;">Your Orders </h1>
              <p>  dear customer , if you have any problem in order list please warn us
                to solve your problem , foodorder always with you so enjoin you moments  </p>
          </div>
<div class="table table-responsive col-lg-8 col-md-8 col-sm-4 m-auto p-3 mt-5" >
<table class="table text-center text-dark p-5 col-lg-8 " >
              <thead>
                <tr>
                  <th>Product</th>
                  <th>customer</th>
                  <th>price</th>
                  <th>quantity</th>
                  <th>total</th>
                  <th>address</th>
                  <th>ordernumber</th>
                  <th>date</th>
                </tr>
              </thead>
              <tbody>
                <?php

$total = 0;
$orders = allData(" SELECT * FROM orders WHERE account_id='$authId' ORDER BY order_id DESC ");
foreach($orders as $allproduct){
$order = $allproduct['order_id'];
$productid = $allproduct['product_id'];
$userid = $allproduct['account_id'];
$price = $allproduct['price'];
$qty = $allproduct['order_qty'];
$amount = $allproduct['amount'];
$number = $allproduct['ordernumber'];
$date = $allproduct['date'];
$getproduct =  findData(" SELECT * FROM products WHERE product_id='{$productid}' ");
$productname = $getproduct['productname'];
$getuser =  findData(" SELECT * FROM accounts WHERE account_id='{$userid}' ");
$username = $getuser['account_name'];
$address = $getuser['account_address'];
?>


                <tr>
                
      <td><?php  echo $productname  ?></td>
      <td><?php  echo $username  ?></td>
      <td>$<?php  echo $price  ?></td>
      <td><?php  echo $qty ?></td>
      <td>$<?php  echo $amount  ?></td>
      <td><?php  echo $address  ?></td> 
      <td><span class="badge bg-primary">#<?=$number;?></span></td>
      <td><?php  echo $date  ?></td>
      
                </tr>

                <?php

}
?>



              </tbody>
            </table>
          </div>

<style>
.topof{
    margin-top: 100px;
}
</style>

<?php
}else{
?>

<section class="caresection">  
<div class="container mycart"> 
     <h1 class="text-center " style="margin-top: 100px;">  <span style="color: #ff6c57;">E</span>mpty <i class="fa-solid fa-bag-shopping"></i></h1>
     </section>
     </div>

<?php
  }


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


</style>



<?php
require_once("footer.php");
?>