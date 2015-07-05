CREATE TABLE `#__activity` (
  `activity_id` int(11) NOT NULL auto_increment,
  `activity_name` varchar(255) NOT NULL COMMENT '活动名称',
  `store_id` int(11) NOT NULL COMMENT '铺商ID',
  `store_name` varchar(255) NOT NULL COMMENT '商铺名称',
  `description` text COMMENT '描述',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `apply_num` int(11) NOT NULL default '0' COMMENT '申请数量',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `pic` varchar(100) NOT NULL COMMENT '活动图片',
 `apply_time` int(11) DEFAULT NULL COMMENT '申请时间' , `apply_item` varchar(255) DEFAULT NULL COMMENT '申请项目', PRIMARY KEY  (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__activity_member
-- ----------------------------
CREATE TABLE `#__activity_member` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(100) NOT NULL COMMENT '会员名称',
  `member_avator` varchar(100) default NULL COMMENT '会员头像',
  `activity_id` int(11) NOT NULL COMMENT '线下活动ID',
  `apply_time` int(11) NOT NULL COMMENT '申请时间',
 `activity_item` varchar(255) DEFAULT NULL COMMENT '活动项目', PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__admin
-- ----------------------------
CREATE TABLE `#__admin` (
  `admin_id` int(11) NOT NULL auto_increment,
  `admin_name` varchar(100) NOT NULL COMMENT '管理员账号',
  `admin_password` varchar(100) NOT NULL COMMENT '管理员密码',
  `admin_login_time` int(11) default NULL COMMENT '登录时间',
  `admin_login_num` int(11) default NULL COMMENT '登陆次数',
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__adv_position
-- ----------------------------
CREATE TABLE `#__adv_position` (
  `ap_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '广告位置id',
  `ap_name` varchar(100) NOT NULL COMMENT '广告位置名',
  `ap_intro` varchar(255) NOT NULL COMMENT '广告位简介',
  `ap_class` smallint(1) unsigned NOT NULL COMMENT '广告类别：1文字2图片',
  `ap_display` smallint(1) unsigned NOT NULL COMMENT '广告展示方式：0幻灯片1多广告展示2单广告展示',
  `is_use` smallint(1) unsigned NOT NULL COMMENT '广告位是否启用：0不启用1启用',
  `ap_width` int(10) NOT NULL COMMENT '广告位宽度',
  `ap_height` int(10) NOT NULL COMMENT '广告位高度',
  `ap_price` int(10) unsigned NOT NULL COMMENT '广告位单价',
  `adv_num` int(10) unsigned NOT NULL COMMENT '拥有的广告数',
  `click_num` int(10) unsigned NOT NULL COMMENT '广告位点击率',
  `default_content` varchar(100) NOT NULL COMMENT '广告位默认内容',
  `link` varchar(100) default NULL COMMENT '链接',
  PRIMARY KEY  (`ap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__appointment
-- ----------------------------
CREATE TABLE `#__appointment` (
  `id` int(11) NOT NULL auto_increment,
  `store_id` int(11) NOT NULL COMMENT '商铺ID',
  `store_name` varchar(100) NOT NULL COMMENT '商铺名称',
  `person_num` int(5) NOT NULL COMMENT '人数',
  `appointtime` int(11) NOT NULL COMMENT '预约时间',
  `mobile` varchar(100) default NULL COMMENT '手机号码',
  `member_id` int(11) default NULL COMMENT '会员ID',
  `contact` varchar(100) default NULL COMMENT '联系人',
  `type` tinyint(1) default '1' COMMENT '1.普通 2.团购',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__area
-- ----------------------------
CREATE TABLE `#__area` (
  `area_id` int(11) NOT NULL auto_increment,
  `area_name` varchar(255) NOT NULL,
  `parent_area_id` int(11) NOT NULL,
  `add_time` int(11) NOT NULL,
  `first_letter` varchar(2) NOT NULL,
  `area_number` varchar(10) default NULL COMMENT '区号',
  `post` varchar(10) NULL DEFAULT NULL COMMENT '邮编',
  `hot_city` tinyint(1) NOT NULL default '0' COMMENT '0.否 1.是',
  `number` int(11) NOT NULL default '0' COMMENT '数量',
  `area_sort` int(11) NOT NULL COMMENT '排序', 
  PRIMARY KEY  (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for #__article
-- ----------------------------
CREATE TABLE `#__article` (
  `article_id` int(11) NOT NULL auto_increment COMMENT '索引id',
  `ac_id` mediumint(8) unsigned NOT NULL default '0' COMMENT '分类id',
  `article_url` varchar(100) default NULL COMMENT '跳转链接',
  `article_show` tinyint(1) unsigned NOT NULL default '1' COMMENT '是否显示，0为否，1为是，默认为1',
  `article_sort` tinyint(3) unsigned NOT NULL default '255' COMMENT '排序',
  `article_title` varchar(100) default NULL COMMENT '标题',
  `article_content` text COMMENT '内容',
  `article_time` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  PRIMARY KEY  (`article_id`),
  KEY `ac_id` (`ac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Table structure for #__article_class
-- ----------------------------
CREATE TABLE `#__article_class` (
  `ac_id` int(10) unsigned NOT NULL auto_increment COMMENT '索引ID',
  `ac_code` varchar(20) default NULL COMMENT '分类标识码',
  `ac_name` varchar(100) NOT NULL COMMENT '分类名称',
  `ac_parent_id` int(10) unsigned NOT NULL default '0' COMMENT '父ID',
  `ac_sort` tinyint(1) unsigned NOT NULL default '255' COMMENT '排序',
  PRIMARY KEY  (`ac_id`),
  KEY `ac_parent_id` (`ac_parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Table structure for #__brand
-- ----------------------------
CREATE TABLE `#__brand` (
  `brand_id` int(5) NOT NULL auto_increment,
  `brand_name` varchar(100) NOT NULL COMMENT '品牌名称',
  `brand_des` text COMMENT '品牌描述',
  `brand_pic` varchar(100) default NULL COMMENT '品牌图片',
  `brand_sort` int(4) default NULL COMMENT '品牌排序',
  PRIMARY KEY  (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__card_member
-- ----------------------------
CREATE TABLE `#__card_member` (
  `id` int(11) NOT NULL auto_increment,
  `is_use` tinyint(1) NOT NULL default '1' COMMENT '1.未开通 2.开通',
  `card_number` varchar(100) NOT NULL COMMENT '会员卡卡号',
  `total_price` decimal(10,2) NOT NULL COMMENT '消费总额',
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(100) NOT NULL COMMENT '会员名称',
  `store_id` int(11) NOT NULL COMMENT '商铺ID',
  `store_name` varchar(100) NOT NULL COMMENT '铺商名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__card_record
-- ----------------------------
CREATE TABLE `#__card_record` (
  `id` int(11) NOT NULL auto_increment,
  `card_id` int(11) NOT NULL COMMENT '会员卡ID',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `person_number` int(5) default NULL COMMENT '消费人数',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__circle
-- ----------------------------
CREATE TABLE `#__circle` (
  `circle_id` int(11) unsigned NOT NULL auto_increment COMMENT '圈子id',
  `circle_name` varchar(12) NOT NULL COMMENT '圈子名称',
  `circle_desc` varchar(255) default NULL COMMENT '圈子描述',
  `circle_masterid` int(11) unsigned NOT NULL COMMENT '圈主id',
  `circle_mastername` varchar(50) NOT NULL COMMENT '圈主名称',
  `circle_img` varchar(50) default NULL COMMENT '圈子图片',
  `class_id` int(11) unsigned NOT NULL COMMENT '圈子分类',
  `circle_mcount` int(11) unsigned NOT NULL default '0' COMMENT '圈子成员数',
  `circle_thcount` int(11) unsigned NOT NULL default '0' COMMENT '圈子主题数',
  `circle_gcount` int(11) unsigned NOT NULL default '0' COMMENT '圈子商品数',
  `circle_pursuereason` varchar(255) default NULL COMMENT '圈子申请理由',
  `circle_notice` varchar(255) default NULL COMMENT '圈子公告',
  `circle_status` tinyint(3) unsigned NOT NULL COMMENT '圈子状态，0关闭，1开启，2审核中，3审核失败',
  `circle_statusinfo` varchar(255) default NULL COMMENT '关闭或审核失败原因',
  `circle_joinaudit` tinyint(3) unsigned NOT NULL COMMENT '加入圈子时候需要审核，0不需要，1需要',
  `circle_addtime` varchar(10) NOT NULL COMMENT '圈子创建时间',
  `circle_noticetime` varchar(10) default NULL COMMENT '圈子公告更新时间',
  `is_recommend` tinyint(3) unsigned NOT NULL COMMENT '是否推荐 0未推荐，1已推荐',
  `is_hot` tinyint(4) NOT NULL default '0' COMMENT '是否为热门圈子 1是 0否',
  `circle_tag` varchar(60) default NULL COMMENT '圈子标签',
  `new_verifycount` int(5) unsigned NOT NULL default '0' COMMENT '等待审核成员数',
  `new_informcount` int(5) unsigned NOT NULL default '0' COMMENT '等待处理举报数',
  `mapply_open` tinyint(4) NOT NULL default '0' COMMENT '申请管理是否开启 0关闭，1开启',
  `mapply_ml` tinyint(4) NOT NULL default '0' COMMENT '成员级别',
  `new_mapplycount` int(5) unsigned NOT NULL default '0' COMMENT '管理申请数量',
  PRIMARY KEY  (`circle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='圈子表';

-- ----------------------------
-- Table structure for #__circle_affix
-- ----------------------------
CREATE TABLE `#__circle_affix` (
  `affix_id` int(11) unsigned NOT NULL auto_increment COMMENT '附件id',
  `affix_filename` varchar(100) NOT NULL COMMENT '文件名称',
  `affix_filethumb` varchar(100) NOT NULL COMMENT '缩略图名称',
  `affix_filesize` int(10) unsigned NOT NULL COMMENT '文件大小，单位字节',
  `affix_addtime` varchar(10) NOT NULL COMMENT '上传时间',
  `affix_type` tinyint(3) unsigned NOT NULL COMMENT '文件类型 0无 1主题 2评论',
  `member_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `theme_id` int(11) unsigned NOT NULL COMMENT '主题id',
  `reply_id` int(11) unsigned NOT NULL default '0' COMMENT '评论id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  PRIMARY KEY  (`affix_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='附件表';

-- ----------------------------
-- Table structure for #__circle_class
-- ----------------------------
CREATE TABLE `#__circle_class` (
  `class_id` int(11) unsigned NOT NULL auto_increment COMMENT '圈子分类id',
  `class_name` varchar(50) NOT NULL COMMENT '圈子分类名称',
  `class_addtime` varchar(10) NOT NULL COMMENT '圈子分类创建时间',
  `class_sort` tinyint(3) unsigned NOT NULL COMMENT '圈子分类排序',
  `class_status` tinyint(3) unsigned NOT NULL COMMENT '圈子分类状态 0不显示，1显示',
  `is_recommend` tinyint(3) unsigned NOT NULL COMMENT '是否推荐 0未推荐，1已推荐',
  PRIMARY KEY  (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子分类表';

-- ----------------------------
-- Table structure for #__circle_classgc
-- ----------------------------
CREATE TABLE `#__circle_classgc` (
  `class_id` int(11) unsigned NOT NULL COMMENT '圈子分类id',
  `gc_id` int(11) unsigned NOT NULL COMMENT '商品分类id',
  PRIMARY KEY  (`class_id`,`gc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子分类与商品分类关联表';

-- ----------------------------
-- Table structure for #__circle_explog
-- ----------------------------
CREATE TABLE `#__circle_explog` (
  `el_id` int(11) unsigned NOT NULL auto_increment COMMENT '经验日志id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `member_id` int(11) unsigned NOT NULL COMMENT '成员id',
  `member_name` varchar(50) NOT NULL COMMENT '成员名称',
  `el_exp` int(10) NOT NULL COMMENT '获得经验',
  `el_time` varchar(10) NOT NULL COMMENT '获得时间',
  `el_type` tinyint(3) unsigned NOT NULL COMMENT '类型 1管理员操作 2发表话题 3发表回复 4话题被回复 5话题被删除 6回复被删除',
  `el_itemid` varchar(100) NOT NULL COMMENT '信息id',
  `el_desc` varchar(255) NOT NULL COMMENT '描述',
  PRIMARY KEY  (`el_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='经验日志表';

-- ----------------------------
-- Table structure for #__circle_expmember
-- ----------------------------
CREATE TABLE `#__circle_expmember` (
  `member_id` int(11) NOT NULL COMMENT '成员id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `em_exp` int(10) NOT NULL COMMENT '获得经验',
  `em_time` varchar(10) NOT NULL COMMENT '获得时间',
  PRIMARY KEY  (`member_id`,`circle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='成员每天获得经验表';

-- ----------------------------
-- Table structure for #__circle_exptheme
-- ----------------------------
CREATE TABLE `#__circle_exptheme` (
  `theme_id` int(11) unsigned NOT NULL COMMENT '主题id',
  `et_exp` int(10) NOT NULL COMMENT '获得经验',
  `et_time` varchar(10) NOT NULL COMMENT '获得时间',
  PRIMARY KEY  (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主题每天获得经验表';

-- ----------------------------
-- Table structure for #__circle_fs
-- ----------------------------
CREATE TABLE `#__circle_fs` (
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `friendship_id` int(11) unsigned NOT NULL COMMENT '友情圈子id',
  `friendship_name` varchar(11) NOT NULL COMMENT '友情圈子名称',
  `friendship_sort` tinyint(4) unsigned NOT NULL COMMENT '友情圈子排序',
  `friendship_status` tinyint(4) NOT NULL default '1' COMMENT '友情圈子名称 1显示 0隐藏',
  PRIMARY KEY  (`circle_id`,`friendship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情圈子表';

-- ----------------------------
-- Table structure for #__circle_inform
-- ----------------------------
CREATE TABLE `#__circle_inform` (
  `inform_id` int(11) unsigned NOT NULL auto_increment COMMENT '举报id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `circle_name` varchar(12) NOT NULL COMMENT '圈子名称',
  `theme_id` int(11) unsigned NOT NULL COMMENT '话题id',
  `theme_name` varchar(50) NOT NULL COMMENT '主题名称',
  `reply_id` int(11) unsigned NOT NULL COMMENT '回复id',
  `member_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `member_name` varchar(50) NOT NULL COMMENT '会员名称',
  `inform_content` varchar(255) NOT NULL COMMENT '举报内容',
  `inform_time` varchar(10) NOT NULL COMMENT '举报时间',
  `inform_type` tinyint(4) NOT NULL COMMENT '类型 0话题、1回复',
  `inform_state` tinyint(4) NOT NULL COMMENT '状态 0未处理、1已处理',
  `inform_opid` int(11) unsigned NOT NULL default '0' COMMENT '操作人id',
  `inform_opname` varchar(50) NOT NULL default '' COMMENT '操作人名称',
  `inform_opexp` tinyint(4) NOT NULL COMMENT '操作经验',
  `inform_opresult` varchar(255) NOT NULL default '' COMMENT '处理结果',
  PRIMARY KEY  (`inform_id`),
  KEY `circle_id` (`circle_id`,`theme_id`,`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子举报表';

-- ----------------------------
-- Table structure for #__circle_like
-- ----------------------------
CREATE TABLE `#__circle_like` (
  `theme_id` int(11) unsigned NOT NULL COMMENT '主题id',
  `member_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主题赞表';

-- ----------------------------
-- Table structure for #__circle_mapply
-- ----------------------------
CREATE TABLE `#__circle_mapply` (
  `mapply_id` int(11) unsigned NOT NULL auto_increment COMMENT '申请id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `member_id` int(11) unsigned NOT NULL COMMENT '成员id',
  `mapply_reason` varchar(255) NOT NULL COMMENT '申请理由',
  `mapply_time` varchar(10) NOT NULL COMMENT '申请时间',
  PRIMARY KEY  (`mapply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='申请管理表';

-- ----------------------------
-- Table structure for #__circle_member
-- ----------------------------
CREATE TABLE `#__circle_member` (
  `member_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `circle_name` varchar(12) NOT NULL COMMENT '圈子名称',
  `member_name` varchar(50) NOT NULL COMMENT '会员名称',
  `member_avatar` varchar(100) default NULL COMMENT '会员头像',
  `cm_applycontent` varchar(255) default '' COMMENT '申请内容',
  `cm_applytime` varchar(10) NOT NULL COMMENT '申请时间',
  `cm_state` tinyint(3) unsigned NOT NULL default '0' COMMENT '状态 0申请中 1通过 2未通过',
  `cm_intro` varchar(255) default '' COMMENT '自我介绍',
  `cm_jointime` varchar(10) NOT NULL COMMENT '加入时间',
  `cm_level` int(11) NOT NULL default '1' COMMENT '成员级别',
  `cm_levelname` varchar(10) NOT NULL default '初级粉丝' COMMENT '成员头衔',
  `cm_exp` int(10) unsigned NOT NULL default '1' COMMENT '会员经验',
  `cm_nextexp` int(10) NOT NULL default '5' COMMENT '下一级所需经验',
  `is_identity` tinyint(3) unsigned NOT NULL COMMENT '1圈主 2管理 3成员',
  `is_allowspeak` tinyint(3) unsigned NOT NULL default '1' COMMENT '是否允许发言 1允许 0禁止',
  `is_star` tinyint(4) NOT NULL default '0' COMMENT '明星成员 1是 0否',
  `cm_thcount` int(11) unsigned NOT NULL default '0' COMMENT '主题数',
  `cm_comcount` int(11) unsigned NOT NULL default '0' COMMENT '回复数',
  `cm_lastspeaktime` varchar(10) default '' COMMENT '最后发言时间',
  `is_recommend` tinyint(4) NOT NULL default '0' COMMENT '是否推荐 1是 0否',
  PRIMARY KEY  (`member_id`,`circle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子会员表';

-- ----------------------------
-- Table structure for #__circle_ml
-- ----------------------------
CREATE TABLE `#__circle_ml` (
  `circle_id` int(11) unsigned NOT NULL auto_increment COMMENT '圈子id',
  `mlref_id` int(10) default NULL COMMENT '参考头衔id 0为默认 null为自定义',
  `ml_1` varchar(10) NOT NULL COMMENT '1级头衔名称',
  `ml_2` varchar(10) NOT NULL COMMENT '2级头衔名称',
  `ml_3` varchar(10) NOT NULL COMMENT '3级头衔名称',
  `ml_4` varchar(10) NOT NULL COMMENT '4级头衔名称',
  `ml_5` varchar(10) NOT NULL COMMENT '5级头衔名称',
  `ml_6` varchar(10) NOT NULL COMMENT '6级头衔名称',
  `ml_7` varchar(10) NOT NULL COMMENT '7级头衔名称',
  `ml_8` varchar(10) NOT NULL COMMENT '8级头衔名称',
  `ml_9` varchar(10) NOT NULL COMMENT '9级头衔名称',
  `ml_10` varchar(10) NOT NULL COMMENT '10级头衔名称',
  `ml_11` varchar(10) NOT NULL COMMENT '11级头衔名称',
  `ml_12` varchar(10) NOT NULL COMMENT '12级头衔名称',
  `ml_13` varchar(10) NOT NULL COMMENT '13级头衔名称',
  `ml_14` varchar(10) NOT NULL COMMENT '14级头衔名称',
  `ml_15` varchar(10) NOT NULL COMMENT '15级头衔名称',
  `ml_16` varchar(10) NOT NULL COMMENT '16级头衔名称',
  PRIMARY KEY  (`circle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员头衔表';

-- ----------------------------
-- Table structure for #__circle_mldefault
-- ----------------------------
CREATE TABLE `#__circle_mldefault` (
  `mld_id` int(11) NOT NULL auto_increment COMMENT '头衔等级',
  `mld_name` varchar(10) NOT NULL COMMENT '头衔名称',
  `mld_exp` int(10) NOT NULL COMMENT '所需经验值',
  PRIMARY KEY  (`mld_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='成员头衔默认设置表';

-- ----------------------------
-- Table structure for #__circle_mlref
-- ----------------------------
CREATE TABLE `#__circle_mlref` (
  `mlref_id` int(10) NOT NULL auto_increment COMMENT '参考头衔id',
  `mlref_name` varchar(10) NOT NULL COMMENT '参考头衔名称',
  `mlref_addtime` varchar(10) NOT NULL COMMENT '创建时间',
  `mlref_status` tinyint(3) unsigned NOT NULL COMMENT '状态',
  `mlref_1` varchar(10) NOT NULL COMMENT '1级头衔名称',
  `mlref_2` varchar(10) NOT NULL COMMENT '2级头衔名称',
  `mlref_3` varchar(10) NOT NULL COMMENT '3级头衔名称',
  `mlref_4` varchar(10) NOT NULL COMMENT '4级头衔名称',
  `mlref_5` varchar(10) NOT NULL COMMENT '5级头衔名称',
  `mlref_6` varchar(10) NOT NULL COMMENT '6级头衔名称',
  `mlref_7` varchar(10) NOT NULL COMMENT '7级头衔名称',
  `mlref_8` varchar(10) NOT NULL COMMENT '8级头衔名称',
  `mlref_9` varchar(10) NOT NULL COMMENT '9级头衔名称',
  `mlref_10` varchar(10) NOT NULL COMMENT '10级头衔名称',
  `mlref_11` varchar(10) NOT NULL COMMENT '11级头衔名称',
  `mlref_12` varchar(10) NOT NULL COMMENT '12级头衔名称',
  `mlref_13` varchar(10) NOT NULL COMMENT '13级头衔名称',
  `mlref_14` varchar(10) NOT NULL COMMENT '14级头衔名称',
  `mlref_15` varchar(10) NOT NULL COMMENT '15级头衔名称',
  `mlref_16` varchar(10) NOT NULL COMMENT '16级头衔名称',
  PRIMARY KEY  (`mlref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='会员参考头衔表';

-- ----------------------------
-- Table structure for #__circle_recycle
-- ----------------------------
CREATE TABLE `#__circle_recycle` (
  `recycle_id` int(11) unsigned NOT NULL auto_increment COMMENT '回收站id',
  `member_id` int(11) NOT NULL COMMENT '会员id',
  `member_name` varchar(50) NOT NULL COMMENT '会员名称',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `circle_name` varchar(12) NOT NULL COMMENT '圈子名称',
  `theme_name` varchar(50) NOT NULL COMMENT '主题名称',
  `recycle_content` text COMMENT '内容',
  `recycle_opid` int(11) unsigned NOT NULL COMMENT '操作人id',
  `recycle_opname` varchar(50) NOT NULL COMMENT '操作人名称',
  `recycle_type` tinyint(3) unsigned NOT NULL COMMENT '类型 1话题，2回复',
  `recycle_time` varchar(10) NOT NULL COMMENT '操作时间',
  PRIMARY KEY  (`recycle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子回收站表';

-- ----------------------------
-- Table structure for #__circle_thclass
-- ----------------------------
CREATE TABLE `#__circle_thclass` (
  `thclass_id` int(11) NOT NULL auto_increment COMMENT '主题分类id',
  `thclass_name` varchar(20) NOT NULL COMMENT '主题名称',
  `thclass_status` tinyint(3) unsigned NOT NULL default '1' COMMENT '主题状态 1开启，0关闭',
  `is_moderator` tinyint(3) unsigned NOT NULL default '0' COMMENT '管理专属 1是，0否',
  `thclass_sort` tinyint(3) unsigned NOT NULL COMMENT '分类排序',
  `circle_id` int(11) unsigned NOT NULL COMMENT '所属圈子id',
  PRIMARY KEY  (`thclass_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子主题分类表';

-- ----------------------------
-- Table structure for #__circle_theme
-- ----------------------------
CREATE TABLE `#__circle_theme` (
  `theme_id` int(11) unsigned NOT NULL auto_increment COMMENT '主题id',
  `theme_name` varchar(50) NOT NULL COMMENT '主题名称',
  `theme_content` text NOT NULL COMMENT '主题内容',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `circle_name` varchar(12) NOT NULL COMMENT '圈子名称',
  `thclass_id` int(11) unsigned NOT NULL default '0' COMMENT '主题分类id',
  `thclass_name` varchar(20) NOT NULL COMMENT '主题分类名称',
  `member_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `member_name` varchar(50) NOT NULL COMMENT '会员名称',
  `member_avatar` varchar(100) default NULL COMMENT '会员头像',
  `is_identity` tinyint(3) unsigned NOT NULL COMMENT '1圈主 2管理 3成员',
  `theme_addtime` varchar(10) NOT NULL COMMENT '主题发表时间',
  `theme_editname` varchar(50) default NULL COMMENT '编辑人名称',
  `theme_edittime` varchar(10) default NULL COMMENT '主题编辑时间',
  `theme_likecount` int(11) unsigned NOT NULL default '0' COMMENT '喜欢数量',
  `theme_commentcount` int(11) unsigned NOT NULL default '0' COMMENT '评论数量',
  `theme_browsecount` int(11) unsigned NOT NULL default '0' COMMENT '浏览数量',
  `theme_sharecount` int(11) unsigned NOT NULL default '0' COMMENT '分享数量',
  `is_stick` tinyint(3) unsigned NOT NULL default '0' COMMENT '是否置顶 1是  0否',
  `is_digest` tinyint(3) unsigned NOT NULL default '0' COMMENT '是否加精 1是 0否',
  `lastspeak_id` int(11) unsigned default NULL COMMENT '最后发言人id',
  `lastspeak_name` varchar(50) default NULL COMMENT '最后发言人名称',
  `lastspeak_time` varchar(10) default NULL COMMENT '最后发言时间',
  `has_goods` tinyint(3) unsigned NOT NULL default '0' COMMENT '商品标记 1是 0否',
  `has_affix` tinyint(3) unsigned NOT NULL default '0' COMMENT '附件标记 1是 0 否',
  `is_closed` tinyint(4) NOT NULL default '0' COMMENT '屏蔽 1是 0否',
  `is_recommend` tinyint(4) NOT NULL default '0' COMMENT '是否推荐 1是 0否',
  `is_shut` tinyint(4) NOT NULL default '0' COMMENT '主题是否关闭 1是 0否',
  `theme_exp` int(11) unsigned NOT NULL default '0' COMMENT '获得经验',
  `theme_readperm` tinyint(3) unsigned NOT NULL default '0' COMMENT '阅读权限',
  `theme_special` tinyint(3) unsigned NOT NULL default '0' COMMENT '特殊话题 0普通 1投票',
  PRIMARY KEY  (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子主题表';

-- ----------------------------
-- Table structure for #__circle_thg
-- ----------------------------
CREATE TABLE `#__circle_thg` (
  `themegoods_id` int(11) NOT NULL auto_increment COMMENT '主题商品id',
  `theme_id` int(11) NOT NULL COMMENT '主题id',
  `reply_id` int(11) unsigned NOT NULL default '0' COMMENT '回复id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `goods_image` varchar(1000) NOT NULL COMMENT '商品图片',
  `store_id` int(11) NOT NULL COMMENT '店铺id',
  `thg_type` tinyint(4) NOT NULL default '0' COMMENT '商品类型 0为本商城、1为淘宝 默认为0',
  `thg_url` varchar(1000) default NULL COMMENT '商品链接',
  PRIMARY KEY  (`themegoods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主题商品表';

-- ----------------------------
-- Table structure for #__circle_thpoll
-- ----------------------------
CREATE TABLE `#__circle_thpoll` (
  `theme_id` int(11) unsigned NOT NULL COMMENT '话题id',
  `poll_multiple` tinyint(3) unsigned NOT NULL COMMENT '单/多选 0单选、1多选',
  `poll_startime` varchar(10) NOT NULL COMMENT '开始时间',
  `poll_endtime` varchar(10) NOT NULL COMMENT '结束时间',
  `poll_days` tinyint(3) unsigned NOT NULL COMMENT '投票天数',
  `poll_voters` mediumint(8) unsigned NOT NULL default '0' COMMENT '投票参与人数',
  PRIMARY KEY  (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票表';

-- ----------------------------
-- Table structure for #__circle_thpolloption
-- ----------------------------
CREATE TABLE `#__circle_thpolloption` (
  `pollop_id` int(11) unsigned NOT NULL auto_increment COMMENT '投票选项id',
  `theme_id` int(11) unsigned NOT NULL COMMENT '话题id',
  `pollop_option` varchar(80) NOT NULL COMMENT '投票选项',
  `pollop_votes` mediumint(8) unsigned NOT NULL default '0' COMMENT '得票数',
  `pollop_sort` tinyint(3) unsigned NOT NULL default '0' COMMENT '排序',
  `pollop_votername` mediumtext COMMENT '投票者名称',
  PRIMARY KEY  (`pollop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票选项表';

-- ----------------------------
-- Table structure for #__circle_thpollvoter
-- ----------------------------
CREATE TABLE `#__circle_thpollvoter` (
  `theme_id` int(11) unsigned NOT NULL COMMENT '话题id',
  `member_id` int(11) unsigned NOT NULL COMMENT '成员id',
  `member_name` varchar(50) NOT NULL COMMENT '成员名称',
  `pollvo_options` mediumtext NOT NULL COMMENT '投票选项',
  `pollvo_time` varchar(10) NOT NULL COMMENT '投票选项',
  KEY `theme_id` (`theme_id`,`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='成员投票信息表';

-- ----------------------------
-- Table structure for #__circle_threply
-- ----------------------------
CREATE TABLE `#__circle_threply` (
  `theme_id` int(11) unsigned NOT NULL COMMENT '主题id',
  `reply_id` int(11) unsigned NOT NULL auto_increment COMMENT '评论id',
  `circle_id` int(11) unsigned NOT NULL COMMENT '圈子id',
  `member_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `member_name` varchar(50) NOT NULL COMMENT '会员名称',
  `member_avatar` varchar(100) default NULL COMMENT '会员头像',
  `reply_content` text NOT NULL COMMENT '评论内容',
  `reply_addtime` varchar(10) NOT NULL COMMENT '发表时间',
  `reply_replyid` int(11) unsigned default NULL COMMENT '回复楼层id',
  `reply_replyname` varchar(50) default NULL COMMENT '回复楼层会员名称',
  `is_closed` tinyint(4) NOT NULL default '0' COMMENT '屏蔽 1是 0否',
  `reply_exp` int(11) unsigned NOT NULL default '0' COMMENT '获得经验',
  PRIMARY KEY  (`theme_id`,`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主题评论表';

-- ----------------------------
-- Table structure for #__comment
-- ----------------------------
CREATE TABLE `#__comment` (
  `comment_id` int(11) NOT NULL auto_increment,
  `store_id` int(11) NOT NULL COMMENT '线下商铺ID',
  `store_name` varchar(255) NOT NULL COMMENT '商铺名称',
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(255) NOT NULL COMMENT '会员名称',
  `comment` text COMMENT '点评信息',
  `photo` varchar(255) default NULL COMMENT '图片',
  `add_time` int(11) NOT NULL COMMENT '加时间添',
  `person_cost` decimal(10,2) NOT NULL COMMENT '人均消费',
  `parking` varchar(255) default NULL COMMENT '停车情况',
  `comment_type` tinyint(1) default NULL COMMENT '点评类型：1.普通点评 2.团购点评',
  `tags` varchar(255) default NULL COMMENT '标签',
  `is_recommend` tinyint(1) default NULL COMMENT '0.不推荐 1.推荐',
  `amount_score` int(2) default '0' COMMENT '评分',
  `city_id` int(5) default NULL COMMENT '城市ID',
  `flower_num` int(10) UNSIGNED NOT NULL COMMENT '鲜花数',
  `comment_explain` TEXT NOT NULL COMMENT '解释说明',
  `fav_num` INT(10) UNSIGNED NOT NULL COMMENT '收藏数',
  PRIMARY KEY  (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__coupon
-- ----------------------------
CREATE TABLE `#__coupon` (
  `coupon_id` int(11) NOT NULL auto_increment,
  `coupon_name` varchar(255) NOT NULL COMMENT '优惠券名称',
  `coupon_pic` varchar(255) NOT NULL COMMENT '优惠券图片',
  `coupon_start_time` int(11) NOT NULL COMMENT '开始时间',
  `coupon_end_time` int(11) NOT NULL COMMENT '结束时间',
  `coupon_des` text COMMENT '优惠券描述',
  `store_id` int(11) NOT NULL COMMENT '线下商户ID',
  `store_name` varchar(100) NOT NULL COMMENT '商铺名称',
  `message` text COMMENT '短信发送优惠券信息',
  `download_count` int(11) default '0' COMMENT '载下次数',
  `view_count` int(11) default '0' COMMENT '览浏次数',
  `limit` int(11) NOT NULL default '0' COMMENT '惠券优数量',
  `short_message` varchar(255) default NULL COMMENT '短信内容',
  `audit` tinyint(1) NOT NULL default '1' COMMENT '1.待审核 2.审核通过 3.审核未通过',
  `audit_reason` text COMMENT '审核原因',
  `city_id` int(5) default NULL COMMENT '城市ID',
  `is_recommend` tinyint(1) UNSIGNED NOT NULL COMMENT '是否推荐（0不推荐1推荐）',
`download_type` tinyint(1) DEFAULT '1' COMMENT '1.打印 2.短信', PRIMARY KEY  (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__coupon_download
-- ----------------------------
CREATE TABLE `#__coupon_download` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(100) NOT NULL COMMENT '会员名称',
  `coupon_id` int(11) NOT NULL COMMENT '优惠券ID',
  `coupon_name` varchar(100) NOT NULL COMMENT '优惠券名称',
  `download_time` int(11) NOT NULL COMMENT '下载时间',
  `download_type` tinyint(1) NOT NULL default '1' COMMENT '1.打印 2.短信',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__document
-- ----------------------------
CREATE TABLE `#__document` (
  `doc_id` mediumint(11) NOT NULL auto_increment COMMENT 'id',
  `doc_code` varchar(255) NOT NULL COMMENT '调用标识码',
  `doc_title` varchar(255) NOT NULL COMMENT '标题',
  `doc_content` text NOT NULL COMMENT '内容',
  `doc_time` int(10) unsigned NOT NULL COMMENT '添加时间/修改时间',
  PRIMARY KEY  (`doc_id`),
  UNIQUE KEY `doc_code` (`doc_code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='系统文章表';

-- ----------------------------
-- Table structure for #__goods
-- ----------------------------
CREATE TABLE `#__goods` (
  `goods_id` int(11) NOT NULL auto_increment,
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称',
  `goods_price` decimal(10,2) default NULL COMMENT '价格',
  `goods_pic` varchar(255) default NULL COMMENT '商品图片',
  `goods_content` text COMMENT '商品描述',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `store_id` int(11) NOT NULL COMMENT '商铺ID',
  `store_name` varchar(100) NOT NULL COMMENT '铺商名称',
  PRIMARY KEY  (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__groupbuy
-- ----------------------------
CREATE TABLE `#__groupbuy` (
  `group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL COMMENT '团购名称',
  `group_help` text NOT NULL COMMENT '团购说明',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `store_id` int(11) NOT NULL COMMENT '商铺ID',
  `store_name` varchar(255) NOT NULL COMMENT '商铺名称',
  `original_price` decimal(10,2) NOT NULL COMMENT '原始价格',
  `group_price` decimal(10,2) NOT NULL COMMENT '团购价格',
  `buyer_count` int(11) default '0' COMMENT '购团数量',
  `buyer_limit` int(5) default NULL COMMENT '购买上线',
  `buyer_num` int(11) default '0' COMMENT '购买人数',
  `group_intro` text COMMENT '团购介绍',
  `group_pic` varchar(255) default NULL COMMENT '团购图片',
  `publish_time` int(11) NOT NULL COMMENT '发布时间',
  `is_hot` tinyint(1) default '1' COMMENT '1.否 2.是 (热门团购)',
  `is_open` tinyint(1) default '1' COMMENT '1.开启 2.关闭',
  `city_id` int(5) default NULL COMMENT '城市ID',
  `area_id` int(5) default NULL COMMENT '区域ID',
  `mall_id` int(5) default NULL COMMENT '商区ID',
  `class_id` int(5) default NULL COMMENT '大分类ID',
  `s_class_id` int(5) default NULL COMMENT '小分类ID',
  `is_audit` tinyint(1) default '1' COMMENT '1.待审核 2.审核通过 3.审核未通过',
  `settle` INT( 2 ) UNSIGNED NOT NULL COMMENT '分佣比例',
 `is_refund` tinyint(1) DEFAULT '1' COMMENT '1.是 2.否', PRIMARY KEY  (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__member
-- ----------------------------
CREATE TABLE `#__member` (
  `member_id` int(11) NOT NULL auto_increment,
  `member_name` varchar(100) NOT NULL COMMENT '会员账号',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `nickname` varchar(100) NOT NULL COMMENT '昵称',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0.保密 1.男 2.女',
  `email` varchar(100) NOT NULL COMMENT '邮箱地址',
  `mobile` varchar(100) NOT NULL COMMENT '移动电话',
  `zipcode` varchar(100) NOT NULL COMMENT '邮编',
  `shipped_to_name` varchar(100) default NULL COMMENT '收件人',
  `address` varchar(255) default NULL COMMENT '地址',
  `telephone` varchar(20) default NULL COMMENT '庭家电话',
  `usercity` varchar(100) default NULL COMMENT '常居地',
  `avatar` varchar(100) default NULL COMMENT '会员头像',
  `introduce` text COMMENT '自我介绍',
  `login_time` int(11) default NULL COMMENT '登陆时间',
  `login_num` int(11) default '0' COMMENT '登陆次数',
  `comment_num` int(11) default '0' COMMENT '评论数',
  `predeposit` decimal(10,2) default '0.00' COMMENT '存款预',
  `point` int(11) default '0' COMMENT '积分',
  `email_code` varchar(50) default NULL COMMENT '找回密码邮箱验证码',
  `pay_password` VARCHAR(100) NOT NULL COMMENT '预存款支付密码',
  `member_degree` TINYINT(1) UNSIGNED NOT NULL COMMENT '会员等级',
  `member_point` INT(10) UNSIGNED NOT NULL COMMENT '会员积分',
  `member_contribution` INT(10) UNSIGNED NOT NULL COMMENT '会员贡献值',
  `province` VARCHAR(100) NOT NULL COMMENT '省',
  `city` VARCHAR(100) NOT NULL COMMENT '市',
  `district` VARCHAR(100) NOT NULL COMMENT '区',
  `register_time` INT(10) UNSIGNED NOT NULL COMMENT '注册时间',
  PRIMARY KEY  (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__member_more
-- ----------------------------
CREATE TABLE `#__member_more` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `card_number` int(11) default NULL COMMENT '会员卡号',
  `weight` tinyint(1) default NULL COMMENT '体重',
  `member_state` tinyint(1) default NULL COMMENT '个人状态',
  `birthday` varchar(50) default NULL COMMENT '日生',
  `constellation` tinyint(1) default NULL COMMENT '星座',
  `member_qq` VARCHAR(20) default NULL COMMENT 'qq',
  `industry` varchar(100) default NULL COMMENT '行业',
  `college` varchar(100) default NULL COMMENT '大学',
  `hobby` varchar(255) default NULL COMMENT '爱好',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__navigation
-- ----------------------------
CREATE TABLE `#__navigation` (
  `nav_id` int(11) NOT NULL auto_increment COMMENT '索引ID',
  `nav_type` tinyint(1) NOT NULL default '0' COMMENT '类别，0自定义导航，1商品分类，2文章导航，3活动导航，默认为0',
  `nav_title` varchar(100) default NULL COMMENT '导航标题',
  `nav_url` varchar(255) default NULL COMMENT '导航链接',
  `nav_location` tinyint(1) NOT NULL default '0' COMMENT '导航位置，0头部，1中部，2底部，默认为0',
  `nav_new_open` tinyint(1) NOT NULL default '0' COMMENT '是否以新窗口打开，0为否，1为是，默认为0',
  `nav_sort` tinyint(3) unsigned NOT NULL default '255' COMMENT '排序',
  `item_id` int(10) unsigned NOT NULL default '0' COMMENT '类别ID，对应着nav_type中的内容，默认为0',
  `nav_byname` varchar(40) default NULL COMMENT '导航判断别名',
  PRIMARY KEY  (`nav_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='页面导航表';

-- ----------------------------
-- Table structure for #__order
-- ----------------------------
CREATE TABLE `#__order` (
  `order_id` int(11) NOT NULL auto_increment,
  `order_sn` bigint(20) NOT NULL COMMENT '订单编号（内部）',
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(100) NOT NULL COMMENT '会员名称',
  `mobile` bigint(20) NOT NULL COMMENT '手机号',
  `store_id` int(11) NOT NULL COMMENT '商铺ID',
  `store_name` varchar(100) NOT NULL COMMENT '商铺名称',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `order_type` tinyint(1) NOT NULL default '1' COMMENT '1.团购 2.代金券',
  `item_id` int(11) NOT NULL COMMENT '项目ID',
  `item_name` varchar(255) NOT NULL COMMENT '名称',
  `number` int(5) default NULL COMMENT '数量',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `state` tinyint(1) NOT NULL COMMENT '状态 1.未支付 2.已支付 3.已消费',
  `order_out` bigint(20) NOT NULL COMMENT '订单编号（外部）',
  `use_time` INT( 10 ) UNSIGNED NOT NULL COMMENT '消费时间',
  PRIMARY KEY  (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__order_pwd
-- ----------------------------
CREATE TABLE `#__order_pwd` (
  `order_group_id` int(11) NOT NULL auto_increment,
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `state` tinyint(1) NOT NULL default '1' COMMENT '1.未使用 2.已使用 3.已锁定',
  `order_pwd` varchar(100) NOT NULL COMMENT '密码',
  `use_time` int(11) default NULL COMMENT '使用时间',
  PRIMARY KEY  (`order_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__payment
-- ----------------------------
CREATE TABLE `#__payment` (
  `payment_id` tinyint(1) unsigned NOT NULL COMMENT '支付索引id',
  `payment_code` char(10) NOT NULL COMMENT '支付代码名称',
  `payment_name` varchar(20) NOT NULL COMMENT '支付名称',
  `payment_info` varchar(255) default NULL COMMENT '支付接口介绍',
  `payment_config` text COMMENT '支付接口配置信息',
  `payment_online` tinyint(1) unsigned default '0' COMMENT '是否为在线接口，1是，0否',
  `payment_state` tinyint(1) unsigned default '1' COMMENT '接口状态，1可用，2不可用',
  PRIMARY KEY  (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__predeposit_charge
-- ----------------------------
CREATE TABLE `#__predeposit_charge` (
  `pre_id` int(11) NOT NULL auto_increment,
  `pdr_sn` varchar(100) NOT NULL COMMENT '记录唯一标示',
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(255) NOT NULL COMMENT '会员名称',
  `payment` tinyint(1) NOT NULL COMMENT '充值方式',
  `payment_name` varchar(100) NOT NULL COMMENT '支付方式名称',
  `charge_price` decimal(10,2) NOT NULL COMMENT '充值金额',
  `charge_des` text COMMENT '充值描述',
  `charge_time` int(11) NOT NULL COMMENT '充值时间',
  `state` tinyint(1) default '1' COMMENT '1.未支付 2.已支付',
  PRIMARY KEY  (`pre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__seo
-- ----------------------------
CREATE TABLE `#__seo` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `keywords` varchar(255) NOT NULL COMMENT '关键词',
  `description` text NOT NULL COMMENT '描述',
  `type` varchar(20) NOT NULL COMMENT '类型',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__setting
-- ----------------------------
CREATE TABLE `#__setting` (
  `name` varchar(20) NOT NULL,
  `value` text,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__store
-- ----------------------------
CREATE TABLE `#__store` (
  `store_id` int(11) NOT NULL auto_increment COMMENT '线下商城ID',
  `account` varchar(255) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `class_id` int(11) NOT NULL COMMENT '分类ID',
  `s_class_id` int(11) NOT NULL COMMENT '分类ID',
  `store_name` varchar(255) NOT NULL COMMENT '线下店铺名称',
  `alisa` varchar(100) default NULL COMMENT '别名',
  `store_click` int(11) default '0' COMMENT '点击数',
  `comment_count` int(11) default '0' COMMENT '评论数',
  `groupbuy_num` int(11) DEFAULT '0' COMMENT '团购数',
  `person_consume` decimal(11,2) default '0.00' COMMENT '人均消费',
  `telephone` varchar(20) default NULL COMMENT '联系电话',
  `city_id` int(5) NOT NULL COMMENT '市城ID',
  `area_id` int(5) NOT NULL COMMENT '区域ID',
  `mall_id` int(5) NOT NULL COMMENT '商区ID',
  `address` varchar(100) default NULL COMMENT '地址',
  `description` text COMMENT '描述',
  `logo` varchar(100) default NULL COMMENT '商铺Logo',
  `pic` varchar(100) default NULL COMMENT '商铺图片',
  `side` varchar(100) default NULL COMMENT '靠近',
  `business_hour` varchar(100) default NULL COMMENT '营业时间',
  `bus` varchar(100) default NULL COMMENT '公交线路',
  `subway` varchar(100) default NULL COMMENT '地铁线路',
  `map` varchar(11) default NULL COMMENT '地图',
  `add_time` int(11) default NULL COMMENT '开店时间',
  `label` text COMMENT '标签',
  `is_card` tinyint(1) default '0' COMMENT '0.未开启 1.开启',
  `card_discount` decimal(10,2) default '0.00' COMMENT '会员卡折扣',
  `card_des` text COMMENT '会员卡描述',
  `card_pic` varchar(100) default NULL COMMENT '员会卡图片',
  `store_state` tinyint(1) NOT NULL default '1' COMMENT '1.创建 2.开启 3.关闭',
  `close_reason` text COMMENT '关闭原因',
  `wx_account` varchar(100) default NULL COMMENT '微信公共账号',
  `qr_code` varchar(100) default NULL COMMENT '微信二维码图片',
  `is_brand` tinyint(1) default '1' COMMENT '1.否 2.是',
  `brand_id` int(5) default NULL COMMENT '品牌ID',
  `is_audit` tinyint(1) default '1' COMMENT '1.待审核 2.审核通过 3.审核未通过',
  `is_appointment` tinyint(1) default '1' COMMENT '1.不开启 2.开启',
  `appointment_pic` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `email_code` varchar(255) default NULL COMMENT '邮箱验证码',
  `seo_title` varchar(255) DEFAULT NULL COMMENT 'seo标题',
  `seo_keyword` varchar(255) DEFAULT NULL COMMENT 'seo关键词',
  `seo_description` varchar(255) DEFAULT NULL COMMENT 'seo描述',
  `is_qr_saft` tinyint(1) DEFAULT '1' COMMENT '1.待审核 2.审核通过 3.审核不通过',
  `store_recommend` TINYINT(1) UNSIGNED NOT NULL COMMENT '是否首页推荐1是0否',
 
  `store_score` INT(2) UNSIGNED NOT NULL COMMENT '店铺得分',
  
  `avatar` VARCHAR(100) NOT NULL COMMENT '商户中心头像',
  
  `store_subdomain` VARCHAR(100) NOT NULL COMMENT '二级域名',
  PRIMARY KEY  (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Table structure for #__store_class
-- ----------------------------
CREATE TABLE `#__store_class` (
  `class_id` int(11) NOT NULL auto_increment,
  `class_name` varchar(255) NOT NULL COMMENT '分类名称',
  `parent_class_id` int(11) NOT NULL COMMENT '父类class_id',
  `class_sort` int(2) default NULL COMMENT '分类排序',
  `class_image` varchar(255) default NULL COMMENT '分类图片',
  `class_recommend` TINYINT( 1 ) UNSIGNED NOT NULL COMMENT '是否推荐（0不推荐1推荐）',
  `class_settle` INT(2) UNSIGNED NOT NULL COMMENT '佣金比例',
  PRIMARY KEY  (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

CREATE TABLE `#__refund` (
  `refund_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `order_sn` varchar(255) NOT NULL COMMENT '订单号',
  `order_pwd` varchar(100) NOT NULL COMMENT '团购券ID',
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(255) NOT NULL COMMENT '会员名称',
  `store_id` int(11) NOT NULL COMMENT '店铺ID',
  `store_name` varchar(255) NOT NULL,
  `refund_price` decimal(10,2) NOT NULL COMMENT '价格',
  `audit` tinyint(1) DEFAULT '1' COMMENT '1.待审核 2.审核通过 3.审核不通过',
  PRIMARY KEY (`refund_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `#__groupbuy_remind` (
  `remind_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(255) NOT NULL COMMENT '会员名称',
  `store_id` int(11) NOT NULL COMMENT '店铺ID',
  `store_name` varchar(255) NOT NULL COMMENT '店铺名称',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`remind_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `#__groupbuy_remind` (
  `remind_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(255) NOT NULL COMMENT '会员名称',
  `store_id` int(11) NOT NULL COMMENT '店铺ID',
  `store_name` varchar(255) NOT NULL COMMENT '店铺名称',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`remind_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `#__predeposit_log` (
  `pl_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `member_name` varchar(255) NOT NULL COMMENT '会员名称',
  `type` tinyint(1) DEFAULT '1' COMMENT '1.添加 2.减少',
  `content` text COMMENT '说明',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`pl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__store_label
-- ----------------------------
CREATE TABLE `#__store_label` (
  `label_id` int(11) NOT NULL auto_increment,
  `store_id` int(11) NOT NULL COMMENT '商铺ID',
  `label_name` varchar(255) NOT NULL COMMENT '标签名称',
  `label_num` int(11) NOT NULL default '0' COMMENT '签标数量',
  PRIMARY KEY  (`label_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__upload
-- ----------------------------
CREATE TABLE `#__upload` (
  `upload_id` int(10) unsigned NOT NULL auto_increment COMMENT '索引ID',
  `file_name` varchar(100) default NULL COMMENT '文件名',
  `file_thumb` varchar(100) default NULL COMMENT '缩微图片',
  `file_wm` varchar(100) default NULL COMMENT '水印图片',
  `file_size` int(10) unsigned NOT NULL default '0' COMMENT '文件大小',
  `store_id` int(10) unsigned NOT NULL default '0' COMMENT '店铺ID，0为管理员',
  `upload_type` tinyint(1) NOT NULL default '0' COMMENT '文件类别，0为无，1为文章图片，默认为0，2为商品切换图片，3为商品内容图片，4为系统文章图片，5为积分礼品切换图片，6为积分礼品内容图片',
  `upload_time` int(10) unsigned NOT NULL default '0' COMMENT '添加时间',
  `item_id` int(11) unsigned NOT NULL default '0' COMMENT '信息ID',
  PRIMARY KEY  (`upload_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='上传文件表';

-- ----------------------------
-- Table structure for #__favorites
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__favorites` (
  `member_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `fav_id` int(10) unsigned NOT NULL COMMENT '收藏ID',
  `fav_type` varchar(20) NOT NULL COMMENT '收藏类型',
  `fav_time` int(10) unsigned NOT NULL COMMENT '收藏时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for #__settle
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__settle` (
  `settle_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `settle_sn` VARCHAR(100) NOT NULL COMMENT '结算单号',
  `store_id` int(11) unsigned NOT NULL,
  `store_name` varchar(200) NOT NULL,
  `date_start` int(10) unsigned NOT NULL,
  `date_end` int(10) unsigned NOT NULL,
  `amount` decimal(10,2) unsigned NOT NULL COMMENT '总金额',
  `final_pay` decimal(10,2) unsigned NOT NULL COMMENT '最终支付金额',
  `state` tinyint(1) unsigned NOT NULL COMMENT '结算状态1.已出账2.已审核3.已确认4.已支付5.已完成',
  `settle_time` INT(10) UNSIGNED NOT NULL COMMENT '结算日期',
  PRIMARY KEY (`settle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='结算表' AUTO_INCREMENT=1 ;

-- ----------------------------
-- Table structure for #__score_setting
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__score_setting` (
  `ss_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `ss_code` varchar(100) NOT NULL COMMENT '项目编码',
  `ss_name` varchar(200) NOT NULL COMMENT '项目名称',
  `ss_contribution` int(10) unsigned NOT NULL COMMENT '获得贡献值',
  `ss_point` int(10) unsigned NOT NULL COMMENT '获得积分',
  PRIMARY KEY (`ss_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员分数设置表';

-- ----------------------------
-- Table structure for #__member_degree
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__member_degree` (
  `md_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `md_name` varchar(200) NOT NULL COMMENT '等级名称',
  `md_from` int(10) unsigned NOT NULL COMMENT '等级最小贡献值',
  `md_to` int(10) unsigned NOT NULL COMMENT '等级最大贡献值',
  PRIMARY KEY (`md_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员等级表';

-- ----------------------------
-- Table structure for #__gift
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__gift` (
  `sg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '礼品ID',
  `sg_name` varchar(1000) NOT NULL COMMENT '礼品名称',
  `sg_point` int(10) unsigned NOT NULL COMMENT '兑换积分',
  `sg_price` decimal(10,2) unsigned NOT NULL COMMENT '市场价格',
  `sg_code` varchar(50) NOT NULL COMMENT '礼品编号',
  `sg_num` int(10) unsigned NOT NULL COMMENT '库存数量',
  `sg_intro` text NOT NULL COMMENT '礼品介绍',
  `sg_member_degree` tinyint(1) unsigned NOT NULL COMMENT '会员等级限制',
  `sg_add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `sg_last_change_time` int(10) unsigned NOT NULL COMMENT '最后修改时间',
  `sg_limit_num` int(10) unsigned NOT NULL COMMENT '限制兑换数量',
  `sg_sale` tinyint(1) unsigned NOT NULL COMMENT '是否上架（0下架1上架）',
  `sg_recommend` tinyint(1) unsigned NOT NULL COMMENT '是否推荐（0不推荐1推荐）',
  `sg_pic` varchar(100) NOT NULL COMMENT '礼品图片',
  `sg_sale_num` INT(10) UNSIGNED NOT NULL COMMENT '兑换数量',
  PRIMARY KEY (`sg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='礼品表';

-- ----------------------------
-- Table structure for #__gift_order
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__gift_order` (
  `go_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '礼品订单ID',
  `go_sn` varchar(100) NOT NULL COMMENT '订单编号',
  `member_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `member_name` varchar(100) NOT NULL COMMENT '会员名',
  `sg_id` int(10) unsigned NOT NULL COMMENT '礼品ID',
  `sg_name` varchar(1000) NOT NULL COMMENT '礼品名',
  `go_num` int(10) unsigned NOT NULL COMMENT '兑换数量',
  `go_unit_point` int(10) unsigned NOT NULL COMMENT '单件积分',
  `go_total_point` int(10) unsigned NOT NULL COMMENT '总消耗积分',
  `go_address` varchar(2000) NOT NULL COMMENT '送货地址',
  `go_contact` varchar(100) NOT NULL COMMENT '收货人',
  `go_phone` varchar(100) NOT NULL COMMENT '电话',
  `go_zipcode` varchar(100) NOT NULL COMMENT '邮政编码',
  `go_state` tinyint(1) unsigned NOT NULL COMMENT '订单状态（1已下单2已发货3已收货）',
  `go_add_time` int(10) unsigned NOT NULL COMMENT '下单时间',
  `go_change_time` int(10) unsigned NOT NULL COMMENT '最后订单状态修改时间',
  PRIMARY KEY (`go_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='礼品订单表';

-- ----------------------------
-- Table structure for #__point_log
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__point_log` (
  `pl_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `member_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `pl_type` tinyint(1) unsigned NOT NULL COMMENT '类型（1贡献值2积分值）',
  `pl_change_score` int(10) NOT NULL COMMENT '变动积分数',
  `pl_total_score` int(10) NOT NULL COMMENT '变动后积分数',
  `pl_time` int(10) unsigned NOT NULL COMMENT '变动时间',
  `pl_note` varchar(1000) NOT NULL COMMENT '变动说明',
  PRIMARY KEY (`pl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员分数日志表';

-- ----------------------------
-- Table structure for #__comment_pic
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__comment_pic` (
  `cp_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论图片ID',
  `pic_name` varchar(100) NOT NULL COMMENT '图片名称',
  `member_id` int(11) unsigned NOT NULL COMMENT '会员ID',
  `member_name` VARCHAR(100) NOT NULL COMMENT '用户名',
  `comment_id` int(11) unsigned NOT NULL COMMENT '评论ID',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `store_id` INT(11) UNSIGNED NOT NULL COMMENT '店铺ID',
  `store_name` VARCHAR(100) NOT NULL COMMENT '店铺名',
  PRIMARY KEY (`cp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='点评图片表';

-- ----------------------------
-- Records 
-- ----------------------------

INSERT INTO `#__adv_position` VALUES ('10', '优惠券列表页侧栏广告位', '', '2', '0', '1', '220', '350', '0', '0', '0', '2718796e982d531864806e4217259567.gif', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('9', '首页底部广告位', '', '2', '0', '1', '1200', '100', '0', '0', '0', 'e24664cc23e46ddecc43f310d444c1e2.jpg', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('5', '首页轮播banner1', '', '2', '0', '1', '1920', '410', '0', '0', '0', '82e65899d9ff4e44674ab8c30a7dafd7.jpg', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('6', '首页轮播banner2', '', '2', '0', '1', '1920', '410', '0', '0', '0', '176918402a1e91a3c28a97ea7f8eda4f.jpg', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('7', '首页轮播banner3', '', '2', '0', '1', '1920', '410', '0', '0', '0', '890b7535f8f2c2ef602dff51061c9df6.jpg', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('8', '首页轮播banner4', '', '2', '0', '1', '1920', '410', '0', '0', '0', 'f5295d2197a1857cc6914f233d67019b.jpg', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('11', '优惠券详细页侧栏广告位', '', '2', '0', '1', '220', '350', '0', '0', '0', 'd054f34d609ae0c10d7d1280a8b8cf3a.gif', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('12', '优惠券详细页底部广告位', '', '2', '0', '1', '740', '100', '0', '0', '0', '906ce8f4eb5e94e9786a169561c427b7.gif', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('13', '商户列表页侧栏广告位', '', '2', '0', '1', '220', '350', '0', '0', '0', '9969a980e5fee3fa2e5620f74356cde5.gif', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('14', '团购列表页侧栏广告位', '', '2', '0', '1', '220', '350', '0', '0', '0', 'bd1389c259e55a5675dc481b3c63759c.gif', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('15', '团购详细页侧栏广告位', '', '2', '0', '1', '220', '350', '0', '0', '0', 'a3f8941d5f15b6ea770d08e01c56365d.gif', 'http://www.shopnc.net');
INSERT INTO `#__adv_position` VALUES ('16', '团购详细页底部广告位', '', '2', '0', '1', '740', '100', '0', '0', '0', '59b4c26442af27fe8bc689cef5fd2814.gif', 'http://www.shopnc.net');
INSERT INTO `#__area` VALUES ('1', '天津', '0', '1381561229', 'T', '022', '30000', '1', '0', '0');
INSERT INTO `#__area` VALUES ('2', '北京', '0', '1368172202', 'B', '010', '0', '1', '0', '0');
INSERT INTO `#__area` VALUES ('3', '南开区', '1', '1372663934', 'A', '', '0', '1', '1', '0');
INSERT INTO `#__area` VALUES ('84', '阿里', '0', '1376357672', 'A', '', '0', '0', '0', '0');
INSERT INTO `#__area` VALUES ('5', '和平区', '1', '1363832792', 'H', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('6', '大悦城', '3', '1372663964', 'D', '', '0', '1', '0', '0');
INSERT INTO `#__area` VALUES ('7', '鞍山', '0', '1367830248', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('8', '安顺', '0', '1367830274', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('9', '阿坝', '0', '1367830293', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('10', '阿拉善', '0', '1367830301', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('85', '安康', '0', '1367889614', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('12', '包头', '0', '1367830350', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('13', '保定', '0', '1367830358', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('14', '巴中', '0', '1367830379', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('15', '成都', '0', '1367830392', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('16', '重庆', '0', '1367830411', 'C', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('17', '常州', '0', '1367830422', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('18', '长沙', '0', '1367830434', 'C', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('19', '长春', '0', '1367830446', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('20', '东莞', '0', '1367830459', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('21', '大连', '0', '1367830469', 'D', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('22', '东营', '0', '1367830479', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('23', '大庆', '0', '1367830489', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('24', '大同', '0', '1367830498', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('25', '恩施', '0', '1367830508', 'E', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('26', '鄂州', '0', '1367830518', 'E', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('27', '鄂尔多斯', '0', '1367830530', 'E', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('28', '福州', '0', '1367830542', 'F', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('29', '佛山', '0', '1367830555', 'F', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('30', '抚顺', '0', '1367830566', 'F', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('31', '阜阳', '0', '1367830578', 'F', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('32', '抚州', '0', '1367830590', 'F', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('33', '广州', '0', '1367830602', 'G', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('34', '贵阳', '0', '1367830612', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('35', '桂林', '0', '1367830622', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('36', '赣州', '0', '1367830635', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('37', '广元', '0', '1367830646', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('38', '杭州', '0', '1367830659', 'H', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('39', '哈尔滨', '0', '1367830670', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('40', '合肥', '0', '1367830683', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('41', '邯郸', '0', '1367830694', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('42', '惠州', '0', '1367830706', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('43', '济南', '0', '1367830720', 'J', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('44', '济宁', '0', '1367830732', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('45', '嘉兴', '0', '1367830769', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('46', '昆明', '0', '1367830783', 'K', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('47', '昆山', '0', '1367830792', 'K', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('48', '喀什', '0', '1367830803', 'K', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('49', '克拉玛依', '0', '1367830814', 'K', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('50', '兰州', '0', '1367830827', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('51', '临沂', '0', '1367830836', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('52', '连云港', '0', '1367830846', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('53', '马鞍山', '0', '1367830858', 'M', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('54', '绵阳', '0', '1367830867', 'M', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('55', '茂名', '0', '1367830878', 'M', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('56', '南京', '0', '1367830891', 'N', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('57', '宁波', '0', '1367830902', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('58', '南通', '0', '1367830914', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('59', '萍乡', '0', '1367830930', 'P', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('60', '平顶山', '0', '1367830940', 'P', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('61', '莆田', '0', '1367830951', 'P', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('62', '青岛', '0', '1367830963', 'Q', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('63', '泉州', '0', '1367830973', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('64', '秦皇岛', '0', '1367830983', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('65', '日照', '0', '1367830998', 'R', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('66', '日喀则', '0', '1367831009', 'R', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('67', '上海', '0', '1367831021', 'S', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('68', '深圳', '0', '1367831032', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('69', '沈阳', '0', '1367831042', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('70', '太原', '0', '1367831057', 'T', null, null, '1', '0', '0');
INSERT INTO `#__area` VALUES ('71', '泰安', '0', '1367831068', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('72', '武汉', '0', '1367831089', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('73', '无锡', '0', '1367831100', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('74', '温州', '0', '1367831112', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('75', '西安', '0', '1367831123', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('76', '西安', '0', '1367831133', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('77', '徐州', '0', '1367831146', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('78', '扬州', '0', '1367831158', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('79', '烟台', '0', '1367831168', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('80', '盐城', '0', '1367831180', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('81', '郑州', '0', '1367831190', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('82', '镇江', '0', '1367831200', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('83', '中山', '0', '1367831213', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('86', '阿克苏', '0', '1367889622', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('87', '安庆', '0', '1367889629', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('88', '阿勒泰', '0', '1367889638', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('89', '安阳', '0', '1367889646', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('90', '澳门', '0', '1367889653', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('91', '巴州', '0', '1367889663', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('92', '亳州', '0', '1367889677', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('93', '滨州', '0', '1367889687', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('94', '博尔塔拉', '0', '1367889697', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('95', '毕节', '0', '1367889707', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('96', '保山', '0', '1367889719', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('97', '本溪', '0', '1367889728', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('98', '百色', '0', '1367889738', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('99', '宝鸡', '0', '1367889748', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('100', '巴彦淖尔', '0', '1367889757', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('101', '北海', '0', '1367889766', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('102', '北海', '0', '1367889775', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('103', '白城', '0', '1367889785', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('104', '白银', '0', '1367889797', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('105', '承德', '0', '1367889808', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('106', '池州', '0', '1367889817', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('107', '昌都', '0', '1367889826', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('108', '朝阳', '0', '1367889834', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('109', '滁州', '0', '1367889845', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('110', '常德', '0', '1367889856', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('111', '郴州', '0', '1367889865', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('112', '沧州', '0', '1367889875', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('113', '昌吉', '0', '1367889885', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('114', '潮州', '0', '1367889895', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('115', '崇左', '0', '1367889906', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('116', '巢湖', '0', '1367889915', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('117', '长治', '0', '1367889924', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('118', '楚雄', '0', '1367889936', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('119', '赤峰', '0', '1367889945', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('120', '定西', '0', '1367889956', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('121', '德宏', '0', '1367889965', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('122', '大兴安岭', '0', '1367889974', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('123', '丹东', '0', '1367889983', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('124', '德州', '0', '1367889992', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('125', '达州', '0', '1367890002', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('126', '迪庆', '0', '1367890012', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('127', '德阳', '0', '1367890022', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('128', '大理', '0', '1367890031', 'D', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('129', '阜新', '0', '1367890041', 'E', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('130', '防城港', '0', '1367890050', 'E', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('131', '抚州', '0', '1367890059', 'E', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('132', '阜阳', '0', '1367890088', 'F', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('133', '贵港', '0', '1367890101', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('134', '广安', '0', '1367890120', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('135', '甘孜', '0', '1367890130', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('136', '甘南', '0', '1367890139', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('137', '固原', '0', '1367890148', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('138', '果洛', '0', '1367890157', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('139', '广元', '0', '1367890172', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('140', '葫芦岛', '0', '1367890183', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('141', '鹤壁', '0', '1367890192', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('142', '黄石', '0', '1367890203', 'G', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('143', '黄冈', '0', '1367890214', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('144', '汉中', '0', '1367890224', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('145', '红河', '0', '1367890233', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('146', '河源', '0', '1367890243', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('147', '衡水', '0', '1367890253', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('148', '呼伦贝尔', '0', '1367890265', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('149', '河池', '0', '1367890275', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('150', '怀化', '0', '1367890284', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('151', '贺州', '0', '1367890294', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('152', '海西', '0', '1367890304', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('153', '黄山', '0', '1367890314', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('154', '淮南', '0', '1367890327', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('155', '淮安', '0', '1367890337', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('156', '哈密', '0', '1367890346', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('157', '和田', '0', '1367890355', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('158', '黑河', '0', '1367890367', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('159', '九江', '0', '1367890378', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('160', '荆门', '0', '1367890386', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('161', '晋中', '0', '1367890396', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('162', '揭阳', '0', '1367890406', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('163', '晋城', '0', '1367890421', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('164', '济源', '0', '1367890431', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('165', '鸡西', '0', '1367890440', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('166', '金昌', '0', '1367890448', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('167', '酒泉', '0', '1367890459', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('168', '佳木斯', '0', '1367890468', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('169', '吉安', '0', '1367890484', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('170', '景德镇', '0', '1367890496', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('171', '江门', '0', '1367890505', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('172', '锦州', '0', '1367890515', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('173', '吉林', '0', '1367890524', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('174', '荆州', '0', '1367890533', 'J', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('175', '克州', '0', '1367890545', 'K', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('176', '开封', '0', '1367890554', 'K', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('177', '乐山', '0', '1367890567', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('178', '泸州', '0', '1367890576', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('179', '来宾', '0', '1367890585', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('180', '娄底', '0', '1367890596', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('181', '林芝', '0', '1367890606', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('182', '临夏', '0', '1367890615', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('183', '丽水', '0', '1367890623', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('184', '吕梁', '0', '1367890633', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('185', '漯河', '0', '1367890642', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('186', '莱芜', '0', '1367890652', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('187', '辽阳', '0', '1367890661', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('188', '辽源', '0', '1367890672', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('189', '拉萨', '0', '1367890681', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('190', '陇南', '0', '1367890693', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('191', '临沧', '0', '1367890701', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('192', '丽江', '0', '1367890712', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('193', '六安', '0', '1367890721', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('194', '凉山', '0', '1367890730', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('195', '六盘水', '0', '1367890739', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('196', '龙岩', '0', '1367890749', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('197', '廊坊', '0', '1367890758', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('198', '眉山', '0', '1367890772', 'M', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('199', '梅州', '0', '1367890781', 'M', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('200', '牡丹江', '0', '1367890791', 'M', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('201', '那曲', '0', '1367890800', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('202', '南阳', '0', '1367890810', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('203', '南平', '0', '1367890819', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('204', '怒江', '0', '1367890828', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('205', '内江', '0', '1367890837', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('206', '宁德', '0', '1367890845', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('207', '南充', '0', '1367890854', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('208', '南昌', '0', '1367890863', 'N', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('209', '盘锦', '0', '1367890872', 'P', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('210', '普洱', '0', '1367890884', 'P', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('211', '平凉', '0', '1367890894', 'P', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('212', '攀枝花', '0', '1367890907', 'P', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('213', '濮阳', '0', '1367890915', 'P', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('214', '清远', '0', '1367890927', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('215', '七台河', '0', '1367890937', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('216', '黔东南', '0', '1367890946', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('217', '曲靖', '0', '1367890960', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('218', '黔南', '0', '1367890978', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('219', '钦州', '0', '1367890986', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('220', '黔西南', '0', '1367890995', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('221', '衢州', '0', '1367891003', 'Q', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('222', '商洛', '0', '1367891022', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('223', '宿州', '0', '1367891034', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('224', '汕头', '0', '1367891044', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('225', '双鸭山', '0', '1367891053', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('226', '石嘴山', '0', '1367891063', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('227', '三明', '0', '1367891071', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('228', '宿迁', '0', '1367891080', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('229', '三峡', '0', '1367891089', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('230', '四平', '0', '1367891098', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('231', '汕尾', '0', '1367891107', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('232', '随州', '0', '1367891116', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('233', '朔州', '0', '1367891125', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('234', '商丘', '0', '1367891135', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('235', '遂宁', '0', '1367891144', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('236', '邵阳', '0', '1367891153', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('237', '山南', '0', '1367891161', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('238', '三门峡', '0', '1367891172', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('239', '十堰', '0', '1367891181', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('240', '上饶', '0', '1367891190', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('241', '松原', '0', '1367891199', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('242', '绥化', '0', '1367891208', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('243', '韶关', '0', '1367891218', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('244', '通化', '0', '1367891228', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('245', '铁岭', '0', '1367891236', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('246', '通辽', '0', '1367891246', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('247', '天水', '0', '1367891255', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('248', '吐鲁番', '0', '1367891264', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('249', '铜仁', '0', '1367891274', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('250', '台北', '0', '1367891282', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('251', '铜川', '0', '1367891291', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('252', '铜陵', '0', '1367891299', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('253', '塔城', '0', '1367891307', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('254', '泰州', '0', '1367891316', 'T', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('255', '乌海', '0', '1367891328', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('256', '文山', '0', '1367891345', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('257', '乌兰察布', '0', '1367891352', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('258', '渭南', '0', '1367891361', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('259', '武威', '0', '1367891370', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('260', '吴忠', '0', '1367891380', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('261', '梧州', '0', '1367891389', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('262', '乌鲁木齐', '0', '1367891398', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('263', '潍坊', '0', '1367891407', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('264', '威海', '0', '1367891416', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('265', '芜湖', '0', '1367891426', 'W', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('266', '许昌', '0', '1367891436', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('267', '咸宁', '0', '1367891449', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('268', '信阳', '0', '1367891458', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('269', '香港', '0', '1367891466', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('270', '宣城', '0', '1367891475', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('271', '咸阳', '0', '1367891485', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('272', '忻州', '0', '1367891496', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('273', '湘西', '0', '1367891520', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('274', '新乡', '0', '1367891532', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('275', '邢台', '0', '1367891541', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('276', '兴安', '0', '1367891550', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('277', '锡林郭勒', '0', '1367891560', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('278', '湘潭', '0', '1367891568', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('279', '新余', '0', '1367891578', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('280', '西双版纳', '0', '1367891588', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('281', '孝感', '0', '1367891600', 'X', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('282', '伊春', '0', '1367891610', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('283', '阳江', '0', '1367891619', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('284', '延边', '0', '1367891632', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('285', '云浮', '0', '1367891643', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('286', '榆林', '0', '1367891652', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('287', '延安', '0', '1367891662', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('288', '阳泉', '0', '1367891672', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('289', '玉溪', '0', '1367891681', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('290', '益阳', '0', '1367891690', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('291', '宜宾', '0', '1367891699', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('292', '永州', '0', '1367891708', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('293', '营口', '0', '1367891719', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('294', '宜春', '0', '1367891733', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('295', '玉树', '0', '1367891742', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('296', '伊犁', '0', '1367891752', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('297', '雅安', '0', '1367891761', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('298', '鹰潭', '0', '1367891770', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('299', '银川', '0', '1367891780', 'Y', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('300', '枣庄', '0', '1367891790', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('301', '中卫', '0', '1367891801', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('302', '资阳', '0', '1367891810', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('303', '张家口', '0', '1367891821', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('304', '驻马店', '0', '1367891830', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('305', '周口', '0', '1367891840', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('306', '张家界', '0', '1367891849', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('307', '昭通', '0', '1367891858', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('308', '张掖', '0', '1367891866', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('309', '肇庆', '0', '1367891878', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('310', '湛江', '0', '1367891888', 'Z', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('314', '河西区', '1', '1367915137', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('315', '河东区', '1', '1367915221', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('316', '水游城', '3', '1367915892', 'A', null, null, '0', '1', '0');
INSERT INTO `#__area` VALUES ('317', '河北区', '1', '1367916777', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('318', '红桥区', '1', '1367916799', 'H', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('319', '滨海新区', '1', '1367916834', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('320', '老城厢/大悦城', '3', '1367916878', 'L', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('321', '白堤路/风荷园', '3', '1367916904', 'B', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('322', '王顶堤/华苑', '3', '1367916922', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('323', '水上/天塔', '3', '1367916942', 'S', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('324', '时代奥城', '3', '1367916960', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('325', '长虹公园', '3', '1367916985', 'C', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('326', '南开公园', '3', '1367917001', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('327', '南开大学/八里台', '3', '1367917020', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('328', '海光寺/六里台', '3', '1367917047', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('329', '天拖地区', '3', '1367917062', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('330', '鼓楼/七向街', '3', '1367917077', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('331', '鞍山西道', '3', '1367917100', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('332', '东马路/新世界百货', '3', '1367917114', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('333', '滨江道', '5', '1367917139', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('334', '和平路', '5', '1367917155', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('335', '小白楼', '5', '1367917169', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('336', '鞍山道沿线', '5', '1367917185', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('337', '南市', '5', '1367917201', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('338', '五大道', '5', '1367917216', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('339', '西康路沿线', '5', '1367917235', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('340', '津湾广场', '5', '1367917249', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('341', '荣业大街', '5', '1367917267', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('342', '土城', '314', '1367917309', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('343', '小海地', '314', '1367917326', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('344', '体院北', '314', '1367917341', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('345', '图书大厦', '314', '1367917357', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('346', '梅江', '314', '1367917373', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('347', '永安道', '314', '1367917388', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('348', '尖山', '314', '1367917401', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('349', '佟楼', '314', '1367917424', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('350', '乐园道', '314', '1367917440', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('351', '下瓦房', '314', '1367917457', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('352', '南楼', '314', '1367917471', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('353', '越秀路', '314', '1367917485', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('354', '天津站后广场', '315', '1367917503', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('355', '卫国道', '315', '1367917740', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('356', '二宫', '3', '1367917756', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('357', '河东万达广场', '3', '1367917775', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('358', '万新村', '315', '1367917791', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('359', '工业大学', '315', '1367917805', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('360', '大王庄', '315', '1367917819', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('361', '大直沽', '315', '1367917833', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('362', '中山门', '315', '1367917849', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('363', '金钟河大街', '317', '1367917874', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('364', '狮子林大街', '317', '1367917885', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('365', '天泰路/榆关道', '317', '1367917899', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('366', '意大利风情区/火车站', '317', '1367917913', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('367', '中山路', '317', '1367917924', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('368', '王串场/民权门', '317', '1367917939', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('369', '汉沽城区', '319', '1367917968', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('370', '大港城区', '319', '1367917982', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('371', '大港油田', '319', '1367917995', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('372', '经济开发区', '319', '1367918007', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('373', '塘沽城区', '319', '1367918020', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('374', '大胡同', '318', '1367918039', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('375', '天津西站', '318', '1367918053', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('376', '创意街/水木天成', '318', '1367918065', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('377', '凯莱赛', '318', '1367918077', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('378', '本溪路/丁字沽', '318', '1367918094', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('379', '芥园道/水游城', '318', '1367918107', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('380', '东城区', '2', '1367978117', 'A', null, null, '0', '0', '0');
INSERT INTO `#__area` VALUES ('381', '西城区', '2', '1367978125', 'A', null, null, '0', '0', '0');
INSERT INTO `#__article` VALUES (1, 2, '', 1, 255, '如何注册成为会员', '如何注册成为会员', 1294709136);
INSERT INTO `#__article` VALUES (2, 5, '', 1, 255, '团购验证', '团购验证', 1404350353);
INSERT INTO `#__article` VALUES (3, 5, '', 1, 255, '会员卡', '会员卡', 1404350379);
INSERT INTO `#__article` VALUES (4, 2, '', 1, 255, '如何搜索', '如何搜索', 1294709301);
INSERT INTO `#__article` VALUES (5, 2, '', 1, 255, '忘记密码', '忘记密码', 1294709313);
INSERT INTO `#__article` VALUES (6, 2, '', 1, 255, '查看已买团购', '查看已购买团购券', 1294709380);
INSERT INTO `#__article` VALUES (7, 3, '', 1, 255, '如何管理店铺', '如何管理店铺', 1294709442);
INSERT INTO `#__article` VALUES (8, 3, '', 1, 255, '如何发优惠券', '如何发优惠券', 1294709599);
INSERT INTO `#__article` VALUES (9, 3, '', 1, 255, '如何申请开店', '如何申请开店', 1294709809);
INSERT INTO `#__article` VALUES (10, 4, '', 1, 255, '在线支付', '在线支付', 1294713631);
INSERT INTO `#__article` VALUES (11, 6, '', 1, 255, '会员修改密码', '会员修改密码', 1294713819);
INSERT INTO `#__article` VALUES (12, 6, '', 1, 255, '会员修改个人资料', '会员修改个人资料', 1294713836);
INSERT INTO `#__article` VALUES (13, 3, '', 1, 255, '如何发布商品', '如何发布商品', 1294713852);
INSERT INTO `#__article` VALUES (14, 6, '', 1, 255, '修改收货地址', '修改收货地址', 1294713910);
INSERT INTO `#__article` VALUES (15, 7, '', 1, 255, '关于ShopNC', '<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 天津市网城创想科技有限责任公司位于天津市南开区，是专业从事生产管理信息化领域技术咨询和软件开发的高新技术企业。公司拥有多名技术人才和资深的行业解决方案专家。\r\n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 公司拥有一支勇于开拓、具有战略眼光和敏锐市场判断力的市场营销队伍，一批求实敬业，追求卓越的行政管理人才，一个能征善战，技术优秀，经验丰富的开发团队。公司坚持按现代企业制度和市场规律办事，在扩大经营规模的同时，注重企业经济运行质量，在自主产品研发及承接软件项目方面获得了很强的竞争力。 我公司也积极参与国内传统企业的信息化改造，引进国际化产品开发的标准，规范软件开发流程，通过提升各层面的软件开发人才的技术素质，打造国产软件精品，目前已经开发出具有自主知识产权的网络商城软件，还在积极开发基于电子商务平台高效能、高效益的管理系统。为今后进一步开拓国内市场打下坚实的基础。公司致力于构造一个开放、发展的人才平台，积极营造追求卓越、积极奉献的工作氛围，把“以人为本”的理念落实到每一项具体工作中，为那些锋芒内敛，激情无限的业界精英提供充分的发展空间，优雅自信、从容自得的工作环境，事业雄心与生活情趣两相兼顾的生活方式。并通过每个员工不断提升自我，以自己的独特价值观对工作与生活作最准确的判断，使我们每一个员工彰显出他们出色的自我品位，独有的工作个性和卓越的创新风格，让他们时刻保持振奋、不断鼓舞内心深处的梦想，永远走在时代潮流前端。公司发展趋势 励精图治，展望未来。公司把发展产业策略与发掘人才策略紧密结合，广纳社会精英，挖掘创新潜能，以人为本，凝聚人气，努力营造和谐宽松的工作氛围，为优秀人才的脱颖而出提供机遇。公司将在深入发展软件产业的同时，通过不懈的努力，来塑造大型软件公司的辉煌形象。\r\n</p>', 1294714215);
INSERT INTO `#__article` VALUES (16, 7, '', 1, 255, '联系我们', '<p>欢迎您对我们的站点、工作、产品和服务提出自己宝贵的意见或建议。我们将给予您及时答复。同时也欢迎您到我们公司来洽商业务。</p>\r\n<p><br />\r\n<strong>公司名称</strong>： 天津市网城创想科技有限责任公司 <br />\r\n<strong>通信地址</strong>： 天津市南开区红旗路220号慧谷大厦712 <br />\r\n<strong>邮政编码</strong>： 300072 <br />\r\n<strong>电话</strong>： 400-611-5098 <br />\r\n<strong>商务洽谈</strong>： 86-022-87631069 <br />\r\n<strong>传真</strong>： 86-022-87631069 <br />\r\n<strong>软件企业编号</strong>： 120193000029441 <br />\r\n<strong>软件著作权登记号</strong>： 2008SR07843 <br />\r\n<strong>ICP备案号</strong>： 津ICP备08000171号 </p>', 1294714228);
INSERT INTO `#__article` VALUES (17, 7, '', 1, 255, '招聘英才', '<dl> <h3>PHP程序员</h3>\r\n<dt>职位要求： <dd>熟悉PHP5开发语言；<br />\r\n熟悉MySQL5数据库，同时熟悉sqlserver，oracle者优先；<br />\r\n熟悉面向对象思想，MVC三层体系，至少使用过目前已知PHP框架其中一种；<br />\r\n熟悉SERVER2003/Linux操作系统，熟悉常用Linux操作命令；<br />\r\n熟悉Mysql数据库应用开发，了解Mysql的数据库配置管理、性能优化等基本操作技能；<br />\r\n熟悉jquery，smarty等常用开源软件；<br />\r\n具备良好的代码编程习惯及较强的文档编写能力；<br />\r\n具备良好的团队合作能力；<br />\r\n熟悉设计模式者优先；<br />\r\n熟悉java，c++,c#,python其中一种者优先； </dd> <dt>学历要求： <dd>大本 </dd> <dt>工作经验： <dd>一年以上 </dd> <dt>工作地点： <dd>天津 </dd></dl> <dl> <h3>网页设计（2名）</h3>\r\n<dt>岗位职责： <dd>网站UI设计、 切片以及HTML制作。 </dd> <dt>职位要求： <dd>有大型网站设计经验；有网站改版、频道建设经验者优先考虑； <br />\r\n熟练掌握photoshop,fireworks,dreamwaver等设计软件； <br />\r\n熟练运用Div+Css制作网页，符合CSS2.0-W3C标准，并掌握不同浏览器下，不同版本下CSS元素的区别；<br />\r\n熟悉网站制作流程，能运用并修改简单JavaScript类程序； <br />\r\n积极向上，有良好的人际沟通能力，良好的工作协调能力，踏实肯干的工作精神；具有良好的沟通表达能力，<br />\r\n需求判断力，团队协作能力； <br />\r\n请应聘者在简历中提供个人近期作品连接。 </dd> <dt>学历要求： <dd>专科 </dd> <dt>工作经验： <dd>一年以上 </dd> <dt>工作地点： <dd>天津 </dd></dl> <dl> <h3>方案策划（1名）</h3>\r\n<dt>职位要求： <dd>2年以上的文案编辑类相关工作经验，具备一定的文字功底，有极强的语言表达和逻辑思维能力， 能独立完成项目方案的编写，拟草各种协议。熟悉使用办公软件。 </dd> <dt>学历要求： <dd>大专以上 </dd> <dt>工作经验： <dd>一年以上 </dd> <dt>工作地点： <dd>天津 </dd></dl>', 1294714240);
INSERT INTO `#__article` VALUES (18, 7, '', 1, 255, '合作及洽谈', '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ShopNC希望与服务代理商、合作伙伴并肩合作，携手开拓日益广阔的网络购物软件市场。如果您拥有好的建议，拥有丰富渠道资源、拥有众多目标客户、拥有相应的市场资源，并希望与ShopNC进行深度业务合作， 欢迎成为ShopNC业务合作伙伴，请联系。</p>\r\n<p>&nbsp;</p>\r\n<p><strong>公司名称</strong>： 天津市网城创想科技有限责任公司 <br />\r\n<strong>通信地址</strong>： 天津市南开区红旗路220号慧谷大厦712 <br />\r\n<strong>邮政编码</strong>： 300072 <br />\r\n<strong>电话</strong>： 400-611-5098 <br />\r\n<strong>商务洽谈</strong>： 86-022-87631069 <br />\r\n<strong>传真</strong>： 86-022-87631069 <br />\r\n</p>', 1294714257);
INSERT INTO `#__article` VALUES (19, 4, '', 1, 255, '分期付款', '分期付款<br />', 1309835564);
INSERT INTO `#__article` VALUES (20, 4, '', 1, 255, '邮局汇款', '邮局汇款<br />', 1309835582);
INSERT INTO `#__article` VALUES (21, 4, '', 1, 255, '公司转账', '公司转账<br />', 1309835600);
INSERT INTO `#__article` VALUES (22, 5, '', 1, 255, '退款申请', '退款申请', 1309835699);
INSERT INTO `#__article` VALUES (23, 2, '', 1, 255, '积分细则', '积分细则', 1322621203);
INSERT INTO `#__article` VALUES (24, 2, '', 1, 255, '积分兑换说明', '积分兑换说明', 1322621243);
INSERT INTO `#__article_class` VALUES ('1', 'notice', '商城公告', '0', '255');
INSERT INTO `#__article_class` VALUES ('2', 'member', '帮助中心', '0', '255');
INSERT INTO `#__article_class` VALUES ('3', 'store', '店主之家', '0', '255');
INSERT INTO `#__article_class` VALUES ('4', 'payment', '支付方式', '0', '255');
INSERT INTO `#__article_class` VALUES ('5', 'sold', '售后服务', '0', '255');
INSERT INTO `#__article_class` VALUES ('6', 'service', '客服中心', '0', '255');
INSERT INTO `#__article_class` VALUES ('7', 'about', '关于我们', '0', '255');
INSERT INTO `#__circle` VALUES ('1', '吃喝玩乐', '吃喝玩乐', '4', 'shopnc', null, '0', '1', '0', '0', '吃喝玩乐', null, '1', null, '0', '1379990082', null, '0', '0', '吃喝玩乐', '0', '0', '0', '0', '0');
INSERT INTO `#__circle_member` VALUES ('4', '1', '吃喝玩乐', 'shopnc', '65c1fa5748735cc871807b12e1b83ca0.jpg', '', '1379990082', '1', '', '1379990082', '1', '初级粉丝', '1', '5', '1', '1', '0', '0', '0', '', '0');
INSERT INTO `#__circle_mldefault` VALUES ('1', '初级粉丝', '1');
INSERT INTO `#__circle_mldefault` VALUES ('2', '中级粉丝', '5');
INSERT INTO `#__circle_mldefault` VALUES ('3', '高级粉丝', '15');
INSERT INTO `#__circle_mldefault` VALUES ('4', '正式会员', '30');
INSERT INTO `#__circle_mldefault` VALUES ('5', '正式会员', '50');
INSERT INTO `#__circle_mldefault` VALUES ('6', '核心会员', '100');
INSERT INTO `#__circle_mldefault` VALUES ('7', '核心会员', '200');
INSERT INTO `#__circle_mldefault` VALUES ('8', '铁杆会员', '500');
INSERT INTO `#__circle_mldefault` VALUES ('9', '铁杆会员', '1000');
INSERT INTO `#__circle_mldefault` VALUES ('10', '知名人士', '2000');
INSERT INTO `#__circle_mldefault` VALUES ('11', '知名人士', '3000');
INSERT INTO `#__circle_mldefault` VALUES ('12', '人气楷模', '6000');
INSERT INTO `#__circle_mldefault` VALUES ('13', '人气楷模', '10000');
INSERT INTO `#__circle_mldefault` VALUES ('14', '意见领袖', '18000');
INSERT INTO `#__circle_mldefault` VALUES ('15', '资深元老', '30000');
INSERT INTO `#__circle_mldefault` VALUES ('16', '荣耀元老', '60000');
INSERT INTO `#__circle_mlref` VALUES ('1', '校园系列', '1371784037', '1', '托儿所', '幼儿园', '学前班', '一年级', '二年级', '三年级', '四年级', '五年级', '六年级', '初一', '初二', '初三', '高一', '高二', '高三', '大学');
INSERT INTO `#__circle_mlref` VALUES ('2', '名气系列', '1371797598', '1', '默默无闻', '崭露头角', '锋芒毕露', '小有名气', '小有美名', '颇具名气', '颇具盛名', '富有名气', '富有美誉', '远近闻名', '崭露头角', '声名远扬', '赫赫有名', '大名鼎鼎', '如雷贯耳', '名扬四海');
INSERT INTO `#__circle_mlref` VALUES ('6', '内涵系列', '1371884423', '1', '1L喂熊', '抢个沙发', '自带板凳', '路人甲君', '打酱油的', '华丽飘过', '前来围观', '我勒个去', '亮了瞎了', '兰州烧饼', '鸭梨山大', '笑而不语', '内牛满面', '虎躯一震', '霸气外露', '此贴必火');
INSERT INTO `#__circle_mlref` VALUES ('7', '军衔系列', '1371884788', '1', '下士', '中士', '上士', '少尉', '中尉', '上尉', '大尉', '少校', '中校', '上校', '大校', '少将', '中将', '上将', '大将', '元帅');
INSERT INTO `#__circle_mlref` VALUES ('8', '书生系列', '1371884953', '1', '白丁', '童生', '秀才', '举人', '举人', '贡士', '进士', '进士', '进士', '探花', '探花', '榜眼', '榜眼', '状元', '状元', '圣贤');
INSERT INTO `#__circle_mlref` VALUES ('9', '武侠系列', '1371885047', '1', '初涉江湖', '无名之辈', '仗剑天涯', '人海孤鸿', '四方游侠', '江湖少侠', '后起之秀', '武林新贵', '武林高手', '英雄豪杰', '人中龙凤', '自成一派', '名震江湖', '武林盟主', '一代宗师', '笑傲江湖');
INSERT INTO `#__document` VALUES ('1', 'agreement', '用户服务协议', '<p>特别提醒用户认真阅读本《用户服务协议》(下称《协议》) 中各条款。除非您接受本《协议》条款，否则您无权使用本网站提供的相关服务。您的使用行为将视为对本《协议》的接受，并同意接受本《协议》各项条款的约束。 <br /> <br /> <strong>一、定义</strong><br /></p>\r\n<ol>\r\n<li>\"用户\"指符合本协议所规定的条件，同意遵守本网站各种规则、条款（包括但不限于本协议），并使用本网站的个人或机构。</li>\r\n<li>\"卖家\"是指在本网站上出售物品的用户。\"买家\"是指在本网站购买物品的用户。</li>\r\n<li>\"成交\"指买家根据卖家所刊登的交易要求，在特定时间内提出最优的交易条件，因而取得依其提出的条件购买该交易物品的权利。</li>\r\n</ol>\r\n<p><br /> <br /> <strong>二、用户资格</strong><br /> <br /> 只有符合下列条件之一的人员或实体才能申请成为本网站用户，可以使用本网站的服务。</p>\r\n<ol>\r\n<li>年满十八岁，并具有民事权利能力和民事行为能力的自然人；</li>\r\n<li>未满十八岁，但监护人（包括但不仅限于父母）予以书面同意的自然人；</li>\r\n<li>根据中国法律或设立地法律、法规和/或规章成立并合法存在的公司、企事业单位、社团组织和其他组织。</li>\r\n</ol>\r\n<p><br /> 无民事行为能力人、限制民事行为能力人以及无经营或特定经营资格的组织不当注册为本网站用户或超过其民事权利或行为能力范围从事交易的，其与本网站之间的协议自始无效，本网站一经发现，有权立即注销该用户，并追究其使用本网站\"服务\"的一切法律责任。<br /> <br /> <strong>三.用户的权利和义务</strong><br /></p>\r\n<ol>\r\n<li>用户有权根据本协议的规定及本网站发布的相关规则，利用本网站网上交易平台登录物品、发布交易信息、查询物品信息、购买物品、与其他用户订立物品买卖合同、在本网站社区发帖、参加本网站的有关活动及有权享受本网站提供的其他的有关资讯及信息服务。</li>\r\n<li>用户有权根据需要更改密码和交易密码。用户应对以该用户名进行的所有活动和事件负全部责任。</li>\r\n<li>用户有义务确保向本网站提供的任何资料、注册信息真实准确，包括但不限于真实姓名、身份证号、联系电话、地址、邮政编码等。保证本网站及其他用户可以通过上述联系方式与自己进行联系。同时，用户也有义务在相关资料实际变更时及时更新有关注册资料。</li>\r\n<li>用户不得以任何形式擅自转让或授权他人使用自己在本网站的用户帐号。</li>\r\n<li>用户有义务确保在本网站网上交易平台上登录物品、发布的交易信息真实、准确，无误导性。</li>\r\n<li>用户不得在本网站网上交易平台买卖国家禁止销售的或限制销售的物品、不得买卖侵犯他人知识产权或其他合法权益的物品，也不得买卖违背社会公共利益或公共道德的物品。</li>\r\n<li>用户不得在本网站发布各类违法或违规信息。包括但不限于物品信息、交易信息、社区帖子、物品留言，店铺留言，评价内容等。</li>\r\n<li>用户在本网站交易中应当遵守诚实信用原则，不得以干预或操纵物品价格等不正当竞争方式扰乱网上交易秩序，不得从事与网上交易无关的不当行为，不得在交易平台上发布任何违法信息。</li>\r\n<li>用户不应采取不正当手段（包括但不限于虚假交易、互换好评等方式）提高自身或他人信用度，或采用不正当手段恶意评价其他用户，降低其他用户信用度。</li>\r\n<li>用户承诺自己在使用本网站网上交易平台实施的所有行为遵守国家法律、法规和本网站的相关规定以及各种社会公共利益或公共道德。对于任何法律后果的发生，用户将以自己的名义独立承担所有相应的法律责任。</li>\r\n<li>用户在本网站网上交易过程中如与其他用户因交易产生纠纷，可以请求本网站从中予以协调。用户如发现其他用户有违法或违反本协议的行为，可以向本网站举报。如用户因网上交易与其他用户产生诉讼的，用户有权通过司法部门要求本网站提供相关资料。</li>\r\n<li>用户应自行承担因交易产生的相关费用，并依法纳税。</li>\r\n<li>未经本网站书面允许，用户不得将本网站资料以及在交易平台上所展示的任何信息以复制、修改、翻译等形式制作衍生作品、分发或公开展示。</li>\r\n<li>用户同意接收来自本网站的信息，包括但不限于活动信息、交易信息、促销信息等。</li>\r\n</ol>\r\n<p><br /> <br /> <strong>四、 本网站的权利和义务</strong><br /></p>\r\n<ol>\r\n<li>本网站不是传统意义上的\"拍卖商\"，仅为用户提供一个信息交流、进行物品买卖的平台，充当买卖双方之间的交流媒介，而非买主或卖主的代理商、合伙  人、雇员或雇主等经营关系人。公布在本网站上的交易物品是用户自行上传进行交易的物品，并非本网站所有。对于用户刊登物品、提供的信息或参与竞标的过程，  本网站均不加以监视或控制，亦不介入物品的交易过程，包括运送、付款、退款、瑕疵担保及其它交易事项，且不承担因交易物品存在品质、权利上的瑕疵以及交易  方履行交易协议的能力而产生的任何责任，对于出现在拍卖上的物品品质、安全性或合法性，本网站均不予保证。</li>\r\n<li>本网站有义务在现有技术水平的基础上努力确保整个网上交易平台的正常运行，尽力避免服务中断或将中断时间限制在最短时间内，保证用户网上交易活动的顺利进行。</li>\r\n<li>本网站有义务对用户在注册使用本网站网上交易平台中所遇到的问题及反映的情况及时作出回复。 </li>\r\n<li>本网站有权对用户的注册资料进行查阅，对存在任何问题或怀疑的注册资料，本网站有权发出通知询问用户并要求用户做出解释、改正，或直接做出处罚、删除等处理。</li>\r\n<li>用  户因在本网站网上交易与其他用户产生纠纷的，用户通过司法部门或行政部门依照法定程序要求本网站提供相关资料，本网站将积极配合并提供有关资料；用户将纠  纷告知本网站，或本网站知悉纠纷情况的，经审核后，本网站有权通过电子邮件及电话联系向纠纷双方了解纠纷情况，并将所了解的情况通过电子邮件互相通知对  方。 </li>\r\n<li>因网上交易平台的特殊性，本网站没有义务对所有用户的注册资料、所有的交易行为以及与交易有关的其他事项进行事先审查，但如发生以下情形，本网站有权限制用户的活动、向用户核实有关资料、发出警告通知、暂时中止、无限期地中止及拒绝向该用户提供服务：         \r\n<ul>\r\n<li>用户违反本协议或因被提及而纳入本协议的文件；</li>\r\n<li>存在用户或其他第三方通知本网站，认为某个用户或具体交易事项存在违法或不当行为，并提供相关证据，而本网站无法联系到该用户核证或验证该用户向本网站提供的任何资料；</li>\r\n<li>存在用户或其他第三方通知本网站，认为某个用户或具体交易事项存在违法或不当行为，并提供相关证据。本网站以普通非专业交易者的知识水平标准对相关内容进行判别，可以明显认为这些内容或行为可能对本网站用户或本网站造成财务损失或法律责任。 </li>\r\n</ul>\r\n</li>\r\n<li>在反网络欺诈行动中，本着保护广大用户利益的原则，当用户举报自己交易可能存在欺诈而产生交易争议时，本网站有权通过表面判断暂时冻结相关用户账号，并有权核对当事人身份资料及要求提供交易相关证明材料。</li>\r\n<li>根据国家法律法规、本协议的内容和本网站所掌握的事实依据，可以认定用户存在违法或违反本协议行为以及在本网站交易平台上的其他不当行为，本网站有权在本网站交易平台及所在网站上以网络发布形式公布用户的违法行为，并有权随时作出删除相关信息，而无须征得用户的同意。</li>\r\n<li>本  网站有权在不通知用户的前提下删除或采取其他限制性措施处理下列信息：包括但不限于以规避费用为目的；以炒作信用为目的；存在欺诈等恶意或虚假内容；与网  上交易无关或不是以交易为目的；存在恶意竞价或其他试图扰乱正常交易秩序因素；该信息违反公共利益或可能严重损害本网站和其他用户合法利益的。</li>\r\n<li>用  户授予本网站独家的、全球通用的、永久的、免费的信息许可使用权利，本网站有权对该权利进行再授权，依此授权本网站有权(全部或部份地)  使用、复制、修订、改写、发布、翻译、分发、执行和展示用户公示于网站的各类信息或制作其派生作品，以现在已知或日后开发的任何形式、媒体或技术，将上述  信息纳入其他作品内。</li>\r\n</ol>\r\n<p><br /> <br /> <strong>五、服务的中断和终止</strong><br /></p>\r\n<ol>\r\n<li>在  本网站未向用户收取相关服务费用的情况下，本网站可自行全权决定以任何理由  (包括但不限于本网站认为用户已违反本协议的字面意义和精神，或用户在超过180天内未登录本网站等)  终止对用户的服务，并不再保存用户在本网站的全部资料（包括但不限于用户信息、商品信息、交易信息等）。同时本网站可自行全权决定，在发出通知或不发出通  知的情况下，随时停止提供全部或部分服务。服务终止后，本网站没有义务为用户保留原用户资料或与之相关的任何信息，或转发任何未曾阅读或发送的信息给用户  或第三方。此外，本网站不就终止对用户的服务而对用户或任何第三方承担任何责任。 </li>\r\n<li>如用户向本网站提出注销本网站注册用户身份，需经本网站审核同意，由本网站注销该注册用户，用户即解除与本网站的协议关系，但本网站仍保留下列权利：         \r\n<ul>\r\n<li>用户注销后，本网站有权保留该用户的资料,包括但不限于以前的用户资料、店铺资料、商品资料和交易记录等。 </li>\r\n<li>用户注销后，如用户在注销前在本网站交易平台上存在违法行为或违反本协议的行为，本网站仍可行使本协议所规定的权利。 </li>\r\n</ul>\r\n</li>\r\n<li>如存在下列情况，本网站可以通过注销用户的方式终止服务：         \r\n<ul>\r\n<li>在用户违反本协议相关规定时，本网站有权终止向该用户提供服务。本网站将在中断服务时通知用户。但如该用户在被本网站终止提供服务后，再一次直接或间接或以他人名义注册为本网站用户的，本网站有权再次单方面终止为该用户提供服务；</li>\r\n<li>一旦本网站发现用户注册资料中主要内容是虚假的，本网站有权随时终止为该用户提供服务； </li>\r\n<li>本协议终止或更新时，用户未确认新的协议的。 </li>\r\n<li>其它本网站认为需终止服务的情况。 </li>\r\n</ul>\r\n</li>\r\n<li>因用户违反相关法律法规或者违反本协议规定等原因而致使本网站中断、终止对用户服务的，对于服务中断、终止之前用户交易行为依下列原则处理：         \r\n<ul>\r\n<li>本网站有权决定是否在中断、终止对用户服务前将用户被中断或终止服务的情况和原因通知用户交易关系方，包括但不限于对该交易有意向但尚未达成交易的用户,参与该交易竞价的用户，已达成交易要约用户。</li>\r\n<li>服务中断、终止之前，用户已经上传至本网站的物品尚未交易或交易尚未完成的，本网站有权在中断、终止服务的同时删除此项物品的相关信息。 </li>\r\n<li>服务中断、终止之前，用户已经就其他用户出售的具体物品作出要约，但交易尚未结束，本网站有权在中断或终止服务的同时删除该用户的相关要约和信息。</li>\r\n</ul>\r\n</li>\r\n<li>本网站若因用户的行为（包括但不限于刊登的商品、在本网站社区发帖等）侵害了第三方的权利或违反了相关规定，而受到第三方的追偿或受到主管机关的处分时，用户应赔偿本网站因此所产生的一切损失及费用。</li>\r\n<li>对违反相关法律法规或者违反本协议规定，且情节严重的用户，本网站有权终止该用户的其它服务。</li>\r\n</ol>\r\n<p><br /> <br /> <strong>六、协议的修订</strong><br /> <br /> 本协议可由本网站随时修订，并将修订后的协议公告于本网站之上，修订后的条款内容自公告时起生效，并成为本协议的一部分。用户若在本协议修改之后，仍继续使用本网站，则视为用户接受和自愿遵守修订后的协议。本网站行使修改或中断服务时，不需对任何第三方负责。<br /> <br /> <strong>七、 本网站的责任范围 </strong><br /> <br /> 当用户接受该协议时，用户应明确了解并同意∶</p>\r\n<ol>\r\n<li>是否经由本网站下载或取得任何资料，由用户自行考虑、衡量并且自负风险，因下载任何资料而导致用户电脑系统的任何损坏或资料流失，用户应负完全责任。</li>\r\n<li>用户经由本网站取得的建议和资讯，无论其形式或表现，绝不构成本协议未明示规定的任何保证。</li>\r\n<li>基于以下原因而造成的利润、商誉、使用、资料损失或其它无形损失，本网站不承担任何直接、间接、附带、特别、衍生性或惩罚性赔偿（即使本网站已被告知前款赔偿的可能性）：         \r\n<ul>\r\n<li>本网站的使用或无法使用。</li>\r\n<li>经由或通过本网站购买或取得的任何物品，或接收之信息，或进行交易所随之产生的替代物品及服务的购买成本。</li>\r\n<li>用户的传输或资料遭到未获授权的存取或变更。</li>\r\n<li>本网站中任何第三方之声明或行为。</li>\r\n<li>本网站其它相关事宜。</li>\r\n</ul>\r\n</li>\r\n<li>本网站只是为用户提供一个交易的平台，对于用户所刊登的交易物品的合法性、真实性及其品质，以及用户履行交易的能力等，本网站一律不负任何担保责任。用户如果因使用本网站，或因购买刊登于本网站的任何物品，而受有损害时，本网站不负任何补偿或赔偿责任。</li>\r\n<li>本  网站提供与其它互联网上的网站或资源的链接，用户可能会因此连结至其它运营商经营的网站，但不表示本网站与这些运营商有任何关系。其它运营商经营的网站均  由各经营者自行负责，不属于本网站控制及负责范围之内。对于存在或来源于此类网站或资源的任何内容、广告、产品或其它资料，本网站亦不予保证或负责。因使  用或依赖任何此类网站或资源发布的或经由此类网站或资源获得的任何内容、物品或服务所产生的任何损害或损失，本网站不负任何直接或间接的责任。</li>\r\n</ol>\r\n<p><br /> <br /> <strong>八.、不可抗力</strong><br /> <br /> 因不可抗力或者其他意外事件，使得本协议的履行不可能、不必要或者无意义的，双方均不承担责任。本合同所称之不可抗力意指不能预见、不能避免并不能克服的  客观情况，包括但不限于战争、台风、水灾、火灾、雷击或地震、罢工、暴动、法定疾病、黑客攻击、网络病毒、电信部门技术管制、政府行为或任何其它自然或人  为造成的灾难等客观情况。<br /> <br /> <strong>九、争议解决方式</strong><br /></p>\r\n<ol>\r\n<li>本协议及其修订本的有效性、履行和与本协议及其修订本效力有关的所有事宜，将受中华人民共和国法律管辖，任何争议仅适用中华人民共和国法律。</li>\r\n<li>因  使用本网站服务所引起与本网站的任何争议，均应提交深圳仲裁委员会按照该会届时有效的仲裁规则进行仲裁。相关争议应单独仲裁，不得与任何其它方的争议在任  何仲裁中合并处理，该仲裁裁决是终局，对各方均有约束力。如果所涉及的争议不适于仲裁解决，用户同意一切争议由人民法院管辖。</li>\r\n</ol>', '1293773586');
INSERT INTO `#__document` VALUES ('2', 'real_name', '什么是实名认证', '<p><strong>什么是实名认证？</strong></p>\r\n<p>&ldquo;认证店铺&rdquo;服务是一项对店主身份真实性识别服务。店主可以通过站内PM、电话或管理员EMail的方式 联系并申请该项认证。经过管理员审核确认了店主的真实身份，就可以开通该项认证。</p>\r\n<p>通过该认证，可以说明店主身份的真实有效性，为买家在网络交易的过程中提供一定的信心和保证。</p>\r\n<p><strong>认证申请的方式：</strong></p>\r\n<p>Email：XXXX@XX.com</p>\r\n<p>管理员：XXXXXX</p>', '1293773817');
INSERT INTO `#__document` VALUES ('3', 'real_store', '什么是实体店铺认证', '<p><strong>什么是实体店铺认证？</strong></p>\r\n<p>&ldquo;认证店铺&rdquo;服务是一项对店主身份真实性识别服务。店主可以通过站内PM、电话或管理员EMail的方式 联系并申请该项认证。经过管理员审核确认了店主的真实身份，就可以开通该项认证。</p>\r\n<p>通过该认证，可以说明店主身份的真实有效性，为买家在网络交易的过程中提供一定的信心和保证。</p>\r\n<p><strong>认证申请的方式：</strong></p>\r\n<p>Email：XXXX@XX.com</p>\r\n<p>管理员：XXXXXX</p>', '1293773875');
INSERT INTO `#__document` VALUES ('4', 'open_store', '开店协议', '<p>使用本公司服务所须遵守的条款和条件。<br /><br />1.用户资格<br />本公司的服务仅向适用法律下能够签订具有法律约束力的合同的个人提供并仅由其使用。在不限制前述规定的前提下，本公司的服务不向18周岁以下或被临时或无限期中止的用户提供。如您不合资格，请勿使用本公司的服务。此外，您的帐户（包括信用评价）和用户名不得向其他方转让或出售。另外，本公司保留根据其意愿中止或终止您的帐户的权利。<br /><br />2.您的资料（包括但不限于所添加的任何商品）不得：<br />*具有欺诈性、虚假、不准确或具误导性；<br />*侵犯任何第三方著作权、专利权、商标权、商业秘密或其他专有权利或发表权或隐私权；<br />*违反任何适用的法律或法规（包括但不限于有关出口管制、消费者保护、不正当竞争、刑法、反歧视或贸易惯例/公平贸易法律的法律或法规）；<br />*有侮辱或者诽谤他人，侵害他人合法权益的内容；<br />*有淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的内容；<br />*包含可能破坏、改变、删除、不利影响、秘密截取、未经授权而接触或征用任何系统、数据或个人资料的任何病毒、特洛依木马、蠕虫、定时炸弹、删除蝇、复活节彩蛋、间谍软件或其他电脑程序；<br /><br />3.违约<br />如发生以下情形，本公司可能限制您的活动、立即删除您的商品、向本公司社区发出有关您的行为的警告、发出警告通知、暂时中止、无限期地中止或终止您的用户资格及拒绝向您提供服务：<br />(a)您违反本协议或纳入本协议的文件；<br />(b)本公司无法核证或验证您向本公司提供的任何资料；<br />(c)本公司相信您的行为可能对您、本公司用户或本公司造成损失或法律责任。<br /><br />4.责任限制<br />本公司、本公司的关联公司和相关实体或本公司的供应商在任何情况下均不就因本公司的网站、本公司的服务或本协议而产生或与之有关的利润损失或任何特别、间接或后果性的损害（无论以何种方式产生，包括疏忽）承担任何责任。您同意您就您自身行为之合法性单独承担责任。您同意，本公司和本公司的所有关联公司和相关实体对本公司用户的行为的合法性及产生的任何结果不承担责任。<br /><br />5.无代理关系<br />用户和本公司是独立的合同方，本协议无意建立也没有创立任何代理、合伙、合营、雇员与雇主或特许经营关系。本公司也不对任何用户及其网上交易行为做出明示或默许的推荐、承诺或担保。<br /><br />6.一般规定<br />本协议在所有方面均受中华人民共和国法律管辖。本协议的规定是可分割的，如本协议任何规定被裁定为无效或不可执行，该规定可被删除而其余条款应予以执行。</p>', '1293773901');
INSERT INTO `#__document` VALUES ('5', 'groupbuy', '团购活动协议', '<p>\r\n	一、团购的所有权和运作权归本公司。\r\n</p>\r\n<p>\r\n	二、本公司有权在必要时修改本协议，本协议一旦发生变更，将会在相关页面上公布。如果您不同意所改动的内容，您应主动停止使用团购服务。如果您继续使用服务，则视为接受本协议的变更。\r\n</p>\r\n<p>\r\n	三、如发生下列任何一种情形，本公司有权中断或终止向您提供的服务而无需通知您：\r\n</p>\r\n1、 您提供的个人资料不真实；<br />\r\n2、您违反本协议的规定；<br />\r\n3、 按照政府主管部门的监管要求；<br />\r\n4、本公司认为您的行为违反团购服务性质或需求的特殊情形。\r\n<p>\r\n	四、尽管本协议可能另有其他规定，本公司仍然可以随时终止本协议。\r\n</p>\r\n<p>\r\n	五、本公司终止本协议的权利不会妨害本公司可能拥有的在本协议终止前因您违反本协议或本公司本应享有的任何其他权利。\r\n</p>\r\n<p>\r\n	六、您理解并完全接受，本公司有权自行对团购资源作下线处理。\r\n</p>', '1328580944');
INSERT INTO `#__navigation` VALUES ('6', '0', '关于ShopNC', 'index.php?act=article&article_id=22', '2', '0', '255', '0', null);
INSERT INTO `#__navigation` VALUES ('7', '0', '联系我们', 'index.php?act=article&article_id=23', '2', '0', '240', '0', null);
INSERT INTO `#__navigation` VALUES ('8', '0', '广告合作', 'index.php?act=article&article_id=25', '2', '0', '220', '0', null);
INSERT INTO `#__navigation` VALUES ('9', '0', '招聘英才', 'index.php?act=article&amp;article_id=24', '2', '1', '210', '0', null);
INSERT INTO `#__navigation` VALUES ('13', '0', '优惠劵', 'index.php?act=coupon&amp;op=list', '0', '0', '250', '0', 'coupon');
INSERT INTO `#__navigation` VALUES ('14', '0', '团购', 'index.php?act=groupbuy', '0', '0', '251', '0', 'groupbuy');
INSERT INTO `#__navigation` VALUES ('15', '0', '会员卡', 'index.php?act=card', '0', '0', '252', '0', 'card');
INSERT INTO `#__navigation` VALUES ('16', '0', '预约', 'index.php?act=appointment', '0', '0', '253', '0', 'appointment');
INSERT INTO `#__navigation` VALUES ('17', '0', '社区', 'circle', '0', '1', '254', '0', 'circle');
INSERT INTO `#__navigation` VALUES ('18', '0', '积分商城', 'index.php?act=gift', '0', '0', '255', '0', 'gift');
INSERT INTO `#__payment` VALUES ('1', 'alipay', '支付宝', '', 'a:1:{s:0:\"\";s:0:\"\";}', '1', '1');
INSERT INTO `#__seo` VALUES ('1', 'ShopNC本地生活', '本地生活 美食 娱乐 电影 团购 优惠券 活动', 'ShopNC专注于研发符合时代发展需要的电子商务商城系统，以专业化的服务水平为企业级用户提供B(2B)2C【B2B2C】电子商务平台解决方案，全力打造电商平台专项ERP(CRM)系统、ERP(RFID)系统等，引领中国电子商务行业企业级需求的发展方向。咨询电话：400-611-5098', 'index');
INSERT INTO `#__seo` VALUES ('2', 'ShopNC本地生活优惠券', '本地生活 美食 娱乐 电影 团购 优惠券 活动', 'ShopNC专注于研发符合时代发展需要的电子商务商城系统，以专业化的服务水平为企业级用户提供B(2B)2C【B2B2C】电子商务平台解决方案，全力打造电商平台专项ERP(CRM)系统、ERP(RFID)系统等，引领中国电子商务行业企业级需求的发展方向。咨询电话：400-611-5098', 'coupon');
INSERT INTO `#__seo` VALUES ('3', 'ShopNC本地生活团购', '本地生活 美食 娱乐 电影 团购 优惠券 活动', 'ShopNC专注于研发符合时代发展需要的电子商务商城系统，以专业化的服务水平为企业级用户提供B(2B)2C【B2B2C】电子商务平台解决方案，全力打造电商平台专项ERP(CRM)系统、ERP(RFID)系统等，引领中国电子商务行业企业级需求的发展方向。咨询电话：400-611-5098', 'groupbuy');
INSERT INTO `#__seo` VALUES ('4', 'ShopNC本地生活会员卡', '本地生活 美食 娱乐 电影 团购 优惠券 活动', 'ShopNC专注于研发符合时代发展需要的电子商务商城系统，以专业化的服务水平为企业级用户提供B(2B)2C【B2B2C】电子商务平台解决方案，全力打造电商平台专项ERP(CRM)系统、ERP(RFID)系统等，引领中国电子商务行业企业级需求的发展方向。咨询电话：400-611-5098', 'card');
INSERT INTO `#__seo` VALUES ('5', 'ShopNC本地生活预约', 'ShopNC本地生活预约', 'ShopNC本地生活预约', 'appointment');
INSERT INTO `#__seo` VALUES ('6', 'ShopNC本地生活积分商城', 'ShopNC本地生活积分商城', 'ShopNC本地生活积分商城', 'gift');
INSERT INTO `#__setting` VALUES ('closed_reason', '网站维护中');
INSERT INTO `#__setting` VALUES ('default_city', 'a:9:{s:7:\"area_id\";s:1:\"1\";s:9:\"area_name\";s:6:\"天津\";s:14:\"parent_area_id\";s:1:\"0\";s:8:\"add_time\";s:10:\"1381561229\";s:12:\"first_letter\";s:1:\"T\";s:11:\"area_number\";s:3:\"022\";s:4:\"post\";s:5:\"30000\";s:8:\"hot_city\";s:1:\"1\";s:6:\"number\";s:1:\"0\";}');
INSERT INTO `#__setting` VALUES ('email_addr', 'shp2357@163.com');
INSERT INTO `#__setting` VALUES ('email_enabled', '1');
INSERT INTO `#__setting` VALUES ('email_host', 'smtp.163.com');
INSERT INTO `#__setting` VALUES ('email_id', 'shp2357@163.com');
INSERT INTO `#__setting` VALUES ('email_pass', 'shp2357.');
INSERT INTO `#__setting` VALUES ('email_port', '25');
INSERT INTO `#__setting` VALUES ('email_type', '1');
INSERT INTO `#__setting` VALUES ('icp_number', '');
INSERT INTO `#__setting` VALUES ('member_logo', 'de88c17219c7288039e1576edf76deb0.jpg');
INSERT INTO `#__setting` VALUES ('qq_appcode', 'test1');
INSERT INTO `#__setting` VALUES ('qq_appid', 'test1');
INSERT INTO `#__setting` VALUES ('qq_appkey', 'test1');
INSERT INTO `#__setting` VALUES ('qq_isuse', '1');
INSERT INTO `#__setting` VALUES ('sina_appcode', 'test');
INSERT INTO `#__setting` VALUES ('sina_isuse', '1');
INSERT INTO `#__setting` VALUES ('sina_wb_akey', 'ttt');
INSERT INTO `#__setting` VALUES ('sina_wb_skey', 'tt');
INSERT INTO `#__setting` VALUES ('site_email', null);
INSERT INTO `#__setting` VALUES ('site_logo', '8fe897c39dbc2066d1e8b6daa9d07f24.png');
INSERT INTO `#__setting` VALUES ('site_name', 'ShopNC本地生活');
INSERT INTO `#__setting` VALUES ('site_status', '1');
INSERT INTO `#__setting` VALUES ('statistics_code', '');
INSERT INTO `#__setting` VALUES ('time_zone', '-12');
INSERT INTO `#__setting` VALUES ('circle_contentleast', '1');
INSERT INTO `#__setting` VALUES ('circle_createsum', '6');
INSERT INTO `#__setting` VALUES ('circle_exprelease', '2');
INSERT INTO `#__setting` VALUES ('circle_expreleasemax', '10');
INSERT INTO `#__setting` VALUES ('circle_expreplied', '3');
INSERT INTO `#__setting` VALUES ('circle_exprepliedmax', '100');
INSERT INTO `#__setting` VALUES ('circle_expreply', '3');
INSERT INTO `#__setting` VALUES ('circle_intervaltime', '10');
INSERT INTO `#__setting` VALUES ('circle_iscreate', '1');
INSERT INTO `#__setting` VALUES ('circle_istalk', '1');
INSERT INTO `#__setting` VALUES ('circle_isuse', '1');
INSERT INTO `#__setting` VALUES ('circle_joinsum', '10');
INSERT INTO `#__setting` VALUES ('circle_loginpic', 'a:4:{i:1;a:2:{s:3:\"pic\";s:5:\"1.jpg\";s:3:\"url\";s:22:\"http://www.shopnc.net/\";}i:2;a:2:{s:3:\"pic\";s:5:\"2.jpg\";s:3:\"url\";s:22:\"http://www.shopnc.net/\";}i:3;a:2:{s:3:\"pic\";s:5:\"3.jpg\";s:3:\"url\";s:22:\"http://www.shopnc.net/\";}i:4;a:2:{s:3:\"pic\";s:5:\"4.jpg\";s:3:\"url\";s:22:\"http://www.shopnc.net/\";}}');
INSERT INTO `#__setting` VALUES ('circle_logo', 'logo.png');
INSERT INTO `#__setting` VALUES ('circle_managesum', '4');
INSERT INTO `#__setting` VALUES ('circle_name', 'ShopNC圈子');
INSERT INTO `#__setting` VALUES ('circle_seodescriptio', '发现精彩：圈子是买家们自己创建的私属领地，我们排斥广告分子，我们热爱真实分享！');
INSERT INTO `#__setting` VALUES ('circle_seokeywords', '圈子,帮派,讨论小组,购物,生活,分享,show,秀,商品,电子商务,社区,消费者社区,论坛,资讯,热门话题,朋友');
INSERT INTO `#__setting` VALUES ('circle_seotitle', '发现精彩 - ShopNC圈子');
INSERT INTO `#__setting` VALUES ('circle_wordfilter', '违禁物品,a{1}s{2}s,/\\d{10}([^\\d]+|$)/');
INSERT INTO `#__setting` VALUES ('taobao_api_isuse', '1');
INSERT INTO `#__setting` VALUES ('taobao_app_key', '21365728');
INSERT INTO `#__setting` VALUES ('taobao_secret_key', 'c15e5a750ebf228744e8f268bf2d0849');
INSERT INTO `#__setting` VALUES ('remind_groupbuy', NULL);
INSERT INTO `#__setting` VALUES ('seller_logo', '599083cb8c6d6530e7939e664c309732.jpg');
INSERT INTO `#__setting` VALUES ('ios_app_url', '');
INSERT INTO `#__setting` VALUES ('android_app_url', '');
INSERT INTO `#__setting` VALUES ('qrcode_app_url', '');
INSERT INTO `#__setting` VALUES ('weixin_qrcode', '');
INSERT INTO `#__setting` VALUES ('weixin_account', '');
INSERT INTO `#__setting` VALUES ('last_settle', '');
INSERT INTO `#__setting` VALUES ('enabled_subdomain', '0');
INSERT INTO `#__setting` VALUES ('subdomain_refuse', NULL);
INSERT INTO `#__score_setting` VALUES (1, 'add_comment', '添加点评', 50, 10);
INSERT INTO `#__score_setting` VALUES (2, 'pic_upload', '点评上传图片', 50, 5);
INSERT INTO `#__score_setting` VALUES (3, 'groupbuy', '购买团购券', 100, 20);
INSERT INTO `#__score_setting` VALUES (4, 'coupon', '下载优惠券', 60, 10);
INSERT INTO `#__score_setting` VALUES (5, 'activity', '报名参加活动', 60, 10);
INSERT INTO `#__score_setting` VALUES (6, 'avatar_upload', '上传头像', 30, 5);
INSERT INTO `#__score_setting` VALUES (7, 'member_info', '完善个人信息', 30, 5);
INSERT INTO `#__score_setting` VALUES (8, 'member_card', '申请会员卡', 60, 10);
INSERT INTO `#__score_setting` VALUES (9, 'appointment', '店铺预约', 60, 10);
INSERT INTO `#__member_degree` VALUES (1, '新人', 0, 49);
INSERT INTO `#__member_degree` VALUES (2, '一星', 50, 99);
INSERT INTO `#__member_degree` VALUES (3, '二星', 100, 199);
INSERT INTO `#__member_degree` VALUES (4, '三星', 200, 499);
INSERT INTO `#__member_degree` VALUES (5, '四星', 500, 999);
INSERT INTO `#__member_degree` VALUES (6, '五星', 1000, 2999);
INSERT INTO `#__member_degree` VALUES (7, '钻石', 3000, 0);