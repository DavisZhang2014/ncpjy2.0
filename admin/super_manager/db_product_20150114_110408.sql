-- 日期：2015-01-14 11:04:08
-- ----------------------------
-- Table structure for `tb_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(20) NOT NULL COMMENT '管理员登录名',
  `password` varchar(40) NOT NULL COMMENT '登录密码',
  `sex` char(1) NOT NULL COMMENT '性别',
  `phone` varchar(11) NOT NULL COMMENT '联系方式',
  `role_id` int(4) NOT NULL DEFAULT '1' COMMENT '角色1为数据量管理员，2为订单管理员，3为超级管理员',
  `uniqid` char(40) NOT NULL COMMENT '唯一标示符',
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `reg_time` datetime NOT NULL COMMENT '注册时间',
  `last_time` datetime NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tb_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tb_comment`;
CREATE TABLE `tb_comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '评论编号',
  `order_id` char(16) NOT NULL DEFAULT '0' COMMENT '所属订单',
  `product_id` int(10) NOT NULL COMMENT '评论的商品序号',
  `username` varchar(20) NOT NULL COMMENT '评论人',
  `content` text NOT NULL COMMENT '评论内容',
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '0为未回复，1为已回复',
  `date_time` datetime NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tb_order_items`
-- ----------------------------
DROP TABLE IF EXISTS `tb_order_items`;
CREATE TABLE `tb_order_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` char(16) NOT NULL COMMENT '订单编号',
  `product_id` int(10) NOT NULL COMMENT '商品ID',
  `quantity` int(8) NOT NULL DEFAULT '1' COMMENT '购买数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tb_orders`
-- ----------------------------
DROP TABLE IF EXISTS `tb_orders`;
CREATE TABLE `tb_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `order_id` char(16) NOT NULL COMMENT '订单号',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `re_name` varchar(20) NOT NULL COMMENT '收货人姓名',
  `phone` varchar(11) NOT NULL COMMENT '收货人联系方式',
  `address` varchar(50) NOT NULL COMMENT '收货地址',
  `remarks` varchar(200) DEFAULT NULL COMMENT '备注',
  `order_time` datetime NOT NULL COMMENT '订单时间',
  `deal` int(2) NOT NULL DEFAULT '0' COMMENT '//处理状态0为未处理，1为已发货，2为已完成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tb_product`
-- ----------------------------
DROP TABLE IF EXISTS `tb_product`;
CREATE TABLE `tb_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '食物id',
  `name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '名称',
  `pic` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '图片',
  `variety` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '品种',
  `area` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '产地',
  `sort` int(3) NOT NULL DEFAULT '0' COMMENT '分类',
  `standard` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '规格',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `market_time` date NOT NULL COMMENT '上市时间',
  `content` mediumtext CHARACTER SET utf8 NOT NULL COMMENT '详细介绍',
  `recommend` int(1) NOT NULL DEFAULT '0' COMMENT '推荐',
  `stock` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存量',
  `sell_count` int(10) NOT NULL COMMENT '累计出售总数',
  `date_time` datetime NOT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `tb_reply`
-- ----------------------------
DROP TABLE IF EXISTS `tb_reply`;
CREATE TABLE `tb_reply` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '回复表ID',
  `to_comment_id` int(10) NOT NULL COMMENT '对应评论ID',
  `username` varchar(20) NOT NULL COMMENT '回复人',
  `degree` int(1) NOT NULL COMMENT '0为用户，1为管理员',
  `content` text NOT NULL COMMENT '回复内容',
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '0为未回复，1为已回复',
  `date_time` datetime NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tb_shoppingcart`
-- ----------------------------
DROP TABLE IF EXISTS `tb_shoppingcart`;
CREATE TABLE `tb_shoppingcart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车id',
  `username` varchar(20) NOT NULL COMMENT '所属用户',
  `product_id` int(10) unsigned NOT NULL COMMENT '商品编号',
  `creat_date` datetime NOT NULL COMMENT '购物时间',
  `quantity` int(8) unsigned NOT NULL COMMENT '购买数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '用户名称',
  `uniqid` char(40) CHARACTER SET utf8 NOT NULL COMMENT '唯一标识符',
  `active` char(40) CHARACTER SET utf8 NOT NULL COMMENT '激活',
  `password` char(40) CHARACTER SET utf8 NOT NULL COMMENT '密码',
  `state` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `question` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '验证问题',
  `answer` char(40) CHARACTER SET utf8 NOT NULL COMMENT '验证问题答案',
  `sex` char(1) CHARACTER SET utf8 NOT NULL COMMENT '性别',
  `address` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '收货地址',
  `phone` varchar(11) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '手机号',
  `qq` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT 'QQ',
  `email` varchar(40) CHARACTER SET utf8 NOT NULL COMMENT '邮箱',
  `del` int(1) NOT NULL DEFAULT '0' COMMENT '删除状态',
  `del_time` datetime NOT NULL COMMENT '删除时间',
  `reg_time` datetime NOT NULL COMMENT '注册时间',
  `last_time` datetime NOT NULL COMMENT '上次登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records for `tb_admin`
-- ----------------------------
INSERT INTO `tb_admin` VALUES ('1', 'zhang', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', '18706420596', '1', '1c12a6402bfd00e2e91fa7adee1fed2226480cbc', '1', '2014-12-11 14:02:39', '2015-01-05 15:52:17');
INSERT INTO `tb_admin` VALUES ('2', 'beifeng', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', '18706420596', '3', 'fcd11890ad611af3746bcdff3ef5009a877d7d91', '1', '2015-01-04 16:08:18', '2015-01-14 16:03:55');
INSERT INTO `tb_admin` VALUES ('3', 'shuhui', '7c4a8d09ca3762af61e59520943dc26494f8941b', '男', '18706420596', '2', 'a485a5a8a44812e967ddaa1573fa25b59c029a76', '1', '2015-01-06 15:01:08', '0000-00-00 00:00:00');

-- ----------------------------
-- Records for `tb_order_items`
-- ----------------------------
INSERT INTO `tb_order_items` VALUES ('1', '2014122252541001', '2', '1');

-- ----------------------------
-- Records for `tb_orders`
-- ----------------------------
INSERT INTO `tb_orders` VALUES ('1', '2014122252541001', 'zhang', 'zhang', '18706420596', '青岛大学', 'dsafas', '2014-12-22 09:52:36', '0');

-- ----------------------------
-- Records for `tb_product`
-- ----------------------------
INSERT INTO `tb_product` VALUES ('2', '有机小青菜', '1418638747.jpg', '无', '山东，青岛，张浦农场', '0', '350g', '12.50', '0000-00-00', '清清爽爽的家常菜 就像小时候那般纯正天然的味道
食用建议：青菜炖豆腐、青菜炒香菇等
储存建议：低温避光 冷藏最佳
营养价值：含有丰富的钙、磷、铁，质地柔嫩，味道清香，是蔬菜中含矿物质和维生素最丰富的菜。
食用禁忌：脾胃虚寒、大便溏薄者，不宜多食。', '0', '599', '1', '2014-12-15 18:19:07');
INSERT INTO `tb_product` VALUES ('3', '有机辣椒', '1418639058.jpg', '无', '青岛市崂山区沙子口', '1', '300g', '14.80', '0000-00-00', '有机种植  拒绝使用任何人工激素、化学农药、化肥
、转基因技术。
食用建议： 辣子鸡丁、线椒炒香肠、线椒肉片等
储存建议： 低温避光
营养价值： 所含辣椒素有抗癌功效，另外可增加食欲、降脂减肥。
食用禁忌：支气管炎，胃炎，消化性溃疡，痔疮，结核病者不宜食用。', '0', '100', '0', '2014-12-15 18:24:18');
INSERT INTO `tb_product` VALUES ('4', '有机油麦菜', '1418639231.jpg', '无', '山东省青岛市张浦农场', '1', '300g', '10.90', '0000-00-00', '食用建议：蒜香油麦菜、白灼油麦菜、白灼油麦菜等
储存建议：低温避光 冷藏最佳
营养价值：所含矿物质丰富，具有降低胆固醇、治疗神经衰弱、清燥润肺、化痰止咳等功效，是一种低热量、高营养的蔬菜。
食用禁忌：尚无发现', '0', '100', '0', '2014-12-15 18:27:11');
INSERT INTO `tb_product` VALUES ('5', '猪肉', '1419510894.jpg', '2', '浙江东阳金钩生态农庄', '2', '蹄髈850g', '50.00', '0000-00-00', '金华猪又称 金华两头乌和 义乌两头乌 ，是我国著名的优良猪种之一。金华猪具有成熟早，肉质好，繁殖率高等优良性能，腌制成的“金华火腿”质佳味香，外型美观，蜚声中外。金华猪尾巴较长，比较直，头部和尾部的毛发一般是黑色，体部为白色。 因其头颈部和臀尾部毛为黑色，其余各处为白色，故又称"两头乌"，是全国地方良种猪之-。', '0', '0', '0', '2014-12-25 20:55:00');
INSERT INTO `tb_product` VALUES ('6', '草莓', '1419942627.jpg', '日本红颜草莓', '山东省青岛市张浦农场', '0', '500g', '25.00', '0000-00-00', '红颜草莓是目前日本最新的品种，又名“红颊”，该品种品均果形大，平均单果重15G，果实长圆锥形状，果实表面和内部色泽均成鲜红色，着色一致，外形美观，富有光泽，酸甜可口，可溶性固形物含量平均为11.8%，并且前期果和中后期果的可溶性固形物含量变化相对较小；“红颜”果实硬度适中，不同采摘期和不同栽培方式平均硬度为0.21kg/m2，耐贮运性明显高于“章姬”与“丰香”；香味浓，口感好，品质极佳。
红颜草莓有丰富的营养，较高的营养价值。据测定，每百克草莓果含碳水化合物7.1克，蛋白质1.0克，胡萝卜素30微克，维生素47毫克，钙10毫克，铁1.8毫克。在日本流传着“每天一颗草莓对美容健身大有补益”的说法。', '1', '100', '0', '2014-12-30 20:30:27');
INSERT INTO `tb_product` VALUES ('7', '萝卜', '1419942818.jpg', '有机圆白萝卜', '河南省郸城县阳光农场', '1', '350g', '9.30', '0000-00-00', '食用建议：生吃、凉拌、包饺子、蒸包子、炖肉、炒菜样样好。

储存建议： 低温避光

营养价值： 胡萝卜素含量最高，有益肝明目、提高免疫力的功效。

食用禁忌： 一般人群均可。', '0', '10', '0', '2014-12-30 20:33:38');
INSERT INTO `tb_product` VALUES ('8', '胡萝卜', '1419943064.jpg', '有机胡萝卜', '山东省青岛市张浦农场', '1', '350g', '9.90', '0000-00-00', '食用建议：生吃、凉拌、包饺子、蒸包子、炖肉、炒菜样样好。

储存建议：低温避光

营养价值：胡萝卜素含量最高，有益肝明目、提高免疫力的功效。

食用禁忌：不宜与白萝卜一同食用。', '0', '10', '0', '2014-12-30 20:37:44');
INSERT INTO `tb_product` VALUES ('9', '姬菇', '1419943190.jpg', '生态姬菇', '山东省青岛市张浦农场', '1', '300g', '9.90', '0000-00-00', '食用建议：菠菜炒平菇、茄汁平菇、软炸平菇、平菇山药汤等

储存建议：低温避光

营养价值：平菇性味甘、温，具有追风散寒、舒筋活络的功效；常食平菇可改善新陈代谢，增强体质。  

食用禁忌：脾胃寒湿气滞和患顽固性皮肤瘙痒者不宜食用。', '0', '10', '0', '2014-12-30 20:39:50');
INSERT INTO `tb_product` VALUES ('10', '甘蓝', '1419943398.jpg', '生态绿甘蓝', '山东省青岛市张浦农场', '0', '500g', '6.50', '0000-00-00', '食用建议：可凉拌、清炒、做泡菜、做汤，如：金针菇炒甘蓝、炝甘蓝、甘蓝炒豆腐丝等

储存建议：通风避光 

营养价值：含丰富的维生素C和B.胡萝卜素及多量的维生素U.纤维素及糖等多种营养成分，具有补肾壮腰，健脑填髓，补脾健胃作用。

食用禁忌：皮肤瘙痒、眼部充血者不宜多吃。', '0', '20', '0', '2014-12-30 20:43:18');
INSERT INTO `tb_product` VALUES ('11', '甘蓝', '1420013174.jpg', '生态紫甘蓝', '山东省青岛市张浦农场', '0', '500g', '9.25', '0000-00-00', '食用建议：可凉拌、清炒、做泡菜、做汤，如：金针菇炒甘蓝、炝甘蓝、甘蓝炒豆腐丝等

储存建议：通风避光

营养价值：含丰富的维生素C和B.胡萝卜素及多量的维生素U.纤维素及糖等多种营养成分，具有补肾壮腰，健脑 填髓，补脾健胃作用。

食用禁忌：皮肤瘙痒、眼部充血者不宜多吃。', '0', '10', '0', '2014-12-31 16:06:14');
INSERT INTO `tb_product` VALUES ('12', '芹菜', '1420013366.jpg', '西芹', '山东省青岛市张浦农场', '1', '500g', '8.50', '0000-00-00', '食用建议：芹菜拌豆干、糖醋芹菜、芹菜粳米粥、芹菜羹等。

储存建议：通风避光 

营养价值：含酸性降压成分和大量膳食纤维，可平肝降压、预防癌症。

食用禁忌：不宜炒得熟烂，以免多种无机盐和维生素的流失。', '0', '0', '0', '2014-12-31 16:09:26');
INSERT INTO `tb_product` VALUES ('13', '辣椒', '1420013720.jpg', '青辣椒', '山东省青岛市张浦农场', '0', '300g', '5.50', '0000-00-00', '食用建议： 辣子鸡丁、线椒炒香肠、线椒肉片等

储存建议： 低温避光

营养价值： 所含辣椒素有抗癌功效，另外可增加食欲、降脂减肥。

食用禁忌：支气管炎，胃炎，消化性溃疡，痔疮，结核病者不宜食用。', '0', '10', '0', '2014-12-31 16:15:20');
INSERT INTO `tb_product` VALUES ('14', '白菜', '1420014573.jpg', '大白菜', '山东省青岛市张浦农场', '1', '1000g', '7.90', '0000-00-00', '食用建议：炒食、炖汤、包饺子都可以。

储存建议：低温避光

营养价值：白菜中B族维生素、维生素C、钙、铁、锌的含量较高，有清热解毒、排毒润肠、补钙等功效。

食用禁忌：腹泻病人不宜食用', '0', '10', '0', '2014-12-31 16:29:33');

-- ----------------------------
-- Records for `tb_user`
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'zhang', '1b5ef1a021bd3c74c51ff0690bc3cbc5d22bfb87', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0', '我家的“狗狗”', '4d5cf6a96cf8a438e3ae210bf7b2dac02b6fa1a4', '男', '', '18706420596', '1047580230', '1047580230@qq.com', '0', '0000-00-00 00:00:00', '2014-12-11 13:54:00', '2015-01-09 20:53:38');

