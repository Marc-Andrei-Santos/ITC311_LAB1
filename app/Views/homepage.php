<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LAB 1 - CRUD</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <style>

        body {
            background-color: black;
        }

        .container {
            background-color: lightgray;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center; 
        }

        h3 {
            color: #333;
        }

        .form-control {
            margin-bottom: 10px;
        }

        select.form-select {
            width: 60%;
        }

        .table {
            margin-top: 20px;
        }

        ul {
            list-style-type: circle;
            margin: 0;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

      
        .btn-primary {
            background-color: green;
            border-color: green;
            margin-right: 10px;
        }

        .btn-danger {
            background-color: red;
            border-color: red;
        }
        th {
            font-weight: bold;
        }

        th.controls {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Laboratory #1 - CRUD</h3>
		<br>
		<br>
        <form action="/insert" method="post">
            <input type="hidden" name="ID" value="<?= isset($user['ID']) ? $user['ID'] : '' ?>">
            <div class="row">
               
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="ProdName" class="form-label"><b>Name</b></label>
                        <input type="text" class="form-control" name="ProdName" id="ProdName" placeholder="Enter Name" value="<?= isset($user['ProductName']) ? $user['ProductName'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ProdDesc" class="form-label"><b>Product Description</b></label>
                        <input type="text" class="form-control" name="ProdDesc" id="ProdDesc" placeholder="Enter Description" style="height: 100px;" value="<?= isset($user['ProductDescription']) ? $user['ProductDescription'] : '' ?>">
                    </div>
                </div>

              
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ProdCat" class="form-label"><b>Product Category</b></label>
                            <input type="text" class="form-control" name="ProdCat" id="ProdCat" placeholder="Enter New Category" value="<?= isset($user['ProductCategory']) ? $user['ProductCategory'] : '' ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="SelectProdCat" class="form-label"><b>Select Category</b></label>
                            <select class="form-select d-inline-block ml-2" name="SelectProdCat" id="SelectProdCat">
                                <?php
                                foreach ($activity as $us) {
                                    echo "<option>{$us['ProductCategory']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <script>
                        document.getElementById('SelectProdCat').addEventListener('change', function() {
                            var selectedValue = this.value;
                            document.getElementById('ProdCat').value = selectedValue;
                        });
                    </script>

                    <div class="mb-3">
                        <label for="ProdQuan" class="form-label"><b>Product Quantity</b></label>
                        <input type="text" class="form-control" name="ProdQuan" id="ProdQuan" placeholder="Enter Quantity" value="<?= isset($user['ProductQuantity']) ? $user['ProductQuantity'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ProdPr" class="form-label"><b>Product Price</b></label>
                        <input type="text" class="form-control" name="ProdPr" id="ProdPr" placeholder="Enter Price" value="<?= isset($user['ProductPrice']) ? $user['ProductPrice'] : '' ?>">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/activity" class="btn btn-danger">New Product</a>
        </form>

        <div class="mt-5">
            <br>
            <select class="form-select d-inline-block ml-2" id="categoryFilter">
                <option value="All">All</option> 
                <?php
                foreach ($activity as $us) {
                    echo "<option>{$us['ProductCategory']}</option>";
                }
                ?>
            </select>
        </div>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th><b>Name</b></th>
                    <th><b>Product Description</b></th>
                    <th><b>Product Category</b></th>
                    <th><b>Product Quantity</b></th>
                    <th><b>Product Price</b></th>
                    <th class="controls"><b>Edit</b></th>
                    <th class="controls"><b>Delete</b></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($activity as $us): ?>
                    <tr data-category="<?= $us['ProductCategory'] ?>">
                        <td><?= $us['ID'] ?></td>
                        <td><?= $us['ProductName'] ?></td>
                        <td><?= $us['ProductDescription'] ?></td>
                        <td><?= $us['ProductCategory'] ?></td>
                        <td><?= $us['ProductQuantity'] ?></td>
                        <td><?= $us['ProductPrice'] ?></td>
                        <td>
                            <a href="/edit/<?= $us['ID']?>" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <a href="/delete/<?= $us['ID']?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <script>
            document.getElementById('categoryFilter').addEventListener('change', function() {
                var selectedCategory = this.value;
                var rows = document.querySelectorAll('tbody tr');
                rows.forEach(function(row) {
                    var rowCategory = row.getAttribute('data-category');
                    if (selectedCategory === 'All' || selectedCategory === rowCategory) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>

        <div class="mt-5">
            <h3 class="d-inline-block">Product List</h3>
            <br>
            <br>
            <ul style="list-style-type:circle">
                <?php foreach ($activity as $us): ?>
                    <li><b>ID: </b><?= $us['ID'] ?></li>
                    <li><b>Name: </b><?= $us['ProductName'] ?></li>
                    <li><b>Product Description: </b><?= $us['ProductDescription'] ?></li>
                    <li><b>Product Category: </b><?= $us['ProductCategory'] ?></li>
                    <li><b>Product Quantity: </b><?= $us['ProductQuantity'] ?></li>
                    <li><b>Product Price: </b><?= $us['ProductPrice'] ?></li>
                    <li>
                        <a href="/edit/<?= $us['ID']?>" class="btn btn-primary">Edit</a>
                        <a href="/delete/<?= $us['ID']?>" class="btn btn-danger">Delete</a>
                    </li>
                    <br>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
