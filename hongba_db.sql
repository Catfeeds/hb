/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : hongba_db

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2018-03-21 14:35:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ysk_admin
-- ----------------------------
DROP TABLE IF EXISTS `ysk_admin`;
CREATE TABLE `ysk_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'UID',
  `auth_id` int(11) NOT NULL DEFAULT '1' COMMENT '角色ID',
  `nickname` varchar(63) DEFAULT NULL COMMENT '昵称',
  `username` varchar(31) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(63) NOT NULL DEFAULT '' COMMENT '密码',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  `reg_type` varchar(20) DEFAULT NULL COMMENT '注册人',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='用户账号表';

-- ----------------------------
-- Records of ysk_admin
-- ----------------------------
INSERT INTO `ysk_admin` VALUES ('1', '1', '超级管理员', 'admin', '8f3bd6b4d00391c9d09cc14e32fee28c', '', '0', '1438651748', '1521107659', '1', '');
INSERT INTO `ysk_admin` VALUES ('18', '7', '测试', 'test', '8f3bd6b4d00391c9d09cc14e32fee28c', '', '0', '1517741110', '1520046466', '1', null);

-- ----------------------------
-- Table structure for ysk_anzi_detail
-- ----------------------------
DROP TABLE IF EXISTS `ysk_anzi_detail`;
CREATE TABLE `ysk_anzi_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '玉贝记录表',
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '数额',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` char(20) NOT NULL DEFAULT '',
  `type_name` varchar(20) DEFAULT NULL COMMENT '操作名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `from_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-转入 2-转出',
  `content` varchar(255) DEFAULT NULL COMMENT '说明s',
  `money_record` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值记录',
  `fee` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_anzi_detail
-- ----------------------------
INSERT INTO `ysk_anzi_detail` VALUES ('1', '8880.00', '317', 'children', '2级分享奖励', '1', '1521182994', '1', '2级分享奖励8880', '8880.00', null);
INSERT INTO `ysk_anzi_detail` VALUES ('2', '10000.00', '317', 'admin', '后台充值', '1', '1521186122', '1', '后台充值10000', '8892.00', null);
INSERT INTO `ysk_anzi_detail` VALUES ('3', '10000.00', '317', 'admin', '后台充值', '1', '1521186331', '1', '后台充值10000', '8892.00', null);
INSERT INTO `ysk_anzi_detail` VALUES ('4', '10000.00', '317', 'getmoney', '提现', '1', '1521186394', '2', '提现10000,手续费2000', '8880.00', null);
INSERT INTO `ysk_anzi_detail` VALUES ('7', '10000.00', '317', 'moneyback', '提现失败', '1', '1521191517', '1', '提现审核不通过，退回10000.00', '18880.00', null);
INSERT INTO `ysk_anzi_detail` VALUES ('8', '10000.00', '317', 'getmoney', '提现', '1', '1521194843', '2', '提现10000,手续费2000', '8880.00', null);

-- ----------------------------
-- Table structure for ysk_article
-- ----------------------------
DROP TABLE IF EXISTS `ysk_article`;
CREATE TABLE `ysk_article` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `savetime` varchar(222) NOT NULL COMMENT '更新时间',
  `content` text NOT NULL COMMENT '文章内容',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_article
-- ----------------------------
INSERT INTO `ysk_article` VALUES ('3', '宏宝用户注册协议', '1521110426', '<p align=\"center\" class=\"MsoNormal\" style=\"text-align:center;\">\r\n	提示条款\r\n</p>\r\n<p align=\"left\" class=\"MsoNormal\" style=\"text-indent:21pt;\">\r\n	宏宝用户注册协议\r\n</p>', '2');
INSERT INTO `ysk_article` VALUES ('4', '公司介绍', '1517759331', '<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span> </span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<strong></strong> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">辽宁华彩网络科技有限公司成立于2017年11月22日，公司位于辽宁省大连市，注册资本5000万元。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<b><span style=\"font-size:16px;\">一、经营理念</span><span></span></b> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">以不断创新迭代的产品和服务，让每一位用户升级为消费商，打造连接亿万用户和千万商户的分享经济平台，未来就是要建互联网+生活消费领域全民共享生态圈。一站式吃喝玩乐住行娱，线上线下，圈内圈外，能生活、能娱乐、能交友、能理财、能赚钱。根据不同的需求有机、立体的结合，形成循环消费、财富共享！</span><b></b> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\"><strong>二、公司目标</strong></span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">短期目标：打造品牌知名度，平台及商城交易额持续增长，具备初步盈利能力。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">中期目标：创建省市著名品牌，辐射区域市场，具备较强盈利能力。登陆新三板。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">长期目标：创建全国著名品牌，辐射全国市场，争取主板上市（IPO）。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\"><strong>三、组织机构</strong></span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">公司下设市场运营中心、平台运营中心、行政管理中心、金融服务中心和技术研发中心等五大运营中心，各部门直接对总裁负责，定期向总裁汇报各部门职责内工作情况。</span><span style=\"font-size:16px;\">&nbsp;</span><span style=\"font-size:14px;\"><br />\r\n&nbsp;</span>&nbsp;<span style=\"font-size:14px;\"><br />\r\n&nbsp;</span> <img alt=\"\" src=\"/static/plugin/attached/image/20180204/20180204234646_57227.png\" /> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<br />\r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:14px;\"> </span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">市场运营中心包括客户培训部，市场运营部，网络运营部，大项目部。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">◎客户培训部，负责来访客户课程讲解。研发培训课程，培训优秀讲师，服务于“华彩”全国乃至全球会员，为市场输送优秀人才。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">◎市场运营部，负责公司日常业务运营工作及客户服务，接待来访客户，服务客户体验华彩电商平台，办理联盟企业/商家、联合代理相关的业务。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">◎网络运营部，负责通过微信、直播等网络平台对“华彩”进行品牌传播和招商推广，在用户和公司之间建立良好的沟通平台，让全世界的用户足不出户就能了解我们的消费商模式。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">◎项目部，负责对接“华彩”电商平台的各种资源能良性发展，充分体现消费商模式工具的优越性，维护品牌形象，提升联盟商家/企业销售流通速度，保障消费者的权益。大项目部对各种大型项目及优质产品进行规范化推广。</span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\"><strong>四、运营模式</strong></span> \r\n</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28pt;\">\r\n	<span style=\"font-size:16px;\">创新采用“电商平台（网络商城＋积分商城＋联盟商家）＋金融服务（第三方支付+虚拟货币+投资理财）＋客户培训”的消费商模式电商平台。</span> \r\n</p>\r\n<br />\r\n<p>\r\n	<br />\r\n</p>\r\n<span style=\"font-size:14px;\"></span> \r\n<p>\r\n	<br />\r\n</p>', '1');
INSERT INTO `ysk_article` VALUES ('13', '网站检测', '1520093894', '<a href=\"http://webscan.360.cn/index/checkwebsite/url/lndttx.net\" name=\"ba4f2250a22bb8f15cbee0ce7c51a2f5\" >360网站安全检测平台</a>', '3');

-- ----------------------------
-- Table structure for ysk_bank_name
-- ----------------------------
DROP TABLE IF EXISTS `ysk_bank_name`;
CREATE TABLE `ysk_bank_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `bank_name` varchar(20) NOT NULL COMMENT '银行类型',
  `bank_img` varchar(150) NOT NULL COMMENT '银行卡类型图片',
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='银行卡类型表';

-- ----------------------------
-- Records of ysk_bank_name
-- ----------------------------
INSERT INTO `ysk_bank_name` VALUES ('1', '中国工商银行', '/static/home/common/images/banks/95588.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('2', '中国建设银行', '/static/home/common/images/banks/95533.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('3', '中国银行', '/static/home/common/images/banks/95566.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('4', '中国交通银行', '/static/home/common/images/banks/95559.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('5', '中国农业银行', '/static/home/common/images/banks/95599.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('6', '招商银行', '/static/home/common/images/banks/95555.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('7', '中国邮政银行', '/static/home/common/images/banks/95580.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('8', '中国光大银行', '/static/home/common/images/banks/95595.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('9', '中国民生银行', '/static/home/common/images/banks/95568.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('10', '中国平安银行', '/static/home/common/images/banks/pinganyinhang_xin.jpg', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('11', '中国浦发银行', '/static/home/common/images/banks/95528.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('12', '中信银行', '/static/home/common/images/banks/95558.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('13', '兴业银行', '/static/home/common/images/banks/95561.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('14', '华夏银行', '/static/home/common/images/banks/95577.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('15', '广发银行', '/static/home/common/images/banks/95508.png', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('16', '农村信用社', '/static/home/common/images/banks/ncxys.jpg', '0', '1');
INSERT INTO `ysk_bank_name` VALUES ('17', '深圳农村商业银行', '/static/home/common/images/banks/sznc.jpg', '0', '1');

-- ----------------------------
-- Table structure for ysk_banner
-- ----------------------------
DROP TABLE IF EXISTS `ysk_banner`;
CREATE TABLE `ysk_banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `b_img` varchar(255) NOT NULL COMMENT '图片路径',
  `b_link` varchar(255) NOT NULL COMMENT '链接',
  `b_type` varchar(20) NOT NULL COMMENT '摆放位置',
  `b_name` varchar(20) NOT NULL COMMENT '广告名称',
  `b_order` int(11) NOT NULL DEFAULT '0' COMMENT '排序，数值越大越靠前',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-显示 0- 不显示',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_banner
-- ----------------------------
INSERT INTO `ysk_banner` VALUES ('11', '/uploads/20180315\\83f9139765e535a5eb2e4f9623c1f310.jpg', '', 'mall_index_wap', '', '1', '1', '1517758807');
INSERT INTO `ysk_banner` VALUES ('12', '/uploads/20180315\\06346b2c79591ac3dd593322a9f8af98.jpg', '', 'mall_index_wap', '', '3', '1', '1517758849');
INSERT INTO `ysk_banner` VALUES ('13', '/uploads/20180315\\712cdb1b6b17ee8fca0a0db6082bb4b3.jpg', '', 'mall_index_wap', '', '2', '1', '1517758866');
INSERT INTO `ysk_banner` VALUES ('17', '/uploads/20180315\\00774a2a894b72878f092bbd26f645ee.jpg', '', 'total', '', '0', '1', '1521109049');
INSERT INTO `ysk_banner` VALUES ('18', '/uploads/20180315\\3516e3215fecde11f8fcf7d8c48c2960.jpg', '', 'total', '', '0', '1', '1521109060');

-- ----------------------------
-- Table structure for ysk_cash_detail
-- ----------------------------
DROP TABLE IF EXISTS `ysk_cash_detail`;
CREATE TABLE `ysk_cash_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '现金记录表',
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '数额',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` char(20) NOT NULL DEFAULT '',
  `type_name` varchar(20) DEFAULT NULL COMMENT '操作名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `from_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-转入 2-转出',
  `content` varchar(255) DEFAULT NULL COMMENT '说明s',
  `money_record` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值记录',
  `fee` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_cash_detail
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_cash_get
-- ----------------------------
DROP TABLE IF EXISTS `ysk_cash_get`;
CREATE TABLE `ysk_cash_get` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '提现记录表',
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '提现金额',
  `fee` decimal(13,2) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '转账银行名称',
  `bank_username` varchar(50) DEFAULT NULL,
  `bank_no` varchar(50) DEFAULT NULL COMMENT '卡号',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `content` varchar(255) DEFAULT NULL COMMENT '说明',
  `reply` varchar(255) DEFAULT NULL COMMENT '回复',
  `admin_id` int(11) DEFAULT NULL COMMENT '回复人',
  `username` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_cash_get
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_config
-- ----------------------------
DROP TABLE IF EXISTS `ysk_config`;
CREATE TABLE `ysk_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(32) DEFAULT NULL COMMENT '配置名称',
  `value` text NOT NULL COMMENT '配置值',
  `group` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '配置类型',
  `options` varchar(255) NOT NULL DEFAULT '' COMMENT '配置额外值',
  `tip` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of ysk_config
-- ----------------------------
INSERT INTO `ysk_config` VALUES ('1', '站点开关', 'TOGGLE_WEB_SITE', '1', '3', '0', '0:关闭\r\n1:开启', '系统升级维护中。。。', '1378898976', '1406992386', '1', '1');
INSERT INTO `ysk_config` VALUES ('2', '网站标题', 'WEB_SITE_TITLE', '宏八商城', '1', '0', '', '网站标题前台显示标题', '1378898976', '1379235274', '2', '1');
INSERT INTO `ysk_config` VALUES ('3', '网站LOGO', 'WEB_SITE_LOGO', '/uploads/temp/2018/03-15/bb8be7876b26a9079c5eca2fb47df9cb.png', '1', '0', '', '网站LOGO', '1407003397', '1407004692', '3', '1');
INSERT INTO `ysk_config` VALUES ('4', '网站描述', 'WEB_SITE_DESCRIPTION', '宏八商城，商城购物，分销商城', '1', '0', '', '网站搜索引擎描述', '1378898976', '1379235841', '4', '1');
INSERT INTO `ysk_config` VALUES ('5', '网站关键字', 'WEB_SITE_KEYWORD', '宏八商城，商城购物，分销商城', '1', '0', '', '网站搜索引擎关键字', '1378898976', '1381390100', '5', '1');
INSERT INTO `ysk_config` VALUES ('6', '版权信息', 'WEB_SITE_COPYRIGHT', '版权信息', '1', '0', '', '设置在网站底部显示的版权信息，如“版权所有 © 2014-2015 科斯克网络科技”', '1406991855', '1406992583', '6', '1');
INSERT INTO `ysk_config` VALUES ('7', '网站备案号', 'WEB_SITE_ICP', '123123', '1', '0', '', '设置在网站底部显示的备案号，如“苏ICP备1502009号\"', '1378900335', '1415983236', '9', '1');
INSERT INTO `ysk_config` VALUES ('8', '网站名称', 'WEB_SITE_NAME', '宏八商城', '1', '0', '', '', '0', '0', '20', '1');
INSERT INTO `ysk_config` VALUES ('9', '联系电话', 'WEB_TEL', '40015656', '1', '0', '', '', '0', '0', '21', '1');
INSERT INTO `ysk_config` VALUES ('10', '联系手机', 'WEB_MOBILE', '', '1', '0', '', '', '0', '0', '21', '1');
INSERT INTO `ysk_config` VALUES ('11', 'QQ', 'WEB_QQ1', '12312313', '1', '0', '', '', '0', '0', '30', '1');
INSERT INTO `ysk_config` VALUES ('12', 'QQ', 'WEB_QQ2', '123123', '1', '0', '', '', '0', '0', '31', '1');
INSERT INTO `ysk_config` VALUES ('13', '客服微信', 'WEB_WX', '/uploads/temp/2018/03-15/217c9e56fcaa8a484f0df04aae166bff.png', '1', '0', '', '', '0', '0', '31', '1');
INSERT INTO `ysk_config` VALUES ('14', '分享奖励(玉贝)', 'abzi_fee', '20', '4', '', '', '', '0', '0', '23', '0');
INSERT INTO `ysk_config` VALUES ('15', '一级消费奖励(积分)', 'buy_fee', '5', '4', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('16', '一级销售奖励(积分)', 'sell_fee', '2.5', '4', '', '', '', '0', '0', '33', '1');
INSERT INTO `ysk_config` VALUES ('24', '单笔提现额度', 'money_max', '50000', '2', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('25', '提现倍数', 'money_beishu', '100', '2', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('27', '默认库存', 'good_default', '100', '2', '4', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('28', '库存预警', 'good_less', '1', '2', '4', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('29', '会员注册赠送积分', 'reg_integral', '0', '2', '4', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('30', '邀请人获得积分', 'parent_integral', '0', '2', '4', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('31', '邀请注册开关', 'close_reg', '1', '2', '4', '0:关闭1:开启', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('32', '提现手续费', 'money_fee_one', '7', '2', '0', '0:关闭1:开启', '关闭注册功能说明', '0', '0', '12', '1');
INSERT INTO `ysk_config` VALUES ('33', '一级分销', 'one_fee', '20', '4', '', '0:关闭1:开启', '交易暂时关闭，16:00后开启', '0', '0', '13', '1');
INSERT INTO `ysk_config` VALUES ('34', '二级分销', 'two_fee', '10', '4', '', '0:关闭1:开启', '关闭果子转出说明11', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('35', '三级分销', 'three_fee', '6', '4', '', '', '', '0', '0', '33', '1');
INSERT INTO `ysk_config` VALUES ('36', '特别奖励(积分)', 'come_fee', '50', '4', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('37', '高级拆分倍数', 'height_lv', '1.5', '2', '4', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('38', '三级好友采矿拆分', 'friends_three', '1', '2', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('39', '公司收款账户名', 'company_account_name', '宏八商城', '2', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('40', '公司收款账户开户行', 'company_account_bank', '交通银行', '2', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('41', '公司收款账户', 'company_account_no', '566654545454544444', '2', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('42', '二级消费奖励(积分)', 'buy_fee_two', '0', '4', '', '', '', '0', '0', '0', '1');
INSERT INTO `ysk_config` VALUES ('43', '二级销售奖励(积分)', 'sell_fee_two', '0', '4', '', '', '', '0', '0', '33', '1');
INSERT INTO `ysk_config` VALUES ('44', '提现手续费', 'money_fee_three', '5', '2', '1', '', '', '0', '0', '12', '1');
INSERT INTO `ysk_config` VALUES ('45', '提现手续费', 'money_fee_five', '3', '2', '3', '', '', '0', '0', '12', '1');
INSERT INTO `ysk_config` VALUES ('46', '提现手续费', 'money_fee_seven', '1', '2', '7', '', '', '0', '0', '12', '1');
INSERT INTO `ysk_config` VALUES ('47', '提现次数', 'money_date_count', '3', '2', '7', '', '', '0', '0', '12', '1');

-- ----------------------------
-- Table structure for ysk_coupon_detail
-- ----------------------------
DROP TABLE IF EXISTS `ysk_coupon_detail`;
CREATE TABLE `ysk_coupon_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '玉贝记录表',
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '数额',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` char(20) NOT NULL DEFAULT '',
  `type_name` varchar(20) DEFAULT NULL COMMENT '操作名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `from_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-转入 2-转出',
  `content` varchar(255) DEFAULT NULL COMMENT '说明s',
  `money_record` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值记录',
  `fee` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_coupon_detail
-- ----------------------------
INSERT INTO `ysk_coupon_detail` VALUES ('7', '7.00', '317', 'moneyback', '宏宝提现返还', '1', '1521191544', '1', '宏宝提现返7', '21.00', null);
INSERT INTO `ysk_coupon_detail` VALUES ('8', '7.00', '317', 'moneyback', '宏宝提现返还', '1', '1521191544', '1', '宏宝提现返7', '21.00', null);
INSERT INTO `ysk_coupon_detail` VALUES ('9', '7.00', '317', 'moneyback', '宏宝提现返还', '1', '1521191544', '1', '宏宝提现返7', '21.00', null);
INSERT INTO `ysk_coupon_detail` VALUES ('10', '7.00', '317', 'moneyback', '宏宝提现返还', '1', '1521191544', '1', '宏宝提现返7', '21.00', null);
INSERT INTO `ysk_coupon_detail` VALUES ('11', '7.00', '317', 'moneyback', '提现返还', '1', '1521194872', '1', '提现返7', '28.00', null);
INSERT INTO `ysk_coupon_detail` VALUES ('12', '7.00', '317', 'moneyback', '提现返还', '1', '1521194874', '1', '提现返7', '35.00', null);
INSERT INTO `ysk_coupon_detail` VALUES ('16', '200.00', '317', 'buygood', '购买商品', '1', '1521198185', '2', '购买商品消耗TP20180316182038146', '35.00', null);

-- ----------------------------
-- Table structure for ysk_daydetail
-- ----------------------------
DROP TABLE IF EXISTS `ysk_daydetail`;
CREATE TABLE `ysk_daydetail` (
  `d_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT ' 签到记录',
  `d_uid` int(11) NOT NULL COMMENT '用户id',
  `d_addtime` varchar(20) NOT NULL COMMENT '添加时间',
  `d_content` text NOT NULL COMMENT '说明',
  `d_money` int(11) NOT NULL COMMENT '获得积分',
  PRIMARY KEY (`d_id`),
  KEY `d_uid` (`d_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_daydetail
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_daysign
-- ----------------------------
DROP TABLE IF EXISTS `ysk_daysign`;
CREATE TABLE `ysk_daysign` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '签到记录',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `year` varchar(20) NOT NULL COMMENT '年',
  `moth` varchar(20) NOT NULL COMMENT '月份',
  `day` text NOT NULL COMMENT '签到日期拼接',
  `totalday` int(5) NOT NULL COMMENT '本月签到次数',
  `lian_day` int(5) NOT NULL DEFAULT '0' COMMENT '连续签到天数',
  `savetime` varchar(20) NOT NULL COMMENT '签到时间',
  `total_jifen` int(11) NOT NULL DEFAULT '0' COMMENT '本月获得积分',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_daysign
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_good
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good`;
CREATE TABLE `ysk_good` (
  `good_id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `good_no` varchar(60) NOT NULL DEFAULT '' COMMENT '商品编号',
  `good_name` varchar(120) NOT NULL DEFAULT '' COMMENT '商品名称',
  `good_read` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `brand_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
  `brand_name` varchar(50) DEFAULT NULL COMMENT '品牌名称',
  `good_store` int(11) unsigned NOT NULL DEFAULT '10' COMMENT '库存数量',
  `good_comment` int(11) NOT NULL DEFAULT '0' COMMENT '商品评论数',
  `good_weight` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品重量克为单位',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `good_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '商品关键词',
  `good_content` text COMMENT '商品详细描述',
  `is_real` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否为实物',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架 1-上架 0-下架',
  `ship_fee` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否包邮0否1是',
  `good_sort` smallint(4) unsigned NOT NULL DEFAULT '50' COMMENT '商品排序',
  `is_recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `is_new` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否新品',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否热卖',
  `last_update` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `good_integral` int(8) NOT NULL DEFAULT '0' COMMENT '购买商品赠送积分',
  `good_supplier` varchar(50) DEFAULT NULL COMMENT '供货商',
  `good_sell_num` int(11) NOT NULL DEFAULT '0' COMMENT '商品销量',
  `good_commission` char(10) DEFAULT '0' COMMENT '佣金用于分销分成 百分比',
  `good_cover_img` varchar(255) DEFAULT NULL COMMENT '封面图片',
  `create_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `model_id` int(11) DEFAULT '0' COMMENT '模型ID',
  `seller_id` int(11) DEFAULT '0' COMMENT '商家ID',
  `good_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-平台自己 1-商家产品',
  PRIMARY KEY (`good_id`),
  KEY `goods_sn` (`good_no`),
  KEY `cat_id` (`category_id`),
  KEY `last_update` (`last_update`),
  KEY `brand_id` (`brand_id`),
  KEY `goods_number` (`good_store`),
  KEY `goods_weight` (`good_weight`),
  KEY `sort_order` (`good_sort`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=657 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good
-- ----------------------------
INSERT INTO `ysk_good` VALUES ('651', '136', 'sg45655', '面包机BM-Y665全自动家用预约保温多功能发酵机', '0', '10', null, '100', '0', '10', '800.00', '300.00', '500.00', '面包机', '<p>\r\n	<img src=\"/static/plugin/attached/image/20180315/20180315214720_88068.jpg\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<img src=\"/static/plugin/attached/image/20180315/20180315214731_80996.jpg\" alt=\"\" />\r\n</p>', '1', '1', '0', '100', '1', '1', '1', '0', '0', '大禹', '0', '0', '/uploads/temp/2018/03-15/a83c701a22af7cb44d23e49962791e3c.jpg', '1521121694', '0', '317', '1');
INSERT INTO `ysk_good` VALUES ('652', '818', 'mm23544', '云南彝药三七粉', '0', '40', null, '99', '0', '20', '500.00', '150.00', '200.00', '三七粉', '<img src=\"/static/plugin/attached/image/20180315/20180315215212_92309.jpg\" alt=\"\" />', '1', '1', '0', '0', '1', '1', '1', '0', '0', '平台', '1', '0', '/uploads/temp/2018/03-15/f7b00051f251d8660a44fa0aee27d907.jpg', '1521122033', '6', '0', '0');
INSERT INTO `ysk_good` VALUES ('653', '425', '2121', '玫瑰灵芝焕颜面膜25gx6片/盒*滋养嫩肤/改善暗沉', '0', '41', null, '10', '0', '10', '250.00', '100.00', '200.00', '玫瑰灵，面膜', '<img src=\"/static/plugin/attached/image/20180315/20180315215727_16053.jpg\" alt=\"\" />', '1', '1', '0', '12', '1', '1', '1', '0', '0', '平台', '0', '0', '/uploads/temp/2018/03-15/880233cd373327cefd4c96e7f5f7adeb.jpg', '1521122270', '0', '0', '0');
INSERT INTO `ysk_good` VALUES ('654', '424', '222', '【妍绿婕妮丝】睫毛滋养液8ml/支*化妆品/台湾进口品牌', '0', '41', null, '100', '0', '0', '200.00', '50.00', '100.00', '妍绿婕妮丝', '<img src=\"/static/plugin/attached/image/20180315/20180315220058_11944.png\" alt=\"\" />', '1', '1', '0', '0', '1', '1', '1', '0', '0', '妍绿婕妮丝', '0', '0', '/uploads/temp/2018/03-15/66280128acebd2d5a20382246afedd8c.jpg', '1521122496', '13', '0', '0');
INSERT INTO `ysk_good` VALUES ('655', '338', '1000', '倍爱】孕妇产妇月子睡衣/纯棉家居服套装/哺乳上衣/秋冬', '0', '36', null, '99', '0', '0', '150.00', '90.00', '100.00', '孕妇产妇', '<img src=\"/static/plugin/attached/image/20180315/20180315220435_40242.jpg\" alt=\"\" />', '1', '1', '0', '121', '1', '1', '1', '0', '0', '尽快尽快', '1', '0', '/uploads/temp/2018/03-15/ad804488c9091e5273bdb565807f3f88.jpg', '1521122710', '2', '0', '0');
INSERT INTO `ysk_good` VALUES ('656', '442', 'hh2323', '【维仕蓝】休闲商务背包WB1138-B/R/BK双肩包男女包', '0', '33', null, '100', '0', '2000', '500.00', '200.00', '300.00', '休闲商务背包', '<img src=\"/static/plugin/attached/image/20180315/20180315220756_93691.jpg\" alt=\"\" />', '1', '1', '0', '0', '1', '1', '1', '0', '0', '度假酒店', '0', '0', '/uploads/temp/2018/03-15/a723716e42ac98a16e3f8afe656bfa93.jpg', '1521122896', '0', '0', '0');

-- ----------------------------
-- Table structure for ysk_good_attribute
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good_attribute`;
CREATE TABLE `ysk_good_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '规格表',
  `model_id` int(11) DEFAULT '0' COMMENT '模型类型',
  `attr_name` varchar(55) DEFAULT NULL COMMENT '规格名称',
  `attr_order` int(11) DEFAULT '50' COMMENT '排序',
  `search_index` tinyint(1) DEFAULT '1' COMMENT '是否需要检索：1是，0否',
  `attr_value` text COMMENT '规格项',
  `seller_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`,`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good_attribute
-- ----------------------------
INSERT INTO `ysk_good_attribute` VALUES ('5', '4', '网络', '50', '0', '2G,3G,4G,5G', '0');
INSERT INTO `ysk_good_attribute` VALUES ('6', '4', '内存', '50', '0', '16G,8G,32G,64G,128G', '0');
INSERT INTO `ysk_good_attribute` VALUES ('7', '4', '屏幕', '50', '1', '触屏,文字屏', '0');
INSERT INTO `ysk_good_attribute` VALUES ('16', '4', '颜色', '50', '0', '黑色,白色, 金色,银色,玫瑰金', '0');
INSERT INTO `ysk_good_attribute` VALUES ('27', '2', '尺码', '20', '1', 'S码,M码,L码', '0');
INSERT INTO `ysk_good_attribute` VALUES ('28', '2', '颜色', '10', '1', '红,绿,蓝', '0');
INSERT INTO `ysk_good_attribute` VALUES ('29', '2', '袖子', '5', '1', '长袖,短袖', '0');
INSERT INTO `ysk_good_attribute` VALUES ('30', '6', '内存', '5', '1', '1G,2G,4G', '2035');
INSERT INTO `ysk_good_attribute` VALUES ('31', '9', '大小', '0', '1', '1寸,2寸', '2035');
INSERT INTO `ysk_good_attribute` VALUES ('35', '6', '型号', '0', '1', 'X,M,L', '2035');
INSERT INTO `ysk_good_attribute` VALUES ('36', '13', '350ml', '0', '1', 'ml', '56');
INSERT INTO `ysk_good_attribute` VALUES ('37', '14', '8ml/支', '0', '1', '毫升', '56');
INSERT INTO `ysk_good_attribute` VALUES ('38', '15', '22对/盒', '0', '1', '盒', '56');
INSERT INTO `ysk_good_attribute` VALUES ('39', '16', '750', '0', '1', 'ml', '56');
INSERT INTO `ysk_good_attribute` VALUES ('40', '17', '容量', '0', '1', '250ml', '56');
INSERT INTO `ysk_good_attribute` VALUES ('41', '21', '473ML*3+473ML*3', '0', '1', 'ml', '56');
INSERT INTO `ysk_good_attribute` VALUES ('42', '22', '2L黑啤*1+白啤2L*1', '0', '1', 'L', '56');
INSERT INTO `ysk_good_attribute` VALUES ('43', '23', '30g*2', '0', '1', '盒', '56');
INSERT INTO `ysk_good_attribute` VALUES ('44', '24', '5L', '0', '1', 'L', '56');
INSERT INTO `ysk_good_attribute` VALUES ('45', '25', '5L', '0', '1', '桶', '56');
INSERT INTO `ysk_good_attribute` VALUES ('46', '26', '5L', '0', '1', '桶', '56');
INSERT INTO `ysk_good_attribute` VALUES ('47', '27', '5L', '0', '1', '桶', '56');
INSERT INTO `ysk_good_attribute` VALUES ('48', '28', '1L*2', '0', '1', '盒', '56');
INSERT INTO `ysk_good_attribute` VALUES ('49', '29', '1L', '0', '1', '桶', '56');
INSERT INTO `ysk_good_attribute` VALUES ('50', '30', '1L*2', '0', '1', '盒', '56');
INSERT INTO `ysk_good_attribute` VALUES ('51', '31', '900ML', '0', '1', '桶', '56');

-- ----------------------------
-- Table structure for ysk_good_brand
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good_brand`;
CREATE TABLE `ysk_good_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) NOT NULL COMMENT '品牌名称',
  `brand_order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `brand_content` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `seller_id` int(11) NOT NULL DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good_brand
-- ----------------------------
INSERT INTO `ysk_good_brand` VALUES ('1', '小米', '1', '很好11', '1', '0');
INSERT INTO `ysk_good_brand` VALUES ('2', '华为', '2', '很好很好', '1', '0');
INSERT INTO `ysk_good_brand` VALUES ('4', 'OPPO', '0', '', '1', '0');
INSERT INTO `ysk_good_brand` VALUES ('10', '商家品牌', '0', '', '1', '2035');
INSERT INTO `ysk_good_brand` VALUES ('12', '索尼', '0', '', '1', '4');
INSERT INTO `ysk_good_brand` VALUES ('13', '芝森堂', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('14', '路得萍', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('15', '古树谷', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('16', '中粮', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('17', '珍氏美', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('18', '湘雅采草人', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('19', '挪亚', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('20', '印尼火船咖啡', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('21', '圣尚保罗', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('22', '中粮中茶', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('23', '海纳美鲜', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('24', '生鲜礼包', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('25', '森林果园', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('26', '大联网', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('27', '莓丽e族', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('28', '合利源', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('29', '万福犇', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('30', '茅台醇', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('31', '北欧欧慕', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('32', '卡宴', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('33', '屯河红素软胶囊', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('34', '生活元素', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('35', '朵彩', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('36', '爱依瑞斯', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('37', '一柯', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('38', '天圣嘉禾', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('40', '鼎鑫', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('41', '美德乐', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('42', '天顺源', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('43', '圭则', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('44', '黄金搭档', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('45', '玉莲', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('46', '宜栖', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('47', '倍爱', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('48', '龙桂蜜', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('49', '云南彝药', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('50', '金石滩', '0', '', '1', '56');
INSERT INTO `ysk_good_brand` VALUES ('51', '五芳斋', '0', '', '1', '56');

-- ----------------------------
-- Table structure for ysk_good_category
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good_category`;
CREATE TABLE `ysk_good_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品分类id',
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '商品分类名',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `pid_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '家族图谱',
  `level` tinyint(1) DEFAULT '0' COMMENT '等级',
  `sort_order` int(11) unsigned NOT NULL DEFAULT '50' COMMENT '顺序排序',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `image` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '分类图片',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '是否推荐为热门分类',
  `cat_group` tinyint(1) DEFAULT '0' COMMENT '分类分组默认0',
  `commission_rate` tinyint(1) DEFAULT '0' COMMENT '分佣比例',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=857 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good_category
-- ----------------------------
INSERT INTO `ysk_good_category` VALUES ('1', '电子类', '0', '0-1-', '1', '55', '1', '/uploads/temp/2018/03-15/44d16b5eaf8d19e91c7ed7fc556e4a80.jpg', '1', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('2', '家用电器', '0', '0-2-', '1', '50', '1', '/uploads/temp/2018/03-15/7e3d2e100eebcc5ff43e5699e430e6be.jpg', '1', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('3', '电脑', '0', '0-3-', '1', '50', '1', '/uploads/temp/2018/03-15/25860571a5894da28c7815d4eb4fbb14.jpg', '1', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('4', '家具', '0', '0-4-', '1', '50', '1', '/uploads/temp/2018/03-15/72acbbdae6347ee35f53c8da7bab7cac.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('5', '服装', '0', '0-5-', '1', '50', '1', '/uploads/temp/2018/03-15/8051131a353ead39fbf923d688bf01fd.png', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('6', '个人化妆', '0', '0-6-', '1', '52', '1', '/uploads/temp/2018/03-15/2b97ad2dd49d7859649dae8007cd6f74.png', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('7', '箱包', '0', '0-7-', '1', '50', '1', '/uploads/temp/2018/03-15/1edb627955e484a61ad5a79f85da863b.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('8', '运动户外', '0', '0-8-', '1', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('9', '汽车用品', '0', '0-9-', '1', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('10', '儿童', '0', '0-10-', '1', '51', '1', '/uploads/temp/2018/03-15/a25963927893c98bd0dae8029dfb4d5b.png', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('11', '图书、音像、电子书', '0', '0-11-', '1', '56', '1', '/uploads/temp/2018/03-15/23bac6a15df08d7a9bfa225b2d182eec.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('12', '手机配件', '1', '0-1-12-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('13', '摄影摄像', '1', '0-1-13-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('14', '运营商', '1', '0-1-14-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('15', '数码配件', '1', '0-1-15-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('16', '娱乐影视', '1', '0-1-16-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('17', '电子教育', '1', '0-1-17-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('18', '手机通讯', '1', '0-1-18-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('19', '生活电器', '2', '0-2-19-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('20', '大家电', '2', '0-2-20-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('21', '厨房电器', '2', '0-2-21-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('22', '个护健康', '2', '0-2-22-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('23', '五金', '2', '0-2-23-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('24', '网络产品', '3', '0-3-24-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('25', '办公设备', '3', '0-3-25-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('26', '文具耗材', '3', '0-3-26-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('27', '电脑整机', '3', '0-3-27-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('28', '电脑配件', '3', '0-3-28-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('29', '外设产品', '3', '0-3-29-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('30', '游戏设备', '3', '0-3-30-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('31', '生活日用', '4', '0-4-31-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('32', '家装软饰', '4', '0-4-32-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('33', '宠物生活', '4', '0-4-33-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('34', '厨具', '4', '0-4-34-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('35', '家装建材', '4', '0-4-35-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('36', '家纺', '4', '0-4-36-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('37', '家具', '4', '0-4-37-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('38', '灯具', '4', '0-4-38-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('39', '女装', '5', '0-5-39-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('40', '男装', '5', '0-5-40-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('41', '内衣', '5', '0-5-41-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('42', '身体护肤', '6', '0-6-42-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('43', '口腔护理', '6', '0-6-43-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('44', '女性护理', '6', '0-6-44-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('45', '香水彩妆', '6', '0-6-45-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('46', '清洁用品', '6', '0-6-46-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('47', '面部护肤', '6', '0-6-47-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('48', '洗发护发', '6', '0-6-48-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('49', '精品男包', '7', '0-7-49-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('50', '功能箱包', '7', '0-7-50-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('51', '珠宝', '7', '0-7-51-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('52', '钟表', '7', '0-7-52-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('53', '时尚女鞋', '7', '0-7-53-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('54', '流行男鞋', '7', '0-7-54-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('55', '潮流女包', '7', '0-7-55-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('56', '体育用品', '8', '0-8-56-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('57', '户外鞋服', '8', '0-8-57-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('58', '户外装备', '8', '0-8-58-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('59', '垂钓用品', '8', '0-8-59-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('60', '运动鞋包', '8', '0-8-60-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('61', '游泳用品', '8', '0-8-61-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('62', '运动服饰', '8', '0-8-62-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('63', '健身训练', '8', '0-8-63-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('64', '骑行运动', '8', '0-8-64-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('65', '车载电器', '9', '0-9-65-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('66', '美容清洗', '9', '0-9-66-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('67', '汽车装饰', '9', '0-9-67-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('68', '安全自驾', '9', '0-9-68-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('69', '线下服务', '9', '0-9-69-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('71', '汽车品牌', '9', '0-9-71-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('72', '维修保养', '9', '0-9-72-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('73', '洗护用品', '10', '0-10-73-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('74', '喂养用品', '10', '0-10-74-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('75', '童车童床', '10', '0-10-75-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('76', '安全座椅', '10', '0-10-76-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('77', '寝居服饰', '10', '0-10-77-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('78', '奶粉', '10', '0-10-78-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('79', '妈妈专区', '10', '0-10-79-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('80', '营养辅食', '10', '0-10-80-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('81', '童装童鞋', '10', '0-10-81-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('82', '尿裤湿巾', '10', '0-10-82-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('83', '玩具乐器', '10', '0-10-83-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('84', '音像', '11', '0-11-84-', '2', '40', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('85', '刊/原版', '11', '0-11-85-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('86', '少儿', '11', '0-11-86-', '2', '51', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('88', '教育', '11', '0-11-88-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('90', '文艺', '11', '0-11-90-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('91', '经管励志', '11', '0-11-91-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('92', '人文社科', '11', '0-11-92-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('93', '生活', '11', '0-11-93-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('94', '科技', '11', '0-11-94-', '2', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('95', '纸品湿巾', '46', '0-6-46-95-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('96', '衣物清洁', '46', '0-6-46-96-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('97', '家庭清洁', '46', '0-6-46-97-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('98', '一次性用品', '46', '0-6-46-98-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('99', '驱虫用品', '46', '0-6-46-99-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('100', '电池 电源 充电器', '12', '0-1-12-100-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('101', '数据线,耳机', '12', '0-1-12-101-', '3', '50', '0', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('102', '贴膜,保护套', '12', '0-1-12-102-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('103', '数码相机', '13', '0-1-13-103-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('104', '单反相机', '13', '0-1-13-104-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('105', '摄像机', '13', '0-1-13-105-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('106', '镜头', '13', '0-1-13-106-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('107', '数码相框', '13', '0-1-13-107-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('108', '选号码', '14', '0-1-14-108-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('109', '办套餐', '14', '0-1-14-109-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('110', '合约机', '14', '0-1-14-110-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('111', '中国移动', '14', '0-1-14-111-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('112', '充值卡', '15', '0-1-15-112-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('113', '读卡器', '15', '0-1-15-113-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('114', '支架', '15', '0-1-15-114-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('115', '滤镜', '15', '0-1-15-115-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('116', '音响麦克风', '16', '0-1-16-116-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('117', '耳机/耳麦', '16', '0-1-16-117-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('118', '学生平板', '17', '0-1-17-118-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('119', '点读机', '17', '0-1-17-119-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('120', '电子书', '17', '0-1-17-120-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('121', '电子词典', '17', '0-1-17-121-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('122', '复读机', '17', '0-1-17-122-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('124', '对讲机', '18', '0-1-18-124-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('125', '录音机', '19', '0-2-19-125-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('126', '饮水机', '19', '0-2-19-126-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('127', '烫衣机', '19', '0-2-19-127-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('128', '电风扇', '19', '0-2-19-128-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('129', '电话机', '19', '0-2-19-129-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('130', '电视', '20', '0-2-20-130-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('131', '冰箱', '20', '0-2-20-131-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('132', '空调', '20', '0-2-20-132-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('133', '洗衣机', '20', '0-2-20-133-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('134', '热水器', '20', '0-2-20-134-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('135', '料理/榨汁机', '21', '0-2-21-135-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('136', '电饭锅', '21', '0-2-21-136-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('137', '微波炉', '21', '0-2-21-137-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('138', '豆浆机', '21', '0-2-21-138-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('139', '剃须刀', '22', '0-2-22-139-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('140', '吹风机', '22', '0-2-22-140-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('141', '按摩器', '22', '0-2-22-141-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('142', '足浴盆', '22', '0-2-22-142-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('143', '血压计', '22', '0-2-22-143-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('144', '厨卫五金', '23', '0-2-23-144-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('145', '门铃门锁', '23', '0-2-23-145-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('146', '开关插座', '23', '0-2-23-146-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('147', '电动工具', '23', '0-2-23-147-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('148', '监控安防', '23', '0-2-23-148-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('149', '仪表仪器', '23', '0-2-23-149-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('150', '电线线缆', '23', '0-2-23-150-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('151', '浴霸/排气扇', '23', '0-2-23-151-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('152', '灯具', '23', '0-2-23-152-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('153', '水龙头', '23', '0-2-23-153-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('154', '网络配件', '24', '0-3-24-154-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('155', '路由器', '24', '0-3-24-155-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('156', '网卡', '24', '0-3-24-156-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('157', '交换机', '24', '0-3-24-157-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('158', '网络存储', '24', '0-3-24-158-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('159', '3G/4G/5G上网', '24', '0-3-24-159-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('160', '网络盒子', '24', '0-3-24-160-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('161', '复合机', '25', '0-3-25-161-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('162', '办公家具', '25', '0-3-25-162-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('163', '摄影机', '25', '0-3-25-163-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('164', '碎纸机', '25', '0-3-25-164-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('165', '白板', '25', '0-3-25-165-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('166', '投影配件', '25', '0-3-25-166-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('167', '考勤机', '25', '0-3-25-167-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('168', '多功能一体机', '25', '0-3-25-168-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('169', '收款/POS机', '25', '0-3-25-169-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('170', '打印机', '25', '0-3-25-170-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('171', '会员视频音频', '25', '0-3-25-171-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('172', '传真设备', '25', '0-3-25-172-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('173', '保险柜', '25', '0-3-25-173-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('174', '验钞/点钞机', '25', '0-3-25-174-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('175', '装订/封装机', '25', '0-3-25-175-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('176', '扫描设备', '25', '0-3-25-176-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('177', '安防监控', '25', '0-3-25-177-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('178', '文具管理', '26', '0-3-26-178-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('179', '本册便签', '26', '0-3-26-179-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('180', '硒鼓/墨粉', '26', '0-3-26-180-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('181', '计算器', '26', '0-3-26-181-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('182', '墨盒', '26', '0-3-26-182-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('183', '笔类', '26', '0-3-26-183-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('184', '色带', '26', '0-3-26-184-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('185', '画具画材', '26', '0-3-26-185-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('186', '纸类', '26', '0-3-26-186-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('187', '财会用品', '26', '0-3-26-187-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('188', '办公文具', '26', '0-3-26-188-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('189', '刻录碟片', '26', '0-3-26-189-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('190', '学生文具', '26', '0-3-26-190-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('191', '平板电脑', '27', '0-3-27-191-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('192', '台式机', '27', '0-3-27-192-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('193', '一体机', '27', '0-3-27-193-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('194', '笔记本', '27', '0-3-27-194-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('195', '超极本', '27', '0-3-27-195-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('196', '内存', '28', '0-3-28-196-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('197', '组装电脑', '28', '0-3-28-197-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('198', '机箱', '28', '0-3-28-198-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('199', '电源', '28', '0-3-28-199-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('200', 'CPU', '28', '0-3-28-200-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('201', '显示器', '28', '0-3-28-201-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('202', '主板', '28', '0-3-28-202-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('203', '刻录机/光驱', '28', '0-3-28-203-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('204', '显卡', '28', '0-3-28-204-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('205', '声卡/扩展卡', '28', '0-3-28-205-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('206', '硬盘', '28', '0-3-28-206-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('207', '散热器', '28', '0-3-28-207-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('208', '固态硬盘', '28', '0-3-28-208-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('209', '装机配件', '28', '0-3-28-209-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('210', '线缆', '29', '0-3-29-210-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('211', '鼠标', '29', '0-3-29-211-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('212', '手写板', '29', '0-3-29-212-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('213', '键盘', '29', '0-3-29-213-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('214', '电脑工具', '29', '0-3-29-214-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('215', '网络仪表仪器', '29', '0-3-29-215-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('216', 'UPS', '29', '0-3-29-216-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('217', 'U盘', '29', '0-3-29-217-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('218', '插座', '29', '0-3-29-218-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('219', '移动硬盘', '29', '0-3-29-219-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('220', '鼠标垫', '29', '0-3-29-220-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('221', '摄像头', '29', '0-3-29-221-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('222', '游戏软件', '30', '0-3-30-222-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('223', '游戏周边', '30', '0-3-30-223-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('224', '游戏机', '30', '0-3-30-224-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('225', '游戏耳机', '30', '0-3-30-225-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('226', '手柄方向盘', '30', '0-3-30-226-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('227', '清洁工具', '31', '0-4-31-227-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('228', '收纳用品', '31', '0-4-31-228-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('229', '雨伞雨具', '31', '0-4-31-229-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('230', '浴室用品', '31', '0-4-31-230-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('231', '缝纫/针织用品', '31', '0-4-31-231-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('232', '洗晒/熨烫', '31', '0-4-31-232-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('233', '净化除味', '31', '0-4-31-233-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('234', '节庆饰品', '32', '0-4-32-234-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('235', '手工/十字绣', '32', '0-4-32-235-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('236', '桌布/罩件', '32', '0-4-32-236-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('237', '钟饰', '32', '0-4-32-237-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('238', '地毯地垫', '32', '0-4-32-238-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('239', '装饰摆件', '32', '0-4-32-239-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('240', '沙发垫套/椅垫', '32', '0-4-32-240-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('241', '花瓶花艺', '32', '0-4-32-241-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('242', '帘艺隔断', '32', '0-4-32-242-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('243', '创意家居', '32', '0-4-32-243-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('244', '相框/照片墙', '32', '0-4-32-244-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('245', '保暖防护', '32', '0-4-32-245-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('246', '装饰字画', '32', '0-4-32-246-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('247', '香薰蜡烛', '32', '0-4-32-247-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('248', '墙贴/装饰贴', '32', '0-4-32-248-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('249', '水族用品', '33', '0-4-33-249-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('250', '宠物玩具', '33', '0-4-33-250-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('251', '宠物主粮', '33', '0-4-33-251-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('252', '宠物牵引', '33', '0-4-33-252-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('253', '宠物零食', '33', '0-4-33-253-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('254', '宠物驱虫', '33', '0-4-33-254-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('255', '猫砂/尿布', '33', '0-4-33-255-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('256', '洗护美容', '33', '0-4-33-256-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('257', '家居日用', '33', '0-4-33-257-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('258', '医疗保健', '33', '0-4-33-258-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('259', '出行装备', '33', '0-4-33-259-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('260', '剪刀菜饭', '34', '0-4-34-260-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('261', '厨房配件', '34', '0-4-34-261-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('262', '水具酒具', '34', '0-4-34-262-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('263', '餐具', '34', '0-4-34-263-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('264', '茶具/咖啡具', '34', '0-4-34-264-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('265', '烹饪锅具', '34', '0-4-34-265-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('266', '电工电料', '35', '0-4-35-266-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('267', '墙地材料', '35', '0-4-35-267-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('268', '装饰材料', '35', '0-4-35-268-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('269', '装修服务', '35', '0-4-35-269-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('270', '沐浴花洒', '35', '0-4-35-270-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('271', '灯饰照明', '35', '0-4-35-271-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('272', '开关插座', '35', '0-4-35-272-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('273', '厨房卫浴', '35', '0-4-35-273-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('274', '油漆涂料', '35', '0-4-35-274-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('275', '五金工具', '35', '0-4-35-275-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('276', '龙头', '35', '0-4-35-276-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('277', '床品套件', '36', '0-4-36-277-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('278', '抱枕靠垫', '36', '0-4-36-278-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('279', '被子', '36', '0-4-36-279-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('280', '布艺软饰', '36', '0-4-36-280-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('281', '被芯', '36', '0-4-36-281-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('282', '窗帘窗纱', '36', '0-4-36-282-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('283', '床单被罩', '36', '0-4-36-283-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('284', '蚊帐', '36', '0-4-36-284-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('285', '床垫床褥', '36', '0-4-36-285-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('286', '凉席', '36', '0-4-36-286-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('287', '电地毯', '36', '0-4-36-287-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('288', '毯子', '36', '0-4-36-288-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('289', '毛巾浴巾', '36', '0-4-36-289-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('290', '餐厅家具', '37', '0-4-37-290-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('291', '电脑椅', '37', '0-4-37-291-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('292', '书房家具', '37', '0-4-37-292-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('293', '衣柜', '37', '0-4-37-293-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('294', '储物家具', '37', '0-4-37-294-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('295', '茶几', '37', '0-4-37-295-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('296', '阳台/户外', '37', '0-4-37-296-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('297', '电视柜', '37', '0-4-37-297-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('298', '商业办公', '37', '0-4-37-298-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('299', '餐桌', '37', '0-4-37-299-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('300', '卧室家具', '37', '0-4-37-300-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('301', '床', '37', '0-4-37-301-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('302', '电脑桌', '37', '0-4-37-302-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('303', '客厅家具', '37', '0-4-37-303-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('304', '床垫', '37', '0-4-37-304-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('305', '鞋架/衣帽架', '37', '0-4-37-305-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('306', '客厅家具', '37', '0-4-37-306-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('307', '沙发', '37', '0-4-37-307-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('308', '吸顶灯', '38', '0-4-38-308-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('309', '吊灯', '38', '0-4-38-309-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('310', '筒灯射灯', '38', '0-4-38-310-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('311', '氛围照明', '38', '0-4-38-311-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('312', 'LED灯', '38', '0-4-38-312-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('313', '节能灯', '38', '0-4-38-313-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('314', '落地灯', '38', '0-4-38-314-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('315', '五金电器', '38', '0-4-38-315-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('316', '应急灯/手电', '38', '0-4-38-316-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('317', '台灯', '38', '0-4-38-317-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('318', '装饰灯', '38', '0-4-38-318-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('319', '短外套', '39', '0-5-39-319-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('320', '羊毛衫', '39', '0-5-39-320-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('321', '雪纺衫', '39', '0-5-39-321-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('322', '礼服', '39', '0-5-39-322-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('323', '风衣', '39', '0-5-39-323-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('324', '羊绒衫', '39', '0-5-39-324-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('325', '牛仔裤', '39', '0-5-39-325-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('326', '马甲', '39', '0-5-39-326-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('327', '衬衫', '39', '0-5-39-327-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('328', '半身裙', '39', '0-5-39-328-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('329', '休闲裤', '39', '0-5-39-329-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('330', '吊带/背心', '39', '0-5-39-330-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('331', '羽绒服', '39', '0-5-39-331-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('332', 'T恤', '39', '0-5-39-332-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('333', '大码女装', '39', '0-5-39-333-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('334', '正装裤', '39', '0-5-39-334-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('335', '设计师/潮牌', '39', '0-5-39-335-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('336', '毛呢大衣', '39', '0-5-39-336-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('337', '小西装', '39', '0-5-39-337-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('338', '中老年女装', '39', '0-5-39-338-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('339', '加绒裤', '39', '0-5-39-339-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('340', '棉服', '39', '0-5-39-340-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('341', '打底衫', '39', '0-5-39-341-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('342', '皮草', '39', '0-5-39-342-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('343', '短裤', '39', '0-5-39-343-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('344', '连衣裙', '39', '0-5-39-344-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('345', '打底裤', '39', '0-5-39-345-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('346', '真皮皮衣', '39', '0-5-39-346-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('347', '婚纱', '39', '0-5-39-347-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('348', '卫衣', '39', '0-5-39-348-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('349', '针织衫', '39', '0-5-39-349-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('350', '仿皮皮衣', '39', '0-5-39-350-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('351', '旗袍/唐装', '39', '0-5-39-351-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('352', '羊毛衫', '40', '0-5-40-352-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('353', '休闲裤', '40', '0-5-40-353-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('354', 'POLO衫', '40', '0-5-40-354-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('355', '加绒裤', '40', '0-5-40-355-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('356', '衬衫', '40', '0-5-40-356-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('357', '短裤', '40', '0-5-40-357-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('358', '真皮皮衣', '40', '0-5-40-358-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('359', '毛呢大衣', '40', '0-5-40-359-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('360', '中老年男装', '40', '0-5-40-360-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('361', '卫衣', '40', '0-5-40-361-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('362', '风衣', '40', '0-5-40-362-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('363', '大码男装', '40', '0-5-40-363-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('364', '羽绒服', '40', '0-5-40-364-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('365', 'T恤', '40', '0-5-40-365-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('366', '仿皮皮衣', '40', '0-5-40-366-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('367', '羊绒衫', '40', '0-5-40-367-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('368', '棉服', '40', '0-5-40-368-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('369', '马甲/背心', '40', '0-5-40-369-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('370', '西服', '40', '0-5-40-370-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('371', '设计师/潮牌', '40', '0-5-40-371-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('372', '针织衫', '40', '0-5-40-372-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('373', '西服套装', '40', '0-5-40-373-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('374', '西裤', '40', '0-5-40-374-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('375', '工装', '40', '0-5-40-375-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('376', '夹克', '40', '0-5-40-376-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('377', '牛仔裤', '40', '0-5-40-377-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('378', '卫裤/运动裤', '40', '0-5-40-378-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('379', '唐装/中山装', '40', '0-5-40-379-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('380', '保暖内衣', '41', '0-5-41-380-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('381', '大码内衣', '41', '0-5-41-381-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('382', '吊带/背心', '41', '0-5-41-382-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('383', '秋衣秋裤', '41', '0-5-41-383-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('384', '文胸', '41', '0-5-41-384-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('385', '内衣配件', '41', '0-5-41-385-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('386', '睡衣/家居服', '41', '0-5-41-386-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('387', '男式内裤', '41', '0-5-41-387-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('388', '泳衣', '41', '0-5-41-388-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('389', '打底裤袜', '41', '0-5-41-389-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('390', '女式内裤', '41', '0-5-41-390-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('391', '塑身美体', '41', '0-5-41-391-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('392', '休闲棉袜', '41', '0-5-41-392-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('393', '连裤袜/丝袜', '41', '0-5-41-393-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('394', '美腿袜', '41', '0-5-41-394-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('395', '商务男袜', '41', '0-5-41-395-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('396', '打底衫', '41', '0-5-41-396-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('397', '情趣内衣', '41', '0-5-41-397-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('398', '情侣睡衣', '41', '0-5-41-398-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('399', '少女文胸', '41', '0-5-41-399-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('400', '文胸套装', '41', '0-5-41-400-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('401', '抹胸', '41', '0-5-41-401-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('402', '沐浴', '42', '0-6-42-402-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('403', '润肤', '42', '0-6-42-403-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('404', '颈部', '42', '0-6-42-404-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('405', '手足', '42', '0-6-42-405-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('406', '纤体塑形', '42', '0-6-42-406-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('407', '美胸', '42', '0-6-42-407-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('408', '套装', '42', '0-6-42-408-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('409', '牙膏/牙粉', '43', '0-6-43-409-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('410', '牙刷/牙线', '43', '0-6-43-410-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('411', '漱口水', '43', '0-6-43-411-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('412', '套装', '43', '0-6-43-412-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('413', '卫生巾', '44', '0-6-44-413-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('414', '卫生护垫', '44', '0-6-44-414-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('415', '私密护理', '44', '0-6-44-415-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('416', '脱毛膏', '44', '0-6-44-416-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('417', '唇部', '45', '0-6-45-417-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('418', '美甲', '45', '0-6-45-418-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('419', '美容工具', '45', '0-6-45-419-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('420', '套装', '45', '0-6-45-420-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('421', '香水', '45', '0-6-45-421-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('422', '底妆', '45', '0-6-45-422-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('423', '腮红', '45', '0-6-45-423-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('424', '眼部', '45', '0-6-45-424-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('425', '面膜', '47', '0-6-47-425-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('426', '剃须', '47', '0-6-47-426-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('427', '套装', '47', '0-6-47-427-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('428', '清洁', '47', '0-6-47-428-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('429', '护肤', '47', '0-6-47-429-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('430', '套装', '48', '0-6-48-430-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('431', '洗发', '48', '0-6-48-431-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('432', '护发', '48', '0-6-48-432-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('433', '染发', '48', '0-6-48-433-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('434', '造型', '48', '0-6-48-434-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('435', '假发', '48', '0-6-48-435-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('436', '商务公文包', '49', '0-7-49-436-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('437', '单肩/斜挎包', '49', '0-7-49-437-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('438', '男士手包', '49', '0-7-49-438-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('439', '双肩包', '49', '0-7-49-439-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('440', '钱包/卡包', '49', '0-7-49-440-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('441', '钥匙包', '49', '0-7-49-441-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('442', '旅行包', '50', '0-7-50-442-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('443', '妈咪包', '50', '0-7-50-443-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('444', '电脑包', '50', '0-7-50-444-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('445', '休闲运动包', '50', '0-7-50-445-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('446', '相机包', '50', '0-7-50-446-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('447', '腰包/胸包', '50', '0-7-50-447-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('448', '登山包', '50', '0-7-50-448-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('449', '旅行配件', '50', '0-7-50-449-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('450', '拉杆箱/拉杆包', '50', '0-7-50-450-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('451', '书包', '50', '0-7-50-451-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('452', '彩宝', '51', '0-7-51-452-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('453', '时尚饰品', '51', '0-7-51-453-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('454', '铂金', '51', '0-7-51-454-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('455', '钻石', '51', '0-7-51-455-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('456', '天然木饰', '51', '0-7-51-456-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('457', '翡翠玉石', '51', '0-7-51-457-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('458', '珍珠', '51', '0-7-51-458-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('459', '纯金K金饰品', '51', '0-7-51-459-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('460', '金银投资', '51', '0-7-51-460-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('461', '银饰', '51', '0-7-51-461-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('462', '水晶玛瑙', '51', '0-7-51-462-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('463', '座钟挂钟', '52', '0-7-52-463-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('464', '男表', '52', '0-7-52-464-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('465', '女表', '52', '0-7-52-465-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('466', '儿童表', '52', '0-7-52-466-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('467', '智能手表', '52', '0-7-52-467-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('468', '女靴', '53', '0-7-53-468-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('469', '布鞋/绣花鞋', '53', '0-7-53-469-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('470', '鱼嘴鞋', '53', '0-7-53-470-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('471', '雪地靴', '53', '0-7-53-471-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('472', '凉鞋', '53', '0-7-53-472-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('473', '雨鞋/雨靴', '53', '0-7-53-473-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('474', '单鞋', '53', '0-7-53-474-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('475', '拖鞋/人字拖', '53', '0-7-53-475-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('476', '鞋配件', '53', '0-7-53-476-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('477', '高跟鞋', '53', '0-7-53-477-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('478', '马丁靴', '53', '0-7-53-478-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('479', '帆布鞋', '53', '0-7-53-479-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('480', '休闲鞋', '53', '0-7-53-480-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('481', '妈妈鞋', '53', '0-7-53-481-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('482', '踝靴', '53', '0-7-53-482-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('483', '防水台', '53', '0-7-53-483-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('484', '内增高', '53', '0-7-53-484-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('485', '松糕鞋', '53', '0-7-53-485-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('486', '坡跟鞋', '53', '0-7-53-486-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('487', '增高鞋', '54', '0-7-54-487-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('488', '鞋配件', '54', '0-7-54-488-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('489', '拖鞋/人字拖', '54', '0-7-54-489-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('490', '凉鞋/沙滩鞋', '54', '0-7-54-490-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('491', '休闲鞋', '54', '0-7-54-491-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('492', '雨鞋/雨靴', '54', '0-7-54-492-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('493', '商务休闲鞋', '54', '0-7-54-493-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('494', '定制鞋', '54', '0-7-54-494-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('495', '正装鞋', '54', '0-7-54-495-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('496', '男靴', '54', '0-7-54-496-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('497', '帆布鞋', '54', '0-7-54-497-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('498', '传统布鞋', '54', '0-7-54-498-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('499', '工装鞋', '54', '0-7-54-499-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('500', '功能鞋', '54', '0-7-54-500-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('501', '钥匙包', '55', '0-7-55-501-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('502', '单肩包', '55', '0-7-55-502-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('503', '手提包', '55', '0-7-55-503-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('504', '斜挎包', '55', '0-7-55-504-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('505', '双肩包', '55', '0-7-55-505-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('506', '钱包', '55', '0-7-55-506-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('507', '手拿包/晚宴包', '55', '0-7-55-507-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('508', '卡包/零钱包', '55', '0-7-55-508-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('509', '轮滑滑板', '56', '0-8-56-509-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('510', '网球', '56', '0-8-56-510-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('511', '高尔夫', '56', '0-8-56-511-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('512', '台球', '56', '0-8-56-512-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('513', '乒乓球', '56', '0-8-56-513-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('514', '排球', '56', '0-8-56-514-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('515', '羽毛球', '56', '0-8-56-515-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('516', '棋牌麻将', '56', '0-8-56-516-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('517', '篮球', '56', '0-8-56-517-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('518', '其它', '56', '0-8-56-518-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('519', '足球', '56', '0-8-56-519-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('520', '速干衣裤', '57', '0-8-57-520-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('521', '功能内衣', '57', '0-8-57-521-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('522', '溯溪鞋', '57', '0-8-57-522-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('523', '滑雪服', '57', '0-8-57-523-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('524', '军迷服饰', '57', '0-8-57-524-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('525', '沙滩/凉拖', '57', '0-8-57-525-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('526', '羽绒服/棉服', '57', '0-8-57-526-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('527', '登山鞋', '57', '0-8-57-527-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('528', '户外袜', '57', '0-8-57-528-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('529', '休闲衣裤', '57', '0-8-57-529-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('530', '徒步鞋', '57', '0-8-57-530-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('531', '抓绒衣裤', '57', '0-8-57-531-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('532', '越野跑鞋', '57', '0-8-57-532-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('533', '软壳衣裤', '57', '0-8-57-533-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('534', '休闲鞋', '57', '0-8-57-534-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('535', 'T恤', '57', '0-8-57-535-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('536', '雪地靴', '57', '0-8-57-536-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('537', '冲锋衣裤', '57', '0-8-57-537-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('538', '户外风衣', '57', '0-8-57-538-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('539', '工装鞋', '57', '0-8-57-539-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('540', '野餐烧烤', '58', '0-8-58-540-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('541', '滑雪装备', '58', '0-8-58-541-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('542', '便携桌椅床', '58', '0-8-58-542-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('543', '极限户外', '58', '0-8-58-543-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('544', '户外工具', '58', '0-8-58-544-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('545', '冲浪潜水', '58', '0-8-58-545-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('546', '背包', '58', '0-8-58-546-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('547', '望远镜', '58', '0-8-58-547-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('548', '户外配饰', '58', '0-8-58-548-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('549', '帐篷/垫子', '58', '0-8-58-549-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('550', '户外仪表', '58', '0-8-58-550-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('551', '睡袋/吊床', '58', '0-8-58-551-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('552', '旅游用品', '58', '0-8-58-552-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('553', '登山攀岩', '58', '0-8-58-553-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('554', '军迷用品', '58', '0-8-58-554-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('555', '户外照明', '58', '0-8-58-555-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('556', '救援装备', '58', '0-8-58-556-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('557', '钓箱鱼包', '59', '0-8-59-557-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('558', '其它', '59', '0-8-59-558-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('559', '鱼竿鱼线', '59', '0-8-59-559-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('560', '浮漂鱼饵', '59', '0-8-59-560-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('561', '钓鱼桌椅', '59', '0-8-59-561-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('562', '钓鱼配件', '59', '0-8-59-562-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('563', '帆布鞋', '60', '0-8-60-563-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('564', '乒羽网鞋', '60', '0-8-60-564-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('565', '跑步鞋', '60', '0-8-60-565-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('566', '训练鞋', '60', '0-8-60-566-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('567', '休闲鞋', '60', '0-8-60-567-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('568', '专项运动鞋', '60', '0-8-60-568-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('569', '篮球鞋', '60', '0-8-60-569-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('570', '拖鞋', '60', '0-8-60-570-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('571', '板鞋', '60', '0-8-60-571-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('572', '运动包', '60', '0-8-60-572-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('573', '足球鞋', '60', '0-8-60-573-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('574', '其它', '61', '0-8-61-574-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('575', '泳镜', '61', '0-8-61-575-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('576', '泳帽', '61', '0-8-61-576-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('577', '游泳包防水包', '61', '0-8-61-577-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('578', '男士泳衣', '61', '0-8-61-578-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('579', '女士泳衣', '61', '0-8-61-579-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('580', '比基尼', '61', '0-8-61-580-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('581', 'T恤', '62', '0-8-62-581-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('582', '棉服', '62', '0-8-62-582-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('583', '运动裤', '62', '0-8-62-583-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('584', '夹克/风衣', '62', '0-8-62-584-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('585', '运动配饰', '62', '0-8-62-585-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('586', '运动背心', '62', '0-8-62-586-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('587', '乒羽网服', '62', '0-8-62-587-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('588', '运动套装', '62', '0-8-62-588-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('589', '训练服', '62', '0-8-62-589-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('590', '羽绒服', '62', '0-8-62-590-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('591', '毛衫/线衫', '62', '0-8-62-591-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('592', '卫衣/套头衫', '62', '0-8-62-592-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('593', '瑜伽舞蹈', '63', '0-8-63-593-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('594', '跑步机', '63', '0-8-63-594-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('595', '武术搏击', '63', '0-8-63-595-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('596', '健身车/动感单车', '63', '0-8-63-596-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('597', '综合训练器', '63', '0-8-63-597-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('598', '哑铃', '63', '0-8-63-598-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('599', '其他大型器械', '63', '0-8-63-599-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('600', '仰卧板/收腹机', '63', '0-8-63-600-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('601', '其他中小型器材', '63', '0-8-63-601-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('602', '甩脂机', '63', '0-8-63-602-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('603', '踏步机', '63', '0-8-63-603-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('604', '运动护具', '63', '0-8-63-604-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('605', '平衡车', '64', '0-8-64-605-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('606', '其他整车', '64', '0-8-64-606-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('607', '骑行装备', '64', '0-8-64-607-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('608', '骑行服', '64', '0-8-64-608-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('609', '山地车/公路车', '64', '0-8-64-609-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('610', '折叠车', '64', '0-8-64-610-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('611', '电动车', '64', '0-8-64-611-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('612', '电源', '65', '0-9-65-612-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('613', '导航仪', '65', '0-9-65-613-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('614', '智能驾驶', '65', '0-9-65-614-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('615', '安全预警仪', '65', '0-9-65-615-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('616', '车载电台', '65', '0-9-65-616-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('617', '行车记录仪', '65', '0-9-65-617-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('618', '吸尘器', '65', '0-9-65-618-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('619', '倒车雷达', '65', '0-9-65-619-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('620', '冰箱', '65', '0-9-65-620-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('621', '蓝牙设备', '65', '0-9-65-621-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('622', '时尚影音', '65', '0-9-65-622-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('623', '净化器', '65', '0-9-65-623-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('624', '清洁剂', '66', '0-9-66-624-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('625', '洗车工具', '66', '0-9-66-625-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('626', '洗车配件', '66', '0-9-66-626-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('627', '车蜡', '66', '0-9-66-627-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('628', '补漆笔', '66', '0-9-66-628-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('629', '玻璃水', '66', '0-9-66-629-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('630', '香水', '67', '0-9-67-630-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('631', '空气净化', '67', '0-9-67-631-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('632', '车内饰品', '67', '0-9-67-632-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('633', '脚垫', '67', '0-9-67-633-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('634', '功能小件', '67', '0-9-67-634-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('635', '座垫', '67', '0-9-67-635-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('636', '车身装饰件', '67', '0-9-67-636-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('637', '座套', '67', '0-9-67-637-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('638', '车衣', '67', '0-9-67-638-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('639', '后备箱垫', '67', '0-9-67-639-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('640', '头枕腰靠', '67', '0-9-67-640-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('641', '充气泵', '68', '0-9-68-641-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('642', '防盗设备', '68', '0-9-68-642-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('643', '应急救援', '68', '0-9-68-643-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('644', '保温箱', '68', '0-9-68-644-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('645', '储物箱', '68', '0-9-68-645-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('646', '自驾野营', '68', '0-9-68-646-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('647', '安全座椅', '68', '0-9-68-647-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('648', '摩托车装备', '68', '0-9-68-648-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('649', '胎压监测', '68', '0-9-68-649-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('650', '功能升级服务', '69', '0-9-69-650-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('651', '保养维修服务', '69', '0-9-69-651-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('652', '清洗美容服务', '69', '0-9-69-652-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('662', '上海大众', '71', '0-9-71-662-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('663', '斯柯达', '71', '0-9-71-663-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('664', '东风雪铁龙', '71', '0-9-71-664-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('665', '一汽奔腾', '71', '0-9-71-665-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('666', '北汽新能源', '71', '0-9-71-666-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('667', '陆风', '71', '0-9-71-667-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('668', '海马', '71', '0-9-71-668-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('669', '润滑油', '72', '0-9-72-669-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('670', '轮胎', '72', '0-9-72-670-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('671', '改装配件', '72', '0-9-72-671-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('672', '添加剂', '72', '0-9-72-672-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('673', '轮毂', '72', '0-9-72-673-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('674', '防冻液', '72', '0-9-72-674-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('675', '刹车片/盘', '72', '0-9-72-675-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('676', '滤清器', '72', '0-9-72-676-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('677', '维修配件', '72', '0-9-72-677-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('678', '火花塞', '72', '0-9-72-678-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('679', '蓄电池', '72', '0-9-72-679-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('680', '雨刷', '72', '0-9-72-680-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('681', '底盘装甲/护板', '72', '0-9-72-681-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('682', '车灯', '72', '0-9-72-682-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('683', '贴膜', '72', '0-9-72-683-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('684', '后视镜', '72', '0-9-72-684-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('685', '汽修工具', '72', '0-9-72-685-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('686', '宝宝护肤', '73', '0-10-73-686-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('687', '宝宝洗浴', '73', '0-10-73-687-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('688', '理发器', '73', '0-10-73-688-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('689', '洗衣液/皂', '73', '0-10-73-689-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('690', '奶瓶清洗', '73', '0-10-73-690-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('691', '日常护理', '73', '0-10-73-691-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('692', '座便器', '73', '0-10-73-692-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('693', '驱蚊防蚊', '73', '0-10-73-693-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('694', '奶瓶奶嘴', '74', '0-10-74-694-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('695', '吸奶器', '74', '0-10-74-695-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('696', '牙胶安抚', '74', '0-10-74-696-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('697', '暖奶消毒', '74', '0-10-74-697-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('698', '辅食料理机', '74', '0-10-74-698-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('699', '碗盘叉勺', '74', '0-10-74-699-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('700', '水壶/水杯', '74', '0-10-74-700-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('701', '婴儿推车', '75', '0-10-75-701-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('702', '餐椅摇椅', '75', '0-10-75-702-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('703', '学步车', '75', '0-10-75-703-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('704', '三轮车', '75', '0-10-75-704-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('705', '自行车', '75', '0-10-75-705-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('706', '扭扭车', '75', '0-10-75-706-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('707', '滑板车', '75', '0-10-75-707-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('708', '婴儿床', '75', '0-10-75-708-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('709', '电动车', '75', '0-10-75-709-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('710', '提篮式', '76', '0-10-76-710-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('711', '安全座椅', '76', '0-10-76-711-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('712', '增高垫', '76', '0-10-76-712-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('713', '安全防护', '77', '0-10-77-713-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('714', '婴儿外出服', '77', '0-10-77-714-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('715', '婴儿内衣', '77', '0-10-77-715-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('716', '婴儿礼盒', '77', '0-10-77-716-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('717', '婴儿鞋帽袜', '77', '0-10-77-717-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('718', '家居床品', '77', '0-10-77-718-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('719', '婴幼奶粉', '78', '0-10-78-719-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('720', '成人奶粉', '78', '0-10-78-720-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('721', '待产/新生', '79', '0-10-79-721-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('722', '孕妇装', '79', '0-10-79-722-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('723', '孕期营养', '79', '0-10-79-723-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('724', '防辐射服', '79', '0-10-79-724-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('725', '妈咪包/背婴带', '79', '0-10-79-725-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('726', '产后塑身', '79', '0-10-79-726-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('727', '孕妈美容', '79', '0-10-79-727-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('728', '文胸/内裤', '79', '0-10-79-728-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('729', '月子装', '79', '0-10-79-729-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('730', '米粉/菜粉', '80', '0-10-80-730-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('731', '果泥/果汁', '80', '0-10-80-731-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('732', '面条/粥', '80', '0-10-80-732-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('733', '宝宝零食', '80', '0-10-80-733-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('734', 'DHA', '80', '0-10-80-734-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('735', '钙铁锌/维生素', '80', '0-10-80-735-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('736', '益生菌/初乳', '80', '0-10-80-736-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('737', '清火/开胃', '80', '0-10-80-737-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('738', '配饰', '81', '0-10-81-738-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('739', '亲子装', '81', '0-10-81-739-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('740', '羽绒服/棉服', '81', '0-10-81-740-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('741', '套装', '81', '0-10-81-741-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('742', '运动服', '81', '0-10-81-742-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('743', '上衣', '81', '0-10-81-743-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('744', '靴子', '81', '0-10-81-744-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('745', '运动鞋', '81', '0-10-81-745-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('746', '演出服', '81', '0-10-81-746-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('747', '裙子', '81', '0-10-81-747-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('748', '裤子', '81', '0-10-81-748-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('749', '功能鞋', '81', '0-10-81-749-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('750', '内衣', '81', '0-10-81-750-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('751', '凉鞋', '81', '0-10-81-751-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('752', '皮鞋/帆布鞋', '81', '0-10-81-752-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('753', '婴儿尿裤', '82', '0-10-82-753-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('754', '拉拉裤', '82', '0-10-82-754-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('755', '成人尿裤', '82', '0-10-82-755-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('756', '湿巾', '82', '0-10-82-756-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('757', '健身玩具', '83', '0-10-83-757-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('758', '适用年龄', '83', '0-10-83-758-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('759', '娃娃玩具', '83', '0-10-83-759-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('760', '遥控/电动', '83', '0-10-83-760-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('761', 'DIY玩具', '83', '0-10-83-761-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('762', '益智玩具', '83', '0-10-83-762-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('763', '创意减压', '83', '0-10-83-763-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('764', '积木拼插', '83', '0-10-83-764-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('765', '乐器相关', '83', '0-10-83-765-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('766', '动漫玩具', '83', '0-10-83-766-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('767', '毛绒布艺', '83', '0-10-83-767-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('768', '模型玩具', '83', '0-10-83-768-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('769', '游戏', '84', '0-11-84-769-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('770', '影视/动漫周边', '84', '0-11-84-770-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('771', '音乐', '84', '0-11-84-771-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('772', '影视', '84', '0-11-84-772-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('773', '教育音像', '84', '0-11-84-773-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('774', '港台图书', '85', '0-11-85-774-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('775', '杂志/期刊', '85', '0-11-85-775-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('776', '英文原版书', '85', '0-11-85-776-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('777', '科普', '86', '0-11-86-777-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('778', '幼儿启蒙', '86', '0-11-86-778-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('779', '0-2岁', '86', '0-11-86-779-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('780', '手工游戏', '86', '0-11-86-780-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('781', '3-6岁', '86', '0-11-86-781-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('782', '智力开发', '86', '0-11-86-782-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('783', '7-10岁', '86', '0-11-86-783-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('784', '11-14岁', '86', '0-11-86-784-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('785', '儿童文学', '86', '0-11-86-785-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('786', '绘本', '86', '0-11-86-786-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('796', '字典词典', '88', '0-11-88-796-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('797', '教材', '88', '0-11-88-797-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('798', '中小学教辅', '88', '0-11-88-798-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('799', '考试', '88', '0-11-88-799-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('800', '外语学习', '88', '0-11-88-800-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('801', '通俗流行', '89', '0-11-89-801-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('802', '古典音乐', '89', '0-11-89-802-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('803', '摇滚说唱', '89', '0-11-89-803-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('804', '爵士蓝调', '89', '0-11-89-804-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('805', '乡村民谣', '89', '0-11-89-805-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('806', '有声读物', '89', '0-11-89-806-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('807', '小说', '90', '0-11-90-807-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('808', '文学', '90', '0-11-90-808-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('809', '青春文学', '90', '0-11-90-809-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('810', '传记', '90', '0-11-90-810-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('811', '动漫', '90', '0-11-90-811-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('812', '艺术', '90', '0-11-90-812-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('813', '摄影', '90', '0-11-90-813-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('814', '管理', '91', '0-11-91-814-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('815', '金融与投资', '91', '0-11-91-815-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('816', '经济', '91', '0-11-91-816-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('817', '励志与成功', '91', '0-11-91-817-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('818', '哲学/宗教', '92', '0-11-92-818-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('819', '社会科学', '92', '0-11-92-819-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('820', '法律', '92', '0-11-92-820-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('821', '文化', '92', '0-11-92-821-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('822', '历史', '92', '0-11-92-822-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('823', '心理学', '92', '0-11-92-823-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('824', '政治/军事', '92', '0-11-92-824-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('825', '国学/古籍', '92', '0-11-92-825-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('826', '美食', '93', '0-11-93-826-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('827', '时尚美妆', '93', '0-11-93-827-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('828', '家居', '93', '0-11-93-828-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('829', '手工DIY', '93', '0-11-93-829-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('830', '家教与育儿', '93', '0-11-93-830-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('831', '两性', '93', '0-11-93-831-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('832', '孕产', '93', '0-11-93-832-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('833', '体育', '93', '0-11-93-833-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('834', '健身保健', '93', '0-11-93-834-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('835', '旅游/地图', '93', '0-11-93-835-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('836', '建筑', '94', '0-11-94-836-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('837', '工业技术', '94', '0-11-94-837-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('838', '电子/通信', '94', '0-11-94-838-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('839', '医学', '94', '0-11-94-839-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('840', '科学与自然', '94', '0-11-94-840-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('841', '农林', '94', '0-11-94-841-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('842', '计算机与互联网', '94', '0-11-94-842-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('843', '科普', '94', '0-11-94-843-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('852', '手机', '18', '0-1-18-852-', '3', '50', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('855', '美食', '0', '0-855-', '1', '49', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');
INSERT INTO `ysk_good_category` VALUES ('856', '茶', '855', '0-855-856-', '2', '0', '1', '/uploads/temp/2018/03-15/4f437967c54039f580f1e44270248fa0.jpg', '0', '0', '0');

-- ----------------------------
-- Table structure for ysk_good_collect
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good_collect`;
CREATE TABLE `ysk_good_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `good_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `good_id` (`good_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good_collect
-- ----------------------------
INSERT INTO `ysk_good_collect` VALUES ('1', '317', '655', '1521198602');

-- ----------------------------
-- Table structure for ysk_good_comment
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good_comment`;
CREATE TABLE `ysk_good_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '评论用户id',
  `username` varchar(20) DEFAULT NULL COMMENT '评论用户名',
  `mobile` varchar(20) DEFAULT NULL COMMENT '评论手机',
  `good_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `good_name` varchar(255) DEFAULT NULL,
  `good_item` varchar(255) DEFAULT NULL COMMENT '商品规格',
  `star_ability` int(2) NOT NULL DEFAULT '0' COMMENT '服务能力星级',
  `star_attitude` int(2) NOT NULL DEFAULT '0' COMMENT '服务态度星级',
  `star_price` int(2) NOT NULL DEFAULT '0' COMMENT '价格合理',
  `content` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '0 差评   1 中评 2 好评',
  `seller_id` int(11) NOT NULL COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`order_id`,`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good_comment
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_good_img
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good_img`;
CREATE TABLE `ysk_good_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL DEFAULT '0',
  `img_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `good_id` (`good_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1008 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good_img
-- ----------------------------
INSERT INTO `ysk_good_img` VALUES ('997', '651', '/uploads/temp/2018/03-15/eaf158ec41d1d6cdc0a0e41d89d228df.jpg');
INSERT INTO `ysk_good_img` VALUES ('998', '651', '/uploads/temp/2018/03-15/16a6e6fc17026b9193cefd4acc43ee54.jpg');
INSERT INTO `ysk_good_img` VALUES ('999', '652', '/uploads/temp/2018/03-15/aae4bc246322dc2f3d1948322062556b.jpg');
INSERT INTO `ysk_good_img` VALUES ('1000', '652', '/uploads/temp/2018/03-15/8a8686e02bbaed3e3c091823c03583ad.jpg');
INSERT INTO `ysk_good_img` VALUES ('1001', '653', '/uploads/temp/2018/03-15/dbacc1ca124857d24835286b94156cca.jpg');
INSERT INTO `ysk_good_img` VALUES ('1002', '654', '/uploads/temp/2018/03-15/df0b48bd862fb1508408d839ddbe59c0.jpg');
INSERT INTO `ysk_good_img` VALUES ('1003', '654', '/uploads/temp/2018/03-15/025e70638240eb1a5b58b3d846192c69.jpg');
INSERT INTO `ysk_good_img` VALUES ('1004', '655', '/uploads/temp/2018/03-15/555279b81c0b3c31d0ed083a40c7e5d3.jpg');
INSERT INTO `ysk_good_img` VALUES ('1005', '655', '/uploads/temp/2018/03-15/0b9a021cf14f55325b0219b19b752330.jpg');
INSERT INTO `ysk_good_img` VALUES ('1006', '656', '/uploads/temp/2018/03-15/9cb4413a2642cfbed0fdecc87a89571a.jpg');
INSERT INTO `ysk_good_img` VALUES ('1007', '656', '/uploads/temp/2018/03-15/12dc81642049ac9931ddd8d1b6e421ed.jpg');

-- ----------------------------
-- Table structure for ysk_good_model
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good_model`;
CREATE TABLE `ysk_good_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(50) NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good_model
-- ----------------------------
INSERT INTO `ysk_good_model` VALUES ('2', '衣服', '0');
INSERT INTO `ysk_good_model` VALUES ('4', '手机', '0');
INSERT INTO `ysk_good_model` VALUES ('5', '化妆品', '0');
INSERT INTO `ysk_good_model` VALUES ('6', '相机', '2035');
INSERT INTO `ysk_good_model` VALUES ('9', '玩具', '2035');
INSERT INTO `ysk_good_model` VALUES ('12', '尺寸', '4');
INSERT INTO `ysk_good_model` VALUES ('13', '漱口水', '56');
INSERT INTO `ysk_good_model` VALUES ('14', '妍绿婕妮丝', '56');
INSERT INTO `ysk_good_model` VALUES ('15', '湘雅采草人', '56');
INSERT INTO `ysk_good_model` VALUES ('16', '酒', '56');
INSERT INTO `ysk_good_model` VALUES ('17', '【挪亚】鳕鱼肝油液', '56');
INSERT INTO `ysk_good_model` VALUES ('18', '肉', '56');
INSERT INTO `ysk_good_model` VALUES ('19', '坚果', '56');
INSERT INTO `ysk_good_model` VALUES ('20', '茶', '56');
INSERT INTO `ysk_good_model` VALUES ('21', '凯撒大帝', '56');
INSERT INTO `ysk_good_model` VALUES ('22', '莱茵小镇', '56');
INSERT INTO `ysk_good_model` VALUES ('23', '屯河红素软胶囊', '56');
INSERT INTO `ysk_good_model` VALUES ('24', '柏林之夜', '56');
INSERT INTO `ysk_good_model` VALUES ('25', '慕尼黑凯撒', '56');
INSERT INTO `ysk_good_model` VALUES ('26', '皇家凯撒1816', '56');
INSERT INTO `ysk_good_model` VALUES ('27', '皇家凯撒1810', '56');
INSERT INTO `ysk_good_model` VALUES ('28', '新疆亚麻籽油', '56');
INSERT INTO `ysk_good_model` VALUES ('29', '悦润亚麻籽油', '56');
INSERT INTO `ysk_good_model` VALUES ('30', '悦润纯红花籽油礼盒装', '56');
INSERT INTO `ysk_good_model` VALUES ('31', '塔原红花籽油', '56');
INSERT INTO `ysk_good_model` VALUES ('32', '母婴用品', '56');

-- ----------------------------
-- Table structure for ysk_good_price
-- ----------------------------
DROP TABLE IF EXISTS `ysk_good_price`;
CREATE TABLE `ysk_good_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `good_attr_name` varchar(50) NOT NULL COMMENT '规格名称',
  `good_attr_value` text COMMENT '规格项',
  `good_arr_order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `price` decimal(13,2) NOT NULL DEFAULT '0.00',
  `store` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `good_attr_text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `good_id` (`good_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_good_price
-- ----------------------------
INSERT INTO `ysk_good_price` VALUES ('1', '652', '', '1G,M', '0', '200.00', '99', '内存:1G,型号:M');
INSERT INTO `ysk_good_price` VALUES ('2', '652', '', '1G,L', '0', '190.00', '100', '内存:1G,型号:L');
INSERT INTO `ysk_good_price` VALUES ('3', '655', '', 'S码', '0', '100.00', '99', '尺码:S码');
INSERT INTO `ysk_good_price` VALUES ('4', '655', '', 'M码', '0', '110.00', '100', '尺码:M码');
INSERT INTO `ysk_good_price` VALUES ('5', '655', '', 'L码', '0', '130.00', '100', '尺码:L码');

-- ----------------------------
-- Table structure for ysk_group
-- ----------------------------
DROP TABLE IF EXISTS `ysk_group`;
CREATE TABLE `ysk_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级部门ID',
  `title` varchar(31) NOT NULL DEFAULT '' COMMENT '部门名称',
  `icon` varchar(31) NOT NULL DEFAULT '' COMMENT '图标',
  `menu_auth` text NOT NULL COMMENT '权限列表',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  `auth_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='部门信息表';

-- ----------------------------
-- Records of ysk_group
-- ----------------------------
INSERT INTO `ysk_group` VALUES ('1', '0', '超级管理员', '', '', '1426881003', '1427552428', '0', '1', '1');
INSERT INTO `ysk_group` VALUES ('2', '0', '普通用户', '', '1,3,4,5,7,8,316,318,10,11,315', '1498324367', '1509947242', '0', '1', '2');
INSERT INTO `ysk_group` VALUES ('7', '0', '客服专员', '', '1,7,8,9,383,316,318,10,11,315', '1505124740', '1520230288', '2', '1', '0');
INSERT INTO `ysk_group` VALUES ('9', '0', '审核专员', '', '1,3,4,5,6,341,7,8,9,359,360,363,369,370,374,316,318,382,322,346,323,356,357,40,41,10,11,315,343,344,345,375,377,361,362,364,365,366,367,368,371,372,381,378,379,380', '1517717533', '1517739382', '0', '-1', '0');
INSERT INTO `ysk_group` VALUES ('10', '0', '审核专员', '', '1,3,4,5,6,341,7,8,9,359,360,363,369,370,374,316,318,382,322,346,323,356,357,40,41,10,11,315,343,344,345,375,377,361,362,364,365,366,367,368,371,372,381,378,379,380', '1517742687', '0', '0', '1', '0');

-- ----------------------------
-- Table structure for ysk_industry
-- ----------------------------
DROP TABLE IF EXISTS `ysk_industry`;
CREATE TABLE `ysk_industry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `path` text NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `level` int(1) NOT NULL,
  `category_id` text NOT NULL COMMENT '商品分类ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_industry
-- ----------------------------
INSERT INTO `ysk_industry` VALUES ('1', '0', '美食', '0,1,', '1', '1', '1', '');
INSERT INTO `ysk_industry` VALUES ('2', '0', '酒店', '0,2,', '1', '2', '1', '5,39,40,41,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,341,342,343,344,345,346,347,348,349,350,351,352,353,354,355,356,357,358,359,360,361,362,363,364,365,366,367,368,369,370,371,372,373,374,375,376,377,378,379,380,381,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401');
INSERT INTO `ysk_industry` VALUES ('3', '0', '休闲娱乐', '0,3,', '1', '3', '1', '');
INSERT INTO `ysk_industry` VALUES ('4', '0', '生活服务', '0,4,', '1', '4', '1', '2,19,20,21,22,23,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153');
INSERT INTO `ysk_industry` VALUES ('5', '0', '百货超市', '0,5,', '1', '0', '1', '');
INSERT INTO `ysk_industry` VALUES ('6', '0', '丽人', '0,6,', '1', '0', '1', '');
INSERT INTO `ysk_industry` VALUES ('7', '0', '旅游', '0,7', '1', '0', '1', '');
INSERT INTO `ysk_industry` VALUES ('8', '0', '汽车', '0,8,', '1', '0', '1', '');
INSERT INTO `ysk_industry` VALUES ('9', '0', '房产', '0,9,', '1', '0', '1', '');
INSERT INTO `ysk_industry` VALUES ('10', '0', '其他', '0,10,', '1', '0', '1', '');

-- ----------------------------
-- Table structure for ysk_integral_detail
-- ----------------------------
DROP TABLE IF EXISTS `ysk_integral_detail`;
CREATE TABLE `ysk_integral_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '积分记录表',
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '数额',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` char(20) NOT NULL DEFAULT '',
  `type_name` varchar(20) DEFAULT NULL COMMENT '操作名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `from_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-转入 2-转出',
  `content` varchar(255) DEFAULT NULL COMMENT '说明s',
  `money_record` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值记录',
  `fee` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`,`from_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5138 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_integral_detail
-- ----------------------------
INSERT INTO `ysk_integral_detail` VALUES ('5127', '99900.00', '317', 'children', '升级奖励', '1', '1521120776', '1', '升级奖励99900', '99900.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5128', '100.00', '317', 'buykucunintegral', '购买库存积分', '1', '1521167147', '1', '购买库存积分', '100000.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5129', '10000.00', '317', 'buykucunintegral', '购买库存积分', '1', '1521167216', '1', '购买库存积分', '110000.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5130', '50000.00', '319', 'buy', '0级消费奖励', '1', '1521174152', '1', '0级消费奖励50000', '100000.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5131', '12500.00', '317', 'buy', '1级消费奖励', '1', '1521174152', '1', '1级消费奖励12500', '122500.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5132', '6250.00', '1', 'buy', '2级消费奖励', '1', '1521174152', '1', '2级消费奖励6250', '6250.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5133', '25000.00', '319', 'buy', '0级销售奖励', '1', '1521174183', '1', '0级销售奖励25000', '125000.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5134', '6250.00', '317', 'buy', '1级销售奖励', '1', '1521174183', '1', '1级销售奖励6250', '128750.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5135', '3125.00', '1', 'buy', '2级销售奖励', '1', '1521174183', '1', '2级销售奖励3125', '9375.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5136', '25000.00', '317', 'buy', '0级销售奖励', '1', '1521174296', '1', '0级销售奖励25000', '153750.00', null);
INSERT INTO `ysk_integral_detail` VALUES ('5137', '88800.00', '320', 'children', '升级奖励', '1', '1521182994', '1', '升级奖励88800', '88800.00', null);

-- ----------------------------
-- Table structure for ysk_kucun_integral_detail
-- ----------------------------
DROP TABLE IF EXISTS `ysk_kucun_integral_detail`;
CREATE TABLE `ysk_kucun_integral_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '库存积分记录表',
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '数额',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` char(20) NOT NULL DEFAULT '',
  `type_name` varchar(20) DEFAULT NULL COMMENT '操作名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `from_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-转入 2-转出',
  `content` varchar(255) DEFAULT NULL COMMENT '说明s',
  `money_record` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值记录',
  `fee` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`,`from_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_kucun_integral_detail
-- ----------------------------
INSERT INTO `ysk_kucun_integral_detail` VALUES ('1', '10800.00', '317', 'buykucunintegral', '购买库存积分', '1', '1521164533', '1', '购买10800个库存积分', '10800.00', null);
INSERT INTO `ysk_kucun_integral_detail` VALUES ('2', '1350.00', '317', 'buykucunintegral', '购买库存积分', '1', '1521167147', '1', '购买1350个库存积分', '12150.00', null);
INSERT INTO `ysk_kucun_integral_detail` VALUES ('3', '135000.00', '317', 'buykucunintegral', '购买库存积分', '1', '1521167216', '1', '购买135000个库存积分', '147150.00', null);

-- ----------------------------
-- Table structure for ysk_menu
-- ----------------------------
DROP TABLE IF EXISTS `ysk_menu`;
CREATE TABLE `ysk_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `pid` int(11) NOT NULL COMMENT '父级id',
  `gid` int(11) NOT NULL DEFAULT '0' COMMENT '爷爷ID、',
  `mod` varchar(30) NOT NULL COMMENT '模块',
  `col` varchar(30) NOT NULL COMMENT '控制器',
  `act` varchar(30) NOT NULL COMMENT '方法',
  `param` varchar(20) DEFAULT NULL COMMENT '参数',
  `param_value` varchar(50) DEFAULT NULL COMMENT '参数值',
  `patch` varchar(50) DEFAULT NULL COMMENT '全路径',
  `level` int(11) NOT NULL COMMENT '级别',
  `icon` varchar(50) DEFAULT NULL,
  `sort` char(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=385 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_menu
-- ----------------------------
INSERT INTO `ysk_menu` VALUES ('1', '系统', '0', '0', '', '', '', null, null, null, '0', 'fa-cog', '0', '1');
INSERT INTO `ysk_menu` VALUES ('3', '统统功能', '1', '1', '', '', '', null, null, '', '1', 'fa-folder-open-o', '1', '1');
INSERT INTO `ysk_menu` VALUES ('4', '系统配置', '3', '1', 'Admin', 'Config', 'group', null, null, '', '2', 'fa-wrench', '1', '1');
INSERT INTO `ysk_menu` VALUES ('5', '角色管理', '3', '1', 'Admin', 'Group', 'index', null, null, '', '2', 'fa-sitemap', '12', '1');
INSERT INTO `ysk_menu` VALUES ('6', '管理员管理', '3', '1', 'Admin', 'Manage', 'index', null, null, '', '2', 'fa fa-lock', '13', '1');
INSERT INTO `ysk_menu` VALUES ('7', '会员管理', '1', '1', '', '', '', null, null, '', '1', 'fa-folder-open-o', '2', '1');
INSERT INTO `ysk_menu` VALUES ('8', '会员列表', '7', '1', 'Admin', 'User', 'index', null, null, null, '2', 'fa-user', '21', '1');
INSERT INTO `ysk_menu` VALUES ('9', '推荐结构', '7', '1', 'Admin', 'Tree', 'index', null, null, null, '2', 'fa-th-large', '22', '1');
INSERT INTO `ysk_menu` VALUES ('10', '商城', '0', '0', '', '', '', null, null, null, '0', 'fa-tasks', '0', '1');
INSERT INTO `ysk_menu` VALUES ('11', '商品管理', '10', '10', '', '', '', null, null, null, '1', 'fa-folder-open-o', '3', '1');
INSERT INTO `ysk_menu` VALUES ('40', '商学院', '1', '1', '', '', '', null, null, null, '1', 'fa-twitter-square', '99', '1');
INSERT INTO `ysk_menu` VALUES ('41', '学员列表', '40', '1', 'Admin', 'News', 'student', null, null, null, '2', 'fa-twitter-square', '123', '1');
INSERT INTO `ysk_menu` VALUES ('42', '作品列表', '40', '1', 'Admin', 'News', 'zuopin', null, null, null, '2', 'fa-twitter-square', '34', '1');
INSERT INTO `ysk_menu` VALUES ('315', '商品列表', '11', '10', 'Adminmall', 'Good', 'index', '', '', null, '2', 'fa fa-navicon', '10', '1');
INSERT INTO `ysk_menu` VALUES ('316', '反馈管理', '1', '1', '', '', '', null, null, null, '1', 'fa-folder-open-o', '3', '1');
INSERT INTO `ysk_menu` VALUES ('318', '反馈列表', '316', '1', 'Admin', 'Useradvice', 'index', null, null, null, '2', 'fa-file-text', '32', '1');
INSERT INTO `ysk_menu` VALUES ('322', '新闻管理', '1', '1', '', '', '', null, null, null, '1', 'fa-folder-open-o', '5', '1');
INSERT INTO `ysk_menu` VALUES ('323', '新闻列表', '322', '1', 'Admin', 'News', 'entry', null, null, null, '2', 'fa-twitter-square', '51', '1');
INSERT INTO `ysk_menu` VALUES ('327', '数据库管理', '3', '1', 'Admin', 'Dbfile', 'index', null, null, null, '2', 'fa fa-arrows', '14', '0');
INSERT INTO `ysk_menu` VALUES ('341', '广告', '3', '1', 'Admin', 'Banner', 'index', null, null, null, '2', 'fa fa-image', '20', '1');
INSERT INTO `ysk_menu` VALUES ('343', '商品分类', '11', '10', 'Adminmall', 'Goodtype', 'index', '', '', '', '2', 'fa fa-sitemap', '30', '1');
INSERT INTO `ysk_menu` VALUES ('344', '商品模型', '11', '10', 'Adminmall', 'Goodmodel', 'index', '', '', '', '2', 'fa fa-th-large', '40', '1');
INSERT INTO `ysk_menu` VALUES ('345', '品牌列表', '11', '10', 'Adminmall', 'Goodbrand', 'index', '', '', '', '2', 'fa fa-navicon', '50', '1');
INSERT INTO `ysk_menu` VALUES ('346', '栏目列表', '322', '1', 'Admin', 'News', 'index', '', '', '', '2', 'fa-twitter-square', '10', '1');
INSERT INTO `ysk_menu` VALUES ('356', '文章管理', '1', '1', '', '', '', '', '', '', '1', 'fa-twitter-square', '91', '1');
INSERT INTO `ysk_menu` VALUES ('357', '文章列表', '356', '1', 'Admin', 'Article', 'index', '', '', '', '2', 'fa-twitter-square', '10', '1');
INSERT INTO `ysk_menu` VALUES ('359', '平台审核', '1', '1', '', '', '', null, null, null, '1', 'fa-folder-open-o', '2', '1');
INSERT INTO `ysk_menu` VALUES ('360', '用户认证', '359', '1', 'Admin', 'Shopstatus', 'index', null, null, null, '2', 'fa fa-navicon', '991', '1');
INSERT INTO `ysk_menu` VALUES ('361', '商城公告', '10', '10', '', '', '', '', '', '', '1', 'fa-folder-open-o', '4', '1');
INSERT INTO `ysk_menu` VALUES ('362', '公告列表', '361', '10', 'Adminmall', 'Shopnews', 'index', null, null, null, '2', 'fa-twitter-square', '50', '1');
INSERT INTO `ysk_menu` VALUES ('363', '工单审核', '359', '1', 'Admin', 'Shopstatus', 'orderlist', '', '', '', '2', 'fa fa-navicon', '992', '1');
INSERT INTO `ysk_menu` VALUES ('364', '订单管理', '10', '10', '', '', '', '', '', '', '1', 'fa-folder-open-o', '5', '1');
INSERT INTO `ysk_menu` VALUES ('365', '未支付订单', '364', '10', 'Adminmall', 'Order', 'index', 'order_status', '0', '', '2', 'fa-twitter-square', '50', '1');
INSERT INTO `ysk_menu` VALUES ('366', '已支付订单', '364', '10', 'Adminmall', 'Order', 'index', 'order_status', '1', '', '2', 'fa-twitter-square', '50', '1');
INSERT INTO `ysk_menu` VALUES ('367', '已发货订单', '364', '10', 'Adminmall', 'Order', 'index', 'order_status', '2', '', '2', 'fa-twitter-square', '50', '1');
INSERT INTO `ysk_menu` VALUES ('368', '已完成订单', '364', '10', 'Adminmall', 'Order', 'index', 'order_status', '3', '', '2', 'fa-twitter-square', '50', '1');
INSERT INTO `ysk_menu` VALUES ('369', '提现审核', '359', '1', 'Admin', 'Money', 'index', '', '', '', '2', 'fa fa-navicon', '992', '1');
INSERT INTO `ysk_menu` VALUES ('370', '充值审核', '359', '1', 'Admin', 'Recharge', 'index', '', '', '', '2', 'fa fa-navicon', '992', '1');
INSERT INTO `ysk_menu` VALUES ('371', '商家管理', '10', '10', '', '', '', '', '', '', '1', 'fa-folder-open-o', '6', '1');
INSERT INTO `ysk_menu` VALUES ('372', '店铺列表', '371', '10', 'Adminmall', 'Seller', 'index', '', '', '', '2', 'fa-twitter-square', '50', '1');
INSERT INTO `ysk_menu` VALUES ('374', '商家申请', '359', '1', 'Admin', 'Sellerapply', 'apply', '', '', '', '2', 'fa fa-navicon', '992', '1');
INSERT INTO `ysk_menu` VALUES ('375', '行业管理', '10', '10', '', '', '', '', '', '', '1', 'fa-folder-open-o', '31', '1');
INSERT INTO `ysk_menu` VALUES ('377', '行业列表', '375', '10', 'Adminmall', 'Industry', 'index', '', '', '', '2', 'fa fa-sitemap', '30', '1');
INSERT INTO `ysk_menu` VALUES ('378', '评论管理', '10', '10', '', '', '', '', '', '', '1', 'fa-folder-open-o', '6', '1');
INSERT INTO `ysk_menu` VALUES ('379', '自营评论', '378', '10', 'Adminmall', 'Comment', 'index', '', '', '', '2', 'fa fa-navicon', '992', '1');
INSERT INTO `ysk_menu` VALUES ('380', '商家评论', '378', '10', 'Adminmall', 'Comment', 'sellercomment', '', '', '', '2', 'fa fa-navicon', '992', '1');
INSERT INTO `ysk_menu` VALUES ('381', '商家列表', '371', '10', 'Adminmall', 'Seller', 'sellerlist', '', '', '', '2', 'fa-twitter-square', '50', '1');
INSERT INTO `ysk_menu` VALUES ('382', '发布消息', '316', '1', 'Admin', 'Message', 'index', '', '', '', '2', 'fa-file-text', '32', '1');
INSERT INTO `ysk_menu` VALUES ('383', '充值记录', '7', '1', 'Admin', 'Rechargedetail', 'index', '', '', '', '2', 'fa-th-large', '212', '1');
INSERT INTO `ysk_menu` VALUES ('384', '财富管理', '7', '1', 'Admin', 'User', 'userlist', '', '', '', '2', 'fa-user', '211', '1');

-- ----------------------------
-- Table structure for ysk_message
-- ----------------------------
DROP TABLE IF EXISTS `ysk_message`;
CREATE TABLE `ysk_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL COMMENT '1-通知消息',
  `content` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '0所有人显示',
  `create_time` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未读 1-已读',
  `send` int(255) NOT NULL DEFAULT '0' COMMENT '1 平台发送 ',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_message
-- ----------------------------
INSERT INTO `ysk_message` VALUES ('1', '1', '3434', '317', '1521191517', '提现审核', '0', '1');

-- ----------------------------
-- Table structure for ysk_message_read
-- ----------------------------
DROP TABLE IF EXISTS `ysk_message_read`;
CREATE TABLE `ysk_message_read` (
  `uid` int(11) NOT NULL,
  `message_id` text NOT NULL COMMENT '已读信息ID',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_message_read
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_money_detail
-- ----------------------------
DROP TABLE IF EXISTS `ysk_money_detail`;
CREATE TABLE `ysk_money_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '充值记录表',
  `order_no` varchar(20) NOT NULL COMMENT '充值单号',
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` char(20) NOT NULL DEFAULT '',
  `type_name` varchar(20) DEFAULT NULL COMMENT '操作名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '转账银行名称',
  `user_name` varchar(50) DEFAULT NULL,
  `card_no` varchar(50) DEFAULT NULL COMMENT '卡号',
  `img` varchar(255) DEFAULT NULL COMMENT '支付凭证',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `from_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-转入 2-转出',
  `content` varchar(255) DEFAULT NULL COMMENT '说明s',
  `money_record` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值记录',
  `reply` varchar(255) DEFAULT NULL COMMENT '回复',
  `admin_id` int(11) DEFAULT NULL COMMENT '回复人',
  `fee` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`,`from_type`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_money_detail
-- ----------------------------
INSERT INTO `ysk_money_detail` VALUES ('295', '', '10000.00', '317', 'admin', '后台充值', '1', null, null, null, null, '1521120741', '1', '后台充值10000', '10000.00', null, null, null);
INSERT INTO `ysk_money_detail` VALUES ('296', '', '999.00', '317', 'updateuser', '用户升级', '1', null, null, null, null, '1521120776', '2', '用户升级消耗999.00', '9001.00', null, null, null);
INSERT INTO `ysk_money_detail` VALUES ('297', '', '8.00', '317', 'buykucunintegral', '购买库存积分', '1', null, null, null, null, '1521164533', '2', '购买10800个库存积分', '8993.00', null, null, null);
INSERT INTO `ysk_money_detail` VALUES ('298', '', '1.00', '317', 'buykucunintegral', '购买库存积分', '1', null, null, null, null, '1521167147', '2', '购买1350个库存积分', '8992.00', null, null, null);
INSERT INTO `ysk_money_detail` VALUES ('299', '', '100.00', '317', 'buykucunintegral', '购买库存积分', '1', null, null, null, null, '1521167216', '2', '购买135000个库存积分', '8892.00', null, null, null);
INSERT INTO `ysk_money_detail` VALUES ('300', '', '10000.00', '320', 'admin', '后台充值', '1', null, null, null, null, '1521182581', '1', '后台充值10000', '10000.00', null, null, null);
INSERT INTO `ysk_money_detail` VALUES ('301', '', '888.00', '320', 'updateuser', '用户升级', '1', null, null, null, null, '1521182994', '2', '用户升级消耗888.00', '9112.00', null, null, null);
INSERT INTO `ysk_money_detail` VALUES ('302', '', '100.00', '317', 'getmoney', '提现', '1', null, null, null, null, '1521194823', '2', '提现100,手续费20', '8792.00', null, null, null);
INSERT INTO `ysk_money_detail` VALUES ('303', '', '100.00', '317', 'buygood', '购买商品', '1', null, null, null, null, '1521198539', '2', '购买商品消耗TP20180316190622166', '8692.00', null, null, null);

-- ----------------------------
-- Table structure for ysk_money_get
-- ----------------------------
DROP TABLE IF EXISTS `ysk_money_get`;
CREATE TABLE `ysk_money_get` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '提现记录表',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '提现金额',
  `fee` decimal(11,2) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '转账银行名称',
  `user_name` varchar(50) DEFAULT NULL,
  `card_no` varchar(50) DEFAULT NULL COMMENT '卡号',
  `bank_branch` varchar(255) DEFAULT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `content` varchar(255) DEFAULT NULL COMMENT '说明',
  `reply` varchar(255) DEFAULT NULL COMMENT '回复',
  `admin_id` int(11) DEFAULT NULL COMMENT '回复人',
  `r_id` int(11) NOT NULL DEFAULT '0' COMMENT '明细表ID',
  `username` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-现金提现 2-玉贝提现',
  `type_name` varchar(20) DEFAULT NULL,
  `fee_time` int(11) NOT NULL DEFAULT '0' COMMENT '到账时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_money_get
-- ----------------------------
INSERT INTO `ysk_money_get` VALUES ('1', '10000.00', '2000.00', '317', '1', '中国工商银行', '李明', '622992052264565', '深圳支行', '1521186394', null, '123123', '1', '0', '深圳网络科技有限公司', '13713713701', 'test123', '2', '宏宝提现', '1');
INSERT INTO `ysk_money_get` VALUES ('2', '100.00', '20.00', '317', '1', '中国工商银行', '李明', '622992052264565', '深圳支行', '1521194823', null, '', '1', '0', '深圳网络科技有限公司', '13713713701', 'test123', '1', '现金提现', '1');
INSERT INTO `ysk_money_get` VALUES ('3', '10000.00', '2000.00', '317', '1', '中国工商银行', '李明', '622992052264565', '深圳支行', '1521194843', null, '', '1', '0', '深圳网络科技有限公司', '13713713701', 'test123', '2', '宏宝提现', '1');

-- ----------------------------
-- Table structure for ysk_money_recharge
-- ----------------------------
DROP TABLE IF EXISTS `ysk_money_recharge`;
CREATE TABLE `ysk_money_recharge` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '充值记录表',
  `order_no` varchar(20) DEFAULT NULL COMMENT '充值单号',
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` char(20) NOT NULL DEFAULT '',
  `type_name` varchar(20) DEFAULT NULL COMMENT '操作名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付 2-不通过',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '转账银行名称',
  `user_name` varchar(50) DEFAULT NULL,
  `card_no` varchar(50) DEFAULT NULL COMMENT '卡号',
  `img` varchar(255) DEFAULT NULL COMMENT '支付凭证',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  `from_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-转入 2-转出',
  `content` varchar(255) DEFAULT NULL COMMENT '说明',
  `money_record` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '充值记录',
  `reply` varchar(255) DEFAULT NULL COMMENT '回复',
  `admin_id` int(11) DEFAULT NULL COMMENT '回复人',
  `fee` decimal(11,2) DEFAULT NULL,
  `r_id` int(11) NOT NULL DEFAULT '0' COMMENT '记录表ID',
  `username` varchar(20) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `paytype` varchar(20) DEFAULT NULL,
  `pay_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`type`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_money_recharge
-- ----------------------------
INSERT INTO `ysk_money_recharge` VALUES ('322', null, '10000.00', '317', 'admin', '后台充值', '1', null, null, null, null, '1521120741', '1', '充值10000', '10000.00', null, null, null, '0', '', 'test123', '13713713701', null, null);
INSERT INTO `ysk_money_recharge` VALUES ('323', null, '10000.00', '320', 'admin', '后台充值', '1', null, null, null, null, '1521182581', '1', '充值10000', '10000.00', null, null, null, '0', '', 'test005', '13713713705', null, null);

-- ----------------------------
-- Table structure for ysk_news
-- ----------------------------
DROP TABLE IF EXISTS `ysk_news`;
CREATE TABLE `ysk_news` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '新闻id',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `px` int(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `addtime` int(11) NOT NULL COMMENT '上传时间',
  `content` text NOT NULL COMMENT '内容',
  `views` int(10) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `newtop` int(1) NOT NULL DEFAULT '1' COMMENT '1最新2置顶',
  `type` varchar(255) NOT NULL COMMENT '上级名称',
  `pid` int(5) NOT NULL COMMENT '上级id',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否展示  1展示  2 不展示',
  `times` int(5) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_news
-- ----------------------------
INSERT INTO `ysk_news` VALUES ('2', '习近平落笔建设现代化经济体系大文章', '0', '1517751790', '<div class=\"page js-page on\" style=\"margin:0px;padding:0px;border:0px currentColor;color:#404040;background-color:#F6F6F6;\">\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		<strong>央视网消息：</strong>国家强，经济体系必须强。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		2018年1月30日，中共中央政治局就建设现代化经济体系进行集体学习。习近平强调：“建设现代化经济体系是一篇大文章，既是一个重大理论命题，更是一个重大实践课题，需要从理论和实践的结合上进行深入探讨。”\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		谋篇布局，运筹帷幄。如何写好建设现代化体系这篇“大文章”，习近平全局在胸。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		<strong>以“新”为序 下笔生辉</strong>\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		2017年11月3日，我国自主设计并建造的亚洲最大绞吸挖泥船“天鲲号”在江苏成功下水。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		2017年12月31日，世界最长的跨海大桥——港珠澳大桥主体全线亮灯，主体工程基本完工。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		2018年2月2日，电磁监测试验卫星“张衡一号”发射升空。我国成为世界上少数拥有在轨运行高精度地球物理场探测卫星的国家之一。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		......\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		自十九大报告首次提出“现代化经济体系”后，一项又一项重大工程捷报频传，不断刷新世界各国对中国经济社会发展的认知。创新是引领发展的第一动力，建设“经济强国”的背后必然有“科技强国”战略的强大推动。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		“要加快实施创新驱动发展战略，强化现代化经济体系的战略支撑，加强国家创新体系建设，强化战略科技力量，推动科技创新和经济社会发展深度融合，塑造更多依靠创新驱动、更多发挥先发优势的引领型发展。”习近平的讲话，不仅为创新发展指明了新目标，也提供了不竭动力。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		十九大报告指出，我国经济已由高速增长阶段转向高质量发展阶段，建设现代化经济体系是跨越关口的迫切需求和我国发展的战略目标。近年来，我国网络购物、移动支付、共享经济等数字经济新业态新模式蓬勃发展，走在了世界前列。2016年，我国数字经济规模总量达22.58万亿元，跃居全球第二位。\r\n	</p>\r\n</div>\r\n<div class=\"page js-page on\" style=\"margin:0px;padding:0px;border:0px currentColor;color:#404040;background-color:#F6F6F6;\">\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		如何抓住时代新机遇，开创发展新局面，是党中央必须解答好的时代命题。自2014年开始，我国的研发投入占GDP的比重超过2%，国际公认这是一个国家进入创新活跃期的关键时间窗口。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		创新发展如逆水行舟，不进则退。坚持创新的发展思想，既是新时代发展的内在要求，也是大有可为的广阔舞台。实现高质量发展，让创新成为建设现代化经济体系的重要基石；推动创新，让老百姓享受更好的生活质量。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		<strong>以“实”为纲 筑牢基础</strong>\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		善战者，求之于势。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		“要深化供给侧结构性改革，加快发展先进制造业，推动互联网、大数据、人工智能同实体经济深度融合，推动资源要素向实体经济集聚、政策措施向实体经济倾斜、工作力量向实体经济加强，营造脚踏实地、勤劳创业、实业致富的发展环境和社会氛围。”习近平一向看重实体经济的发展。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		十九大后，习近平首次调研即选择了我国首个创新型省份建设试点省——江苏。他在徐工集团重型机械有限公司看望劳动模范、技术能手等职工代表时强调：“必须始终高度重视发展壮大实体经济”。同时，他在去年的中央经济工作会议中要求：“结构性政策要发挥更大作用，强化实体经济吸引力和竞争力”。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		实体经济是一国经济的立身之本，是财富创造的根本源泉，是国家强盛的重要支柱。只有大力发展实体经济，才能筑牢现代化经济体系的坚实基础。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		国家统计局最新数据显示，2017年，我国规模以上工业企业实现利润75187.1亿元，比上年增长21%，增速比2016年提高12.5个百分点，是2012年以来增速最高的一年。从盈利能力看，2017年，规模以上工业企业主营业务收入利润率为6.46%，比上年提高0.54个百分点，工业企业盈利能力明显增强。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		建设现代化经济体系就必须抓住发展实体经济这个“牛鼻子”，推动形成全面开放新格局，早日实现产业强国的梦想。\r\n	</p>\r\n</div>\r\n<div class=\"page js-page on\" style=\"margin:0px;padding:0px;border:0px currentColor;color:#404040;background-color:#F6F6F6;\">\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		<strong>以“强”为要 擘画现代化强国</strong>\r\n	</p>\r\n	<div class=\"photo\" style=\"margin:0.3rem 0px;padding:0px;border:0px currentColor;text-align:center;\">\r\n		<a href=\"https://cms-bucket.nosdn.127.net/catchpic/0/03/030bea02e8537eaca01260ac310c2428.jpg\"></a>强国，是习近平为未来的中国印上的醒目标签。“从2020年到2035年，在全面建成小康社会的基础上，再奋斗十五年，基本实现社会主义现代化……从2035年到本世纪中叶，在基本实现现代化的基础上，再奋斗十五年，把我国建成富强民主文明和谐美丽的社会主义现代化强国。”习近平在中国共产党第十九次全国代表大会上的这句展望，赢得了热烈而持久的掌声。\r\n	</div>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		建设现代化经济体系，是党中央从党和国家事业全局出发，着眼于实现“两个一百年”奋斗目标、顺应中国特色社会主义进入新时代的新要求作出的重大决策部署。只有形成现代化经济体系，才能更好地顺应现代化发展潮流和赢得国际竞争主动，也才能为其他领域现代化提供有力支撑，确保社会主义现代化强国目标如期实现。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		近年来，中国的经济实力不断增强，对世界经济的影响力也在不断提升。国际货币基金组织认为，中国2016年为全球经济增长贡献了1.2个百分点，而美国只贡献了0.3个百分点，欧洲贡献了0.2个百分点。联合国发布的《2018年世界经济形势与展望》报告指出，2017年全球经济增长有1/3是依仗中国。5年来，中国对世界经济增长的年均贡献率达30.2%，超过同期美国、欧元区和日本贡献的总和。2017年中国经济总量占全球的比重达15%，比5年前提高3.5个百分点。\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		从建设工业强国、航天强国、海洋强国、网络强国等硬实力，到建设文化强国、体育强国等软实力，正如习近平所言：“中华民族迎来了从站起来、富起来到强起来的伟大飞跃。”\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		中华儿女“比历史上任何时期都更接近、更有信心和能力实现中华民族伟大复兴的目标。”\r\n	</p>\r\n	<p style=\"text-align:justify;text-indent:2em;\">\r\n		犹记习近平2018年新年贺词，“千千万万普通人最伟大。”“幸福都是奋斗出来的。”只要一件事情接着一件事情办，一年接着一年干，坚忍不拔、锲而不舍，中国人民就能走好社会主义现代化新征程，走好社会主义现代化强国之路。\r\n	</p>\r\n</div>', '0', '1', '资讯动态', '5', '1', '37');
INSERT INTO `ysk_news` VALUES ('3', '内测试运营开启', '10', '1521110604', '<p>\r\n	内测试运营开启内测试运营开启内测试运营开启内测试运营开启内测试运营开启\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '0', '2', '官方公告', '1', '1', '161');
INSERT INTO `ysk_news` VALUES ('4', '线上支付', '0', '1521110577', '<p align=\"left\">\r\n	支付帮助\r\n</p>', '0', '1', '支付平台', '10', '1', '53');
INSERT INTO `ysk_news` VALUES ('5', '线下支付', '0', '1521110717', '<p>\r\n	线下支付支付\r\n</p>', '0', '1', '支付平台', '10', '1', '25');
INSERT INTO `ysk_news` VALUES ('6', '提现处理', '0', '1521110785', '<p>\r\n	提现提现相同\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '0', '1', '交易中心', '8', '1', '13');
INSERT INTO `ysk_news` VALUES ('7', '试运营期间平台规则', '11', '1521110813', '<p class=\"p0\" style=\"text-align:center;text-indent:48pt;\">\r\n	规则<span>规则</span><span>规则</span><span>规则</span><span>规则</span>\r\n</p>\r\n<!--EndFragment-->', '0', '2', '平台规则', '2', '1', '150');
INSERT INTO `ysk_news` VALUES ('8', '如何修改密码', '0', '1517758305', '<p>\r\n	<img alt=\"\" src=\"/static/plugin/attached/image/20180204/20180204233053_88837.jpg\" /><img alt=\"\" src=\"/static/plugin/attached/image/20180204/20180204233101_11969.jpg\" /><img alt=\"\" src=\"/static/plugin/attached/image/20180204/20180204233110_78823.jpg\" />\r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"/static/plugin/attached/image/20180204/20180204233106_52929.jpg\" />\r\n</p>', '0', '1', '用户中心', '9', '1', '4');
INSERT INTO `ysk_news` VALUES ('9', '忘记密码怎么办', '0', '1521110376', '<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img alt=\"\" src=\"/static/plugin/attached/image/20180204/20180204233458_91812.jpg\" /> \r\n</p>', '0', '1', '交易中心', '9', '1', '2');
INSERT INTO `ysk_news` VALUES ('10', '公告', '99', '1521110632', '公告公告公告公告公告公告', '0', '2', '官方公告', '1', '1', '66');
INSERT INTO `ysk_news` VALUES ('11', '关于宏八提现时间通知', '0', '1521110673', '通知通知<span>通知通知</span><span>通知通知</span><span>通知通知</span><span>通知通知</span>', '0', '2', '官方公告', '1', '1', '57');

-- ----------------------------
-- Table structure for ysk_news_title
-- ----------------------------
DROP TABLE IF EXISTS `ysk_news_title`;
CREATE TABLE `ysk_news_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `title` varchar(255) NOT NULL COMMENT '栏目名称',
  `addtime` int(11) NOT NULL COMMENT '更新时间',
  `sort` int(255) DEFAULT NULL COMMENT '排序',
  `pid` int(5) NOT NULL DEFAULT '346',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_news_title
-- ----------------------------
INSERT INTO `ysk_news_title` VALUES ('1', '官方公告', '1512613461', '21', '346');
INSERT INTO `ysk_news_title` VALUES ('2', '平台规则', '1512613530', '33', '346');
INSERT INTO `ysk_news_title` VALUES ('3', '处罚通知', '1512613558', '12', '346');
INSERT INTO `ysk_news_title` VALUES ('4', '系统通知', '1512613569', '122', '346');
INSERT INTO `ysk_news_title` VALUES ('5', '资讯动态', '1512613972', '123', '346');
INSERT INTO `ysk_news_title` VALUES ('6', '帮助中心', '1512613619', '54', '346');
INSERT INTO `ysk_news_title` VALUES ('8', '交易中心', '1513050423', '76', '6');
INSERT INTO `ysk_news_title` VALUES ('9', '用户中心', '1513050626', '356', '6');
INSERT INTO `ysk_news_title` VALUES ('10', '支付平台', '1513050467', '12', '6');

-- ----------------------------
-- Table structure for ysk_nzbill
-- ----------------------------
DROP TABLE IF EXISTS `ysk_nzbill`;
CREATE TABLE `ysk_nzbill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '明细id',
  `bill_uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `bill_num` decimal(10,1) NOT NULL DEFAULT '0.0' COMMENT '财富币',
  `bill_reason` char(20) NOT NULL COMMENT '生成的原因',
  `bill_time` int(11) NOT NULL DEFAULT '0' COMMENT '生成时间',
  `bill_name` varchar(50) DEFAULT NULL,
  `bill_type` char(1) NOT NULL COMMENT '0-扣除 1-获得',
  `bill_username` varchar(20) DEFAULT NULL,
  `bill_account` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`bill_id`),
  KEY `bill_userid` (`bill_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='转盘抽奖';

-- ----------------------------
-- Records of ysk_nzbill
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_order
-- ----------------------------
DROP TABLE IF EXISTS `ysk_order`;
CREATE TABLE `ysk_order` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `order_no` varchar(50) NOT NULL DEFAULT '' COMMENT '订单编号',
  `order_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态 0 未支付 1已支付  2已发货 3已完成',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `user_name` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人',
  `user_country` varchar(20) DEFAULT '0' COMMENT '国家',
  `user_province` varchar(50) NOT NULL DEFAULT '0' COMMENT '省份',
  `user_city` varchar(50) NOT NULL DEFAULT '0' COMMENT '城市',
  `user_district` varchar(50) NOT NULL DEFAULT '0' COMMENT '县区',
  `user_address` varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  `user_mobile` varchar(60) CHARACTER SET utf32 NOT NULL DEFAULT '' COMMENT '收货人手机',
  `order_transport_code` varchar(32) NOT NULL DEFAULT '' COMMENT '物流单号',
  `order_transport_name` varchar(120) NOT NULL DEFAULT '' COMMENT '物流名称',
  `order_pay_code` varchar(32) NOT NULL DEFAULT '' COMMENT '支付code',
  `order_pay_name` varchar(20) NOT NULL DEFAULT '' COMMENT '支付方式名称',
  `order_ship_price` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `order_use_money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '使用余额',
  `order_use_coupon` decimal(13,2) DEFAULT '0.00' COMMENT '优惠券抵扣',
  `order_use_integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用积分',
  `order_total_price` decimal(10,2) DEFAULT '0.00' COMMENT '订单总价',
  `order_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下单时间',
  `order_ship_time` int(11) DEFAULT '0' COMMENT '发货时间',
  `order_confirm_time` int(10) DEFAULT '0' COMMENT '收货确认时间',
  `order_pay_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付时间',
  `order_discount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格调整',
  `order_user_note` varchar(255) DEFAULT '' COMMENT '用户备注',
  `order_admin_note` varchar(255) DEFAULT '' COMMENT '管理员备注',
  `order_is_distribut` tinyint(1) DEFAULT '0' COMMENT '是否已分成0未分成1已分成',
  `order_is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户假删除标识,1:删除,0未删除',
  `seller_id` int(11) NOT NULL DEFAULT '0' COMMENT '商家ID',
  `money_to_seller` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否给钱给商家 0没给 1已给',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_no` (`order_no`),
  KEY `user_id` (`user_id`),
  KEY `order_create_time` (`order_create_time`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_order
-- ----------------------------
INSERT INTO `ysk_order` VALUES ('1', 'NZ201803161820388650', '1', '317', '测试', '0', '广东', '深圳市', '南山区', '105路25号', '13713713701', '', '', '5', '购物券支付', '0.00', '0.00', '0.00', '0', '200.00', '1521195638', '0', '0', '1521198185', '0.00', '备注备注', '', '0', '0', '0', '0');
INSERT INTO `ysk_order` VALUES ('2', 'NZ201803161906227503', '1', '317', '测试', '0', '广东', '深圳市', '南山区', '105路25号', '13713713701', '', '', '1', '余额支付', '0.00', '0.00', '0.00', '0', '100.00', '1521198382', '0', '0', '1521198539', '0.00', '', '', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for ysk_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `ysk_order_detail`;
CREATE TABLE `ysk_order_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id自增',
  `order_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `good_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `good_name` varchar(120) NOT NULL DEFAULT '' COMMENT '视频名称',
  `good_no` varchar(60) DEFAULT '' COMMENT '商品货号',
  `good_cover_img` varchar(255) DEFAULT NULL,
  `good_num` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '购买数量',
  `market_price` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `good_price` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '售价',
  `cost_price` decimal(13,2) DEFAULT '0.00' COMMENT '商品成本价',
  `user_good_price` decimal(13,2) DEFAULT '0.00' COMMENT '会员折扣价',
  `give_integral` mediumint(8) DEFAULT '0' COMMENT '购买商品赠送积分',
  `attr_value` varchar(128) DEFAULT '' COMMENT '商品规格项',
  `attr_text` text COMMENT '规格对应的名字',
  `is_comment` tinyint(1) DEFAULT '0' COMMENT '是否评价',
  `is_send` tinyint(1) DEFAULT '0' COMMENT '0未发货，1已发货，2已换货，3已退货',
  `ship_no` char(20) DEFAULT '0' COMMENT '发货单号',
  `seller_id` int(11) NOT NULL DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `good_id` (`good_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_order_detail
-- ----------------------------
INSERT INTO `ysk_order_detail` VALUES ('1', '1', '652', '云南彝药三七粉', 'mm23544', '/uploads/temp/2018/03-15/f7b00051f251d8660a44fa0aee27d907.jpg', '1', '500.00', '200.00', '150.00', '0.00', '0', '1G,M', '内存:1G,型号:M', '0', '0', '0', '0');
INSERT INTO `ysk_order_detail` VALUES ('2', '2', '655', '倍爱】孕妇产妇月子睡衣/纯棉家居服套装/哺乳上衣/秋冬', '1000', '/uploads/temp/2018/03-15/ad804488c9091e5273bdb565807f3f88.jpg', '1', '150.00', '100.00', '90.00', '0.00', '0', 'S码', '尺码:S码', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for ysk_order_pay
-- ----------------------------
DROP TABLE IF EXISTS `ysk_order_pay`;
CREATE TABLE `ysk_order_pay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '支付订单',
  `order_no` varchar(50) NOT NULL COMMENT '支付订单号',
  `order_id_list` text NOT NULL COMMENT '所有关联订单的ID,用逗号隔开',
  `order_total_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付价格',
  `order_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付 1已支付',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_order_pay
-- ----------------------------
INSERT INTO `ysk_order_pay` VALUES ('1', 'TP20180316182038146', '1', '200.00', '1', '317');
INSERT INTO `ysk_order_pay` VALUES ('2', 'TP20180316190622166', '2', '100.00', '1', '317');

-- ----------------------------
-- Table structure for ysk_pay_record
-- ----------------------------
DROP TABLE IF EXISTS `ysk_pay_record`;
CREATE TABLE `ysk_pay_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '支付记录表',
  `money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `order_no` varchar(20) NOT NULL COMMENT '付款单号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `pay_type` varchar(20) NOT NULL COMMENT '支付方式',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_no` (`order_no`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_pay_record
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_school_details
-- ----------------------------
DROP TABLE IF EXISTS `ysk_school_details`;
CREATE TABLE `ysk_school_details` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '作品ID',
  `addtime` varchar(255) NOT NULL COMMENT '保存时间',
  `link` varchar(255) NOT NULL COMMENT '视频连接',
  `content` text NOT NULL COMMENT '作品介绍',
  `people_id` int(5) NOT NULL COMMENT '学员ID',
  `people_name` varchar(255) NOT NULL COMMENT '学员姓名',
  `title` varchar(255) NOT NULL COMMENT '作品标题',
  `sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1、展示 2、隐藏',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_school_details
-- ----------------------------
INSERT INTO `ysk_school_details` VALUES ('4', '1513669331', 'http://player.youku.com/embed/XMzA4MTkwMTM1Mg==', '<p style=\"font-size:3vmin;text-indent:2em;font-family:Simsun;background-color:#F2F2F2;\">\r\n	简介：第一个在美国打球的是马健第1个和NBA有接触的，被NBA球队相中的球员是： 宋涛第1个接到NBA十天短合同的球员是：胡卫东第1个登陆NBA的球员是： 王治郅第1个拿到NBA总冠军戒指的球员是： 巴特尔第1个以“新秀状元”身份加入NBA的球员是： 姚明第一个亲自到NBA选秀现场的中国球员是：易建联胡卫东第1个登陆NBA的球员是： 王治郅第1个拿到NBA总冠军戒指的球员是： 巴特尔第1个以“新秀状元”身份加入NBA的球员是： 姚明第一个亲自到NBA选秀现场的中国球员是：易建联\r\n</p>\r\n<p style=\"font-size:3vmin;text-indent:2em;font-family:Simsun;background-color:#F2F2F2;\">\r\n	简介：第一个在美国打球的是马健第1个和NBA有接触的，被NBA球队相中的球员是： 宋涛第1个接到NBA十天短合同的球员是：胡卫东第1个登陆NBA的球员是： 王治郅第1个拿到NBA总冠军戒指的球员是： 巴特尔第1个以“新秀状元”身份加入NBA的球员是： 姚明第一个亲自到NBA选秀现场的中国球员是：易建联胡卫东第1个登陆NBA的球员是： 王治郅第1个拿到NBA总冠军戒指的球员是： 巴特尔第1个以“新秀状元”身份加入NBA的球员是： 姚明第一个亲自到NBA选秀现场的中国球员是：易建联\r\n</p>', '16', '都不会大幅', '商学院大标题', '23', '1');
INSERT INTO `ysk_school_details` VALUES ('3', '1513852297', 'http://player.youku.com/embed/XMTc0MTE0NzE2NA==', '反对恢复得很但斯科斯达克使得公司的那个为了克服了网络', '8', '使得根深蒂固', '地方吧会发光', '23', '1');
INSERT INTO `ysk_school_details` VALUES ('5', '1513852328', 'http://player.youku.com/embed/XMjUxNTE3NzEwNA==', '凌空垫射反抗螺丝钉扑克牌未批哦但斯科价格vjsdjh啊控诉放假哦', '14', '更何况与', '吉大港', '23', '1');
INSERT INTO `ysk_school_details` VALUES ('6', '1513852186', 'http://player.youku.com/embed/XMTc0Mjg4NjY4MA==', '斯蒂芬供货合同三大高端峰会日啊是否对事故多发高发放到更好地发挥阿斯共同话题和的方法和地方富含软骨和环球网热情为', '16', '都不会大幅', '上帝会给对方', '1432', '1');
INSERT INTO `ysk_school_details` VALUES ('7', '1513852238', 'http://player.youku.com/embed/XMjU1MzQ2ODgzMg==', '对方合法化过热we过会儿呵呵啊官方三大高端房人员建议如果', '13', '国家和认同感', '东方红', '325', '1');

-- ----------------------------
-- Table structure for ysk_school_people
-- ----------------------------
DROP TABLE IF EXISTS `ysk_school_people`;
CREATE TABLE `ysk_school_people` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '人物id',
  `addtime` varchar(255) NOT NULL COMMENT '添加时间',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `age` int(3) DEFAULT NULL COMMENT '年龄',
  `addres` varchar(255) DEFAULT NULL COMMENT '地址',
  `image` varchar(255) NOT NULL COMMENT '头像',
  `content` text NOT NULL COMMENT '介绍',
  `fans` int(5) DEFAULT NULL COMMENT '粉丝',
  `graded` decimal(4,1) DEFAULT NULL COMMENT '评分',
  `numeration` int(6) NOT NULL DEFAULT '0' COMMENT '播放次数',
  `sort` int(4) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_school_people
-- ----------------------------
INSERT INTO `ysk_school_people` VALUES ('8', '1521119286', '使得根深蒂固', '22', '四点半根深蒂固', '/uploads/temp/2018/03-15/fac9e2020c1672c823cce48e9fccb44c.jpg', 'sag围观围观围观', '0', '22.0', '13', '2');
INSERT INTO `ysk_school_people` VALUES ('16', '1521119312', '都不会大幅', '2233', '大陆', '/uploads/temp/2018/03-15/61423fa59fb7c9d51c03f8f207cac976.jpg', '<span style=\"font-family:Simsun;background-color:#F2F2F2;\">简介：第一个在美国打球的是马健第1个和NBA有接触的，被NBA球队相中的球员是： 宋涛第1个接到NBA十天短合同的球员是：胡卫东第1个登陆NBA的球员是： 王治郅第1个拿到NBA总冠军戒指的球员是： 巴特尔第1个以“新秀状元”身份加入NBA的球员是： 姚明第一个亲自到NBA选秀现场的中国球员是：易建联胡卫东第1个登陆NBA的球员是： 王治郅第1个拿到NBA总冠军戒指的球员是： 巴特尔第1个以“新秀状元”身份加入NBA的球员是： 姚明第一个亲自到NBA选秀现场的中国球员是：易建联</span><br />', '0', '9.9', '16', '34');
INSERT INTO `ysk_school_people` VALUES ('13', '1521119299', '国家和认同感', '34', '东方红', '/uploads/temp/2018/03-15/8df987440791f5b4ef10ccd8b00665c5.jpg', '规划和认同和投入使得公司的规划', '0', '9.8', '4', '5');

-- ----------------------------
-- Table structure for ysk_seller_apply
-- ----------------------------
DROP TABLE IF EXISTS `ysk_seller_apply`;
CREATE TABLE `ysk_seller_apply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商家申请',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '商家ID',
  `username` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  `con_name` varchar(20) NOT NULL COMMENT '联系人姓名',
  `con_mobile` varchar(20) NOT NULL COMMENT '联系人手机',
  `con_email` varchar(20) NOT NULL COMMENT '联系人邮箱',
  `shop_name` varchar(50) NOT NULL COMMENT '店铺名称',
  `respon_name` varchar(20) NOT NULL COMMENT '店铺负责人姓名',
  `respon_mobile` varchar(20) NOT NULL COMMENT '店铺负责人手机',
  `respon_email` varchar(20) NOT NULL COMMENT '店铺负责人邮箱',
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `addresss_detail` varchar(255) NOT NULL COMMENT '详细地址',
  `create_time` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL COMMENT '操作管理员',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `industry_id` int(11) NOT NULL COMMENT '所属行业',
  `fee` int(255) NOT NULL,
  `industry_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_seller_apply
-- ----------------------------
INSERT INTO `ysk_seller_apply` VALUES ('29', '317', '', '13713713701', 'test123', '李明', '13713713701', '123@qq.com', '大禹销售店', '李明', '13713713701', '123@qq.com', '辽宁省', '鞍山市', '台安县', '大明路138号', '1521120992', null, '1', '5', '8', '百货超市');

-- ----------------------------
-- Table structure for ysk_seller_menu
-- ----------------------------
DROP TABLE IF EXISTS `ysk_seller_menu`;
CREATE TABLE `ysk_seller_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` varchar(6) NOT NULL DEFAULT '0',
  `orders` int(8) NOT NULL,
  `isshow` tinyint(1) NOT NULL DEFAULT '1',
  `icon` varchar(30) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ismodel` tinyint(1) NOT NULL DEFAULT '1',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_seller_menu
-- ----------------------------
INSERT INTO `ysk_seller_menu` VALUES ('14', '首页', '0', '0', '1', 'icon-windows', null, '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('30', '网站首页', '14', '0', '1', 'icon-home', 'Index/webcome', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('31', '店铺信息', '14', '0', '1', 'icon-user', 'setting/index', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('32', '订单管理', '0', '0', '1', null, null, '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('33', '未支付订单', '32', '50', '1', 'icon-file-text-o', 'order/index?order_status=0', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('34', '已支付订单', '32', '40', '1', 'icon-file-text-o', 'order/index?order_status=1', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('35', '已发货订单', '32', '20', '1', 'icon-file-text-o', 'order/index?order_status=2', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('36', '商品管理', '0', '0', '1', null, null, '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('37', '商品列表', '36', '0', '1', 'icon-reorder', 'good/index', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('38', '财务', '0', '0', '0', null, null, '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('39', '提现申请', '38', '0', '1', null, 'cash/index', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('40', '提现记录', '38', '0', '1', null, 'cash/record', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('42', '已完成订单', '32', '10', '1', 'icon-file-text-o', 'order/index?order_status=3', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('43', '商品模型', '36', '0', '1', 'icon-reorder', 'goodmodel/index', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('44', '品牌列表', '36', '0', '1', 'icon-reorder', 'goodbrand/index', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('45', '店铺设置', '14', '0', '1', 'icon-user', 'setting/setshop', '1', '1');
INSERT INTO `ysk_seller_menu` VALUES ('46', '评论列表', '36', '0', '1', 'icon-reorder', 'comment/index', '1', '1');

-- ----------------------------
-- Table structure for ysk_shopnew
-- ----------------------------
DROP TABLE IF EXISTS `ysk_shopnew`;
CREATE TABLE `ysk_shopnew` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_shopnew
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_shop_collect
-- ----------------------------
DROP TABLE IF EXISTS `ysk_shop_collect`;
CREATE TABLE `ysk_shop_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_shop_collect
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_shop_info
-- ----------------------------
DROP TABLE IF EXISTS `ysk_shop_info`;
CREATE TABLE `ysk_shop_info` (
  `uid` int(11) NOT NULL,
  `shop_name` varchar(50) DEFAULT NULL,
  `shop_img` varchar(255) DEFAULT NULL COMMENT 'banner图',
  `shop_logo` varchar(255) DEFAULT NULL COMMENT '店铺logo',
  `shop_comment` int(11) NOT NULL DEFAULT '0' COMMENT '店铺评论数',
  `shop_collect` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `respon_name` varchar(20) NOT NULL COMMENT '店铺负责人姓名',
  `respon_mobile` varchar(20) NOT NULL COMMENT '店铺负责人手机',
  `respon_email` varchar(20) NOT NULL COMMENT '店铺负责人邮箱',
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `addresss_detail` varchar(255) NOT NULL COMMENT '详细地址',
  `create_time` int(11) NOT NULL,
  `industry_id` text NOT NULL COMMENT '所属行业',
  `fee` int(255) NOT NULL DEFAULT '0',
  `industry_name` varchar(500) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `server_tel` varchar(20) DEFAULT NULL,
  `work_time` varchar(50) DEFAULT NULL,
  `shop_j` varchar(255) DEFAULT NULL COMMENT '经纬度',
  `shop_w` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_shop_info
-- ----------------------------
INSERT INTO `ysk_shop_info` VALUES ('317', '大禹销售店', '/uploads/temp/2018/03-15/99ad6d1ff0e16365093fab669ee20b7a.jpg', '/uploads/temp/2018/03-15/33275aee56ed45487761dc6ddc563ec7.png', '0', '0', '李明', '13713713701', '123@qq.com', '辽宁省', '鞍山市', '台安县', '大明路138号', '1521120992', ',5,', '8', '百货超市', '发动机覆盖见附件', '4564564', '9:00-18:00', '114.065414', '22.590107');

-- ----------------------------
-- Table structure for ysk_turntable_lv
-- ----------------------------
DROP TABLE IF EXISTS `ysk_turntable_lv`;
CREATE TABLE `ysk_turntable_lv` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '转盘抽奖概率',
  `one` int(11) unsigned NOT NULL DEFAULT '0',
  `two` int(11) unsigned NOT NULL DEFAULT '0',
  `three` int(11) unsigned NOT NULL DEFAULT '0',
  `four` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

-- ----------------------------
-- Records of ysk_turntable_lv
-- ----------------------------
INSERT INTO `ysk_turntable_lv` VALUES ('1', '1', '4', '80', '15');

-- ----------------------------
-- Table structure for ysk_update_order
-- ----------------------------
DROP TABLE IF EXISTS `ysk_update_order`;
CREATE TABLE `ysk_update_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户升级订单',
  `order_no` varchar(20) NOT NULL COMMENT '订单号',
  `money` decimal(11,2) NOT NULL DEFAULT '0.00',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `user_level` int(1) NOT NULL COMMENT '用户等级 0-消费商 1-创客 2-创投',
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未支付 1-已支付',
  `paytype` varchar(20) DEFAULT NULL COMMENT '支付方式',
  `type_name` varchar(255) DEFAULT '' COMMENT '名称 用户升级',
  `pay_time` int(11) NOT NULL COMMENT '付款时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no` (`order_no`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_update_order
-- ----------------------------
INSERT INTO `ysk_update_order` VALUES ('150', 'UD201803152132298515', '999.00', '317', '1', '1521120749', '1', '余额支付', '用户升级', '1521120776');
INSERT INTO `ysk_update_order` VALUES ('151', 'UD201803161339215468', '888.00', '320', '1', '1521178761', '1', '余额支付', '用户升级', '1521182994');

-- ----------------------------
-- Table structure for ysk_update_userinfo
-- ----------------------------
DROP TABLE IF EXISTS `ysk_update_userinfo`;
CREATE TABLE `ysk_update_userinfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '工单表',
  `uid` int(11) NOT NULL DEFAULT '0',
  `update_type` tinyint(1) NOT NULL COMMENT '修改类型 1-修改手机号码 2-修改姓名 3-修改企业名称',
  `new_info` varchar(225) NOT NULL COMMENT '要修改的信息',
  `content` text NOT NULL COMMENT '备注信息',
  `img` varchar(500) NOT NULL COMMENT '证件照',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未审核 1-通过 2-不通过',
  `reply` text COMMENT '回复信息',
  `admin_id` int(11) DEFAULT NULL COMMENT '操作管理员',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  `img_back` varchar(255) DEFAULT NULL COMMENT '身份证反面照',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `update_type` (`update_type`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_update_userinfo
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_upload
-- ----------------------------
DROP TABLE IF EXISTS `ysk_upload`;
CREATE TABLE `ysk_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'UID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `url` varchar(255) DEFAULT NULL COMMENT '文件链接',
  `ext` char(4) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) DEFAULT NULL COMMENT '文件md5',
  `sha1` char(40) DEFAULT NULL COMMENT '文件sha1编码',
  `location` varchar(15) NOT NULL DEFAULT '' COMMENT '文件存储位置',
  `download` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文件上传表';

-- ----------------------------
-- Records of ysk_upload
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_user
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user`;
CREATE TABLE `ysk_user` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL COMMENT '上级ID',
  `gid` int(11) NOT NULL DEFAULT '0' COMMENT '上上级ID',
  `ggid` int(11) NOT NULL COMMENT '上上上级ID',
  `account` char(20) NOT NULL DEFAULT '0' COMMENT '用户账号',
  `mobile` char(20) NOT NULL COMMENT '用户手机号',
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `safety_pwd` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '' COMMENT '安全密码',
  `safety_salt` char(5) CHARACTER SET latin1 NOT NULL,
  `login_pwd` varchar(32) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `login_salt` char(3) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `sex` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-女 1-男',
  `reg_date` int(11) NOT NULL COMMENT '注册时间',
  `reg_ip` varchar(20) NOT NULL COMMENT '注册IP',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户锁定  1 不锁  0拉黑  -1 删除',
  `activate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否激活 1-已激活 0-未激活',
  `session_id` varchar(225) DEFAULT NULL,
  `wx_no` varchar(20) DEFAULT '0' COMMENT '微信',
  `alipay` varchar(20) DEFAULT NULL,
  `idcard` varchar(20) NOT NULL,
  `deep` int(11) NOT NULL DEFAULT '0' COMMENT '层级',
  `path` text NOT NULL,
  `level` tinyint(2) NOT NULL DEFAULT '0' COMMENT '用户等级 0-消费商 1-创客 2-创投 3-联盟商家 4-代理商 5-GA代理商 6-EA代理商',
  `user_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0-个人用户  1-企业用户',
  `head_img` varchar(255) DEFAULT NULL COMMENT '头像',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '银行名称',
  `bank_no` varchar(50) DEFAULT NULL COMMENT '银行卡号',
  `bank_username` varchar(20) DEFAULT NULL COMMENT '姓名',
  `sign_total` int(11) NOT NULL DEFAULT '0' COMMENT '签到总数',
  `jf_daysign` int(11) NOT NULL DEFAULT '0' COMMENT '签到奖励',
  `seller` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-非商家 1-商家',
  `area_province` varchar(255) NOT NULL DEFAULT '',
  `area_city` varchar(255) NOT NULL DEFAULT '',
  `area_district` varchar(255) NOT NULL DEFAULT '',
  `area_type` tinyint(1) NOT NULL COMMENT '1-省级代理 2-市级代理 3-区、县级代理',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `account` (`account`) USING BTREE,
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_user
-- ----------------------------
INSERT INTO `ysk_user` VALUES ('1', '0', '0', '0', 'test0755', '13713713111', '', '', '', '', '8d64f8dff6ae73ca318d9d69c3ad5727', '804', '0', '1521119990', '127.0.0.1', '1', '0', 'n1136a4g42iojml0s20sn9ku11', '0', '', '', '0', '0', '0', '1', '', '', '', '', '0', '0', '0', '', '', '', '0');
INSERT INTO `ysk_user` VALUES ('316', '1', '1', '0', 'test0766', '13713713702', '', '', '', '', 'bbf6f9ca8a1fe76a3fff1675ff4befab', '8ef', '0', '1521120465', '127.0.0.1', '1', '0', null, '0', null, '', '1', '-1-', '0', '0', null, null, null, null, '0', '0', '0', '', '', '', '0');
INSERT INTO `ysk_user` VALUES ('317', '1', '1', '0', 'test123', '13713713701', '深圳网络科技有限公司', '', '2d023a6068626f3cd691b8c457555745', 'd46', '57377d578e14c77a4355a488f81c62e0', '0b9', '0', '1521120559', '127.0.0.1', '1', '0', 'n1136a4g42iojml0s20sn9ku11', '0', null, '', '1', '-1-', '3', '1', null, null, null, null, '0', '0', '1', '', '', '', '0');
INSERT INTO `ysk_user` VALUES ('318', '1', '0', '0', 'test001', '13713713703', '', '', '', '', '3ab7509d09f45ad0fbcd1857a5dfd21a', '631', '0', '1521171194', '127.0.0.1', '1', '0', null, '0', null, '', '1', '-1-', '0', '0', null, null, null, null, '0', '0', '0', '', '', '', '0');
INSERT INTO `ysk_user` VALUES ('319', '317', '1', '1', 'test002', '13713713704', '', '', '', '', '9af13332dabd82d49c1771c3c19031d6', '0c9', '0', '1521171251', '127.0.0.1', '1', '0', null, '0', null, '', '2', '-1-317-', '0', '0', null, null, null, null, '0', '0', '0', '', '', '', '0');
INSERT INTO `ysk_user` VALUES ('320', '319', '317', '1', 'test005', '13713713705', '', '', '955c89cfb56d29205c964b2688e6772c', '102', '955c89cfb56d29205c964b2688e6772c', '102', '0', '1521171306', '127.0.0.1', '1', '0', 'n1136a4g42iojml0s20sn9ku11', '0', null, '', '3', '-1-317-319-', '1', '0', null, null, null, null, '0', '0', '0', '', '', '', '0');

-- ----------------------------
-- Table structure for ysk_user_address
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user_address`;
CREATE TABLE `ysk_user_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `user_name` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人',
  `user_mobile` varchar(60) NOT NULL DEFAULT '' COMMENT '手机',
  `country` varchar(50) DEFAULT '0' COMMENT '国家',
  `province` varchar(50) NOT NULL DEFAULT '0' COMMENT '省份',
  `city` varchar(50) NOT NULL DEFAULT '0' COMMENT '城市',
  `district` varchar(50) NOT NULL DEFAULT '0' COMMENT '地区',
  `detail_address` varchar(120) NOT NULL DEFAULT '' COMMENT '地址',
  `zipcode` varchar(60) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `is_default` tinyint(1) DEFAULT '0' COMMENT '默认收货地址',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_user_address
-- ----------------------------
INSERT INTO `ysk_user_address` VALUES ('1', '317', '测试', '13713713701', '0', '广东', '深圳市', '南山区', '105路25号', '', '1');

-- ----------------------------
-- Table structure for ysk_user_advice
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user_advice`;
CREATE TABLE `ysk_user_advice` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '表单id',
  `create_time` varchar(222) NOT NULL COMMENT '提交时间',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `userid` int(4) NOT NULL COMMENT '用户ID',
  `account` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未读，1已读',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_user_advice
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_user_bank
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user_bank`;
CREATE TABLE `ysk_user_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) NOT NULL,
  `bank_no` varchar(20) NOT NULL,
  `bank_img` varchar(255) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1默认',
  `bank_branch` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`is_default`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_user_bank
-- ----------------------------
INSERT INTO `ysk_user_bank` VALUES ('1', '中国工商银行', '622992052264565', '/static/home/common/images/banks/95588.png', '317', '李明', '1', '深圳支行');

-- ----------------------------
-- Table structure for ysk_user_checkinfo
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user_checkinfo`;
CREATE TABLE `ysk_user_checkinfo` (
  `uid` int(11) NOT NULL,
  `is_check_mobile` tinyint(1) NOT NULL DEFAULT '0' COMMENT '手机认证 0-未认证 1-已认证',
  `province` varchar(50) DEFAULT NULL COMMENT '省',
  `city` varchar(50) DEFAULT NULL COMMENT '市',
  `district` varchar(50) DEFAULT NULL COMMENT '县',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `idcard` varchar(50) DEFAULT NULL,
  `idcar_startdate` date DEFAULT NULL,
  `idcar_endtdate` date DEFAULT NULL,
  `idcard_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-大陆身份证 1-非大陆身份证',
  `idcard_img_face` varchar(200) DEFAULT NULL COMMENT '正面照',
  `idcard_img_back` varchar(200) DEFAULT NULL,
  `idcard_img_hand` varchar(200) DEFAULT NULL,
  `is_check_user` tinyint(1) NOT NULL DEFAULT '0' COMMENT '个人认证 1-审核中 2-审核通过',
  `user_type` tinyint(1) NOT NULL COMMENT '0-个人用户  1-企业用户',
  `is_three_card` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否三证合一  0:1',
  `is_child_company` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否分公司',
  `credit_no` char(200) DEFAULT NULL COMMENT '社会信用代码',
  `tax_no` char(200) DEFAULT NULL COMMENT '税务登记证',
  `organize_no` char(200) DEFAULT NULL COMMENT '组织机构证',
  `legal_name` varchar(20) DEFAULT NULL COMMENT '法人',
  `company_type` varchar(50) DEFAULT NULL COMMENT '公司类型',
  `is_legal` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-法人  1-被授权人',
  `manage_parent` varchar(20) DEFAULT NULL COMMENT '经营负责人',
  `company_name` varchar(50) DEFAULT NULL COMMENT '公司名称',
  `company_license` varchar(50) DEFAULT NULL COMMENT '营业执照',
  `company_organize` varchar(255) DEFAULT NULL COMMENT '组织机构',
  `is_check_company` tinyint(1) NOT NULL DEFAULT '0' COMMENT '公司认证 1-审核中 2-审核通过',
  `company_license_img` varchar(200) DEFAULT NULL COMMENT '营业执照图片',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`uid`),
  KEY `is_check_user` (`is_check_user`,`is_check_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_user_checkinfo
-- ----------------------------
INSERT INTO `ysk_user_checkinfo` VALUES ('1', '0', null, null, null, null, null, null, null, '0', null, null, null, '0', '1', '0', '0', null, null, null, null, null, '0', null, ' 深圳科技有限公司', '457811325444656523', '企业', '0', null, '0');
INSERT INTO `ysk_user_checkinfo` VALUES ('316', '0', null, null, null, null, null, null, null, '0', null, null, null, '0', '0', '0', '0', null, null, null, null, null, '0', null, null, null, null, '0', null, '0');
INSERT INTO `ysk_user_checkinfo` VALUES ('317', '1', '广东省', '深圳市', '南山区', '中国', null, null, null, '0', '/uploads/20180315\\5f50845090a1890642b3f7188692c4be.jpg', '/uploads/20180315\\a5783c559183346fbfff7aef7dd70cd2.jpg', '/uploads/20180315\\4341bf68ed089cb8b0d7688f432eb703.jpg', '0', '1', '1', '0', '4561231234565', '', '', '刘密', '私营企业', '0', '刘密', '深圳网络科技有限公司', '4561231234565', '企业', '2', '/uploads/20180315\\23691280936526dafda65c2eb8bad693.jpg', '1521120838');
INSERT INTO `ysk_user_checkinfo` VALUES ('318', '0', null, null, null, null, null, null, null, '0', null, null, null, '0', '0', '0', '0', null, null, null, null, null, '0', null, null, null, null, '0', null, '0');
INSERT INTO `ysk_user_checkinfo` VALUES ('319', '0', null, null, null, null, null, null, null, '0', null, null, null, '0', '0', '0', '0', null, null, null, null, null, '0', null, null, null, null, '0', null, '0');
INSERT INTO `ysk_user_checkinfo` VALUES ('320', '0', null, null, null, null, null, null, null, '0', null, null, null, '0', '0', '0', '0', null, null, null, null, null, '0', null, null, null, null, '0', null, '0');

-- ----------------------------
-- Table structure for ysk_user_checkinfo_record
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user_checkinfo_record`;
CREATE TABLE `ysk_user_checkinfo_record` (
  `id` int(11) NOT NULL COMMENT '用户审核记录表',
  `uid` int(11) NOT NULL COMMENT '用户ID ',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `province` varchar(50) DEFAULT NULL COMMENT '省',
  `city` varchar(50) DEFAULT NULL COMMENT '市',
  `district` varchar(50) DEFAULT NULL COMMENT '县',
  `idcard` varchar(50) DEFAULT NULL,
  `idcar_startdate` date DEFAULT NULL,
  `idcar_endtdate` date DEFAULT NULL,
  `idcard_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-大陆身份证 1-非大陆身份证',
  `idcard_img_face` varchar(50) DEFAULT NULL COMMENT '正面照',
  `idcard_img_back` varchar(50) DEFAULT NULL,
  `idcard_img_hand` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0-未申请 1-通过审核 2-审核不通过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_user_checkinfo_record
-- ----------------------------

-- ----------------------------
-- Table structure for ysk_user_level
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user_level`;
CREATE TABLE `ysk_user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) NOT NULL COMMENT '等级名称',
  `level` tinyint(2) NOT NULL DEFAULT '0' COMMENT '等级标识',
  `level_fee` decimal(10,1) NOT NULL DEFAULT '0.0' COMMENT '升级费用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_user_level
-- ----------------------------
INSERT INTO `ysk_user_level` VALUES ('1', '消费商', '0', '0.0');
INSERT INTO `ysk_user_level` VALUES ('2', '宏客', '1', '888.0');
INSERT INTO `ysk_user_level` VALUES ('3', '宏投', '2', '8888.0');
INSERT INTO `ysk_user_level` VALUES ('4', '联盟商家', '3', '0.0');
INSERT INTO `ysk_user_level` VALUES ('5', '代理商', '4', '0.0');
INSERT INTO `ysk_user_level` VALUES ('6', 'GA代理商', '5', '0.0');
INSERT INTO `ysk_user_level` VALUES ('7', 'EA代理商', '6', '0.0');

-- ----------------------------
-- Table structure for ysk_user_wealth
-- ----------------------------
DROP TABLE IF EXISTS `ysk_user_wealth`;
CREATE TABLE `ysk_user_wealth` (
  `uid` int(11) NOT NULL,
  `money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `integral` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '积分',
  `anzi` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '安资宝',
  `kucun_integral` decimal(13,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '库存积分',
  `total_money` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '累计销售金额',
  `total_integral` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '积分累计',
  `total_anzi` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '玉贝累计',
  `uptime` char(20) NOT NULL DEFAULT '',
  `uptimeing` datetime NOT NULL,
  `coupon` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '购物券',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysk_user_wealth
-- ----------------------------
INSERT INTO `ysk_user_wealth` VALUES ('1', '0.00', '9375.00', '0.00', '0.00', '0.00', '9375.00', '0.00', '', '0000-00-00 00:00:00', '0.00');
INSERT INTO `ysk_user_wealth` VALUES ('316', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '0000-00-00 00:00:00', '0.00');
INSERT INTO `ysk_user_wealth` VALUES ('317', '8692.00', '153750.00', '8880.00', '147150.00', '0.00', '153750.00', '8880.00', '', '0000-00-00 00:00:00', '35.00');
INSERT INTO `ysk_user_wealth` VALUES ('318', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '0000-00-00 00:00:00', '0.00');
INSERT INTO `ysk_user_wealth` VALUES ('319', '0.00', '125000.00', '0.00', '0.00', '0.00', '125000.00', '0.00', '', '0000-00-00 00:00:00', '0.00');
INSERT INTO `ysk_user_wealth` VALUES ('320', '9112.00', '88800.00', '0.00', '0.00', '0.00', '88800.00', '0.00', '', '0000-00-00 00:00:00', '0.00');

-- ----------------------------
-- Procedure structure for IntegralToAnzi
-- ----------------------------
DROP PROCEDURE IF EXISTS `IntegralToAnzi`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `IntegralToAnzi`()
BEGIN
	 UPDATE ysk_user_wealth SET integral=integral-(integral/10000),anzi=anzi+(integral/10000),total_anzi=total_anzi+(integral/10000),uptime=DATE_FORMAT(now(), '%Y%m%d'),uptimeing=now() WHERE integral>=100 AND uptime != DATE_FORMAT(now(), '%Y%m%d');
END
;;
DELIMITER ;
