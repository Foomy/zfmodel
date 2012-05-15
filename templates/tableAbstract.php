<?php

/**
 * @todo	May using Zend_View and view scripts for this templates.
 */

$tplTableAbstract = array(
	'path' => MODEL_PATH . '/Table/',

	'lines' => array(
		'<?php',

		'',
		'/**',
		' * Abstract DB table class for the model of mcp admin tool.',
		' *',
		' * @author'.TAB.TAB.'zfmodel <zfmodel@sirfoomy.de>',
		' * @author'.TAB.TAB.'[coderName] <[coderEmail]>',
		' *',
		' * @package'.TAB.TAB.'Model_Table_Abstract',
		' */',
		'class Model_Table_Abstract extends Zend_Db_Table_Abstract',
		'{',
		TAB.'const ASC'.TAB.'= \' ASC\';',
		TAB.'const DESC'.TAB.'= \' DESC\';',
		'',
		TAB.'const F_ID'.TAB.TAB.TAB.'= \'id\';',
		TAB.'const F_CREATED'.TAB.TAB.'= \'created\';',
		TAB.'const F_MODIFIED'.TAB.'= \'modified\';',

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
		TAB.' * @param	Zend_Log $logger	Optional!',
		TAB.' * @return	Zend_Log',
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
		TAB.' * @param mixed $var1, $var',
		TAB.' * @param mixed $var2',
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

