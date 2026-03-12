-- Profile Migration SQL
-- Add new profile columns to users table

ALTER TABLE `users` 
ADD COLUMN `student_id` VARCHAR(20) NULL AFTER `password`,
ADD COLUMN `course` VARCHAR(100) NULL AFTER `student_id`,
ADD COLUMN `year_level` TINYINT NULL AFTER `course`,
ADD COLUMN `section` VARCHAR(50) NULL AFTER `year_level`,
ADD COLUMN `phone` VARCHAR(20) NULL AFTER `section`,
ADD COLUMN `address` TEXT NULL AFTER `phone`,
ADD COLUMN `profile_image` VARCHAR(255) NULL AFTER `address`;
