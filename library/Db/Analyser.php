<?php

/**
 * Analyser for MySQL databases.
 *
 * @author		Sascha Schneider <foomy.code@arcor.de>
 *
 * @category	library
 * @package		Db_Analyser
 */
class Db_Analyser
{
	private $_db;

	private $_tables;

	public function __construct(Db_Mysql $db)
	{
		$this->_db = $db;
	}

	public function analyse() {
		$tables = $this->readTables();

		foreach ($tables as $table) {
			$fields = $this->readFields($table);
			$this->_tables[$table] = $fields;
		}
	}

	public function getTable($tablename)
	{
		if (null !== $this->_tables) {
			if (array_key_exists($tablename, $this->_tables)) {
				return $this->_tables[$tablename];
			}
		}

		return false;
	}

	public function getAllTables()
	{
		return $this->_tables;
	}

	public function getTablesNames()
	{
		return array_keys($this->_tables);
	}

	private function readFields($table)
	{
		$fiels = array();
		$query = 'DESCRIBE ' . $table;
		$result = $this->_db->prepare($query)->execute()->fetchAllAssoc();

		foreach ($result as $res) {
			$fields[array_shift($res)] = $res;
		}

		return $fields;
	}

	private function readTables()
	{
		$query = 'SHOW TABLES';
		$result = $this->_db->prepare($query)->execute()->fetchAll();

		return $result;
	}
}
