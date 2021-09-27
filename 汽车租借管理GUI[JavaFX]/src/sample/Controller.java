package sample;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.input.KeyEvent;
import javafx.scene.input.MouseEvent;
import javafx.stage.Stage;

import javax.swing.*;
import java.io.*;
import java.sql.*;
import java.util.HashSet;

public class Controller extends Main{
    //用于连接数据库
    Connection conn=null;
    ResultSet rs=null;
    PreparedStatement prestmt=null;
    Statement stmt=null;

    String driver="com.mysql.cj.jdbc.Driver";
    String url="jdbc:mysql://localhost:3306/ffcar?serverTimezone=UTC";
    String sqluser="root";
    String sqlpwd="123";
    //获取登录输入
    @FXML ComboBox<String> username;
    @FXML private  PasswordField upwd;
    //获取登录成功的账号和密码，用于后期获取vip等级
    static String logname=null,logpwd=null,wel=null; //wel为欢迎语

    //登录事件
    public void upuserdate() throws Exception{
        username.getItems().setAll(); //先清理防止重复
        //读取数据并加入到HashSet集合中(过滤重复)
        try { //文件已初始化时
            BufferedReader br=new BufferedReader(new FileReader("user.conf"));
            HashSet<String> set= new HashSet<>();
            String str;
            while ((str=br.readLine())!=null){ //遍历并添加到集合中
                set.add(str);
            }
            br.close();
            //向下拉框添加数据
            for (String s : set) {
                username.getItems().add(s);
            }
        }
        catch (Exception e){ //如果发现没有文件时，创建文件
            File file=new File("user.conf");
            file.createNewFile();
        }
    }

    @FXML protected void login(ActionEvent e) throws Exception{
        String uname=username.getValue(); //获取账号
        String pwd=upwd.getText();  //获取密码
        int v; //用于设置销售页的的欢迎字段
        Class.forName(driver);
        conn=DriverManager.getConnection(url,sqluser,sqlpwd); //连接数据库
        prestmt=conn.prepareStatement("select * from tb_ffcar "+
                "where name =? and pwd=?");
        prestmt.setString(1,uname);
        prestmt.setString(2,pwd);
        rs=prestmt.executeQuery();
        while (rs.next()){
            v=rs.getInt("vip");
            wel="欢迎，尊贵的vip"+v+"用户。来选择你想要租借的车辆吧！";
        }
        if (wel!=null){ //如果欢迎内容为空，则表示没有查询到数据
            //将登录的账号密码保存
            logname=uname;
            logpwd=pwd;
            //写入可追加的数据
            BufferedWriter bw=new BufferedWriter(new FileWriter("user.conf",true));
            bw.write(logname+"\n");
            bw.close();
            try {  //验证成功时切换租借界面
                Parent zj = FXMLLoader.load(getClass().getResource("sale.fxml"));
                Scene Operation_Creating_Scene = new Scene(zj);

                //获取当前界面
                Stage CreateOperation_Stage = (Stage) ((Node) e.getSource()).getScene().getWindow();
                CreateOperation_Stage.hide();  //隐藏当前界面
                CreateOperation_Stage.setTitle("租借");
                CreateOperation_Stage.setScene(Operation_Creating_Scene);  //加载新界面
                CreateOperation_Stage.show(); //显示新界面
            }
            catch (Exception ee){System.out.println("页面加载异常");}
        }
        else {JOptionPane.showMessageDialog(null,"账号或密码不正确，如果没有账号请先注册！");}
    }

    //获取注册的文本输入
    @FXML private TextField regname;
    @FXML private TextField regpwd;
    @FXML private TextField regpwdtoo;
    //注册事件
    public void regdenglu(ActionEvent e) throws Exception{
        String name=regname.getText();  //获取账号
        String pwd=regpwd.getText();  //获取密码
        String ptoo=regpwdtoo.getText(); //对比密码
        int update=0,v=1;
        //新创建的用户会员等级默认为1
        wel="欢迎，尊贵的vip"+v+"用户。来选择你想要租借的车辆吧！";
        if(pwd.equals(ptoo)){
            Class.forName(driver);
            conn=DriverManager.getConnection(url,sqluser,sqlpwd); //连接数据库
            prestmt=conn.prepareStatement("insert into tb_ffcar(name,pwd) "+
                    "values(?,?)");
            prestmt.setString(1,name);
            prestmt.setString(2,pwd);
            update= prestmt.executeUpdate();
            //将登录的账号密码保存
            logname=name;
            logpwd=pwd;
        }
        else {JOptionPane.showMessageDialog(null,"两次输入的密码不同，请检查！");}
        if (update!=0){
            try {  //验证成功时切换租借界面
                Parent zj = FXMLLoader.load(getClass().getResource("sale.fxml"));
                Scene Operation_Creating_Scene = new Scene(zj);

                //获取当前界面
                Stage CreateOperation_Stage = (Stage) ((Node) e.getSource()).getScene().getWindow();
                CreateOperation_Stage.hide();  //隐藏当前界面
                CreateOperation_Stage.setTitle("租借");
                CreateOperation_Stage.setScene(Operation_Creating_Scene);  //加载新界面
                CreateOperation_Stage.show(); //显示新界面
            }
            catch (Exception ee){System.out.println("页面加载异常");}
        }
        else {JOptionPane.showMessageDialog(null,"注册失败，请重试！");}
    }


    /*菜单点击事件*/
//退出
    public void exit() {
        System.exit(0);
    }
    //初始化数据库
    public void chushi() throws Exception{
        Class.forName(driver);
        conn=DriverManager.getConnection(url,sqluser,sqlpwd); //连接数据库
        stmt= conn.createStatement();
        rs=stmt.executeQuery("show tables like 'tb_ffcar'"); //查询是否有表
        //添加数据
        //创建新表
        if(rs.next()){ //有表且有数据时，清空表并重新加载表
            stmt.execute("drop table tb_ffcar");//删除旧表
        }
        stmt.execute("create table tb_ffcar(id int primary key auto_increment,"+
                "name varchar(20),pwd varchar(20),vip int default 1,"+
                "ss int default 0,mm int default 0,bb int default 0)"); //创建新表
        stmt.execute("insert into tb_ffcar(name,pwd,vip) values('1930634','123',3)");//添加数据
        JOptionPane.showMessageDialog(null,"初始化成功！");
    }
    //显示租借规则弹窗
    public void rule(ActionEvent event) {
        //创建一个文本块
        String about= """
                租借价格按会员等级进行优惠折扣，vip1无优惠。
                vip2享受9.5折优惠
                vip3享受9折优惠
                每个用户最多租借100辆汽车，如有更大需求可以上门面谈。
                \t""";
        JOptionPane.showConfirmDialog(null,about,"租借规则", JOptionPane.OK_CANCEL_OPTION);
    }


    /*面板切换*/
    //前往登录页
    public void denglu(ActionEvent e) {
        try {  //切换登录界面
            logname=null;logpwd=null;wel=null; //初始化
            Scene reg = new Scene(FXMLLoader.load(getClass().getResource("sample.fxml")));
            //获取当前界面
            Stage CreateOperation_Stage = (Stage) ((Node) e.getSource()).getScene().getWindow();
            CreateOperation_Stage.hide();  //隐藏当前界面
            CreateOperation_Stage.setTitle("登录");
            CreateOperation_Stage.setScene(reg);  //加载新界面
            CreateOperation_Stage.show(); //显示新界面
        }
        catch (Exception ee){System.out.println("页面加载异常");}
    }
    //前往注册页
    public void reg(ActionEvent e) {
        try {  //切换注册界面
            Scene reg = new Scene(FXMLLoader.load(getClass().getResource("reguser.fxml")));
            //获取当前界面
            Stage CreateOperation_Stage = (Stage) ((Node) e.getSource()).getScene().getWindow();
            CreateOperation_Stage.hide();  //隐藏当前界面
            CreateOperation_Stage.setTitle("注册");
            CreateOperation_Stage.setScene(reg);  //加载新界面
            CreateOperation_Stage.show(); //显示新界面
        }
        catch (Exception ee){System.out.println("页面加载异常");}
    }
    //切换查询租借情况面板
    public void findsale(ActionEvent event) {
        try {  //切换查询界面
            Scene find = new Scene(FXMLLoader.load(getClass().getResource("remand.fxml")));
            //获取当前界面
            Stage CreateOperation_Stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
            CreateOperation_Stage.hide();  //隐藏当前界面
            CreateOperation_Stage.setTitle("查询");
            CreateOperation_Stage.setScene(find);  //加载新界面
            CreateOperation_Stage.show(); //显示新界面
        }
        catch (Exception ee){System.out.println("页面加载异常");}
    }
    //归还切换销售面面板
    public void resale(ActionEvent event){
        try {  //切换查询界面
            Scene sale = new Scene(FXMLLoader.load(getClass().getResource("sale.fxml")));
            //获取当前界面
            Stage CreateOperation_Stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
            CreateOperation_Stage.hide();  //隐藏当前界面
            CreateOperation_Stage.setTitle("销售");
            CreateOperation_Stage.setScene(sale);  //加载新界面
            CreateOperation_Stage.show(); //显示新界面
        }
        catch (Exception ee){System.out.println("页面加载异常");}
    }


//销售提交
    //获取销售欢迎字段
    @FXML private Label welcome;
    //获取三种类型的多选框
    @FXML private CheckBox smbox;
    @FXML private CheckBox mmbox;
    @FXML private CheckBox bbbox;
    //获取三种类型需要租借的天数框
    @FXML private TextField smdays;
    @FXML private TextField mmdays;
    @FXML private TextField bbdays;

    @FXML private Slider smroll; //获取轿车的滚动条
    @FXML private TextField smtext; //获取轿车的文本框
    @FXML private Slider mmroll; //获取客车的滚动条
    @FXML private TextField mmtext; //获取客车的文本框
    @FXML private Slider bbroll; //获取货车的滚动条
    @FXML private TextField bbtext; //获取货车的文本框
    double db; //用于判断多选框是否划勾
    double smro=0,mmro=0,bbro=0;
    //用于设置销售页的欢迎提示
    public void wwe() {
        welcome.setText(wel);
    }
    public void sms(MouseEvent mouseEvent) { //轿车的滚动条被拉动时触发
        smro=smroll.getValue();
        smtext.setText(String.valueOf((int)smro));
        //同步复选框和时间框
        db=smroll.getValue();
        if (db<=0){smdays.setText("0");}
        else {smdays.setText("1");}
        smbox.setSelected(db >= 1);
    }
    public void mms(MouseEvent mouseEvent) { //客车的滚动条被拉动时触发
        mmro=mmroll.getValue();
        mmtext.setText(String.valueOf((int)mmro));
        db=mmroll.getValue();
        if (db<=0){mmdays.setText("0");}
        else {mmdays.setText("1");}
        mmbox.setSelected(db >= 1);
    }
    public void bbs(MouseEvent mouseEvent) { //货车的滚动条被拉动时触发
        bbro=bbroll.getValue();
        bbtext.setText(String.valueOf((int)bbro));
        db=bbroll.getValue();
        if (db<=0){bbdays.setText("0");}
        else {bbdays.setText("1");}
        bbbox.setSelected(db >= 1);
    }
    public void sment(KeyEvent event) {  //轿车文本框被按下回车时触发
        smroll.setValue(Double.parseDouble(smtext.getText()));
        db=smroll.getValue();
        if (db<=0){smdays.setText("0");}
        else {smdays.setText("1");}
        smbox.setSelected(db >= 1);
    }
    public void mment(KeyEvent event) { //客车文本框被按下文本框时触发
        mmroll.setValue(Double.parseDouble(mmtext.getText()));
        db=mmroll.getValue();
        if (db<=0){mmdays.setText("0");}
        else {mmdays.setText("1");}
        mmbox.setSelected(db >= 1);
    }
    public void bbent(KeyEvent event) { //货车文本框被按下文本框时触发
        bbroll.setValue(Double.parseDouble(bbtext.getText()));
        db=bbroll.getValue();
        if (db<=0){bbdays.setText("0");}
        else {bbdays.setText("1");}
        bbbox.setSelected(db >= 1);
    }

    //提交按钮被点击时
    public void sub(ActionEvent e) throws Exception{
        /*数据库中ss为轿车租借数量；mm为客车租借数量；bb为货车租借数量
          租借的数量以文本框的输入为准，smtext为轿车，mmtext为客车，bbtext为货车
          smday为轿车租用时间，mmday为客车租用时间，bbday为货车租用时间
        */
        //获取每个类型租借的数量
        int smnum,mmnum,bbnum;
        smnum= Integer.parseInt(smtext.getText());
        mmnum= Integer.parseInt(mmtext.getText());
        bbnum= Integer.parseInt(bbtext.getText());
        double smsum=0,mmsum=0,bbsum=0,sum; //用于计算每个类型的总价
        int vvip=1; //获取当前用户的会员等级，用于计算折扣
        //获取每个类型租借的时间
        int smday,mmday,bbday;
        smday= Integer.parseInt(smdays.getText());
        mmday= Integer.parseInt(mmdays.getText());
        bbday= Integer.parseInt(bbdays.getText());
        //连接数据库
        Class.forName(driver);
        conn=DriverManager.getConnection(url,sqluser,sqlpwd);
        //获取当前正在登录的账号
        prestmt= conn.prepareStatement("select * from tb_ffcar "+
                "where name =? and pwd=?");
        prestmt.setString(1,logname);
        prestmt.setString(2,logpwd);
        rs=prestmt.executeQuery();
        while (rs.next()){//获取当前用户的会员等级
            vvip=rs.getInt("vip");
        }
        if (vvip==1){  //会员等级为1时
            if (smbox.isSelected()){ //轿车500/天
                smsum=smnum*500*smday;
            }
            if (mmbox.isSelected()){ //客车400/天
                mmsum=mmnum*400*mmday;
            }
            if (smbox.isSelected()){ //货车800/天
                bbsum=bbnum*800*bbday;
            }
            sum=smsum+bbsum+mmsum;
            JOptionPane.showMessageDialog(null,"提交成功！"+
                    "请核对您的租借信息：\n"+
                    "轿车"+smnum+"辆"+smday+"天\n"+
                    "客车"+mmnum+"辆"+mmday+"天\n"+
                    "货车"+bbnum+"辆"+bbday+"天\n"+
                    "您需要支付"+sum+"元");
        }
        else if (vvip==2){  //会员等级为2时
            if (smbox.isSelected()){ //轿车500/天
                smsum=smnum*500*smday;
            }
            if (mmbox.isSelected()){ //客车400/天
                mmsum=mmnum*400*mmday;
            }
            if (smbox.isSelected()){ //货车800/天
                bbsum=bbnum*800*bbday;
            }
            sum=(smsum+bbsum+mmsum)*0.95; //会员等级2打95折
            JOptionPane.showMessageDialog(null,"提交成功！"+
                    "请核对您的租借信息：\n"+
                    "轿车"+smnum+"辆"+smday+"天\n"+
                    "客车"+mmnum+"辆"+mmday+"天\n"+
                    "货车"+bbnum+"辆"+bbday+"天\n"+
                    "您需要支付"+sum+"元");
        }
        else if (vvip==3){  //会员等级为1时
            if (smbox.isSelected()){ //轿车500/天
                smsum=smnum*500*smday;
            }
            if (mmbox.isSelected()){ //客车400/天
                mmsum=mmnum*400*mmday;
            }
            if (smbox.isSelected()){ //货车800/天
                bbsum=bbnum*800*bbday;
            }
            sum=(smsum+bbsum+mmsum)*0.9; //会员等级3打9折
            JOptionPane.showMessageDialog(null,"提交成功！"+
                    "请核对您的租借信息：\n"+
                    "轿车"+smnum+"辆"+smday+"天\n"+
                    "客车"+mmnum+"辆"+mmday+"天\n"+
                    "货车"+bbnum+"辆"+bbday+"天\n"+
                    "您需要支付"+sum+"元");
        }

        //支付完成后（点击了确认）数据库增加租借车辆的数量
        prestmt=conn.prepareStatement("update tb_ffcar set ss=ss+?"+
                ",mm=mm+?,bb=bb+? where name=? and pwd=?");
        prestmt.setString(1, String.valueOf(smnum));
        prestmt.setString(2, String.valueOf(mmnum));
        prestmt.setString(3, String.valueOf(bbnum));
        prestmt.setString(4,logname);
        prestmt.setString(5,logpwd);
        prestmt.execute();
    }


    //车辆归还
    @FXML Label userwol; //欢迎语
    @FXML Label leasm;  //已租借轿车
    @FXML Label leamm; //已租借客车
    @FXML Label leabb; //已租借货车
    int smnum,mmnum,bbnum; //用于获取租借数量
    //进入该面板时触发，将已租借标签刷新并更新提示语
    public void remandstart(MouseEvent mouseEvent) throws Exception{
        //设置欢迎语
        String welcome="用户 "+logname+" 您好！您当前租借的车辆总数如下：";
        userwol.setText(welcome);
        //设置已租借信息
        Class.forName(driver);
        conn=DriverManager.getConnection(url,sqluser,sqlpwd);
        prestmt=conn.prepareStatement("select * from tb_ffcar where "+
                "name=? and pwd=?");
        prestmt.setString(1,logname);
        prestmt.setString(2,logpwd);
        rs= prestmt.executeQuery();
        while (rs.next()){
            smnum=rs.getInt("ss"); //获取轿车
            mmnum=rs.getInt("mm"); //获取客车
            bbnum=rs.getInt("bb"); //获取货车
            leasm.setText(smnum+" 辆"); //设置轿车
            leamm.setText(mmnum+" 辆"); //设置客车
            leabb.setText(bbnum+" 辆"); //设置货车
        }
    }

    //获取输入的归还数量
    @FXML TextField smrem;
    @FXML TextField mmrem;
    @FXML TextField bbrem;

    public void remandcar(ActionEvent event) throws Exception{
        //获取要归还的数量
        int smr= Integer.parseInt(smrem.getText()); //小
        int mmr= Integer.parseInt(mmrem.getText()); //中
        int bbr= Integer.parseInt(bbrem.getText()); //大
        //获取已租借的数量
        int lsm= smnum; //小
        int lmm= mmnum; //中
        int lbb= bbnum; //大
        //检查归还数量是否合理
        if(smr<=lsm){ //归还是否小于等于租借数量，合法则进入下一步判断
            if(mmr<=lmm){ //判断客车，同样合法进入下一步判断
                if(bbr<=lbb){
                    //当判断所有输入项合法时，开始进行处理
                    Class.forName(driver);
                    conn=DriverManager.getConnection(url,sqluser,sqlpwd);
                    stmt=conn.createStatement();
                    stmt.execute("update tb_ffcar set ss=ss-"+smr+
                            ",mm=mm-"+mmr+",bb=bb-"+bbr+" where name="+
                            logname+" and pwd="+logpwd);

                    int flag=1; //默认不退出
                    flag=JOptionPane.showConfirmDialog(null,
                            "已归还，感谢您的使用\n\n是否退出程序?",
                            "提示",
                            JOptionPane.YES_NO_OPTION);
                    if(flag==0){System.exit(0);}  //用户点击确认时
                }
                else {
                    JOptionPane.showMessageDialog(null,
                            "您输入的 '货车' 归还数量超出租借数量了！",
                            "警告",
                            JOptionPane.WARNING_MESSAGE);
                }
            }
            else {
                JOptionPane.showMessageDialog(null,
                        "您输入的 '客车' 归还数量超出租借数量了！",
                        "警告",
                        JOptionPane.WARNING_MESSAGE);
            }
        }
        else {
            JOptionPane.showMessageDialog(null,
                    "您输入的 '轿车' 归还数量超出租借数量了！",
                    "警告",
                    JOptionPane.WARNING_MESSAGE);
        }
    }

}