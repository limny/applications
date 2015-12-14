<?php

class MailApp {
	private $db;

	private $setup;

	public function __construct($registry) {
		$this->db = $registry->db;

		$setup = load_lib('setup', true, true);

		$this->setup = $setup;
	}

	public function install() {
		$this->setup->add_adminnav([
			['title' => 'MAIL_MAIL', 'query' => 'mail']
		]);

		$this->setup->add_permission([
			['name' => 'MAIL_MAIL', 'query' => 'mail', 'sub_allowed' => true]
		]);

		return true;
	}

	public function uninstall() {
		$this->setup->adminnav_delete('mail');

		$this->setup->permission_delete('mail');

		return true;
	}
}

?>