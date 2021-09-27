using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

using System.Configuration;
using System.Data.SqlClient;
using System.Data;

public partial class index : System.Web.UI.Page
{
    string sql = ConfigurationManager.ConnectionStrings["GalleryConnectionString"].ConnectionString;
    SqlConnection conn;
    SqlCommand cmd;
    SqlDataReader sdr;
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!Page.IsPostBack)
        {
            //通过ado编程读取数据库内容
            conn = new SqlConnection(sql);
            using (conn)
            {
                conn.Open();
                cmd = conn.CreateCommand();
                cmd.CommandText = "select top 12 tagtext,addpath,uploadby,id from pic_list where tag='pic' order by id desc";
                sdr = cmd.ExecuteReader();
                homepic.DataSource = sdr; //将查询的结果绑定到数据控件
                homepic.DataBind();
                sdr.Close(); cmd.Dispose(); conn.Close();
            }
        }
    }
}