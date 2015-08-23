/*操作日志表*/
CREATE TABLE IF NOT EXISTS `operation_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `action` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `action_name` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_id` varchar(100) NOT NULL,
  `over_pri` varchar(500) NOT NULL,
  `options` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

