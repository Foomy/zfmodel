<?php

interface Db_Connection_Interface
{
	public function prepare($query);
	public function execute($query);
}