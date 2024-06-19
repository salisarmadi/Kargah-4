<?php
include("includes/header.php");
if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)) {
?>
    <script type="text/javascript">
        //<!--
        location.replace("index.php")
        //-->
    </script>
<?php }
$pro_code = $_POST['pro_code'];
$pro_name = $_POST['pro_name'];
$pro_qty = $_POST['pro_qty'];
$pro_price = $_POST['pro_price'];
$total_price = $_POST['total_price'];
$realname = $_POST['realname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$username = $_SESSION['username'];
$link = mysqli_connect("localhost", "root", "", "shop_db");
if (mysqli_connect_errno())
    exit("خطایی به شرع زیر رخ داده است" . mysqli_connect_error());
$query = "INSERT INTO `orders`(`id`, `username`, `pro_code`, `pro_qty`, `pro_price`, `mobile`, `address`, `trackcode`, `state`)
VALUES
('0','$username',
'$pro_code','$pro_qty','$pro_price','$mobile','$address','000000000000000000000000','0')";
mysqli_set_charset($link, "utf8");
if (mysqli_query($link, $query) === true) {
    echo "<p style='color:green;'><b>سفارش شما با موفقیت در سامانه ثبت شد.<br></b></p>";
    echo "<p style='color:brown;'><b>کاربر گرامی آقا/خانم $realname <br></b></p>";
    echo "<p style='color:brown;'><b>محصول $pro_name با کد $pro_code به تعداد/مقدار $pro_qty با قیمت پایه $pro_price ریال را سفارش داده اید. <br></b></p>";
    echo "<p style='color:red;'><b>مبلغ قابل پرداخت برای سفارش ثبت شده $total_price ریال است. <br></b></p>";
    echo "<p style='color:blue;'><b>پس از بررسی سفارش و تایید آن با شما تماس گرفته خواهد شد. <br></b></p>";
    echo "<p style='color:blue;'><b>محصول خریداری شده از طرق شرکت پست ایران طبق آدرس درج شده ارسال خواهد شد <br></b></p>";
    echo "<p style='color:blue;'><b>در هنگام تحویل گرفتن محصول آن را بررسی و از صحت و سالم آن اطمینان حاصل کنید سپس مبلغ کالا را طبق فاکتور ارائه شده به مامور پست تحویل دهید. <br></b></p>";
    $query = "UPDATE products SET pro_qty=pro_qty-$pro_qty where pro_code='$pro_code'";
    mysqli_query($link, $query);
} else {
    echo mysqli_error($link);
    echo mysqli_errno($link);
    echo "<p style='color:red;'><b>خطا در ثبت سفارش</b></p?";
}
mysqli_close($link);
include('includes/footer.php');
?>