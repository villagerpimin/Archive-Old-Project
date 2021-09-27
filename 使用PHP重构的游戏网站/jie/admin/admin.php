<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员界面</title>
<link href="admin.css" rel="stylesheet" />
<link href="admin(2).css" rel="stylesheet" />
<script src="../JQ/jquery-3.6.0.min.js"></script>
<script>
$(function(){
	//这是管理密码
	$('#adminlogin').on('click',function(){
		$('#contentleft').hide();
		$('#content').show(3000);
		$('.content2').hide();
		$('.del22').hide();
		})
	//这是插入操作
	$('#addinsert').on('click',function(){
		$('#contentleft').hide();
		$('#content').hide();
		$('.del22').hide();
		$('.content2').show(3000);
		})
	//这是删除操作
	$('#del').on('click',function(){
		$('#contentleft').hide();
		$('#content').hide();
		$('.content2').hide();
		$('.del22').show()
		})
	})
</script>
</head>

<body>
<div class="content">
<div class="contentright">
  <div id="contentright"> <img src="../loginimages/ztf.png" id="img"  style="cursor:pointer;"/>
    <p>我是<?php echo $_GET['name'] ?></p>
    <p>欢迎到凤凰游戏管理</p>
    <p>我的目录如下</p>
    <br />
    <span><a id="addinsert" style="cursor:pointer;">插入操作</a></span><br />
    <br />
    <span><a id="del" style="cursor:pointer;">删除操作</a></span><br />
    <br />
    <span><a id="adminlogin" id="adminlogin" style="cursor:pointer;">管理密码</a></span><br />
    <br />
    <div id="img1"><img src="../loginimages/n.png"  id="img2" />&nbsp&nbsp;<img src="../loginimages/m.png"  id="img3"/>&nbsp&nbsp;<img src="../loginimages/b.png"  id="img4" /></div>
    <br />
    <br />
    <p >时刻都在更新！</p>
  </div>
</div>
<div class="contentleft">
<div id="contentleft"> <img  src="../loginimages/bjt3.png" id="bjt2" />
  <div id="pos"><span><<<a href='../login/login.php'>退出</a></span></div>
  <!--这是中间隐藏的区域-->
  <div id="centertext">
    <h1>欢迎来到凤凰游戏管理界面</h1>
    <p>“管理员 （Administrator）一般是指负责一定系统或者软件的维护或管理更新的实际个人或帐号，也有的是专门管理违反原则的。也有些场合，比如网吧、交流群等直接叫做管理员。”</p>
    <video src="../loginimages/1.mp4" id="video" controls="controls"></video>
  </div>
</div>
<div class="del22" style="display:none">
  <div id="fullcontent">
    <div class="head"><a href="#"><img src="../loginimages/logo.png"></a></div>
    <div id="middle3"> <span id="registername">删除</span>
      <div class="registername">
        <div>删除</div>
      </div>
      <form method="post">
        <div id="formpos">
          <?php
include('../login/database.php');
$select="select * from game limit 5";
$res=mysqli_query($conn,$select);
$row_num=mysqli_num_rows($res); //获得行数
$page=isset($_GET['page'])?$_GET['page']:1; //默认为第一页
$page_num=ceil($row_num/20); //总页数
$startNum=($page-1)*20; //数据读取的开始位
$sql="select * from game order by id limit $startNum,5";
$res=mysqli_query($conn,$sql);
?>
          <?php while($row=mysqli_fetch_array($res)){   ?>
          <div class="sqlcontent"> <img src="../../<?php echo $row["img"] ?>"  width="200px" height="80px">
            <h3 style="position:relative; left:-150px; top:-80px; cursor:pointer;"><?php echo $row["name"]?></h3>
            <p style="position:relative; left:-85px; top:-100px;"><span>发布于</span><span><?php echo $row["date"]?></span> <span><?php echo $row['typename']?></span></p>
            <div style="position:relative; left:500px; top:-170px; cursor:pointer;"><img src="../../<?php echo $row["pingtai"]?>" /></div>
            <div id="dazebutton"><?php echo $row["daze"]?></div>
            <div id="deletebutton"><a href="#">删除</a></div>
          </div>
          <?php }?>
            <div id="" data-page="<?php echo $page; ?>"
                data-pagenum="<?php echo $page_num; ?>" style="">
                <input type="submit" value="第一页"  name="btn" />
                <input type="submit" value="上一页" name="btn"  />
                <input type="submit" value="下一页" name="btn" />
                <input type="submit" value="最后一页" name="btn" />
            </div>
         
        </div>
        <?php  
        if(!empty($_POST['btn'])){
			if($_POST['btn']=="第一页"){
				echo "<script>window.location.href='admin.php?id={$_GET['id']}&name={$_GET['name']}&page=1'</script>";
			}else if($_POST['btn']=='下一页'){
				$p=++$page;
				echo "<script>window.location.href='admin.php?id={$_GET['id']}&name={$_GET['name']}&page=$p'</script>";
				}else if($_POST['btn']=='下一页'){
					$p1=--$page;
					echo "<script>window.location.href='admin.php?id={$_GET['id']}&name={$_GET['name']}&page=$p1'</script>";
					}else if($_POST['btn']=='最后一页'){
						echo "<script>window.location.href='admin.php?id={$_GET['id']}&name={$_GET['name']}&page=$p1'</script>";
						}
			}	
	    ?>
      </form>
      <div id="bottom">©我们是第二小组成员 小组成员有1930634朱腾飞 1930638许泽栋 1930630余创杰 </div>
    </div>
  </div>
</div>
<div class="content2" style="display:none;">
  <div id="fullcontent">
    <div class="head"><a href="#"><img src="../loginimages/logo.png"></a></div>
    <div id="middle3"> <span id="registername">插入游戏</span>
      <div class="registername">
        <div>插入游戏</div>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div id="formpos"> <span>游戏名称:</span>
          <input type="text" name="name"   />
          <br />
          <span>别名:</span>
          <input type="text" name="nametitle"  />
          <span>价格:</span>
          <input type="text" name="price"  />
          <br />
          <span>日期:</span>
          <input type="text" name="data" />
          <span>类别:</span>
          <input type="text" name="typename" />
          <br />
          <span>打折:</span>
          <input type="text" name="daze" />
          <span>日期:</span>
          <input type="text" name="data" />
          <br />
          <span>内容也图片:</span>
          <input type="file" name="img" />
          <span>目录页图片:</span>
          <input type="file" name="cover" />
          <br />
          <span>平台图片:</span>
          <input  type="file" name="pingtai" />
        </div>
        <input type="submit" value="插入" name="register2" id="registerbutton"  />
      </form>
      <div id="bottom">©我们是第二小组成员 小组成员有1930634朱腾飞 1930638许泽栋 1930630余创杰 </div>
    </div>
  </div>
</div>
<?php
include('../login/database.php');
if(!empty($_POST['register2'])){
  $name=$_POST['name'];
  $nametitle=$_POST['nametitle'];
  $price=$_POST['price'];
  $data=$_POST['data'];
  $daze=$_POST['daze'];
  $typename=$_POST['typename'];
  $img=$_FILES['img']['name'];
  $cover=$_FILES['cover']['name'];
  $pingtai=$_FILES['pingtai']['name'];
  $insert="insert into game(name,nametitle,price,daze,typename,img,cover,pingtai,date)
  values('$name','$nametitle','$price','$daze','$typename','$img','$cover','$pingtai','$data')";
  if(mysqli_query($conn,$insert)or die(mysqli_error($conn))==true)
  {echo "<script>alert('插入成功')</script>";}
  else{echo "<script>alert('插入失败')</script>";}
  }
?>
<div id="content" style="display:none;">
<div id="fullcontent">
  <div class="head"><a href="#"><img src="../loginimages/logo.png"></a></div>
  <div id="middle"> <span id="registername">修改密码</span>
    <div class="registername">
      <div>修改密码</div>
    </div>
    <form method="post">
      <div id="formpos"> <span>账号:</span>
        <input type="text" name="username" id="username" required="required" placeholder="请输入您的账号:" 
            value="<?php echo $_GET['name'] ?>" disabled="disabled" />
        <br />
        <span>密码:</span>
        <input type="password" name="password" id="password" required="required" placeholder="请输入您修改的密码:" />
        <br />
        <span>重复:</span>
        <input type="password" name="repassword" id="repassword" required="required" placeholder="再一次输入您的密码:" />
        <br />
        <input type="submit" value="确定" name="register" id="registerbutton" />
      </div>
    </form>
    <div id="bottom">©我们是第二小组成员 小组成员有1930634朱腾飞 1930638许泽栋 1930630余创杰 </div'> </div>
  </div>
</div>
<?php
include('adminpsw.php');

?>
</body>
</html>