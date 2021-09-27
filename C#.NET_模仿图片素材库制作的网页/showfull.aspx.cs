using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

using System.Data;
using System.Data.SqlClient;
using System.Configuration;

public partial class showfull : System.Web.UI.Page
{
    string sql = ConfigurationManager.ConnectionStrings["GalleryConnectionString"].ConnectionString;
    SqlConnection conn;
    SqlCommand cmd;
    SqlDataReader sdr;
    public string tagText; //图片标签
    public int zanNum;
    public string picPath;
    public string lx; //图片类型
    public int wid; //图片宽度
    public int hei; //图片高度
    public int picid = 0; //图片id
    string loginUser; //登录的用户

    protected void Page_Load(object sender, EventArgs e)
    {
        string uploadby;
        if (Request.QueryString["id"] != null)
        {
            //判断是否登录
            if (Session["user"] != null)
            {
                notSess.Visible = false;  //隐藏登录&注册
                hasSess.Visible = true; //显示用户
                showLoginUser.Text = "欢迎！" + Session["user"];
                showLoginUser.NavigateUrl = "~/user.aspx?usn=" + Session["user"];
            }

            picid =int.Parse(Request.QueryString["id"]); //获得图片id
            //读取数据库图片信息
            using (conn)
            {
                conn = new SqlConnection(sql);
                conn.Open();
                cmd = conn.CreateCommand();
                cmd.CommandText = "select * from pic_list where id="+picid;
                sdr = cmd.ExecuteReader();
                if (sdr.Read())
                {
                    /*读取pic_list库中对应图片后读取用户数据*/
                    uploadby = sdr.GetString(7); //获得上传者
                    tagText = sdr.GetString(2).ToString();
                    picPath = sdr.GetString(3).ToString();
                    wid = sdr.GetInt32(5);
                    hei = sdr.GetInt32(6);
                    Image1.ImageUrl = picPath;
                    zanNum = sdr.GetInt32(4);
                    /*不同类型显示不同文本*/
                    switch (sdr.GetString(1).ToString())
                    {
                        case "pic":
                            {
                                lx = "照片";
                                break;
                            }
                        case "shiliang":
                            {
                                lx = "矢量图";
                                break;
                            }
                        case "chahua":
                            {
                                lx = "插画";
                                break;
                            }
                    }
                    sdr.Close(); cmd.Dispose();
                    /*读取用户数据*/
                    cmd.CommandText = "select * from user_list where username='"+uploadby+"'";
                    sdr=cmd.ExecuteReader();
                    if (sdr.Read())
                    {
                        img.ImageUrl = sdr.GetString(4);
                        username.Text = sdr.GetString(1);
                    }
                }
                else { Response.Write("<script>alert('没有数据！')</script>"); }
                Page.DataBind();
                sdr.Close(); cmd.Dispose(); conn.Close();
            }
            //显示评论对应头像
            using (conn)
            {
                conn = new SqlConnection(sql);
                conn.Open();
                cmd = conn.CreateCommand();
                loginUser = Session["user"] != null ? Session["user"].ToString() : "null"; //获取当前登录的用户
                tou.ToolTip = loginUser;
                if (!loginUser.Equals("null"))
                {
                    cmd.CommandText = "select userpic from user_list where username='"+loginUser+"'";
                    string touimg = cmd.ExecuteScalar().ToString();
                    tou.ImageUrl =!touimg.Equals(null)?touimg:"~/images/admin.jpg";
                }
                else
                {
                    //没有登录时
                    tou.ImageUrl = "~/images/admin.jpg";
                }
                
            }
            //显示评论内容
            using (conn)
            {
                conn = new SqlConnection(sql);
                conn.Open();
                cmd = conn.CreateCommand();
                cmd.CommandText = "select top 10 * from comment_list where picid=" + picid+"order by id desc"; //只显示前10条评论
                sdr = cmd.ExecuteReader();
                if (sdr.HasRows)
                {
                    sComm.DataSource = sdr;
                    sComm.DataBind();
                }
                else { noComm.Visible = true; }
            }
        }
        else
        {
            Response.Write("<script>alert('没有传递内容！')</script>");
        }
    }

    //点击点赞按钮时
    protected void zan_Click(object sender, EventArgs e)
    {
        try
        {
            conn = new SqlConnection(sql);
            conn.Open();
            cmd = conn.CreateCommand();
            cmd.CommandText = "update pic_list set likes=likes+1 where id=" + picid;//更新数据
            cmd.ExecuteNonQuery();
            cmd.Dispose();conn.Close();
        }
        catch
        {
            Response.Write("<script>alert('点赞失败')"+ Request.QueryString["id"] + "</script>");
        }
        finally
        {
            cmd.Dispose();conn.Close();
        }
    }

    //发表评论
    protected void commSend_Click(object sender, EventArgs e)
    {
        using (conn)
        {
            conn = new SqlConnection(sql);
            conn.Open();
            cmd = conn.CreateCommand();
            //向获取当前用户的头像
            cmd.CommandText = "select userpic from user_list where username='" + loginUser + "'";
            string touimg = cmd.ExecuteScalar() != null? cmd.ExecuteScalar().ToString(): "~/images/admin.jpg";
            //touimg = !touimg.Equals(null) ? touimg : "~/images/admin.jpg";
            cmd.Dispose();
            //向数据库增加数据
            cmd.CommandText = "insert into comment_list values("+picid+",'"+comm.Text+"','"+loginUser+"','"+
                DateTime.Now.ToString()+"','"+touimg+"')"; //插入评论
            int arrow=cmd.ExecuteNonQuery();
            Response.Write(arrow!=0?"<script>alert('评论成功！');location.href='./showfull.aspx?id="+picid+"'</script>":
                "<script>alert('评论失败！');</script>");
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