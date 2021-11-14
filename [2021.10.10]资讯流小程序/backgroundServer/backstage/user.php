<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户管理</title>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="./js/manager.js"></script>
</head>
<body>
    <div class="container">
        <div class="alert alert-success" role="alert">目前正在管理<b>所有用户</b></div>
        <!-- 模态框，用于显示新增/修改的信息 -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">用户操作</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            用户头像：
                        </div>
                        <div class="col-sm-5">
                            <form action="" method="POST" enctype="multipart/form-data" id="userpic_upload">
                                <label class="thumbnail" style="height: 200px;cursor:pointer;text-align:center;" 
                                    for="userpic">
                                    <input type="file" name="userpic" id="userpic" style="display: none;"
                                        accept="image/jpeg,image/jpg,image/png">
                                    <span id="userpic_text" style="font-weight: 400;line-height: 200px;font-size:17px;">
                                        请选择图片</span>
                                    <!-- 上传成功后的预览图 -->
                                    <img style="height:190px;" id="userpic_preview"/>
                                </label>
                            </form>
                        </div>
                        <div class="col-sm-1"><button class="btn btn-default" id="send_userpic">上传</button></div>
                    </div><!-- 用户头像设置 -->

                    <div class="row">
                        <div class="col-sm-3">昵称：</div>
                        <div class="col-sm-7">
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                    </div><!-- 用户昵称设置 --><br>

                    <div class="row">
                        <div class="col-sm-3">性别：</div>
                        <div class="col-sm-7">
                            <select name="sex" id="sex" class="form-control">
                                <option value="男" selected name="nan">男</option>
                                <option value="女" name="nv">女</option>
                            </select>
                        </div>
                    </div><!-- 用户性别设置 --><br>

                    <div class="row">
                        <div class="col-sm-3">密码：</div>
                        <div class="col-sm-7">
                            <input type="text" name="pwd" id="pwd" class="form-control">
                        </div>
                    </div><!-- 用户密码设置 --><br>

                    <div class="row">
                        <div class="col-sm-3">邮箱：</div>
                        <div class="col-sm-7">
                            <input type="mail" name="mail" id="mail" class="form-control">
                        </div>
                    </div><!-- 用户密码设置 --><br>
                    
                </div>
                <!-- 提交操作 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="saveChange" data-type="" data-id="">保存更改</button>
                </div>
                </div>
            </div>
        </div> <!-- 弹窗 -->

        <!-- 操作状态提示 -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="msg">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">提示</h4>
                    </div>
                    <div class="modal-body">
                        操作成功！两秒后会自动刷新信息
                    </div>
                </div>
            </div>
        </div>

        <div class="list-group col-sm-6">
            <!-- 新增用户 -->
            <a href="#" class="list-group-item" name="userinfo" data-val="create"
                data-toggle="modal" data-target="#myModal">
                <h4 class="list-group-item-heading" >
                    新增用户</h4>
                <p class="list-group-item-text">
                    点击此处进行添加用户操作
                </p>
            </a><br>
            <?php
                include_once("../api/database.php");
                $str = "select * from user";
                $sth = $conn->prepare($str);
                $sth->execute();
                while($res = $sth->fetchObject()){
            ?>
                <a href="#" class="list-group-item" name="userinfo" data-val="<?php echo $res->id; ?>">
                    <div class="badge" style="background-color: rgba(255, 255, 255, 0);">
                        <button class="btn btn-default" value="<?php echo $res->id; ?>" name="del_user">删除</button>
                    </div>
                    <h4 class="list-group-item-heading" data-toggle="modal" data-target="#myModal">
                        <?php echo $res->wxname; ?></h4>
                    <p class="list-group-item-text" data-toggle="modal" data-target="#myModal">
                        性别:<?php echo $res->gender==1?"男":"女"; ?>,&nbsp;&nbsp;
                        openid:<?php echo empty($res->openid)?"非微信用户":$res->openid; ?>
                    </p>
                </a><br>
            <?php }?>
        </div><!-- 用户数据展示 -->
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">操作提示</div>
                <div class="panel-body">
                    点击用户列表中的账号可以对指定用户进行操作，点击新建用户可以创建一个网页版用户
                </div>
            </div>
        </div><!-- 提示面板 -->
    </div><!-- container -->
</body>
</html>