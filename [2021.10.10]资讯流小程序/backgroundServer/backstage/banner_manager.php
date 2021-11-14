<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>轮播图管理</title>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="./js/manager2.js"></script>
</head>
<body>
    <div class="container">
        <div class="alert alert-success" role="alert">目前正在管理<b>所有轮播图</b></div>
        <div class="alert alert-info">轮播图的标题和图片与新闻标题和头图<b>两者不互通</b></div>
        <a class="col-sm-push-1 col-sm-3 thumbnail" style="margin-right: 25px;height: 220px;
            text-align:center;line-height:220px;font-size:20px;color:#808080;text-decoration:none;" href="#"
            name="banner_item" data-type="add">
            添加
        </a>
        <?php
            /* 查询所有轮播图 */
            include_once("../api/database.php");
            $str = "select * from banner";
            $sth = $conn->prepare($str);
            $sth->execute();
            while($res = $sth->fetchObject()){
        ?>
            <a class="col-sm-push-1 col-sm-3 thumbnail" style="margin-right: 25px;height: 220px;
                color:#808080;text-decoration:none;" href="#" name="banner_item" data-type="update"
                data-bid="<?php echo $res->id; ?>">
                <img src="<?php echo $res->banner_image; ?>" style="height:165px;">
                <?php echo $res->banner_title; ?>
            </a>
        <?php }?>

        <!-- 管理内容 -->
        <div class="modal fade" tabindex="-1" role="dialog" id="showbanner">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">操作</h4>
                    </div>
                    <div class="modal-body">
                        <p>轮播标题：</p>
                        <input type="text" name="edit_title" id="edit_title" class="form-control"><br>
                        <p>轮播图：</p>
                        <div class="row">
                            <form action="" method="POST" enctype="multipart/form-data" id="bannerpic_upload"
                                class="col-sm-8">
                                <label class="thumbnail" style="height: 200px;cursor:pointer;text-align:center;" 
                                    for="bannerpic">
                                    <input type="file" name="bannerpic" id="bannerpic" style="display: none;"
                                        accept="image/jpeg,image/jpg,image/png">
                                    <span id="bannerpic_text" style="font-weight: 400;line-height: 200px;font-size:17px;">
                                        请选择图片</span>
                                    <!-- 上传成功后的预览图 -->
                                    <img style="height:190px;" id="bannerpic_preview" data-filename=""/>
                                </label>
                            </form>
                            <button class="btn btn-default" id="send_bannerpic">上传</button>
                        </div><br>
                        <p>对应新闻：</p>
                        <div class="row">
                            <div class="col-sm-3">
                                <button class="btn btn-success" data-nid="" name="old">跳转</button>
                                <button class="btn btn-primary" name="new">新建</button><br>
                            </div>
                            <div class="col-sm-3">
                                <input type="number" name="nid" id="nid" class="form-control">
                            </div>
                            <button class="btn btn-default" id="save_current">获取并设置该id的新闻为轮播图</button>
                        </div>
                        
                    </div><!-- 轮播图上传 -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="del_banner">删除</button>
                        <button type="button" class="btn btn-primary" id="save_bannerchange" data-type="">保存更改</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</body>
</html>