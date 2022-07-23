<!DOCTYPE html>
<html lang="en">
<?php

session_start(); //temp session
error_reporting(0); // hide undefine index
include("connection/connect.php"); // connection
if(isset($_POST['submit'] )) //if submit btn is pressed
{
     if(empty($_POST['firstname']) ||  //fetching and find if its empty
   	    empty($_POST['lastname'])|| 
		empty($_POST['email']) ||  
		empty($_POST['phone'])||
		empty($_POST['password'])||
		empty($_POST['cpassword']) ||
		empty($_POST['cpassword']))
		{
			$message = "Tất cả các dòng phải là Bắt buộc!";
		}
	else
	{
		//cheching username & email if already present
	$check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
	$check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");
		

	
	if($_POST['password'] != $_POST['cpassword']){  //matching passwords
       	$message = "Mật khẩu không khớp";
    }
	elseif(strlen($_POST['password']) < 6)  //cal password length
	{
		$message = "Mật khẩu phải >= 6 kí tự";
	}
	elseif(strlen($_POST['phone']) < 10)  //cal phone length
	{
		$message = "Số điện thoại không hợp lệ!";
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
       	$message = "Địa chỉ email không hợp lệ, vui lòng nhập một email hợp lệ!";
    }
	elseif(mysqli_num_rows($check_username) > 0)  //check username
     {
    	$message = 'Tên đăng kí đã được sử dụng!';
     }
	elseif(mysqli_num_rows($check_email) > 0) //check email
     {
    	$message = 'Email đã tồn tại!';
     }
	else{
       
	 //inserting values into db
	$mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
	mysqli_query($db, $mql);
		$success = "Đã tạo tài khoản thành công! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
														<script type='text/javascript'>
														function countdown() {
															var i = document.getElementById('counter');
															if (parseInt(i.innerHTML)<=0) {
																location.href = 'login.php';
															}
															i.innerHTML = parseInt(i.innerHTML)-1;
														}
														setInterval(function(){ countdown(); },1000);
														</script>'";
		
		
		
		
		 header("refresh:5;url=login.php"); // redireted once inserted success
    }
	}

}


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Wow Food</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
     
         <!--header starts-->
         <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
               <div class="container">
                  <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                  <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-wow-logo.png" alt=""> </a>
                  <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                     <ul class="nav navbar-nav">
							<li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Nhà Hàng <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng Nhập</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng Ký</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn đặt hàng của bạn</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">logout</a> </li>';
							}

						?>
							 
                        </ul>
                  </div>
               </div>
            </nav>
            <!-- /.navbar -->
         </header>
         <div class="page-wrapper">
            <div class="breadcrumb">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">
					  <span style="color:red;"><?php echo $message; ?></span>
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					   
					</a></li>
                    
                  </ul>
               </div>
            </div>
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body">
                              
							  <form action="" method="post">
                                 <div class="row">
								  <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Tên tài khoản</label>
                                       <input class="form-control" type="text" name="username" id="example-text-input" placeholder="Tên tài khoản"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Tên</label>
                                       <input class="form-control" type="text" name="firstname" id="example-text-input" placeholder="Tên"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Họ</label>
                                       <input class="form-control" type="text" name="lastname" id="example-text-input-2" placeholder="Họ"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Địa chỉ Email</label>
                                       <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập vào địa chỉ email"> <small id="emailHelp" class="form-text text-muted">Chúng tôi sẽ không bao giờ chia sẻ email của bạn với bất kỳ ai khác.</small> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Số điện thoại</label>
                                       <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Số điện thoại"> <small class="form-text text-muted">Chúng tôi sẽ không bao giờ chia sẻ email của bạn với bất kỳ ai khác.</small> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Mật khẩu</label>
                                       <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Mật Khẩu"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Xác nhận mật khẩu</label>
                                       <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Nhập lại mật khẩu"> 
                                    </div>
									 <div class="form-group col-sm-12">
                                       <label for="exampleTextarea">Địa chỉ đặt hàng</label>
                                       <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                                    </div>
                                   
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                           
						   </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                     <!-- WHY? -->
                     <div class="col-md-4">
                        <h4>Đăng ký là nhanh chóng, dễ dàng và miễn phí.</h4>
                        <p>Sau khi đăng ký, bạn có thể:</p>
                        <hr>
                        <img src="http://placehold.it/400x300" alt="" class="img-fluid">
                        <p></p>
                        <div class="panel">
                           <div class="panel-heading">
                              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle collapsed" href="#faq1" aria-expanded="false"><i class="ti-info-alt" aria-hidden="true"></i>Chúng tôi có thể giúp gì cho bạn?</a></h4>
                           </div>
                           <div class="panel-collapse collapse" id="faq1" aria-expanded="false" role="article" style="height: 0px;">
                              <div class="panel-body"> Chúng tôi liên kết với các nhà hàng, cửa hàng để làm nó bụng các bạn. </div>
                           </div>
                        </div>
                        <!-- end:panel -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle" href="#faq2" aria-expanded="true"><i class="ti-info-alt" aria-hidden="true"></i>Chúng tôi có thể giúp gì cho bạn?</a></h4>
                           </div>
                           <div class="panel-collapse collapse" id="faq2" aria-expanded="true" role="article">
                              <div class="panel-body"> Chúng tôi liên kết với các nhà hàng, cửa hàng để làm nó bụng các bạn. </div>
                           </div>
                        </div>
                        <!-- end:Panel -->
                        <h4 class="m-t-20">Liên hệ Hỗ trợ khách hàng</h4>
                        <p>Nếu bạn đang tìm kiếm thêm trợ giúp hoặc có câu hỏi cần hỏi, vui lòng </p>
                        <p> <a href="contact.html" class="btn theme-btn m-t-15">Liên hệ chúng tôi</a> </p>
                     </div>
                     <!-- /WHY? -->
                  </div>
               </div>
            </section>
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
                        <a href="#"> <img src="images/food-wow-logo.png" alt="Footer logo"> </a> <span>Order Delivery &amp; Take-Out </span> 
                     </div>
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
                              <h5>Phone: <a href="https://www.facebook.com/NguyenThanhTu06/">0332775431</a></h5>
                           </div>
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