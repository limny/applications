<?php

class LogviewApp {
	private $setup;

	public function __construct($registry) {
		$setup = load_lib('setup', true, true);

		$this->setup = $setup;
	}

	public function install() {
		$this->setup->add_adminnav([
			['title' => 'Log View', 'query' => 'logview']
		]);

		$this->setup->add_permission([
			['name' => 'Log View', 'query' => 'logview', 'sub_allowed' => false]
		]);

		return true;
	}

	public function uninstall() {
		$this->setup->adminnav_delete('logview');

		$this->setup->permission_delete('logview');

		return true;
	}
}

?>