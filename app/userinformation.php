<?php
require_once('dashhead.php');
?>



<?php
                if(isset($_GET['orderdetails']))
{
    $thisis = $_GET['orderdetails'];
       $find =findData("SELECT account_name FROM accounts WHERE account_id = '{$thisis}' ");
      //  $read = countData("SELECT * FROM orders WHERE account status = 0");
       $userhead = $find['account_name'];
     
     ?>
     <br><br><br>
<div class="container col-lg-12 ">
<div class="container   text-light  col-lg-6 ">

    <h6 class="display-6 text-dark text-center"> <?php echo $userhead."  orders";  ?></h6>

    </div>
    <hr>
   </div>
<?php
}
?>


                <?php

if(isset($_GET['orderdetails'])){
 $user = $_GET['orderdetails'];

 $checkuser  = countData("SELECT * FROM orders WHERE account_id = '{$user}'");

 
 if($checkuser == 0){
    ?>
<script>
   window.location.replace("userinformation.php")
       alert("Sorry This user Not Found In Orders")
</script>
<?php

 }else{
    ?>
             <div class="table table-responsive col-lg-8 col-md-8 col-sm-6 m-auto p-3 mt-2" >
<table class="table text-center text-dark p-5 col-lg-8 bg-white rounded shadow-sm  table-hover " >
      <thead>
        <tr>

          <th scope="col">#</th>
          <th scope="col">Product</th>
          <th scope="col">Customer</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
          <th scope="col">Amount</th>
          <th scope="col">Address</th>
          <th scope="col">Ordernumber</th>
          <th scope="col">Date</th>
        
        </tr>
      </thead>
      <tbody>
        <?php

$orders = allData(" SELECT * FROM orders WHERE account_id='$user' ORDER BY order_id DESC ");
foreach($orders as $allproduct){

$status = $allproduct['status'];
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

  <?php
  if($status == 0 ){
?>

<tr class="bg-danger">
    <th scope="col"> <?php  echo $order ?> </th>
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
  }else{
?>
    <tr>
    <th scope="col"> <?php  echo $order ?> </th>
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
 
<?php
  execute("UPDATE orders SET status = 1 WHERE account_id = '{$user}' ");
 }
?>

  </tbody>
    </table>
  </div>
 


<?php

}
}else{
?>

          
                <div class="table table-responsive col-lg-8 col-md-8 col-sm-6 m-auto p-3 mt-5" >
<table class="table text-center text-dark p-5 col-lg-8 bg-white rounded shadow-sm  table-hover " >
      <thead>
        <tr>

          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone_num</th>
          <th scope="col">Address</th>
          <th scope="col">Roll</th>
          <th scope="col">Actions</th>
     
        </tr>
      </thead>
      <tbody> 
      <?php
    



  

    $countread = 0;

     $users = allData(" SELECT * FROM accounts ORDER BY account_id DESC");
     foreach($users as $allueser) {
      $userid = $allueser['account_id'];
  $allread = countData("SELECT * FROM orders WHERE account_id='{$userid}' AND status = 0");
      
  ?>
  <tr>
          
          <td><?php echo $allueser['account_id']  ?></td>
          <td>  <?php echo $allueser['account_name']  ?>   </td>
          <td>  <?php echo $allueser['account_email']  ?>   </td>
          <td>  <?php echo $allueser['account_phoneno']  ?>   </td>
          <td>   <?php echo $allueser['account_address']  ?>  </td>
          <td>   <?php echo $allueser['account_roll']  ?>  </td>
          <td><a href="userinformation?orderdetails=<?=$allueser["account_id"];?>" class="btn btn-success btn-sm">Orders <span class="text-light"> <?php  echo $allread; ?></span></a>      </td>
        
        </tr>
        <?php
     }
  ?>
        
      </tbody>
    </table>
  </div>
  
  <?php
}
    ?>



<?php
require_once('dashfoot.php');
?>
