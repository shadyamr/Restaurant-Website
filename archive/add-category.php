<?php
require 'components/main/connect.php';
?>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"><?php
require 'components/main/connect.php';
?>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        body{
            margin:0;
            padding:0;
        }
        #filters{
            margin-left: 10%;
            margin-top: 2%;
            margin-bottom: 2%;
        }
    </style>
</head>
<body>

    <div id="filters">
        <span>Fetch Resullt by &nbsp</span>
        <select name="fetchval" id="fetchval">

            <option value="" disabled="" selected="">Select category</option>
            <option value="Drinks">Drinks</option>
            <option value="Breakfast">Breakfast</option>
            <option value="Launch">Launch</option>
            <option value="Dinner">Dinner</option>
        </select>
    </div>

    <div class="containter">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <?php 

                $query="Select * FROM products";
                $result=mysqli_query($conn,$query);
                while($row=mysqli_fetch_assoc($result)){
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
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){//da al mas2ol 3an al fetch of specific category
            $("#fetchval").on('change',function(){
                var value=$(this).val();

                $.ajax({
                    url:"fetch.php",
                    type:"post",
                    data:'request=' + value,
                    beforesend:function(){
                        $(".container").html("<span>working...</span>");
                    },
                    success:function(data){
                        $(".container").html(data);
                    }

                });
            });

        });
    
    </script>
</body>
</html>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        body{
            margin:0;
            padding:0;
        }
        #filters{
            margin-left: 10%;
            margin-top: 2%;
            margin-bottom: 2%;
        }
    </style>
</head>
<body>

    <div id="filters">
        <span>Fetch Resullt by &nbsp</span>
        <select name="fetchval" id="fetchval">

            <option value="" disabled="" selected="">Select category</option>
            <option value="">Drinks</option>
            <option>Breakfast</option>
            <option>Launch</option>
            <option>Dinner</option>
        </select>
    </div>

    <div class="containter">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <?php 

                $query="Select * FROM products";
                $result=mysqli_query($conn,$query);
                while($row=mysqli_fetch_assoc($result)){
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
        </table>
    </div>
</body>
</html>
