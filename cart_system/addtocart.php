<?php
    session_start();
    $product_key=array();
    session_destroy();

    if(filter_input(INPUT_POST,'add_to_cart')){
        if(isset($_SESSION['shopping_cart'])){

        }else{
            $_SESSION['shopping_cart'][0]=array(
                'id' => filter_input(INPUT_GET,'id'),
                'name' => filter_input(INPUT_POST,'name'),
                'price' => filter_input(INPUT_POST,'price'),
                'quantity' => filter_input(INPUT_POST,'quantity'),
            );
        }
    }
    pre($_SESSION);

    function pre($array){
        echo'<pre>';
        print_r($array);
        echo'</pre>';

    }
?>



<html>

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="addtocart.css">

</head>
<body>
    <div class="container">
    <?php
    
    $connectcart = mysqli_connect('localhost','root','','restaurant');
    $query = 'select * from products order by id ASC';
    $result = mysqli_query($connectcart,$query);

    if($result){
        if(mysqli_num_rows($result)>0){
            while($products=mysqli_fetch_assoc($result)){
            ?>
            <div class="col-sm-4 col-md-3">
                <form method="post" action="addtocart.php?action=add&id=<?php echo $products['id']; ?>">
                    <div class="products">
                        <img src="./assets/img/uploads/<?php echo $products['image']; ?>"class="img-responsive" width="200"/>
                        <h4 class="text-info"><?php echo $products['name']; ?></h4>
                        <h4><?php echo $products['price']; ?></h4>
                        <input type="text" name="quantity" class="form-control" value="1" />
                        <input type="hidden" name="name" value="<?php echo $products['name']; ?>" />
                        <input type="hidden" name="price" value="<?php echo $products['price']; ?>" />
                        <input type="submit" name="add_to_cart" style="margin-top=5px;" class="btn btn-info" value="add to cart" />
                    </div>
                </form>
            </div>
            <?php
            }
        }

    }


    ?>
    </div>

</body>
</html>



