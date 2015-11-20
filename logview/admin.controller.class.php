<?php

class LogviewAdminController {
	public function __default() {
		$log_file = PATH . DS . '.limny_error';

		if (file_exists($log_file) === false)
			file_put_contents($log_file, '');

		$log_content = file_get_contents($log_file);

		$this->title = 'Log view';
		$this->content = load_view('logview', 'logview.tpl', ['log_file' => $log_file, 'log_content' => $log_content]);
	}
}

?>