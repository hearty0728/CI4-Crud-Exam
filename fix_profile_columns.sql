-- Fix Profile Columns Data Types
-- This corrects the columns that were created with wrong types

ALTER TABLE `users` 
MODIFY COLUMN `student_id` VARCHAR(20) NULL,
MODIFY COLUMN `course` VARCHAR(100) NULL,
MODIFY COLUMN `year_level` TINYINT NULL,
MODIFY COLUMN `section` VARCHAR(50) NULL,
MODIFY COLUMN `phone` VARCHAR(20) NULL,
MODIFY COLUMN `address` TEXT NULL,
MODIFY COLUMN `profile_image` VARCHAR(255) NULL;
