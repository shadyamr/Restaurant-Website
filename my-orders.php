<?php
    require 'components/main/connect.php';
    
?>

<html>
<body>

<?php
    $sql="select * from orders";
    $results= mysqli_query($conn,$sql);
    $resultcheck = mysqli_num_rows($results);
    ?>

<table class="table">
    <?php
        if($resultcheck){
    ?>

    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php
        }else{
            echo "sorry no records found!";
        }
        ?>
    </thead>


    <tbody>
    <?php
    if($resultcheck>0){
        while($row = mysqli_fetch_assoc($results)){
            ?>
            <tr>
                <td><?php echo $row['order_name'] . "  "?></td>
                <td><?php echo $row['order_price'] . "  "?></td>
                <td><?php echo $row['order_quantity'] . "  " ?></td>
            </tr>
            <?php
            }
            ?>
    </tbody>
    
</table>
<a href="Payment.php" class="d-grid gap-2"><button type="submit" class="btn btn-success">Proceed to Payment!</button></a>
<?php
}
?>
<footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">Copyright &copy; 2022 Cairo GRND Restaurant</p>
    <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
</footer>
</body>
</html>