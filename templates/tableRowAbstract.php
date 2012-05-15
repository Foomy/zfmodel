<?php

/**
 * @todo	May using Zend_View and view scripts for this templates.
 */

$tplTableRowAbstract = array(
	'path' => MODEL_PATH . '/Table/Row/',

	'lines' => array(
		'<?php',
		'',
		'/**',
		' * Abstract row class for the <project> model',
		' *',
		' * @author'.TAB.TAB.'zfmodel <zfmodel@sirfoomy.de>',
		' * @author'.TAB.TAB.'[coderName] <[coderEmail]>',
		' *',
		' * @category'.TAB.'model',
		' * @package'.TAB.TAB.'Model_Table_Row_Abstract',
		' */',
		'class Model_Table_Row_Abstract extends Zend_Db_Table_Row_Abstract',
		'{',
		TAB.'protected $_primary = Model_Table_Abstract::F_ID;',

		'',
		TAB.'protected $_id;',
		TAB.'protected $_created;',
		TAB.'protected $_modified;',

		'',
		TAB.'public function init() {',
		TAB.TAB.'parent::init();',
		'',
		TAB.TAB.'$this->_id'.TAB.TAB.TAB.'= Model_Table_Abstract::F_ID;',
		TAB.TAB.'$this->_created'.TAB.TAB.'= Model_Table_Abstract::F_CREATED;',
		TAB.TAB.'$this->_modified'.TAB.'= Model_Table_Abstract::F_MODIFIED;',
		TAB.'}',

		'',
		TAB.'/**',
		TAB.' * Returns the database id.',
		TAB.' *',
		TAB.' * @return'.TAB.'int $id',
		TAB.' */',
		TAB.'public function getId()',
		TAB.'{',
		TAB.TAB.'return $this->{$this->_id};',
		TAB.'}',

		'',
		TAB.'/**',
		TAB.' * Returns the creation datetime of the data record.',
		TAB.' *',
		TAB.' * @return'.TAB.'string $creationDate',
		TAB.' */',
		TAB.'public function wasCreatedOn()',
		TAB.'{',
		TAB.TAB.'return $this->{$this->_created};',
		TAB.'}',

		'',
		TAB.'/**',
		TAB.' * Returns the datetime of the last modification.',
		TAB.' *',
		TAB.' * @return'.TAB.'string $modificationDate',
		TAB.' */',
		TAB.'public function wasLastModifiedOn()',
		TAB.'{',
		TAB.TAB.'return $this->{$this->_modified};',
		TAB.'}',
		'',
		TAB.'/**',
		TAB.' * Checks, if a string contains a valid date.',
		TAB.' *',
		TAB.' * @param'.TAB.'Zend_Validate_Date $validatorTABOptional!',
		TAB.' * @return'.TAB.'Zend_Validate_Date',
		TAB.' */',
		TAB.'protected function isDateValid($date, $format = \'YYYY-MM-DD\', Zend_Validate_Date $validator = null)',
		TAB.'{',
		TAB.TAB.'if (null === $validator) {',
		TAB.TAB.TAB.'$validator = new Zend_Validate_Date();',
		TAB.TAB.TAB.'$validator->setFormat($format);',
		TAB.TAB.'}',
		'',
		TAB.TAB.'return $validator->isValid($date);',
		TAB.'}',

		'',
		TAB.'/**',
		TAB.' * Lazy initilization of an bootstrap instance',
		TAB.' */',
		TAB.'protected function getBootstrap(Zend_Application_Bootstrap_Bootstrap $bootstrap = null)',
		TAB.'{',
		TAB.TAB.'if (null === $bootstrap) {',
		TAB.TAB.TAB.'$bootstrap = Zend_Controller_Front::getInstance()->getParam(\'bootstrap\');',
		TAB.TAB.'}',
		'',
		TAB.TAB.'return $bootstrap;',
		TAB.'}',

		'',
		TAB.'/**',
		TAB.' * Lazy initilization of the logger.',
		TAB.' *',
		TAB.' * @param'.TAB.'Zend_Log $loggerTABOptional!',
		TAB.' * @return'.TAB.'Zend_Log',
		TAB.' */',
		TAB.'protected function getLogger(Zend_Log $logger = null)',
		TAB.'{',
		TAB.TAB.'if (null === $logger) {',
		TAB.TAB.TAB.'$logger = $this->getBootstrap()->getResource(\'log\');',
		TAB.TAB.'}',
		'',
		TAB.TAB.'return $logger;',
		TAB.'}',

		'',
		TAB.'/**',
		TAB.' * Print variables like var_dump() to logger.',
		TAB.' *',
		TAB.' * @param'.TAB.'mixed $var1, $var',
		TAB.' * @param'.TAB.'mixed $var2',
		TAB.' */',
		TAB.'protected function debug($var1, $var2 = null)',
		TAB.'{',
		TAB.TAB.'$logger = $this->getLogger();',
		'',
		TAB.TAB.'$argsCount = func_num_args();',
		TAB.TAB.'if ($argsCount > 1) {',
		TAB.TAB.TAB.'$args = func_get_args();',
		'',
		TAB.TAB.TAB.'for ($i = 0; $i < $argsCount; $i++) {',
		TAB.TAB.TAB.TAB.'$logger->log($args[$i], Zend_Log::DEBUG);',
		TAB.TAB.TAB.'}',
		TAB.TAB.'}',
		TAB.TAB.'else {',
		TAB.TAB.TAB.'$logger->log($var1, Zend_Log::DEBUG);',
		TAB.TAB.'}',
		TAB.'}',
		'}'
	)
);

