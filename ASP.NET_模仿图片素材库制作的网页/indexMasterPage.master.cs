using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class indexMasterPage : System.Web.UI.MasterPage
{
    string sql = ConfigurationManager.ConnectionStrings["GalleryConnectionString"].ConnectionString;
    SqlConnection conn;
    SqlCommand cmd;
    SqlDataReader sdr;
    protected void Page_Load(object sender, EventArgs e)
    {
        string url = Request.Url.LocalPath; //获取当前网页的位置
        if (url == "/index.aspx")
        {
            leixing.SelectedValue = "pic";
        }
        else if (url == "/shiliang.aspx")
        {
            leixing.SelectedValue = "shiliang";
        }
        else if (url == "/chahua.aspx")
        {
            leixing.SelectedValue = "chahua";
        }
        //判断是否登录
        if (Session["user"] != null)
        {
            notSess.Visible = false;  //隐藏登录&注册
            hasSess.Visible = true; //显示用户
            showLoginUser.Text = "欢迎！"+Session["user"];
            showLoginUser.NavigateUrl = "~/user.aspx?usn=" + Session["user"];
        }
    }

    /*搜索框的点击跳转*/
    protected void searpic_Click(object sender, EventArgs e)
    {
        string lx = leixing.SelectedValue; //获得选择的图片类型
        string inp = inptext.Text; //获得文本框的内容
        string url = "search.html?q=" + inp + "&lx=" + lx+"&page=1";
        Response.Redirect(url);
    }

    /*登录事件*/
    protected void userlog_Click(object sender, EventArgs e)
    {
        string name = username.Text; //获得用户名
        string pwd = userpwd.Text; //获得密码
        //连接数据库
        conn = new SqlConnection(sql);
        using (conn)
        {
            conn.Open();
            cmd = conn.CreateCommand();
            cmd.CommandText = "select * from user_list where username='"+name+"' and password='"+pwd+"'";
            sdr = cmd.ExecuteReader(); //执行查询语句
            if (sdr.Read())
            {
                Session["user"] = name; //存储用户会话
                Session.Timeout = 999;
                hasSess.Visible = true;
                notSess.Visible = false;
                showLoginUser.Text = "欢迎！" + Session["user"];
                showLoginUser.NavigateUrl = "~/user.aspx?usn="+name;

                //有值则判断是否为管理员
                if (sdr.GetInt32(3) == 1) //1为管理员
                {
                    Response.Write("<script>alert('登录成功！');location.href='./admin.aspx?user="+
                        name+"'</script>");
                }
                else
                {
                    //普通用户
                    Response.Write("<script>alert('登录成功！');location.href='./user.aspx?usn="+
                        name+"'</script>");
                }
            }
            else
            {
                //没值直接弹窗提示
                Response.Write("<script>alert('没有该用户！')</script>");
            }
        }
    }

    /*注册事件*/
    protected void userreg_Click(object sender, EventArgs e)
    {
        string name = username.Text; //获得用户名
        string pwd = userpwd.Text; //获得密码
        //连接数据库
        conn = new SqlConnection(sql);
        using (conn) {
            conn.Open();
            cmd = conn.CreateCommand();
            string insertUser = "insert into user_list(username,password,purview) values('" +
                name+"','"+pwd+"',0)";
            cmd.CommandText = insertUser;
            int num=cmd.ExecuteNonQuery();
            if (num != 0)
            {
                Response.Write("<script>alert('注册成功！');location.href='./user.aspx?usn=" +
                        name + "'</script>");
                Session["user"] = name;
                Session.Timeout = 9999;
                hasSess.Visible = true;
                notSess.Visible = false;
                showLoginUser.Text = "欢迎！" + Session["user"];
                showLoginUser.NavigateUrl = "~/user.aspx?usn=" + name;
            }
            else
            {
                Response.Write("<script>alert('注册失败！')</script>");
            }
        }
    }

    /* 用于退出登录(清除session) */
    protected void LinkButton1_Click(object sender, EventArgs e)
    {
        Session.Abandon(); //结束会话
        hasSess.Visible = false;
        notSess.Visible = true;
    }
   
}
