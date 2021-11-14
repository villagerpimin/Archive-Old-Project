<?php
@$type=$_GET["type"];
    @$id=$_GET["id"];
    include_once("../../api/database.php");
    if(empty($type)){
        /* 没有给定模式时 */
        echo "<script>
                alert('没有给定选择的模式！');history.go(-1)</script>";
    }
    if($type=="update"){
        /* 更新新闻 */
        $str = "select * from news where id=$id";
        $sth=$conn->prepare($str);
        $sth->execute();
        $res=$sth->fetchObject();
    }
    if($type=="audit"){
        /* 审核新闻 */
        $str = "select * from news_cache where id=$id";
        $sth = $conn->prepare($str);
        $sth->execute();
        $res = $sth->fetchObject();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新闻编辑页</title>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="../css/public.css" rel="stylesheet">
</head>
<body>
<script src="../js/manager.js"></script>
    <div class="container">
        <div class="alert alert-success" role="alert">
            目前正在<b>编辑新闻</b>
            当前新闻id：<b><?php echo isset($id)?$id:"null"; ?></b>
        </div>
        <?php if($type=="audit"){?>
            <div class="alert alert-info" role="alert">
                以下为用户投稿的新闻
            </div>
        <?php }else{?>
            <ul class="nav nav-pills">
                <li role="presentation"><a href="../news.php">管理</a></li>
                <li role="presentation" class="active"><a href="./edit_news.php?type=add">新增</a></li>
            </ul>
        <?php }?>
        <br><br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-7">
                <!-- 头图 -->
                <div class="row">
                    <div class="col-sm-2" style="height:200px;line-height:200px;font-size:16px;">
                        头图：
                    </div>
                    <div class="col-sm-7" style="height:200px">
                        <form action="" method="POST" enctype="multipart/form-data" id="headpic_upload">
                            <label class="thumbnail" style="height: 200px;cursor:pointer;text-align:center;" 
                                for="headpic">
                                <input type="file" name="headpic" id="headpic" style="display: none;"
                                    accept="image/jpeg,image/jpg,image/png">
                                <?php if(empty($res->image)){ ?>
                                    <span id="headpic_text" style="font-weight: 400;line-height: 200px;font-size:17px;">
                                        请选择图片</span>
                                    <!-- 上传成功后的预览图 -->
                                    <img style="height:190px;" id="headpic_preview"/>
                                <?php }else{ ?>
                                    <img style="height:190px;" id="headpic_preview" 
                                        src="<?php echo $res->image; ?>"/>
                                <?php } ?>
                            </label>
                        </form>
                    </div>
                    <div class="col-sm-1" style="margin-top: 90px;">
                        <button class="btn btn-default" id="send_headpic">上传</button>
                    </div>
                </div>
                <!-- 新闻标题 -->
                <br><br><div class="row">
                    <div class="col-sm-2" style="height:50px;line-height:50px;font-size:16px;">
                        标题：
                    </div>
                    <div class="col-sm-7" style="height:50px">
                    <!-- 输入的文本 -->
                        <textarea name="news_title" id="news_title" class="form-control"
                            col="30" rows="3"><?php echo empty($res->title)?"":$res->title; ?></textarea>
                    </div>
                </div>
                <!-- 新闻分类 -->
                <br><br><div class="row">
                    <div class="col-sm-2" style="height:50px;line-height:50px;font-size:16px;">
                        分类：
                    </div>
                    <div class="col-sm-7" style="height:50px">
                        <!-- 展示可用的tag -->
                        <?php
                            /* 编辑新闻时，有tag */
                            $select = isset($res->tag)?$res->tag:null;
                            /* 查询tag */
                            $str="select tag from tags";
                            $sth=$conn->query($str);
                            $list=array(); //tag列表
                            $count=0;
                            foreach($sth as $row){
                                $list[$count]=$row["tag"];
                                $count++;
                            }
                        ?>
                        <select name="tag" id="tag" class="form-control">
                            <option value="" <?php echo empty($select)?"selected":""; ?>>默认</option>
                            <?php for($i=2;$i<sizeof($list);$i++){ ?>
                                <option value="<?php echo $list[$i]; ?>"
                                 <?php echo $select==$list[$i]?"selected":""; ?>><?php echo $list[$i]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- 新闻内容 -->
                <br><br><div class="row">
                    <div class="col-sm-2" style="height:50px;line-height:50px;font-size:16px;">
                        正文：
                    </div>
                    <div class="col-sm-10" style="height:50px">
                    <!-- 输入的文本 -->
                        <textarea name="news_content" id="news_content" cols="30" rows="25"
                            class="form-control"><?php echo empty($res->content)?"":$res->content; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- 新闻操作 -->
                <br><br>
                <?php if(empty($res->id)){ ?>
                    <!-- 新增新闻 -->
                    <button class="btn btn-info" id="reset">重置</button>
                    <button class="btn btn-success" id="send">提交</button>
                <?php }else if($type=="update"){?>
                    <!-- 新闻更新 -->
                    <button class="btn btn-info" id="reset">重置</button>
                    <button class="btn btn-primary" id="update" data-id="<?php echo $res->id; ?>">更新</button>
                <?php }else{?>
                    <!-- 审核新闻 -->
                    <button class="btn btn-danger" id="news_fail" data-id="<?php echo $res->id; ?>">不通过</button>
                    <button class="btn btn-success" id="news_pass" data-id="<?php echo $res->id; ?>">通过</button>
                <?php }?>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div> <!-- end-container -->
</body>
</html>