ALTER TABLE `user` ADD `notify` TINYINT(3) NOT NULL AFTER `name`;
ALTER TABLE `user` CHANGE `notify` `notify` TINYINT(3) NULL;
