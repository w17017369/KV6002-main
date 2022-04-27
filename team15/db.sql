/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.27-log : Database - shop6002
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`shop6002` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `shop6002`;

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

/*Data for the table `cart` */


/*Data for the table `cc_user` */

insert  into `cc_user`(`Id`,`username`,`password`,`day`,`email`,`phone`,`update_time`,`created_at`) values 
(7,'123','e10adc3949ba59abbe56e057f20f883e',0,'','',1610382415,1610331402),
(13,'666','fae0b27c451c728867a567e8c1bb4e53',0,'614141873@qq.com','13581996629',NULL,1610436355),
(26,'1','c4ca4238a0b923820dcc509a6f75849b',0,'614141873@qq.com','phone',NULL,1610440956),
(27,'2','c81e728d9d4c2f636f067f89cc14862c',0,'','13581996629',1610441331,1610441314),
(28,'3','202cb962ac59075b964b07152d234b70',0,'','13581996629',1610442669,1610442642),
(29,'4','a87ff679a2f3e71d9181a67b7542122c',0,'614141873@qq.com','phone',NULL,1610443047),
(30,'5','202cb962ac59075b964b07152d234b70',0,'614141873@qq.com','13581996629',1610443128,1610443106),
(32,'1234','81dc9bdb52d04dc20036dbd8313ed055',0,'15992389958@qq.com','phone',NULL,1638887821),
(33,'12333','a8ae104615cb4e966ddb435f3e575a02',1647446400,'12345621@qq.com','13042781123',NULL,1647271474),
(34,'test','098f6bcd4621d373cade4e832627b4f6',1646582400,'tim.y.zhang@outlook.com','18077453883',NULL,1648400884),
(35,'user','ee11cbb19052e40b07aac0ca060c23ee',1646236800,'tim.y.zhang@outlook.com','18077453883',NULL,1648417933),
(36,'user123','6ad14ba9986e3615423dfca256d04e3f',1646150400,'tim.y.zhang@outlook.com','18077453883',NULL,1648421678);

/*Table structure for table `dsf_users` */

DROP TABLE IF EXISTS `dsf_users`;

CREATE TABLE `dsf_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` int(4) NOT NULL COMMENT '0-Administrator,1-Customer',
  `email` varchar(30) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `dsf_users` */

insert  into `dsf_users`(`userid`,`username`,`password_hash`,`phone`,`role`,`email`,`firstname`,`surname`) values 
(1,'admin1234','$2y$10$241VguAQ6fD12z38.FQ/bul3NU8yYoIXPQSbeN6lU5nSlyJsLVjgG',NULL,1,NULL,'Allison','Smith'),
(7,'user1234','45$Qr87$482d',NULL,1,NULL,NULL,NULL),
(36,'user123','safasfas',NULL,1,NULL,NULL,NULL),
(0,'testName','3242',NULL,1,NULL,NULL,NULL);

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `uid` int(11) DEFAULT '0',
  `pid` int(11) DEFAULT '0',
  `content` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `img` varchar(128) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `message` */

insert  into `message`(`id`,`tid`,`uid`,`pid`,`content`,`create_time`,`img`) values 
(1,1,7,7,'123123',1604246400,'images/1649673060.jpg'),
(2,1,7,7,'123',1648393948,'images/1649673060.jpg'),
(3,1,0,0,'123',1649673060,'images/1649673060.jpg'),
(4,1,0,0,'11111',1649673240,'images/1649673240.jpg'),
(5,1,0,0,'111',1649675884,'images/1649675884.jpg'),
(6,1,0,0,'sssss',1649675997,'images/1649675997.jpg'),
(7,9,0,0,'523523',1650665991,''),
(8,10,0,0,'32532532532',1650665997,'images/1650665997.jpg'),
(9,10,0,0,'325325235253235253',1650666006,'images/1650666006.jpg'),
(10,10,0,0,'11111111111111',1650666018,'images/1650666018.jpg'),
(11,10,0,0,'test Picture',1650666218,'images/1650666218.jpg'),
(12,10,7,0,'aaaaaaaaaaaaaaaaaaaaa',1650666534,''),
(13,5,0,0,'35252',1650935863,'images/1650935863.jpg'),
(14,5,0,0,'aaaaaaaaa',1650935902,'images/1650935902.jpg'),
(15,11,0,0,'3223323232',1651005585,''),
(16,1,0,0,'1',1651005938,'1'),
(17,1,0,0,'1',1651005942,'1'),
(18,1,0,0,'1',1651005996,''),
(19,12,0,0,'32423',1651006217,''),
(20,8,0,0,'32423',1651006227,''),
(21,12,0,0,'3423',1651006375,''),
(22,11,0,0,'432',1651006379,''),
(23,12,0,0,'AAAAAAAAAA',1651006431,''),
(24,12,0,0,'test',1651062203,'images/1651062203.jpg'),
(25,14,0,0,'test',1651077308,''),
(26,14,0,0,'aaa',1651077318,'images/1651077318.jpg'),
(27,16,0,0,'aaaaa',1651077391,'images/1651077391.jpg'),
(28,18,0,0,'test',1651094511,'images/1651094511.jpg'),
(29,18,0,0,'test',1651094519,'');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `proid` varchar(64) NOT NULL COMMENT 'product id',
  `cateid` varchar(64) DEFAULT NULL COMMENT 'category_id',
  `name` varchar(100) NOT NULL,
  `subtitle` varchar(200) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL COMMENT 'product image',
  `detail` text,
  `price` decimal(20,2) NOT NULL COMMENT 'Product price. Retain two decimal places',
  `stock` int(11) NOT NULL,
  `status` int(6) DEFAULT '1' COMMENT 'Product Status.1-On Sale 2-Take down 3-Deleted',
  `createtime` datetime DEFAULT NULL COMMENT 'Product create time',
  `updatetime` datetime DEFAULT NULL COMMENT 'Product update time',
  PRIMARY KEY (`proid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`proid`,`cateid`,`name`,`subtitle`,`image`,`detail`,`price`,`stock`,`status`,`createtime`,`updatetime`) values 
('p1','1','blackcap','1','blackcap.png',NULL,1.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p10','2','peachcase','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p11','2','glass1','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p12','2','glass2','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p13','2','hoodie1','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p14','2','hoodie2','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p15','2','hoodie3','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p16','2','plaint','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p17','2','bluet','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p18','2','coralt','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p19','2','greent','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p2','1','pinkcap','1','pinkcap.png',NULL,2.00,2,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p20','2','pinkt','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p21','2','redt','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p22','2','tealt','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p23','2','whitet','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p24','2','blackt','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p3','2','keyring','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p4','2','keyring2','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p5','2','keyring3','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p6','1','mug1','1','blackcap.png',NULL,1.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p7','1','mug2','1','pinkcap.png',NULL,2.00,2,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p8','2','mug3','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01'),
('p9','2','whitecase','1','pinkcap.png',NULL,2.00,1,1,'2022-04-15 14:11:57','2022-04-30 14:12:01');

/*Table structure for table `topic` */

DROP TABLE IF EXISTS `topic`;

CREATE TABLE `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `img` varchar(128) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `topic` */

insert  into `topic`(`id`,`title`,`content`,`uid`,`create_time`,`img`) values 
(1,'1212111','1222212121',7,1604246400,''),
(3,'111','222',7,1650120555,''),
(4,'222','222',7,1650120596,'images/1650120596.jpg'),
(5,'2141','2412',7,1650583327,'images/1650583327.jpg'),
(6,'test','hhhh',7,1650584031,'images/1650584031.jpg'),
(7,'214124','421412412',7,1650584106,'images/1650584106.jpg'),
(8,'4124124','21412',7,1650585064,''),
(9,'432','32423',7,1650586422,''),
(10,'352532','32523523523',7,1650665118,''),
(11,'4232323','5325323',7,1650668809,''),
(12,'dasd','as',7,1651005709,''),
(13,'test','test',7,1651062215,''),
(14,'aaaa','aaaaa',7,1651077303,''),
(15,'test','aaa',7,1651077328,'images/1651077328.jpg'),
(16,'tedt','test',7,1651077382,''),
(17,'2222','222',7,1651092050,''),
(18,'test','test ',7,1651094493,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
