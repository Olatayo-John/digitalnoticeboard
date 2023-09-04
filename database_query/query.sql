ALTER TABLE `moodswings`.`users` 
ADD COLUMN `user_type` TINYINT(1) NOT NULL COMMENT '1: Super Admin\n2: Admin\n3: Doctor\n4: User' AFTER `time_offset`,
ADD COLUMN `is_deleted` TINYINT(1) NOT NULL DEFAULT 0 AFTER `user_type`,
ADD COLUMN `deleted_at` DATETIME NULL AFTER `is_deleted`,
CHANGE COLUMN `is_active` `is_active` INT(11) NULL ;

