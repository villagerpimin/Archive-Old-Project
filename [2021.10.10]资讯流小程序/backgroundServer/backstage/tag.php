<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>标签管理</title>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="./js/manager2.js"></script>
</head>
<body>
    <div class="container">
        <div class="alert alert-success" role="alert">目前正在管理<b>所有标签</b></div>
        <div class="col-sm-4">
            <button class="btn btn-primary" name="tags" data-val="create" style="margin-bottom: 25px;">新增</button>&nbsp;&nbsp;
            <button class="btn btn-success" name="tags" data-val="最新" data-tid="1" style="margin-bottom: 25px;">最新</button>&nbsp;&nbsp;
            <button class="btn btn-success" name="tags" data-val="热门" data-tid="2" style="margin-bottom: 25px;">热门</button>&nbsp;&nbsp;
            <?php
                include_once("../api/database.php");
                $sth = $conn->prepare("select * from tags");
                $sth->execute();
                while($res = $sth->fetchObject()){
                    if($res->tag!="最新"&&$res->tag!="热门"){
            ?>
                <button class="btn btn-default" name="tags" data-val="<?php echo $res->tag;?>"
                    style="margin-bottom: 25px;" data-tid="<?php echo $res->id; ?>">
                    <?php echo $res->tag; ?>
                </button>&nbsp;&nbsp;
            <?php }}?>
        </div><!-- 展示标签 -->
        <div class="col-sm-push-2 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">操作提示</div>
                <div class="panel-body">
                    长按标签可以对已有标签进行操作
                </div>
            </div>
        </div><!-- 操作提示 -->
        <div class="modal fade" tabindex="-1" role="dialog" id="showtag">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">标签操作</h4>
                    </div>
                    <div class="modal-body">
                        <p>标签名称：</p><br>
                        <input type="text" name="edit_tag" id="edit_tag" data-tid="" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="del_tag">删除标签</button>
                        <button type="button" class="btn btn-primary" id="save_tagchange">保存更改</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</body>
</html>