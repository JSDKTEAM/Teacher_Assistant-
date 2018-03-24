<?php
	class conDb {
		private static $instance = NULL;
		private static $dsn = "mysql:dbname=web_app;host=localhost";
		private static $user = "root";
		private static $pass = "";
			private function __construct() {}
			private function __clone() {}
			public static function getInstance() {
			if (!isset(self::$instance)) {
				self::$instance = new PDO(self::$dsn,self::$user,self::$pass);
				self::$instance->exec("set names utf8");
			}
			return self::$instance;
			}
		}
?>

