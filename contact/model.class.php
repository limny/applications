<?php

class ContactModel {
	public static $db;

	public static function insert($name, $email, $message) {
		foreach (['name', 'email', 'message'] as $field_name)
			${$field_name} = htmlspecialchars(${$field_name});
		
		return self::$db->prepare('INSERT INTO ' . DB_PRFX . 'contact (name, email, message, ip, time) VALUES (?, ?, ?, INET_ATON(?), UNIX_TIMESTAMP())')->execute([$name, $email, $message, $_SERVER['REMOTE_ADDR']]);
	}
}

?>