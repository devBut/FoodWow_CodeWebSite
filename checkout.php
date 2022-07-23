<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{
    foreach ($_SESSION["cart_item"] as $item)
	{
	    $item_total += ($item["price"]*$item["quantity"]);
        if($_POST['submit'])
	    {
		    $SQL="insert into users_orders(u_id,title,quantity,price) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
			mysqli_query($db,$SQL);
            $success = "Cảm ơn bạn! Đơn hàng của bạn đã được đặt thành công!";
        }
	}
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- 3 thẻ meta ở trên * phải * xuất hiện đầu tiên; bất kỳ nội dung tiêu đề nào khác phải đến * sau * các thẻ này -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Wow Food</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Các kiểu tùy chỉnh cho mẫu này -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
    
    <div class="site-wrapper">
        <!--tiêu đề bắt đầu-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.html"> <img class="img-rounded" src="images/food-wow-logo.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Các nhà hàng <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng Nhập</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng Ký</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn đặt hàng của bạn</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Đăng xuất</a> </li>';
							}

						?>
							 
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Chọn nhà hàng</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Chọn món ăn yêu thích của bạn</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active" ><span>3</span><a href="checkout.php">Đặt hàng và thanh toán trực tuyến</a></li>
                    </ul>
                </div>
            </div>
			
                <div class="container">
                 
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					
                </div>
            
			
			
				  
            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Tóm tắt giỏ hàng</h4> </div>
                                        <div class="cart-totals-fields">
										
                                            <table class="table">
											<tbody>
                                          
												 
											   
                                                    <tr>
                                                        <td>Tổng phụ giỏ hàng</td>
                                                        <td> <?php echo "$".$item_total; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Vận chuyển &amp; Xử Lý</td>
                                                        <td>Free shipping</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Tổng cộng</strong></td>
                                                        <td class="text-color"><strong> <?php echo $item_total."VNĐ"; ?></strong></td>
                                                    </tr>
                                                </tbody>
												
												
												
												
                                            </table>
                                        </div>
                                    </div>
                                    <!--Tóm tắt giỏ hàng-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Thanh toán khi nhận hàng</span>
                                                    <br> <span>Vui lòng gửi địa chỉ cụ thể của bạn đến cửa hàng, Số nhà, Tên đường, Ấp/Phường, Quận/Huyện, Thành Phố, Mã bưu điện cửa hàng.</span> </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod"  type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Thanh Toán Trực Tuyến <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Bạn có chắc không?');" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>
                                    </div>
									</form>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
            </div>
            <section class="app-section">
                <div class="app-wrap">
                    <div class="container">
                        <div class="row text-img-block text-xs-left">
                            <div class="container">
                                <div class="col-xs-12 col-sm-6  right-image text-center">
                                    <figure> <img src="images/app.png" alt="Right Image"> </figure>
                                </div>
                                <div class="col-xs-12 col-sm-6 left-text">
                                    <h3>Ứng dụng giao đồ ăn tốt nhất</h3>
                                    <p>Giờ đây, bạn có thể chế biến đồ ăn ở bất cứ đâu nhờ tính năng Giao đồ ăn miễn phí, dễ sử dụng &amp; Takeout App.</p>
                                    <div class="social-btns">
                                        <a href="#" class="app-btn apple-button clearfix">
                                            <div class="pull-left"><i class="fa fa-apple"></i> </div>
                                            <div class="pull-right"> <span class="text">Có sẵn trên</span> <span class="text-2">App Store</span> </div>
                                        </a>
                                        <a href="#" class="app-btn android-button clearfix">
                                            <div class="pull-left"><i class="fa fa-android"></i> </div>
                                            <div class="pull-right"> <span class="text">Có sẵn trên</span> <span class="text-2">Play store</span> </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- start: FOOTER -->
            <footer class="footer">
                <div class="container">
                    <!-- top footer statrs -->
                    <div class="row top-footer">
                        <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                            <a href="#"> <img src="images/food-wow-logo.png" alt="Footer logo"> </a> <span>Order Delivery &amp; Take-Out </span> </div>
                        <div class="col-xs-12 col-sm-2 about color-gray">
                            <h5>Thông tin chúng tôi</h5>
                            <ul>
                                <li><a href="#">Thông tin chúng tôi</a> </li>
                                <li><a href="#">Được sáng lập bởi 1 đồ án =))</a> </li>
                                <li><a href="#">Team: Nguyễn Thanh Tú, Nguyễn Thị Kiều Trang, Nguyễn Quốc Khánh, Bùi Tấn Thành</a> </li>
                                <li><a href="#">Chúng tôi đang tuyển nhân viên shipper</a> </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                            <h5>Làm thế nào để nó hoặt động</h5>
                            <ul>
                                <li><a href="#">Nhập vị trí của bạn</a> </li>
                                <li><a href="#">Chọn nhà hàng</a> </li>
                                <li><a href="#">Chọn bữa ăn</a> </li>
                                <li><a href="#">Thanh toán qua thẻ tín dụng</a> </li>
                                <li><a href="#">Chờ giao hàng</a> </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-2 pages color-gray">
                            <h5>Các trang</h5>
                            <ul>
                                <li><a href="#">Trang kết quả tìm kiếm</a> </li>
                                <li><a href="#">Trang Đăng ký người dùng</a> </li>
                                <li><a href="#">Trang giá cả</a> </li>
                                <li><a href="#">Đặt hàng</a> </li>
                                <li><a href="#">Thêm vào giỏ hàng</a> </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                            <h5>Các địa điểm nổi tiếng</h5>
                            <ul>
                                <li><a href="#">Sarajevo</a> </li>
                                <li><a href="#">Split</a> </li>
                                <li><a href="#">Tuzla</a> </li>
                                <li><a href="#">Sibenik</a> </li>
                                <li><a href="#">Zagreb</a> </li>
                                <li><a href="#">Brcko</a> </li>
                                <li><a href="#">Beograd</a> </li>
                                <li><a href="#">New York</a> </li>
                                <li><a href="#">Gradacac</a> </li>
                                <li><a href="#">Los Angeles</a> </li>
                            </ul>
                        </div>
                    </div>
                    <!-- top footer ends -->
                    <!-- bottom footer statrs -->
                    <div class="row bottom-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3 payment-options color-gray">
                                    <h5>Các lựa chọn thanh toán</h5>
                                    <ul>
                                        <li>
                                            <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                        </li>
                                        <li>
                                            <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                        </li>
                                        <li>
                                            <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                        </li>
                                        <li>
                                            <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a>
                                        </li>
                                        <li>
                                            <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-4 address color-gray">
                                    <h5>Địa chỉ</h5>
                                    <p>425 Mạc Cửu, Rạch Giá, Kiên Giang</p>
                                    <h5>Phone: <a href="https://www.facebook.com/NguyenThanhTu06/">0332775431</a></h5> </div>
                                <div class="col-xs-12 col-sm-5 additional-info color-gray">
                                    <h5>Thông tin bổ sung</h5>
                                    <p>Tham gia cùng hàng nghìn nhà hàng khác, những người được hưởng lợi từ việc đưa thực đơn của họ lên TakeOff</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- bottom footer ends -->
                </div>
            </footer>
            <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
         </div>

     <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>

<?php
}
?>
