<?php

class ContactApp {
	private $db;

	private $setup;

	public function __construct($registry) {
		$this->db = $registry->db;

		$setup = load_lib('setup', true, true);

		$this->setup = $setup;
	}

	public function install() {
		$this->db->exec('CREATE TABLE ' . DB_PRFX . 'contact (
	id int(11) NOT NULL,
	name varchar(128) NOT NULL,
	email varchar(256) NOT NULL,
	message text NOT NULL,
	ip int(11) NOT NULL,
	time int(11) NOT NULL,
	`read` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8');

		$this->db->exec('ALTER TABLE ' . DB_PRFX . 'contact ADD PRIMARY KEY (id)');

		$this->db->exec('ALTER TABLE ' . DB_PRFX . 'contact MODIFY id int(11) NOT NULL AUTO_INCREMENT');

		$this->setup->add_adminnav([
			['title' => 'CONTACT_CONTACT', 'query' => 'contact'],
			['title' => 'CONTACT_MESSAGES', 'query' => 'contact/messages']
		]);

		$this->setup->add_permission([
			['name' => 'CONTACT_CONTACT', 'query' => 'contact', 'sub_allowed' => false],
			['name' => 'CONTACT_MESSAGES', 'query' => 'contact/messages', 'sub_allowed' => false],
			['name' => 'CONTACT_ADD', 'query' => 'contact/messages/add', 'sub_allowed' => false],
			['name' => 'CONTACT_VIEW', 'query' => 'contact/messages/view', 'sub_allowed' => true],
			['name' => 'CONTACT_EDIT', 'query' => 'contact/messages/edit', 'sub_allowed' => true],
			['name' => 'CONTACT_DELETE', 'query' => 'contact/messages/delete', 'sub_allowed' => true],
		]);

		return true;
	}

	public function uninstall() {
		$this->db->exec('DROP TABLE ' . DB_PRFX . 'contact');

		$this->setup->adminnav_delete('contact');

		$this->setup->permission_delete('contact');

		return true;
	}
}

?>