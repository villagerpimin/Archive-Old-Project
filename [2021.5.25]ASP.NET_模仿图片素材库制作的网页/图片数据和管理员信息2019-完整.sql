USE [master]
GO
/****** Object:  Database [Gallery]    Script Date: 2021/6/25 16:33:57 ******/
if exists (select * from sysdatabases where name='Gallery')
		drop database Gallery
		
		DECLARE @device_directory NVARCHAR(520)
SELECT @device_directory = SUBSTRING(filename, 1, CHARINDEX(N'master.mdf', LOWER(filename)) - 1)
FROM master.dbo.sysaltfiles WHERE dbid = 1 AND fileid = 1

EXECUTE (N'CREATE DATABASE Gallery
  ON PRIMARY (NAME = N''Gallery'', FILENAME = N''' + @device_directory + N'Gallery.mdf'')
  LOG ON (NAME = N''Gallery_log'',  FILENAME = N''' + @device_directory + N'Gallery.ldf'')')
  GO
ALTER DATABASE [Gallery] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Gallery].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [Gallery] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [Gallery] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [Gallery] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [Gallery] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [Gallery] SET ARITHABORT OFF 
GO
ALTER DATABASE [Gallery] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [Gallery] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [Gallery] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [Gallery] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [Gallery] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [Gallery] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [Gallery] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [Gallery] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [Gallery] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [Gallery] SET  DISABLE_BROKER 
GO
ALTER DATABASE [Gallery] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [Gallery] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [Gallery] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [Gallery] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [Gallery] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [Gallery] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [Gallery] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [Gallery] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [Gallery] SET  MULTI_USER 
GO
ALTER DATABASE [Gallery] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [Gallery] SET DB_CHAINING OFF 
GO
ALTER DATABASE [Gallery] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [Gallery] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [Gallery] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [Gallery] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [Gallery] SET QUERY_STORE = OFF
GO
USE [Gallery]
GO
/****** Object:  Table [dbo].[comment_list]    Script Date: 2021/6/25 16:33:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[comment_list](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[picid] [int] NOT NULL,
	[comment] [nvarchar](max) NULL,
	[commentBy] [nvarchar](max) NOT NULL,
	[commentDate] [datetime] NOT NULL,
	[upic] [nvarchar](max) NULL,
 CONSTRAINT [PK_comment_list] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pic_list]    Script Date: 2021/6/25 16:33:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pic_list](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[tag] [nvarchar](50) NULL,
	[tagtext] [nvarchar](max) NULL,
	[addpath] [nvarchar](max) NULL,
	[likes] [int] NULL,
	[imageWidth] [int] NULL,
	[imageHeight] [int] NULL,
	[uploadby] [nvarchar](80) NULL,
 CONSTRAINT [PK_pic_list] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user_list]    Script Date: 2021/6/25 16:33:57 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[user_list](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](50) NOT NULL,
	[password] [nvarchar](50) NOT NULL,
	[purview] [int] NOT NULL,
	[userpic] [nvarchar](200) NULL,
 CONSTRAINT [PK_user_list] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[comment_list] ON 

INSERT [dbo].[comment_list] ([id], [picid], [comment], [commentBy], [commentDate], [upic]) VALUES (1, 1034, N'真不错', N'null', CAST(N'2021-06-24T15:26:13.000' AS DateTime), N'~/images/admin.jpg')
INSERT [dbo].[comment_list] ([id], [picid], [comment], [commentBy], [commentDate], [upic]) VALUES (4, 1034, N'测试', N'null', CAST(N'2021-06-24T15:29:43.000' AS DateTime), N'~/images/admin.jpg')
INSERT [dbo].[comment_list] ([id], [picid], [comment], [commentBy], [commentDate], [upic]) VALUES (6, 1034, N'头像显示测试', N'usertest', CAST(N'2021-06-24T16:27:35.000' AS DateTime), N'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.X6Uwkoix3aDmOBSRYskE_AHaHb%26pid%3DApi&f=1')
INSERT [dbo].[comment_list] ([id], [picid], [comment], [commentBy], [commentDate], [upic]) VALUES (7, 1034, N'头像显示测试2', N'zhu', CAST(N'2021-06-24T16:28:41.000' AS DateTime), N'~/images/gdx.png')
INSERT [dbo].[comment_list] ([id], [picid], [comment], [commentBy], [commentDate], [upic]) VALUES (8, 1033, N'好图', N'zhu', CAST(N'2021-06-24T16:33:53.000' AS DateTime), N'~/images/gdx.png')
INSERT [dbo].[comment_list] ([id], [picid], [comment], [commentBy], [commentDate], [upic]) VALUES (11, 1032, N'牛', N'zhu', CAST(N'2021-06-24T22:15:08.000' AS DateTime), N'~/images/gdx.png')
SET IDENTITY_INSERT [dbo].[comment_list] OFF
GO
SET IDENTITY_INSERT [dbo].[pic_list] ON 

INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1, N'pic', N'动物', N'~/images/pic/animal-1.jpg', 1, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (2, N'pic', N'动物', N'~/images/pic/animal-2.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (3, N'pic', N'城市', N'~/images/pic/city-1.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (4, N'pic', N'城市', N'~/images/pic/city-2.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (5, N'pic', N'花', N'~/images/pic/flower-1.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (6, N'pic', N'花,城市', N'~/images/pic/girl-1.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (7, N'pic', N'美女', N'~/images/pic/girl-2.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (8, N'pic', N'风景', N'~/images/pic/landspace-1.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (9, N'pic', N'风景', N'~/images/pic/landspace-2.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (10, N'pic', N'风景', N'~/images/pic/landspace-3.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (11, N'pic', N'风景', N'~/images/pic/landspace-4.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (12, N'pic', N'天空', N'~/images/pic/sky-1.jpg', 23, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1004, N'pic', N'花', N'~/images/pic/flower-2.jpg', 6, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1005, N'chahua', N'绿色,薄荷,茶,茶杯', N'~/images/chahua/1.jpg', 0, 739, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1006, N'chahua', N'森林,山,夜晚的天空', N'~/images/chahua/2.jpg', 0, 1280, 720, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1007, N'chahua', N'叶子,植物,花圈,抽象', N'~/images/chahua/3.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1008, N'chahua', N'日出,海洋,船舶', N'~/images/chahua/4.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1009, N'chahua', N'眼睛,邪恶之眼,蓝色,设计', N'~/images/chahua/5.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1010, N'chahua', N'曼陀罗,心,云', N'~/images/chahua/6.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1011, N'chahua', N'森林,雾,侧影,树', N'~/images/chahua/7.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1012, N'chahua', N'团队,理念,头脑风暴,协作', N'~/images/chahua/8.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1013, N'chahua', N'树,森林,机舱,雪,房子', N'~/images/chahua/9.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1014, N'chahua', N'城市,建筑物,天际线,结构', N'~/images/chahua/10.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1015, N'chahua', N'万圣节,南瓜,蝙蝠,骨头', N'~/images/chahua/11.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1016, N'chahua', N'叶子,背景,植物区系,自然', N'~/images/chahua/12.jpg', 0, 720, 480, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1017, N'shiliang', N'咖啡,咖啡杯,早餐,杯子', N'~/images/shiliang/1.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1018, N'shiliang', N'面具,口罩,疫苗,冠状病毒', N'~/images/shiliang/2.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1019, N'shiliang', N'心,得意,脸,表情,粉红', N'~/images/shiliang/3.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1020, N'shiliang', N'风,伞,女孩,天气', N'~/images/shiliang/4.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1021, N'shiliang', N'齿轮,团队,工作,集体', N'~/images/shiliang/5.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1022, N'shiliang', N'树,叶子,森林,性质,植物', N'~/images/shiliang/6.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1023, N'shiliang', N'山,旅行,景观', N'~/images/shiliang/7.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1024, N'shiliang', N'盒,胶带,复古,铅笔', N'~/images/shiliang/8.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1025, N'shiliang', N'房子,街,房屋,体系结构', N'~/images/shiliang/9.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1026, N'shiliang', N'城市,村,数字,热气球', N'~/images/shiliang/10.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1027, N'shiliang', N'互联网,程序,浏览器,图形', N'~/images/shiliang/11.svg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1028, N'shiliang', N'钓鱼,男子,水,鱼', N'~/images/shiliang/12.svg', 5, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1029, N'pic', N'旧镇,建筑物,街道', N'~/images/pic/637594048218813079.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1030, N'pic', N'苍鹭,湖', N'https://cdn.pixabay.com/photo/2021/06/07/14/05/grey-heron-6318054_1280.jpg', 0, 1280, 853, N'zhu')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1032, N'pic', N'鹦鹉,鸟,羽毛', N'https://cdn.pixabay.com/photo/2021/06/16/21/46/parrot-6342271_1280.jpg', 6, 4050, 2700, N'test')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1033, N'pic', N'沙漠', N'https://cdn.pixabay.com/photo/2021/05/02/15/05/desert-6223778_1280.jpg', 0, 5835, 3890, N'test')
INSERT [dbo].[pic_list] ([id], [tag], [tagtext], [addpath], [likes], [imageWidth], [imageHeight], [uploadby]) VALUES (1034, N'pic', N'上午,雾,阳光', N'~/images/pic/637601241597221211.jpg', 0, 5836, 3440, N'test')
SET IDENTITY_INSERT [dbo].[pic_list] OFF
GO
SET IDENTITY_INSERT [dbo].[user_list] ON 

INSERT [dbo].[user_list] ([id], [username], [password], [purview], [userpic]) VALUES (1, N'zhu', N'123', 1, N'~/images/gdx.png')
INSERT [dbo].[user_list] ([id], [username], [password], [purview], [userpic]) VALUES (2, N'test', N'123', 0, N'~/images/user/637601221670841594.jpg')
INSERT [dbo].[user_list] ([id], [username], [password], [purview], [userpic]) VALUES (4, N'usertest', N'123', 0, N'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.X6Uwkoix3aDmOBSRYskE_AHaHb%26pid%3DApi&f=1')
INSERT [dbo].[user_list] ([id], [username], [password], [purview], [userpic]) VALUES (8, N'empty', N'test', 0, NULL)
SET IDENTITY_INSERT [dbo].[user_list] OFF
GO
ALTER TABLE [dbo].[pic_list] ADD  CONSTRAINT [DF_pic_list_likes]  DEFAULT ((0)) FOR [likes]
GO
ALTER TABLE [dbo].[pic_list] ADD  CONSTRAINT [DF_pic_list_imageWidth]  DEFAULT ((1280)) FOR [imageWidth]
GO
ALTER TABLE [dbo].[pic_list] ADD  CONSTRAINT [DF_pic_list_imageHeight]  DEFAULT ((853)) FOR [imageHeight]
GO
ALTER TABLE [dbo].[pic_list] ADD  CONSTRAINT [DF_pic_list_uploadby]  DEFAULT (N'zhu') FOR [uploadby]
GO
ALTER TABLE [dbo].[user_list] ADD  CONSTRAINT [DF_user_list_purview]  DEFAULT ((0)) FOR [purview]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'对应图片id' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'comment_list', @level2type=N'COLUMN',@level2name=N'picid'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'评论内容' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'comment_list', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'评论的发布者' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'comment_list', @level2type=N'COLUMN',@level2name=N'commentBy'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'发布时间' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'comment_list', @level2type=N'COLUMN',@level2name=N'commentDate'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'图片id' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'pic_list', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'图片类型' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'pic_list', @level2type=N'COLUMN',@level2name=N'tag'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'图片标签' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'pic_list', @level2type=N'COLUMN',@level2name=N'tagtext'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'图片路径' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'pic_list', @level2type=N'COLUMN',@level2name=N'addpath'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'点赞数' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'pic_list', @level2type=N'COLUMN',@level2name=N'likes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'图片的上传者' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'pic_list', @level2type=N'COLUMN',@level2name=N'uploadby'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'用户id' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user_list', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'用户权限，0为普通用户；1为管理员' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user_list', @level2type=N'COLUMN',@level2name=N'purview'
GO
USE [master]
GO
ALTER DATABASE [Gallery] SET  READ_WRITE 
GO
