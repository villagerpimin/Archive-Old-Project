<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<script src="./js/jquery-3.6.0.min.js"></script>
		<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		
		
		<link rel="stylesheet" href="./css/index.css">
		<link rel="stylesheet" href="./css/detail.css">
		<script src="./js/index.js"></script>
		
		<?php
		    include "./database.php";
			
			$id=$_GET["id"];
			
			session_start();
			
		?>
		
	</head>
	<body>
		<div class="container-fluid">
        <!-- 导航 -->
			<nav class="navbar navbg">
				<div class="navbar-header">
					<a class="navbar-brand" href="./index.php">
						<img src="./images/logo.png" alt="">
					</a>
				</div>
				<!-- 搜索游戏 -->
				<form method="POST" action="./showSearch.php" class="navbar-form navbar-left martop">
					<div class="input-group input-group-lg">
						<input type="text" name="search" class="form-control" placeholder="请输入关键词">
						<span class="input-group-addon" id="serachsub">
							<i class="glyphicon glyphicon-search"></i>
						</span>
					</div>
				</form>
				<!-- 导航项 -->
				<ul class="nav navbar-nav navbar-left martop">
					<li>
						<a href="./shopCar.php" class="btn-lg">
							<span class="glyphicon glyphicon-shopping-cart"></span>
							&nbsp;&nbsp;购物车
						</a>
					</li>
					<li>
						<a href="#" class="btn-lg">
							<span class="glyphicon glyphicon-send"></span>
							&nbsp;&nbsp;问题反馈
						</a>
					</li>
				</ul>
				<!-- 登录 -->
				<?php include "./user.php"; ?>
			</nav>
		</div>
		
		
			<?php
			$sql="select * from game where id=$id";
				 $res=mysqli_query($conn,$sql);
				 while($row=mysqli_fetch_array($res)){
				 $row['cover'] ; 
			?>
			
	
		<div class="container-fluid "  >
		<?php  $row["img"] ?>
		
			<div class="container">
					<div>
						<p class="name">
							<?php echo $row['name'] ;?>
						</p>
						<p class="smallname">
							<span title="<?php echo $row["nametitle"] ?>">
								<?php echo strlen($row["nametitle"])>18?substr($row["nametitle"],0,18)."...":
									$row["nametitle"] ?>
							</span>|
							<?php echo $row['date']."上市" ;?>|
							<?php echo $row['typename'] ;?>|
							支持中文
							
						</p>
					
					</div>

					<div>
						<div class="left-img">
							<img class="bigimg" src="<?php echo $row["img"] ?>">
						</div>

						<div class="right-txt">
							<div class="top-title">
								<img class="smallimg" src="<?php echo $row["cover"] ?>">
								<div class="smalltxt">
									<span class="xiaoming"><?php echo $row['name'] ;?></span>
<br>
								
									<span class='fangwei' ><?php echo $row["nametitle"]?></span>
<br>
								
									<span class='fangwei'>使用于全国地区</span>
								</div>
							</div>


							<div class="buy" > 
								<div class="center">
									<p>
									
										<span >游戏平台:&nbsp;&nbsp;&nbsp;&nbsp;</span>
										<input type="submit" class="pingtai" value="" style="background-image: url(<?php echo $row["pingtai"] ?>);">
									</p>
									
									<p>
										<span >数字版本:&nbsp;&nbsp;&nbsp;&nbsp;</span>
										<input type="submit" class="ping" value="全国版key">
									</p>
								</div>
								<div class="border">
									<div class="jiaqian">
										
										<span class="shuzi"><?php echo "￥".$row["daze"] ?></span>
										<span class="sz"><?php echo "￥".$row["price"] ?></span>
										
										<span class="luse" >-
										<?php echo 100-round($row["daze"]/$row["price"] *100)."％"?>
										</span>

									</div>
									<div style="clear: both;"></div>

									<div class="but">
										<span>
											<input type="submit" class="bth-buy" value="立即购买">
										</span>


										<form method="POST">
										<span>
											<input type="submit" class="bth-shop" name="shop" value="加入购物车">
										</span>	
										</form>

										<!-- 判断购物车数据库是否有改商品 -->
										<?php
											
											if(isset($_POST["shop"])){

												
												$username=$_COOKIE["username"];
												$sqlid="select gameid from shop where  gameid =$id and username=$username ";
												$resid=mysqli_query($conn,$sqlid);
												
												if($resid->num_rows == 0){
													
													$sqlshop="insert into shop (username,gamenum,gameid) values('$username','1','$id')";
												}else {
													
													$sqlshop="update shop set gamenum =gamenum+1 where  gameid =$id and username=$username ";
												};
												$resshop=mysqli_query($conn,$sqlshop);
											}
											
										?>

									</div>
								</div>
							</div>
						</div>
					</div>
				
					
			</div>

		

			<?php
			    }
			?>
		</div>
		
	</body>
</html>
