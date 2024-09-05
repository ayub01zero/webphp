<?php
require_once('dashhead.php');
?>

<?php
                if(isset($_GET['editproduct'])) {
$productId = request($_GET['editproduct']);
$checkProduct  = countData(" SELECT * FROM products WHERE product_id='{$productId}' ");
if($checkProduct < 1 ){
redirect('dashboard');
}
else {
$getProduct  = findData(" SELECT * FROM products WHERE product_id='{$productId}' ");
?>
 
 <section id="contact" class="mt-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 mx-auto text-center">
                    
                    <h1>Update products</h1>
                    <p>hey admin you can update here any problem contact with ayooooo</p>
                </div>
            </div>

            <form action="dashboard.php" method="post" class="row g-3 justify-content-center">
                <div class="col-md-5">
                    <input type="text" class="form-control shadow" readonly name="productid" value="<?=$getProduct['product_id']."-ID";?>" placeholder="Id">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control shadow"  name="productname" value="<?=$getProduct['productname'];?>" placeholder="name">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control shadow"  name="productprice" value="<?=$getProduct['productprice'];?>" placeholder="price">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control shadow" name="productquantity" value="<?=$getProduct['productquantity'];?>" placeholder="qty">
                </div>
                <div class="col-md-10">
                    <input  name="description" value="<?=$getProduct['description'];?>" cols="20" rows="5" class="form-control shadow"
                        placeholder="product description"></input>
                </div>
                <div class="col-md-10 d-grid">
                    <button name="updateproduct" type="submit" class="btn btn-dark">Update product</button>
                </div>
            </form>

        </div>
    </section>

<?php
}
}
?>

<div class="table table-responsive col-lg-8 col-md-8 col-sm-6 m-auto p-3 mt-5 " >
<table class="table text-center text-dark p-5 col-lg-8 bg-white rounded shadow-sm  table-hover mytable" >
    <tr>
        <th >#</th>
        <th>name</th>
        <th>price</th>
        <th>quantity</th>
        <th>action</th>
    </tr>
    <?php 
$allproducts = allData(" SELECT * FROM products ORDER BY product_id DESC ");
foreach($allproducts as $product){
?>
     <tr>

        <td><?=$product["product_id"];?></td>
        <td><?=$product["productname"];?></td>
        <td><?=$product["productprice"];?></td>
        <td><?=$product["productquantity"];?></td>
       
        

        <td >
            <a style="text-decoration: none!important;color:black;" href="dashboard?editproduct=<?=$product["product_id"];?>">  <i class="fas fa-edit p-2"></i> </a>
            <a style="color: black;" href="dashboard?deleteproduct=<?=$product["product_id"];?>">  <i class="fas fa-trash-alt"></i> </a>
        </td>

    </tr>
    <?php

}
?>
</table>
</div>
    
<?php


if (isset($_POST['updateproduct'])) {
    $productid = request($_POST['productid']);
    $productname = request($_POST['productname']);
    $productprice = request($_POST['productprice']);
    $productquantity = request($_POST['productquantity']);
    $description = request($_POST['description']);
    execute(" UPDATE products SET 
    productname='{$productname}' , productprice='{$productprice}' , productquantity='{$productquantity}' , description='{$description}' 
    WHERE product_id='{$productid}'  ");
    message('Updated!!','warning');
    redirect('dashboard');
    }




if (isset($_GET['deleteproduct'])) {
    $productId = request($_GET['deleteproduct']);
    $checkProduct  = countData(" SELECT * FROM products WHERE product_id='{$productId}' ");
    if($checkProduct > 0){
    execute(" DELETE FROM products WHERE product_id='{$productId}' ");
    message('Deleted!!','danger');

    }
    redirect('dashboard');
    }

    ?>

<?php
require_once('dashfoot.php');
?>