-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: yike
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) DEFAULT NULL COMMENT '0:已完成的演讲 1：已完成的沙龙 2：公开课 ',
  `guest_name` varchar(100) DEFAULT NULL COMMENT '演讲嘉宾名称',
  `guest_avatar` varchar(100) DEFAULT NULL COMMENT '嘉宾头像',
  `guest_intro` text COMMENT '嘉宾介绍',
  `title` varchar(255) DEFAULT NULL COMMENT '活动的标题  不是给浏览器看的title属性',
  `summary` varchar(800) DEFAULT NULL COMMENT '描述或简介',
  `seo_title` varchar(255) DEFAULT NULL COMMENT 'SEO优化的title',
  `thumbnail` varchar(100) DEFAULT NULL COMMENT '活动封面图路径',
  `seo_alt` varchar(80) DEFAULT NULL COMMENT '封面图的alt值',
  `state` int(1) unsigned DEFAULT NULL COMMENT '状态，发布后不可修改  0:待审核, 1:驳回, 2:发布',
  `author_id` varchar(255) DEFAULT NULL COMMENT '发布者ID',
  `start_time` datetime DEFAULT NULL COMMENT '活动有效的开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '活动有效的结束时间',
  `address` varchar(255) DEFAULT NULL COMMENT '地点',
  `longitude` double DEFAULT NULL COMMENT '经度',
  `latitude` double DEFAULT NULL COMMENT '纬度',
  `modify_time` datetime DEFAULT NULL COMMENT '最新修改时间   默认当前时间',
  `seo_keywords` varchar(100) DEFAULT NULL COMMENT 'seo需要的keyword',
  `is_delete` int(1) DEFAULT NULL COMMENT '0:不删除 1:删除',
  `holder` varchar(100) DEFAULT NULL COMMENT '举办方',
  `position` int(1) DEFAULT '0' COMMENT '顺序，数值越大越靠前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (1,2,NULL,NULL,NULL,'如何成为一名伟大的创业者','Sam Altman联合斯坦福大学一起，开设了这门叫做CS183B的课，目的是教给所有想创业的人该如何去创业。','Sam Altman联合斯坦福大学一起，开设了这门叫做CS183B的课，目的是教给所有想创业的人该如何去创业。','/pages/upload/hua.jpg','创业者',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-12 11:35:12','创业者，斯坦福大学，CS183B',0,NULL,3),(2,2,NULL,NULL,NULL,'超级百万大奖概率','概率课程通过各种生动的例子，由最基本的概率问题讲起，逐步深入讲解了概率中的一系列概念及问题。','概率课程通过各种生动的例子，由最基本的概率问题讲起，逐步深入讲解了概率中的一系列概念及问题。','/pages/upload/hua.jpg','概率',2,'2',NULL,NULL,NULL,NULL,NULL,'2015-02-12 11:38:59','百万大奖，概率，中奖',0,NULL,0),(3,2,NULL,NULL,NULL,'宇宙大爆炸','包含宇宙学，天文学，物理学，化学，生物学等学科内容，从宇宙起源开始，直至宇宙的毁灭结束。','包含宇宙学，天文学，物理学，化学，生物学等学科内容，从宇宙起源开始，直至宇宙的毁灭结束。','/pages/upload/hua.jpg','宇宙，爆炸',2,'3',NULL,NULL,NULL,NULL,NULL,'2015-02-12 14:38:59','爆炸，宇宙，学科',0,NULL,0),(4,0,'周鸿祎','/pages/upload/W020120612419212260261.jpg','出生于湖北黄冈毕业于西安交通大学并获得硕士学位 曾供职于方正集团后历任3721公司创始人雅虎中国总裁等职务 2006年周鸿袆出任奇虎360公司董事长并带领奇虎360公司于2011年3月30日在美国纽交所上市NYSEQIHU 现为360公司董事长知名天使投资人。','老子是做的互联网安全公司','“通过此次赴美上市，奇虎360将有能力为其3亿中国互联网用户提供更多服务，从而让公司更多潜力被挖掘出来，转变为真正的实力。”','老子是做的互联网安全公司','/pages/upload/1312231843349.jpg','安全，360，周鸿祎',2,'1','2015-03-01 14:16:27','2015-03-01 16:16:27','北京朝阳区建外SOHO东区',NULL,NULL,'2015-02-14 14:16:27','周鸿祎，互联网，互联网安全',0,'一刻',1),(5,0,'王石','/pages/upload/W020120612419212260261.jpg','出生于湖北黄冈毕业于西安交通大学并获得硕士学位 曾供职于方正集团后历任3721公司创始人雅虎中国总裁等职务 2006年周鸿袆出任奇虎360公司董事长并带领奇虎360公司于2011年3月30日在美国纽交所上市NYSEQIHU 现为360公司董事长知名天使投资人。','老子是做的互联网安全公司','“在过去的四年中，奇虎360通过为中国互联网用户提供免费的安全上网服务，积累了3亿用户群。在此基础上，奇虎360今后将致力于为用户打造一个安全上网的入口，以及建立一个开放式的平台，并从中获得增值服务和广告收入的成长机会。”','老子是做的互联网安全公司','/pages/upload/1312231843349.jpg','安全，360，奇虎',2,'1','2015-03-13 14:16:27','2015-03-19 16:16:27','北京朝阳区建外SOHO东区',NULL,NULL,'2015-02-14 14:17:48','奇虎，互联网，互联网安全',0,'一刻',3),(6,0,'奇虎360','/pages/upload/W020120612419212260261.jpg','出生于湖北黄冈毕业于西安交通大学并获得硕士学位 曾供职于方正集团后历任3721公司创始人雅虎中国总裁等职务 2006年周鸿袆出任奇虎360公司董事长并带领奇虎360公司于2011年3月30日在美国纽交所上市NYSEQIHU 现为360公司董事长知名天使投资人。','老子是做的互联网安全公司','“在过去的四年中，奇虎360通过为中国互联网用户提供免费的安全上网服务，积累了3亿用户群。在此基础上，奇虎360今后将致力于为用户打造一个安全上网的入口，以及建立一个开放式的平台，并从中获得增值服务和广告收入的成长机会。”','老子是做的互联网安全公司','/pages/upload/1312231843349.jpg','安全，360，奇虎',2,'1','2015-03-27 14:16:27','2015-03-28 00:00:00',NULL,NULL,NULL,'2015-02-14 14:20:18','奇虎，互联网，互联网安全',0,'一刻',0),(7,1,'宋新于','','你想听这位部长的首席顾问现场把中国经济怎么发展的吗？','荟·萃——艾米李画廊年度群展','活动描述','荟·萃——艾米李画廊年度群展','/pages/upload/f59aa4a8-f3df-46d0-94c7-bb9a2d6d79be.jpg',NULL,2,'1','2015-03-27 18:32:35','2015-03-31 20:37:48','北京朝阳区建外SOHO东区',NULL,NULL,'2015-02-25 16:35:37',NULL,0,'一刻',1),(8,1,'新于宋',NULL,'真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送，真心的信誉送。','真心的信誉送。新语，新华，新梅。','活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述','真心的信誉送。新语，新华，新梅。','/pages/upload/f59aa4a8-f3df-46d0-94c7-bb9a2d6d79be.jpg',NULL,2,'1','2015-03-14 16:35:02','2015-03-23 20:37:58','北京朝阳区四惠地铁站110',NULL,NULL,'2015-02-25 16:35:42',NULL,0,'一刻',0),(9,2,NULL,NULL,NULL,'22222222222','22222222222222222','2222222222222','/pages/upload/hua.jpg','222222222222',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:28:25','2222222222',0,'2222',0),(10,2,NULL,NULL,NULL,'33333333333','33333333333','333333333333333','/pages/upload/hua.jpg','33333333333',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:28:52','33',0,'33',0),(11,2,NULL,NULL,NULL,'44444444','44444444444','444444444444444444','/pages/upload/hua.jpg','4444444444444',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:29:44','44444444444',0,'4444444',0),(12,2,NULL,NULL,NULL,'55555555555','55555555555555','55555555555555555','/pages/upload/hua.jpg','55555555555555',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:30:07','5555555555',0,'55555555',0),(13,2,NULL,NULL,NULL,'66666666666','666666666666666666','66666666666666666','/pages/upload/hua.jpg','666666666666666',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:30:38','6666666666',0,'66666666666666666',0),(14,2,NULL,NULL,NULL,'777777777777777','7777777777777777','77777777777777777777','/pages/upload/hua.jpg','7777777777777777777',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:31:45','7777777777777777',0,'7777777777777',0),(15,2,NULL,NULL,NULL,'8888888888888','8888888888888888888','8888888888888888','/pages/upload/hua.jpg','8888888888888888888',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:32:03','88888888888888',0,'888888888',0),(16,2,NULL,NULL,NULL,'9999999999999999','999999999999999','9999999999999999','/pages/upload/hua.jpg','99999999999999',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:32:30','99999999999999',0,'999999999999999',0),(17,2,NULL,NULL,NULL,'101010101010','1010101010','1010101010','/pages/upload/hua.jpg','1000000000000001',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:33:47','100000000000000000000',0,'100000',0),(18,2,NULL,NULL,NULL,'111111111111111111','111111111111111111111','1111111111111111111','/pages/upload/hua.jpg','111111111111111111',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:34:19','111111111111111111111111',0,'1111111111111',0),(19,2,NULL,NULL,NULL,'AAAAAAAAAAAA','AAAAAAAAAAAAAAAAAA','AAAAAAAAAAAAAAAAA','/pages/upload/hua.jpg','AAAAAAAAAAAAAAA',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:35:08','AAAAAAAAAAAAAAAAAA',0,'AAAAAAAAAAAAA',0),(20,2,NULL,NULL,NULL,'BBBBBBBBBBBB','BBBBBBBBBBBBBBBBB','BBBBBBBBBBBBBBBBBB','/pages/upload/hua.jpg','BBBBBBBBBBBBBBBB',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:35:43','BBBBBBBBBBBBBBBBBB',0,'BBBBBBBBBBBBBBBBBBB',0),(21,2,NULL,NULL,NULL,'CCCCCCCCCCCCC','CCCCCCCCCCCC','CCCCCCCCCCCCCC','/pages/upload/hua.jpg','CCCCCCCCCCCC',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 10:36:16','CCCCCCCCCCCCC',0,'CCCCCCCCCCCC',0),(22,2,NULL,NULL,NULL,'DDDDDDDDDDD','DDDDDDDDDDDDD','DDDDDDDDDDDDD','/pages/upload/ecdd713401890ebf1638156c4531a2d0.png','DDDDDDDDDDDDDDD',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-03-03 11:48:55','DDDDDDDDDDDDDD',0,'DDDDDDDDDD',0),(23,0,'AAAAAAAAAAAA','/pages/upload/W020120612419212260261.jpg','AAAAAAAAAAAAA','AAAAAAAAAAAAAAAAAA','AAAAAAAAAAAAAAAAA','AAAAAAAAAAAAAAAAAA','/pages/upload/1312231843349.jpg','AAAAAAAAAAAA',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:42:26','AAAAAAAAAAAAA',0,'AAAAAAAAA',0),(24,0,'BBBBBBBBBB','/pages/upload/W020120612419212260261.jpg','BBBBBBBBBBBBBBB','BBBBBBBBBBBBBBB','BBBBBBBBBBBBBBB','BBBBBBBBBBBBBBB','/pages/upload/1312231843349.jpg','BBBBBBBBBBBBBB',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:43:23','BBBBBBBBBBBBBBB',0,'BBBBBBBBBBB',0),(25,0,'CCCCCCCCCCCC','/pages/upload/W020120612419212260261.jpg','CCCCCCCCCCCCC','CCCCCCCCCCCCC','CCCCCCCCCCCCC','CCCCCCCCCCCCC','/pages/upload/1312231843349.jpg','CCCCCCCCCCCC',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:44:19','CCCCCCCCCCCC',0,'CCCCCCCCC',0),(26,0,'DDDDDDDD','/pages/upload/W020120612419212260261.jpg','DDDDDDDDDDDDD','DDDDDDDDDDDDD','DDDDDDDDDDDDD','DDDDDDDDDDDDD','/pages/upload/1312231843349.jpg','DDDDDDDDDDDD',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:45:08','DDDDDDDDDDDD',0,'DDDDDDDDD',0),(27,0,'EEEEEEEEE','/pages/upload/W020120612419212260261.jpg','EEEEEEEEEEEEEEE','EEEEEEEEEEEEEEE','EEEEEEEEEEEEEEE','EEEEEEEEEEEEEEE','/pages/upload/1312231843349.jpg','EEEEEEEEEEEEEE',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:45:54','EEEEEEEEEEEEEE',0,'EEEEEEEEEE',0),(28,0,'FFFFFFFFF','/pages/upload/W020120612419212260261.jpg','FFFFFFFFFFFFFFF','FFFFFFFFFFFFFFF','FFFFFFFFFFFFFFF','FFFFFFFFFFFFFFF','/pages/upload/1312231843349.jpg','FFFFFFFFFFFFFF',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:47:04','FFFFFFFFFFFFFF',0,'FFFFFFFFFF',0),(29,0,'GGGGGGG','/pages/upload/W020120612419212260261.jpg','GGGGGGGGGGGG','GGGGGGGGGGGGG','GGGGGGGGGGGGG','GGGGGGGGGGGGG','/pages/upload/1312231843349.jpg','GGGGGGGGGGGG',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:47:47','GGGGGGGGGGGG',0,'GGGGGGGG',0),(30,0,'HHHHHHH','/pages/upload/W020120612419212260261.jpg','HHHHHHHHHHHH','HHHHHHHHHHHHH','HHHHHHHHHHHHH','HHHHHHHHHHHHH','/pages/upload/1312231843349.jpg','HHHHHHHHHHHH',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:49:15','HHHHHHHHHHHH',0,'HHHHHHHH',0),(31,0,'JJJJJJJJJJ','/pages/upload/W020120612419212260261.jpg','JJJJJJJJJJJJJJJJ','JJJJJJJJJJJJJJJJ','JJJJJJJJJJJJJJJJ','JJJJJJJJJJJJJJJJ','/pages/upload/1312231843349.jpg','JJJJJJJJJJJJJJJJ',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:50:32','JJJJJJJJJJJJJJJJJ',0,'JJJJJJJJJJJ',0),(32,0,'KKKKKKKK','/pages/upload/W020120612419212260261.jpg','KKKKKKKK','KKKKKKKK','KKKKKKKK','KKKKKKKK','/pages/upload/1312231843349.jpg','KKKKKKKK',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:50:35','KKKKKKKK',0,'KKKKKKKK',0),(33,0,'LLLLLLLLLL','/pages/upload/W020120612419212260261.jpg','LLLLLLLLLL','LLLLLLLLLL','LLLLLLLLLL','LLLLLLLLLL','/pages/upload/1312231843349.jpg','LLLLLLLLLL',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:51:03','LLLLLLLLLL',0,'LLLLLLLLLL',0),(34,0,'PPPPPPPP','/pages/upload/W020120612419212260261.jpg','PPPPPPPP','PPPPPPPP','PPPPPPPP','PPPPPPPP','/pages/upload/1312231843349.jpg','PPPPPPPP',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:51:37','PPPPPPPP',0,'PPPPPPPP',0),(35,0,'OOOOOO','/pages/upload/W020120612419212260261.jpg','OOOOOO','OOOOOO','OOOOOO','OOOOOO','/pages/upload/1312231843349.jpg','OOOOOO',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:52:03','OOOOOO',0,'OOOOOO',0),(36,0,'IIIIIIIIIIII','/pages/upload/W020120612419212260261.jpg','IIIIIIIIIIII','IIIIIIIIIIII','IIIIIIIIIIII','IIIIIIIIIIII','/pages/upload/1312231843349.jpg','IIIIIIIIIIII',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:52:35','IIIIIIIIIIII',0,'IIIIIIIIIIII',0),(37,0,'UUUUUUU','/pages/upload/W020120612419212260261.jpg','UUUUUUU','UUUUUUU','UUUUUUU','UUUUUUU','/pages/upload/1312231843349.jpg','UUUUUUU',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:53:01','UUUUUUU',0,'UUUUUUU',0),(38,0,'YYYYYYYYY','/pages/upload/W020120612419212260261.jpg','YYYYYYYYY','YYYYYYYYY','YYYYYYYYY','YYYYYYYYY','/pages/upload/1312231843349.jpg','YYYYYYYYY',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:53:28','YYYYYYYYY',0,'YYYYYYYYY',0),(39,0,'TTTTTTTTT','/pages/upload/W020120612419212260261.jpg','TTTTTTTTT','TTTTTTTTT','TTTTTTTTT','TTTTTTTTT','/pages/upload/1312231843349.jpg','TTTTTTTTT',2,'1',NULL,NULL,NULL,NULL,NULL,'2015-02-26 11:53:44','TTTTTTTTT',0,'TTTTTTTTT',0),(49,0,'小p','/pages/upload/xiaoP.jpg','小P老师要疯了','小P老师要疯了','小P老师要疯了','?????????','/pages/upload/xiaoP.jpg','小P老师要疯了',2,'0','2015-04-01 12:00:00','2014-04-01 15:00:00','小P老师要疯了',116.46,39.92,'0000-00-00 00:00:00','小P老师要疯了',0,'小P老师要疯了',0);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adv`
--

DROP TABLE IF EXISTS `adv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `summary` varchar(255) DEFAULT NULL COMMENT '正文',
  `type` int(1) DEFAULT NULL COMMENT '0: 网页活动介绍',
  `link` varchar(200) DEFAULT NULL COMMENT '链接',
  `image` varchar(80) DEFAULT NULL COMMENT '图片路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adv`
--

LOCK TABLES `adv` WRITE;
/*!40000 ALTER TABLE `adv` DISABLE KEYS */;
INSERT INTO `adv` VALUES (1,'中国的新财富英雄','近些年来， 随着中国的新兴产业发展， 涌现出了一大批的杰出企业家',1,'http://www.bing.com','/pages/upload/ad.png');
/*!40000 ALTER TABLE `adv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(40) DEFAULT NULL COMMENT '用户id',
  `name` varchar(50) DEFAULT NULL COMMENT '报名者姓名',
  `mobile` varchar(14) DEFAULT NULL COMMENT '报名者手机号码',
  `activity_id` int(10) unsigned DEFAULT NULL COMMENT '活动的ID',
  `state` int(1) DEFAULT NULL COMMENT '0：待审核\r\n 1：通过2：用户确认要来\r\n3：已参加\r\n',
  `message` varchar(255) DEFAULT NULL COMMENT '驳回原因',
  `appoint_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` VALUES (32,'92850c3c-c0a5-11e4-83ce-3065ec3f4e00','表示的啊啊','13718202649',6,0,'','2015-03-05 16:48:11'),(33,'92850c3c-c0a5-11e4-83ce-3065ec3f4e00','黄阿能','13718202649',7,0,'','2015-03-05 16:49:29'),(34,'','黄阿能','13718202649',49,0,'','2015-03-11 09:59:56'),(35,'189c8aaa-b83e-be09-eb09-db2d7a450994','黄阿能','13718202649',49,0,'','2015-03-11 17:46:26');
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel`
--

DROP TABLE IF EXISTS `channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL COMMENT '栏目的简介或描述  (预留字段)',
  `seo_title` varchar(255) DEFAULT NULL COMMENT '栏目的标题',
  `seo_desc` varchar(255) DEFAULT NULL COMMENT '描述或简介',
  `thumbnail` varchar(100) DEFAULT NULL COMMENT '栏目封面图路径(预留)',
  `seo_alt` varchar(80) DEFAULT NULL COMMENT '封面图的alt值',
  `seo_keywords` varchar(80) DEFAULT NULL COMMENT '页面SEO的关键词',
  `type` int(1) DEFAULT NULL COMMENT '0：广告位 1：演讲 2：活动 3：点他来讲 4：公开课 5：沙龙活动标签',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel`
--

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;
INSERT INTO `channel` VALUES (1,'热门演讲','推荐一些热门的演讲','热门的精彩演讲','热门的精彩演讲',NULL,NULL,'热门的精彩演讲',1),(2,'公开课','推荐一些热门的公开课',NULL,NULL,NULL,NULL,NULL,4),(3,'首页点TA来讲','首页上推荐的一些热门的人物',NULL,NULL,NULL,NULL,NULL,3),(5,'演讲预告','即将到来的精彩演讲','近期的精彩演讲预告','近期的精彩演讲预告',NULL,NULL,'演讲预告,近期演讲',1),(6,'活动预告','近期将会开始的活动','近期开始的精彩活动','近期开始的精彩活动',NULL,NULL,'近期活动',2),(7,'热门活动','热闹活动','热闹活动','热闹活动',NULL,NULL,'热闹活动',2),(8,'首页广告','首页广告',NULL,NULL,'/pages/upload/ad.png',NULL,NULL,0),(9,'首页演讲','显示在首页上的几个推荐演讲',NULL,NULL,NULL,NULL,NULL,1),(10,'首页活动','显示在首页上的推荐的几个活动',NULL,NULL,NULL,NULL,NULL,2);
/*!40000 ALTER TABLE `channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel_activity`
--

DROP TABLE IF EXISTS `channel_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) DEFAULT NULL COMMENT '栏目的id  ',
  `activity_id` int(11) DEFAULT NULL COMMENT '动活的id ',
  `number` int(2) DEFAULT NULL COMMENT '顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel_activity`
--

LOCK TABLES `channel_activity` WRITE;
/*!40000 ALTER TABLE `channel_activity` DISABLE KEYS */;
INSERT INTO `channel_activity` VALUES (1,2,1,3),(2,2,2,2),(3,1,4,0),(4,1,5,0),(5,1,6,0),(8,5,5,1),(9,5,6,2),(10,7,6,0),(11,8,6,0),(12,5,49,0),(13,6,7,0),(14,6,8,1),(15,9,5,2),(16,9,4,1),(17,10,7,1),(18,10,8,2),(19,10,7,3),(20,10,8,4),(21,10,7,5);
/*!40000 ALTER TABLE `channel_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel_adv`
--

DROP TABLE IF EXISTS `channel_adv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) NOT NULL,
  `adv_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel_adv`
--

LOCK TABLES `channel_adv` WRITE;
/*!40000 ALTER TABLE `channel_adv` DISABLE KEYS */;
INSERT INTO `channel_adv` VALUES (1,8,1,1);
/*!40000 ALTER TABLE `channel_adv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel_tag`
--

DROP TABLE IF EXISTS `channel_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) DEFAULT NULL COMMENT '栏目表的id   channel的主键',
  `tag_id` int(11) DEFAULT NULL COMMENT '签标表的id  tag的主键',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel_tag`
--

LOCK TABLES `channel_tag` WRITE;
/*!40000 ALTER TABLE `channel_tag` DISABLE KEYS */;
INSERT INTO `channel_tag` VALUES (1,6,1),(2,6,2),(3,6,3),(4,6,4),(5,6,5),(6,7,5),(7,7,4),(8,7,3),(9,7,2),(10,7,1);
/*!40000 ALTER TABLE `channel_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel_talker`
--

DROP TABLE IF EXISTS `channel_talker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel_talker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) NOT NULL,
  `talker_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel_talker`
--

LOCK TABLES `channel_talker` WRITE;
/*!40000 ALTER TABLE `channel_talker` DISABLE KEYS */;
INSERT INTO `channel_talker` VALUES (1,3,1,1),(2,3,2,2);
/*!40000 ALTER TABLE `channel_talker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_code`
--

DROP TABLE IF EXISTS `check_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(13) DEFAULT NULL COMMENT '手机号码',
  `verify_code` varchar(8) DEFAULT NULL COMMENT '验证码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_code`
--

LOCK TABLES `check_code` WRITE;
/*!40000 ALTER TABLE `check_code` DISABLE KEYS */;
INSERT INTO `check_code` VALUES (10,'13718202649','719161');
/*!40000 ALTER TABLE `check_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_device`
--

DROP TABLE IF EXISTS `client_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imei` varchar(100) DEFAULT NULL COMMENT '只有Android有',
  `model` varchar(100) DEFAULT NULL COMMENT '备设型号',
  `sw_version` varchar(25) DEFAULT NULL COMMENT '软件版本号',
  `width` int(11) DEFAULT NULL COMMENT '宽度',
  `height` int(11) DEFAULT NULL COMMENT '屏幕的高度',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_device`
--

LOCK TABLES `client_device` WRITE;
/*!40000 ALTER TABLE `client_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(40) DEFAULT NULL COMMENT 'user的id',
  `activity_id` int(11) DEFAULT NULL COMMENT '动活的id',
  `detail` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `sub_time` datetime DEFAULT NULL COMMENT '提交时间',
  `state` int(11) DEFAULT NULL COMMENT '0：待审核\r\n1：已发布\r\n2：驳回\r\n',
  `reason` varchar(255) DEFAULT NULL COMMENT '驳回原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (13,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 15:56:30',1,''),(14,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 15:57:13',1,''),(15,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 15:57:47',1,''),(16,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 15:57:53',1,''),(17,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 15:58:16',1,''),(18,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 15:58:40',1,''),(19,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 15:59:56',1,''),(20,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 16:00:09',1,''),(21,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'asdasd','2015-03-11 16:00:20',1,''),(22,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'先生  您好','2015-03-11 16:05:55',1,''),(23,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'先生  您好','2015-03-11 16:06:28',1,''),(24,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'阿斯达  您好','2015-03-11 16:06:58',1,''),(25,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'阿斯达  您好 你真的好吗？','2015-03-11 16:07:09',1,''),(26,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,' 您好？','2015-03-11 16:10:54',1,''),(27,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,' 您好？','2015-03-11 16:11:33',1,''),(28,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,' 您真的好啊？','2015-03-11 16:11:55',1,''),(29,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'阿斯达','2015-03-11 16:13:10',1,''),(30,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,' 你是谁？','2015-03-11 16:15:17',1,''),(31,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,' 我认识你吗》？','2015-03-11 16:15:32',1,''),(32,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'js 注入','2015-03-11 16:15:58',1,''),(33,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'<p style=\"color:red;\"> I LOVE YOU</p>','2015-03-11 16:16:57',1,''),(34,'189c8aaa-b83e-be09-eb09-db2d7a450994',7,'我不爱你了','2015-03-11 16:58:19',1,''),(35,'189c8aaa-b83e-be09-eb09-db2d7a450994',4,'真是 什么也没有','2015-03-11 17:31:18',1,'');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity`
--

DROP TABLE IF EXISTS `commodity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品ID       自增',
  `name` varchar(80) DEFAULT NULL COMMENT '商品名',
  `image_path` varchar(100) DEFAULT NULL COMMENT '商品图片路径',
  `seo_alt` varchar(80) DEFAULT NULL COMMENT '图片alt值',
  `link` varchar(255) DEFAULT NULL COMMENT '详情介绍链接',
  `code` varchar(100) DEFAULT NULL COMMENT '优惠码或兑换码',
  `price` int(10) unsigned DEFAULT NULL COMMENT '兑换商品所需积分',
  `city` varchar(255) DEFAULT NULL COMMENT '适用地区范围',
  `summary` varchar(255) DEFAULT NULL COMMENT '商品简介',
  `duration` varchar(128) DEFAULT NULL COMMENT '兑换截止日期',
  `method` varchar(1000) DEFAULT NULL COMMENT '兑换流程',
  `act_desc` varchar(100) DEFAULT NULL COMMENT '活动说明',
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity`
--

LOCK TABLES `commodity` WRITE;
/*!40000 ALTER TABLE `commodity` DISABLE KEYS */;
INSERT INTO `commodity` VALUES (1,'英伦咖啡杯','/pages/upload/commodity_01.png','英伦咖啡杯',NULL,NULL,100,'北京',NULL,'2015年1月31日之前','1. 关注微信一刻演讲\r\n2. 回复回复信息\r\n3. 支付0.01元外加10元快递费','由一刻度演讲提供，活动最终解释权归一刻演讲所有',20),(2,'法国小香水','/pages/upload/commodity_02.png','法国小香水',NULL,NULL,300,'全国',NULL,'2015.5.1日之前','现场参加一刻演讲，并留下姓名\r\n每次演讲之后的两周内开奖','奖品由一刻演讲活动提供',6);
/*!40000 ALTER TABLE `commodity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange_record`
--

DROP TABLE IF EXISTS `exchange_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchange_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_id` int(11) DEFAULT NULL COMMENT '品商ID',
  `user_id` varchar(40) DEFAULT NULL COMMENT '户用id',
  `mobile` varchar(14) DEFAULT NULL COMMENT '手机号码',
  `address` varchar(255) DEFAULT NULL COMMENT '邮寄地址',
  `name` varchar(100) DEFAULT NULL COMMENT '货收人',
  `exch_time` datetime DEFAULT NULL COMMENT '兑换时间',
  `code` varchar(255) DEFAULT NULL COMMENT '兑换码',
  `state` int(1) DEFAULT NULL COMMENT '0: 线下已领取  1：带线下领取',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange_record`
--

LOCK TABLES `exchange_record` WRITE;
/*!40000 ALTER TABLE `exchange_record` DISABLE KEYS */;
INSERT INTO `exchange_record` VALUES (1,1,'0','18500135623','北京市朝阳区慈云寺东区国际','宋昱鹏','2015-02-25 12:11:45',NULL,0);
/*!40000 ALTER TABLE `exchange_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL COMMENT '用户ID',
  `act_id` int(11) DEFAULT NULL COMMENT '活动ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` VALUES (1,'0',6),(2,'0',7),(3,'0',8),(4,'0',8);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) DEFAULT NULL COMMENT '热词',
  `heat` int(1) DEFAULT NULL COMMENT '热度',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keywords`
--

LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
INSERT INTO `keywords` VALUES (1,'轮回',4),(2,'旅行',10);
/*!40000 ALTER TABLE `keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score_record`
--

DROP TABLE IF EXISTS `score_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(40) DEFAULT NULL COMMENT '用户ID',
  `type` int(1) DEFAULT NULL COMMENT '0:积分获取,1:积分兑换',
  `amount` int(11) DEFAULT NULL COMMENT '积分值',
  `rule_id` int(11) DEFAULT NULL COMMENT '积分规则ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score_record`
--

LOCK TABLES `score_record` WRITE;
/*!40000 ALTER TABLE `score_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `score_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score_rule`
--

DROP TABLE IF EXISTS `score_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '规则标题',
  `detail` text COMMENT '规则说明',
  `times_in_day` int(2) DEFAULT NULL COMMENT '一天之内最多次数',
  `times_in_hour` int(2) DEFAULT NULL COMMENT '一小时之内最多次数',
  `valid` int(1) DEFAULT NULL COMMENT '规则是否开启  0：开启 1：关闭',
  `amount` int(11) DEFAULT NULL COMMENT '规则增加积分数',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score_rule`
--

LOCK TABLES `score_rule` WRITE;
/*!40000 ALTER TABLE `score_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `score_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL COMMENT '段落类型  0：文字 1：图片 2：链接 3：视图 4：标题',
  `detail` text COMMENT '纯文本  0 2 3 4 ',
  `image_path` varchar(80) DEFAULT NULL COMMENT '图片路径,或视频截图（1,3）',
  `seo_alt` varchar(80) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL COMMENT '外部链接（2,3）',
  `num` int(2) DEFAULT NULL COMMENT '段落顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES (1,2,NULL,NULL,NULL,1,'http://www.baidu.com',0),(2,2,NULL,NULL,NULL,2,'',0),(3,2,NULL,NULL,NULL,3,'http://ke.qq.com',0),(5,3,'雷军北大演讲','/pages/upload/1312231843349.jpg','雷军北大演讲',5,'http://www.iqiyi.com/w_19rscmi72p.html',1),(6,0,'我不知道写些什么，那就这样吧！先看到凑合一下。',NULL,NULL,5,NULL,2),(7,0,'纯文本第一段',NULL,NULL,8,NULL,1),(8,0,'纯文本第二段',NULL,NULL,8,NULL,2),(9,0,'纯文本第三段',NULL,NULL,8,NULL,3);
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '标签名',
  `thumbnail` varchar(80) DEFAULT NULL COMMENT '标签图片路径',
  `seo_alt` varchar(80) DEFAULT NULL COMMENT '图片alt值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'文化',NULL,NULL),(2,'心理',NULL,NULL),(3,'亲子',NULL,NULL),(4,'创业',NULL,NULL),(5,'职场',NULL,NULL);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_activity`
--

DROP TABLE IF EXISTS `tag_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) DEFAULT NULL COMMENT '标签表tag 的id',
  `activity_id` int(11) DEFAULT NULL COMMENT '活动id  activity表的主键',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_activity`
--

LOCK TABLES `tag_activity` WRITE;
/*!40000 ALTER TABLE `tag_activity` DISABLE KEYS */;
INSERT INTO `tag_activity` VALUES (1,1,7),(2,2,7),(3,3,8),(4,4,8),(5,5,8),(6,5,8),(7,1,8);
/*!40000 ALTER TABLE `tag_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talker`
--

DROP TABLE IF EXISTS `talker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '人名',
  `points` int(11) DEFAULT '0' COMMENT '多少人点过',
  `image` varchar(255) DEFAULT NULL COMMENT '图片路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talker`
--

LOCK TABLES `talker` WRITE;
/*!40000 ALTER TABLE `talker` DISABLE KEYS */;
INSERT INTO `talker` VALUES (1,'小P',102,'/pages/upload/xiaoP.jpg'),(2,'小H',87,'/pages/upload/xiaoP.jpg'),(3,'小A',25,'/pages/upload/xiaoP.jpg'),(4,'小B',9,'/pages/upload/xiaoP.jpg'),(5,'小D',3,'/pages/upload/xiaoP.jpg'),(6,'小E',6,'/pages/upload/xiaoP.jpg'),(7,'小F',2,'/pages/upload/xiaoP.jpg'),(8,'小G',11,'/pages/upload/xiaoP.jpg'),(9,'小J',23,'/pages/upload/xiaoP.jpg'),(10,'小K',22,'/pages/upload/xiaoP.jpg'),(11,'小L',22,'/pages/upload/xiaoP.jpg'),(12,'小O',12,'/pages/upload/xiaoP.jpg'),(13,'小I',0,'/pages/upload/xiaoP.jpg'),(14,'小U',1,'/pages/upload/xiaoP.jpg'),(15,'小Y',1,'/pages/upload/xiaoP.jpg'),(16,'小T',0,'/pages/upload/xiaoP.jpg'),(17,'小R',1,'/pages/upload/xiaoP.jpg'),(18,'小W',13,'/pages/upload/xiaoP.jpg'),(19,'小Q',0,'/pages/upload/xiaoP.jpg'),(20,'小z',6,'/pages/upload/xiaoP.jpg'),(21,'小X',108,'/pages/upload/xiaoP.jpg'),(22,'小C',0,'/pages/upload/xiaoP.jpg'),(23,'小V',0,'/pages/upload/xiaoP.jpg'),(24,'小N',4,'/pages/upload/xiaoP.jpg'),(25,'小M',9,'/pages/upload/xiaoP.jpg');
/*!40000 ALTER TABLE `talker` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-13 18:19:43
