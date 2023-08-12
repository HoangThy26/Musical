<?php
include 'classes/user.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new user();
    $result = $user->insert($_POST);
    if ($result == true) {
        $userId = $user->getLastUserId(); 
        header("Location:./confirm.php?id=".$userId['id']."");
    }
}
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
    <title>Đăng ký</title>
</head>

<body>
    <nav>
        <label class="logo">STORENOW</label>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="productList.php">Product</a></li>
            <li><a href="register.php" id="signup" class="active">Signup</a></li>
            <li><a href="login.php" id="signin">Signin</a></li>
            <li><a href="order.php" id="order">Order</a></li>
            <li>
                <a href="checkout.html">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="sumItem">
                        0
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <section class="banner"></section>
    <div class="featuredProducts">
        <h1>Signup</h1>
    </div>
    <div class="container-single">
        <div class="login">
            <form action="register.php" method="post" class="form-login">
                <label for="fullName">Full name</label>
                <input type="text" id="fullName" name="fullName" placeholder="Full name..." required>

                <label for="email">Email</label>
                <p class="error"><?= !empty($result) ? $result : '' ?></p>
                <input type="email" id="email" name="email" placeholder="Email..." required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password..." required>

                <label for="repassword">Repassword</label>
                <input type="password" id="repassword" name="repassword" required placeholder="Repassword..." oninput="check(this)">

                <label for="address">Address</label>
                <textarea name="address" id="address" cols="30" rows="5" required></textarea>

                <label for="dob">Birthday</label>
                <input type="date" name="dob" id="dob" required>

                <input type="submit" value="Submit" name="submit">
            </form>
        </div>
    </div>
    </div>
    <footer>
        <div class="social">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
        <ul class="list">
            <li>
                <a href="./">Home</a>
            </li>
            <li>
                <a href="productList.php">Product</a>
            </li>
        </ul>
        <p class="copyright">STORENOW @ 2021</p>
    </footer>
</body>
<script language='javascript' type='text/javascript'>
    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('Password Must be Matching.');
        }else{
            input.setCustomValidity('');
        }
    }
</script>
</html>