using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

using System.Data;
using System.Data.SqlClient;
using System.Configuration;

public partial class shiliang : System.Web.UI.Page
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
                cmd.CommandText = "select top 12 tagtext,addpath,uploadby,id from pic_list where tag='shiliang' order by id desc";
                sdr = cmd.ExecuteReader();
                homepic.DataSource = sdr; //将查询的结果绑定到数据控件
                homepic.DataBind();
                sdr.Close(); cmd.Dispose(); conn.Close();
            }
        }
    }
}