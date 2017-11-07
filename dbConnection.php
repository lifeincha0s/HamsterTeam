<?php
/*
	dbConnection.php
	Defines the database connection class
	@params - none
	@return - database connection object (PDO_MYSQL)
*/

class dbConnection extends PDO
{
	// set location for the config file
	private static $config_file	= './config.ini';
	
	public function __construct()
	{
		// Get the values from the configuration ini file
		$config = parse_ini_file($this->config_file);
		
		parent::__construct(
			'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'],
			$config['db_user'],
			$config['db_pass'],
			array(PDO::ATTR_PERSISTENT => true)
			);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
}
?>