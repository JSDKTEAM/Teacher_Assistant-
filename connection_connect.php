<?php
	class conDb {
		private static $instance = NULL;
		private static $dsn = "mysql:dbname=WAD_05;host=localhost";
		private static $user = "WAD_05";
		private static $pass = "WAD_05";
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

