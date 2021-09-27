<%@ Page Title="" Language="C#" MasterPageFile="~/indexMasterPage.master" AutoEventWireup="true" CodeFile="shiliang.aspx.cs" Inherits="shiliang" %>

<asp:Content ID="Content1" ContentPlaceHolderID="head" Runat="Server">
    <!--预留的HEAD-->
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="wel1" Runat="Server">
    <!--欢迎标语1-->
    免费正版高清矢量图素材库
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="wel2" Runat="Server">
    <!--欢迎标语2-->
    Pixabay拥有100000张优质矢量图素材，让你轻松应对各种设计场景
</asp:Content>

<asp:Content ID="Content4" ContentPlaceHolderID="hots" Runat="Server">
    <!--热门搜索-->
    热门搜索： 花, 背景, 科技, 卡通, 树, 人, 云, 人物
</asp:Content>

<asp:Content ID="Content5" ContentPlaceHolderID="showdata" Runat="Server">
    <!--从数据库读取矢量图-->
    <asp:DataList ID="homepic" runat="server" RepeatLayout="Flow"
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
</asp:Content>

<asp:Content ID="Content6" ContentPlaceHolderID="moad" runat="server">
    <div class="fx">发现更多</div>
            <h1>可在任何地方使用的免费图片和视频</h1>
            <h3>如此充满活力的创意社区，分享版权免费图片和视频。 所有内容均根据如下许可证发布，这使得它们可以安全使用而无需征得许可或给予艺术家信用 - 即使是出于商业目的。
                <a href="https://pixabay.com/zh/service/faq/" style="color:#526ca9;" 
                    target="_blank" title="链接来自原网站的说明">了解更多...</a>
            </h3>
            <br /><br />
            <h1>加入Pixabay</h1>
            <h3 style="margin-bottom:70px;">下载免版权的照片和视频，分享你自己的照片作为公共领域与世界各地的人。</h3>
            <div class="fx">
                <asp:HyperLink ID="bottreg" runat="server" NavigateUrl="#">免费注册吧！</asp:HyperLink>
            </div>
</asp:Content>

