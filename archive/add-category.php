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
        </table>
    </div>
</body>
</html>