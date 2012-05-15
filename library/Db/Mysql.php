<?php

require_once 'Db/Connection/Interface.php';
require_once 'Db/Mysql/Statement.php';
require_once 'Db/Mysql/Exception.php';

class Db_Mysql implements Db_Connection_Interface
{
	protected $user;
	protected $pass;
	protected $dbhost;
	protected $dbname;
	protected $dbh;

	public function __construct($user, $pass, $dbhost, $dbname)
	{
		$this->user = $user;
		$this->pass = $pass;
		$this->dbhost = $dbhost;
		$this->dbname = $dbname;
	}

	public function get_resource()
	{
		return $this->dbh;
	}

	protected function connect()
	{
		$this->dbh = mysql_pconnect($this->dbhost, $this->user, $this->pass);

		if (! is_resource($this->dbh)) {
			throw new Mysql_Exception();
		}

		if (! mysql_select_db($this->dbname, $this->dbh)) {
			throw new Mysql_Exception();
		}
	}

	public function execute($query)
	{
		if ( !$this->dbh ) {
			$this->connect();
		}

		$ret = mysql_query($query, $this->dbh);

		if (! $ret) {
			throw new Mysql_Exception();
		}
		else {
			if (! is_resource($ret)) {
				return true;
			}
			else {
				$stmt = new Db_Mysql_Statement($this->dbh, $query);
				$stmt->result = $ret;
				return $stmt;
			}
		}
	}

	public function prepare($query)
	{
		if ( !$this->dbh ) {
			$this->connect();
		}
		return new Db_Mysql_Statement($this->dbh, $query);
	}
}