<?php
    /* 用于判断是否登录并向引入的页面输出相应内容 */
    if(isset($_COOKIE["id"])){
        $userid=$_COOKIE["id"];
        //echo "<script>alert('已登录，用户id：$userid')</script>";
        include "./database.php"; //通过id查询用户表
        $sql="select * from user where id=$userid";
        $res=mysqli_query($conn,$sql);
        @$row=mysqli_fetch_array($res);
        if($row){
?>
    <ul class="nav navbar-nav navbar-right" id="loging" data-userid="<?php echo $userid; ?>">
        <li style="margin-right: 0;">
            <a>欢迎，<?php echo $row["username"]; ?></a>
        </li>
        <li id="exituser">
            <a>退出登录</a>
        </li>
    </ul>
<?php }else{ ?>

    <!-- 未登录状态显示的内容 -->
    <a href="./jie/login/login.php">
        <div class="nav navbar-nav navbar-right">
            <div id="login">
                登录
            </div>
        </div>
    </a>  

<?php } ?>

<?php
    }/* if已登录判断 */
    else{
        //echo "<script>alert('未登录')</script>";
?>
    <!-- 未登录状态显示的内容 -->
    <a href="./jie/login/login.php">
        <div class="nav navbar-nav navbar-right">
            <div id="login">
                登录
            </div>
        </div>
    </a>  
<?php        
    }
?>