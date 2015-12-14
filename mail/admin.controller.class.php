<?php

class MailAdminController {
	public function __global() {
		$vars = ['to' => '', 'subject' => '', 'message' => ''];
		
		if (isset($_POST['mail_send'])) {
			$to = @$_POST['to'];
			$subject = @$_POST['subject'];
			$message = @$_POST['message'];

			if (empty($to))
				$to = [];
			else {
				$to = explode(',', $to);
				$to = array_map('trim', $to);
				$to = array_filter($to);
				$to = array_unique($to);
			}

			list($result, $result_message) = $this->check($to, $subject, $message);

			$vars['to'] = implode(', ', $to);

			foreach (['subject', 'message'] as $name)
				$vars[$name] = htmlspecialchars(${$name});

			if ($result === true) {
				if ($this->send_mail($to, $subject, $message)) {
					$_SESSION['limny']['mail']['success'] = true;

					redirect(BASE . '/' . ADMIN_DIR . '/mail');
				} else {
					$vars['message_class'] = 'danger';
					$vars['message_text'] = MAIL_SENTENCE_4;
				}
			} else {
				$vars['message_class'] = 'warning';
				$vars['message_text'] = $result_message;
			}
		} else if (isset($_SESSION['limny']['mail']['success'])) {
			$vars['message_class'] = 'success';
			$vars['message_text'] = MAIL_SENTENCE_5;

			unset($_SESSION['limny']['mail']['success']);
		}

		$application = load_lib('application', true, true);
		$apps = $application->apps();

		$this->title = MAIL_MAIL;
		$this->content = load_view('mail', 'form.tpl', $vars);
		$this->head = load_css('mail', 'style.css');

		if (isset($apps['ckeditor']) && empty($apps['ckeditor']['enabled']) === false)
			$this->head .= '<script type="text/javascript" src="' . BASE . '/apps/ckeditor/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function(){
	if ($("#message").length > 0)
		CKEDITOR.replace("message");
});
</script>';
	}

	private function check($to, $subject, $message) {
		if (count($to) < 1 || empty($subject) || empty($message))
			return [false, MAIL_SENTENCE_2];
		
		foreach ($to as $email)
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
				return [false, MAIL_SENTENCE_3];

		return [true, true];
	}

	private function send_mail($to, $subject, $message) {
		return send_mail($to, $subject, $message);
	}
}

?>