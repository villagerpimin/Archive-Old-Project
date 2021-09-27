<%@ Page Language="C#" AutoEventWireup="true" CodeFile="admin.aspx.cs" Inherits="admin" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pixabay</title>
    <!--导入动画库-->
    <link href="css/animate.min.css" rel="stylesheet" />
    <!--导入样式表-->
    <link rel="stylesheet" href="css/adminCss.css" />
    <link rel="stylesheet" href="js/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
    <!--导入js文件-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</head>
<body>
    <form id="form1" runat="server">
    <div>
        <!--页头-->
        <div class="container">
        <div class="navbar navbar-default">
            <!--logo-->
            <div class="navbar-header">
                <div class="navbar-brand">
                    pixabay
                </div>
            </div>
            <!--导航-->
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
                <li><asp:LinkButton ID="gotouser" runat="server" 
                         OnClick="gotouser_Click">切换用户界面&nbsp;&nbsp;</asp:LinkButton></li>
            </ul>
        </div>
        

        <!--巨幕-->
        <div class="jumbotron">
            <h1>管理员页面</h1>
            <small>在这里可以修改/添加/删除一切信息，并且数据会同步更新</small>
        </div>

        <!--展示需要修改的信息-->
            <ul class="nav nav-tabs">
                <li class="dropdown">
                    <a class="btn btn-default" data-toggle="dropdown" style="cursor:pointer">
                        用户管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#showUser" data-toggle="tab">查看用户</a></li>
                        <li><a href="#fixUser" data-toggle="tab">用户修改</a></li>
                        <li><a href="#delUser" data-toggle="tab">删除用户</a></li>
                    </ul>
                </li>

                <li><a href="#newpic" data-toggle="tab">上传图片</a></li>
                <li><a href="#uppic" data-toggle="tab">修改图片</a></li>
                <li><a href="#delpic" data-toggle="tab">删除图片</a></li> 
                <!--评论管理-->
                <li class="dropdown">
                    <a class="btn btn-default" data-toggle="dropdown" style="cursor:pointer">
                        评论管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#showComment" data-toggle="tab">查看评论</a></li>
                        <li><a href="#fixComment" data-toggle="tab">修改评论</a></li>
                        <li><a href="#delComment" data-toggle="tab">删除评论</a></li>
                    </ul>
                </li>

             </ul>
            <div class="tab-content">
                <!-- 评论管理 -->
                <asp:SqlDataSource ID="SqlDataSource2" runat="server" 
                    ConnectionString='<%$ ConnectionStrings:GalleryConnectionString %>' 
                    DeleteCommand="DELETE FROM [comment_list] WHERE [id] = @id" 
                    InsertCommand="INSERT INTO [comment_list] ([picid], [comment], [commentBy], [commentDate], [upic]) VALUES (@picid, @comment, @commentBy, @commentDate, @upic)" 
                    SelectCommand="SELECT * FROM [comment_list]"
                     UpdateCommand="UPDATE [comment_list] SET [picid] = @picid, [comment] = @comment, [commentBy] = @commentBy, [commentDate] = @commentDate, [upic] = @upic WHERE [id] = @id">
                    <DeleteParameters>
                        <asp:Parameter Name="id" Type="Int32"></asp:Parameter>
                    </DeleteParameters>
                    <InsertParameters>
                        <asp:Parameter Name="picid" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="comment" Type="String"></asp:Parameter>
                        <asp:Parameter Name="commentBy" Type="String"></asp:Parameter>
                        <asp:Parameter Name="commentDate" Type="DateTime"></asp:Parameter>
                        <asp:Parameter Name="upic" Type="String"></asp:Parameter>
                    </InsertParameters>
                    <UpdateParameters>
                        <asp:Parameter Name="picid" Type="Int32"></asp:Parameter>
                        <asp:Parameter Name="comment" Type="String"></asp:Parameter>
                        <asp:Parameter Name="commentBy" Type="String"></asp:Parameter>
                        <asp:Parameter Name="commentDate" Type="DateTime"></asp:Parameter>
                        <asp:Parameter Name="upic" Type="String"></asp:Parameter>
                        <asp:Parameter Name="id" Type="Int32"></asp:Parameter>
                    </UpdateParameters>
                </asp:SqlDataSource>

                <div class="tab-pane" id="showComment">
                    <!--查看评论-->
                    <asp:ListView ID="ListView3" runat="server" DataSourceID="SqlDataSource2"
                         DataKeyNames="id">
                        <EmptyDataTemplate>
                            <table runat="server" style="">
                                <tr>
                                    <td>未返回数据。</td>
                                </tr>
                            </table>
                        </EmptyDataTemplate>
                        <ItemTemplate>
                            <tr style="">
                                <td>
                                    <asp:HyperLink ID="picidLabel" runat="server" NavigateUrl='<%# "~/showfull.aspx?id="+Eval("picid") %>'>
                                        <%# Eval("picid") %></asp:HyperLink>
                                    </td>
                                <td>
                                    <asp:Label Text='<%# Eval("comment") %>' Width="140px" runat="server" ID="commentLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("commentBy") %>' runat="server" ID="commentByLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("commentDate") %>' runat="server" ID="commentDateLabel" /></td>
                                <td>
                                    <asp:Image ID="Image3" runat="server" Width="100px" Height="100px" ImageUrl='<%# Eval("upic") %>' /></td>
                            </tr>
                        </ItemTemplate>
                        <LayoutTemplate>
                            <table runat="server">
                                <tr runat="server">
                                    <td runat="server">
                                        <table runat="server" id="itemPlaceholderContainer" style="" border="0">
                                            <tr runat="server">
                                                <th runat="server" style="width:20%">图片id</th>
                                                <th runat="server" style="width:20%">评论内容</th>
                                                <th runat="server" style="width:20%">发布者</th>
                                                <th runat="server" style="width:20%">发布日期</th>
                                                <th runat="server" style="width:20%">发布者头像</th>
                                            </tr>
                                            <tr runat="server" id="itemPlaceholder"></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr runat="server">
                                    <td runat="server" style="">
                                        <asp:DataPager runat="server" ID="DataPager3">
                                            <Fields>
                                                <asp:NextPreviousPagerField ButtonType="Button" ButtonCssClass="btn btn-default" ShowFirstPageButton="True" ShowLastPageButton="True"></asp:NextPreviousPagerField>
                                            </Fields>
                                        </asp:DataPager>
                                    </td>
                                </tr>
                            </table>
                        </LayoutTemplate>
                    </asp:ListView>
                </div>
                <div class="tab-pane" id="fixComment">
                    <!--修改评论-->
                    <asp:ListView ID="ListView4" runat="server" DataSourceID="SqlDataSource2" DataKeyNames="id">
                        <EditItemTemplate>
                            <tr style="">
                                <td>
                                    <asp:TextBox Text='<%# Bind("picid") %>' runat="server" ID="picidTextBox" /></td>
                                <td>
                                    <asp:TextBox Text='<%# Bind("comment") %>' Width="150px" runat="server" ID="commentTextBox" /></td>
                                <td>
                                    <asp:TextBox Text='<%# Bind("commentBy") %>' runat="server" ID="commentByTextBox" /></td>
                                <td>
                                    <asp:TextBox Text='<%# Bind("commentDate") %>' runat="server" ID="commentDateTextBox" /></td>
                                <td style="width:150px">
                                    <asp:TextBox Text='<%# Bind("upic") %>' runat="server" ID="upicTextBox" /></td>
                                <td>
                                    <asp:Button runat="server" CssClass="btn btn-default" CommandName="Update" Text="更新" ID="UpdateButton" />
                                    <asp:Button runat="server" CssClass="btn btn-default" CommandName="Cancel" Text="取消" ID="CancelButton" />
                                </td>
                            </tr>
                        </EditItemTemplate>
                        <EmptyDataTemplate>
                            <table runat="server" style="">
                                <tr>
                                    <td>未返回数据。</td>
                                </tr>
                            </table>
                        </EmptyDataTemplate>
                        <ItemTemplate>
                            <tr style="">
                                <td>
                                    <asp:HyperLink ID="picidLabel" runat="server" NavigateUrl='<%# "~/showfull.aspx?id="+Eval("picid") %>'>
                                        <%# Eval("picid") %></asp:HyperLink></td>
                                <td>
                                    <asp:Label Text='<%# Eval("comment") %>' Width="150px" runat="server" ID="commentLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("commentBy") %>' runat="server" ID="commentByLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("commentDate") %>' runat="server" ID="commentDateLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("upic") %>' Width="150px" runat="server" ID="upicLabel" /></td>
                                <td>
                                    <asp:Button runat="server" CssClass="btn btn-default" CommandName="Edit" Text="编辑" ID="EditButton" />
                                </td>
                            </tr>
                        </ItemTemplate>
                        <LayoutTemplate>
                            <table runat="server">
                                <tr runat="server">
                                    <td runat="server">
                                        <table runat="server" id="itemPlaceholderContainer" style="" border="0">
                                            <tr runat="server" style="">
                                                <th runat="server" style="width:20%">图片id</th>
                                                <th runat="server" style="width:20%">评论内容</th>
                                                <th runat="server" style="width:20%">发布者</th>
                                                <th runat="server" style="width:20%">发布日期</th>
                                                <th runat="server" style="width:20%">发布者头像</th>
                                            </tr>
                                            <tr runat="server" id="itemPlaceholder"></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr runat="server">
                                    <td runat="server" style="">
                                        <asp:DataPager runat="server" ID="DataPager4">
                                            <Fields>
                                                <asp:NextPreviousPagerField ButtonType="Button" ButtonCssClass="btn btn-default" ShowFirstPageButton="True" ShowLastPageButton="True"></asp:NextPreviousPagerField>
                                            </Fields>
                                        </asp:DataPager>
                                    </td>
                                </tr>
                            </table>
                        </LayoutTemplate>
                    </asp:ListView>
                </div>
                <div class="tab-pane" id="delComment">
                    <!--删除评论-->
                    <asp:ListView ID="ListView5" EnablePersistedSelection="true" runat="server" DataSourceID="SqlDataSource2" DataKeyNames="id">
                        <EmptyDataTemplate>
                            <table runat="server" style="">
                                <tr>
                                    <td>未返回数据。</td>
                                </tr>
                            </table>
                        </EmptyDataTemplate>
                        <ItemTemplate>
                            <tr style="">
                                <td>
                                    <asp:HyperLink ID="picidLabel" runat="server" NavigateUrl='<%# "~/showfull.aspx?id="+Eval("picid") %>'>
                                        <%# Eval("picid") %></asp:HyperLink></td>
                                <td>
                                    <asp:Label Text='<%# Eval("comment") %>' Width="150px" runat="server" ID="commentLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("commentBy") %>' runat="server" ID="commentByLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("commentDate") %>' runat="server" ID="commentDateLabel" />
                                </td>
                                <td>
                                    <asp:Image ID="Image3" runat="server" Width="100px" Height="100px" ImageUrl='<%# Eval("upic") %>' /></td>
                                <td>
                                    <asp:Button runat="server" CssClass="btn btn-default" CommandName="Delete" Text="删除" ID="DeleteButton" />
                                </td>
                            </tr>
                        </ItemTemplate>
                        <LayoutTemplate>
                            <table runat="server">
                                <tr runat="server">
                                    <td runat="server">
                                        <table runat="server" id="itemPlaceholderContainer" style="" border="0">
                                            <tr runat="server" style="">
                                                <th runat="server" style="width:20%">图片id</th>
                                                <th runat="server" style="width:20%">评论内容</th>
                                                <th runat="server" style="width:20%">发布者</th>
                                                <th runat="server" style="width:20%">发布日期</th>
                                                <th runat="server" style="width:20%">用户头像</th>
                                            </tr>
                                            <tr runat="server" id="itemPlaceholder"></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr runat="server">
                                    <td runat="server" style="">
                                        <asp:DataPager runat="server" ID="DataPager6">
                                            <Fields>
                                                <asp:NextPreviousPagerField ButtonCssClass="btn btn-default" ButtonType="Button" ShowFirstPageButton="True" ShowLastPageButton="True"></asp:NextPreviousPagerField>
                                            </Fields>
                                        </asp:DataPager>
                                    </td>
                                </tr>
                            </table>
                        </LayoutTemplate>
                    </asp:ListView>
                </div>

                <!-- 用户管理 -->
                <asp:SqlDataSource ID="userSqlData" runat="server" ConnectionString='<%$ ConnectionStrings:GalleryConnectionString %>' DeleteCommand="DELETE FROM [user_list] WHERE [id] = @id" InsertCommand="INSERT INTO [user_list] ([username], [password], [purview], [userpic]) VALUES (@username, @password, @purview, @userpic)" SelectCommand="SELECT * FROM [user_list] ORDER BY [id]" UpdateCommand="UPDATE [user_list] SET [username] = @username, [password] = @password, [purview] = @purview, [userpic] = @userpic WHERE [id] = @id">
                        <DeleteParameters>
                            <asp:Parameter Name="id" Type="Int32"></asp:Parameter>
                        </DeleteParameters>
                        <InsertParameters>
                            <asp:Parameter Name="username" Type="String"></asp:Parameter>
                            <asp:Parameter Name="password" Type="String"></asp:Parameter>
                            <asp:Parameter Name="purview" Type="Int32"></asp:Parameter>
                            <asp:Parameter Name="userpic" Type="String"></asp:Parameter>
                        </InsertParameters>
                        <UpdateParameters>
                            <asp:Parameter Name="username" Type="String"></asp:Parameter>
                            <asp:Parameter Name="password" Type="String"></asp:Parameter>
                            <asp:Parameter Name="purview" Type="Int32"></asp:Parameter>
                            <asp:Parameter Name="userpic" Type="String"></asp:Parameter>
                            <asp:Parameter Name="id" Type="Int32"></asp:Parameter>
                        </UpdateParameters>
                </asp:SqlDataSource>
                <!--用户浏览-->
                <div class="tab-pane active" id="showUser">
                    <asp:GridView ID="GridView1" runat="server" AutoGenerateColumns="False" DataKeyNames="id" 
                        DataSourceID="userSqlData" AllowPaging="True" GridLines="None" PageSize="5">
                        <Columns>
                            <asp:TemplateField HeaderText="用户id" ItemStyle-Width="15%" InsertVisible="False" SortExpression="id">
                                <ItemTemplate>
                                    <asp:Label runat="server" Text='<%# Bind("id") %>' ID="Label1"></asp:Label>
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:TemplateField HeaderText="用户名" ItemStyle-Width="15%" SortExpression="username">
                                <ItemTemplate>
                                    <asp:Label runat="server" Text='<%# Bind("username") %>' ID="Label2"></asp:Label>
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:TemplateField HeaderText="用户密码" ItemStyle-Width="15%" SortExpression="password">
                                <ItemTemplate>
                                    <asp:Label runat="server" Text='<%# Bind("password") %>' ID="Label3"></asp:Label>
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:TemplateField HeaderText="用户权限" ItemStyle-Width="15%" SortExpression="purview">
                                <ItemTemplate>
                                    <asp:Label runat="server" Text='<%# Eval("purview").ToString()=="0"?"普通用户":"管理员" %>' ID="Label4"></asp:Label>
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:TemplateField HeaderText="用户头像" ItemStyle-Width="15%" SortExpression="userpic">
                                <ItemTemplate>
                                    <asp:Image ID="Image1" runat="server" ImageUrl='<%# Bind("userpic") %>' Width="100px" Height="100px" />
                                </ItemTemplate>
                            </asp:TemplateField>
                        </Columns>
                        <PagerSettings FirstPageText="首页&nbsp;&nbsp;" NextPageText="下一页&nbsp;&nbsp;" LastPageText="最后一页&nbsp;&nbsp;" 
                            Mode="NextPreviousFirstLast" PreviousPageText="上一页&nbsp;&nbsp;"/>
                        <PagerStyle CssClass="btn btn-default" />
                        
                    </asp:GridView>
                </div>
                <!--用户修改-->
                <div class="tab-pane" id="fixUser">
                    <asp:ListView ID="ListView2" runat="server" DataSourceID="userSqlData" DataKeyNames="id">
                        <EditItemTemplate>
                            <tr style="">
                                <td>
                                    <asp:Button runat="server" CommandName="Update" CssClass="btn btn-default" Text="更新" ID="UpdateButton" />
                                    <asp:Button runat="server" CommandName="Cancel" CssClass="btn btn-default" Text="取消" ID="CancelButton" />
                                </td>
                                <td>
                                    <asp:Label Text='<%# Eval("id") %>' runat="server" ID="idLabel1" /></td>
                                <td>
                                    <asp:TextBox Text='<%# Bind("username") %>' runat="server" ID="usernameTextBox" /></td>
                                <td>
                                    <asp:TextBox Text='<%# Bind("password") %>' runat="server" ID="passwordTextBox" /></td>
                                <td>
                                    <asp:TextBox Text='<%# Bind("purview") %>' runat="server" ID="purviewTextBox" /></td>
                                <td>
                                    <asp:TextBox Text='<%# Bind("userpic") %>' runat="server" ID="userpicTextBox" /></td>
                            </tr>
                        </EditItemTemplate>
                        <EmptyDataTemplate>
                            <table runat="server" style="">
                                <tr>
                                    <td>未返回数据。</td>
                                </tr>
                            </table>
                        </EmptyDataTemplate>
                        <ItemTemplate>
                            <tr style="">
                                <td>
                                    <asp:Label Text='<%# Eval("id") %>' runat="server" ID="idLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("username") %>' runat="server" ID="usernameLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("password") %>' runat="server" ID="passwordLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("purview") %>' runat="server" ID="purviewLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("userpic") %>' runat="server" ID="userpicLabel" /></td>
                                <td>
                                    <asp:Button runat="server" CommandName="Edit" CssClass="btn btn-default" Text="编辑" ID="EditButton" />
                                </td>
                            </tr>
                        </ItemTemplate>
                        <LayoutTemplate>
                            <table runat="server">
                                <tr runat="server">
                                    <td runat="server">
                                        <table runat="server" id="itemPlaceholderContainer" style="" border="0">
                                            <tr runat="server" style="">
                                                <th runat="server" style="width:20%">用户id</th>
                                                <th runat="server" style="width:20%">用户名</th>
                                                <th runat="server" style="width:20%">用户密码</th>
                                                <th runat="server" style="width:20%">用户权限(0普通用户，1管理员)</th>
                                                <th runat="server" style="width:20%">用户头像</th>
                                            </tr>
                                            <tr runat="server" id="itemPlaceholder"></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr runat="server">
                                    <td runat="server" style="">
                                        <asp:DataPager runat="server" ID="DataPager2">
                                            <Fields>
                                                <asp:NextPreviousPagerField ButtonType="Button" ButtonCssClass="btn btn-default" ShowFirstPageButton="True" ShowLastPageButton="True"></asp:NextPreviousPagerField>
                                            </Fields>
                                        </asp:DataPager>
                                    </td>
                                </tr>
                            </table>
                        </LayoutTemplate>
                        <SelectedItemTemplate>
                            <tr style="">
                                <td>
                                    <asp:Button runat="server" CommandName="Edit" CssClass="btn btn-default" Text="编辑" ID="EditButton" />
                                </td>
                                <td>
                                    <asp:Label Text='<%# Eval("id") %>' runat="server" ID="idLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("username") %>' runat="server" ID="usernameLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("password") %>' runat="server" ID="passwordLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("purview") %>' runat="server" ID="purviewLabel" /></td>
                                <td>
                                    <asp:Label Text='<%# Eval("userpic") %>' runat="server" ID="userpicLabel" /></td>
                            </tr>
                        </SelectedItemTemplate>
                    </asp:ListView>
                </div>
                <!--删除用户-->
                <div class="tab-pane" id="delUser">
                    <asp:GridView ID="GridView2" runat="server" AutoGenerateColumns="False" DataKeyNames="id" 
                        DataSourceID="userSqlData" AllowPaging="True" GridLines="None" PageSize="5">
                        <Columns>
                            <asp:TemplateField HeaderText="用户id" ItemStyle-Width="15%" InsertVisible="False" SortExpression="id">
                                <ItemTemplate>
                                    <asp:Label runat="server" Text='<%# Bind("id") %>' ID="Label1"></asp:Label>
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:TemplateField HeaderText="用户名" ItemStyle-Width="15%" SortExpression="username">
                                <ItemTemplate>
                                    <asp:Label runat="server" Text='<%# Bind("username") %>' ID="Label2"></asp:Label>
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:TemplateField HeaderText="用户密码" ItemStyle-Width="15%" SortExpression="password">
                                <ItemTemplate>
                                    <asp:Label runat="server" Text='<%# Bind("password") %>' ID="Label3"></asp:Label>
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:TemplateField HeaderText="用户权限" ItemStyle-Width="15%" SortExpression="purview">
                                <ItemTemplate>
                                    <asp:Label runat="server" Text='<%# Eval("purview").ToString()=="0"?"普通用户":"管理员" %>' ID="Label4"></asp:Label>
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:TemplateField HeaderText="用户头像" ItemStyle-Width="15%" SortExpression="userpic">
                                <ItemTemplate>
                                    <asp:Image ID="Image1" runat="server" ImageUrl='<%# Bind("userpic") %>' Width="100px" Height="100px" />
                                </ItemTemplate>
                            </asp:TemplateField>
                            <asp:CommandField ShowDeleteButton="True" ButtonType="Button" ControlStyle-CssClass="btn btn-default"></asp:CommandField>
                        </Columns>
                    </asp:GridView>
                </div>

                <!-- 上传图片 -->
                 <div id="newpic" class="tab-pane">
                     <div class="col-sm-6 col-md-6" style="margin-top:30px;">
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

                <!-- 修改图片 -->
                 <div id="uppic" class="tab-pane">
                     <br />
                     <div class="row">
                         <div class="col-sm-5 col-md-5">
                             <!--通过id获取修改的图片信息-->
                             输入需要修改的图片id：
                             <div class="input-group">
                                <asp:TextBox ID="updateId" runat="server" CssClass="form-control"></asp:TextBox>
                                 <span class="input-group-btn">
                                     <asp:LinkButton ID="snedUpId" runat="server" 
                                            CssClass="btn btn-default" OnClick="snedUpId_Click">
                                         <span class="glyphicon glyphicon-search"></span>
                                     </asp:LinkButton>
                                 </span>
                             </div>
                         </div>
                     </div><br />

                     <!--展示可修改的信息-->
                     <div class="col-sm-6 col-md-6 list-group">
                         <div class="list-group-item list-group-item-success">
                             可修改的信息
                         </div>
                         <div class="list-group-item">
                             图片id：<!--图片id不可修改-->
                             <asp:TextBox ID="uPicid" runat="server" CssClass="form-control" Enabled="False"></asp:TextBox>
                         </div>
                         <div class="list-group-item">
                             图片类型：
                             <asp:DropDownList ID="uPiclx" runat="server" CssClass="form-control">
                                 <asp:ListItem Value="pic">照片</asp:ListItem>
                                 <asp:ListItem Value="chahua">插画</asp:ListItem>
                                 <asp:ListItem Value="shiliang">矢量图</asp:ListItem>
                             </asp:DropDownList>
                         </div>
                         <div class="list-group-item">
                             图片标签：
                             <asp:TextBox ID="uPictext" CssClass="form-control" runat="server"></asp:TextBox>
                         </div>
                         <div class="list-group-item">
                             图片预览：
                             <asp:Image ID="uPicimg" runat="server" />
                             <br />修改图片(仅支持URL形式)
                             <asp:TextBox ID="uPicurl" CssClass="form-control" runat="server"></asp:TextBox>
                         </div>
                         <div class="list-group-item">
                             图片宽度：
                             <asp:TextBox ID="uPicwidth" CssClass="form-control" runat="server"></asp:TextBox>
                         </div>
                         <div class="list-group-item">
                             图片高度：
                             <asp:TextBox ID="uPicheight" CssClass="form-control" runat="server"></asp:TextBox>
                         </div>
                         <div class="list-group-item">
                             <asp:LinkButton ID="sendUpic" CssClass="btn btn-default"
                                 runat="server" OnClick="sendUpic_Click">提交修改</asp:LinkButton>
                         </div>
                     </div>

                     <!--展示原信息-->
                     <div class="col-sm-6 col-md-6 list-group">
                         <div class="list-group-item list-group-item-info">
                             原信息
                         </div>
                         <div class="list-group-item">
                             图片id：
                             <asp:TextBox ID="Picid" runat="server" CssClass="form-control" Enabled="False"></asp:TextBox>
                         </div>
                         <div class="list-group-item">
                             图片类型：
                             <asp:DropDownList ID="Piclx" runat="server" CssClass="form-control" Enabled="false">
                                 <asp:ListItem Value="pic">照片</asp:ListItem>
                                 <asp:ListItem Value="chahua">插画</asp:ListItem>
                                 <asp:ListItem Value="shiliang">矢量图</asp:ListItem>
                             </asp:DropDownList>
                         </div>
                         <div class="list-group-item">
                             图片标签：
                             <asp:TextBox ID="Pictext" CssClass="form-control" runat="server" Enabled="false"></asp:TextBox>
                         </div>
                         <div class="list-group-item">
                             图片预览：
                             <asp:Image ID="Picimg" runat="server" />
                         </div>
                         <div class="list-group-item">
                             图片宽度：
                             <asp:TextBox ID="yPicwidth" CssClass="form-control" runat="server" Enabled="false"></asp:TextBox>
                         </div>
                         <div class="list-group-item">
                             图片高度：
                             <asp:TextBox ID="yPicheight" CssClass="form-control" runat="server" Enabled="false"></asp:TextBox>
                         </div>
                     </div>
                 </div>

                <!-- 删除图片 -->
                 <div id="delpic" class="tab-pane">
                     <asp:SqlDataSource ID="SqlDataSource1" runat="server" 
                         ConnectionString='<%$ ConnectionStrings:GalleryConnectionString %>' 
                         DeleteCommand="DELETE FROM [pic_list] WHERE [id] = @id" 
                         InsertCommand="INSERT INTO [pic_list] ([addpath]) VALUES (@addpath)" 
                         SelectCommand="SELECT [id], [addpath] FROM [pic_list]" 
                         UpdateCommand="UPDATE [pic_list] SET [addpath] = @addpath WHERE [id] = @id">
                         <DeleteParameters>
                             <asp:Parameter Name="id" Type="Int32"></asp:Parameter>
                         </DeleteParameters>
                         <InsertParameters>
                             <asp:Parameter Name="addpath" Type="String"></asp:Parameter>
                         </InsertParameters>
                         <UpdateParameters>
                             <asp:Parameter Name="addpath" Type="String"></asp:Parameter>
                             <asp:Parameter Name="id" Type="Int32"></asp:Parameter>
                         </UpdateParameters>
                     </asp:SqlDataSource>

                     <asp:ListView ID="ListView1" runat="server" DataSourceID="SqlDataSource1" DataKeyNames="id" GroupItemCount="3">
                         <EmptyDataTemplate>
                             <table runat="server" style="">
                                 <tr>
                                     <td>未返回数据。</td>
                                 </tr>
                             </table>
                         </EmptyDataTemplate>
                         <EmptyItemTemplate>
                             <td runat="server" />
                         </EmptyItemTemplate>
                         <GroupTemplate>
                             <tr runat="server" id="itemPlaceholderContainer">
                                 <td runat="server" id="itemPlaceholder"></td>
                             </tr>
                         </GroupTemplate>
                         <ItemTemplate>
                             <td runat="server" style="">
                                 <asp:Label runat="server" ID="addpathLabel">
                                     <div class="thumbnail text-center">
                                         <asp:Image ID="Image2" runat="server" ImageUrl='<%# Eval("addpath") %>'
                                             ToolTip='<%# "id:"+Eval("id") %>'/>
                                         <asp:Button runat="server" CommandName="Delete" Text="删除"
                                             ID="DeleteButton" CssClass="btn btn-default"/>
                                     </div>
                                 </asp:Label>
                                 
                             </td>
                         </ItemTemplate>
                         <LayoutTemplate>
                             <table runat="server">
                                 <tr runat="server">
                                     <td runat="server">
                                         <table runat="server" id="groupPlaceholderContainer" style="" border="0">
                                             <tr runat="server" id="groupPlaceholder"></tr>
                                         </table>
                                     </td>
                                 </tr>
                                 <tr runat="server">
                                     <td runat="server" style="">
                                         <asp:DataPager runat="server" PageSize="12" ID="DataPager1">
                                             <Fields>
                                                 <asp:NextPreviousPagerField ButtonType="Button" ShowFirstPageButton="True" ShowLastPageButton="True" ButtonCssClass="btn btn-default"></asp:NextPreviousPagerField>
                                             </Fields>
                                         </asp:DataPager>
                                     </td>
                                 </tr>
                             </table>
                         </LayoutTemplate>
                     </asp:ListView>
                 </div>
             </div>

        </div>
 </div>

        <!--页脚-->
        <div id="footer">
            1930634 朱腾飞 19软6
        </div>

        <!--返回顶部的小箭头-->
        <div id="totop" class="gotop" title="返回顶部">⬆</div>
    </div>
    </form>
</body>
</html>
