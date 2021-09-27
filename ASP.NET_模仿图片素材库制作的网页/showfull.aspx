<%@ Page Language="C#" AutoEventWireup="true" CodeFile="showfull.aspx.cs" Inherits="showfull" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>详情页</title>
    <link href="css/showfull.css" rel="stylesheet" />
    <!--引入外部动画库-->
    <link rel="stylesheet" href="css/animate.min.css"/>
    <script src="js/showFull.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <!--页头-->
        <div id="header">
            <!--logo-->
            <div class="header_left">
                <img id="logo" src="images/logo.png" style="padding-top:20px;cursor:pointer;" width="100" height="35"/>
                <div id="search">
                <asp:LinkButton ID="searpic" runat="server" CssClass="searpic"></asp:LinkButton>
                <!--搜索框的提示语在js-->
                <asp:TextBox ID="inptext" runat="server" AutoPostBack="true" CssClass="seastyle"></asp:TextBox>
                <asp:DropDownList ID="leixing" runat="server" CssClass="lxstyle" AutoPostBack="True">
                    <asp:ListItem Value="pic">照片</asp:ListItem>
                    <asp:ListItem Value="shiliang">矢量</asp:ListItem>
                    <asp:ListItem Value="chahua">插画</asp:ListItem>
                    <asp:ListItem Value="video">视频</asp:ListItem>
                    <asp:ListItem Value="music">音乐</asp:ListItem>
                </asp:DropDownList>
            </div>
            </div>

            <!--登录-->
            <div class="header_right">
                <!--未登录时显示-->
                <ul id="notSess" runat="server" visible="true">
                    <li>
                        <asp:LinkButton ID="login" runat="server">未登录</asp:LinkButton></li>
                </ul>
                <!--登录时显示-->
                <ul id="hasSess" runat="server" visible="false">
                    <li>
                        <asp:HyperLink ID="showLoginUser" runat="server"></asp:HyperLink>
                    </li>
                    <li>
                        <asp:LinkButton ID="LinkButton1" runat="server" OnClick="LinkButton1_Click">退出</asp:LinkButton>
                    </li>
                </ul>

                <!--上传的点击跳转在js页中-->
                <div id="updata">上传</div>

                <!--菜单项-->
                <asp:Menu ID="Menu1" runat="server" Orientation="Horizontal" CssClass="ts">
                    <DynamicMenuItemStyle CssClass="tsItem" ForeColor="White"/>
                    <DynamicHoverStyle ForeColor="#898989" />
                    <DynamicMenuStyle VerticalPadding="30px" />
                    <Items>
                        <asp:MenuItem Text="探索" Value="探索">
                            <asp:MenuItem NavigateUrl="https://villagerpimin.github.io/" Target="_blank" Text="博客" Value="博客"></asp:MenuItem>
                            <asp:MenuItem NavigateUrl="https://pixabay.com/zh/service/faq/" Target="_blank" Text="常见问题" Value="常见问题"></asp:MenuItem>
                            <asp:MenuItem NavigateUrl="https://pixabay.com/zh/service/about/api/" Target="_blank" Text="API" ToolTip="部分页面调用了网站提供的api" Value="API"></asp:MenuItem>
                        </asp:MenuItem>
                    </Items>
                </asp:Menu>
            </div>
        </div>

        <!--内容-->
        <div id="content">
            <div id="pic">
                <!--此处显示从数据库读取的tag-->
                <div id="showTag" class="showTagtext">Tag:<%# tagText %></div>
                <!--此处显示查询字符串传递的图片-->
                <asp:Image ID="Image1" ImageUrl="~/images/shiliang/8.svg" runat="server" />
            </div>

            <!--此处显示图片上传者及图片详细信息-->
            <div id="media">
                <!--作者信息-->
                <div id="author">
                    <!--用户头像-->
                    <div id="userpic"><asp:Image ID="img" runat="server" /></div>
                    <!--用户名-->
                    <asp:Label ID="username" runat="server" Text="null"></asp:Label>
                    <br />
                </div>
                <hr />
                <!--点赞收藏-->
                <div id="goodpic">
                    <div>
                        <asp:LinkButton ID="zan" runat="server" ToolTip="点赞" OnClick="zan_Click">
                            👍<%# zanNum %></asp:LinkButton></div>
                    <div><asp:LinkButton ID="shoucang" runat="server" ToolTip="收藏">♥</asp:LinkButton></div>
                </div>
                <br /><hr />
                <!--下载图片-->
                <div id="download">
                    <asp:HyperLink ID="downloadPic" NavigateUrl='<%# picPath %>' Target="_blank"
                         runat="server">下载图片</asp:HyperLink>
                </div>
                <br /><hr style="margin-top:20px;" />
                <!--图片信息-->
                <div id="picFull">
                    
                    <div id="inText">
                        <ul id="left">
                            <li>图片类型：</li>
                            <li>宽度：</li>
                            <li>高度：</li>
                            <li>标签：</li>
                            <li>点赞数：</li>
                        </ul>
                        
                        <ul id="right">
                            <li><%# lx %></li>
                            <li><%# wid %></li>
                            <li><%# hei %></li>
                            <li title='<%# tagText %>''><%# tagText.Length>=8?tagText.Substring(0,8).ToString()+"...":tagText %></li>
                            <li><%# zanNum %></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--图片评论-->
        <div id="pinlun" class="container">
            <!--评论的输入框-->
            <div id="commentEdit">
                <br />
                <asp:Image ID="tou" runat="server"></asp:Image>
                <asp:TextBox ID="comm" runat="server"></asp:TextBox>
                <br />
                <asp:Button ID="commSend" runat="server" Text="发表" OnClick="commSend_Click" />
            </div>
            <!--显示评论-->
            <div id="showComm">
                <asp:DataList ID="sComm" runat="server">
                    <ItemTemplate>
                        <br />
                        <div style="float:left;">
                            <asp:Image ID="Image2" CssClass="sComm" runat="server" ImageUrl='<%# Eval("upic").ToString() %>' />
                        </div>
                        <div style="float:left;">
                            <asp:Label ID="Label1" CssClass="fontc" runat="server" Text='<%# Eval("commentBy").ToString() != "null" ? Eval("commentBy") : "匿名用户" %>'></asp:Label><br />
                            <asp:Label ID="Label2" runat="server" Text='<%# Eval("comment").ToString() %>'></asp:Label>
                            <div style="clear:both;float:right;margin-top:30px;margin-left:30px;">
                                <span class="fontc">发布日期：<%# Eval("commentDate","[{0:G}]") %></span>
                            </div>
                        </div>
                    </ItemTemplate>
                </asp:DataList>
                <h3 runat="server" id="noComm" visible="false">暂时没有评论···</h3>
            </div>
        </div>

        <!--页脚-->
        <div id="footer">
             1930634 朱腾飞 19软6
         </div>

    </div>
    </form>
</body>
</html>
