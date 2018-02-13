# Dump of table ta_auth_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ta_auth_access`;

CREATE TABLE `ta_auth_access` (
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色',
  `rule_id` mediumint(8) unsigned NOT NULL COMMENT '规则唯一英文标识,全小写',
  KEY `role_id` (`role_id`),
  KEY `rule_name` (`rule_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限授权表';

LOCK TABLES `ta_auth_access` WRITE;
/*!40000 ALTER TABLE `ta_auth_access` DISABLE KEYS */;

INSERT INTO `ta_auth_access` (`role_id`, `rule_id`)
VALUES
  (2,3),
  (1,2),
  (2,1),
  (3,2);

/*!40000 ALTER TABLE `ta_auth_access` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ta_auth_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ta_auth_rule`;

CREATE TABLE `ta_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `rule_val` varchar(255) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父类ID',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限规则表';

LOCK TABLES `ta_auth_rule` WRITE;
/*!40000 ALTER TABLE `ta_auth_rule` DISABLE KEYS */;

INSERT INTO `ta_auth_rule` (`id`, `title`, `rule_val`, `pid`, `update_time`, `delete_time`)
VALUES
  (1,'内容管理','admin/index/index',3,1484209924,NULL),
  (2,'用户管理','admin/user/index',6,1484145913,NULL),
  (3,'Admin/Index','admin/index',0,1483502713,NULL),
  (4,'Admin/Sdd','admin/sdd',0,1484131420,NULL),
  (6,'Admin/User','admin/user',0,1484145913,NULL),
  (7,'niu','admin/user/index',6,NULL,NULL);

/*!40000 ALTER TABLE `ta_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ta_log_record
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ta_log_record`;

CREATE TABLE `ta_log_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `os` varchar(18) DEFAULT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台操作日志记录';

LOCK TABLES `ta_log_record` WRITE;
/*!40000 ALTER TABLE `ta_log_record` DISABLE KEYS */;

INSERT INTO `ta_log_record` (`id`, `user_id`, `ip`, `os`, `browser`, `remark`, `create_time`)
VALUES
  (79,4,'110.184.40.9','Mac OS X 10_12_2','chrome-55','登录成功',1484449096),
  (80,1,'110.184.40.9','Mac OS X 10_12_2','chrome-55','登录成功',1484449112);

/*!40000 ALTER TABLE `ta_log_record` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ta_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ta_role`;

CREATE TABLE `ta_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `pid` smallint(6) DEFAULT NULL COMMENT '父角色ID',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色表';

LOCK TABLES `ta_role` WRITE;
/*!40000 ALTER TABLE `ta_role` DISABLE KEYS */;

INSERT INTO `ta_role` (`id`, `name`, `pid`, `status`, `remark`, `create_time`, `update_time`)
VALUES
  (1,'超级管理员1',0,1,'网站最高管理员权限！',1329633709,1329633709),
  (2,'测试角色',NULL,0,'测试角色',1482389092,0);

/*!40000 ALTER TABLE `ta_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ta_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ta_user`;

CREATE TABLE `ta_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) DEFAULT NULL COMMENT '账号',
  `mobile` varchar(12) DEFAULT NULL COMMENT '手机号',
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `status` int(11) DEFAULT '0' COMMENT '状态 （0禁止 1可用）',
  `create_time` int(11) DEFAULT NULL COMMENT '帐号创建时间',
  `administrator` int(1) DEFAULT '0' COMMENT '是否超级管理员，1是 0否',
  `role_id` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) DEFAULT NULL COMMENT '账户最后更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

LOCK TABLES `ta_user` WRITE;
/*!40000 ALTER TABLE `ta_user` DISABLE KEYS */;

INSERT INTO `ta_user` (`id`, `username`, `mobile`, `password`, `status`, `create_time`, `administrator`, `role_id`, `update_time`, `delete_time`)
VALUES
  (1,'石金融','13330613321','4c3c8afaf91b4dd81bcf68ba519fa2f6',1,1478252401,1,2,1484214600,NULL),
  (3,'程斌','15116041105','4c3c8afaf91b4dd81bcf68ba519fa2f6',1,1483423025,0,0,1483423039,1483423039),
  (2,'管理员','15100000000','4c3c8afaf91b4dd81bcf68ba519fa2f6',1,1482835627,1,2,1484148776,NULL),
  (4,'aierui','13330613322','4c3c8afaf91b4dd81bcf68ba519fa2f6',1,1484448977,0,2,1484448977,NULL),
  (5,'test','13330613012','4c3c8afaf91b4dd81bcf68ba519fa2f6',1,1484449210,0,2,1484449239,1484449239);

/*!40000 ALTER TABLE `ta_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
