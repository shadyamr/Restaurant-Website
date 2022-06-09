<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<?php
require 'components/main/connect.php';


if(isset($_post['request'])){
    $request = $_POST['request'];
    $query="select * FROM products WHERE cat_id = '$request'";
    $result = mysqli_query($conn,$query);
    $count = mysqli_num_rows($result);

?>

<table class="table">
    <?php
        if($count){
    ?>

    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
        <?php
        }else{
            echo "sorry no records found!";
        }
        ?>
    </thead>

    <tbody>
        <?php
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                <td><img src="./components/assets/img/uploads/<?php echo $row['image'] ?>"class="img-responsive" width="150"></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['price'] ?></td>
            </tr>
            <?php
            }
            ?>
    </tbody>
</table>
<?php
}
?>