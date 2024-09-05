<?php
require_once('dashhead.php');
?>




                <section id="contact " class="mt-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 mx-auto text-center">
                   
                    <h1>Add Products</h1>
                    <p>Adding food to your website is a great way to showcase your culinary creations and attract customers. Use high-quality images and engaging descriptions, and provide information about ingredients and nutritional value. </p>
                </div>
            </div>

            <form action="addproducts.php" method="POST" role="form" enctype="multipart/form-data" class="row g-3 justify-content-center">
                <div class="col-md-5" >
                    <input type="text" required class="form-control shadow" name="productname"  placeholder="Product Name">
                </div>
                <div class="col-md-5">
                    <input type="text" required class="form-control shadow"  name="productprice"  placeholder="Product Price">
                </div>
                <div class="col-md-5">
                    <input type="text" required class="form-control shadow" placeholder="Product quantity" name="productquantity">
                </div>
                <div class="col-md-5">
                    <input required class="form-control shadow"  type="file"  name="image"  placeholder="Image" multiple></input>
                </div>
                <div class="col-md-10">
                <textarea  maxlength="200" style="background-color: white;" class="form-control shadow mb-2" name="description" placeholder="product description" required></textarea>                </div>
                <div class="col-md-10 d-grid">
                    <button type="submit" class="btn btn-dark" name="addproducts">Add item</button>
                </div>
            </form>

        </div>
    </section>



<?php
if (isset($_POST['addproducts'])) {
    $productname = request($_POST['productname']);
    $productprice = request($_POST['productprice']);
    $productquantity = request($_POST['productquantity']);
    $description = request($_POST['description']);
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    execute(" INSERT INTO products(productname,p_image,productprice,productquantity,description) 
    VALUES('{$productname}','{$file}','{$productprice}','{$productquantity}','{$description}') ");
    message('Created!!','success');
    redirect('dashboard');
    }
    ?>
    

    <?php
require_once('dashfoot.php');
?>


