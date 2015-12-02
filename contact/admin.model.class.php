<?php

class ContactAdminModel {
	public static $db;

	public static function set_as_read($message_id) {
		return self::$db->prepare('UPDATE ' . DB_PRFX . 'contact SET `read` = 1 WHERE id = ?')->execute([$message_id]);
	}
}

?>