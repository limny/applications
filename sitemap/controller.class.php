<?php

class SitemapController {
	public $q;
	public $cache;
	
	public $head;
	public $title;
	public $content;

	public function SitemapController($registry) {
		require_once PATH . '/apps/post/model.class.php';
		PostModel::$db = $registry->db;
	}

	public function __default() {
		$items = '';

		foreach (PostModel::posts(999) as $post) {

			$params = [
				'url' => $this->post_permalink($post['id']),
				'date' => date('Y-m-d', empty($post['update']) ? $post['time'] : $post['updated']),
				'change' => 'monthly',
				'priority' => '1.0'
			];

			$items .= load_view('sitemap', 'item.tpl', $params) . "\n";
		}

		header('Content-Type: text/xml;');

		print load_view('sitemap', 'sitemap.tpl', ['items' => $items]);

		exit;
	}

	private function post_permalink($post_id) {
		$permalink = load_lib('permalink');

		if ($permalink_item = $permalink->permalink_by_query('post/' . $post_id))
			$post['url'] = url($permalink_item['permalink'], true);
		else
			$post['url'] = url('post/' . $post_id, true);

		return $post['url'];
	}
}

?>