<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>购物车</title>

    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./css/shop.css">
    <link rel="stylesheet" href="./css/index.css">
    <script src="./js/shop.js"></script>
</head>
<body>

<?php
    include "./database.php";
?>


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

    <!-- 伪选项卡 -->
    <div class="mtab">
        <ul>
            <li style="border-bottom: 5px solid orange;font-weight: bold;">
            <a href="./index.php">首页</a></li>
            <li><a href="./game.php">游戏</a></li>
            <li>主机</li>
            <li>周边</li>
        </ul>
    </div>


    <!-- 购物车 -->
    <div class="container-fluid  shop-back  ">
        <div class="container   shop-box">
            <!-- 游戏 -->
            <div class="left-game">
                <span>购物车</span>
                <span style="float: right;"><input type="checkbox" name="quan" id="quan">全选</span>
             <!--   <form method="post" action=""> -->  
               
				<?php
                    $uid=$_COOKIE["id"]; //登录的用户id
                    echo empty($uid)?"<script>alert('没有登录！');location.href='./jie/login/login.php'</script>":
                        "";
                    
					$sql="select * from shop where userid = $uid";
					$res=mysqli_query($conn,$sql);
					while($row=mysqli_fetch_array($res)){ 
				?>

                <div  class="che"> 
                <table>

            <?php  
                    $gameid=$row["gameid"]; //加购的游戏id
                    $id=$row["id"];
            ?>
                   <!-- 多选框 -->
                   <tr>
                <td style="width:30px">
                    <input type="checkbox" value="<?php echo $gameid ?>" name='checkgid'>
                </td>
                
                <?php
                    $sqlgame="select * from game where id='$gameid'" ;
                    $resgame=mysqli_query($conn,$sqlgame);
                    while($rowgame=mysqli_fetch_array($resgame)){
                    $imgs=$rowgame["cover"];
                    //$qa=1;
                  
                ?>   
                    <!-- 图片 -->
                    <td style=" width:103px; height:100% ;"><img src="<?php  echo $imgs ?>" class="shopimg"></td>
                    
                    <!-- 游戏名字 -->
                    <td  style="width: 170px;">
                   
                     
                        <!-- 中文占3位 -->
                        <span style="font-family:微软雅黑">
                             <?php echo strlen($rowgame["name"])>21?substr($rowgame["name"],0,21)."...":$rowgame["name"] ?>
                        </span>
                      
                       
                      <br>
                      
                      <span style="color: #9b9b9b;font-size:12px;">
                            <?php echo strlen($rowgame["nametitle"])>21?substr($rowgame["nametitle"],0,21)."...":
                        $rowgame["nametitle"] ?>
                      </span>
                      
                      
                   
                    </td>
                    <td style="width:120px">


                     <!-- 数量 -->
                    <input type="button" name="jian" value="-" class="btn btn-default btn-xs"
                        data-num="<?php echo $row["gamenum"]; ?>" data-gid="<?php echo $row["gameid"] ?>"/>
                    <input style="width:40px;" type="number" name="gamenum<?php echo $row["gameid"] ?>" value="<?php echo $row["gamenum"]; ?>" 
                        class="inps" data-gid="<?php echo $row["gameid"] ?>"/>
                    <input type="button" name="jia" id="add" value="+" class="btn btn-default btn-xs" 
                        data-num="<?php echo $row["gamenum"]; ?>" data-gid="<?php echo $row["gameid"] ?>"/>
                          
                         
                    </td>
                 
                    <!-- 价钱 -->
                    <td style="width: 66px;">
                        <span class="price"><?php echo "￥".$rowgame["daze"] ?></span>
                    </td>
                    <td style="width:100px">
                         <span  class="daze" ><?php echo "￥".$rowgame["price"] ?></span>
                         <br>
                         <div class="luse" >
                        <?php
                                echo "-".(100-round($rowgame["daze"]/$rowgame["price"] *100))."％"
                        ?>
                        </div>
                    </td>
                    <!-- 删除 -->
                    <td>
                        <span name="del" class="delimg glyphicon glyphicon-trash"
                            data-delid="<?php echo $row["gameid"] ?>">&nbsp;</span>
                    </td>

                
            <?php
                };
                   
             ?>
       
        </tr>
        </table>  
        </div> 
         
        <?php 
      
            }
        ?>
        
   

            </div>
			
            <!-- 优惠券 -->
            <div class="right-quan">
				
            <ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab">可用优惠券</a></li>
			<li><a href="#tab2" data-toggle="tab">优惠码</a></li>
			</ul>
				<div id="mytab-content" class="tab-content">
					<div class="tab-pane fade in active" id="tab1">
						 <select style="border-width:1px; width: 100%; outline: none;" class="form-control">
						   <option value="volvo">无可用优惠券</option>
						 </select>
					</div>
						<div class="tab-pane fade" id="tab2">
							<div class="input-group">
								<input type="text" class="form-control">
								<span class="input-group-addon">使用</span>
							</div>
						</div>
				</div>
            </div>



            <!-- 横线清除浮动 -->
            <div class="clear">

            </div>



            <!-- 订单备注 -->

            <div class="left-title">
                <span> 订单备注</span>
                
                <input type="text" class="form-control txt" placeholder="( •̀ ω •́ )y"  name="text" >
               
            </div>



            <!-- 订单支付 -->
            <div class="right-title">



                <div class="rtxt ">
                    <span>快递费用</span>
                    <p class="qian">￥ 0.00</p>
                </div>

                <div class="rtxt ">
                    <span>为你节省</span>
                    <!-- js替换 -->
                    <p class="qian" id="jiesheng">￥ 0.00</p>
                </div>


                <div class="fukuan">
                    <!-- <form method="get" action=""> -->
                        <tr> 
                           <td><span style="margin-right: 30px;">应付金额</span></td>
                           <!-- js输出 -->
                           <td ><span class="jiner"> <?php  $jiner=0;  echo "￥".number_format($jiner,2)?></span></td>

                           <td><input type="button" value="确定付款" class="sub" name="fukuan"> </td>
                        </tr>
                </div>
                   
                
                    
                </div>
				   <!-- </form> -->
            </div>

    </div>
    
</body>
</html>