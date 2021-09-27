using Microsoft.SqlServer.Server;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class user : System.Web.UI.Page
{
    public string username = "null"; //用户显示
    string sql = ConfigurationManager.ConnectionStrings["GalleryConnectionString"].ConnectionString;
    SqlConnection conn;
    SqlCommand cmd;
    SqlDataReader sdr;
    public int row_num;

    protected void Page_Load(object sender, EventArgs e)
    {
        username = Session["user"]!=null?Session["user"].ToString():"null"; //没有登录用户名则为null
        Page.DataBind();
        using (conn)
        {
            conn = new SqlConnection(sql);
            conn.Open();
            cmd = conn.CreateCommand();
            cmd.CommandText = "select userpic from user_list where username='"+username+"'";
            sdr = cmd.ExecuteReader();
            if (sdr.Read())
            {
                if (!sdr.IsDBNull(0)) //判断当前列是否含有数据
                {
                    //用户有设置头像则从数据库读取
                    userimg.ImageUrl = sdr.GetString(0);
                }
                else
                {
                    //没有头像则使用默认的
                    userimg.ImageUrl = "~/images/admin.jpg";
                }
            }
        }/*用户头像显示*/

        using (conn)
        {
            conn = new SqlConnection(sql);
            conn.Open();
            cmd = conn.CreateCommand();
            cmd.CommandText = "select count(*) from pic_list where uploadby='"+username+"'"; //用于查看总数
            row_num = Convert.ToInt32(cmd.ExecuteScalar()); //获得总数
            Page.DataBind();

            sdr.Close();cmd.Dispose();

            cmd.CommandText = "select top 9 * from pic_list where uploadby='" + username + "' order by id desc";
            sdr = cmd.ExecuteReader();
            if (sdr.HasRows)
            {
                spic.DataSource = sdr;
                spic.DataBind();
                nopic.Visible = false;
                sdr.Close(); cmd.Dispose(); conn.Close();
            }
            else //没有上传过图片时显示
            {
                nopic.Visible = true;
            }
        }/*用户上传的图片展示*/
    }

    protected void userExit_Click(object sender, EventArgs e)
    {
        Session.Abandon();
        Response.Write("<script>location.href='./index.aspx'</script>");
    }

    //用户编辑个人资料
    protected void useredit_Click(object sender, EventArgs e)
    {
        showpic.Visible = false;
        uedit.Visible = true;
        newpic.Visible = false;
        using (conn)
        {
            conn = new SqlConnection(sql);
            conn.Open();
            cmd = conn.CreateCommand();
            cmd.CommandText = "select userpic from user_list where username='" + username + "'";
            sdr = cmd.ExecuteReader();
            if (sdr.Read())
            {
                if (!sdr.IsDBNull(0)) //判断当前列是否含有数据
                {
                    //用户有设置头像则从数据库读取
                    simg.ImageUrl = sdr.GetString(0);
                }
                else
                {
                    //没有头像则使用默认的
                    simg.ImageUrl = "~/images/admin.jpg";
                }
            }
        }/*用户头像显示*/
    }

    //用户更新头像
    protected void Button1_Click(object sender, EventArgs e)
    {
        if (uimg.HasFile) //判断用户是否上传了文件，以判断上传的路径
        {
            //上传为文件时
            string path = Server.MapPath("~/images/user/"); //定义上传文件的路径
            string fileName = DateTime.Now.Ticks.ToString(); //修改文件名为当前时间戳     
            string[] str = uimg.FileName.Split('.'); //获取文件的后缀名
            //限制只能上传图片
            if (str[str.Length - 1].ToLower() != "jpg" &&
                    str[str.Length - 1].ToLower() != "gif" &&
                    str[str.Length - 1].ToLower() != "png" &&
                    str[str.Length - 1].ToLower() != "jpeg" &&
                    str[str.Length - 1].ToLower() != "bmp")
            {
                Response.Write("<script>alert('只能上传图片文件!')</script>");
                return;
            }
            //保存文件的路径
            string localPic = path + fileName + "." + (str[str.Length - 1].ToLower());
            //设置存入数据库的路径
            string sqlPath = "~/images/user/" + fileName + "." + (str[str.Length - 1].ToLower());
            using (conn)
            {
                conn = new SqlConnection(sql);
                conn.Open();
                cmd = conn.CreateCommand();
                cmd.CommandText = "update user_list set userpic='"+sqlPath+"' where username='"+username+"'";
                if (cmd.ExecuteNonQuery()!=0)
                {
                    Response.Write("<script>alert('更新成功！');location.href='./user.aspx?usn="+username
                        +"'</script>");
                    uimg.SaveAs(localPic); //数据库有数据后再上传文件
                }
                else {
                    Response.Write("<script>alert('更新失败！')");
                }
            }
        }//有文件时
        else //没文件时
        {
            if (uimgwl.Text != "")
            {
                using (conn)
                {
                    conn = new SqlConnection(sql);
                    conn.Open();
                    cmd = conn.CreateCommand();
                    cmd.CommandText = "update user_list set userpic='" + uimgwl.Text + "' where username='" + username + "'";
                    if (cmd.ExecuteNonQuery() != 0)
                    {
                        Response.Write("<script>alert('更新成功！');location.href='./user.aspx?usn=" + username
                            + "'</script>");
                    }
                    else
                    {
                        Response.Write("<script>alert('更新失败！')");
                    }
                }
            }
            else { Response.Write("<script>alert('没有数据！')");  }
        }
    }

    //更新密码
    protected void uppwd_Click(object sender, EventArgs e)
    {
        string oldpwd;
        using (conn)
        {
            //查询旧密码
            conn = new SqlConnection(sql);
            conn.Open();
            cmd = conn.CreateCommand();
            cmd.CommandText = "select password from user_list where username='"+username+"'";
            oldpwd = cmd.ExecuteScalar().ToString();
        }
        string npwd = newpwd.Text;
        string renpwd = renewpwd.Text;
        if (npwd.Equals(renpwd)) //两次输入无误时
        {
            using (conn)
            {
                conn = new SqlConnection(sql);
                conn.Open();
                cmd = conn.CreateCommand();
                cmd.CommandText = "update user_list set password='"+npwd+"' where username='"+username+"'";
                Response.Write(cmd.ExecuteNonQuery()!=0 ? 
                    "<script>alert('修改成功！');location.href='./user.aspx?usn="+username+"'</script>" :
                    "<script>alert('修改失败！')</script>");
            }
        }
        else
        {
            Response.Write("<script>alert('两次密码有误，请检查')</script>");
        }
    }

    /* 图片点击提交时 */
    protected void sendPic_Click(object sender, EventArgs e)
    {
        string leixin = picTag.SelectedValue; //获得选择的图片类型
        string pictext = tagText.Text; //获得图片的标签
        string width = picWidth.Text; //获得图片的宽度
        string height = picHeight.Text; //获得图片的高度

        string picU = picUrl.Text; //获得上传的图片Url链接
        string picP = pic.FileName; //获得上传图片的文件路径

        string upBy = username; //获得传递的上传者名称
        //上传文件
        if (pic.HasFile) //判断用户是否上传了文件，以判断上传的路径
        {
            //上传为文件时
            string path = Server.MapPath("~/images/pic/"); //定义上传文件的路径,默认为照片文件夹
            switch (leixin)
            {
                case "pic": //上传到照片文件夹
                    {
                        path = Server.MapPath("~/images/pic/");
                        break;
                    }
                case "chahua": //上传到插画文件夹
                    {
                        path = Server.MapPath("~/images/chahua/");
                        break;
                    }
                case "shiliang":
                    {
                        path = Server.MapPath("~/images/shiliang/");
                        break;
                    }
            }
            string fileName = DateTime.Now.Ticks.ToString(); //修改文件名为当前时间戳
                                                             //获取文件的后缀名
            string[] str = pic.FileName.Split('.');
            //限制只能上传图片
            if (str[str.Length - 1].ToLower() != "jpg" &&
                    str[str.Length - 1].ToLower() != "gif" &&
                    str[str.Length - 1].ToLower() != "png" &&
                    str[str.Length - 1].ToLower() != "jpeg" &&
                    str[str.Length - 1].ToLower() != "bmp")
            {
                Response.Write("<script>alert('只能上传图片文件!')</script>");
                return;
            }
            //保存文件的路径
            string localPic = path + fileName + "." + (str[str.Length - 1].ToLower());

            //将所有填入的信息上传到数据库
            using (conn)
            {
                conn = new SqlConnection(sql);
                conn.Open();
                cmd = conn.CreateCommand();
                //设置存入数据库的文件路径
                string sqlPath = "~/images/" + leixin + "/" + fileName + "." + (str[str.Length - 1].ToLower());
                string insert = "insert into pic_list(tag,tagtext,addpath,imageWidth,imageHeight," +
                    "uploadby) values('" + leixin + "','" + pictext + "','" + sqlPath + "'," +
                    width + "," + height + ",'" + upBy + "')";
                cmd.CommandText = insert;
                int affectRow = cmd.ExecuteNonQuery(); //执行语句
                if (affectRow != 0)
                {
                    Response.Write("<script>alert('上传成功！');location.href='./user.aspx?usn=" + username + "'</script>");
                    pic.SaveAs(localPic); //数据库有数据后再上传文件
                }
                else
                {
                    Response.Write("<script>alert('上传失败！')</script>");
                }
            }
        }
        else
        {
            //上传的图片为链接时
            using (conn)
            {
                conn = new SqlConnection(sql);
                conn.Open();
                cmd = conn.CreateCommand();
                string insert = "insert into pic_list(tag,tagtext,addpath,imageWidth,imageHeight," +
                    "uploadby) values('" + leixin + "','" + pictext + "','" + picU + "'," +
                    width + "," + height + ",'" + upBy + "')";
                //Response.Write(insert);
                cmd.CommandText = insert;
                int affectRow = cmd.ExecuteNonQuery(); //执行语句
                if (affectRow != 0)
                {
                    Response.Write("<script>alert('上传成功！')</script>");
                }
                else
                {
                    Response.Write("<script>alert('上传失败！')</script>");
                }
            }
        }
    }

    //点击上传图片时
    protected void uppic_Click(object sender, EventArgs e)
    {
        newpic.Visible = true;
        showpic.Visible = false;
        uedit.Visible = false;
    }
}