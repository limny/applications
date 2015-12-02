<?php

class ContactController {
	public $q;
	public $cache;

	public $head;
	public $title;
	public $content;

	public function ContactController($registry) {
		ContactModel::$db = $registry->db;
	}

	public function __default() {
		$vars = [];

		if (isset($_POST['contact_submit'])) {
			$name = @$_POST['name'];
			$email = @$_POST['email'];
			$message = @$_POST['message'];

			list($result, $result_message) = $this->check($name, $email, $message);

			if ($result === true) {
				$_SESSION['limny']['contact']['success'] = true;
				
				ContactModel::insert($name, $email, $message);

				redirect(url('contact'));
			} else {
				$vars['class'] = 'error';
				$vars['message'] = $result_message;
			}
		}

		if (isset($_SESSION['limny']['contact']['success'])) {
			unset($_SESSION['limny']['contact']['success']);

			$vars['class'] = 'success';
			$vars['message'] = CONTACT_SENTENCE_3;
		}

		$this->title = CONTACT_CONTACT;
		$this->head = load_css('contact', 'style.css');
		$this->content = load_view('contact', 'form.tpl', $vars);
	}

	private function check($name, $email, $message) {
		if (empty($name) || empty($email) || empty($message))
			return [false, CONTACT_SENTENCE_1];
		else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
			return [false, CONTACT_SENTENCE_2];

		return [true, true];
	}
}

?>