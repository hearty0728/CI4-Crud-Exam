-- Fix updated_at column to allow NULL and set default
ALTER TABLE `users` 
MODIFY COLUMN `updated_at` DATETIME NULL DEFAULT NULL;

-- Update any invalid datetime values to NULL
UPDATE `users` SET `updated_at` = NULL WHERE `updated_at` = '0000-00-00 00:00:00';
