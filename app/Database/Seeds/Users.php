<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
	public function run()
	{
		// Database seeding for roles
		$this->db->query("INSERT IGNORE INTO roles (id, name, label, created_at, updated_at) VALUES
			(1, 'admin',       'Administrator', NOW(), NOW()),
			(2, 'teacher',     'Teacher',       NOW(), NOW()),
			(3, 'student',     'Student',       NOW(), NOW()),
			(4, 'coordinator', 'Coordinator',   NOW(), NOW())
		");

		// Database seeding for user menu category
		$this->db->query("INSERT IGNORE INTO user_menu_category (id, menu_category) VALUES
			(1, 'Common Page'),
			(2, 'Settings')
		");

		// Database seeding for user menu
		$this->db->query("INSERT IGNORE INTO user_menu (id, menu_category, title, url, icon, parent) VALUES
			(1, 1, 'Dashboard',       'dashboard',       'home',    0),
			(2, 2, 'Users',           'users',           'user',    0),
			(3, 2, 'Menu Management', 'menu-management', 'command', 0)
		");

		// Database seeding for user role
		$this->db->query("INSERT IGNORE INTO user_role (id, role_name) VALUES (1, 'Developer')");

		// Database seeding for users
		$this->db->query("INSERT IGNORE INTO users (fullname, username, password, role, role_id, created_at, updated_at) VALUES
			('Administrator', 'admin@mail.io',       '" . password_hash('admin123',       PASSWORD_DEFAULT) . "', 1, 1, NOW(), NOW()),
			('Teacher',       'teacher@mail.io',     '" . password_hash('teacher123',     PASSWORD_DEFAULT) . "', 1, 2, NOW(), NOW()),
			('Coordinator',   'coordinator@mail.io', '" . password_hash('coordinator123', PASSWORD_DEFAULT) . "', 1, 4, NOW(), NOW())
		");

		// Database seeding for user access
		$this->db->query("INSERT IGNORE INTO user_access (role_id, menu_category_id, menu_id, submenu_id) VALUES
			(1, 1, 0, 0),
			(1, 0, 1, 0),
			(1, 2, 0, 0),
			(1, 0, 2, 0),
			(1, 0, 3, 0)
		");
	}
}
