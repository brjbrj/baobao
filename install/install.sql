DROP TABLE IF EXISTS `tool_files`;
create table `tool_files` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`filepath` text NULL,
`update` datetime DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;