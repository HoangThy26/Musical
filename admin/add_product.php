<?php
include '../lib/session.php';
include '../classes/product.php';
include '../classes/categories.php';
Session::checkSession('admin');
$role_id = Session::get('role_id');
if ($role_id == 1) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $product = new product();
        $result = $product->insert($_POST, $_FILES);
    }
} else {
    header("Location:../index.php");
}

$category = new categories();
$categoriesList = $category->getAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://use.fontawesome.com/2145adbb48.js"></script>
    <script src="https://kit.fontawesome.com/a42aeb5b72.js" crossorigin="anonymous"></script>
    <title>Add new products</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">ADMIN</label>
        <ul>
            <li><a href="productlist.php" class="active">Product Management</a></li>
            <li><a href="categoriesList.php" >Manage categories</a></li>
            <li><a href="orderlist.php">Order Management</a></li>
        </ul>
    </nav>
    <div class="title">
        <h1>Add new products</h1>
    </div>
    <div class="container">
        <p style="color: green;"><?= !empty($result) ? $result : '' ?></p>
        <div class="form-add">
            <form action="add_product.php" method="post" enctype="multipart/form-data">
                <label for="name">Name product</label>
                <input type="text" id="name" name="name" placeholder="Name.." required>

                <label for="originalPrice">Cost</label>
                <input type="number" id="originalPrice" name="originalPrice" placeholder="Price.." required min="1">

                <label for="promotionPrice">Promotion price</label>
                <input type="number" id="promotionPrice" name="promotionPrice" placeholder="Price.." required min="1">

                <label for="image">Picture</label>
                <input type="file" id="image" name="image" required>

                <label for="cateId">Product Type</label>
                <select id="cateId" name="cateId">
                    <?php
                    foreach ($categoriesList as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php }
                    ?>
                </select>

                <label for="qty">Quantity</label>
                <input type="number" id="qty" name="qty" required min="1">

                <label for="des">Describe</label>
                <textarea name="des" id="des" cols="30" rows="10" required></textarea>

                <input type="submit" value="Submit" name="submit">
            </form>
        </div>
    </div>
    </div>
    <footer>
        <p class="copyright">STORENOW @ 2021</p>
    </footer>
</body>

</html>