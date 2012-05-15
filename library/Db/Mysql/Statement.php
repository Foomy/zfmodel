<?php

require_once 'Db/Statement/Interface.php';
require_once 'Db/Mysql/Exception.php';

class Db_Mysql_Statement implements Db_Statement_Interface
{
	public $result;
	public $binds = array();
	public $query;
	public $dbh;

	public function __construct($dbh, $query)
	{
		$this->query = $query;
		$this->dbh = $dbh;

		if (! is_resource($dbh)) {
			throw new Mysql_Exception("Not a valid database connection");
		}
	}

	public function bindParam($ph, $pv)
	{
		$this->binds[$ph] = $pv;
		return $this;
	}

	public function execute()
	{
		$binds = func_get_args();

		foreach ($binds as $index => $name) {
			$this->binds[$index + 1] = $name;
		}

		$cnt = count($binds);
		$query = $this->query;

		foreach ($this->binds as $ph => $pv) {
			$query = str_replace(":$ph", "'" . mysql_escape_string($pv) . "'", $query);
		}

		$this->result = mysql_query($query, $this->dbh);

		if ( !$this->result ) {
			throw new Mysql_Exception();
		}

		return $this;
	}

	public function fetchRow()
	{
		if ( !$this->result ) {
			throw new Mysql_Exception("Query not executed");
		}

		return mysql_fetch_row($this->result);
	}

	public function fetchAll()
	{
		$retval = array();

		while (is_array($row = $this->fetchRow())) {
			$retval[] = $row[0];
		}

		return $retval;
	}

	public function fetchAssoc()
	{
		return mysql_fetch_assoc($this->result);
	}

	public function fetchAllAssoc()
	{
		$retval = array();

		while (is_array($row = $this->fetchAssoc())) {
			$retval[] = $row;
		}

		return $retval;
	}
}