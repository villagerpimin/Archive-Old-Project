<%@ Page Language="C#" AutoEventWireup="true" CodeFile="user.aspx.cs" Inherits="user" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>用户页面</title>
    <link rel="stylesheet" href="css/animate.min.css" />
    <link rel="stylesheet" href="js/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/userStyle.css" />
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</head>
<body>
    <form id="form1" runat="server">
    <div>
        <!--用户界面-->
        <div class="container">
            <!--导航栏-->
            <div class="navbar">
            <div class="navbar-header">
                <!--logo-->
                <div class="navbar-brand">
                    pixabay
                </div>
            </div>
                <!--导航项-->
                <nav>
                    <ul class="nav navbar-nav">
                        <li>
                            <asp:Hyperlink ID="picture" runat="server" NavigateUrl="index.aspx">照片</asp:Hyperlink></li>
                        <li>
                            <asp:Hyperlink ID="chahua" runat="server" NavigateUrl="chahua.aspx">插画</asp:Hyperlink></li>
                        <li>
                            <asp:Hyperlink ID="shiliang" runat="server" NavigateUrl="shiliang.aspx">矢量</asp:Hyperlink></li>
                        <li>
                            <asp:Hyperlink ID="video" runat="server" NavigateUrl="#">视频</asp:Hyperlink></li>
                        <li>
                            <asp:Hyperlink ID="music" runat="server" NavigateUrl="#">音乐</asp:Hyperlink></li>
                    </ul>
                </nav>
                <ul class="nav navbar-nav navbar-right">
                    <li><asp:HyperLink ID="showLoginUser" runat="server" 
                        Text='<%# Session["user"]!=null?"欢迎，"+Session["user"]:"未登录" %>'></asp:HyperLink></li>
                    <li><asp:LinkButton ID="userExit" runat="server" 
                         OnClick="userExit_Click">退出登录</asp:LinkButton></li>
                </ul>
            </div> <!--导航栏-->
        </div><!--固定宽度container-->

        <!--用户登录信息展示(满屏)-->
            <div class="jumbotron uj">
                <h1><%# username %></h1>
                <asp:Image ID="userimg" runat="server" /><br /><br /><br />
                <asp:Button ID="useredit" CssClass="btn btn-default" runat="server" 
                    ToolTip="修改密码等" Text="编辑资料" OnClick="useredit_Click"/>
                <asp:Button ID="uppic" CssClass="btn btn-default" runat="server" OnClick="uppic_Click" Text="上传图片"/>
            </div>

        <!--展示用户上传的图片-->
        <div id="showpic" class="showdb" runat="server">
            <h4 id="picnum">共上传过<%# row_num %>张图片(仅展示最后上传的9张)</h4>
            <asp:DataList ID="spic" runat="server" RepeatLayout="Flow"
                 GridLines="None" RepeatDirection="Horizontal">
                <ItemTemplate>
                    <!--读取数据库中存储的图片地址-->
                    <asp:HyperLink ID="HyperLink1" runat="server"
                        NavigateUrl='<%# "showfull.aspx?id="+Eval("id")+"&up="+Eval("uploadby") %>'>
                        <asp:Image ID="Image1" runat="server" ImageUrl='<%# Eval("addpath") %>'
                       ToolTip='<%# Eval("tagtext") + "\n上传者："+Eval("uploadby") %>'
                        />
                    </asp:HyperLink>
                </ItemTemplate>
              </asp:DataList>
            <!--没有图片时显示-->
            <h1 id="nopic" runat="server" visible="false">还没有上传过图片呢</h1>
        </div>

        <!--编辑资料-->
        <div runat="server" visible="false" id="uedit" class="container">
            <div class="row">
                <!--上传头像-->
                <div class="col-sm-6 col-md-6 ubot">
                    <h3>修改头像</h3>
                    <hr />
                    原头像：<asp:Image ID="simg" runat="server"  CssClass="editimg"/><br /><br />
                    新头像上传：<asp:FileUpload ID="uimg" runat="server" />
                    来自网络的图片：<asp:TextBox ID="uimgwl" runat="server" CssClass="form-control"
                        TextMode="Url" ToolTip="会优先使用上传的文件"></asp:TextBox><br /><br />
                    <asp:Button ID="Button1" runat="server" OnClick="Button1_Click" CssClass="btn btn-default" Text="更新头像" />
                </div>

                <div class="col-sm-6 col-md-6">
                    <h3>修改密码</h3>
                    <hr />
                    原密码：<asp:TextBox ID="oldpwd" runat="server" CssClass="form-control"></asp:TextBox><br />
                    新密码：<asp:TextBox ID="newpwd" runat="server" CssClass="form-control"></asp:TextBox><br />
                    重复密码：<asp:TextBox ID="renewpwd" runat="server" CssClass="form-control"></asp:TextBox><br />
                    <br />
                    <asp:Button ID="uppwd" runat="server" Text="更新密码" OnClick="uppwd_Click" CssClass="btn btn-default" />
                </div>
            </div>
        </div>

        <!--上传图片-->
        <div id="newpic" class="tab-pane" runat="server" visible="false">
                     <div class="col-sm-6 col-md-6 ubot" style="margin-top:30px;">
                         <span>图片类型：</span>
                         <asp:DropDownList ID="picTag" runat="server" CssClass="form-control">
                             <asp:ListItem Value="pic">照片</asp:ListItem>
                             <asp:ListItem Value="chahua">插画</asp:ListItem>
                             <asp:ListItem Value="shiliang">矢量图</asp:ListItem>
                         </asp:DropDownList>

                         <span>图片标签（多个使用逗号分隔）：</span>
                         <asp:TextBox ID="tagText" runat="server" CssClass="form-control"></asp:TextBox>

                         <span>图片宽度（单位px）：</span>
                         <asp:TextBox ID="picWidth" runat="server" TextMode="Number"
                             CssClass="form-control"></asp:TextBox>

                         <span>图片高度（单位px）：</span>
                         <asp:TextBox ID="picHeight" runat="server" TextMode="Number"
                             CssClass="form-control"></asp:TextBox>

                     </div>
                     
                     <div class="col-sm-6 col-md-6" style="margin-top:30px;">
                         <asp:FileUpload ID="pic" runat="server"/>
                         <br />
                         <span>图片地址：</span>
                         <asp:TextBox ID="picUrl" runat="server" TextMode="Url"
                             CssClass="form-control"></asp:TextBox>
                         <br />
                         <span class="label-info">注意：通常情况下建议只上传图片连接，
                             不推荐上传文件。</span>
                         <br /><br />
                         <asp:LinkButton ID="sendPic" runat="server"
                             CssClass="btn btn-default" OnClick="sendPic_Click">提交</asp:LinkButton>
                     </div>
                 </div>

    </div>
    </form>
</body>
</html>
