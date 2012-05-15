<?php

interface Db_Statement_Interface
{
	public function execute();
	public function bindParam($key, $value);
	public function fetchRow();
	public function fetchAll();
	public function fetchAssoc();
	public function fetchAllAssoc();
}