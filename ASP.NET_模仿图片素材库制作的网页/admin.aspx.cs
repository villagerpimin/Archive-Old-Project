using System;
using System.Collections;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class admin : System.Web.UI.Page
{
    string sql = ConfigurationManager.ConnectionStrings["GalleryConnectionString"].ConnectionString;
    SqlConnection conn;
    SqlCommand cmd;
    SqlDataReader sdr;
    string username;
    protected void Page_Load(object sender, EventArgs e)
    {
        username = Session["user"]!=null?Session["user"].ToString():"null";
        if (!Page.IsPostBack)
        {
            //判断是否为管理员
            using (conn)
            {
                conn = new SqlConnection(sql);
                conn.Open();
                cmd = conn.CreateCommand();
                cmd.CommandText = "select purview from user_list where username='"+username+"'";
                int pur = Convert.ToInt32(cmd.ExecuteScalar());
                if (pur!=1) //权限不够时
                {
                    Response.Write("<script>alert('登录的不是管理员账号或者会话已过期！请重新登录');location.href='./index.aspx'</script>");
                }
            }
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
        string picP =pic.FileName; //获得上传图片的文件路径

        string upBy = Request.Params["user"]; //获得传递的上传者id
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
                //Response.Write(insert);
                cmd.CommandText = insert;
                int affectRow = cmd.ExecuteNonQuery(); //执行语句
                if (affectRow != 0)
                {
                    Response.Write("<script>alert('上传成功！')</script>");
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
    }/*插入提交点击事件*/

    /* 将输入的图片id的信息输出到修改中 */
    protected void snedUpId_Click(object sender, EventArgs e)
    {
        string getPicId = updateId.Text.ToString(); //获取要修改的图片id
        using (conn)
        {
            conn = new SqlConnection(sql);
            conn.Open();
            cmd = conn.CreateCommand();
            cmd.CommandText = "select * from pic_list where id="+getPicId;
            sdr = cmd.ExecuteReader();
            //查询id只能获得一条数据
            if (sdr.Read())
            {
                //将获取的数据填入相应控件
                uPicid.Text = Picid.Text = sdr.GetInt32(0).ToString();
                uPiclx.SelectedValue = Piclx.SelectedValue = sdr.GetString(1);
                uPictext.Text = Pictext.Text = sdr.GetString(2);
                uPicimg.ImageUrl = Picimg.ImageUrl = sdr.GetString(3);
                uPicurl.Text = sdr.GetString(3);
                uPicwidth.Text = yPicwidth.Text = sdr.GetInt32(5).ToString();
                uPicheight.Text = yPicheight.Text = sdr.GetInt32(6).ToString();
            }
            else
            {
                Response.Write("<script>alert('没有这张图片！')</script>");
            }
        }
    }
    /* 提交修改 */
    protected void sendUpic_Click(object sender, EventArgs e)
    {
        string upLx = uPiclx.SelectedValue; //图片类型
        string upText = uPictext.Text; //图片标签
        string upUrl = uPicurl.Text; //图片路径
        string upWidth = uPicwidth.Text; //图片宽度
        string upHeight = uPicheight.Text; //图片高度
        using (conn)
        {
            conn = new SqlConnection(sql);
            conn.Open();
            cmd = conn.CreateCommand();
            string update = "update pic_list set tag='" + upLx + "',tagtext='"+upText+"'"+
                ",addpath='"+upUrl+"',imageWidth="+upWidth+",imageHeight="+upHeight+
                "where id="+updateId.Text.ToString();
            cmd.CommandText = update;
            int affectRow = cmd.ExecuteNonQuery();
            if (affectRow != 0)
            {
                Response.Write("<script>alert('更新成功！')</script>");
            }
            else
            {
                Response.Write("<script>alert('更新失败！')</script>");
            }
        }
    }

    //切换到用户界面
    protected void gotouser_Click(object sender, EventArgs e)
    {
        Response.Write("<script>location.href='./user.aspx?usn="+username+"'</script>");
    }
}