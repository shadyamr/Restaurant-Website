<?php
    session_start();
    $product_key=array();

    if(filter_input(INPUT_POST,'add_to_cart')){
        if(isset($_SESSION['shopping_cart'])){
            $count=count($_SESSION['shopping_cart']);

            $product_id=array_column($_SESSION['shopping_cart'],'id');

            if(!in_array(filter_input(INPUT_GET,'id'),$product_id)){
                $_SESSION['shopping_cart'][$count]=array(
                'id' => filter_input(INPUT_GET,'id'),
                'name' => filter_input(INPUT_POST,'name'),
                'price' => filter_input(INPUT_POST,'price'),
                'quantity' => filter_input(INPUT_POST,'quantity'),
                );
            }
            else{
                for($i = 0 ; $i < count($product_id) ; $i++){
                    if($product_id[$i] == filter_input(INPUT_GET , 'id')){
                        $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST,'quantity');
                    }
                }
            }
        }else{
            $_SESSION['shopping_cart'][0]=array(
                'id' => filter_input(INPUT_GET,'id'),
                'name' => filter_input(INPUT_POST,'name'),
                'price' => filter_input(INPUT_POST,'price'),
                'quantity' => filter_input(INPUT_POST,'quantity'),
            );
        }
    }

    if(filter_input(INPUT_GET,'action') == 'delete'){
        foreach($_SESSION['shopping_cart'] as $product_key => $products){
            if($products['id'] == filter_input(INPUT_GET,'id')){
                unset($_SESSION['shopping_cart'][$product_key]);
            }
        }
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
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
                        <center><h4 class="text-info"><?php echo $products['name']; ?></h4>
                        <h4><?php echo $products['price']; ?></h4></center>
                        <input type="text" name="quantity" class="form-control" value="1" />
                        <input type="hidden" name="name" value="<?php echo $products['name']; ?>" />
                        <input type="hidden" name="price" value="<?php echo $products['price']; ?>" />
                        <center><input type="submit" name="add_to_cart" style="margin-top: 5px;" class="btn btn-info" value="add to cart" /></center>
                    </div>
                </form>
            </div>
            <?php
            }
        }

    }
    ?>
    <div style="clear:both"></div> 
    <br />
    <?php if(!count($_SESSION['shopping_cart']) == 0):?>
    <div class="table-responsive">
        <table class="table">
            <tr><th colspan="5"><h3>Order Details</h3></th></tr>
            <tr>
                <th width="40%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>   
                <th width="5%">Action</th>
            </tr>
            <?php
                if(!empty($_SESSION['shopping_cart'])){
                    $total=0;

                    foreach($_SESSION['shopping_cart'] as $product_key => $products);
                }
            ?>
            <tr>
                <td><?php echo $products['name']; ?></td>
                <td><?php echo $products['quantity']; ?></td>
                <td><?php echo $products['price']; ?></td>
                <td><?php echo number_format($products['quantity'] * $products['price'],2); ?></td>
                <td><a href="addtocart.php?action=delete&id=<?php echo $products['id']; ?>">
                        <div class="btn btn-danger">Remove</div>
                    </a>
                </td>
            </tr>
            <?php
                $total += $products['quantity'] * $products['price'];
            ?>
            <tr>
                <td colspan="3" align="right">total</td>
                <td align="right"><?php echo number_format($total,2); ?> </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5">
                    <?php
                        if(isset($_SESSION['shopping_cart'])):
                        if(count($_SESSION['shopping_cart'])>0):
                    ?>
                    <a href="#" class="btn btn-primary">Checkout</a>
                    <?php endif;endif; ?>
                </td>
            </tr>
        </table>
    </div>
    <?php endif;?>
</body>
</html>