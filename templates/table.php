<?php

/**
 * @todo	May using Zend_View and view scripts for this templates.
 */

$tplTable = array(
	'path' => MODEL_PATH . '/Table/',

	'lines' => array(
		'<?php',

		'',
		'/**',
		' * Table class for the model of [project].',
		' *',
		' * @author'.TAB.TAB.'zfmodel <zfmodel@sirfoomy.de>',
		' * @author'.TAB.TAB.'[coderName] <[coderEmail]>',
		' *',
		' * @category'.TAB.'model',
		' * @package'.TAB.TAB.'[tableClassName]',
		' */',
		'class [tableClassName] extends Zend_Db_Table_Abstract',
		'{',
		TAB."const T_NAME = '[tableName]';",

		'',
		"[fieldConstants]",

		'',
		TAB.'protected $_name'.TAB.TAB.'= self::T_NAME;',
		TAB.'protected $_primary'.TAB.TAB.'= self::F_ID;',
		TAB.'protected $_rowClass'.TAB."= '[tableRowClassName]';",
		TAB.'protected $_sequence'.TAB.'= true;',

		'',
		TAB.'protected $_referenceMap = array();',
		TAB.'protected $_dependentTables = array();',

		'',
		TAB.'protected static $instance = null;',

		'',
		TAB.'/**',
		TAB.' * Returns an instance of the client table.',
		TAB.' *',
		TAB.' * @return'.TAB.'[tableClassName]',
		TAB.' */',
		TAB.'public static function getInstance()',
		TAB.'{',
		TAB.TAB.'if (null === self::$instance) {',
		TAB.TAB.TAB.'self::$instance = new self();',
		TAB.TAB.'}',
		'',
		TAB.TAB.'return self::$instance;',
		TAB.'}',

		'',
		TAB.'/**',
		TAB.' * Returns a rowset with all entries stored in the table.',
		TAB.' *',
		TAB.' * @return'.TAB.'Zend_Db_Table_Rowset_Abstract',
		TAB.' */',
		TAB.'public static function getAll()',
		TAB.'{',
		TAB.TAB.'$select = self::getInstance()->select();',
		TAB.TAB.'return self::getInstance()->fetchAll($select);',
		TAB.'}',

		'',
		TAB.'/**',
		TAB.' * Returns a data record specified by its database id.',
		TAB.' *',
		TAB.' * @param'.TAB.'int $id',
		TAB.' * @return'.TAB.'[tableRowClassName] | null',
		TAB.' */',
		TAB.'public static function findById($id)',
		TAB.'{',
		TAB.TAB.'$select = self::getInstance()->select();',
		TAB.TAB.'$select->where(self::F_ID . \'=?\', $id);',
		TAB.TAB.'return self::getInstance()->fetchRow($select);',
		TAB.'}',
		'}'
	)
);

