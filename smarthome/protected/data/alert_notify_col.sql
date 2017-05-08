ALTER TABLE `alert` ADD `notify` TINYINT(3) NULL AFTER `actuator_state`;
ALTER TABLE `alert` ADD `is_daily` TINYINT(3) NULL AFTER `scheduled_on`;
