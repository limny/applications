<?php

class ContactAdminController extends Manage {
	public $q;
	
	public $head;
	public $title;
	public $content;

	public $manage_upload_path = PATH . DS . 'uploads';

	public function __construct($registry) {
		parent::__construct($registry);

		$this->manage_q = $this->q;

		ContactAdminModel::$db = $registry->db;
	}

	public function messages() {
		$this->manage_title = CONTACT_MESSAGES;
		$this->manage_table = 'contact';
		$this->manage_head = [
			CONTACT_NAME => 'name',
			CONTACT_DATE => 'time',
			CONTACT_STATUS => 'read'
		];
		$this->manage_sort = ['name', 'time'];
		$this->manage_order = ['id' => 'DESC'];
		$this->manage_fields = [
			'name' => [
				'label' => CONTACT_NAME,
				'type' => 'text',
				'required' => true
			],
			'email' => [
				'label' => CONTACT_EMAIL,
				'type' => 'text',
				'required' => true
			],
			'message' => [
				'label' => CONTACT_MESSAGE,
				'type' => 'textarea'
			]
		];
		$this->manage_fields_view = [
			'name' => ['label' => CONTACT_NAME],
			'email' => ['label' => CONTACT_EMAIL],
			'message' => ['label' => CONTACT_MESSAGE],
			'ip' => ['label' => CONTACT_IP],
			'time' => ['label' => CONTACT_DATE],
		];
		$this->manage_add = false;
		$this->manage_view = true;
		$this->manage_edit = false;

		$this->manage_action->list->time = 'system_date';
		$this->manage_action->list->read = 'message_status';
		$this->manage_action->view->message = 'nl2br';
		$this->manage_action->view->ip = 'long2ip';
		$this->manage_action->view->time = 'system_date';
		$this->manage_action->view->function = 'set_as_read';
		$this->manage_action->edit->function = 'set_as_read';

		$this->title = CONTACT_MESSAGES;
		$this->content = $this->manage();
	}

	protected function set_as_read($column, $post, $files, $id) {
		return ContactAdminModel::set_as_read($id);
	}

	protected function message_status($status) {
		if (empty($status))
			return '<span class="text-red">' . CONTACT_UNREAD . '</span>';
		
		return false;
	}
}

?>