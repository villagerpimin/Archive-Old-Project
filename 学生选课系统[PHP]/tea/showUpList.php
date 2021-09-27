<?php
    /* 用于展示通过浏览标签传递的修改项 */
    $upId=$_POST['upId']; //获得发送的课程号
    include("../connect.php");
    $CouInfo="select * from course where CouNo='$upId'";
    $CouRes=mysqli_query($conn,$CouInfo);
    $CouRow=mysqli_fetch_array($CouRes);
    echo <<<html
            <div class="list-group-item">
                <label for="upcno" class="control-label">课程号：</label>
                <input type="text" name="upcno" id="upcno" class="form-control"
                    value="{$CouRow['CouNo']}" readonly>
                <br>
                <label for="upcname">课程名</label>
                <input type="text" name="upcname" id="upcname" class="form-control"
                    value="{$CouRow['CouName']}">
                <br>
                <label for="upckind">课程类型</label>
                <select name="upckind" id="upckind" class="form-control">`
        html;
                    //从数据库读取类型并输出
                    $getKind="select distinct kind from course"; //不重复查询
                    $reKind=mysqli_query($conn,$getKind);
                    while($kindRow=mysqli_fetch_array($reKind)){
                        if($CouRow['Kind']==$kindRow[0]){
                            echo "<option value='$kindRow[0]' selected>$kindRow[0]</option>";
                        }
                        else {echo "<option value='$kindRow[0]'>$kindRow[0]</option>";}
                    }
        echo <<<html
                </select>
                <br>
                <label for="upccredit">课程学时</label>
                <input type="number" name="upccredit" id="upccredit" class="form-control"
                    value="{$CouRow['Credit']}">
                <br>
                <label for="upctea">任课教师</label>
                <input type="text" name="upctea" id="upctea" class="form-control"
                    value="{$CouRow['Teacher']}">
                <br>
                <label for="upcdepart">任课教师所属院系</label>
                <select name="upcdepart" id="upcdepart" class="form-control">
        html;
                        //从数据库读取院系信息
                        $getDepart="select * from department";
                        $reDepart=mysqli_query($conn,$getDepart);
                        while($departRow=mysqli_fetch_array($reDepart)){
                            if($CouRow['DepartNo']==$departRow[0]){
                                echo "<option value='$departRow[0]' selected>$departRow[1]</option>";
                            }
                            else{echo "<option value='$departRow[0]'>$departRow[1]</option>";}
                        }
        echo <<<html
                </select>
                <br>
                <label for="upctime">任课时间</label>
                <input type="text" name="upctime" id="upctime" class="form-control"
                    value='{$CouRow['SchoolTime']}'>
                <br>
                <label for="upclimt">限制选修人数</label>
                <input type="number" name="upclimt" id="upclimt" class="form-control"
                    value='{$CouRow['LimitNum']}'>
                <br>
            </div>    
    html;
?>