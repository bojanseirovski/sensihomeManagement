CREATE TABLE `smarthome`.`alert_log` ( 
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `sid` INT(11) NULL , 
    `aid` INT(11) NULL , 
    `alid` INT(11) NOT NULL , 
    `alname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `svalue` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `astate` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `date` TIMESTAMP NOT NULL , 
    PRIMARY KEY (`id`)
)
ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci;

ALTER TABLE `alert_log` CHANGE `date` `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;