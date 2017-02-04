/*
DROP TABLE IF EXISTS `nx_user`;
CREATE TABLE IF NOT EXISTS `nx_user` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(32) NOT NULL DEFAULT '',
    `email` VARCHAR(50) NOT NULL DEFAULT '',
    `cellphone` CHAR(32) NOT NULL DEFAULT '',
    `password` CHAR(32) NOT NULL DEFAULT '',
    `exttype` VARCHAR(8) NOT NULL DEFAULT '',
    `extvalue1` VARCHAR(32) NOT NULL DEFAULT '',
    `extvalue2` VARCHAR(32) NOT NULL DEFAULT '',
    `extvalue3` VARCHAR(32) NOT NULL DEFAULT '',
    `extvalue4` VARCHAR(32) NOT NULL DEFAULT '',
    `truename` VARCHAR(32) NOT NULL DEFAULT '',
    `nickname` VARCHAR(32) NOT NULL DEFAULT '',
    `sex` ENUM('0', '1', '2') NOT NULL DEFAULT '0',
    `age` TINYINT UNSIGNED NOT NULL DEFAULT '0',
    `createtime` DATE NOT NULL DEFAULT '2017-01-01',
    `logintime` DATE NOT NULL DEFAULT '2017-01-01',    
    `loginip` BIGINT NOT NULL DEFAULT '0',
    PRIMARY KEY(`id`),
    UNIQUE nx_name_password(`name`, `password`),
    UNIQUE nx_email_password(`email`, `password`),
    UNIQUE nx_cellphone_password(`cellphone`, `password`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `nx_user_profile`;
*/

DROP TABLE IF EXISTS `nx_user_sign`;
CREATE TABLE IF NOT EXISTS `nx_user_sign` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, 
    `name` VARCHAR(32) NOT NULL DEFAULT '',
    `email` VARCHAR(50) NOT NULL DEFAULT '',
    `phone` CHAR(32) NOT NULL DEFAULT '',
    `openid` VARCHAR(32) NOT NULL DEFAULT '',
    `status` TINYINT UNSIGNED NOT NULL DEFAULT '0',
    `origin` TINYINT UNSIGNED NOT NULL DEFAULT '0',
    `reserve1` VARCHAR(32) NOT NULL DEFAULT '',
    `reserve2` VARCHAR(32) NOT NULL DEFAULT '',
    `reserve3` VARCHAR(32) NOT NULL DEFAULT '',
    `password` CHAR(32) NOT NULL DEFAULT '', 
    PRIMARY KEY(`id`),
    UNIQUE nx_name_password(`name`, `password`),
    UNIQUE nx_email_password(`email`, `password`),
    UNIQUE nx_phone_password(`phone`, `password`),
    UNIQUE nx_openid_password(`openid`, `password`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE=utf8_general_ci;
