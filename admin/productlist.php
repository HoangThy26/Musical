<?php
include '../lib/session.php';
include '../classes/product.php';
Session::checkSession('admin');
$role_id = Session::get('role_id');
if ($role_id == 1) {
    # code...
} else {
    header("Location:../index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new product();
    if (isset($_POST['block'])) {
        $result = $product->block($_POST['id']);
        if ($result) {
            echo '<script type="text/javascript">alert("Khóa sản phẩm thành công!");</script>';
        } else {
            echo '<script type="text/javascript">alert("Khóa sản phẩm thất bại!");</script>';
        }
    } else if (isset($_POST['active'])) {
        $result = $product->active($_POST['id']);
        if ($result) {
            echo '<script type="text/javascript">alert("Kích hoạt sản phẩm thành công!");</script>';
        } else {
            echo '<script type="text/javascript">alert("Kích hoạt sản phẩm thất bại!");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Có lỗi xảy ra!");</script>';
        die();
    }
}

$product = new product();
$list = $product->getAllAdmin((isset($_GET['page']) ? $_GET['page'] : 1));
$pageCount = $product->getCountPaging();
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
    <title>List of products</title>
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
        <h1>List of products</h1>
    </div>
    <div class="addNew">
        <a href="add_product.php">Add new</a>
    </div>
    <div class="container">
        <?php $count = 1;
        if ($list) { ?>
            <table class="list">
                <tr>
                    <th>STT</th>
                     <th>Product Name</th>
                     <th>Image</th>
                     <th>Original price</th>
                     <th>Promotion price</th>
                     <th>Created by</th>
                     <th>Amount</th>
                     <th>Status</th>
                     <th>Action</th>
                </tr>
                <?php foreach ($list as $key => $value) { ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= $value['name'] ?></td>
                        <td><img class="image-cart" src="uploads/<?= $value['image'] ?>" alt=""></td>
                        <td><?= number_format($value['originalPrice'], 0, '', ',') ?> VND</td>
                        <td><?= number_format($value['promotionPrice'], 0, '', ',') ?> VND</td>
                        <td><?= $value['fullName'] ?></td>
                        <td><?= $value['qty'] ?></td>
                        <td><?= ($value['status']) ? "Active" : "Block" ?></td>
                        <td>
                            <a href="edit_product.php?id=<?= $value['id'] ?>">View/Edit</a>
                            <?php
                            if ($value['status']) { ?>
                                <form action="productlist.php" method="post">
                                    <input type="text" name="id" hidden value="<?= $value['id'] ?>" style="display: none;">
                                    <input type="submit" value="Block" name="block">
                                </form>
                            <?php } else { ?>
                                <form action="productlist.php" method="post">
                                    <input type="text" name="id" hidden value="<?= $value['id'] ?>" style="display: none;">
                                    <input type="submit" value="Active" name="active">
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <h3>No products...</h3>
        <?php } ?>
        <div class="pagination">
            <a href="productlist.php?page=<?= (isset($_GET['page'])) ? (($_GET['page'] <= 1) ? 1 : $_GET['page'] - 1) : 1 ?>">&laquo;</a>
            <?php
            for ($i = 1; $i <= $pageCount; $i++) {
                if (isset($_GET['page'])) {
                    if ($i == $_GET['page']) { ?>
                        <a class="active" href="productlist.php?page=<?= $i ?>"><?= $i ?></a>
                    <?php } else { ?>
                        <a href="productlist.php?page=<?= $i ?>"><?= $i ?></a>
                    <?php  }
                } else {
                    if ($i == 1) { ?>
                        <a class="active" href="productlist.php?page=<?= $i ?>"><?= $i ?></a>
                    <?php  } else { ?>
                        <a href="productlist.php?page=<?= $i ?>"><?= $i ?></a>
                    <?php   } ?>
                <?php  } ?>
            <?php }
            ?>
            <a href="productlist.php?page=<?= (isset($_GET['page'])) ? $_GET['page'] + 1 : 2 ?>">&raquo;</a>
        </div>
    </div>
    </div>
    <footer>
        <p class="copyright">STORENOW @ 2021</p>
    </footer>
</body>

</html>