<?php

class ContactModel {
	public static $db;

	public static function insert($name, $email, $message) {
		foreach (['name', 'email', 'message'] as $field_name)
			${$field_name} = htmlspecialchars(${$field_name});
		
		return self::$db->prepare('INSERT INTO ' . DB_PRFX . 'contact (name, email, message, ip, time) VALUES (?, ?, ?, INET_ATON(?), UNIX_TIMESTAMP())')->execute([$name, $email, $message, $_SERVER['REMOTE_ADDR']]);
	}

	public static function count($ip, $period = 3600) {
		$result = self::$db->prepare('SELECT COUNT(id) AS count FROM ' . DB_PRFX . 'contact WHERE ip = INET_ATON(?) AND UNIX_TIMESTAMP() - time < ?');
		$result->execute([$ip, $period]);
		
		return $result->fetch(PDO::FETCH_ASSOC)['count'];
	}
}

?>