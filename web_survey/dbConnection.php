<?php
/*
 * 	dbConnection.php
 * 		Defines the database connection class
*/

class dbConnection extends PDO
{
	// set location for the config file
	private $config_file = 'configs/config.ini';
	private $config = array();
	private $db_host = '', $db_name = '';

	public function __construct()
	{
		// Get the values from the configuration ini file
		$config = parse_ini_file($this->config_file);
		$db_host = $config['db_host'];
		$db_name = $config['db_name'];
		parent::__construct("mysql:host=$db_host;dbname=$db_name",
			$config['db_user'],
			$config['db_pass'],
			array(PDO::ATTR_PERSISTENT => true)
			);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
}
?>
