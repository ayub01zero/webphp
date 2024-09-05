<?php
require_once("header.php");
?>

<head><link rel="stylesheet" href="../css/cart.css"></head>

<?php
if(isAuth()){
  if(help($authId) > 0 )
  {
?>


<section id="hero" class="d-flex align-items-center justify-content-center ">
    <div class="container  text-light ">
      <div class="row">
        <div class="hiddenn col-lg-5 pt-4 pt-lg-0 mt-4  d-flex flex-column justify-content-center ">
          <h1>Shopping cart <i class="fa-solid fa-cart-arrow-down"></i></i></h1>
          <h2> Hello dear customer in this page you can see the foods that have decided to buy , please be careful not to cancel the request</h2>
        </div>
        <div class="col-lg-7 order-1 order-lg-2 hero-table ">

<div class=" table-responsive col-lg-8 col-md-8 col-sm-8 m-auto p-3 mt-5 text-center" >
<table class="table text-center text-dark p-5 col-lg-8 " >
      <thead>
        <tr>
  
          <th scope="col">Product</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
          <th scope="col">Amount</th>
          <th scope="col">Remove</th>
         
        </tr>
      </thead>
      <tbody>


      <?php 
      $alltotal=0;
    $sum =0;
    $delivery = 3.5;
    $counternum=0;
    $prolist = allData("SELECT * FROM orderlist WHERE account_id ='$authId'");
foreach ($prolist as  $listback) {
  $myorder = $listback['Orderlist_id'];
  $pro_id  = $listback['product_id'];
  $amount  = $listback['amount'];
  $price  = $listback['price'];
  $qty  = $listback['qty'];
  $ordernumber  = $listback['ordernumber'];
  
  $sum+=$amount;
  $alltotal = $sum+$delivery;
   $findpro =  findData("SELECT productname FROM products WHERE product_id='$pro_id'");
   $proname = $findpro['productname'];
   $counternum++;
  ?>
<tr>  
              <td><?php echo " $proname" ; ?></td>
              <td><?php echo "$price$";?></td>
              <td><?php echo"$qty X" ?></td>
            <td> <?php echo "$amount$";?></td>
      <td><a   href="cart?dellist=<?=$listback['Orderlist_id'];?>" class=" btn "><i class="fa fa-solid fa-trash mb-3"></i></a></td>  
    </tr>
   
<?php
}
?>

  </tbody>
    </table>
  </div>
  <form class="col-lg-6 m-auto" method="POST" action="cart.php">
         
          <div >
          <ul class="list-unstyled mb-4 text-dark">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>$<?php echo$sum ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Delivery</strong><strong>$<?php echo$delivery ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Discount</strong><strong>$0.00</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                <h5 class="font-weight-bold">$<?php echo$alltotal ?></h5>
              </li>
            </ul><button type="submit" name="orderuser" class="button-49">Procceed to checkout</button>
          </div>
         </form>
        </div>
      </div>
    </div>
  </section>


  <?php

if (isset($_GET['dellist'])) {
  $orderdel = request($_GET['dellist']);
  $product = findData("SELECT * FROM orderlist WHERE Orderlist_id = $orderdel");
  $Orderlistid = $product['Orderlist_id'];
    execute(" DELETE FROM orderlist WHERE  Orderlist_id = $Orderlistid");
  redirect('cart');
  }     

if(isset($_POST['orderuser'])){

  $swap = allData("SELECT * FROM orderlist WHERE account_id='$authId'");
  foreach($swap as $allswap){
   
    $userorder = $allswap['account_id'];
    $productorder = $allswap['product_id'];
    $orderprice = $allswap['price'];
    $orderqty = $allswap['qty'];
    $order_ordernumber = $allswap['ordernumber'];
    $order_amount = $allswap['amount'];
    // $order_date = $allswap['date'];
 

    execute(" INSERT INTO orders (ordernumber,product_id,account_id,price,order_qty,amount,date) 
VALUES('{$order_ordernumber}','{$productorder}','{$userorder}','{$orderprice}','{$orderqty}','{$order_amount}',NOW()) ");
   


  }
  execute("DELETE FROM orderlist WHERE account_id='$userorder'");
  message('Order Added','success');
  redirect('orders.php');
}
  }else{
?>

<section class="caresection">  
<div class="container mycart"> 
     <h1 class="text-center " style="margin-top: 100px;">  <span style="color: #ff6c57;">E</span>mpty <i class="fa fa-cart-shopping"></i></h1>
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





<?php
require_once("footer.php");
?>

