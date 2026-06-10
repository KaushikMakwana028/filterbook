INSERT INTO `users` (`name`, `store_name`, `mobile`, `isActive`, `email`, `password`, `role`, `profile_image`, `device_token`, `created_on`, `address`, `instagram`, `facebook`, `website`)
VALUES
('Super Admin', 'Filter Book HQ', '9999999999', 1, 'superadmin@filterbook.com', MD5('123456'), 1, '', '', NOW(), '', '', '', '');
