<?php
include_once '../lib/session.php';
Session::checkSession('admin');
$role_id = Session::get('role_id');
if ($role_id == 1) {
    # code...
} else {
    header("Location:../index.php");
}
include '../classes/order.php';

$order = new order();
$processingOrderList = $order->getProcessingOrder();
$processedOrderList = $order->getProcessedOrder();
$deliveringOrderList = $order->getDeliveringOrder();
$completeOrderList = $order->getCompleteOrder();
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
    <title>Order Management</title>
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
        <h1>Order Management</h1>
    </div>
    <div class="container">
        <!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Processing')">Processing</button>
            <button class="tablinks" onclick="openTab(event, 'Processed')">Processed</button>
            <button class="tablinks" onclick="openTab(event, 'Delivering')">Delivery in progress</button>
            <button class="tablinks" onclick="openTab(event, 'Complete')">Accomplished</button>
        </div>

        <!-- Tab content -->
        <div id="Processing" class="tabcontent">
            <?php
            if ($processingOrderList) { ?>
                <table class="list">
                    <tr>
                        <th>STT</th>
                        <th>Order ID</th>
                        <th>Booking date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php $count = 1;
                    foreach ($processingOrderList as $key => $value) { ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['createdDate'] ?></td>
                            <td><?= ($value['status'] != "Processing") ? $value['receivedDate'] : "Estimated 3 days after the order has been processed" ?> <?=  ($value['status'] != "Complete" && $value['status'] != "Processing") ? "(Expected)" : "" ?> </td>
                            <td><?= $value['status'] ?></td>
                            <td>
                                <a href="orderlistdetail.php?orderId=<?= $value['id'] ?>">Detail</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
            <?php } else { ?>
                <h3>No orders are being processed yet</h3>
            <?php }
            ?>
        </div>

        <div id="Processed" class="tabcontent">
            <?php
            if ($processedOrderList) { ?>
                <table class="list">
                    <tr>
                        <th>STT</th>
                        <th>Order ID</th>
                        <th>Booking date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php $count = 1;
                    foreach ($processedOrderList as $key => $value) { ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['createdDate'] ?></td>
                            <td><?= ($value['status'] != "Processing") ? $value['receivedDate'] : "Estimated 3 days after the order has been processed" ?> <?=  ($value['status'] != "Complete" && $value['status'] != "Processing") ? "(Expected)" : "" ?> </td>
                            <td><?= $value['status'] ?></td>
                            <td>
                                <a href="delivering_order.php?orderId=<?= $value['id'] ?>">Delivery</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
            <?php } else { ?>
                <h3>No orders have been processed yet</h3>
            <?php }
            ?>
        </div>

        <div id="Delivering" class="tabcontent">
            <?php
            if ($deliveringOrderList) { ?>
                <table class="list">
                    <tr>
                        <th>STT</th>
                        <th>Order ID</th>
                        <th>Booking date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php $count = 1;
                    foreach ($deliveringOrderList as $key => $value) { ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['createdDate'] ?></td>
                            <td><?= ($value['status'] != "Processing") ? $value['receivedDate'] : "Estimated 3 days after the order has been processed" ?> <?=  ($value['status'] != "Complete" && $value['status'] != "Processing") ? "(Expected)" : "" ?> </td>
                            <td><?= $value['status'] ?></td>
                            <td>
                                <a href="orderlistdetail.php?orderId=<?= $value['id'] ?>">Detail</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
            <?php } else { ?>
                <h3>Chưa có đơn hàng nào đang giao</h3>
            <?php }
            ?>
        </div>

        <div id="Complete" class="tabcontent">
            <?php
            if ($completeOrderList) { ?>
                <table class="list">
                    <tr>
                        <th>STT</th>
                        <th>Order ID</th>
                        <th>Booking date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php $count = 1;
                    foreach ($completeOrderList as $key => $value) { ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['createdDate'] ?></td>
                            <td><?= ($value['status'] != "Processing") ? $value['receivedDate'] : "Estimated 3 days after the order has been processed" ?> <?=  ($value['status'] != "Complete" && $value['status'] != "Processing") ? "(Expected)" : "" ?> </td>
                            <td><?= $value['status'] ?></td>
                            <td>
                                <a href="orderlistdetail.php?orderId=<?= $value['id'] ?>">Detail</a>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </table>
            <?php } else { ?>
                <h3>No orders have been processed yet</h3>
            <?php }
            ?>
        </div>
    </div>
    </div>
    
    <footer>
        <p class="copyright">STORENOW @ 2021</p>
    </footer>
</body>
<script type="text/javascript">
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 1; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        document.getElementById(tabName).style.display = "block";
    }
</script>

</html>