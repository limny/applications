<?php

class SitemapApp {
	private $permalink;

	public function __construct($registry) {
		$this->permalink = load_lib('permalink');
	}

	public function install() {
		$this->permalink->add_permalink('sitemap', 'sitemap.xml');

		return true;
	}

	public function uninstall() {
		$this->permalink->permalink_remove('sitemap');

		return true;
	}
}

?>