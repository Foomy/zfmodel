<?php

require_once 'Db/Mysql.php';

class Db_Mysql_Factory
{
	/**
	 * Return a database handle.
	 *
	 * @param	array $dbc
	 * @return	Db_Mysql | null
	 */
	public static function create($dbc)
	{
		if (! is_array($dbc)) {
			$this->showMalformedDbcError();
			return null;
		}

		if (! array_key_exists('dbname', $dbc)) {
			$this->showMalformedDbcError();
			return null;
		}

		if (! array_key_exists('user', $dbc)) {
			$this->showMalformedDbcError();
			return null;
		}

		if (! array_key_exists('pass', $dbc)) {
			$this->showMalformedDbcError();
			return null;
		}

		if (! array_key_exists('dbhost', $dbc)) {
			$dbc['dbhost'] = 'localhost';
		}

		return new Db_Mysql($dbc['user'], $dbc['pass'], $dbc['dbhost'], $dbc['dbname']);
	}

	private function showMalformedDbcError() {
			echo 'Error: Database config array not valid. It should be defined as followed:' . PHP_EOL;
			echo PHP_EOL . "\t" . '$dbc = array(' . PHP_EOL;
			echo "\t\t'dbname' => <name of your database>" . PHP_EOL;
			echo "\t\t'user'   => <username for the db connection> (Only reading rights needed.)" . PHP_EOL;
			echo "\t\t'pass'   => <connection password>" . PHP_EOL;
			echo "\t\t'dbhost' => <database host> (Optional! DbTool assume localhost, if omitted." . PHP_EOL;
			echo "\t);";
	}
}
