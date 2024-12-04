<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark QR Menu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #333;
            color: #fff;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .category {
            cursor: pointer;
        }
        .category-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="logo">Dark QR Menu</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs" id="menu-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="food-tab" data-toggle="tab" href="#food" role="tab" aria-controls="food" aria-selected="true">Food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="drinks-tab" data-toggle="tab" href="#drinks" role="tab" aria-controls="drinks" aria-selected="false">Drinks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="desserts-tab" data-toggle="tab" href="#desserts" role="tab" aria-controls="desserts" aria-selected="false">Desserts</a>
                </li>
            </ul>
            <div class="tab-content" id="menu-tabContent">
                <div class="tab-pane fade show active" id="food" role="tabpanel" aria-labelledby="food-tab">
                    <h2 class="category-header">Main Dishes</h2>
                    <ul>
                        <li class="product">Makarna</li>
                        <li class="product">Chicken Biryani</li>
                        <li class="product">Beef Steak</li>
                    </ul>
                    <h2 class="category-header">Sandwiches</h2>
                    <ul>
                        <li class="product">Club Sandwich</li>
                        <li class="product">Grilled Chicken</li>
                        <li class="product">Veggie Delight</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="drinks" role="tabpanel" aria-labelledby="drinks-tab">
                    <h2 class="category-header">Soft Drinks</h2>
                    <ul>
                        <li class="product">Coca-Cola</li>
                        <li class="product">Pepsi</li>
                        <li class="product">Fanta</li>
                    </ul>
                    <h2 class="category-header">Juices</h2>
                    <ul>
                        <li class="product">Orange Juice</li>
                        <li class="product">Apple Juice</li>
                        <li class="product">Mango Juice</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="desserts" role="tabpanel" aria-labelledby="desserts-tab">
                    <h2 class="category-header">Cakes</h2>
                    <ul>
                        <li class="product">Chocolate Cake</li>
                        <li class="product">Vanilla Cake</li>
                        <li class="product">Red Velvet Cake</li>
                    </ul>
                    <h2 class="category-header">Pastries</h2>
                    <ul>
                        <li class="product">Croissants</li>
                        <li class="product">Danish Pastry</li>
                        <li class="product">Muffins</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
